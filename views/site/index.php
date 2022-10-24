<?php
use yii\helpers\Html; 
use app\models\Station;
use yii\grid\GridView;
use sjaakp\gcharts\ColumnChart;
/* @var $this yii\web\View */

$this->title = 'Home Page - Welcome';

$this->registerCss(' 
    
    .padme
    {
        height: 100px;
        width: 100px;
        margin:15px;
    }
'); 

?>

<div class="row">
    <div class="col-lg-6">
        <?php if(\Yii::$app->user->identity->role == '102'): ?>
            <?= Html::a(Html::img('@web/images/icon-48-article.png').'<br><b>Vente au <br>détail</b>', ['/retail/index'], ['class'=>'btn btn-default padme']) ?>
        <?= Html::a(Html::img('@web/images/icon-48-module.png').'<br><b>Vente en <br>gros</b>', ['/supply/index'], ['class'=>'btn btn-default padme']) ?>
        <?php endif; ?>
       <!--  DECHARGEMENT BLOC-->

        <?php if(\Yii::$app->user->identity->role == '105'): ?>
            <?= Html::a(Html::img('@web/images/icon-48-stats.png').'<br><b>Achat</b>', ['/dechargement/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-stats.png').'<br><b>Distribution</b>', ['/distribution/index'], ['class'=>'btn btn-default padme']) ?>

            <?= Html::a(Html::img('@web/images/icon-48-search.png').'<br><b>Raports</b>', ['/reports/index'], ['class'=>'btn btn-default padme']) ?>
        <?php endif; ?>


        <!-- MANAGER BLOC -->
        <?php if(\Yii::$app->user->identity->role == '103'): ?>

            <?= Html::a(Html::img('@web/images/icon-48-menu-add.png').'<br><b>Fiche journalière</b>', ['/record-journalier/index'], ['class'=>'btn btn-default padme']) ?>
             <?= Html::a(Html::img('@web/images/icon-48-expenses.png').'<br><b>Depenses</b>', ['/depense/index'], ['class'=>'btn btn-default padme']) ?>

             
              <?= Html::a(Html::img('@web/images/icon-48-search.png').'<br><b>Raports</b>', ['/reports/index'], ['class'=>'btn btn-default padme']) ?>

           <?php endif; ?> 

        <!--  DISTRIBUTOR  BLOC-->

           <?php if(\Yii::$app->user->identity->role == '106'): ?>
            <?= Html::a(Html::img('@web/images/icon-48-stats.png').'<br><b>Distribution</b>', ['/distribution/index'], ['class'=>'btn btn-default padme']) ?>

            <?php endif; ?> 

         <!--  CASHIER BLOC-->
         <?php if(\Yii::$app->user->identity->role == '104'): ?>
            <?= Html::a(Html::img('@web/images/icon-48-vbank.png').'<br><b>Bank Transactions</b>', ['/versement-bank/index'], ['class'=>'btn btn-default padme']) ?>
                <?= Html::a(Html::img('@web/images/icon-48-vwallet.png').'<br><b>Wallet Transactions</b>', ['/versement-wallet/index'], ['class'=>'btn btn-default padme']) ?>
                <?= Html::a(Html::img('@web/images/icon-48-search.png').'<br><b>Raports</b>', ['/reports/index'], ['class'=>'btn btn-default padme']) ?>
            <?php endif; ?> 

        <!--  ROOT  BLOC-->
        <?php if(\Yii::$app->user->identity->role == '100'): ?>

         <?= Html::a(Html::img('@web/images/icon-48-article.png').'<br><b>Vente au <br>détail</b>', ['/retail/index'], ['class'=>'btn btn-default padme']) ?>
        <?= Html::a(Html::img('@web/images/icon-48-module.png').'<br><b>Vente en <br>gros</b>', ['/supply/index'], ['class'=>'btn btn-default padme']) ?>
        <?= Html::a(Html::img('@web/images/icon-48-search.png').'<br><b>Raports</b>', ['/reports/index'], ['class'=>'btn btn-default padme']) ?>
        
        <?= Html::a(Html::img('@web/images/icon-48-generic.png').'<br><b>Grand Stock</b>', ['/grand-stock/index'], ['class'=>'btn btn-default padme']) ?>
            
        
       
            <?= Html::a(Html::img('@web/images/icon-48-stats.png').'<br><b>Achat</b>', ['/dechargement/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-stats.png').'<br><b>Distribution</b>', ['/distribution/index'], ['class'=>'btn btn-default padme']) ?>

            <?= Html::a(Html::img('@web/images/icon-48-user.png').'<br><b>Utulisateurs</b>', ['/users/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-themes.png').'<br><b>Produits</b>', ['/produit/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-content.png').'<br><b>Stations</b>', ['/station/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-massmail.png').'<br><b>Tarification</b>', ['/tarification/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-menu-add.png').'<br><b>Fiche journalière</b>', ['/record-journalier/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/tank.png').'<br><b>Tanks Carburant</b>', ['/tank/index'], ['class'=>'btn btn-default padme']) ?>
             <?= Html::a(Html::img('@web/images/icon-48-expenses.png').'<br><b>Depenses</b>', ['/depense/index'], ['class'=>'btn btn-default padme']) ?>
              <?= Html::a(Html::img('@web/images/icon-48-account.png').'<br><b>Bank Accounts</b>', ['/account/index'], ['class'=>'btn btn-default padme']) ?>
              <?= Html::a(Html::img('@web/images/icon-48-wallet.png').'<br><b>Wallets</b>', ['/wallet/index'], ['class'=>'btn btn-default padme']) ?>
              <?= Html::a(Html::img('@web/images/icon-48-vbank.png').'<br><b>Bank Transactions</b>', ['/versement-bank/index'], ['class'=>'btn btn-default padme']) ?>
                <?= Html::a(Html::img('@web/images/icon-48-vwallet.png').'<br><b>Wallet Transactions</b>', ['/versement-wallet/index'], ['class'=>'btn btn-default padme']) ?>
                <?= Html::a(Html::img('@web/images/icon-48-themes.png').'<br><b>Rate</b>', ['/rate/index'], ['class'=>'btn btn-default padme']) ?>
       
                <?php endif; ?>

        <!--  ADMINISTRATOR  BLOC-->
        <?php if(\Yii::$app->user->identity->role == '101'): ?>

         
        <?= Html::a(Html::img('@web/images/icon-48-search.png').'<br><b>Raports</b>', ['/reports/index'], ['class'=>'btn btn-default padme']) ?>
        
       
        
       
            <?= Html::a(Html::img('@web/images/icon-48-stats.png').'<br><b>Achat</b>', ['/dechargement/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-stats.png').'<br><b>Distribution</b>', ['/distribution/index'], ['class'=>'btn btn-default padme']) ?>

            <?= Html::a(Html::img('@web/images/icon-48-user.png').'<br><b>Utulisateurs</b>', ['/users/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-themes.png').'<br><b>Produits</b>', ['/produit/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-content.png').'<br><b>Stations</b>', ['/station/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-massmail.png').'<br><b>Tarification</b>', ['/tarification/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-menu-add.png').'<br><b>Fiche journalière</b>', ['/record-journalier/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/tank.png').'<br><b>Tanks Carburant</b>', ['/tank/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-expenses.png').'<br><b>Depenses</b>', ['/depense/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-account.png').'<br><b>Bank Accounts</b>', ['/account/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-wallet.png').'<br><b>Wallets</b>', ['/wallet/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-vbank.png').'<br><b>Bank Transactions</b>', ['/versement-bank/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-vwallet.png').'<br><b>Wallet Transactions</b>', ['/versement-wallet/index'], ['class'=>'btn btn-default padme']) ?>
            <?= Html::a(Html::img('@web/images/icon-48-vwallet.png').'<br><b>Rate</b>', ['/rate/index'], ['class'=>'btn btn-default padme']) ?>
       
       
        
        <?php endif; ?>

        <div style="border-top:solid grey 1px; margin-top:10px; padding-top:10px;">
            <?= Html::img("@web/logo.png") ?>
        </div>
    
    </div>

    


<div class="col-lg-6">
    <div class="panel-body">
	<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Station', 'AGO', 'PMS'],
          
          <?php
        foreach($chartdataProvider as $post)
        {
            
            echo "[
            '".$post['station']."',
            ".$post['ago'].",
            ".$post['pms'].",
            ]," ;
            
            //$rows[]=$post;
        }
        
        
        ?>
          
        ]);

        var options = {
          chart: {
            title: 'Ventes d\'aujourd\'hui',
            subtitle: 'Station, AGO, and PMS',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 700px; height: 400px;"></div>
  </body>
</html>
</div>
   


    </div> 

<div class="rate-index">
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'station',
            // 'rusd',
            // 'rcdf',
            [
                'label'=>'Vente en USD',
                'attribute'=>'rusd',

            ],
            [
                'label'=>'Vente en FC',
                'attribute'=>'rcdf',

            ],
            // 'cdfcredit',
            // 'usdcredit',
            // [
            //     'label'=>'Credit en USD',
            //     'attribute'=>'usdcredit',

            // ],
            
            // [
            //     'label'=>'Credit en FC',
            //     'attribute'=>'cdfcredit',

            // ],
           
            // 'dusd',
            // 'dcdf',
            [
                'label'=>'Depense en USD',
                'attribute'=>'dusd',

            ],
            [
                'label'=>'Depense en FC',
                'attribute'=>'dcdf',

            ],
            // 'pusd',
            // 'pcdf',
            // [
            //     'label'=>'Payable en USD',
            //     'attribute'=>'pusd',

            // ],
            // [
            //     'label'=>'Payable en FC',
            //     'attribute'=>'pcdf',

            // ],

            //'station',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'account',
            //'payment_mode',
            //'receivable',
        
        ],
    ]); ?>

</div>

 