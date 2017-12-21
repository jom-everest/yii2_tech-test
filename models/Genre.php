<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "genre".
 *
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['genre'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'genre' => 'Genre',
        ];
    }

	public function getGenresList()
	{
		$genresObj = Genre::find()->all();
		return ArrayHelper::map($genresObj, 'name', 'name');
	}

}
