<?php

namespace app\controllers;

use app\models\VersementWallet;
use app\models\Wallet;
use app\models\VersementWalletSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Yii;

/**
 * VersementWalletController implements the CRUD actions for VersementWallet model.
 */
class VersementWalletController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all VersementWallet models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VersementWalletSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VersementWallet model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VersementWallet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new VersementWallet();

        $user = Yii::$app->user->identity;
        $wallet = $user->wallet;
        $super= Wallet::find()->where(['id'=>$wallet])->one()->is_super;
        $model->wallet_to= $user->wallet;
        $to=0;
        
        // var_dump($super);
        if($super == 0){
          echo "<script>alert('tu n'es pas super utilisateur');</script>";
          return $this->redirect(['index']);
            // echo"<script>alert('');</script>";
        }
        else{
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {

                    if($model->currency == "usd"){
                        $model->balance_from= Wallet::find()->where(['id'=>$model->wallet_from])->one()->balance_usd - $model->amount; 
                        $model->balance_to = Wallet::find()->where(['id'=>$model->wallet_to])->one()->balance_usd + $model->amount;
                        $to=Wallet::find()->where(['id'=>$model->wallet_to])->one()->balance_usd + $model->amount;
                        $model->usd=$model->amount;
                        $model->cdf=0;
                    }
                    else{
                        $model->balance_from= Wallet::find()->where(['id'=>$model->wallet_from])->one()->balance_cdf - $model->amount; 
                        $model->balance_to = Wallet::find()->where(['id'=>$model->wallet_to])->one()->balance_cdf + $model->amount;
                        $to=Wallet::find()->where(['id'=>$model->wallet_to])->one()->balance_cdf + $model->amount;
                        $model->usd=0;
                        $model->cdf=$model->amount;
                     
                    }
                   
                    // $model->balance_from= Wallet::find()->where(['id'=>$model->wallet_from])->one()->balance - $; 
                    

                    if($model->save()){
                        if($model->currency == "usd"){
                            Yii::$app->db->createCommand("UPDATE wallet set balance_usd =$model->balance_from where id=$model->wallet_from")->execute();
                            Yii::$app->db->createCommand("UPDATE wallet set balance_usd = $to where id= $model->wallet_to")->execute();

                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                        else{
                            Yii::$app->db->createCommand("UPDATE wallet set balance_cdf =$model->balance_from where id=$model->wallet_from")->execute();
                            Yii::$app->db->createCommand("UPDATE wallet set balance_cdf = $to where id= $model->wallet_to")->execute();

                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                        
                        
                    }
                
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        }
        
    }

    /**
     * Updates an existing VersementWallet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VersementWallet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VersementWallet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VersementWallet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VersementWallet::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
