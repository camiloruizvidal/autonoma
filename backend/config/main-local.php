<?php

$config = [
    'components' => [
    //   'view' => [
    //   'theme' => [
    //     'pathMap' => array('@app/views' => '@app/themes/themes1'),
    //     'baseUrl'   => '@web/../themes/themes1'
    //   ],
    // ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qOfs12FQZcjWjz7Q_iwZVV4AECHUFvTI',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
