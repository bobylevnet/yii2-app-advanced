<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Typedoc;
use common\models\Reguser;
use frontend\models\Typemat;
use common\models\UserO;
/* @var $this yii\web\View */
/* @var $model app\models\regisin */
/* @var $form yii\widgets\ActiveForm */
?>

<?php // \yii\widgets\Pjax::begin();?>



<?php \yii\widgets\Pjax::begin(['id'=>'new_row'])?>
<div class="container"> 

	<div class="row">
	
		
		
		<!-- <div class="regisin-form"> -->
			<div class="col-lg-5">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
	
	<?= $form->field($model, 'idOrg')->hiddenInput(['id' => 'reg-idorg', ])->label($org) ?>
	

  

    <?= $form->field($model, 'idTypDocum')->dropDownList(common\models\Typedoc::getItems()) ?>

    <?= $form->field($model, 'idTypeMat')->dropDownList(common\models\Typemat::getItems())  ?>

    <?= $form->field($model, 'aboutDoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateDoc')->widget(yii\jui\DatePicker::classname(),  [
    			'dateFormat' => 'yyyy-MM-dd',
    		
    ], ['class'=>'form-control'])?>
		
	
		
	
    <?php  //юзеры нашей организации   ?>
	
    <?= $form->field($model, 'idUserRun')->dropDownList(Reguser::getItems(1, '=')) ?>
    	</div>
    <div class="col-lg-5">
	<?php //юзеры организации не нашей	?>  
	 <?= $form->field($model, 'idUserOrg')->dropDownList(Reguser::getItems($model['idOrg'],  '='), ['id' =>'userorg']) ?>

    <?= $form->field($model, 'listNumber')->textInput(['class'=>'form-control field number-input']) ?>

    <?= $form->field($model, 'countList')->textInput(['class'=>'form-control  number-input']) ?>


	<?= $form->field($model, 'dateIn')->widget(yii\jui\DatePicker::classname(), [
			'dateFormat' => 'yyyy-MM-dd'
]) ?>

    <?= $form->field($model, 'numberIn')->textInput(['class'=>'form-control  number-input']) ?>
  
</div>
<div class="form-group">

    <div class="col-lg-10">
        <?= Html::submitButton($model->isNewRecord ? 'Зарегистрировать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success center-block btn-l' : '	 btn-primary center-block btn-l']) ?>
     </div>
     
    </div>
    <?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end()?>
				
 			</div>
		</div>
		


