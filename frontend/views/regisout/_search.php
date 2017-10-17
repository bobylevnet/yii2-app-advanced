<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Regisout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regisout-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idRout') ?>

    <?= $form->field($model, 'idOrg') ?>

    <?= $form->field($model, 'idTypDocum') ?>

    <?= $form->field($model, 'idTypeMat') ?>

    <?= $form->field($model, 'aboutDoc') ?>

    <?php // echo $form->field($model, 'dateDoc') ?>

    <?php // echo $form->field($model, 'numberDoc') ?>

    <?php // echo $form->field($model, 'yearDoc') ?>

    <?php // echo $form->field($model, 'idUserRun') ?>


    <?php // echo $form->field($model, 'senderType') ?>

    <?php // echo $form->field($model, 'senderDate') ?>

    <?php // echo $form->field($model, 'returnDate') ?>

    <?php // echo $form->field($model, 'listNumber') ?>

    <?php // echo $form->field($model, 'countList') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
