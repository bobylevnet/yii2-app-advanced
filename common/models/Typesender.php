<?php

namespace common\models;

use Yii;
use frontend\models\Regisin;
use frontend\models\Regisout;

/**
 * This is the model class for table "typesender".
 *
 * @property string $idTypeSender
 * @property string $typeSender
 */
class Typesender extends \yii\db\ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'typesender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeSender'], 'required'],
            [['typeSender'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTypeSender' => 'Id Type Sender',
            'typeSender' => 'Type Sender',
        ];
    }
    
    public function Fields()
    {
    
    	$fields = parent::attributes();
    	return $fields;
    }
   
    
    
   
    
    
    public static function getItems($id=null)
    {
    
    	$items = \yii\helpers\ArrayHelper::map(Typesender::find()->all(),'idTypeSender','typeSender');
    	return $items;
    }
}
