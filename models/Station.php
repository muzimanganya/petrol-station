<?php

namespace app\models;

use Yii;
use app\traits\AuditTrailsTrait;

/**
 * This is the model class for table "station".
 *
 * @property int $id
 * @property string $nom
 * @property string $address
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Produit[] $produits
 * @property RecordJournalier[] $recordJournaliers
 * @property Retail[] $retails
 * @property Supply[] $supplies
 * @property Tank[] $tanks
 */
class Station extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'station';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['nom'], 'string', 'max' => 55],
            [['address'], 'string', 'max' => 155],
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
            'address' => Yii::t('app', 'Address'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Produits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduits()
    {
        return $this->hasMany(Produit::className(), ['id' => 'produit'])->viaTable('tank', ['station' => 'id']);
    }

    /**
     * Gets query for [[RecordJournaliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecordJournaliers()
    {
        return $this->hasMany(RecordJournalier::className(), ['station' => 'id']);
    }

    /**
     * Gets query for [[Retails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetails()
    {
        return $this->hasMany(Retail::className(), ['station' => 'id']);
    }

    /**
     * Gets query for [[Supplies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplies()
    {
        return $this->hasMany(Supply::className(), ['station' => 'id']);
    }

    /**
     * Gets query for [[Tanks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTanks()
    {
        return $this->hasMany(Tank::className(), ['station' => 'id']);
    }
}
