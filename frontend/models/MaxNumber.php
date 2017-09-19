<?php
namespace app\models;

class MaxNumber
{
	
	public static function getMax($model)
	{
		
		return $model = $model->find()
		->where(['YEAR(dateDoc)'=> new \yii\db\Expression('YEAR(CURDATE())')])
		->max('numberDoc')+1;
		// $model->find()->select('numberDoc')->max('numberDoc')+1;
		
	}
	
	
}