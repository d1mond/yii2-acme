<?php

namespace common\components;

use \yii\base\Behavior;
use \yii\base\ModelEvent;
use \yii\db\ActiveRecord;
use \yii\db\Expression;

/**
 *
 */
class TimestampBehavior extends Behavior
{
	/**
	 * @var string
	 */
	public $createAttribute = 'created_at';

	/**
	 * @var string
	 */
	public $updateAttribute = 'updated_at';

	/**
	 * @var boolean
	 */
	public $setUpdateOnCreate = true;

	/**
	 * @var string
	 */
	public $timestampExpression;

	/**
	 * @var array
	 */
	public static $typeMap = array(
		'datetime' => 'NOW()',
		'timestamp' => 'NOW()',
		'date' => 'NOW()',
	);

	public function events()
	{
		return array(
			ActiveRecord::EVENT_BEFORE_INSERT => 'onInsert',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'onUpdate',
		);
	}

	/**
	 * @param ModelEvent $event
	 */
	public function onInsert($event)
	{
		if ($this->createAttribute !== null) {
			$this->owner->{$this->createAttribute} = $this->getTimestampByAttribute($this->createAttribute);
		}
		if ($this->updateAttribute !== null && $this->setUpdateOnCreate) {
			$this->owner->{$this->updateAttribute} = $this->getTimestampByAttribute($this->updateAttribute);
		}
	}

	/**
	 * @param ModelEvent $event
	 */
	public function onUpdate($event)
	{
		if ($this->updateAttribute !== null) {
			$this->owner->{$this->updateAttribute} = $this->getTimestampByAttribute($this->updateAttribute);
		}
	}

	/**
	 * @param string $attribute
	 * @return integer|Expression
	 */
	protected function getTimestampByAttribute($attribute)
	{
		if ($this->timestampExpression instanceof Expression) {
			return $this->timestampExpression;
		} elseif ($this->timestampExpression !== null) {
			return eval('return ' . $this->timestampExpression . ';');
		}

		$type = $this->owner->getTableSchema()->getColumn($attribute)->type;
		return $this->getTimestampByType($type);
	}

	/**
	 * @param string $type
	 * @return integer|Expression
	 */
	protected function getTimestampByType($type)
	{
		if (isset(static::$typeMap[$type])) {
			return new Expression(static::$typeMap[$type]);
		} else {
			return time();
		}
	}
}
