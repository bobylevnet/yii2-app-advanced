<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\regisout */

$this->title = 'Update Regisout: ' . $model->idRout;
$this->params['breadcrumbs'][] = ['label' => 'Regisouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRout, 'url' => ['view', 'id' => $model->idRout]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="regisout-update">

  	<?= $this->render('@app/views/findOrg')?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
