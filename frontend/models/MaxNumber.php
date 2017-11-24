<?php
namespace frontend\models;
use common\models\Numberyear;




class MaxNumber
{

		public static $maxn;
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
	 
	  	MaxNumber::$maxn=$number;
	  	return $number['numberCurrent'];
	 

		
	}
	
	
	public static function save()
	{
		MaxNumber::$maxn->save();
	}
	
	
	
	
}