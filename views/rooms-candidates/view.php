<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RoomsCandidates */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rooms Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rooms-candidates-view">

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
            'id',
            [
                'attribute' => 'conclusion',
                'label' => 'Room name',
                'value' => function ($model) {
                    return $model->room->name;
                },
            ],
            'candidate_id',
            [
                'label' => 'email',
                'value' => function ($model) {
                    return $model->candidate->email;
                },
            ],
            [
                'label' => 'Candidate Name',
                'value' => function ($model) {
                    return $model->candidate->name;
                },
            ],
            'points',
            [
                'attribute' => 'conclusion',
                'value' => function ($model) {
                    return $model->conclusion ? $model->conclusion : 'Not overviewed yet';
                },
            ],
        ],
    ]) ?>

</div>
