<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes}}`.
 */
class m210703_082009_create_notes_table extends Migration{

	/**
	 * {@inheritdoc}
	 */
	public function safeUp(){
		$this->createTable('{{%notes}}', [
			'id'         => $this->primaryKey(),
			'title'      => $this->string(1024),
			'body'       => $this->text(),
			'created_at' => $this->integer(11),
			'created_by' => $this->integer(11),
			'updated_at' => $this->integer(11),
		]);

		$this->createIndex(
			'{{%idx-notes-created_by}}',
			'{{%notes}}',
			'created_by'
		);
		$this->addForeignKey(
			'{{%fk-notes-created_by}}',
			'{{%notes}}',
			'created_by',
			'{{%users}}',
			'id',
			'CASCADE'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown(){
		// drops foreign key for table `{{%users}}`
		$this->dropForeignKey(
			'{{%fk-notes-created_by}}',
			'{{%notes}}'
		);

		// drops index for column `created_by`
		$this->dropIndex(
			'{{%idx-notes-created_by}}',
			'{{%notes}}'
		);

		$this->dropTable('{{%notes}}');

	}
}
