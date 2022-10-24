<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "wallet".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $balance_usd
 * @property float|null $balance_cdf
 * @property int|null $station
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Wallet extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['balance_usd', 'balance_cdf'], 'number'],
            [['is_super','station','created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'balance_usd' => Yii::t('app', 'Balance Usd'),
            'balance_cdf' => Yii::t('app', 'Balance Cdf'),
            'is_super'=>Yii::t('app','Is Super'),
            'station'=>Yii::t('app','Station'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
