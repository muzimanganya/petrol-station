<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VersementWallet;

/**
 * VersementWalletSearch represents the model behind the search form of `app\models\VersementWallet`.
 */
class VersementWalletSearch extends VersementWallet
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'wallet_from', 'wallet_to','usd','cdf','created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['amount', 'balance_from', 'balance_to'], 'number'],
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
        $query = VersementWallet::find();

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
            'wallet_from' => $this->wallet_from,
            'wallet_to' => $this->wallet_to,
            'amount' => $this->amount,
            'usd' => $this->usd,
            'cdf' => $this->cdf,
            'balance_from' => $this->balance_from,
            'balance_to' => $this->balance_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency]);

        return $dataProvider;
    }
}
