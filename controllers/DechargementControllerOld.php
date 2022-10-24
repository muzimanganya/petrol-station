<?php

namespace app\controllers;

use app\models\Dechargement;
use app\models\Tank;
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
        $user = Yii::$app->user->identity;
        $model->station=$user->station;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->stock_initiale= Tank::find()->where(['id'=>$model->tank])->one()->capacity;
                $model->quantite_finale= $model->stock_initiale + $model->quantite;
                
                $no= Dechargement::find()->where(['tank'=>$model->tank])->orderBy(['no'=>SORT_DESC])->one();
                if($no){
                    $no=$no->no;
                    $index_debut=Dechargement::find()->where(['no'=>$no])->one()->index_debut;
                    Yii::$app->db->createCommand("UPDATE dechargement set index_fin=$model->index_debut, sortie_pompe=$model->index_debut - $index_debut where no=$no")->execute();      
                }
                
                    Yii::$app->db->createCommand("UPDATE tank set capacity=$model->quantite_finale where id=$model->tank")->execute();

                    $previous = GrandStock::find()->where(['produit'=>$model->produit])->one();
                    if($previous){
                        Yii::$app->db->createCommand("INSERT into grand_stock (produit,quantite,buying_price,selling_price,currency,created_at,created_by,updated_at,updated_by) values ($model->produit,$model->quantite,$model->buying_price,$model->selling_price,$model->created_at,$model->created_by,$model->updated_at,$model->updated_by)
                        ")->execute();
                    }
                    else{
                        Yii::$app->db->createCommand("UPDATE grand_stock set quantite=$model->quantite,buying_price=$model->unit_price ,created_at= $model->created_at,created_by=$model->created_by,updated_at=$model->updatd_at,updated_by=$model->updatd_by where produit=$model->produit
                        ")->execute();
                    }
                    // Yii::$app->db->createCommand("IF Not Exists(select * from grand_stock where product=$model->product)
                    // Begin
                    // insert into grand_stock (produit,quantite,buying_price,selling_price,created_at,created_by,updated_at,updated_by) values ($model->produit,$model->quantite,$model->buying_price,$model->selling_price,$model->created_at,$model->created_by,$model->updated_at,$model->updated_by)
                    // End
                    // else
                    // UPDATE grand_stock set quantite=$model->quantite,buying_price=$model->unit_price ,created_at= $model->created_at,created_by=$model->created_by,updated_at=$model->updatd_at,updated_by=$model->updatd_by where produit=$model->produit
                    // ")->execute();
                if($model->save(false)){
                    

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
