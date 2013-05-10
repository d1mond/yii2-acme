<?php

/**
 * Migration creates blog post table.
 */
class m130508_154654_post_table extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('{{%post}}', array(
			'id' => 'pk',
			'title' => 'string',
			'slug' => 'string',
			'text' => 'text',
			'created_at' => 'integer',
			'created_by' => 'integer',
			'updated_at' => 'integer',
			'updated_by' => 'integer',
		));
	}

	public function down()
	{
		$this->dropTable('{{%post}}');
	}
}
