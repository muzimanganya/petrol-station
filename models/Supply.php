<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "supply".
 *
 * @property int $id
 * @property int $nom_client
 * @property int $telephone
 * @property float $quantite
 * @property float $prix
 * @property string $usd
 * @property float|null $cdf
 * @property int $tank
 * @property int $produit
 * @property int $station
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property string|null $account
 * @property string|null $payment_mode
 * @property float|null $receivable
 *
 * @property Produit $produit0
 * @property Station $station0
 * @property Tank $tank0
 */
class Supply extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supply';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_client', 'telephone', 'quantite', 'prix','rate','cdf','usd','produit'], 'required'],
            [['telephone', 'tank', 'produit', 'station', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['quantite', 'prix', 'cdf','usd', 'rate','receivable'], 'number'],
            [['account', 'payment_mode','currency'], 'string', 'max' => 45],
            [['nom_client'],'string','max'=>200],
            [['tank'], 'exist', 'skipOnError' => true, 'targetClass' => Tank::className(), 'targetAttribute' => ['tank' => 'id']],
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
            'nom_client' => Yii::t('app', 'Nom Client'),
            'telephone' => Yii::t('app', 'Telephone'),
            'quantite' => Yii::t('app', 'Quantite'),
            'prix' => Yii::t('app', 'Prix'),
            'usd' => Yii::t('app', 'USD'),
            'cdf' => Yii::t('app', 'FC'),
            'rate' => Yii::t('app', 'Rate'),
            'tank' => Yii::t('app', 'Tank'),
            'produit' => Yii::t('app', 'Produit'),
            'station' => Yii::t('app', 'Station'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'account' => Yii::t('app', 'Account'),
            'payment_mode' => Yii::t('app', 'Payment Mode'),
            'receivable' => Yii::t('app', 'Receivable'),
            'currency'=>Yii::t('app','Currency'),
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
