<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "typemat".
 *
 * @property string $idMatDoc
 * @property string $nameMat
 */
class Typemat extends \yii\db\ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'typemat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameMat'], 'required'],
            [['nameMat'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMatDoc' => 'Id Mat Doc',
            'nameMat' => 'Name Mat',
        ];
    }
    
    
    public function Fields()
    {
    
    	$fields = parent::attributes();
    	return $fields;
    }
    
    
   public static function getItems()
    {
 
        $items = \yii\helpers\ArrayHelper::map(Typemat::find()->all(),'idMatDoc','nameMat');
        return $items;
    }
    public static function primaryKey()
    {
    	 
    	return static::getTableSchema()->primaryKey;
    }
  
}
