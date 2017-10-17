<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\regisin;

/**
 * RegisinSearch represents the model behind the search form about `app\models\regisin`.
 */
class RegisinSearch extends Regisin
{
    /**
     * @inheritdoc
     */

	public $nameTypeDoc;
	public $nameMat;
	public $nameOrg;
	public $userNameOrg;
	public $userNameRun;
	
    public function rules()
    {
        return [
            [['idRin', 'idOrg', 'idTypDocum', 'idTypeMat', 'yearDoc', 'idUserRun', 'idUserOrg', 'listNumber', 'countList', 'numberDoc'], 'integer'],
            [['aboutDoc', 
              'dateDoc', 
              'dateIn', 
              'numberIn',
              'typed.nameTypeDoc',
              'typem.nameMat',
              'nameTypeDoc',
              'nameMat',
              'org.nameOrg',
              'nameOrg',
              'userNameOrg',
              'userNameRun',
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
   
    	
    	
    	
        $query = regisin::find();
        
        $query = regisin::find()->joinWith(['typed', 'typem', 'org', 'userr', 'usero as uorg']);
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
       $dataProvider->sort->attributes['userNameOrg'] = [
       		'asc'=> ['reguser.nameUser'=>SORT_ASC],
       		'desc'=> ['reguser.nameUser'=>SORT_DESC],
       ];
       
        
        	
       // }]

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'idRin' => $this->idRin,
            'idOrg' => $this->idOrg,
          	'numberDoc'=>$this->numberDoc,
            'idTypeMat' => $this->idTypeMat,
            'dateDoc' => $this->dateDoc,
            'yearDoc' => $this->yearDoc,
            'idUserRun' => $this->idUserRun,
            'idUserOrg' => $this->idUserOrg,
            'listNumber' => $this->listNumber,
            'countList' => $this->countList,
            'dateIn' => $this->dateIn,
        ]);
     
        $query->andFilterWhere(['like', 'aboutDoc', $this->aboutDoc])
            ->andFilterWhere(['like', 'numberIn', $this->numberIn])
        	->andFilterWhere(['like', 'typedoc.nameTypeDoc', $this->nameTypeDoc])
        	->andFilterWhere(['like', 'org.nameOrg', $this->nameOrg])
        	->andFilterWhere(['like', 'regUser.nameUser', $this->userNameOrg])
        	->andFilterWhere(['like', 'regUser.nameUser', $this->userNameRun]);

        return $dataProvider;
    }
}
