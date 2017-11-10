<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\regisout */

$this->title = $model->idRout;
$this->params['breadcrumbs'][] = ['label' => 'Regisouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regisout-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->idRout], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idRout], [
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
            'idRout',
            'idOrg',
            'idTypDocum',
            'idTypeMat',
            'aboutDoc',
            'dateDoc',
            'numberDoc',
            'yearDoc',
            'idUserRun',
     
         //  'senderType',
            'senderDate',
            'returnDate',
            'listNumber',
            'countList',
        ],
    ]) ?>

</div>
