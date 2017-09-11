<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "templatelist".
 *
 * @property string $id
 * @property string $nametemplate
 */
class Templatelist extends \yii\db\ActiveRecord
{
    /**
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
}
