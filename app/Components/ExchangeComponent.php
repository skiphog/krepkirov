<?php

namespace app\Components;


use App\Product;

class ExchangeComponent
{

    public static function run()
    {
        return new static;
    }


    public function parse($filename)
    {
        if (($xml = simplexml_load_file(storage_path('app/') . $filename)) === false) {
            return false;
        }

        $method = pathinfo($filename, PATHINFO_FILENAME);

        return $this->$method($xml);
    }

    protected function import(\SimpleXMLElement $xml)
    {
        $data = [];

        foreach ($xml->Каталог->Товары->Товар as $product) {

            $data['name'] = (string)$product->Наименование;
            $data['description'] = (string)$product->Описание ?: '';
            $data['weight'] = (float)($product->ЗначенияРеквизитов->ЗначениеРеквизита[3]->Значение ?: 0.000);

            Product::updateOrCreate(
                ['1c_id' => (string)$product->Ид],
                $data
            );

        }

        return true;
    }

    protected function offers(\SimpleXMLElement $xml)
    {
        foreach ($xml->ПакетПредложений->Предложения->Предложение as $offers) {
            $tmp = [];

            foreach ($offers->Цены->Цена as $price) {
                $tmp[] = (float)$price->ЦенаЗаЕдиницу;
            }
            rsort($tmp);

            /** @noinspection ReturnFalseInspection */
            $data = array_combine(['price_1', 'price_2', 'price_3'], $tmp);

            $data['unit'] = (string)$offers->БазоваяЕдиница;
            $data['quantity'] = (float)$offers->Количество;

            Product::updateOrCreate(
                ['1c_id' => (string)$offers->Ид],
                $data
            );
        }

        Product::where('price_1', (float)0)->delete();

        return true;
    }

    public function __call($name, $arguments)
    {
        return false;
    }

}