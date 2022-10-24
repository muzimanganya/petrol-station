<?php

namespace app\modules\api\modules\v1\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Accessory;

/**
 * SearchAccessory represents the model behind the search form of `app\models\Accessory`.
 */
class SearchAccessory extends Accessory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job', 'tel_donneu', 'curr_km', 'click', 'roue_de_secour', 'cle_de_roue', 'trouse_a_outils', 'extincteur', 'triangle', 'enjoliver', 'assurance', 'ccva', 'cartes_grisse', 'carnet_de_bord', 'radio', 'cle_usb', 'cd', 'chargeur_tel', 'mp3', 'tapis_de_sol_AV', 'tapis_de_sol_arr', 'oeil_de_remorque', 'dat', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['plateNo', 'nom_donneur', 'fuel', 'others'], 'safe'],
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
        $query = Accessory::find();

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
            'job' => $this->job,
            'tel_donneu' => $this->tel_donneu,
            'curr_km' => $this->curr_km,
            'click' => $this->click,
            'roue_de_secour' => $this->roue_de_secour,
            'cle_de_roue' => $this->cle_de_roue,
            'trouse_a_outils' => $this->trouse_a_outils,
            'extincteur' => $this->extincteur,
            'triangle' => $this->triangle,
            'enjoliver' => $this->enjoliver,
            'assurance' => $this->assurance,
            'ccva' => $this->ccva,
            'cartes_grisse' => $this->cartes_grisse,
            'carnet_de_bord' => $this->carnet_de_bord,
            'radio' => $this->radio,
            'cle_usb' => $this->cle_usb,
            'cd' => $this->cd,
            'chargeur_tel' => $this->chargeur_tel,
            'mp3' => $this->mp3,
            'tapis_de_sol_AV' => $this->tapis_de_sol_AV,
            'tapis_de_sol_arr' => $this->tapis_de_sol_arr,
            'oeil_de_remorque' => $this->oeil_de_remorque,
            'dat' => $this->dat,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'plateNo', $this->plateNo])
            ->andFilterWhere(['like', 'nom_donneur', $this->nom_donneur])
            ->andFilterWhere(['like', 'fuel', $this->fuel])
            ->andFilterWhere(['like', 'others', $this->others]);

        return $dataProvider;
    }
}
