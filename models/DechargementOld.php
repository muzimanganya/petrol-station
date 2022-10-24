<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "dechargement".
 *
 * @property int $no
 * @property float $stock_initiale
 * @property float $quantite
 * @property float $index_debut
 * @property float $index_fin
 * @property float $sortie_pompe
 * @property float $quantite_finale
 * @property int $tank
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property float|null $unit_price
 * @property float|null $selling_price
 * @property float|null $margin
 * @property int|null $station
 * @property string|null $payment_mode
 * @property string|null $account
 * @property float|null $payable
 *
 * @property Depense[] $depenses
 * @property Tank $tank0
 */
class Dechargement extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dechargement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantite','unit_price', 'tank','index_debut','currency'], 'required'],
            [['stock_initiale', 'quantite', 'index_debut', 'index_fin','sortie_pompe', 'quantite_finale', 'unit_price', 'selling_price', 'margin', 'payable'], 'number'],
            [['tank', 'created_at', 'created_by', 'updated_at', 'updated_by', 'station'], 'integer'],
            [['payment_mode', 'account','currency'], 'string', 'max' => 45],
            [['tank'], 'exist', 'skipOnError' => true, 'targetClass' => Tank::className(), 'targetAttribute' => ['tank' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no' => Yii::t('app', 'No'),
            'stock_initiale' => Yii::t('app', 'Stock Initiale'),
            'quantite' => Yii::t('app', 'Quantite'),
            'index_debut' => Yii::t('app', 'Index Debut'),
            'index_fin' => Yii::t('app', 'Index Fin'),
            'sortie_pompe' => Yii::t('app', 'Sortie Pompe'),
            'quantite_finale' => Yii::t('app', 'Quantite Finale'),
            'tank' => Yii::t('app', 'Tank'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'currency' => Yii::t('app', 'Currency'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'margin' => Yii::t('app', 'Margin'),
            'station' => Yii::t('app', 'Station'),
            'payment_mode' => Yii::t('app', 'Payment Mode'),
            'account' => Yii::t('app', 'Account'),
            'payable' => Yii::t('app', 'Payable'),
        ];
    }

    /**
     * Gets query for [[Depenses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepenses()
    {
        return $this->hasMany(Depense::className(), ['dechargemt' => 'no']);
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
