<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now();
        DB::table('orders')->insert([
            [
                'quantity' => 3,
                'sum' => 300,
                'name' => 'Вася Пупкин',
                'email' => 'vasya@pupkin.ru',
                'organization' => 'Рога и копыта',
                'phone' => '+7 (912) 999-99-99',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'quantity' => 1,
                'sum' => 100,
                'name' => 'Жена Васи Пупкина',
                'email' => 'wife_vasya@pupkin.ru',
                'organization' => 'Ромашка',
                'phone' => '+7 (912) 888-88-88',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'quantity' => 10,
                'sum' => 10000,
                'name' => 'Петя',
                'email' => '',
                'organization' => '',
                'phone' => '+7 (922) 666-66-66',
                'created_at' => $date,
                'updated_at' => $date
            ],
        ]);
    }
}
