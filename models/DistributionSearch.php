<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Distribution;

/**
 * DistributionSearch represents the model behind the search form of `app\models\Distribution`.
 */
class DistributionSearch extends Distribution
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dechargement', 'station', 'tank', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['stock_initiale', 'quantite', 'index_debut', 'index_fin', 'sortie_pompe', 'quantite_finale'], 'number'],
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
        $query = Distribution::find();

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
            'dechargement' => $this->dechargement,
            'stock_initiale' => $this->stock_initiale,
            'quantite' => $this->quantite,
            'index_debut' => $this->index_debut,
            'index_fin' => $this->index_fin,
            'sortie_pompe' => $this->sortie_pompe,
            'quantite_finale' => $this->quantite_finale,
            'station' => $this->station,
            'tank' => $this->tank,
            
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
