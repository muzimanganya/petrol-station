<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "grand_stock_updates".
 *
 * @property int $id
 * @property int $produit
 * @property int $dechargement
 * @property float $old_quantity
 * @property float $old_selling_price
 * @property float $old_buying_price
 * @property float $new_quantity
 * @property float $new_buying_price
 * @property float $new_selling_price
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 */
class GrandStockUpdates extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grand_stock_updates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produit', 'dechargement', 'old_quantity','currency', 'old_selling_price', 'old_buying_price', 'new_quantity', 'new_buying_price', 'new_selling_price'], 'required'],
            [['produit', 'dechargement', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['currency'],'string','max'=>45],
            [['old_quantity', 'old_selling_price', 'old_buying_price', 'new_quantity', 'new_buying_price', 'new_selling_price'], 'number'],
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
            'dechargement' => Yii::t('app', 'Dechargement'),
            'old_quantity' => Yii::t('app', 'Old Quantity'),
            'old_selling_price' => Yii::t('app', 'Old Selling Price'),
            'old_buying_price' => Yii::t('app', 'Old Buying Price'),
            'new_quantity' => Yii::t('app', 'New Quantity'),
            'new_buying_price' => Yii::t('app', 'New Buying Price'),
            'new_selling_price' => Yii::t('app', 'New Selling Price'),
            'currency'=>Yii::t('app','Currency'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
