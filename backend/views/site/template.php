<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use backend\models\Templatelist;
use yii\jui\Draggable;
use yii\jui\Droppable;
$this->title = 'Шаблоны';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>



</div>

<div class="row">
 
    <div class="col-sm-3 ">   
    <?php

echo ListView::widget([
    'dataProvider' => $listDataProvider,
    'itemView' => '_files',
]);



?>
    </div>
    

 <div class="col-sm-8 back"> 





<?php



$form = ActiveForm::begin();

    $params = [	
        'prompt' => 'Выберите шаблон'
    ];
        echo $form->field($model, 'nametemplate')->dropDownList($model::getItems());
     
        
        
        Droppable::begin([
        		 
        		'clientOptions' => ['grid' => [50, 20]],
        		'id' => 'dropElement',
        		
        		"clientEvents" => [
        				 
        				"drop" =>
        				"function (event, ui) {
        					var elemeDrop = $(this).find('.column-insert');
				 
        				
        				$(this).find('.append').append(ui.draggable);
       
        		}",
        				"out" =>  "function (event, ui)
        		{
        	  
       
      			}",
        				 
        		"over" => "function (event, ui) {
        	     var elemeDrop = $(this).find('.column-insert');
      
       
       					 	}",
        			 
        	   "activate" => "function (event, ui){
      
      
        					 }",
        	   "deactivate" => "function (event, ui){
        
      
        					 }",
        				 
        		],
        		 
        ]);
        
      	echo Html::tag('div','',['class' => 'append']);
         
        Droppable::end();
        ActiveForm::end();
       ?> 

        <div class="order">
        <?php 
        $arr= $keymodel->attributes;
        $labels = $keymodel->attributeLabels();
        foreach ($arr as $key=>$value)
        {
        	echo Html::tag('div',$key,['class'=>'column']);
        	echo Html::tag('div',$labels[$key],['class'=>'column']);
        	echo '</br>';
        	

        }
        

   
?>
 </div>
</div>
    
</div>

