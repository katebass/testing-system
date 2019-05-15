<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rooms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'questions_pack_id')
        ->dropDownList(
            ArrayHelper::map(app\models\QuestionsPacks::find()->all(), 'id', 'name'),
            ['prompt'=>'please, choose'])
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>



    <?php echo $form->field($model, 'start_datetime')->widget(
        'trntv\yii\datetime\DateTimeWidget',
        [
            'phpDatetimeFormat' => 'dd.MM.yyyy, HH:mm:ss',
            'clientOptions' => [
                'allowInputToggle' => false,
                'sideBySide' => true,
                'widgetPositioning' => [
                    'horizontal' => 'auto',
                    'vertical' => 'auto'
                ]
            ]
        ]
    );
    ?>

    <?php echo $form->field($model, 'end_datetime')->widget(
        'trntv\yii\datetime\DateTimeWidget',
        [
            'phpDatetimeFormat' => 'dd.MM.yyyy, HH:mm:ss',
            'clientOptions' => [
                'allowInputToggle' => false,
                'sideBySide' => true,
                'widgetPositioning' => [
                    'horizontal' => 'auto',
                    'vertical' => 'auto'
                ]
            ]
        ]
    );
    ?>

    <?php
    echo $form->field($model, 'roomsCandidates')->widget(MultipleInput::className(), [
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'min' => 2,
        'max' => 2,
        'columns' => [
            [
                'name'  => 'candidate_id',
                'type'  => 'dropDownList',
                'title' => 'Candidates Emails',
                'items' => [
                    'prompt' => 'Please, choose a user',
                    ArrayHelper::map(app\models\User::find()->all(), 'id', 'email')
                ]
            ]
        ]
    ])
        ->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
