<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "versement_bank".
 *
 * @property int $id
 * @property int|null $wallet
 * @property string|null $account
 * @property float|null $amount
 * @property string|null $currency
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property float|null $balance
 */
class VersementBank extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'versement_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wallet'], 'required'],
            [['id', 'wallet', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['amount', 'balance','usd','cdf'], 'number'],
            [['account', 'currency'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'wallet' => Yii::t('app', 'Wallet'),
            'account' => Yii::t('app', 'Account'),
            'amount' => Yii::t('app', 'Amount'),
            'currency' => Yii::t('app', 'Currency'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'balance' => Yii::t('app', 'Balance'),
        ];
    }
}
