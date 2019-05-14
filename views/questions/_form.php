<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Questions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($model, 'questionsTags')->widget(MultipleInput::className(), [
            'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
            'min' => 0,
            'columns' => [
                [
                    'name'  => 'tag_id',
                    'type'  => 'dropDownList',
                    'title' => 'Tags',
                    'items' => [
                        'prompt' => 'Please, choose a tag',
                        ArrayHelper::map(app\models\Tags::find()->all(), 'id', 'name')
                    ]
                ]
            ]
        ])
        ->label(false);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'time_to_answer')->textInput() ?>

    <?= $form->field($model, 'time_to_answer')
        ->widget(\janisto\timepicker\TimePicker::className(), [
            'mode' => 'time',
            'clientOptions' => [
                'timeFormat' => 'mm:ss',
            ]
        ])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>