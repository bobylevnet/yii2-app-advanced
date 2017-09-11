<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reguser".
 *
 * @property string $idUser
 * @property string $nameUser
 * @property integer $idOrg
 */
class Reguser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reguser';
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
}
