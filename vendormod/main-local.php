<?php
return [
    'timeZone' => 'America/Guayaquil',
    'components' => [
        /* 'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=186.71.30.34;dbname=dbyii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ], */
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbbagsacorp',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],*/
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',           
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
             'class' => 'Swift_SmtpTransport',
             /*'host' => 'smtp.gmail.com',
             'username' => 'acepsistemas@gmail.com',
             'password' => 'tecnologia1990',*/
             'host' => 'smtp.office365.com',
             'username' => 'cpn_paginaweb@cpn.fin.ec',
             'password' => 'Paginaweb2019$$',
             'port' => '587',
             'encryption' => 'tls',
             'streamOptions' => [ 
                'ssl' => [ 
                    'allow_self_signed' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ]
            ],
        ],
    ],
];
