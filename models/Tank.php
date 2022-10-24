<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "tank".
 *
 * @property int $id
 * @property float $capacity
 * @property string $location
 * @property int $produit
 * @property int $station
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Dechargement[] $dechargements
 * @property Produit $produit0
 * @property Retail[] $retails
 * @property Station $station0
 * @property Supply[] $supplies
 */
class Tank extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['capacity', 'location', 'produit'], 'required'],
            [['capacity'], 'number'],
            [['produit', 'station', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['location'], 'string', 'max' => 100],
            [['produit', 'station'], 'unique', 'targetAttribute' => ['produit', 'station']],
            [['produit'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['produit' => 'id']],
            [['station'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['station' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'capacity' => Yii::t('app', 'Capacity'),
            'location' => Yii::t('app', 'Location'),
            'produit' => Yii::t('app', 'Produit'),
            'station' => Yii::t('app', 'Station'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Dechargements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDechargements()
    {
        return $this->hasMany(Dechargement::className(), ['tank' => 'id']);
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
     * Gets query for [[Retails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetails()
    {
        return $this->hasMany(Retail::className(), ['tank' => 'id']);
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

    /**
     * Gets query for [[Supplies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplies()
    {
        return $this->hasMany(Supply::className(), ['tank' => 'id']);
    }
}
