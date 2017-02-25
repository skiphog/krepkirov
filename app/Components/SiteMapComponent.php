<?php

namespace App\Components;


use App\Category;

class SiteMapComponent
{

    protected static $static_url = [
        '',
        '/prices',
        '/certificates',
        '/contacts',
        '/catalog'
    ];

    public function makeSiteMap()
    {
        $categories = Category::select('full_url')
            ->withoutGlobalScopes()
            ->orderBy('id')
            ->pluck('full_url')
            ->toArray();

        array_walk($categories, function (&$value) {
            $value = '/catalog/' . $value;
        });

        $categories = array_merge(self::$static_url, $categories);

        return $this->makeXml($categories);

    }

    protected function makeXml(array $categories)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');

        //$dom->formatOutput = true;

        $root = $dom->createElement('urlset');
        $root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $root->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $root->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');


        foreach ($categories as $category) {
            $url = $dom->createElement('url');
            $loc = $dom->createElement('loc', config('app.url') . $category);
            $url->appendChild($loc);
            $root->appendChild($url);
        }

        $dom->appendChild($root);

        return (int)(bool)$dom->save(public_path() . '/sitemap.xml');
    }


}