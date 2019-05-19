<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii2mod\editable\EditableColumn;

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

        <?php
            if (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'manager') { ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::dropDownList('cat', $model->state,
                        ['New' => 'New', 'Open' => 'Open', 'Finished' => 'Finished'],
                        ['class' => 'state-dropdown btn btn-primary', 'roomId' => $model->id]); ?>
        <?php } ?>


        <?php if (array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'candidate') {
                if ($model->state == 'Open') { ?>
                    <?php Yii::$app->session->setFlash('success', "The testing is open! Please, press the button 'Start testing'."); ?>
                    <?= Html::a('Start testing', ['testing', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
                <?php } else if ($model->state == 'Closed') {
                    Yii::$app->session->setFlash('warning', "Testing is finished. Go to 'Overall Results' to see your success");
                } else {
                    Yii::$app->session->setFlash('warning', "Please wait for the testing start");
                }
            }
        ?>

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
