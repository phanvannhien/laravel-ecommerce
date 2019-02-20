<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "Land linking, Kết nối nhà đất của bạn", // set false to total remove
            'description'  => 'Đăng tin, rao bán cho thuê nhà đất miễn phí', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => 'g7xyiqqKrBlw-YJLuZQveznTkLnz_rd96FCXa0B0IfI',
            'bing'      => '5704D520D8E838ABF38F6AF2FCB4478F',
            'alexa'     => null,
            'pinterest' => '45da1e1a6b764206d5cef33310780326',
            'yandex'    => '23f6697bc0c865e6',
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Land linking, Kết nối nhà đất của bạn', // set false to total remove
            'description' => 'Đăng tin, rao bán cho thuê nhà đất miễn phí', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          'card'        => 'summary',
          'site'        => '@NhienPhanVan',
        ],
    ],
];
