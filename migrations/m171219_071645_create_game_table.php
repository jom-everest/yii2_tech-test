<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game`.
 */
class m171219_071645_create_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('game', [
            'id' => $this->primaryKey(),
			'name' => $this->string()->notNull()->unique(),
			'year' => $this->integer()->notNull(),
			'genre' => $this->string()->notNull(),
			'rating' => $this->float(1),
			'image_path' => $this->string(),
        ], $tableOptions);
		
		$this->addForeignKey(
            'fk-game-genre_id',
            'game',
            'genre',
            'genre',
            'name'
        );
		
		$this->batchInsert('game', ['name', 'year', 'genre', 'rating', 'image_path'], [
			['PLAYERUNKNOWN\'S BATTLEGROUNDS', 2017, 'Shooter', 9, 'images/_Логотип_игры_PlayerUnknown\'s_Battlegrounds.jpg'],
			['The Witcher 3: Wild Hunt', 2015, 'RPG', 9, 'images/_The_Witcher_3-_Wild_Hunt_Cover.jpg'],
			['Halo: Combat Evolved', 2001, 'Shooter', 8, 'images/_Halobox.jpg'],
			['Grand Theft Auto V ', 2011, 'Adventure', 10, 'images/_GTAV_Official_Cover_Art.jpg'],
			['Outlast', 2013, 'Horror', 7, 'images/_285618791.jpg']
		]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('game');
    }
}
