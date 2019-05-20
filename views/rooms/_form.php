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

    <?php
    echo $form->field($model, 'roomsCandidates')->widget(MultipleInput::className(), [
        'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'min' => 1,
        'columns' => [
            [
                'name'  => 'candidate_id',
                'type'  => 'dropDownList',
                'title' => 'Candidates Emails',
                'items' =>  ArrayHelper::map(app\models\User::find()
                                ->where(['in', 'id', Yii::$app->authManager->getUserIdsByRole('candidate')])
                                ->all(), 'id', 'email'),
                'options' => ['prompt' => 'Please, choose a user email', 'required' => true]
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
