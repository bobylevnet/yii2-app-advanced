<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\regisin */

$this->title = 'Update Regisin: ' . $model->idRin;
$this->params['breadcrumbs'][] = ['label' => 'Regisins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRin, 'url' => ['view', 'id' => $model->idRin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="regisin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
