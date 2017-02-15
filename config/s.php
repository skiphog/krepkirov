<?php

return [
    'default_img_category' => 'no_image.png',
    'default_img_product' => 'no_image.jpg',
    'default_img_product_400' => 'no_image_400.jpg',
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
