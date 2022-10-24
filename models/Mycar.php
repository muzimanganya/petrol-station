<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Mycar extends Model
{
   
    
    public $vehicle;
   
    
    
    public function rules()
    {
        return [
            [['vehicle'], 'required'],
            [['vehicle'],'string','max'=>18 ],
           // [['invoice'], 'exist', 'skipOnError' => false, 'targetClass' => Transactions::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'vehicle' => Yii::t('app', 'Vehicle plateNo or Chasis No'),
         ];   
    }
    
    
}
