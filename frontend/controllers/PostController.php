<?php

class PostController extends \yii\web\Controller
{
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if (Yii::$app->getUser()->getIsGuest() && $action == 'create') {
			throw new \yii\base\HttpException(403);
		}

		return true;
	}

	public function actionCreate()
	{
		$post = new \common\models\Post(array('scenario' => 'userCreate'));

		if ($this->populate($_POST, $post) && $post->save()) {
			Yii::$app->getResponse()->redirect(array('site/index'));
		}

		echo $this->render('create', array(
			'post' => $post,
		));
	}
}
