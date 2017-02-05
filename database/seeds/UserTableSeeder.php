<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now();

        DB::table('users')->insert([
            [
                'name' => 'Администратор',
                'email' => 'admin@admin.ru',
                'password' => bcrypt('0'),
                'is_admin' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'name' => 'Менеджер',
                'email' => 'manager@manager.ru',
                'password' => bcrypt('0'),
                'is_admin' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'name' => 'Чувак',
                'email' => 'test@test.ru',
                'password' => bcrypt('0'),
                'is_admin' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
        ]);
    }
}
