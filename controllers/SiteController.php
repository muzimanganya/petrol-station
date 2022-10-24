<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\SqlDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $chartData = [];
        // $chartData['cols'] = [
        //     ['label' => 'Date', 'type' => 'string'], 
        //     ['label' => 'Income', 'type' => 'number']
        // ];

        // $chartData['rows'] = [];
        // return $this->render('index', ['chartData'=>$chartData]);

        $sql = "select station.nom as station,sum(rusd) as rusd,sum(rcdf) as rcdf,sum(usdcredit) as usdcredit,sum(cdfcredit) as cdfcredit ,sum(dusd) as dusd,sum(dcdf) as dcdf,sum(pusd) as pusd,sum(pcdf) as pcdf from(
            SELECT station,sum(usd) as rusd,sum(cdf) as rcdf,sum(case when currency='USD' then receivable end) as usdcredit,sum(case when currency='CDF' then receivable end) as cdfcredit,0 as dusd,0 as dcdf,0 as pusd,0 as pcdf FROM petrol.retail group by station union
            SELECT station,sum(usd) as rusd,sum(cdf) as rcdf,sum(case when currency='USD' then receivable end) as usdcredit,sum(case when currency='CDF' then receivable end) as cdfcredit,0 as dusd,0 as dcdf,0 as pusd,0 as pcdf FROM petrol.supply group by station union
            SELECT station,0 as rusd, 0 as rcdf,0 as usdcredit,0 as cdfcredit, sum(case when currency='USD' then prix*quantite end) as dusd,sum(case when currency='CDF' then prix*quantite end) as dcdf,sum(case when currency='USD' then payable end) as pusd,sum(case when currency='USD' then payable end) as pusd from petrol.depense group by station)t, station where station.id=t.station group by t.station
            ";
        $count=Yii::$app->db->createCommand("SELECT COUNT(*) from ($sql)t")->queryScalar();


       


             $posts = Yii::$app->db->createCommand('SELECT s.nom as station,ifnull(sum(case when produit=2 then capacity end),0) as ago,ifnull(sum(case when produit=3 then capacity end),0) as pms FROM petrol.tank t join petrol.station s on t.station=s.id group by s.nom')
            ->queryAll();

            // var_dump($posts);
            // die;
       
        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'totalCount'=>$count,
        ]);

      
        

        return $this->render('index',[
            'dataProvider'=>$dataProvider,
            'chartdataProvider'=>$posts,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
