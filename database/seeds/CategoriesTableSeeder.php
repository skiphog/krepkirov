<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = \Carbon\Carbon::now();
        DB::table('categories')->insert([
            [
                'parent_id' => 0,
                'url' => 'anker',
                'full_url' => 'anker',
                'title' => 'Анкеры',
                'nav_title' => 'Анкеры',
                'img' => 'anker/anker_gayka.png',
                'text' => 'Анкерная техника',
                'description' => 'Анкерная техника',
                'standard' => '',
                'additionally' => '',
                'breadcrumbs' => json_encode([]),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 1,
                'url' => 'anker-gayka',
                'full_url' => 'anker/anker-gayka',
                'title' => 'Анкерный болт с гайкой',
                'nav_title' => 'Анкерный болт с гайкой',
                'img' => 'anker/anker_gayka.png',
                'text' => 'Анкерный болт с шестигранной гайкой для крепления тяжеловесных конструкций к плотным материалам',
                'description' => 'Анкерный болт с шестигранной гайкой для крепления тяжеловесных конструкций к плотным материалам',
                'standard' => '',
                'additionally' => 'бетон, кирпич',
                'breadcrumbs' => json_encode([['title' => 'Анкеры','url' => 'anker']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 1,
                'url' => 'anker-bolt',
                'full_url' => 'anker/anker-bolt',
                'title' => 'Анкерный болт',
                'nav_title' => 'Анкерный болт',
                'img' => 'anker/anker_bolt.png',
                'text' => 'Анкерный болт для крепления тяжеловесных конструкций к плотным материалам',
                'description' => 'Анкерный болт для крепления тяжеловесных конструкций к плотным материалам',
                'standard' => '',
                'additionally' => 'бетон, кирпич',
                'breadcrumbs' => json_encode([['title' => 'Анкеры','url' => 'anker']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 1,
                'url' => 'anker-double',
                'full_url' => 'anker/anker-double',
                'title' => 'Анкер двухраспорный',
                'nav_title' => 'Анкер двухраспорный',
                'img' => 'anker/anker_2rasp.png',
                'text' => '2-х распорный анкерный болт с гайкой для крепления тяжеловесных конструкций к плотным материалам',
                'description' => '2-х распорный анкерный болт с гайкой для крепления тяжеловесных конструкций к плотным материалам',
                'standard' => '',
                'additionally' => 'бетон, кирпич',
                'breadcrumbs' => json_encode([['title' => 'Анкеры','url' => 'anker']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 1,
                'url' => 'anker-g',
                'full_url' => 'anker/anker-g',
                'title' => 'Анкерный болт с Г-крюком',
                'nav_title' => 'Анкерный болт с Г-крюком',
                'img' => 'anker/anker_gkruk.png',
                'text' => 'Анкерный болт с Г-крюком для для крепления подвесных, тяжеловесных конструкций к плотным материалам',
                'description' => 'Анкерный болт с Г-крюком для для крепления подвесных, тяжеловесных конструкций к плотным материалам',
                'standard' => '',
                'additionally' => 'бетон, кирпич',
                'breadcrumbs' => json_encode([['title' => 'Анкеры','url' => 'anker']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 1,
                'url' => 'anker-s',
                'full_url' => 'anker/anker-s',
                'title' => 'Анкерный болт с С-крюком',
                'nav_title' => 'Анкерный болт с С-крюком',
                'img' => 'anker/anker_kruk.png',
                'text' => 'Анкерный болт с С-крюком для для крепления подвесных, тяжеловесных конструкций к плотным материалам',
                'description' => 'Анкерный болт с С-крюком для для крепления подвесных, тяжеловесных конструкций к плотным материалам',
                'standard' => '',
                'additionally' => 'бетон, кирпич',
                'breadcrumbs' => json_encode([['title' => 'Анкеры','url' => 'anker']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 1,
                'url' => 'anker-o',
                'full_url' => 'anker/anker-o',
                'title' => 'Анкерный болт с кольцом',
                'nav_title' => 'Анкерный болт с кольцом',
                'img' => 'anker/anker_kolso.png',
                'text' => 'Анкерный болт с кольцом для для крепления подвесных, тяжеловесных конструкций к плотным материалам',
                'description' => 'Анкерный болт с кольцом для для крепления подвесных, тяжеловесных конструкций к плотным материалам',
                'standard' => '',
                'additionally' => 'бетон, кирпич',
                'breadcrumbs' => json_encode([['title' => 'Анкеры','url' => 'anker']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 1,
                'url' => 'anker-wam',
                'full_url' => 'anker/anker-wam',
                'title' => 'Клиновой анкер',
                'nav_title' => 'Клиновой анкер',
                'img' => 'anker/anker_wam.png',
                'text' => 'Стальной оцинкованный клиновой анкер для тяжелых креплений в плотных строительныхматериалах. Применяется для монтажа рельс, барьеров, фасадных каркасов и конструкционных рам и т.п.',
                'description' => 'Стальной оцинкованный клиновой анкер для тяжелых креплений в плотных строительныхматериалах. Применяется для монтажа рельс, барьеров, фасадных каркасов и конструкционных рам и т.п.',
                'standard' => '',
                'additionally' => 'бетон, кирпич',
                'breadcrumbs' => json_encode([['title' => 'Анкеры','url' => 'anker']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 1,
                'url' => 'anker-man',
                'full_url' => 'anker/anker-man',
                'title' => 'Анкер-клин',
                'nav_title' => 'Анкер-клин',
                'img' => 'anker/anker_klin.png',
                'text' => 'Стальной оцинкованный быстромонтажный анкер-клин для крепления подвесных конструкций в плотных материалах',
                'description' => 'Стальной оцинкованный быстромонтажный анкер-клин для крепления подвесных конструкций в плотных материалах',
                'standard' => '',
                'additionally' => 'бетон',
                'breadcrumbs' => json_encode([['title' => 'Анкеры','url' => 'anker']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 0,
                'url' => 'bolt',
                'full_url' => 'bolt',
                'title' => 'Болты',
                'nav_title' => 'Болты',
                'img' => 'bolt/bolt_6gr_zink_prez.png',
                'text' => 'Болты шестигранные и мебельные',
                'description' => 'Болты шестигранные и мебельные',
                'standard' => '',
                'additionally' => '',
                'breadcrumbs' => json_encode([]),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 10,
                'url' => 'hex',
                'full_url' => 'bolt/hex',
                'title' => 'Болты с шестигранной головкой',
                'nav_title' => 'Болты с шестигранной головкой',
                'img' => 'bolt/bolt_6gr.png',
                'text' => 'Болты стальные с шестигранной головкой и метрической резьбой. Без покрытия.',
                'description' => 'Болты стальные с шестигранной головкой и метрической резьбой. Без покрытия.',
                'standard' => 'ГОСТ 7798-70, ГОСТ 7805-70, DIN 931',
                'additionally' => 'Класс прочности: 5,6',
                'breadcrumbs' => json_encode([['title' => 'Болты','url' => 'bolt']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 10,
                'url' => 'furniture',
                'full_url' => 'bolt/furniture',
                'title' => 'Болт мебельный с усом',
                'nav_title' => 'Болт мебельный с усом',
                'img' => 'bolt/bolt_mebel_us_zink.png',
                'text' => 'Болт мебельный с усом, полукруглой головкой и метрической резьбой.',
                'description' => 'Болт мебельный с усом, полукруглой головкой и метрической резьбой.',
                'standard' => 'ГОСТ 7801-81, DIN 601',
                'additionally' => 'Класс прочности: 5.6',
                'breadcrumbs' => json_encode([['title' => 'Болты','url' => 'bolt']],JSON_UNESCAPED_UNICODE),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 0,
                'url' => 'vint',
                'full_url' => 'vint',
                'title' => 'Винты',
                'nav_title' => 'Винты',
                'img' => 'vint/din_7985.png',
                'text' => 'Винты',
                'description' => 'Винты',
                'standard' => '',
                'additionally' => '',
                'breadcrumbs' => json_encode([]),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 0,
                'url' => 'gayka',
                'full_url' => 'gayka',
                'title' => 'Гайки',
                'nav_title' => 'Гайки',
                'img' => 'gayka/din_934.png',
                'text' => 'Гайки',
                'description' => 'Гайки',
                'standard' => '',
                'additionally' => '',
                'breadcrumbs' => json_encode([]),
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'parent_id' => 0,
                'url' => 'gvozdi',
                'full_url' => 'gvozdi',
                'title' => 'Гвозди',
                'nav_title' => 'Гвозди',
                'img' => 'gvozdi/gvozd_stroy.png',
                'text' => 'Гвозди',
                'description' => 'Гвозди',
                'standard' => '',
                'additionally' => '',
                'breadcrumbs' => json_encode([]),
                'created_at' => $date,
                'updated_at' => $date
            ],
        ]);
    }
}
