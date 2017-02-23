<?php

namespace App;

use App\Traits\RewriteJsonable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Category
 *
 * @property int $id
 * @property int $parent_id
 * @property string $url
 * @property string $full_url
 * @property string $title
 * @property string $nav_title
 * @property string $img
 * @property string $text
 * @property string $description
 * @property int $sort
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereFullUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereImg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereIsShow($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereNavTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereSort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUrl($value)
 * @mixin \Eloquent
 * @property array $breadcrumbs
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereBreadcrumbs($value)
 * @property string $standard
 * @property string $additionally
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereAdditionally($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereStandard($value)
 */
class Category extends Model
{
    use RewriteJsonable;

    /**
     * Хлебные крошки хранятся как json
     * @var array
     */
    protected $casts = [
        'breadcrumbs' => 'array',
    ];

    protected $guarded = [];


    /**
     * @todo Убрать эту фигю отсюда!!!! Доавить простой scope
     * Все запросы по умолчанию включают в себя where is_show = 1
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy('sort', 'asc');
        });
    }

    /**
     * Получаем дерево категорий
     * @return array
     */
    public static function getTreeCategories()
    {

        //todo: Достать из кеша

        $categories = parent::all(['id', 'parent_id', 'full_url', 'nav_title'])->keyBy('id')->toArray();
        $tree = [];

        foreach ($categories as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
                continue;
            }
            $categories[$node['parent_id']]['children'][$node['id']] = &$node;
        }

        unset($node);

        return $tree;
    }

    public function setImgAttribute($value)
    {
        if (empty($value)) {
            return $this->attributes['img'] = config('s.default_img_category');
        }

        return $this->attributes['img'] = $value;
    }

}
