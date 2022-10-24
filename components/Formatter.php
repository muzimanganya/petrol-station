<?php

namespace app\components;

use Yii;
use yii\i18n\Formatter as I18nFormatter;

class Formatter extends I18nFormatter
{
    public function asGender($gender)
    {
        $gender = strtolower($gender);
        return $gender == 'f' ? Yii::t('app', 'Female') : Yii::t('app', 'Male');
    }
}
