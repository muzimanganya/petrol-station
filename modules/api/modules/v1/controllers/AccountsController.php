<?php



namespace app\modules\api\modules\v1\controllers;

use yii\rest\ActiveController;

use app\modules\api\modules\v1\models\User;
use Yii;
//use yii\rest\Controller;

/**
 * User Mgt controller for the `api` module
 */
class AccountsController extends ActiveController
{
    public $modelClass = 'app\models\Staff';

    public function actions()
    {
        $actions = parent::actions();

        // disable the  actions
        unset($actions['delete'], $actions['create'], $actions['index'], $actions['view']);

        return $actions;
    }

    public function actionLogin()
    {
        $post = Yii::$app->request->post();
        $success = ['token' => ''];

        Yii::error($post);
        $model = User::find()->where(['username' => $post['username']])->one();
        if (empty($model)) {
            $success['success'] = false;
            $success['message'] = Yii::t('app', 'Invalid username or password');
            return $success;
        }

        if (Yii::$app->security->validatePassword($post['password'], $model->password)) {
            $model->generateToken();

            $success['success'] = true;
            $success['message'] = Yii::t('app', 'Login was successful!');
            $success['token'] = $model->token_id;
            $success['user']= $model->id;
                        return $success;
        } else {
            $success['success'] = false;
            $success['message'] = Yii::t('app', 'Invalid username or password');
            return $success;
        }
    }

    public function actionLogout($token)
    {
        \Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
        $user = User::findIdentityByAccessToken($token);
        $success = ['success'=>false, 'message'=>'Could not log out'];
        if ($user) {
            $token = $user->nullToken();

            $success['success'] = true;
            $success['message'] = 'Logged out';
        }
        return $success;
    }

    public function actionChangePassword($username, $old, $new)
    {
        \Yii::$app->response->format = \yii\web\response::FORMAT_JSON;
        $user = User::findByUsername($username);
        $success = ['success'=>false, 'token'=>''];
        if ($user && $user->validatePassword($old)) {
            //change password
            $user->password = $new;
            $user->generateHash();
            $token = $user->nullToken(); //this saves it all so need to call save on previous line

            $success['success'] = true;
            $success['token'] = $token;
        }
        return $success;
    }

    
}
