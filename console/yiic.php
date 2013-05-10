<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 10);

// fcgi doesn't have STDIN defined by default
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

require(__DIR__ . '/../common/lib/yii2/yii/Yii.php');

Yii::setAlias('@root', __DIR__ . '/../');
Yii::setAlias('@common', __DIR__ . '/../common/');
Yii::setAlias('@console', __DIR__ . '/../console/');
Yii::setAlias('@backend', __DIR__ . '/../backend/');
Yii::setAlias('@frontend', __DIR__ . '/../frontend/');

$config = \yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/../common/config/main.php'),
	require(__DIR__ . '/../common/config/main-local.php'),
	require(__DIR__ . '/config/main.php'),
	require(__DIR__ . '/config/main-local.php')
);

$params = \yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/../common/config/params.php'),
	require(__DIR__ . '/../common/config/params-local.php'),
	require(__DIR__ . '/config/params.php'),
	require(__DIR__ . '/config/params-local.php')
);

$application = new \yii\console\Application($config, array('params' => $params));
$application->run();
