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

    <form action="testing?id=<?= $model->id ?>" method="POST">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <input type="hidden" name="questionId" value="<?= $currentQuestion->id ?>" />
    <h3>Question: <strong><?= $currentQuestion->question ?></strong></h3>

    <ul class="list-group">
        <?php foreach ($currentQuestion->answers as $answer) { ?>
            <div class="list-group-item">
                <input
                    type="checkbox"
                    group-name="is-right-checkbox"
                    name="answer_<?= $answer->id ?>"
                    value="<?= $answer->id ?>">
                <label class="control-label" for="answer_<?= $answer->id ?>"><?= ucfirst($answer->answer) ?></label>
            </div>
        <?php } ?>
    </ul>


    <div class="form-group">
        <input type="submit" class='btn btn-success' value="Answer">
    </div>

   </form>

</div>
