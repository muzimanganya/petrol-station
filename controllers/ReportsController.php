<?php

namespace app\controllers;

use app\models\DocumentReport;
use app\modules\api\modules\v1\models\Card;
use app\modules\api\modules\v1\models\DocumentType;
use app\modules\api\modules\v1\models\SearchCard;
use yii\data\SqlDataProvider;
use yii\base\DynamicModel;
use app\models\Rate;
use Yii;

class ReportsController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $model = new \app\models\FindReport();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                return $this->redirect([$model->report, 'start' => $model->start, 'end' => $model->end, 'reference' => $model->reference]);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionDailySales($start,$end)
    {
        
        return $this->render('daily-sales', [
           'start'=>$start,
            'end'=>$end,
        ]);
    }


    public function actionDechargement($start,$end){

        $sql= "SELECT date(from_unixTime(created_at)) as _date,quantite,sum(case when currency='USD' then unit_price*quantite end) as dusd,sum(case when currency='CDF' then unit_price*quantite end) as dcdf from dechargement where date(from_unixTime(created_at)) between :start and :end GROUP BY date(from_unixTime(created_at)),currency,quantite";
        $params=[':start'=>$start,':end'=>$end];

        $count=Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('dechargement',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }

    public function actionRapportJournalier($start,$end){

        $sql= "SELECT date,station.nom as station,index_debut,index_fin,sortie_pompe,usd,cdf,depense_usd,credit_montant_usd,quantite,credit_montant_usd *quantite as total_credit,stock_physique from record_journalier, station where date between :start and :end and station.id=record_journalier.station";
        $params=[':start'=>$start,':end'=>$end];

        $count=Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('rapport-journalier',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }
    
    public function actionDepense($start,$end){

        $sql= "SELECT date(from_unixTime(created_at)) as _date,station,sum(case when currency='USD' then prix*quantite end) as dusd,sum(case when currency='CDF' then prix*quantite end) as dcdf from depense where date(from_unixTime(created_at)) between :start and :end GROUP BY date(from_unixTime(created_at)),station";
        $params=[':start'=>$start,':end'=>$end];

        $count=Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('depense',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    } 
    public function actionTank($start,$end){

        $sql= "SELECT _date,station,tank,sum(little_in) as little_in ,sum(little_out) as little_out from (
                        SELECT date(from_unixTime(created_at)) as _date,station,tank,quantite as little_in,0 as little_out from distribution
                  UNION SELECT date(from_unixTime(created_at)) as _date,station,tank,0 as little_in, quantite as little_out from retail
                  UNION SELECT date(from_unixTime(created_at)) as _date,station,tank,0 as little_in, quantite as little_out from supply) t
                  
                   where _date between :start and :end GROUP BY _date,station,tank";
        $params=[':start'=>$start,':end'=>$end];

        $count=Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('tank',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }

    public function actionBankTransactions($start,$end){

       

        $sql="SELECT date(from_unixTime(b.created_at)) as _date, w.name as _from,sum(b.cdf) as CDF,sum(b.USD) as USD from versement_bank b,wallet w where w.id= wallet and date(from_unixTime(b.created_at)) between :start and :end GROUP BY date(from_unixTime(b.created_at)), w.name";
        $params=[':start'=>$start,':end'=>$end];

        $count = Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('bank-transactions',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }

    

    public function actionWalletTransactions($start,$end){

        $sql="SELECT date(from_unixTime(v.created_at)) as _date, _from.name as _from,_to.name as _to,sum(v.usd) as USD,sum(v.cdf) as CDF from versement_wallet v,wallet _from,wallet _to where _from.id= wallet_from and _to.id=wallet_to and date(from_unixTime(v.created_at)) between :start and :end
              GROUP BY date(from_unixTime(v.created_at)),_from.name,_to.name ";
        $params=[':start'=>$start,':end'=>$end];

        $count = Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('wallet-transactions',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }

    public function actionStationReport($start,$end){
        $rate= Rate::find()->orderBy(['id'=>SORT_DESC])->one()->rate;

        $sql="SELECT _date,station.nom as station,SUM(vcdf) as vcdf,SUM(vusd) as vusd,SUM(dusd) as dusd,SUM(dcdf) as dcdf,((sum(vusd)+(SUM(vcdf)/:rate)) - (sum(dusd)+(SUM(dcdf)/:rate))) as profit_usd,SUM(cdf_versement_bank) as cdf_versement_bank,SUM(usd_versement_bank) as usd_versement_bank,(SUM(vcdf)-SUM(cdf_versement_bank)) as rcdf, SUM(vusd)-SUM(usd_versement_bank) as rusd
        FROM(                                                                                              
        SELECT date(from_unixTime(created_at)) as _date,station,cdf as vcdf,usd as vusd,0 as dcdf,0 as dusd,0 as cdf_versement_bank,0 as usd_versement_bank from retail 
        UNION
        SELECT date(from_unixTime(created_at)) as _date,station,cdf as vcdf,usd as vusd,0 as dcdf,0 as dusd,0 as cdf_versement_bank,0 as usd_versement_bank from supply
        UNION
        SELECT date(from_unixTime(created_at)) as _date,station,0 as vcdf,0 as vusd,sum(case when currency='CDF' then prix*quantite end) as dcdf, sum(case when currency='USD' then prix*quantite end) as dusd,0 as cdf_versement_bank,0 as usd_versement_bank from depense group by date(from_unixTime(created_at))
        UNION
        SELECT date(from_unixTime(v.created_at)) as _date,w.station,0 as vcdf,0 as vusd,0 as dusd,0 as dcdf,v.cdf as cdf_versement_bank,v.usd as usd_versement_bank from versement_bank v,wallet w WHERE w.id=wallet
         
        )t, station where station.id=t.station and _date between :start and :end GROUP BY _date,station";
        $params=[':start'=>$start,':end'=>$end,':rate'=>$rate];

        $count = Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('station-report',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }

    public function actionPompisteReport($start,$end){

        $sql="SELECT _date,station.nom as station,user.name as _user,sum(cdf) as cdf,sum(usd) as usd from
        (
            SELECT date(from_unixTime(created_at)) as _date,station,created_by as _user,cdf,usd from retail
            UNION
            SELECT date(from_unixTime(created_at)) as _date,station,created_by as _user,cdf,usd from supply
        )t,station,user where user.id=t._user and _date between :start and :end and t.station=station.id GROUP by _user,_date,station.nom ";
        $params=[':start'=>$start,':end'=>$end];

        $count = Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('pompiste-report',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }


    public function actionIncomeStatement($start, $end){

        $rate= Rate::find()->orderBy(['id'=>SORT_DESC])->one()->rate;


        $income_usd_ago = Yii::$app->db->createCommand("SELECT sum(usd) from produit p,record_journalier r where p.nom= 'AGO' and p.id=r.produit and date(from_unixTime(r.created_at)) between '$start' and '$end'")->queryScalar();
        $income_cdf_ago = Yii::$app->db->createCommand("SELECT sum(cdf/$rate) from produit p,record_journalier r where p.nom= 'AGO' and p.id=r.produit and date(from_unixTime(r.created_at)) between '$start' and '$end'")->queryScalar();

        $income_usd_pms = Yii::$app->db->createCommand("SELECT sum(usd) from produit p,record_journalier r where p.nom= 'PMS' and p.id=r.produit and date(from_unixTime(r.created_at)) between '$start' and '$end'")->queryScalar();
        $income_cdf_pms = Yii::$app->db->createCommand("SELECT sum(cdf/$rate) from produit p,record_journalier r where p.nom= 'PMS' and p.id=r.produit and date(from_unixTime(r.created_at)) between '$start' and '$end'")->queryScalar();

        $depense_usd = Yii::$app->db->createCommand("SELECT sum(depense_usd) from produit p,record_journalier r where p.nom= 'PMS' and p.id=r.produit and date(from_unixTime(r.created_at)) between '$start' and '$end'")->queryScalar();

        $expenses_usd = Yii::$app->db->createCommand("SELECT  sum(prix*quantite) as usd from depense where currency='USD' and date(from_unixTime(created_at)) BETWEEN '$start' and '$end'")->queryScalar();
        $expenses_cdf = Yii::$app->db->createCommand("SELECT sum((prix*quantite)/rate)  as cdf from depense where currency='CDF' and date(from_unixTime(created_at)) BETWEEN '$start' and '$end'")->queryScalar();

        $total_expenses = $expenses_cdf + $expenses_usd;
 

      
        return $this->render('income-statement',[
            'income_usd_ago'=>$income_usd_ago,
            'income_cdf_ago'=>$income_cdf_ago,
            'income_usd_pms'=>$income_usd_pms,
            'income_cdf_pms'=>$income_cdf_pms,
            'depense_usd'=>$depense_usd,
            'total_expenses'=>$total_expenses,
            'start'=>$start,
            'end'=>$end,
        ]);


    }


        public function actionOperationalExpenses($start,$end){

        $sql="SELECT date(from_unixTime(created_at)) as _date,station, sum(case when currency='USD' then prix*quantite end) as dusd,sum(case when currency='CDF' then prix*quantite end) as dcdf from depense where isNULL(dechargemt) 
              AND date(from_unixTime(created_at)) between :start and :end GROUP BY date(from_unixTime(created_at)),station";
        $params=[':start'=>$start,':end'=>$end];

        $count = Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('operational-expenses',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }
    public function actionOperationalExpensesDetails($date,$station,$start,$end){

        $sql="SELECT date(from_unixTime(created_at)) as _date,station,description,(case when currency='USD' then prix*quantite end) as dusd,(case when currency='CDF' then prix*quantite end) as dcdf from depense where station=:station and isNULL(dechargemt)
              AND date(from_unixTime(created_at)) =:date ";
        $params=[':date'=>$date,'station'=>$station];

        $count = Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('operational-expenses-details',[
            'dataProvider'=>$dataProvider,
            'date'=>$date,
            'station'=>$station,
            'start'=>$start,
            'end'=>$end,

        ]);
    }

    
    public function actionDechargementExpenses($start,$end){

        $sql="SELECT date(from_unixTime(created_at)) as _date,station, sum(case when currency='USD' then prix*quantite end) as dusd,sum(case when currency='CDF' then prix*quantite end) as dcdf from depense where dechargemt>0 
              AND date(from_unixTime(created_at)) between :start and :end GROUP BY _date,station";
        $params=[':start'=>$start,':end'=>$end];

        $count = Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('dechargement-expenses',[
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }

    public function actionDechargementExpensesDetails($date,$station,$start,$end){

        $sql="SELECT date(from_unixTime(created_at)) as _date,station,description,(case when currency='USD' then prix*quantite end) as dusd,(case when currency='CDF' then prix*quantite end) as dcdf from depense where station=:station and dechargemt>0 
              AND date(from_unixTime(created_at)) =:date ";
        $params=[':date'=>$date,'station'=>$station];

        $count = Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

        return $this->render('dechargement-expenses-details',[
            'dataProvider'=>$dataProvider,
            'date'=>$date,
            'station'=>$station,
            'start'=>$start,
            'end'=>$end,

        ]);
    }

    public function actionSummary($start=null, $end=null,$reference=null)
    {
        if($start==null || $end == null)
            $start = $end = date('Y-m-d');
            
        $sql = "SELECT _date,station.nom as station,SUM(little_in) as little_in,SUM(little_out) as little_out,SUM(cdf) as cdf,SUM(usd) as usd,SUM(cdf_versement) as cdf_versement,SUM(usd_versement) as usd_versement,sum(dusd) as depense_usd,sum(dcdf) as depense_cdf
FROM(

SELECT date(from_unixTime(created_at)) as _date,station as station,0 as little_in,quantite as little_out,cdf as cdf,usd as usd,0 as cdf_versement,0 as usd_versement,0 as dusd,0 as dcdf from retail
UNION
SELECT date(from_unixTime(created_at)) as _date,station as station,0 as little_in,quantite as little_out,cdf as cdf,usd as usd,0 as cdf_versement,0 as usd_versement,0 as dusd,0 as dcdf from supply
UNION
SELECT date(from_unixTime(v.created_at)) as _date,u.station as station,0 as little_in,0 as little_out,0 as cdf,0 as usd,v.cdf as cdf_versement,v.usd as usd_versement,0 as dusd,0 as dcdf from versement_bank v,user u
UNION
SELECT date(from_unixTime(created_at)) as _date,1 as station,quantite as little_in,0 as little_out,0 as cdf,0 as usd,0 as cdf_versement,0 as usd_versement,0 as dusd,0 as dcdf from dechargement
UNION
SELECT date(from_unixTime(created_at)) as _date,station as station,0 as little_in,0 as little_out,0 as cdf,0 as usd,0 as cdf_versement,0 as usd_versement, sum(case when currency='USD' then prix*quantite end) as dusd,sum(case when currency='CDF' then prix*quantite end) as dcdf from depense group by station,date(from_unixTime(created_at))


)t ,station where t.station=station.id and _date between :start and :end GROUP by _date,station.nom ORDER BY _date DESC";

        $count = Yii::$app->db->createCommand("SELECT COUNT(*) FROM ({$sql}) AS tbl")
            ->bindValues([':start' => $start, ':end' => $end,])
            ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'params' => [
                ':start' => $start,
                ':end' => $end,
            ],
            'totalCount' => $count,

            'sort' => [
                'attributes' => array_merge([

                    'amount',
                ]),
            ],
            'pagination' => [
                'pageSize' => false,
            ],
        ]);
      
        return $this->render('summary', [
            // 'model' => $model,
            'dataProvider'=>$dataProvider,
            'start'=>$start,
            'end'=>$end,
        ]);
    }


   



    
}
