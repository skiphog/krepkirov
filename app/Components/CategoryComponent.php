<?php

namespace App\Components;


use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryComponent
{

    protected $request;


    public function __construct(CategoryRequest $request)
    {
        $this->request = $request->except('_token', '_method');
    }

    public function createCategory()
    {
        $this->generateData();

        return Category::create($this->request);
    }

    public function editCategory(Category $category)
    {
        $this->generateData();

        $category->update($this->request);

        $this->changeUrl($category->id);

    }

    protected function generateData()
    {

        $this->generateUrl();

        $this->request['full_url'] = $this->makeFullUrl($this->request['parent_id'], $this->request['url']);

        $this->request['breadcrumbs'] = $this->makeBreadcrumbs($this->request['parent_id']);
    }

    private function changeUrl($parent_id)
    {
        $children = Category::where('parent_id', $parent_id)->get();

        $page = [];

        foreach ($children as $child) {
            $page['full_url'] = $this->makeFullUrl($child->parent_id, $child->url);
            $page['breadcrumbs'] = $this->makeBreadcrumbs($child->parent_id);
            Category::where('id', $child->id)->first()->fill($page)->save();
            $this->changeUrl($child->id);
        }
    }

    protected function generateUrl()
    {
        $this->request['url'] = $this->transliterate($this->request['title']);
    }

    private function makeFullUrl($parent_id, $url)
    {
        if ((int)$parent_id === 0) {
            return $url;
        }

        return Category::where('id', $parent_id)->value('full_url') . '/' . $url;
    }

    private function makeBreadcrumbs($parent_id)
    {
        if ((int)$parent_id === 0) {
            return [];
        }

        $category = Category::where('id', $parent_id)->first();

        $breadcrumbs = $category->breadcrumbs;

        $breadcrumbs[] = [
            'title' => $category->title,
            'url' => $category->full_url
        ];

        return $breadcrumbs;

    }

    private function transliterate($string)
    {
        $str = mb_strtolower($string);

        $leter_array = [
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г',
            'd' => 'д',
            'e' => 'е,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            '' => 'ъ,ь',
            'y' => 'ы',
            'yu' => 'ю',
            'ya' => 'я',
        ];

        foreach ($leter_array as $leter => $kyr) {
            $kyr = explode(',', $kyr);

            $str = str_replace($kyr, $leter, $str);

        }

        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);

        $str = trim($str, '-');

        return $str;
    }


}