<?php

use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $date = \Carbon\Carbon::now();

        DB::table('prices')->insert([
            [
                'name' => 'Крепеж',
                'file' => '1_KM_krepeg.xls',
                'url' => 'http://krepkirov.dev/downloads/price/1_KM_krepeg.xls',
                'description' => 'Гвозди, саморезы, шурупы, болты, винты, гайки, шайбы, анкеры, дюбели, уголки, биты, сверла, буры, такелаж',
                'size' => 4756480,
                'm_date' => $date,
            ],
            [
                'name' => 'Инструмент',
                'file' => '2_KM_furnitura.xls',
                'url' => 'http://krepkirov.dev/downloads/price/2_KM_furnitura.xls',
                'description' => 'Ручной и электро инструмент',
                'size' => 1959424,
                'm_date' => $date,
            ],
            [
                'name' => 'Фурнитура',
                'file' => '3_KM_instrument.xls',
                'url' => 'http://krepkirov.dev/downloads/price/3_KM_instrument.xls',
                'description' => 'Мебельная фурнитура, петли, ручки, замки, ушки, подвески, крючки-вешалки, шпингалеты',
                'size' => 2585600,
                'm_date' => $date,
            ],
            [
                'name' => 'Сантехника',
                'file' => '4_KM_santehnika.xls',
                'url' => 'http://krepkirov.dev/downloads/price/4_KM_santehnika.xls',
                'description' => 'Трубы, канализация, краны, шланги, фитинги',
                'size' => 784896,
                'm_date' => $date,
            ],
            [
                'name' => 'Теплицы',
                'file' => '5_KM_teplizy.xls',
                'url' => 'http://krepkirov.dev/downloads/price/5_KM_teplizy.xls',
                'description' => 'Теплицы и комплектующие, поликарбонат',
                'size' => 94208,
                'm_date' => $date,
            ],
            [
                'name' => 'Утеплитель',
                'file' => '6_KM_uteplitel.xls',
                'url' => 'http://krepkirov.dev/downloads/price/6_KM_uteplitel.xls',
                'description' => 'Кровельные материалы',
                'size' => 303616,
                'm_date' => $date,
            ]
        ]);
    }
}
