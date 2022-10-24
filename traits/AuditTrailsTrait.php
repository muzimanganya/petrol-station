<?php

namespace app\traits;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use yii\web\Application;

trait AuditTrailsTrait
{
    public function behaviors()
    {
        $behaviors = [];
        
        //only update user if there is one
        if (Yii::$app instanceof Application){
            $behaviors[] = TimestampBehavior::class;
            $behaviors[] = BlameableBehavior::class;
            
            if($this->hasProperty('business')){
                $behaviors[] = [
                    'class' => AttributeBehavior::class,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => 'business',
                    ],
                    'value' => function ($event) {
                        return Yii::$app->user->identity->business ?? null;
                    },
                ];
            }
        }
        
        return $behaviors;
    }
}
