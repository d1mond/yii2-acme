<?php

use yii\base\HttpException;
use common\models\Post;
use common\models\User;
use backend\components\Controller;

/**
 *
 */
class UserController extends Controller
{
	/**
	 * @var Post[]
	 */
	public $posts = array();

	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if ('create' == $action->id || 'update' == $action->id) {
			$this->posts = Post::find()->listData();
		}
		if ('delete' == $action->id && !Yii::$app->getRequest()->getIsDeleteRequest()) {
			throw new HttpException(403, Yii::t('app|User can be deleted only through DELETE request.'));
		}

		return true;
	}

	/**
	 *
	 */
	public function actionIndex()
	{
		$users = User::find()->with('posts')->all();

		echo $this->render('index', array(
			'users' => $users,
		));
	}

	/**
	 *
	 */
	public function actionCreate()
	{
		$user = new User(array('scenario' => 'backendCreate'));

		if ($this->populate($_POST, $user) && $user->save()) {
			Yii::$app->getSession()->setFlash('successAlert', $user->getAttribute('username') . ' user has been created!');
			Yii::$app->getResponse()->redirect(array('index'));
		}

		echo $this->render('create', array(
			'user' => $user,
		));
	}

	/**
	 * @param integer $id
	 * @throws HttpException
	 */
	public function actionUpdate($id)
	{
		$user = User::find()->oneById($id, array('scenario' => 'backendUpdate'));
		if (null === $user) {
			throw new HttpException(404, Yii::t('acme|Requested user does not exist.'));
		}

		if ($this->populate($_POST, $user) && $user->save()) {
			Yii::$app->getSession()->setFlash('successAlert', $user->getAttribute('username') . ' user has been updated!');
			Yii::$app->getResponse()->redirect(array('index'));
		}

		echo $this->render('update', array(
			'user' => $user,
		));
	}

	/**
	 * @param integer $id
	 * @throws HttpException
	 */
	public function actionDelete($id)
	{
		$user = User::find()->oneById($id);
		if (null === $user) {
			throw new HttpException(404, Yii::t('acme|Requested user does not exist.'));
		}

		if (!$user->delete()) {
			throw new HttpException(404, Yii::t('acme|Cannot delete user.'));
		}

		Yii::$app->getResponse()->redirect(array('index'));
	}
}
