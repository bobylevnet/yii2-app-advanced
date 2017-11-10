<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\regisin */

$this->title = 'Update Regisin: ' . $model->idRin;
$this->params['breadcrumbs'][] = ['label' => 'Regisins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRin, 'url' => ['view', 'id' => $model->idRin]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="regisin-update">


	<?= $this->render('@app/views/findOrg')?>
 

    <?= $this->render('_form', [
        'model' => $model,
    	'org'=>$org,
    	'id'=>$model['idOrg'],
    ]) ?>

</div>
