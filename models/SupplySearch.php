<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supply;

/**
 * SupplySearch represents the model behind the search form of `app\models\Supply`.
 */
class SupplySearch extends Supply
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nom_client', 'telephone', 'tank', 'produit', 'station', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['quantite', 'prix', 'cdf', 'receivable'], 'number'],
            [['usd', 'account', 'payment_mode'], 'safe'],
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
        $query = Supply::find();

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
            'nom_client' => $this->nom_client,
            'telephone' => $this->telephone,
            'quantite' => $this->quantite,
            'prix' => $this->prix,
            'cdf' => $this->cdf,
            'tank' => $this->tank,
            'produit' => $this->produit,
            'station' => $this->station,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'receivable' => $this->receivable,
        ]);

        $query->andFilterWhere(['like', 'usd', $this->usd])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'payment_mode', $this->payment_mode]);

        return $dataProvider;
    }
}
