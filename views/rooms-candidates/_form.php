<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RoomsCandidates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-candidates-form">

    <?php $form = ActiveForm::begin(); ?>

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
        ],
    ]) ?>

    <?= $form->field($model, 'conclusion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
