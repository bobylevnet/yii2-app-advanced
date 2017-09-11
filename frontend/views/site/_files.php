<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="files">
    

    <?= Html::encode($model->name ) ?>

     <?= HtmlPurifier::process($model->comment) ?>
    
    <?= Html::a('Показать','#',['name','id'=>$model->id]) ?>
    
    
    <div class="column">
    </div>

    
</div>