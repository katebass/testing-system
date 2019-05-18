<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rooms', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'questions_pack_id',
                'value' => function ($model) {
                    $Pack = \app\models\QuestionsPacks::find()
                        ->where(['id' => $model->questions_pack_id])->one();
                    return $Pack['name'];
                },
            ],
            'name',
            [
                'attribute' => 'start_datetime',
                'value' => function ($model) {
                    return $model->start_datetime ? $model->start_datetime : 'Not started';
                },
            ],
            [
                'attribute' => 'end_datetime',
                'value' => function ($model) {
                    return $model->end_datetime ? $model->end_datetime : 'Not ended';
                },
            ],
            'state',
            'points',
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{openRoom}',
            'buttons' => [
                'openRoom' => function($url, $model) {     // render your custom button
                    return Html::a('Open Room', ['/rooms/view?id=' . $model->id], ['class'=>'btn btn-primary']);
                }
            ]
        ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}'],
        ],
    ]); ?>


</div>
