<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regUser".
 *
 * @property string $idUser
 * @property string $nameUser
 * @property integer $idOrg
 */
class UserO extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regUser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameUser', 'idOrg'], 'required'],
            [['idOrg'], 'integer'],
            [['nameUser'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'nameUser' => 'Name User',
            'idOrg' => 'Id Org',
        ];
    }
    
    
    //возвращем значение для dropdownlist
    public static function getItems($id=null,$z)
    {
    		$items = \yii\helpers\ArrayHelper::map(UserO::find()->where([$z, 'idOrg', $id])->all(),'idUser','nameUser') ;
    		return $items;
    }
}
