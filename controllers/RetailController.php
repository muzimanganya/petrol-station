<?php

namespace app\controllers;

use app\models\Retail;
use app\models\Rate;
use app\models\RetailSearch;
use app\models\Tarification;
use app\models\Tank;
use app\models\TarificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use Yii;

/**
 * RetailController implements the CRUD actions for Retail model.
 */
class RetailController extends Controller
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
     * Lists all Retail models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RetailSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Retail model.
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
     * Creates a new Retail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Retail();
        $user = Yii::$app->user->identity;
        $user_wallet=$user->wallet;
        $model->station=$user->station;

        

        $params = [':station' => $model->station];
        $sql='SELECT * FROM tarification WHERE station=:station ORDER BY created_at';
        $dataProviderTarification = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => 2,
            'params' => $params,
            'pagination' => [
                'pageSize' => false,
            ],
        ]);
        // var_dump($dataProviderTarification);
        // die;

        $rate=Rate::find()->orderBy(['id'=>SORT_DESC])->limit(1)->one();

        if($rate){
             $model->rate = $rate->rate;
        }
        else{
            $model->rate=0;
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->tank= Tank::find()->where(['produit'=>$model->produit, 'station'=>$model->station])->one()->id;
                
                if($model->payment_mode != 'receivable'){
                    Yii::$app->db->createCommand("UPDATE wallet SET balance_usd=balance_usd+$model->usd , balance_cdf=balance_cdf + $model->cdf ,updated_at=$model->updated_at,updated_by=$model->updated_by WHERE id=$user_wallet")->execute(); 
                }
                else{
                    if($model->usd){
                        $model->receivable=$model->usd;
                        $model->currency='usd';
                    }
                    
                    else{
                        $model->receivable=$model->cdf;
                        $model->currency='cdf';
                    }
                }

                if($model->save(false)){

                   
                    Yii::$app->db->createCommand("UPDATE tank SET capacity=capacity-$model->quantite WHERE id=$model->tank")->execute();
                    // Yii::$app->db->createCommand(" UPDATE wallet set usd_balance=usd_balance+$model->usd, cdf_balance=cdf_balance+$model->cdf where id= $user->wallet")->execute();
                    if($model->payment_mode == 'bank' && $model->account == null){

                        echo"<scripts>alert('Account must have account number')</scripts>";
                    }
                    return $this->redirect(['view', 'id' => $model->id]); 
                }
               
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'dataProviderTarification'=>$dataProviderTarification,
        ]);
    }

    /**
     * Updates an existing Retail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // $user = Yii::$app->user->identity;
        // $user_wallet=$user->wallet;
        // $model->station=$user->station;

        $searchModelTarification = new TarificationSearch();
        $dataProviderTarification = $searchModelTarification->search($this->request->queryParams);
        $dataProviderTarification->query->andWhere(['station'=>$model->station]);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dataProviderTarification'=>$dataProviderTarification,
        ]);
    }

    /**
     * Deletes an existing Retail model.
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
     * Finds the Retail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Retail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Retail::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
