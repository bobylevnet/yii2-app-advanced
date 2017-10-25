<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use common\models\iRelation;

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
 * @property string $test
 */
class Org extends \yii\db\ActiveRecord  implements iRelation
{

	public $typeSender;
	/**
     * @inheritdoc
     */

	
    public static function tableName()
    {
        return 'Org';
    }

    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameOrg'], 'required'],
            [['deilevery'], 'integer'],
        	[['nameOrg', 'adresMail', 'adresTrans'], 'string', 'max' => 255],
            [['orgKks'], 'string', 'max' => 15],
            [['numDog'], 'string', 'max' => 30],
        	[['sendertype.typeSender','typeSender' , 'adresTrans', 'orgKks', 'numDog'], 'safe'],
        ];

    }
    
    
    
    
   
    public static function relation()
    {
    	return [
    			
    			'typeSender' => 'sendertype.typeSender',
    			//имя модели класс
    			'typeSenderModel' => 'Typesender',
    			//верное поле для формы
    			'typeSenderForm' => 'deilevery',
    			//модель для отношения одна организация много записей
    			'Org' => 'common\models\Reguser',
    	];
    	
    }
    
    
   /* public function init()
    {
    	parent::init();
    	$this->find()->joinWith('sendertype');

    	
    	return  $this;
    	
    }*/
    
 
   public function Fields()
    {
 
    	$fields = parent::attributes();
   		//$fields[] =  'deileveryList';
   		$fields[] = 'typeSender';
    	unset($fields[array_search('deilevery', $fields)]);
    	    return $fields;
    }

  //  public function attributes()
   // {
    	//$attributes = parent::attributes();
    //	$attributes[] = 
    	//return $attributes;
    	
   // }
  
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrg' => 'Id Org',
            'nameOrg' => 'Имя организации',
            'adresMail' => 'Почтовый адрес',
            'adresTrans' => 'Адрес транспортный',
            'orgKks' => 'ККС',
            'numDog' => 'Номер договора',
           'deilevery' => 'Тип доставки',
        //		'test' => 'Test'
        ];
    }
    
    
   
  
    
    public static function primaryKey()
    {
    	return static::getTableSchema()->primaryKey;
    }
    
    //связь с наменование организации
    public function getSendertype()
    {
    	return $this->hasOne(Typesender::className(),['idTypeSender'=>'deilevery'] );
    
    }
    
    public static function getItems($id=null)
    {
    if (isset($id))  {
    	$items = \yii\helpers\ArrayHelper::map(Org::find()->where(['idOrg'=>$id])->all(),'idOrg','nameOrg');
    }
    else{
    	$items = \yii\helpers\ArrayHelper::map(Org::find()->all(),'idOrg','nameOrg');
    }
    	
    	return $items;
    }
}


