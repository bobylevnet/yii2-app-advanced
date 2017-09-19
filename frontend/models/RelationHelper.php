<?php  

namespace app\models;

use Yii;
//устанавливаем связи со справочными таблицами

class RelationHelper extends \yii\db\ActiveRecord
{
	
	//свзяь с тип документа
	public function getTyped()
	{
		return $this->hasOne(Typedoc::className(),['idTypDoc'=>'idTypDocum'] );
		 
	}
	//связь с тип материала документа
	public function getTypem()
	{
		return $this->hasOne(Typemat::className(),['idMatDoc'=>'idTypeMat'] );
	
	}
	
	//связь с наменование организации
	public function getOrg()
	{
		return $this->hasOne(Org::className(),['idOrg'=>'idOrg'] );
	
	}
	
	
	//связь пользователь исполнитель
	public function getUserr()
	{
		return $this->hasOne(UserO::className(),['idUser'=>'idUserRun'] );
	
	}
	
	
	//связь пользователь организация
	public function getUsero()
	{
		return $this->hasOne(UserO::className(),['idUser'=>'idUserOrg'] );
	
	}
}