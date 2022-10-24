<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "margin".
 *
 * @property int $id
 * @property float $margin
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 */
class Margin extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'margin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['margin'], 'required'],
            [['margin'], 'number'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'margin' => Yii::t('app', 'Margin'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
