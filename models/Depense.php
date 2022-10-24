<?php

namespace app\models;
use app\traits\AuditTrailsTrait;
use Yii;

/**
 * This is the model class for table "depense".
 *
 * @property int $id
 * @property string $description
 * @property float $quantite
 * @property float $prix
 * @property int $dechargemt
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Dechargement $dechargemt0
 */
class Depense extends \yii\db\ActiveRecord
{
    use AuditTrailsTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'depense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description','prix','currency','observation'], 'required'],
            [['quantite', 'prix'], 'number'],
            [['dechargemt', 'distribution','created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['description'], 'string', 'max' => 100],
            [['observation'], 'safe'],
            [['dechargemt'], 'exist', 'skipOnError' => true, 'targetClass' => Dechargement::className(), 'targetAttribute' => ['dechargemt' => 'no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'quantite' => Yii::t('app', 'Quantite'),
            'prix' => Yii::t('app', 'Prix'),
            'dechargemt' => Yii::t('app', 'Dechargement'),
            'distribution'=>Yii::t('app','Distribution'),
            'cuurency'=>Yii::t('app','Currency'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Dechargemt0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDechargemt0()
    {
        return $this->hasOne(Dechargement::className(), ['no' => 'dechargemt']);
    }
}
