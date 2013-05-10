<?php

return array(
	'id' => null,
	'name' => null,
	'basePath' => null,

	'components' => array(
		'db' => array(
			'class' => 'yii\db\Connection',
			'dsn' => null,
			'username' => null,
			'password' => null,
			'tablePrefix' => 'tbl_',
		),

		'cache' => array(
			'class' => 'yii\caching\DummyCache',
		),

		'user' => array(
			'class' => 'yii\web\User',
			'identityClass' => 'common\models\User',
		),

		'assetManager' => array(
			'class' => 'yii\web\AssetManager',
			'bundles' => array(
				'bootstrap' => array(
					'sourcePath' => '@common/assets/bootstrap',
					'css' => array(
						'css/bootstrap.min.css',
						'css/bootstrap-responsive.min.css',
					),
					'js' => array(
						'js/bootstrap.min.js',
					),
					'depends' => array(
						'jquery',
					),
				),
				'foundation' => array(
					'sourcePath' => '@common/assets/foundation',
					'css' => array(
						'css/normalize.css',
						'css/foundation.min.css',
					),
					'js' => array(
						'js/vendor/custom.modernizr.js',
						'js/foundation.min.js',
					),
					'depends' => array(
						'jquery',
					),
				),
			),
		),

		'urlManager' => array(
			'class' => 'common\components\UrlManager',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'ruleConfig' => array(
				'class' => 'common\components\UrlRule',
				'context' => 'common',
			),
			'rules' => array(
				// backend rules
				array('pattern' => 'users', 'route' => 'user/index', 'context' => 'backend'),
				array('pattern' => 'user/<action:(create|update|delete)>', 'route' => 'user/<action>', 'context' => 'backend'),

				array('pattern' => 'posts', 'route' => 'post/index', 'context' => 'backend'),
				array('pattern' => 'post/<action:(create|update|delete)>', 'route' => 'post/<action>', 'context' => 'backend'),

				// frontend rules
				array('pattern' => 'sign-up', 'route' => 'user/create', 'context' => 'frontend'),
				array('pattern' => 'sign-in', 'route' => 'user/login', 'context' => 'frontend'),

				array('pattern' => 'latest-posts', 'route' => 'post/index', 'context' => 'frontend'),
				array('pattern' => 'popular-posts', 'route' => 'post/best', 'context' => 'frontend'),
				array('pattern' => 'post/<id:\d+>-<slug:[\w-]+>', 'route' => 'post/view', 'context' => 'frontend'),

				// common rules
				array('pattern' => '', 'route' => 'site/index'),
				array('pattern' => '<controller:\w+>/<action:\w+>', 'route' => '<controller>/<action>'),
				array('pattern' => '<controller:\w+>', 'route' => '<controller>/index'),
			),
		),
	),
);
