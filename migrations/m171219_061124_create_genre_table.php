<?php

use yii\db\Migration;

/**
 * Handles the creation of table `genre`.
 */
class m171219_061124_create_genre_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('genre', [
			'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);
		
		$this->batchInsert('genre', ['name'], [
			['Shooter'], 
			['Strategy'],
			['RPG'],
			['Adventure'],
			['Horror'],
			['Logic'],
			['Mobile'],
			['Simulaion']
		]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('genre');
    }
}
