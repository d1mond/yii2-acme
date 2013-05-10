<?php

use yii\web\Controller;

use common\models\User;

/**
 *
 */
class UserController extends Controller
{
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if ('logout' == $action->id && !Yii::$app->getRequest()->getIsDeleteRequest()) {
			throw new HttpException(403, Yii::t('app|Log out can be performed only through DELETE request.'));
		}

		return true;
	}

	/**
	 *
	 */
	public function actionCreate()
	{
		$user = new User(array('scenario' => 'signup'));

		if ($this->populate($_POST, $user) && $user->save()) {
			Yii::$app->getResponse()->redirect(array('site/index'));
		}

		echo $this->render('create', array(
			'user' => $user,
		));
	}

	/**
	 *
	 */
	public function actionLogin()
	{
		$user = new User(array('scenario' => 'login'));

		if ($this->populate($_POST, $user) && $user->login()) {
			Yii::$app->getResponse()->redirect(array('site/index'));
		}

		echo $this->render('login', array(
			'user' => $user,
		));
	}

	/**
	 *
	 */
	public function actionLogout()
	{
		Yii::$app->getUser()->logout();
		Yii::$app->getResponse()->redirect(array('site/index'));
	}
}
