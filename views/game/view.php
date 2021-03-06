<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\game */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
		
			[
				'attribute' => 'name',
			],

			[
				'attribute' => 'year',
			],

			[
				'attribute' => 'genre',
			],
			
			[
				'attribute' => 'rating',
			],
			
			[
				'attribute' => 'image_path',
				'format' => 'raw',
				'value' => function($data){
					return Html::img(($data->image_path), ['class'=>'img-responsive']);
				},
			],
        ],
    ]) ?>

</div>
