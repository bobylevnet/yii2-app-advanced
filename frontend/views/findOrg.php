<?php
use yii\helpers\Html;


//$this->registerJsFile('@web/js/_pjax.js', ['depends'=>'yii\web\JqueryAsset']);

$this->registerJs("$('document').ready( function() {
      $('#new_row').on('pjax:end', function() {
       $.pjax.reload({container: '#grid'});
       });
    });");

?>
    
    
    
     <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::input('text','find', '' ,['id'=>'find']); ?>
    
    <div id="searorg">
    </div> 
