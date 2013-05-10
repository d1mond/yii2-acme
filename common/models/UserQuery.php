<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use common\components\DbTableCacheDependency;

/**
 *
 */
class UserQuery extends ActiveQuery
{
	/**
	 * @param integer $userId
	 * @param array $config
	 * @return User
	 */
	public function oneById($userId, $config = array())
	{
		$cacheKey = "UserQuery.oneById.{$userId}";
		$user = Yii::$app->getCache()->get($cacheKey);
		if (false === $user) {
			$user = $this->where(array('id' => $userId))->one();

			if (null !== $user) {
				foreach ($config as $attribute => $value) {
					$user->$attribute = $value;
				}
			}

			$tableName = call_user_func(array($this->modelClass, 'tableName'));
			Yii::$app->getCache()->set($cacheKey, $user, 3600, new DbTableCacheDependency($tableName));
		}
		return $user;
	}

	/**
	 * @return array
	 */
	public function listData()
	{
		$cacheKey = 'UserQuery.listData';
		$listData = Yii::$app->getCache()->get($cacheKey);
		if (false === $listData) {
			$users = $this->select('id, username')->asArray()->all();
			$listData = array();
			foreach ($users as $user) {
				$listData[$user['id']] = $user['username'];
			}

			$tableName = call_user_func(array($this->modelClass, 'tableName'));
			Yii::$app->getCache()->set($cacheKey, $listData, 3600, new DbTableCacheDependency($tableName));
		}
		return $listData;
	}
}
