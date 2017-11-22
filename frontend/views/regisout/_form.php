<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Typemat;
use common\models\Typedoc;
use common\models\Reguser;
use common\models\Typesender;

/* @var $this yii\web\View */
/* @var $model app\models\regisout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container"> 

	<div class="row">
	


<?php \yii\widgets\Pjax::begin(['id'=>'new_row'])?>


<div class="col-lg-5">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    

    <?= $form->field($model, 'idOrg')->hiddenInput(['id' => 'reg-idorg'])->label($org) ?>

    <?= $form->field($model, 'idTypDocum')->dropDownList(Typedoc::getItems()) ?>

    <?= $form->field($model, 'idTypeMat')->dropDownList(Typemat::getItems()) ?>

    <?= $form->field($model, 'aboutDoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateDoc')->widget(yii\jui\DatePicker::classname(), [
    		'dateFormat'=>'yyyy-MM-dd',
    ]) ?>

     <?= $form->field($model, 'idUserRun')->dropDownList(Reguser::getItems(1, '=')) ?>
</div>

 <div class="col-lg-5">
	 <?= $form->field($model, 'idUserOrg')->dropDownList(Reguser::getItems($model['idOrg'], '='), ['id' =>'userorg']) ?>

    <?= $form->field($model, 'senderDate')->widget(yii\jui\DatePicker::classname(), [
    		'dateFormat'=>'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'returnDate')->widget(yii\jui\DatePicker::classname(), [
    		'dateFormat'=>'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'listNumber')->textInput(['class'=>'form-control field number-input']) ?>

    <?= $form->field($model, 'countList')->textInput(['class'=>'form-control field number-input']) ?>
    
     <?= $form->field($model, 'idTypeSender')->dropDownList(Typesender::getItems()) ?>
</div>






  
  <div class="form-group">
   <div class="col-lg-10">
        <?= Html::submitButton($model->isNewRecord ? 'Зарегистрировать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success center-block btn-l' : '	 btn-primary center-block btn-l']) ?>
	</div>
    <?php ActiveForm::end(); ?>
    <?php \yii\widgets\Pjax::end()?>
</div>
</div>
</div>
