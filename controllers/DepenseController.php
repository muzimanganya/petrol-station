<?php

namespace app\controllers;

use app\models\Depense;
use app\models\Dechargement;
use app\models\GrandStockUpdates;
use app\models\Margin;
use app\models\Rate;
use app\models\DepenseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * DepenseController implements the CRUD actions for Depense model.
 */
class DepenseController extends Controller
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
     * Lists all Depense models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DepenseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Depense model.
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
     * Creates a new Depense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($no=null,$transaction=null,$id=null)
    {
        $model = new Depense();
        $user = Yii::$app->user->identity;
       // $model->station=$user->station;
        
        if(!is_null($no)){
            $model->dechargemt= $no;
            $model->transaction=$transaction;
        }
        if(!is_null($id)){
            $model->distribution= $id;
            $model->transaction=$transaction;
            $model->dechargemt=$no;
        }
        $model->rate= Rate::find()->orderBy(['id'=>SORT_DESC])->one()->rate;
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save(false)) {
                if(!is_null($model->dechargemt) &&  is_null($model->distribution)){

                    $margin= Margin::find()->orderBy(['id'=>SORT_DESC])->one();
                    if($margin){
                        $grandStock= GrandStockUpdates::find()->where(['dechargement'=>$model->dechargemt])->one();
    
                        Yii::$app->db->createCommand("UPDATE grand_stock_updates set new_selling_price=(((($grandStock->new_quantity*$grandStock->new_buying_price)+($model->quantite*$model->prix))/$grandStock->new_quantity)+(((($grandStock->new_quantity*$grandStock->new_buying_price)+($model->quantite*$model->prix))/$grandStock->new_quantity)*$margin->margin)) where id= $grandStock->id")->execute();
                    }
                //   set default margin=1
                   else{
                        Yii::$app->db->createCommand("UPDATE grand_stock_updates set new_selling_price=(((($grandStock->new_quantity*$grandStock->new_buying_price)+($model->quantite*$model->prix))/$grandStock->new_quantity)+(((($grandStock->new_quantity*$grandStock->new_buying_price)+($model->quantite*$model->prix))/$grandStock->new_quantity)*1)) where id= $grandStock->id ")->execute();
                
                    }


                //   setting selling price for arrivals
                  
                  $produit= Dechargement::find()->where(['no'=>$model->dechargemt])->one()->produit;

                  $grandStock= GrandStockUpdates::find()->where(['produit'=>$produit])->orderBy(['id'=>SORT_DESC])->one();

                  Yii::$app->db->createCommand("UPDATE grand_stock set selling_price= (($grandStock->old_quantity*$grandStock->old_selling_price)+($grandStock->new_quantity*$grandStock->new_selling_price))/($grandStock->new_quantity + $grandStock->old_quantity) where produit=$produit")->execute();
                   return $this->redirect(['/dechargement/view', 'no' => $model->dechargemt]); 
                }
                else if(!is_null($model->distribution)){
                    return $this->redirect(['/distribution/view', 'id' => $model->distribution]); 
                }
                else{
                   return $this->redirect(['/depense/view', 'id' => $model->id]); 
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
     * Updates an existing Depense model.
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
     * Deletes an existing Depense model.
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
     * Finds the Depense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Depense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Depense::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
