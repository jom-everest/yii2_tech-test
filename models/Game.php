<?php

namespace app\models;

use Yii;
use yii\imagine\Image;
use yii\web\UploadedFile;


/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property string $name
 * @property integer $year
 * @property string $genre
 * @property double $rating
 * @property string $image_path
 */
class Game extends \yii\db\ActiveRecord
{
	public $image;
	public $isDeleteImage;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
				['name', 'year', 'rating', 'genre'], 'required', 'message' => "Поле не может быть пустым",
			],
            [['year'], 'integer', 'min' => 1970, 'max' => 2018],
            [['rating'], 'number', 'min' => 0, 'max' => 10],
            [['name', 'image_path'], 'string', 'max' => 255],
            [['name'], 'unique'],
			[['image'], 'image', 'extensions' => 'png, jpg'],
			[['isDeleteImage'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название игры',
            'year' => 'Год выпуска',
            'genre' => 'Жанр',
            'rating' => 'Рейтинг',
            'image_path' => 'Изображение',
        ];
    }
	
	public function save($runValidation = true, $attributeNames = NULL)
	{
        $image = UploadedFile::getInstance($this, 'image');
        if ($image && $image->tempName) {
            $this->image = $image;
            if ($this->validate(['image'])) {
				$dir = "images/";
				if(isset($this->image_path) && file_exists(Yii::getAlias('@webroot', $this->image_path))) {
					unlink(Yii::getAlias('@webroot' . '/' . $this->image_path));
				}
				$this->image_path = $fileName = "${dir}_{$image->baseName}.{$image->extension}";
				$this->image->saveAs($fileName);
                //$photo = Image::getImagine()->open($dir . $fileName);
				$this->image = null;
			}
			else 
				return false;
		}
		
		if ($this->validate()) {
			return parent::save();
		}
		else
			return false;
	}
	
	public function delete() {
		unlink(Yii::getAlias('@webroot' . '/' . $this->image_path));
		return parent::delete();
	}
	
	public function upload($fileName)
    {
        if ($this->validate()) {
			$name = "{$this->name}_{$this->image->baseName}";
			$ext = $this->image->extension;
            $this->image->saveAs("uploads/{$name}.{$ext}");
            return true;
        } else {
            return false;
        }
    }
}
