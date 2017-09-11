<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\models\Typedoc;
use app\models\Reguser;
  

/* @var $this yii\web\View */
/* @var $model app\models\regisin */
/* @var $form yii\widgets\ActiveForm */
?>

<?php // \yii\widgets\Pjax::begin();?>



<?php \yii\widgets\Pjax::begin(['id'=>'new_row'])?>
<div class="regisin-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>


    <?= $form->field($model, 'idOrg')->hiddenInput() ?>

    <?= $form->field($model, 'idTypDocum')->dropDownList(app\models\Typedoc::getItems()) ?>

    <?= $form->field($model, 'idTypeMat')->dropDownList(app\models\Typemat::getItems())  ?>

    <?= $form->field($model, 'aboutDoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateDoc')->widget(yii\jui\DatePicker::classname(),  [
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
    ])?>

    <?php //$form->field($model, 'yearDoc')->textInput() ?>

    <?= $form->field($model, 'idUserRun')->dropDownList(app\models\UserO::getItems(1)) ?>

    <?= $form->field($model, 'idUserOrg')->dropDownList(app\models\UserO::getItems(0)) ?>

    <?= $form->field($model, 'listNumber')->textInput() ?>

    <?= $form->field($model, 'countList')->textInput() ?>

<?= $form->field($model, 'dateIn')->widget(yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
]) ?>

    <?= $form->field($model, 'numberIn')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end()?>
 
</div>
