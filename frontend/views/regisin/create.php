<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\regisin */

$this->title = 'Create Regisin';
$this->params['breadcrumbs'][] = ['label' => 'Regisins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regisin-create">

  
    
	<?= $this->render('@app/views/findOrg')?>
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
