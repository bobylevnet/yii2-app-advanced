<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "org".
 *
 * @property string $idOrg
 * @property string $nameOrg
 * @property string $adresMail
 * @property string $adresTrans
 * @property string $orgKks
 * @property string $numDog
 * @property integer $deilevery
 */
class Org extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'org';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameOrg', 'adresMail', 'adresTrans', 'orgKks', 'numDog', 'deilevery'], 'required'],
            [['deilevery'], 'integer'],
            [['nameOrg', 'adresMail', 'adresTrans'], 'string', 'max' => 255],
            [['orgKks'], 'string', 'max' => 15],
            [['numDog'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrg' => 'Id Org',
            'nameOrg' => 'Name Org',
            'adresMail' => 'Adres Mail',
            'adresTrans' => 'Adres Trans',
            'orgKks' => 'Org Kks',
            'numDog' => 'Num Dog',
            'deilevery' => 'Deilevery',
        ];
    }
}
