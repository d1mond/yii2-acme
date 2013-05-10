<?php

use yii\base\HttpException;
use common\models\Post;
use common\models\User;
use backend\components\Controller;

/**
 *
 */
class PostController extends Controller
{
	/**
	 * @var User[]
	 */
	public $users = array();

	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if ('create' == $action->id || 'update' == $action->id) {
			$this->users = User::find()->listData();
		}
		if ('delete' == $action->id && !Yii::$app->getRequest()->getIsDeleteRequest()) {
			throw new HttpException(403, Yii::t('app|Post can be deleted only through DELETE request.'));
		}

		return true;
	}

	/**
	 *
	 */
	public function actionIndex()
	{
		$posts = Post::find()->with('author')->all();

		echo $this->render('index', array(
			'posts' => $posts,
		));
	}

	/**
	 *
	 */
	public function actionCreate()
	{
		$post = new Post(array('scenario' => 'backendCreate'));

		if ($this->populate($_POST, $post) && $post->save()) {
			Yii::$app->getSession()->setFlash('successAlert', $post->getAttribute('title') . ' post has been created!');
			Yii::$app->getResponse()->redirect(array('index'));
		}

		echo $this->render('create', array(
			'post' => $post,
		));
	}

	/**
	 * @param integer $id
	 * @throws HttpException
	 */
	public function actionUpdate($id)
	{
		$post = Post::find()->oneById($id, array('scenario' => 'backendUpdate'));
		if (null === $post) {
			throw new HttpException(404, Yii::t('acme|Requested blog post does not exist.'));
		}

		if ($this->populate($_POST, $post) && $post->save()) {
			Yii::$app->getSession()->setFlash('successAlert', $post->getAttribute('title') . ' post has been updated!');
			Yii::$app->getResponse()->redirect(array('index'));
		}

		echo $this->render('update', array(
			'post' => $post,
		));
	}

	/**
	 * @param integer $id
	 * @throws HttpException
	 */
	public function actionDelete($id)
	{
		$post = Post::find()->oneById($id);
		if (null === $post) {
			throw new HttpException(404, Yii::t('acme|Requested blog post does not exist.'));
		}

		if (!$post->delete()) {
			throw new HttpException(404, Yii::t('acme|Cannot delete blog post.'));
		}

		Yii::$app->getResponse()->redirect(array('index'));
	}
}
