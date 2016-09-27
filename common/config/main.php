<?php
$params = array_merge(
    require(__DIR__ . '/sphinxServer.php')
);

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=zhuabook3',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
		'mongodb' => [
			'class' => '\yii\mongodb\Connection',
			'dsn' => 'mongodb://yihangbook:yihangbook@120.76.123.86:27017/zhuabook',
		],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ]
    ],
	'params' => $params,
];

