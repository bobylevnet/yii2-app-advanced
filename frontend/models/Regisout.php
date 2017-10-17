<?php

namespace frontend\models;

use Yii;
use frontend\models\RelationHelper;
/**
 * This is the model class for table "regisout".
 *
 * @property string $idRout
 * @property integer $idOrg
 * @property integer $idTypDocum
 * @property integer $idTypeMat
 * @property string $aboutDoc
 * @property string $dateDoc
 * @property integer $numberDoc
 * @property integer $yearDoc
 * @property integer $idUserRun
 * @property string $senderDate
 * @property string $returnDate
 * @property integer $listNumber
 * @property integer $countList
 */
class Regisout extends \frontend\models\RelationHelper
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regisout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idOrg', 'idTypDocum', 'idTypeMat', 'aboutDoc', 'dateDoc', 'numberDoc', 'yearDoc', 'idUserOrg', 'idUserRun',  'senderDate',  'listNumber', 'countList'], 'required'],
            [['idOrg', 'idTypDocum', 'idTypeMat', 'numberDoc', 'yearDoc', 'idUserRun',   'listNumber', 'countList'], 'integer'],
            [['dateDoc', 'senderDate', 'returnDate'], 'safe'],
            [['aboutDoc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idRout' => 'Id Rout',
            'idOrg' => 'Id Org',
            'idTypDocum' => 'Id Typ Docum',
            'idTypeMat' => 'Id Type Mat',
            'aboutDoc' => 'About Doc',
            'dateDoc' => 'Date Doc',
            'numberDoc' => 'Number Doc',
            'yearDoc' => 'Year Doc',
            'idUserRun' => 'Id User Run',
        	'idUserOrg'  => 'Id User Org',
            'senderDate' => 'Sender Date',
            'returnDate' => 'Return Date',
            'listNumber' => 'List Number',
            'countList' => 'Count List',
        	
        ];
    }
    
    
    

}
