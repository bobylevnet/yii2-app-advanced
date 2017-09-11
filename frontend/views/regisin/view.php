<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\regisin */

$this->title = $model->idRin;
$this->params['breadcrumbs'][] = ['label' => 'Regisins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regisin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idRin], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idRin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idRin',
            'idOrg',
            'idTypDocum',
            'idTypeMat',
            'aboutDoc',
            'dateDoc',
            'yearDoc',
            'idUserRun',
            'idUserOrg',
            'listNumber',
            'countList',
            'dateIn',
            'numberIn',
        ],
    ]) ?>

</div>
