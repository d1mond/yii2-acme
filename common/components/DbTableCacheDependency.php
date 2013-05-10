<?php

namespace common\components;

use yii\caching\ChainedDependency;
use yii\caching\DbDependency;

/**
 *
 */
class DbTableCacheDependency extends ChainedDependency
{
	/**
	 * @param array $tableName
	 * @param array $config
	 */
	public function __construct($tableName, $config = array())
	{
		$this->dependencies = array(
			new DbDependency('SELECT MAX(updated_at) FROM ' . $tableName),
			new DbDependency('SELECT COUNT(*) FROM ' . $tableName),
		);

		parent::__construct($config);
	}
}
