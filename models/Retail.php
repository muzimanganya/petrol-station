<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "retail".
 *
 * @property int $produit
 * @property string $plaque
 * @property float $quantite
 * @property float $prix
 * @property string $usd
 * @property float|null $cdf
 * @property int $id
 * @property int $station
 * @property int $tank
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property string|null $payment_mode
 * @property string|null $account
 * @property float|null $receivable
 *
 * @property Produit $produit0
 * @property Station $station0
 * @property Tank $tank0
 */
class Retail extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'retail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produit', 'plaque', 'quantite', 'prix', 'usd','cdf','rate','station'], 'required'],
            [['produit', 'id', 'station', 'tank', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['quantite', 'prix', 'cdf','usd', 'receivable'], 'number'],
            [['plaque'], 'string', 'max' => 100],
            [['usd'], 'string', 'max' => 15],
            [['payment_mode', 'account','currency'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['station'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['station' => 'id']],
            [['produit'], 'exist', 'skipOnError' => true, 'targetClass' => Produit::className(), 'targetAttribute' => ['produit' => 'id']],
            [['tank'], 'exist', 'skipOnError' => true, 'targetClass' => Tank::className(), 'targetAttribute' => ['tank' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'produit' => Yii::t('app', 'Produit'),
            'plaque' => Yii::t('app', 'Plaque'),
            'quantite' => Yii::t('app', 'Quantite'),
            'prix' => Yii::t('app', 'Prix'),
            'usd' => Yii::t('app', 'Usd'),
            'cdf' => Yii::t('app', 'FC'),
            'rate' => Yii::t('app', 'Rate'),
            'id' => Yii::t('app', 'ID'),
            'station' => Yii::t('app', 'Station'),
            'tank' => Yii::t('app', 'Tank'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'payment_mode' => Yii::t('app', 'Payment Mode'),
            'account' => Yii::t('app', 'Account'),
            'receivable' => Yii::t('app', 'Receivable'),
            'currency'=>Yii::t('app','Receivable Currency'),
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

    /**
     * Gets query for [[Tank0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTank0()
    {
        return $this->hasOne(Tank::className(), ['id' => 'tank']);
    }
}
