<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoomsCandidates */

$this->title = 'Update Rooms Candidates: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rooms Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rooms-candidates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
