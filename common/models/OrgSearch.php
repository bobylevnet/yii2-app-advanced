<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Org;

/**
 * OrgSearch represents the model behind the search form about `app\models\Org`.
 */
class OrgSearch extends Org
{
	
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idOrg'], 'integer'],
            [['nameOrg', 'adresMail', 'adresTrans', 'orgKks', 'numDog',  'sendertype.typeSender', 'typeSender'], 'safe'],
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

        // add conditions that should always apply here

    	if (isset($params['nameOrg'])) {
    		$query = Org::find()->andWhere(['like', 'nameOrg', $params['nameOrg']]);
    	}
    	else {
    		$query =    $query = Org::find();
    	
  	  	}
    	
        $dataProvider = new ActiveDataProvider([
        		'query' => $query,
        		
        ]);

       $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
        //    $query->where('0=1');
          return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idOrg' => $this->idOrg,
        ]);

        $query->andFilterWhere(['like', 'nameOrg', $this->nameOrg])
            ->andFilterWhere(['like', 'adresMail', $this->adresMail])
            ->andFilterWhere(['like', 'adresTrans', $this->adresTrans])
            ->andFilterWhere(['like', 'orgKks', $this->orgKks])
            ->andFilterWhere(['like', 'numDog', $this->numDog]);

        return $dataProvider;
    }
}
