<?php

namespace app\models;
use app\traits\AuditTrailsTrait;

use Yii;

/**
 * This is the model class for table "dechargement".
 *
 * @property int $no
 * @property int $produit
 * @property float|null $unit_price
 * @property string $currency
 * @property float $quantite
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Depense[] $depenses
 * @property Distribution[] $distributions
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
            [['produit', 'currency', 'quantite'], 'required'],
            [['produit', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['unit_price', 'quantite'], 'number'],
            [['currency'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no' => Yii::t('app', 'No'),
            'produit' => Yii::t('app', 'Produit'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'currency' => Yii::t('app', 'Currency'),
            'quantite' => Yii::t('app', 'Quantite'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
     * Gets query for [[Distributions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistributions()
    {
        return $this->hasMany(Distribution::className(), ['dechargement' => 'no']);
    }
}
