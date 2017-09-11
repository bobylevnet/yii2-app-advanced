<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\reguser */

$this->title = 'Update Reguser: ' . $model->idUser;
$this->params['breadcrumbs'][] = ['label' => 'Regusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idUser, 'url' => ['view', 'id' => $model->idUser]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reguser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
