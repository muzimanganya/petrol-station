<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "distribution".
 *
 * @property int $id
 * @property int $dechargement
 * @property float $stock_initiale
 * @property float $quantite
 * @property float $index_debut
 * @property float $index_fin
 * @property float $sortie_pompe
 * @property float $quantite_finale
 * @property int|null $station
 * @property int $tank
 * @property int|null $transaction
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Dechargement $dechargement0
 */
class Distribution extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distribution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produit', 'quantite', 'index_debut','tank'], 'required'],
            [['dechargement', 'station', 'tank', 'produit', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['stock_initiale', 'quantite', 'index_debut', 'index_fin', 'sortie_pompe', 'quantite_finale','unit_price'], 'number'],
            [['currency'],'string', 'max'=>45],
            [['dechargement'], 'exist', 'skipOnError' => true, 'targetClass' => Dechargement::className(), 'targetAttribute' => ['dechargement' => 'no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dechargement' => Yii::t('app', 'Dechargement'),
            'produit' => Yii::t('app', 'Produit'),
            'stock_initiale' => Yii::t('app', 'Stock Initiale'),
            'quantite' => Yii::t('app', 'Quantite'),
            'unit_price'=>Yii::t('app','Unit Price'),
            'currency'=>Yii::t('app','Currency'),
            'index_debut' => Yii::t('app', 'Index Debut'),
            'index_fin' => Yii::t('app', 'Index Fin'),
            'sortie_pompe' => Yii::t('app', 'Sortie Pompe'),
            'quantite_finale' => Yii::t('app', 'Quantite Finale'),
            'station' => Yii::t('app', 'Station'),
            'tank' => Yii::t('app', 'Tank'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Dechargement0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDechargement0()
    {
        return $this->hasOne(Dechargement::className(), ['no' => 'dechargement']);
    }
}
