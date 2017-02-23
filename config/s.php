<?php

return [
    'default_img_category' => 'no_image.png',
    'default_img_product' => 'no_image.jpg',
    'default_img_product_400' => 'no_image_400.jpg',
    'images_path' => 'catalog',
    'img_width_category' => 150,
    'img_height_category' => 100,
    'status_order' => [
        'icon' => [
            0 => '<i class="uk-icon-spinner uk-icon-spin uk-text-warning"></i>',
            1 => '<i class="uk-icon-upload uk-text-success"></i>',
            2 => '<i class="uk-icon-ban uk-text-danger"></i>'
        ],
        'word' => [
            0 => 'Ожидает выгрузки',
            1 => 'Выгружен в 1С',
            2 => 'Отклонен'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Конфигурация доступа для обмена с 1С
    |--------------------------------------------------------------------------
    */
    '1c' => [
        'login' => env('1C_LOGIN'),
        'password' => env('1C_PASSWORD'),
    ]

];
