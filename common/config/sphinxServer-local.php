<?php
/**
 * sphinx配置文件
 */
return [
    'sphinxServer' => [
        //直营城市非聚合售房
		'bookinfo' => [
            'port' => '9895',
            'server' => '198.71.91.148',
            'indexName' => 'bookinfo'
        ],
		'booksource' => [
			'port' => '9898',
			'server' => '198.71.91.148',
			'indexName' => 'booksource'
		],
		'chapters' => [
			'port' => '9901',
			'server' => '198.71.91.148',
			'indexName' => 'chapters'
		],
    ]
];
