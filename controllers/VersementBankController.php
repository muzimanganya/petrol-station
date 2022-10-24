<?php

namespace app\controllers;

use app\models\VersementBank;
use app\models\VersementBankSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Wallet;
use app\models\Account;
use Yii;
/**
 * VersementBankController implements the CRUD actions for VersementBank model.
 */
class VersementBankController extends Controller
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
     * Lists all VersementBank models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VersementBankSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VersementBank model.
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
     * Creates a new VersementBank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new VersementBank();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->currency = Account::find()->where(['no'=>$model->account])->one()->currency;

                if($model->currency == "usd"){
                    $balance =Wallet::find()->where(['id'=>$model->wallet])->one()->balance_usd;
                    $model->balance = $balance - $model->amount;
                    Yii::$app->db->createCommand("UPDATE wallet SET balance_usd= $model->balance where id=$model->wallet")->execute();
                    $model->usd= $model->amount;
                    $model->cdf= 0;
                
                }
                else{
                     $balance = Wallet::find()->where(['id'=>$model->wallet])->one()->balance_cdf;
                     $model->balance= $balance - $model->amount;
                     Yii::$app->db->createCommand("UPDATE wallet SET balance_cdf= $model->balance where id=$model->wallet")->execute();
                     $model->usd=0;
                     $model->cdf=$model->amount;
                }
                Yii::$app->db->createCommand("UPDATE account set balance= balance + $model->amount where no=$model->account")->execute();
                

                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VersementBank model.
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
     * Deletes an existing VersementBank model.
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
     * Finds the VersementBank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VersementBank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VersementBank::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
