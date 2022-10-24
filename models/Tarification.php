<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "tarification".
 *
 * @property int $produit
 * @property float $usd_price
 * @property float $cdf_price
 * @property int $station
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 */
class Tarification extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produit', 'usd_price', 'cdf_price'], 'required'],
            [['produit', 'station', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['usd_price', 'cdf_price'], 'number'],
            [['produit', 'usd_price', 'cdf_price', 'station'], 'unique', 'targetAttribute' => ['produit', 'usd_price', 'cdf_price', 'station']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'produit' => Yii::t('app', 'Produit'),
            'usd_price' => Yii::t('app', 'Usd Price'),
            'cdf_price' => Yii::t('app', 'FC Price'),
            'station' => Yii::t('app', 'Station'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
