<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Genre;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'genre')->dropDownList(Genre::getGenresList()) ?>
	
    <?= $form->field($model, 'rating')->textInput() ?>

	<?php
		if(isset($model->image_path) && file_exists(Yii::getAlias('@webroot', $model->image_path)))
		{ 
			echo Html::img($model->image_path, ['class'=>'img-responsive']);
//			echo $form->field($model,'isDeleteImage')->checkBox(['class'=>'span-1']);
		}
	?>
	<?php
		echo $form->field($model, 'image')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],]);
	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
