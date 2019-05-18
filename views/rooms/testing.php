<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rooms */

$this->title = 'Testing in running... :)';
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

\yii\web\YiiAsset::register($this);

?>
<div class="rooms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <h3>Question: <strong><?= $currentQuestion->question ?></strong></h3>

    <div class="testing-answers">
        <?php foreach ($currentQuestion->answers as $answer) { ?>
            <?=
                    $form->field($answer, 'answer')
                     ->checkbox(['label' => null, 'group-name' => 'is-right-checkbox'])
                     ->label(ucfirst($answer->answer))
            ?>
        <?php } ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Answer', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
