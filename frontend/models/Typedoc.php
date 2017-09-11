<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "typedoc".
 *
 * @property string $idTypDoc
 * @property string $nameTypeDoc
 */
class Typedoc extends \yii\db\ActiveRecord
{
   
    public $value;
    public $key;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'typedoc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameTypeDoc'], 'required'],
            [['nameTypeDoc'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTypDoc' => 'Id Typ Doc',
            'nameTypeDoc' => 'Name Type Doc',
        ];
    }
    
    
    public static function getItems()
    {
 
        $items = \yii\helpers\ArrayHelper::map(Typedoc::find()->all(),'idTypDoc','nameTypeDoc');
        return $items;
    }
}
