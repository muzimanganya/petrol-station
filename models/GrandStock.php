<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "grand_stock".
 *
 * @property int $id
 * @property int $produit
 * @property float $quantite
 * @property float $buying_price
 * @property float $selling_price
 * @property string $currency
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 */
class GrandStock extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grand_stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produit', 'quantite', 'buying_price', 'selling_price', 'currency'], 'required'],
            [['produit', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['quantite', 'buying_price', 'selling_price'], 'number'],
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
            'produit' => Yii::t('app', 'Produit'),
            'quantite' => Yii::t('app', 'Quantite'),
            'buying_price' => Yii::t('app', 'Buying Price'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'currency' => Yii::t('app', 'Currency'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
