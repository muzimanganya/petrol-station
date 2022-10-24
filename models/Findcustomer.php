<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Findcustomer extends Model
{
   
    
  
    public $customer;
    
    
    public function rules()
    {
        return [
            [['customer'], 'required'],
            [['customer'],'string','max'=>166 ],
           // [['invoice'], 'exist', 'skipOnError' => false, 'targetClass' => Transactions::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'customer' => Yii::t('app', 'customer'),
         ];   
    }
    
    
}
