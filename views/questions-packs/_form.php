<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionsPacks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-packs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'questionsPacksQuestions')->widget(MultipleInput::className(), [
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'min' => 1,
        'columns' => [
            [
                'name'  => 'question_id',
                'type'  => 'dropDownList',
                'title' => 'Questions',
                'items' => [
                    'prompt' => 'Please, choose a question',
                    ArrayHelper::map(app\models\Questions::find()->all(), 'id', 'name')
                ],
                'options' => ['required' => true]
            ]
        ]
    ])
        ->label(false);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
