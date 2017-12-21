<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Genre;
use kartik\field\FieldRange;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Games';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Game', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

/*			
			[
				'attribute' => 'id',
				'headerOptions' => ['width' => '80'],
			],
*/			
			[
				'attribute'=>'name',
			],
			
	        [
				'attribute' => 'year',
			],
 
			[
				'attribute' => 'genre',
				'filter' => Genre::getGenresList(),
			],
			
			[
				'attribute' => 'rating',
				'headerOptions' => ['width' => '300'],
/*			    'filter' => FieldRange::widget([
					'model' => $searchModel,
					'name1' => '1',
					'name2'=>'valueTo',
					'separator' => 'to',
					'type' => FieldRange::INPUT_SPIN,
					'widgetOptions1' => [
						'pluginOptions' => [
							'initval' => 5,
							'min' => 0,
							'max' => 10,
							'step' => 0.1,
							'decimals' => 1,
							'verticalbuttons' => true,
						]
					],
				]),
*/
			],
			
            [
			    'filter' => "",
				'attribute' => 'image_path',
				'enableSorting' => false,
				'format' => 'raw',
				'value' => function($data){
					return Html::img(($data->image_path),[
						'style' => 'width:180px;'
					]);
				},
			],
			
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {delete}',
/*				'buttons' => [
					'update' => function ($url,$model) {
						return Html::a(
							'<span class="glyphicon glyphicon-screenshot"></span>', 
							$url);
					},
					'link' => function ($url,$model,$key) {
						return Html::a('Действие', $url);
					},
				],
*/
			],
        ],
    ]); ?>
</div>
