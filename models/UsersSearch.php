<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\api\modules\v1\models\User;

/**
 * UsersSearch represents the model behind the search form of `app\modules\api\modules\v1\models\User`.
 */
class UsersSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'institution', 'faculty', 'city'], 'integer'],
            [['first_name', 'username', 'password', 'token_id', 'middle_name', 'last_name', 'gender', 'date_of_birth', 'card'], 'safe'],
            [['is_active'], 'boolean'],
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
        $query = User::find();

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
            'is_active' => $this->is_active,
            'date_of_birth' => $this->date_of_birth,
            'institution' => $this->institution,
            'faculty' => $this->faculty,
            'city' => $this->city,
        ]);

        $query->andFilterWhere(['ilike', 'first_name', $this->first_name])
            ->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'token_id', $this->token_id])
            ->andFilterWhere(['ilike', 'middle_name', $this->middle_name])
            ->andFilterWhere(['ilike', 'last_name', $this->last_name])
            ->andFilterWhere(['ilike', 'gender', $this->gender])
            ->andFilterWhere(['ilike', 'card', $this->card]);

        return $dataProvider;
    }
}
