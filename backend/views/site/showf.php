


<?php

use yii\jui\Draggable;


if (isset($model))
{

foreach ($model as $key=>$value)
{
    if (!is_null( $model[$key]))
    {
    	
    Draggable::begin([
    			'clientOptions' => ['revert'=>'invalid'],
    			'id' => $model->id .'-'. $key,
    			
    	
    			//"clientEvents" => [ "drop" => "function (event, ui) { alert(ui); }"],
    	]);
    
      echo "<div class='drop'>";
      
      echo \yii\bootstrap\Html::input('hidden',$key,$value);
      
      echo  \yii\bootstrap\Html::label($value);

      //echo   "</br>";
      echo "</div>";
      Draggable::end();
      
    }

}
}
else {
    echo \yii\bootstrap\Html::label('Нет данных');
}
    
