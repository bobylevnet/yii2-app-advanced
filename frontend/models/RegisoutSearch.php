<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\regisout;

/**
 * RegisoutSearch represents the model behind the search form about `app\models\regisout`.
 */
class RegisoutSearch extends regisout
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idRout', 'idOrg', 'idTypDocum', 'idTypeMat', 'numberDoc', 'yearDoc', 'idUserRun', 'idUserOrg', 'senderType', 'listNumber', 'countList'], 'integer'],
            [['aboutDoc', 'dateDoc', 'senderDate', 'returnDate'], 'safe'],
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
            'idRout' => $this->idRout,
            'idOrg' => $this->idOrg,
            'idTypDocum' => $this->idTypDocum,
            'idTypeMat' => $this->idTypeMat,
            'dateDoc' => $this->dateDoc,
            'numberDoc' => $this->numberDoc,
            'yearDoc' => $this->yearDoc,
            'idUserRun' => $this->idUserRun,
            'idUserOrg' => $this->idUserOrg,
            'senderType' => $this->senderType,
            'senderDate' => $this->senderDate,
            'returnDate' => $this->returnDate,
            'listNumber' => $this->listNumber,
            'countList' => $this->countList,
        ]);

        $query->andFilterWhere(['like', 'aboutDoc', $this->aboutDoc]);

        return $dataProvider;
    }
}
