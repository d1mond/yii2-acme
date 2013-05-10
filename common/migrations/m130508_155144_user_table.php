<?php

/**
 * Migration creates user table.
 */
class m130508_155144_user_table extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('{{%user}}', array(
			'id' => 'pk',
			'username' => 'string',
			'password_digest' => 'string',
			'email' => 'string',
			'created_at' => 'integer',
			'created_by' => 'integer',
			'updated_at' => 'integer',
			'updated_by' => 'integer',
		));

		$this->createIndex('user__created_by', '{{%user}}', 'created_by');
		$this->addForeignKey('user__created_by', '{{%user}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'RESTRICT');

		$this->createIndex('user__updated_by', '{{%user}}', 'updated_by');
		$this->addForeignKey('user__updated_by', '{{%user}}', 'updated_by', '{{%user}}', 'id', 'SET NULL', 'RESTRICT');

		$this->addColumn('{{%post}}', 'author_id', 'integer');

		$this->createIndex('post__created_by', '{{%post}}', 'created_by');
		$this->addForeignKey('post__created_by', '{{%post}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'RESTRICT');

		$this->createIndex('post__updated_by', '{{%post}}', 'updated_by');
		$this->addForeignKey('post__updated_by', '{{%post}}', 'updated_by', '{{%user}}', 'id', 'SET NULL', 'RESTRICT');

		$this->createIndex('post__author_id', '{{%post}}', 'author_id');
		$this->addForeignKey('post__author_id', '{{%post}}', 'author_id', '{{%user}}', 'id', 'SET NULL', 'RESTRICT');
	}

	public function down()
	{
		$this->dropForeignKey('post__author_id', '{{%post}}');
		$this->dropIndex('post__author_id', '{{%post}}');

		$this->dropForeignKey('post__created_by', '{{%post}}');
		$this->dropIndex('post__created_by', '{{%post}}');

		$this->dropForeignKey('post__updated_by', '{{%post}}');
		$this->dropIndex('post__updated_by', '{{%post}}');

		$this->dropColumn('{{%post}}', 'author_id');

		$this->dropForeignKey('user__created_by', '{{%user}}');
		$this->dropIndex('user__created_by', '{{%user}}');

		$this->dropForeignKey('user__updated_by', '{{%user}}');
		$this->dropIndex('user__updated_by', '{{%user}}');

		$this->dropTable('{{%user}}');
	}
}
