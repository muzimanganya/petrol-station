<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dechargement;

/**
 * DechargementSearch represents the model behind the search form of `app\models\Dechargement`.
 */
class DechargementSearch extends Dechargement
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'tank', 'created_at', 'created_by', 'updated_at', 'updated_by', 'station'], 'integer'],
            [['stock_initiale', 'quantite', 'index_debut', 'index_fin', 'quantite_finale', 'unit_price', 'selling_price', 'margin', 'payable'], 'number'],
            [['payment_mode', 'account'], 'safe'],
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
        $query = Dechargement::find();

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
            'no' => $this->no,
            'stock_initiale' => $this->stock_initiale,
            'quantite' => $this->quantite,
            'index_debut' => $this->index_debut,
            'index_fin' => $this->index_fin,
            'quantite_finale' => $this->quantite_finale,
            'tank' => $this->tank,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'unit_price' => $this->unit_price,
            'selling_price' => $this->selling_price,
            'margin' => $this->margin,
            'station' => $this->station,
            'payable' => $this->payable,
        ]);

        $query->andFilterWhere(['like', 'payment_mode', $this->payment_mode])
            ->andFilterWhere(['like', 'account', $this->account]);

        return $dataProvider;
    }
}
