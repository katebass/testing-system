<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoomsCandidates */

$this->title = 'Create Rooms Candidates';
$this->params['breadcrumbs'][] = ['label' => 'Rooms Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-candidates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
