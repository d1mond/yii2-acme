<?php

namespace common\components;

use Yii;
use yii\web\UrlManager as BaseUrlManager;

/**
 *
 */
class UrlManager extends BaseUrlManager
{
	public function createUrl($route, $params = array())
	{
		if (!isset($params['context'])) {
			$params['context'] = Yii::$app->params['activeApplication'];
		}
		return parent::createUrl($route, $params);
	}

	public function createAbsoluteUrl($route, $params = array())
	{
		if (isset($params['context'])) {
			$httpHost = $_SERVER['HTTP_HOST'];
			$_SERVER['HTTP_HOST'] = Yii::$app->params['domains'][$params['context']];
			$url = parent::createAbsoluteUrl($route, $params);
			$_SERVER['HTTP_HOST'] = $httpHost;
			return $url;
		} else {
			return parent::createAbsoluteUrl($route, $params);
		}
	}
}
