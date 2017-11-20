<?php

namespace frontend\models;

use Yii;
use frontend\models\RelationHelper;
use common\models\Typesender;
use common\models\Helpmass;
use common\models\Org;
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
 * @property integer $idTypeSender
 */
class Regisout extends \frontend\models\RelationHelper
{
    //маса вычесляемое поле
    public $mass;
    public $price;
    public $adres;
    public $numberDocList;
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
            [['idOrg', 'idTypDocum', 'idTypeMat', 'numberDoc', 'yearDoc', 'idUserRun',   'listNumber', 'countList', 'idTypeSender'], 'integer'],
            [['dateDoc', 'senderDate', 'returnDate', 'idTypeSender'], 'safe'],
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
            'idTypDocum' => 'Тип документа',
            'idTypeMat' => 'Вид документа',
            'aboutDoc' => 'О чем документ',
            'dateDoc' => 'Дата документа',
            'numberDoc' => 'Number Doc',
            'yearDoc' => 'Year Doc',
            'idUserRun' => 'Исполнитель',
        	'idUserOrg'  => 'Кому',
            'senderDate' => 'Дата отправки',
            'returnDate' => 'Дата возврата',
            'listNumber' => 'Кол-во листов',
            'countList' => 'Кол-во экземпляров',
        	'idTypeSender'=>'Тип отправки',
        	
        ];
    }	
    
    public function  getCountLists( $dateBegin, $dateEnd )
    {
    	
    	$resultListReg=[];
    	
    	$orgListBet = $this->getOrgListBetween($dateBegin, $dateEnd);
    
    	foreach ($orgListBet as $orgId)
    	{
    	
    	//вычисляем массу
    		$result['mass'] =   Regisout::find()->select(['{{regisout}}.*','SUM(([[listNumber]] * [[countList]] * 5 + 15)) as mass'])
    		->where(['idOrg'=>$orgId->idOrg])
    		->andWhere(['between', 'dateDoc', $dateBegin, $dateEnd ])->one()['mass'];
    
    	//цена письма
    	$result['price']=Helpmass::find()->where('mass <=:mass',[':mass'=> $result['mass']])->max('price');  	
    	//адрес почтовый				
    	$r =  Org::find()->select(['adresTrans'])->where(['idOrg'=>$orgId->idOrg])->all();
    		
    		if (count($r)!=0) {
    			$result['adres']=$r[0]['adresTrans'];
    		}
    		else 
    		{
    			$result['adres'] = '';
    		}
    	
    	//список номер исходящих документов
    	$result['numberDocList']  =  $this->getStrListNumberOrgOne($orgId->idOrg,$dateBegin, $dateEnd );
    	$resultListReg[]= $result;
    	
    	}
    	
    	return $resultListReg;
    }
    
    
    
    //список номер исходящих за период
    public function getStrListNumberOrgOne($idorg, $dateBegin, $dateEnd)
    {
    	$numberDocList = Regisout::find()
    	->select(['numberDoc'])
    	->where(['idOrg'=>$idorg])
    	->andWhere(['between', 'dateDoc', $dateBegin, $dateEnd ])
    	->all();
    	$listNumber='';
    	
    	foreach($numberDocList as $oneList){
    		
    		$listNumber = $listNumber .  $oneList['numberDoc'] . ' ' ;
    	}
    	
    	return $listNumber;
    }
    
    
    
    //список организации за период
    public function getOrgListBetween($dateBegin, $dateEnd)
    {
    	 $orgPeriod =  Regisout::find()->select(['idOrg'])
       	 ->where(['between', 'dateDoc', $dateBegin, $dateEnd ])
    	 ->groupBy(['idOrg'])
    	 ->all();
    	
    	 return $orgPeriod;
    }
    
    
    //связь с наменование организации
    public function getRegout()
    {
    
    	return $this->hasOne(Typesender::className(),['idTypeSender'=>'idTypeSender'] );
    
    }
    
    

}
