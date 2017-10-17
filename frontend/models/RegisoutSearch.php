<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\regisout;

/**
 * RegisoutSearch represents the model behind the search form about `app\models\regisout`.
 */
class RegisoutSearch extends regisout
{
	
	

	public $nameTypeDoc;
	public $nameMat;
	public $nameOrg;
	public $userNameRun;
	public $userNameOrg;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		        		
        		
            [['idRout', 'idOrg', 'idTypDocum', 'idTypeMat', 'numberDoc', 'yearDoc', 'idUserRun',  'listNumber', 'countList'], 'integer'],
            [['aboutDoc', 'dateDoc', 
            		'senderDate', 
            		'returnDate',
            		'typed.nameTypeDoc',
        			'typem.nameMat',
        			'nameTypeDoc',
        			'nameMat',
        			'org.nameOrg',
        			'nameOrg',
        			'userNameRun',
            		'userNameOrg',
            ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = regisout::find();
        $query = regisout::find()->joinWith(['typed', 'typem', 'org', 'userr', 'usero as uorg']);
        // add conditions that should always apply here

        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        
        
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->sort->attributes['nameTypeDoc'] = [
        		'asc'=> ['typedoc.nameTypeDoc'=>SORT_ASC],
        		'desc'=> ['typedoc.nameTypeDoc'=>SORT_DESC],
        ];
         
        $dataProvider->sort->attributes['nameMat'] = [
        		'asc'=> ['typemat.nameMat'=>SORT_ASC],
        		'desc'=> ['typemat.nameMat'=>SORT_DESC],
        ];
         
        $dataProvider->sort->attributes['nameOrg'] = [
        		'asc'=> ['org.nameOrg'=>SORT_ASC],
        		'desc'=> ['org.nameOrg'=>SORT_DESC],
        ];
         
        $dataProvider->sort->attributes['userNameRun'] = [
        		'asc'=> ['reguser.nameUser'=>SORT_ASC],
        		'desc'=> ['reguser.nameUser'=>SORT_DESC],
        ];
  
        
        
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idRout' => $this->idRout,
            'idOrg' => $this->idOrg,
            'idTypDocum' => $this->idTypDocum,
            'idTypeMat' => $this->idTypeMat,
            'dateDoc' => $this->dateDoc,
            'numberDoc' => $this->numberDoc,
            'yearDoc' => $this->yearDoc,
            'idUserRun' => $this->idUserRun,     
        	'idUserOrg' => $this->idUserOrg,
            'senderDate' => $this->senderDate,
            'returnDate' => $this->returnDate,
            'listNumber' => $this->listNumber,
            'countList' => $this->countList,
        ]);

        $query->andFilterWhere(['like', 'aboutDoc', $this->aboutDoc])
        ->andFilterWhere(['like', 'numberDoc', $this->numberDoc])
        ->andFilterWhere(['like', 'typedoc.nameTypeDoc', $this->nameTypeDoc])
        ->andFilterWhere(['like', 'org.nameOrg', $this->nameOrg])
        ->andFilterWhere(['like', 'regUser.nameUser', $this->userNameOrg])
        ->andFilterWhere(['like', 'regUser.nameUser', $this->userNameRun]);

        return $dataProvider;
    }
}
