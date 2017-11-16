<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
      'mail' => [
           'class' => 'yii\swiftmailer\Mailer',
           'viewPath' => '@common/mail',

            ],
        'authManager' => [
              'class' => 'yii\rbac\DbManager',
          ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
