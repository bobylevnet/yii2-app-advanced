<?php
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">


       <?php
       $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
  	    <?= $form->field($model, 'excelFiles[]')->fileInput(['multiple' => true]) ?>
   	    <button>Загрузить</button>
		<?php ActiveForm::end()?>

</div>
