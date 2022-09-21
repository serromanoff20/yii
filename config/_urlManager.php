<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'suffix' => '',
    'rules' => [
        ['pattern' => '', 'route' => 'site/index'],

        ['pattern' => 'job/<action:[\w\-]+>', 'route' => 'job/<action>'],
        ['pattern' => 'site/<action:[\w\-]+>', 'route' => 'site/<action>'],
    ]
];