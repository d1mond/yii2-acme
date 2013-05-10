<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use common\components\DbTableCacheDependency;

/**
 *
 */
class PostQuery extends ActiveQuery
{
	/**
	 * @param integer $postId
	 * @param array $config
	 * @return Post
	 */
	public function oneById($postId, $config = array())
	{
		$cacheKey = "PostQuery.oneById.{$postId}";
		$post = Yii::$app->getCache()->get($cacheKey);
		if (false === $post) {
			$post = $this->where(array('id' => $postId))->one();

			if (null !== $post) {
				foreach ($config as $attribute => $value) {
					$post->$attribute = $value;
				}
			}

			$tableName = call_user_func(array($this->modelClass, 'tableName'));
			Yii::$app->getCache()->set($cacheKey, $post, 3600, new DbTableCacheDependency($tableName));
		}
		return $post;
	}

	/**
	 * @return array
	 */
	public function listData()
	{
		$cacheKey = 'PostQuery.listData';
		$listData = Yii::$app->getCache()->get($cacheKey);
		if (false === $listData) {
			$posts = $this->select('id, title')->asArray()->all();
			$listData = array();
			foreach ($posts as $post) {
				$listData[$post['id']] = $post['title'];
			}

			$tableName = call_user_func(array($this->modelClass, 'tableName'));
			Yii::$app->getCache()->set($cacheKey, $listData, 3600, new DbTableCacheDependency($tableName));
		}
		return $listData;
	}
}
