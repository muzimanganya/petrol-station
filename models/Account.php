<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "account".
 *
 * @property string $no
 * @property string|null $bank
 * @property float|null $balance
 * @property string|null $currency
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Account extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no'], 'required'],
            [['balance'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['no'], 'string', 'max' => 15],
            [['bank', 'currency'], 'string', 'max' => 45],
            [['no'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no' => Yii::t('app', 'No'),
            'bank' => Yii::t('app', 'Bank'),
            'balance' => Yii::t('app', 'Balance'),
            'currency' => Yii::t('app', 'Currency'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
