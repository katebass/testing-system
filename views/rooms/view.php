<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rooms */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rooms-view">

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
        <?= Html::a('Start testing', ['testing', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'questions_pack_id',
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
        ],
    ]) ?>

</div>
