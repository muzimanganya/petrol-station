<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "versement_wallet".
 *
 * @property int $id
 * @property int|null $wallet_from
 * @property int|null $wallet_to
 * @property float|null $amount
 * @property string|null $currency
 * @property float|null $balance_from
 * @property float|null $balance_to
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class VersementWallet extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'versement_wallet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wallet_from','amount','currency'], 'required'],
            [['wallet_from', 'wallet_to','usd','cdf', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['amount', 'balance_from', 'balance_to'], 'number'],
            [['currency'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'wallet_from' => Yii::t('app', 'Wallet From'),
            'wallet_to' => Yii::t('app', 'Wallet To'),
            'amount' => Yii::t('app', 'Amount'),
            'currency' => Yii::t('app', 'Currency'),
            'usd' => Yii::t('app', 'USD'),
            'cdf' => Yii::t('app', 'CDF'),
            'balance_from' => Yii::t('app', 'Balance From'),
            'balance_to' => Yii::t('app', 'Balance To'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
