<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\jui\Draggable;
use yii\widgets\Pjax;
?>
<div class="files">
    

  

     <?= HtmlPurifier::process($model->comment) ?>
    


    <?= Html::a('Показать','#',['name','id'=>$model->id]) ?>
   

		<div class="column" id=<?=$key . 'column'?>> </div>


</div>