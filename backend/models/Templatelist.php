<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "templatelist".
 *
 * @property string $id
 * @property string $nametemplate
 */
class Templatelist extends \yii\db\ActiveRecord
{
    /** q
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'templatelist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nametemplate'], 'required'],
            [['nametemplate'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nametemplate' => 'Nametemplate',
        ];
    }
    
    public function Fields()
    {
    
    	$fields = parent::attributes();
    	return $fields;
    }

    public static function getItems($id=null)
    {
    
    	return $items = \yii\helpers\ArrayHelper::map(Templatelist::find()->all(),'model','nametemplate');
    	
    }
}
