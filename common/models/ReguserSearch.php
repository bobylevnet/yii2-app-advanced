<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserO;

/**
 * UserOSearch represents the model behind the search form about `common\models\UserO`.
 */
class ReguserSearch extends Reguser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idOrg'], 'integer'],
            [['nameUser'], 'safe'],
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
    	
    	if (isset($params['id']))
    	{
      	  $query = Reguser::find()->where(['idOrg'=>$params['id']]);
    	}
    	else 
    	{
    		$query = Reguser::find();
    	}
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idUser' => $this->idUser,
            'idOrg' => $this->idOrg,
        ]);

        $query->andFilterWhere(['like', 'nameUser', $this->nameUser]);

        return $dataProvider;
    }
}
