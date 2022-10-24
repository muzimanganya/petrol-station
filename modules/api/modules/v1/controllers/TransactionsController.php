<?php

namespace app\modules\api\modules\v1\controllers;

use app\modules\api\modules\v1\models\User;
use app\models\Produit;
use app\models\Station;
use app\models\TarificationSearch;
use app\models\Retail;
use app\models\Rate;
use app\models\Tank;
use app\models\Supply;
use yii\rest\Controller;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\ServerErrorHttpException;
use Yii;

class TransactionsController extends Controller
{
	public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];

        return $behaviors;
    }

    public function actionProducts()
    {
        return Produit::find()->select('id,nom')->asArray()->all();
    }
    public function actionStations()
    {
        return Station::find()->select('id,nom')->asArray()->all();
    }
    public function actionPricing()
    {
    	//$user = Yii::$app->user->identity;
       $sql = 'SELECT p.nom as produit,usd_price as usd,cdf_price as cdf FROM tarification t join produit p on t.produit=p.id join station s on t.station=s.id where t.station=:station';
        $tanks = Yii::$app->db->createCommand($sql)
           ->bindValue(':station',Yii::$app->user->id)
                ->queryAll();
                return $tanks;
    }
     public function actionTanks()
    {

       $sql = 'SELECT t.id,concat(t.id," ",s.nom," ",p.nom) as nom FROM tank t join station s on t.station=s.id join produit p on t.produit=p.id';
        $tanks = Yii::$app->db->createCommand($sql)
        		//->bindValue(':station',Yii::$app->user->id)
                ->queryAll();
       
        return $tanks;
    }

    public function actionRetails()
    {
        $post = Yii::$app->request->post();
        $success = [];
        $model = new Retail();

        $post = Yii::$app->request->post();
        $success = [];
        $model = new Retail();
      
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
            $model->rate=1;
        }

        if ($this->request->isPost) {
              $model->produit=$post['produit'];
        $model->plaque=$post['plaque'];
        $model->quantite=$post['quantite'];
        $model->prix=$post['prix'];
        $model->usd=$post['usd'];
         $model->cdf=$post['cdf'];
         $model->rate=10;
         $model->tank= Tank::find()->where(['produit'=>$model->produit, 'station'=>$model->station])->one()->id;
         //$model->tank=$post['tank'];
         // $model->created_by=$post['user'];
         // $model->updated_by=$post['user'];
         //$updated_by=$post['user'];
                if($model->save(false)){
                	
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
                    Yii::$app->db->createCommand("UPDATE tank SET capacity=capacity-$model->quantite WHERE id=$model->tank")->execute();
                    // Yii::$app->db->createCommand(" UPDATE wallet set usd_balance=usd_balance+$model->usd, cdf_balance=cdf_balance+$model->cdf where id= $user->wallet")->execute();
                    if($model->payment_mode == 'bank' && $model->account == null){

                        echo"<scripts>alert('Account must have account number')</scripts>";
                    }
                     $success['success'] = true;
        $success['message'] = Yii::t('app', 'Operation Saved Successfully!');
        			$success['data']=$model;
        return  $success; 
                }
               
          
        } else {
            $model->loadDefaultValues();
        }




        
       

        

       // Yii::error($model->errors);

        $success['success'] = false;
        $success['message'] = Yii::t('app', 'Operation Failed!');
        return  $success;
    }

    public function actionGros()
    {
        $post = Yii::$app->request->post();
        $success = [];
        
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
            $model->rate=1;
        }

        if ($this->request->isPost) {
              $model->produit=$post['produit'];
        $model->nom_client=$post['nom_client'];
        $model->telephone=$post['telephone'];
        $model->quantite=$post['quantite'];
        $model->prix=$post['prix'];
        $model->usd=$post['usd'];
         $model->cdf=$post['cdf'];
         $model->rate=10;
         //$model->station=$post['station'];
        $model->tank= Tank::find()->where(['produit'=>$model->produit, 'station'=>$model->station])->one()->id;
         // $model->created_by=$post['user'];
         // $model->updated_by=$post['user'];
         //$updated_by=$post['user'];
                if($model->save(false)){
                	
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
                    Yii::$app->db->createCommand("UPDATE tank SET capacity=capacity-$model->quantite WHERE id=$model->tank")->execute();
                    // Yii::$app->db->createCommand(" UPDATE wallet set usd_balance=usd_balance+$model->usd, cdf_balance=cdf_balance+$model->cdf where id= $user->wallet")->execute();
                    if($model->payment_mode == 'bank' && $model->account == null){

                        echo"<scripts>alert('Account must have account number')</scripts>";
                    }
                     $success['success'] = true;
        $success['message'] = Yii::t('app', 'Operation Saved Successfully!');
        			$success['data']=$model;
        return  $success; 
                }
               
          
        } else {
            $model->loadDefaultValues();
        } 

       // Yii::error($model->errors);

        $success['success'] = false;
        $success['message'] = Yii::t('app', 'Operation Failed!');
        return  $success;
    }

    
}
