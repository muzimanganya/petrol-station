<?php

namespace app\controllers;

use app\models\Distribution;
use app\models\GrandStock;
use app\models\Dechargement;
use app\models\DechargementSearch;
use app\models\DepenseSearch;
use app\models\Tank;
use app\models\DistributionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * DistributionController implements the CRUD actions for Distribution model.
 */
class DistributionController extends Controller
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
     * Lists all Distribution models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DistributionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Distribution model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $searchModel = new DepenseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['distribution'=>$id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Distribution model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Distribution();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                 $dechargement= Dechargement::find()->where(['produit'=>$model->produit])->orderBy('no', SORT_DESC)->one();
                
                 $model->unit_price= GrandStock::find()->where(['produit'=>$model->produit])->one()->selling_price;
                 $model->currency= GrandStock::find()->where(['produit'=>$model->produit])->one()->currency;
                 
                 $model->stock_initiale= Tank::find()->where(['produit'=>$model->produit,'station'=>$model->station])->one()->capacity;
                 $model->tank=Tank::find()->where(['produit'=>$model->produit,'station'=>$model->station])->one()->id;

                 $model->quantite_finale= $model->stock_initiale + $model->quantite;
                

                 $id= Distribution::find()->where(['tank'=>$model->tank])->orderBy(['id'=>SORT_DESC])->one();
                 if($id){
                     $id=$id->id;
                     $index_debut=Distribution::find()->where(['id'=>$id])->one()->index_debut;
                     Yii::$app->db->createCommand("UPDATE distribution set index_fin=$model->index_debut, sortie_pompe=$model->index_debut - $index_debut where id=$id")->execute();      
                 }

                $model->station=Tank::find()->where(['id'=>$model->tank])->one()->station;
                 
                if($dechargement){
                 
                    $model->dechargement=$dechargement->no;

                    if($model->save()){
                        Yii::$app->db->createCommand("UPDATE tank set capacity=$model->quantite_finale where id=$model->tank")->execute();
                        Yii::$app->db->createCommand("UPDATE grand_stock set quantite=quantite- $model->quantite where produit=$model->produit")->execute();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                 else{

                    $searchModel = new DistributionSearch();
                    $dataProvider = $searchModel->search($this->request->queryParams);

                    echo"<script>alert('aucune déchargement trouvée')</script>";
            
                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                    
                 }

                
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    // }
    }

    /**
     * Updates an existing Distribution model.
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
     * Deletes an existing Distribution model.
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
     * Finds the Distribution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Distribution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Distribution::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
