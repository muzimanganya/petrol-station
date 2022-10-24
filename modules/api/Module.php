<?php

namespace app\modules\api;

use Yii;
use yii\web\Request;
use yii\web\Response;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->setModules([
            'v1' => [
                'class' => 'app\modules\api\modules\v1\Module',
            ],
        ]);

        Yii::configure(Yii::$app, [
            'components' => [
                'request' => [
                    'class' => Request::class,
                    'enableCsrfValidation' => false,
                    'enableCookieValidation' => false,
                    'parsers' => [
                        'application/json' => 'yii\web\JsonParser',
                    ]
                ],
                'response' => [
                    'class' => Response::class,
                    'format' =>  Response::FORMAT_JSON,
                ],
            ]
        ]);

        //Hide information that might help the hackers
        if (function_exists('header_remove')) {
            header_remove('X-Powered-By');
        } else {
            @ini_set('expose_php', 'off');
        }
    }

    public function beforeAction($action)
    {
        $module = $action->controller->module;
        if ((!empty($module) && $module->id == 'api') || $module->module->id == 'api') {
            Yii::$app->user->enableSession = false;
            Yii::$app->user->loginUrl = null;
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        return parent::beforeAction($action);
    }
}
