<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];


// 配置文件包含3个部分
// 基本信息配置，主要指如id,basePath等这些应用的基本信息，主要是一些简单的字符串
// components配置，配置文件的主体
// params配置，主要是提供一些全局参数
//[
//    'class' => 'path\to\ClassName',
//    'propertyName' => 'propertyValue',
//    'on eventName' => $eventHandler,
//    'as behaviorName' => $behaviorConfig,
//]
// 配置项以数组进行组织
// class数组元素表示将要创建的对象的完整类名
// propertyName 数组元素表示指定为propertyName属性的初始值为$propertyValue
// on eventName 数组元素表示将$eventHandler绑定到对象的eventName事件中
// as behaviorName 数组元素表示用