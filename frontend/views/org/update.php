<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Org */

$this->title = 'Update Org: ' . $model->idOrg;
$this->params['breadcrumbs'][] = ['label' => 'Orgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idOrg, 'url' => ['view', 'id' => $model->idOrg]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="org-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
