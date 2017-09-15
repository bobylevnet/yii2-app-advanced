<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\regisin;

/**
 * RegisinSearch represents the model behind the search form about `app\models\regisin`.
 */
class RegisinSearch extends regisin
{
    /**
     * @inheritdoc
     */

	public $nameTypeDoc;
	
    public function rules()
    {
        return [
            [['idRin', 'idOrg', 'idTypDocum', 'idTypeMat', 'yearDoc', 'idUserRun', 'idUserOrg', 'listNumber', 'countList'], 'integer'],
            [['aboutDoc', 'dateDoc', 'dateIn', 'numberIn','typed.nameTypeDoc','typem.nameMat','nameTypeDoc'], 'safe'],
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
   
    	
    	
    	
        $query = regisin::find()->joinWith(['typed', 'typem']);
   
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
       $dataProvider->sort->attributes['nameTypeDoc'] = [
       						'asc'=> ['typedoc.nameTypeDoc'=>SORT_ASC],
       						'desc'=> ['typedoc.nameTypeDoc'=>SORT_DESC],
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
            'typedoc.nameTypeDoc' => $this->nameTypeDoc,
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
        	->andFilterWhere(['like', 'typedoc.nameTypeDoc', $this->typed]) ;

        return $dataProvider;
    }
}
