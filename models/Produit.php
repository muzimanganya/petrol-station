<?php

namespace app\models;

use Yii;
use app\traits\AuditTrailsTrait;

/**
 * This is the model class for table "produit".
 *
 * @property int $id
 * @property string $nom
 * @property int $is_active
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property RecordJournalier[] $recordJournaliers
 * @property Retail[] $retails
 * @property Station[] $stations
 * @property Supply[] $supplies
 * @property Tank[] $tanks
 * @property Tarification[] $tarifications
 */
class Produit extends \yii\db\ActiveRecord
{
   use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom'], 'required'],
            [['is_active', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['nom'], 'string', 'max' => 100],
            [['nom'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nom' => Yii::t('app', 'Nom'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[RecordJournaliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecordJournaliers()
    {
        return $this->hasMany(RecordJournalier::className(), ['produit' => 'id']);
    }

    /**
     * Gets query for [[Retails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetails()
    {
        return $this->hasMany(Retail::className(), ['produit' => 'id']);
    }

    /**
     * Gets query for [[Stations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStations()
    {
        return $this->hasMany(Station::className(), ['id' => 'station'])->viaTable('tank', ['produit' => 'id']);
    }

    /**
     * Gets query for [[Supplies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplies()
    {
        return $this->hasMany(Supply::className(), ['produit' => 'id']);
    }

    /**
     * Gets query for [[Tanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTanks()
    {
        return $this->hasMany(Tank::className(), ['produit' => 'id']);
    }

    /**
     * Gets query for [[Tarifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTarifications()
    {
        return $this->hasMany(Tarification::className(), ['produit' => 'id']);
    }
}
