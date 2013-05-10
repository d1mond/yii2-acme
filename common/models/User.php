<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Identity;
use yii\helpers\SecurityHelper;
use yii\helpers\StringHelper;

/**
 * @property integer $id
 * @property string $username
 * @property string $password_digest
 * @property string $email
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 *
 * @property Post[] $posts
 * @property integer[] $postIds
 */
class User extends ActiveRecord implements Identity
{
	/**
	 * @var string
	 */
	public $password;

	/**
	 * @var string
	 */
	public $passwordRepeat;

	public function attributeLabels()
	{
		return array(
			'id' => 'Identifier',
			'username' => 'Username, login',
			'password_digest' => 'Password digest, hash',
			'password' => 'Password',
			'passwordRepeat' => 'Password repeat',
			'email' => 'E-mail',
			'created_at' => 'Create time',
			'created_by' => 'User first created',
			'updated_at' => 'Update time',
			'updated_by' => 'User last updated',

			'postIds' => 'Posts',
		);
	}

	public function scenarios()
	{
		return array(
			'backendCreate' => array('username', 'password', 'passwordRepeat', 'email', 'postIds'),
			'backendUpdate' => array('username', 'password', 'passwordRepeat', 'email', 'postIds'),
			'signup' => array('username', 'password', 'passwordRepeat', 'email'),
			'login' => array('username', 'password'),
		);
	}

	public function rules()
	{
		return array(
			array('username', 'required', 'on' => array('backendCreate', 'backendUpdate', 'signup', 'login')),
			array('username', 'string', 'min' => 6, 'max' => 15,
				'on' => array('backendCreate', 'backendUpdate', 'signup', 'login')),
			array('username', 'unique', 'on' => array('backendCreate', 'backendUpdate', 'signup')),
			array('username', 'exist', 'on' => array('login')),

			array('password', 'required', 'on' => array('backendCreate', 'signup', 'login')),
			array('password', 'string', 'min' => 6, 'max' => 50,
				'on' => array('backendCreate', 'backendUpdate', 'signup', 'login')),
			array('password', 'compare', 'compareAttribute' => 'passwordRepeat', 'operator' => '==',
				'on' => array('backendCreate', 'backendUpdate', 'signup')),
			array('password', 'validatePassword', 'on' => array('login')),

			array('passwordRepeat', 'required', 'on' => array('backendCreate', 'signup')),
			array('passwordRepeat', 'string', 'min' => 6, 'max' => 50,
				'on' => array('backendCreate', 'backendUpdate', 'signup')),
			array('passwordRepeat', 'compare', 'compareAttribute' => 'password', 'operator' => '==',
				'on' => array('backendCreate', 'backendUpdate', 'signup')),

			array('email', 'required', 'on' => array('backendCreate', 'backendUpdate', 'signup')),
			array('email', 'string', 'min' => 6, 'max' => 25, 'on' => array('backendCreate', 'backendUpdate', 'signup')),
			array('email', 'email', 'on' => array('backendCreate', 'backendUpdate', 'signup')),
			array('email', 'unique', 'on' => array('backendCreate', 'backendUpdate', 'signup')),
		);
	}

	public function formName()
	{
		return 'user-' . StringHelper::camel2id($this->scenario) . '-form';
	}

	public function beforeSave($insert)
	{
		if (!parent::beforeSave($insert)) {
			return false;
		}

		if ($this->isAttributeSafe('password') && !empty($this->password)) {
			$this->setAttribute('password_digest', SecurityHelper::generatePasswordHash($this->password));
		}

		return true;
	}

	public function beforeDelete()
	{
		if (!parent::beforeDelete()) {
			return false;
		}

		if ($this->username == 'tester') {
			return false;
		}

		return true;
	}

	public function afterSave($insert)
	{
		parent::afterSave($insert);

		if ($this->isAttributeSafe('postIds')) {
			foreach ($this->posts as $post) {
				$this->unlink('posts', $post);
			}
			if (is_array($this->getPostIds())) {
				foreach ($this->getPostIds() as $postId) {
					$post = Post::find()->where(array('id' => $postId))->one();
					$this->link('posts', $post);
				}
			}
		}
	}

	public static function createQuery()
	{
		return new UserQuery(array(
			'modelClass' => 'common\models\User',
		));
	}

	/**
	 * @return User
	 */
	public function getCreatedBy()
	{
		return $this->hasOne('User', array('created_by' => 'id'));
	}

	/**
	 * @return User
	 */
	public function getUpdatedBy()
	{
		return $this->hasOne('User', array('updated_by' => 'id'));
	}

	/**
	 *
	 */
	public function getPosts()
	{
		return $this->hasMany('Post', array('author_id' => 'id'));
	}

	/**
	 * @var integer[]
	 */
	private $_postIds;

	/**
	 * @return integer[]
	 */
	public function getPostIds()
	{
		if ($this->_postIds === null) {
			$this->_postIds = array();
			foreach ($this->posts as $post) {
				$this->_postIds[] = $post->id;
			}
		}
		return $this->_postIds;
	}

	/**
	 * @param integer[] $postIds
	 */
	public function setPostIds($postIds)
	{
		if ($postIds && is_array($postIds)) {
			$this->_postIds = $postIds;
		}
	}

	public function save($runValidation = true, $attributes = null)
	{
		if ($this->username == 'tester') {
			return false;
		}

		$transaction = $this->getDb()->beginTransaction();
		try {
			$result = parent::save($runValidation, $attributes);
			if ($result) {
				$transaction->commit();
			} else {
				$transaction->rollback();
			}
		} catch (\Exception $e) {
			$transaction->rollback();
			throw $e;
		}
		return $result;
	}

	public function behaviors()
	{
		return array(
			'timestamp' => array(
				'class' => 'common\components\TimestampBehavior',
			),
		);
	}

	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->getAttribute('id');
	}

	/**
	 * @return string
	 */
	public function getAuthKey()
	{
		return md5($this->getAttribute('id') . '-' . $this->getAttribute('username'));
	}

	/**
	 * @param string $authKey
	 * @return boolean
	 */
	public function validateAuthKey($authKey)
	{
		return $authKey == $this->getAuthKey();
	}

	/**
	 * @param integer $userId
	 * @return Identity
	 */
	public static function findIdentity($userId)
	{
		return self::find()->where(array('id' => $userId))->one();
	}

	/**
	 * @return boolean
	 */
	public function login()
	{
		if (!$this->validate()) {
			return false;
		}

		$user = self::find()->where(array('username' => $this->getAttribute('username')))->one();
		Yii::$app->getUser()->login($user, 0);
		Yii::$app->getSession()->set('User.id', $user->getAttribute('id'));
		Yii::$app->getSession()->set('User.username', $user->getAttribute('username'));

		return true;
	}

	/**
	 *
	 */
	public function validatePassword()
	{
		$user = self::find()->where(array('username' => $this->getAttribute('username')))->one();
		if (!$user || !SecurityHelper::validatePassword($this->password, $user->getAttribute('password_digest'))) {
			$this->addError('password', 'Incorrect username or password.');
		}
	}

	public static function tableName()
	{
		return '{{%user}}';
	}
}
