<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReguserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regisin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idRin') ?>

    <?= $form->field($model, 'idOrg') ?>

    <?= $form->field($model, 'idTypDocum') ?>

    <?= $form->field($model, 'idTypeMat') ?>

    <?= $form->field($model, 'aboutDoc') ?>

    <?php // echo $form->field($model, 'dateDoc') ?>

    <?php // echo $form->field($model, 'yearDoc') ?>

    <?php // echo $form->field($model, 'idUserRun') ?>

    <?php // echo $form->field($model, 'idUserOrg') ?>

    <?php // echo $form->field($model, 'listNumber') ?>

    <?php // echo $form->field($model, 'countList') ?>

    <?php // echo $form->field($model, 'dateIn') ?>

    <?php // echo $form->field($model, 'numberIn') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
