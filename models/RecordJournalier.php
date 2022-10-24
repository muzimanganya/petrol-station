<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "record_journalier".
 *
 * @property int $id
 * @property int $index_debut
 * @property int $index_fin
 * @property float $sortie_pompe
 * @property string $date
 * @property int $station
 * @property int $produit
 * @property float $cdf
 * @property float $usd
 * @property float $depense_usd
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Produit $produit0
 * @property Station $station0
 */
class RecordJournalier extends \yii\db\ActiveRecord
{

    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'record_journalier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['index_debut', 'index_fin','date', 'station', 'produit','stock_physique'], 'required'],
            [['index_debut', 'index_fin', 'station', 'produit', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['sortie_pompe', 'cdf','usd', 'depense_usd','stock_physique','credit_montant_usd','quantite'], 'number'],
            [['date'], 'string', 'max' => 15],
            [['produit', 'station', 'date'], 'unique', 'targetAttribute' => ['produit', 'station', 'date']],
            [['station'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['station' => 'id']],
            [['produit'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['produit' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'index_debut' => Yii::t('app', 'Index Debut'),
            'index_fin' => Yii::t('app', 'Index Fin'),
            'sortie_pompe' => Yii::t('app', 'Sortie Pompe'),
            'date' => Yii::t('app', 'Date'),
            'station' => Yii::t('app', 'Station'),
            'produit' => Yii::t('app', 'Produit'),
            'cdf' => Yii::t('app', 'FC'),
            'usd' => Yii::t('app', 'Usd'),
            'depense_usd' => Yii::t('app', 'Depense en USD'),
            'stock_physique'=>Yii::t('app','Stock Physique'),
            'credit_montant_usd'=>Yii::t('app','credit montant en USD'),
            'quantite'=>Yii::t('app','Quantite'),
            // 'dechargemt' => Yii::t('app', 'Dechargement en Usd'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Produit0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduit0()
    {
        return $this->hasOne(Produit::className(), ['id' => 'produit']);
    }

    /**
     * Gets query for [[Station0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStation0()
    {
        return $this->hasOne(Station::className(), ['id' => 'station']);
    }
}
