<?php
namespace common\models;

use Yii;
use common\models\iRelation;

/**
 * This is the model class for table "reguser".
 *
 * @property string $idUser
 * @property string $nameUser
 * @property integer $idOrg
 */
class Reguser extends \yii\db\ActiveRecord implements iRelation
{
    /**
     * @inheritdoc
     */
	
	public $nameOrg;
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
            [['nameUser'],  'string', 'max' => 100],
        	[['orgn.nameOrg', 'nameOrg'], 'safe' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'nameUser' => 'Имя',
            'idOrg' => 'Код организации',
        ];
    }
    
    public function Fields()
    {
    
    	$fields = parent::attributes();
    	$fields[] = 'nameOrg';
    	unset($fields[array_search('idOrg', $fields)]);
    	return $fields;
 
    }
    
    
    public static function Relation()
    {   	
    	return [
    			'nameOrg' => 'orgn.nameOrg',
    			'nameOrgModel'=> 'Org',
    			'nameOrgForm'=>'idOrg',
    			//1 Модель внешнней таблицы 2 поле для связи с данными импорта 3 поле текующий таблицы для вста
    			'import'=>'Org.orgKKs.idOrg',
    			];
    }
    
    //связь с наменование организации
    public function getOrgn()
    {
    	
    	return $this->hasOne(Org::className(),['idOrg'=>'idOrg'] );
    
    }
    
    
    
    //возвращем значение для dropdownlist
    public static function getItems($id=null,$z)
    {
    	$items = \yii\helpers\ArrayHelper::map(Reguser::find()->where([$z, 'idOrg', $id])->all(),'idUser','nameUser') ;
    	return $items;
    }
}
