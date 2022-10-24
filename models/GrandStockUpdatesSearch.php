<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GrandStockUpdates;

/**
 * GrandStockUpdatesSearch represents the model behind the search form of `app\models\GrandStockUpdates`.
 */
class GrandStockUpdatesSearch extends GrandStockUpdates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'produit', 'dechargement', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['old_quantity', 'old_selling_price', 'old_buying_price', 'new_quantity', 'new_buying_price', 'new_selling_price'], 'number'],
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
        $query = GrandStockUpdates::find();

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
            'dechargement' => $this->dechargement,
            'old_quantity' => $this->old_quantity,
            'old_selling_price' => $this->old_selling_price,
            'old_buying_price' => $this->old_buying_price,
            'new_quantity' => $this->new_quantity,
            'new_buying_price' => $this->new_buying_price,
            'new_selling_price' => $this->new_selling_price,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
