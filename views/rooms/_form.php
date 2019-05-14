<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
