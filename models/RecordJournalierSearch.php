<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RecordJournalier;

/**
 * RecordJournalierSearch represents the model behind the search form of `app\models\RecordJournalier`.
 */
class RecordJournalierSearch extends RecordJournalier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'index_debut', 'index_fin', 'station', 'produit', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['sortie_pompe','stock_physique'], 'number'],
            [['date'], 'safe'],
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
        $query = RecordJournalier::find();

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
            'index_debut' => $this->index_debut,
            'index_fin' => $this->index_fin,
            'sortie_pompe' => $this->sortie_pompe,
            'station' => $this->station,
            'produit' => $this->produit,
            'cdf'=>$this->cdf,
            'usd'=>$this->usd,
            // 'dechargemt'=>$this->dechargemt,
            'depense_usd'=>$this->depense_usd,
            'stock_physique'=>$this->stock_physique,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
