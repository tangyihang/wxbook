<?php
return [
    'suffix' => '.html',
    'cache_hourly_image' => md5(strtotime(date('Y-m-d H', time()) .':00:00') .'5i5jimg'),
    'cache_hourly_css' => md5(strtotime(date('Y-m-d H', time()) .':00:00') .'5i5jcss'),
    'cache_hourly_jd' => md5(strtotime(date('Y-m-d H', time()) .':00:00') .'5i5jcss'),
    
    //配置及文件中定义房源朝向
    'faceOn' => [
        0 => '朝向',
        1 => '东',
        2 => '西',
        3 => '南',
        4 => '北',
        5 => '东南',
        6 => '西南',
        7 => '东北',
        8 => '西北',
        9 => '东西',
        10 => '南北',
    ],
    //小区取暖
    'hotairConfig' => [
        1=>'自供暖',
        2=>'集中供暖',
        3=>'自供暖 集中供暖',
        4=>'分户供暖',
    ],
];
