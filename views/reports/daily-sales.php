<?php

use kartik\grid\GridView;
use yii\helpers\Html;
// use app\models\RetailsInfo;
use app\models\Station;
use yii\data\SqlDataProvider;
use app\components\SumProviderRows;

$this->title=Yii::t('app','Daily sales '.$start. ' to '.$end);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report'), 'url' => ['index']];

$stations = Yii::$app->db->createCommand('SELECT  r.station as id,s.nom,sum(cdf) as fc,sum(usd) as usd FROM petrol.retail r join petrol.station s on r.station =s.id where date(from_unixTime(r.created_at)) between :start and :end group by station,nom')
            ->bindValue(':start',$start)
            ->bindValue(':end',$end)
            ->queryAll();
           // var_dump($posts);
$posts = Yii::$app->db->createCommand(' select* from tank ')
            //->bindValue(':no',$no)
            ->queryAll();
           // var_dump($posts);
?>
 <h1><?= Html::encode($this->title) ?></h1>
 <?php
 foreach($stations as $post)
 { 
 // $station=Station::find()->where(['id'=>$post['station']])->one()->nom;
   $sql='select t.station,t.produit,p.nom,sum(t.capacity) as capacity from petrol.tank t join petrol.produit p on t.produit=p.id where t.station=:station and  t.produit=:produit group by t.station,t.produit,p.nom  ';
   $params=[':station'=>$post['id'],':produit'=>2];

        $count=Yii::$app->db->createCommand("SELECT count(*) from ($sql)t",$params)->queryScalar();

        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'params'=>$params,
            'totalCount'=>$count,
        ]);

    $sql3='select t.station,t.produit,p.nom,sum(t.capacity) as capacity from petrol.tank t join petrol.produit p on t.produit=p.id where t.station=:station and  t.produit=:produit group by t.station,t.produit,p.nom  ';
   $params3=[':station'=>$post['id'],':produit'=>3];

        $count3=Yii::$app->db->createCommand("SELECT count(*) from ($sql3)t",$params3)->queryScalar();

        $dataProvider3= new SqlDataProvider([
            'sql'=>$sql3,
            'params'=>$params3,
            'totalCount'=>$count3,
        ]);

    $sql2='select prix,sum(quantite) as quantite, sum(usd) as usd,sum(fc) as fc,sum(us_equivalent) as us_equivalent from (
SELECT  prix,sum(quantite) as quantite,sum(usd) as usd,sum(cdf) as fc,sum((cdf/rate)+usd) as us_equivalent FROM petrol.retail where date(from_unixtime(created_at)) between :start and :end and station=:station and produit=:produit group by  prix
union
SELECT prix,sum(quantite) as quantite,sum(usd) as usd,sum(cdf) as fc,sum((cdf/rate)+usd) as us_equivalent FROM petrol.supply where date(from_unixtime(created_at)) between :start and :end and station=:station and produit=:produit group by  prix)x group by x.prix';
   $params2=[':station'=>$post['id'],':produit'=>2,':start'=>$start,':end'=>$end]; 
  $count2=Yii::$app->db->createCommand("SELECT count(*) from ($sql2)t",$params2)->queryScalar();

        $dataProvider2= new SqlDataProvider([
            'sql'=>$sql2,
            'params'=>$params2,
            'totalCount'=>$count2,
        ]);


    $sql4='select prix,sum(quantite) as quantite, sum(usd) as usd,sum(fc) as fc,sum(us_equivalent) as us_equivalent from (
SELECT  prix,sum(quantite) as quantite,sum(usd) as usd,sum(cdf) as fc,sum((cdf/rate)+usd) as us_equivalent FROM petrol.retail where date(from_unixtime(created_at)) between :start and :end and station=:station and produit=:produit group by  prix
union
SELECT prix,sum(quantite) as quantite,sum(usd) as usd,sum(cdf) as fc,sum((cdf/rate)+usd) as us_equivalent FROM petrol.supply where date(from_unixtime(created_at)) between :start and :end and station=:station and produit=:produit group by  prix)x group by x.prix';
   $params4=[':station'=>$post['id'],':produit'=>3,':start'=>$start,':end'=>$end]; 
  $count4=Yii::$app->db->createCommand("SELECT count(*) from ($sql4)t",$params4)->queryScalar();

        $dataProvider4= new SqlDataProvider([
            'sql'=>$sql4,
            'params'=>$params4,
            'totalCount'=>$count4,
        ]);

    ?>
  <br> <h2><?= Html::encode($post['nom']) ?>
            &emsp; &emsp; <?= Html::encode(number_format($post['usd'])).' USD' ?> 
             &emsp; &emsp; <?= Html::encode(number_format($post['fc'])).' FC' ?></h2> <br>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
     'layout' => '{items}',
    'columns' => [
        
        [
            'attribute'=>'nom',
            'label'=>'Produit',
            

        ],
        [
            'attribute'=>'capacity',
            'label'=>'Stock',
            'format'=>'decimal',

        ],
        //'created_at:datetime',
        // ...
    ],
]) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider2,
     'layout' => '{items}',
     'showFooter'=>true, 
        'footerRowOptions'=>['style'=>'font-weight:bold;font-size: 16px;'],
    'columns' => [
        
        [
            'attribute'=>'prix',
            'label'=>'Prix',
            

        ],
        [
            'attribute'=>'quantite',
            'label'=>'Littres',
            'format'=>'decimal',
            'footer'=>SumProviderRows::total($dataProvider2, 'quantite')

        ],

        [
            'attribute'=>'usd',
            'label'=>'USD',
            'format'=>'decimal',
            'footer'=>SumProviderRows::total($dataProvider2, 'usd')

        ],
        [
            'attribute'=>'fc',
            'label'=>'FC',
            'format'=>'decimal',
            'footer'=>SumProviderRows::total($dataProvider2, 'fc')

        ],
        [
            'attribute'=>'us_equivalent',
            'label'=>'US us_equivalent',
            'format'=>'decimal',
            'footer'=>SumProviderRows::total($dataProvider2, 'us_equivalent')

        ],
        //'created_at:datetime',
        // ...
    ],
]) ?>
<br>

<?= GridView::widget([
    'dataProvider' => $dataProvider3,
     'layout' => '{items}',
    'columns' => [
        
        [
            'attribute'=>'nom',
            'label'=>'Produit',
            

        ],
        [
            'attribute'=>'capacity',
            'label'=>'Stock',
            'format'=>'decimal',

        ],
        //'created_at:datetime',
        // ...
    ],
]) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider4,
     'layout' => '{items}',
     'showFooter'=>true, 
        'footerRowOptions'=>['style'=>'font-weight:bold;font-size: 16px;'],
    'columns' => [
        
        [
            'attribute'=>'prix',
            'label'=>'Prix',
            

        ],
        [
            'attribute'=>'quantite',
            'label'=>'Littres',
            'format'=>'decimal',
            'footer'=>SumProviderRows::total($dataProvider4, 'quantite')

        ],

        [
            'attribute'=>'usd',
            'label'=>'USD',
            'format'=>'decimal',
            'footer'=>SumProviderRows::total($dataProvider4, 'usd')

        ],
        [
            'attribute'=>'fc',
            'label'=>'FC',
            'format'=>'decimal',
            'footer'=>SumProviderRows::total($dataProvider4, 'fc')

        ],
        [
            'attribute'=>'us_equivalent',
            'label'=>'US us_equivalent',
            'format'=>'decimal',
            'footer'=>SumProviderRows::total($dataProvider4, 'us_equivalent')

        ],
        //'created_at:datetime',
        // ...
    ],
]) ?>

  <?php  
  
 }


?>