<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;

/**
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property User $author
 * @property User $createdBy
 * @property User $updatedBy
 *
 * @property string $url
 */
class Post extends ActiveRecord
{
	/**
	 * @return User
	 */
	public function getAuthor()
	{
		return $this->hasOne('User', array('id' => 'author_id'));
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

	public static function createQuery()
	{
		return new PostQuery(array(
			'modelClass' => 'common\models\Post',
		));
	}

	public function scenarios()
	{
		return array(
			'backendCreate' => array('title', 'text', 'author_id'),
			'backendUpdate' => array('title', 'text', 'author_id'),
			'userCreate' => array('title', 'text'),
		);
	}

	public function rules()
	{
		return array(
			array('title', 'required', 'on' => array('backendCreate', 'backendUpdate')),
			array('title', 'string', 'min' => 5, 'max' => 50, 'on' => array('backendCreate', 'backendUpdate')),
			array('title', 'unique', 'on' => array('backendCreate', 'backendUpdate')),

			array('text', 'required', 'on' => array('backendCreate', 'backendUpdate')),
			array('text', 'string', 'min' => 20, 'max' => 20000, 'on' => array('backendCreate', 'backendUpdate')),

			array('author_id', 'required', 'on' => array('backendCreate', 'backendUpdate')),
			array('author_id', 'integer', 'on' => array('backendCreate', 'backendUpdate')),
			array('author_id', 'exist', 'className' => 'common\models\User', 'attributeName' => 'id',
				'on' => array('backendCreate', 'backendUpdate')),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'Identifier',
			'title' => 'Post title',
			'slug' => 'Slug',
			'text' => 'Post text',
			'created_at' => 'Created at',
			'created_by' => 'Created by',
			'updated_at' => 'Last updated at',
			'updated_by' => 'Last updated by',
			'author_id' => 'Author',
		);
	}

	public function behaviors()
	{
		return array(
			'timestamp' => array(
				'class' => 'common\components\TimestampBehavior',
			),
		);
	}

	public function formName()
	{
		return 'post-' . StringHelper::camel2id($this->scenario) . '-form';
	}

	public function beforeSave($insert)
	{
		if (!parent::beforeSave($insert)) {
			return false;
		}

		if ($this->isAttributeSafe('title')) {
			$this->slug = preg_replace('/\s{2,}/', '', $this->title);
			$this->slug = preg_replace('/\s/', '-', $this->slug);
			$this->slug = preg_replace('/[^A-Za-z0-9-]/iu', '', $this->slug);
			$this->slug = trim(strtolower($this->slug), '-');
		}

		return true;
	}

	/**
	 * @var string
	 */
	private $_url;

	/**
	 * @return string
	 */
	public function getUrl()
	{
		if ($this->_url === null) {
			$this->_url = Yii::$app->getUrlManager()->createAbsoluteUrl('post/view',
				array('context' => 'frontend', 'id' => $this->getAttribute('id'), 'slug' => $this->getAttribute('slug')));
		}
		return $this->_url;
	}

	public static function tableName()
	{
		return '{{%post}}';
	}
}
