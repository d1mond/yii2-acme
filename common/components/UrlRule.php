<?php

namespace common\components;

use Yii;
use yii\web\UrlRule as BaseUrlRule;

/**
 *
 */
class UrlRule extends BaseUrlRule
{
	/**
	 * @var string
	 */
	public $context;

	public function createUrl($manager, $route, $params)
	{
		if (!isset($params['context'])) {
			$params['context'] = Yii::$app->params['activeApplication'];
		}
		if ($this->context != 'common' && $this->context != $params['context']) {
			return false;
		}
		unset($params['context']);
		return parent::createUrl($manager, $route, $params);
	}

	public function parseRequest($manager, $request)
	{
		if ($this->context != 'common' && $this->context != Yii::$app->params['activeApplication']) {
			return false;
		}
		return parent::parseRequest($manager, $request);
	}
}
