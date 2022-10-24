<?php

namespace app\controllers;

use app\models\Supply;
use app\models\SupplySearch;
use app\models\Rate;
use app\models\Tarification;
use app\models\TarificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Tank;


use Yii;
/**
 * SupplyController implements the CRUD actions for Supply model.
 */
class SupplyController extends Controller
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
     * Lists all Supply models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SupplySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Supply model.
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
     * Creates a new Supply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Supply();
        $user = Yii::$app->user->identity;
        $user_wallet=$user->wallet;
        $model->station=$user->station;

        $searchModelTarification = new TarificationSearch();
        $dataProviderTarification = $searchModelTarification->search($this->request->queryParams);
        $dataProviderTarification->query->andWhere(['station'=>$model->station]);
  

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
                    Yii::$app->db->createCommand("UPDATE wallet SET balance_usd=balance_usd+$model->usd , balance_cdf=balance_cdf + $model->cdf WHERE id=$user_wallet")->execute(); 
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
                    // Yii::$app->db->createCommand("UPDATE wallet SET balance_usd=balance_usd+$model->usd , balance_cdf=balance_cdf+$model->cdf,updated_at=$model->updated_at,updated_by=$model->updated_by WHERE id=$user_wallet")->execute();
                    Yii::$app->db->createCommand("UPDATE tank SET capacity=capacity-$model->quantite WHERE id=$model->tank")->execute();
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
     * Updates an existing Supply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
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
     * Deletes an existing Supply model.
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
     * Finds the Supply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Supply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supply::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
