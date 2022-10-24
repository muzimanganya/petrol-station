<?php

namespace app\controllers;

use app\models\Dechargement;
use app\models\GrandStock;
use app\models\Margin;
use app\models\DechargementSearch;
use app\models\DepenseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * DechargementController implements the CRUD actions for Dechargement model.
 */
class DechargementController extends Controller
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
     * Lists all Dechargement models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DechargementSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dechargement model.
     * @param int $no No
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($no)
    {
        $searchModel = new DepenseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['dechargemt'=>$no]);

        return $this->render('view', [
            'model' => $this->findModel($no),
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Dechargement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Dechargement();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                
          $margin= Margin::find()->orderBy(['id'=>SORT_DESC])->one();
                if($model->save()){
                    // Yii::$app->db->createCommand("UPDATE grand_stock set quantite=$model->quantite,buying_price=$model->unit_price ,created_at= $model->created_at,created_by=$model->created_by,updated_at=$model->updated_at,updated_by=$model->updated_by where produit=$model->produit ")->execute();
                   
                    $previous = GrandStock::find()->where(['produit'=>$model->produit])->one();
                    if($previous){

                       $margin= Margin::find()->orderBy(['id'=>SORT_DESC])->one();
                
                       if($margin){
                        Yii::$app->db->createCommand("INSERT INTO grand_stock_updates(produit,dechargement,old_quantity,new_quantity,old_selling_price,old_buying_price,new_buying_price,new_selling_price) VALUES($model->produit,$model->no,$previous->quantite,$model->quantite,$previous->selling_price,$previous->buying_price,$model->unit_price,((($model->quantite*$model->unit_price)+0)/$model->quantite)+(((($model->quantite*$model->unit_price)+0)/$model->quantite)*$margin->margin)) ")->execute();
                   
                       } 

                    //    set margin =1 by default
                       else{

                        Yii::$app->db->createCommand("INSERT INTO grand_stock_updates(produit,dechargement,old_quantity,new_quantity,old_selling_price,old_buying_price,new_buying_price,new_selling_price) VALUES($model->produit,$model->id,$previous->quantite,$model->quantite,$previous->selling_price,$previous->buying_price,$model->unit_price,((($model->quantite*$model->unit_price)+0)/$model->quantite+(((($model->quantite*$model->unit_price)+0)/$model->quantite)*1)) ")->execute();
                   
                       }
                        
                        Yii::$app->db->createCommand("UPDATE grand_stock set quantite=$model->quantite,buying_price=$model->unit_price,selling_price=((($model->quantite*$model->unit_price)+0)/$model->quantite+(((($model->quantite*$model->unit_price)+0)/$model->quantite)*$margin->margin)),currency=$model->currency ,created_at= $model->created_at,created_by=$model->created_by,updated_at=$model->updated_at,updated_by=$model->updated_by where produit=$model->produit
                        ")->execute();
                    }
                    else{
                        Yii::$app->db->createCommand("INSERT into grand_stock (produit,quantite,buying_price,selling_price,currency,created_at,created_by,updated_at,updated_by) values ($model->produit,$model->quantite,$model->unit_price,((($model->quantite*$model->unit_price)+0)/$model->quantite+(((($model->quantite*$model->unit_price)+0)/$model->quantite)*$margin->margin)),'$model->currency',$model->created_at,$model->created_by,$model->updated_at,$model->updated_by
                        ")->execute();
                    }


    
                   return $this->redirect(['view', 'no' => $model->no]);
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
     * Updates an existing Dechargement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $no No
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($no)
    {
        $model = $this->findModel($no);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'no' => $model->no]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dechargement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $no No
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($no)
    {
        $this->findModel($no)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dechargement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $no No
     * @return Dechargement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($no)
    {
        if (($model = Dechargement::findOne(['no' => $no])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
