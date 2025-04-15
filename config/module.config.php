<?php

return [

    'service_manager' => [
        'invokables' => [
            'git.toolbar' => 'icwkb\GitToolbar\Collector\GitCollector',
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'laminas-developer-tools/toolbar/git-data' => __DIR__.'/../view/laminas-developer-tools/toolbar/git-data.phtml',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

    'laminas-developer-tools' => [
        'profiler' => [
            'collectors' => [
                'git.toolbar' => 'git.toolbar',
            ],
        ],
        'toolbar' => [
            'entries' => [
                'git.toolbar' => 'laminas-developer-tools/toolbar/git-data',
            ],
        ],
    ],

];