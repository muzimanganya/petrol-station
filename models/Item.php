<?php

namespace app\models;
// use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "item".
 *
 * @property string $nom
 * @property int|null $is_active
 * @property int|null $created_at
 * @property int|null $created_by
 */
class Item extends \yii\db\ActiveRecord
{
    // use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom'], 'required'],
            [['is_active', 'created_at', 'created_by'], 'integer'],
            [['nom'], 'string', 'max' => 100],
            [['nom'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nom' => Yii::t('app', 'Nom'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }
}
