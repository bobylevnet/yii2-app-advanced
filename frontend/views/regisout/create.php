<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\regisout */

$this->title = 'Create Regisout';
$this->params['breadcrumbs'][] = ['label' => 'Regisouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regisout-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
