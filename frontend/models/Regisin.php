<?php

namespace frontend\models;

use Yii;
use frontend\models\RelationHelper;

/**
 * This is the model class for table "regisin".
 *
 * @property string $idRin
 * @property integer $idOrg
 * @property integer $idTypDocum
 * @property integer $idTypeMat
 * @property string $aboutDoc
 * @property string $dateDoc
 * @property integer $yearDoc
 * @property integer $idUserRun
 * @property integer $idUserOrg
 * @property integer $listNumber
 * @property integer $countList
 * @property string $dateIn
 * @property string $numberIn
 */
class Regisin extends RelationHelper
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regisin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['yearDoc', 'idRin', 'idRout'],'safe'],
            [['idOrg', 'idTypDocum', 'idTypeMat', 'aboutDoc', 'dateDoc','idUserRun', 'idUserOrg', 'listNumber', 'countList', 'dateIn', 'numberIn'], 'required'],
            [['idOrg', 'idTypDocum', 'idTypeMat', 'yearDoc', 'idUserRun', 'idUserOrg', 'listNumber', 'countList','numberDoc'], 'integer'],
            [['dateDoc', 'dateIn', 'nameTypeDoc'], 'safe'],
            [['aboutDoc'], 'string', 'max' => 255],
            [['numberIn'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrg' => 'Id Org',
            'typeDoc' => 'Тип документа',
            'idTypeMat' => 'Вид документа',
            'aboutDoc' => 'О чем документ',
            'dateDoc' => 'Дата исх',
            'yearDoc' => 'Year Doc',
            'idUserRun' => 'Исполнитель',
            'idUserOrg' => 'Кому',
            'listNumber' => 'Кол-во листов',
            'countList' => 'Кол-во экземпляров',
            'dateIn' => 'Дата исходящего',
            'numberIn' => 'Номер исходящиего',
        	'numberDoc' => 'Number Doc',
        	'idTypDocum' => 'Тип документа',
        	'userNameOrg' =>'От кого письмо',
        	'userNameRun' => 'Исполнитель'
        	
    
        ];
    }
    
    
    
}
