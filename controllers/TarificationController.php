<?php

namespace app\controllers;

use app\models\Tarification;
use app\models\TarificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * TarificationController implements the CRUD actions for Tarification model.
 */
class TarificationController extends Controller
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
     * Lists all Tarification models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TarificationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tarification model.
     * @param int $produit Produit
     * @param string $usd_price Usd Price
     * @param string $cdf_price Cdf Price
     * @param int $station Station
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($produit, $usd_price, $cdf_price, $station)
    {
        return $this->render('view', [
            'model' => $this->findModel($produit, $usd_price, $cdf_price, $station),
        ]);
    }

    /**
     * Creates a new Tarification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tarification();
        $user = Yii::$app->user->identity;
        // $user_wallet=$user->wallet;
        //$model->station=$user->station;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'produit' => $model->produit, 'usd_price' => $model->usd_price, 'cdf_price' => $model->cdf_price, 'station' => $model->station]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tarification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $produit Produit
     * @param string $usd_price Usd Price
     * @param string $cdf_price Cdf Price
     * @param int $station Station
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($produit, $usd_price, $cdf_price, $station)
    {
        $model = $this->findModel($produit, $usd_price, $cdf_price, $station);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'produit' => $model->produit, 'usd_price' => $model->usd_price, 'cdf_price' => $model->cdf_price, 'station' => $model->station]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tarification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $produit Produit
     * @param string $usd_price Usd Price
     * @param string $cdf_price Cdf Price
     * @param int $station Station
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($produit, $usd_price, $cdf_price, $station)
    {
        $this->findModel($produit, $usd_price, $cdf_price, $station)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tarification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $produit Produit
     * @param string $usd_price Usd Price
     * @param string $cdf_price Cdf Price
     * @param int $station Station
     * @return Tarification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($produit, $usd_price, $cdf_price, $station)
    {
        if (($model = Tarification::findOne(['produit' => $produit, 'usd_price' => $usd_price, 'cdf_price' => $cdf_price, 'station' => $station])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
