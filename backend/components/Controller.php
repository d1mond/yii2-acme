<?php

namespace backend\components;

use Yii;
use yii\web\Controller as BaseController;

/**
 *
 */
class Controller extends BaseController
{
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if ('login' !== $action->id && Yii::$app->getUser()->getIsGuest()) {
			Yii::$app->getResponse()->redirect(array('site/login'));
		}

		return true;
	}
}
