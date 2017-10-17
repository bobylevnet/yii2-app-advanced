<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Typemat;
use common\models\Typedoc;
use common\models\Reguser;

/* @var $this yii\web\View */
/* @var $model app\models\regisout */
/* @var $form yii\widgets\ActiveForm */
?>




<?php \yii\widgets\Pjax::begin(['id'=>'new_row'])?>
<div class="regisout-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    

    <?= $form->field($model, 'idOrg')->hiddenInput(['id' => 'reg-idorg']) ?>

    <?= $form->field($model, 'idTypDocum')->dropDownList(Typedoc::getItems()) ?>

    <?= $form->field($model, 'idTypeMat')->dropDownList(Typemat::getItems()) ?>

    <?= $form->field($model, 'aboutDoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateDoc')->widget(yii\jui\DatePicker::classname(), [
    		'dateFormat'=>'yyyy-MM-dd',
    ]) ?>


     

     <?= $form->field($model, 'idUserRun')->dropDownList(Reguser::getItems(1, '=')) ?>

	 <?= $form->field($model, 'idUserOrg')->dropDownList(Reguser::getItems(0, '='), ['id' =>'userorg']) ?>

    <?= $form->field($model, 'senderDate')->widget(yii\jui\DatePicker::classname(), [
    		'dateFormat'=>'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'returnDate')->widget(yii\jui\DatePicker::classname(), [
    		'dateFormat'=>'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'listNumber')->textInput() ?>

    <?= $form->field($model, 'countList')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<?php \yii\widgets\Pjax::end()?>

</div>
