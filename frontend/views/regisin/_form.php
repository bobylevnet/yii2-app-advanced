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
	
	
	

  

    <?= $form->field($model, 'idTypDocum')->dropDownList(common\models\Typedoc::getItems()) ?>

    <?= $form->field($model, 'idTypeMat')->dropDownList(common\models\Typemat::getItems())  ?>

    <?= $form->field($model, 'aboutDoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateDoc')->widget(yii\jui\DatePicker::classname(),  [
    			'dateFormat' => 'yyyy-MM-dd',
    ])?>
		
	
		
	
    <?php  //юзеры нашей организации   ?>
	
    <?= $form->field($model, 'idUserRun')->dropDownList(Reguser::getItems(1, '=')) ?>
    	</div>
    <div class="col-lg-5">
	<?php //юзеры организации не нашей	?>  
	 <?= $form->field($model, 'idUserOrg')->dropDownList(Reguser::getItems(0, '='), ['id' =>'userorg']) ?>

    <?= $form->field($model, 'listNumber')->textInput() ?>

    <?= $form->field($model, 'countList')->textInput() ?>

	<?= $form->field($model, 'dateIn')->widget(yii\jui\DatePicker::classname(), [
			'dateFormat' => 'yyyy-MM-dd',

]) ?>

    <?= $form->field($model, 'numberIn')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'idOrg')->hiddenInput(['id' => 'reg-idorg'])->label('') ?>	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end()?>
				</div>
 			</div>
		</div>
		


