


<?php

if (!is_null($model))
{

foreach ($model as $key=>$value)
{
    if (!is_null( $model[$key]))
    {
        
      echo "<div class='drop'>"; 
      echo  \yii\bootstrap\Html::label($model[$key]);
      echo   "</br>";
      echo "</div>";
    }

}
}
else {
    echo \yii\bootstrap\Html::label('Нет данных');
}
    
