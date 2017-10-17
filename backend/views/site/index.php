<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
$this->title = 'My Yii Application';
?>
<div class="site-index">

  

          <?php
       $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
  	    <?= $form->field($model, 'excelFiles[]')->fileInput(['multiple' => true]) ?>
   	    <button>Загрузить</button>
		<?php ActiveForm::end()?>
            
            <?php 
            echo $model->column;
            ?>

</div>
