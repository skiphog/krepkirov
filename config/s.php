<?php

return [
    'default_img_category' => 'no_image.png',
    'images_path' => 'catalog',
    'img_width_category' => 150,
    'img_height_category' => 100,

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
