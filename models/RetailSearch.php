<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Retail;

/**
 * RetailSearch represents the model behind the search form of `app\models\Retail`.
 */
class RetailSearch extends Retail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produit', 'id', 'station', 'tank', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['plaque', 'usd', 'payment_mode', 'account'], 'safe'],
            [['quantite', 'prix', 'cdf', 'receivable'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Retail::find();

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
            'produit' => $this->produit,
            'quantite' => $this->quantite,
            'prix' => $this->prix,
            'cdf' => $this->cdf,
            'id' => $this->id,
            'station' => $this->station,
            'tank' => $this->tank,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'receivable' => $this->receivable,
        ]);

        $query->andFilterWhere(['like', 'plaque', $this->plaque])
            ->andFilterWhere(['like', 'usd', $this->usd])
            ->andFilterWhere(['like', 'payment_mode', $this->payment_mode])
            ->andFilterWhere(['like', 'account', $this->account]);

        return $dataProvider;
    }
}
