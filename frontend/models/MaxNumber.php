<?php
namespace frontend\models;
use common\models\Numberyear;


class MaxNumber
{
	//$INOUT - 1 ВХОДЯЩИЕ 2  ИСХОДЯЩИЕ
	public static function getMax($model, $INOUT)
	{
		
	    $number = Numberyear::find()->where(['year'=> new \yii\db\Expression('YEAR(CURDATE())')])->WHERE(['dinOut'=>$INOUT])->one();
//	  if ($number['numberCurrent']<$number['numberStart'])	
	//  {
	  	$number['numberCurrent'] =	$number['numberCurrent']+1;
	  	
	  	if ($number['numberCurrent']<$number['numberStart'])
	  	{
	  	$number['numberCurrent'] = $number['numberStart'] + $number['numberCurrent'];
	  	}
	 
	  	
	  
	  	
	  	$number->save();
	  	return $number['numberCurrent'];
	 
	 /*   $numberDoc = $model->find()
	    ->where(['YEAR(dateDoc)'=> new \yii\db\Expression('YEAR(CURDATE())')])
	    ->max('numberDoc')+1;
	    
	    
	   	if (isset($numberStart)) 
	   	{
	    $result = $numberStart['numberStart'];
	    
	    if ($result<$numberDoc)
	    {
	    	$numberStart->delete();
	    	return $numberDoc;
	    }
	    
		return $result;
	   	}*/
		
	   
	   	
	   	
	   	//удаляем запись 
	   
	   	
		//return $numberDoc;
		// $model->find()->select('numberDoc')->max('numberDoc')+1;
		
	}
	
	
}