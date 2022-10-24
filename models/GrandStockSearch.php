<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GrandStock;

/**
 * GrandStockSearch represents the model behind the search form of `app\models\GrandStock`.
 */
class GrandStockSearch extends GrandStock
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'produit', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['quantite', 'buying_price', 'selling_price'], 'number'],
            [['currency'], 'safe'],
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
        $query = GrandStock::find();

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
            'id' => $this->id,
            'produit' => $this->produit,
            'quantite' => $this->quantite,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
