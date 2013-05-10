<?php

/**
 *
 */
class MigrationController extends \yii\console\controllers\MigrateController
{
	/**
	 * @var string
	 */
	public $migrationPath = '@common/migrations';

	/**
	 * @var string
	 */
	public $migrationTable = '{{%migration}}';
}
