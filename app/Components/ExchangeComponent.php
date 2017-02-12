<?php

namespace app\Components;


use App\Order;
use App\Product;
use Illuminate\Database\Eloquent\Collection;

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
                ['id_1c' => (string)$product->Ид],
                $data
            );

        }

        return 'Выгрузка сведений о товарах завершена';
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
                ['id_1c' => (string)$offers->Ид],
                $data
            );
        }

        Product::where('price_1', (float)0)->delete();

        return 'Выгрузка сведений о ценах завершена';
    }

    public function query()
    {
        $orders = Order::where('status', 0)->get()->load('orderItems');

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><КоммерческаяИнформация ВерсияСхемы="2.04" ДатаФормирования="' . \Carbon\Carbon::now()->format('Y-m-d') . '" />');

        if ($orders->isEmpty()) {
            return $xml->saveXML();
        }

        /** @var Collection $orders */
        /** @var Order $order */
        foreach ($orders as $order) {

            $doc = $xml->addChild('Документ');
            $doc->addChild('Ид', $order->id);
            $doc->addChild('Номер', $order->id);
            $doc->addChild('Дата', $order->created_at->format('Y-m-d'));
            $doc->addChild('ХозОперация', 'Заказ товара');
            $doc->addChild('Роль', 'Продавец');
            $doc->addChild('Валюта', 'руб.');
            $doc->addChild('Курс', 1);
            $doc->addChild('Сумма', $order->sum);
            $doc->addChild('Время', $order->created_at->format('H:i:s'));
            $doc->addChild('Комментарий', $order->organization . ' ~ ' . $order->name . ' ~ ' . $order->phone . ' ~ ' . $order->email . ' === ' . $order->note . ':');

            $c = $doc->addChild('Контрагенты')->addChild('Контрагент');
            $c->addChild('Ид', '1#Web# Web');
            $c->addChild('Наименование', 'Web');
            $c->addChild('Роль', 'Покупатель');
            $c->addChild('ПолноеНаименование', 'Web');


            foreach ($order->orderItems as $item) {
                $p = $doc->addChild('Товары')->addChild('Товар');
                $p->addChild('Ид', $item->id_1c);
                $p->addChild('Наименование', htmlspecialchars($item->name, ENT_QUOTES));
                $p->addChild('ЦенаЗаЕдиницу', $item->price);
                $p->addChild('Количество', $item->quantity);
                $p->addChild('Сумма', $item->sum);
            }
            //$r = $doc->addChild('ЗначенияРеквизитов')->addChild('ЗначениеРеквизита');
            //$r->addChild('Наименование', 'Финальный статус');
            //$r->addChild('Значение', 'true');

        }

        return $xml->saveXML();

    }

    public function statusOne()
    {
        Order::where('status', 0)->update(['status' => 1]);
    }

    public function __call($name, $arguments)
    {
        return false;
    }

}