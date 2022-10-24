<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

use yii\grid\GridView;
use app\models\Rate;
// use Yii;

$this->title = Yii::t('app', 'Income Statement');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

// $rate= Rate::find()->orderBy(['id'=>SORT_DESC])->one()->rate;

// $start= $_REQUEST['start'];
// $end = $_REQUEST['end'];

// $income_usd_ago = Yii::$app->db->createCommand("SELECT sum(usd) from produit p,record_journalier r where p.nom= 'AGO' and p.id=r.produit and date(from_unixTime(r.created_at)) between ''")->queryScalar();
// $income_cdf_ago = Yii::$app->db->createCommand("SELECT sum(cdf/$rate) from produit p,record_journalier r where p.nom= 'AGO' and p.id=r.produit ")->queryScalar();

// $income_usd_pms = Yii::$app->db->createCommand("SELECT sum(usd) from produit p,record_journalier r where p.nom= 'PMS' and p.id=r.produit ")->queryScalar();
// $income_cdf_pms = Yii::$app->db->createCommand("SELECT sum(cdf/$rate) from produit p,record_journalier r where p.nom= 'PMS' and p.id=r.produit ")->queryScalar();

?>
<html>
<style>
table, th, td {
  border:0px solid black;
}
</style>
<body>

<h2>Ordinary Income/Expense</h2>

<table style="width:100%">
  <tr>
    <th>Income/Revenue</th>
    <th></th>
    <th></th>
  </tr>
  <tr>
    <td></td>
    <td>Income $ AGO</td>
    <td><?php echo(number_format($income_usd_ago,1))?>
</td>
  </tr>
  <tr>
    <td></td>
    <td>Income Fc AGO in $</td>
    <td><?=number_format($income_cdf_ago,1)?></td>
  </tr>
  <tr>
    <td></td>
    <td>Income $ PMS</td>
    <td><?=number_format($income_usd_pms,1)?></td>
  </tr>

  <tr>
    <td></td>
    <td>Income Fc PMS in $</td>
    <td><?=number_format($income_cdf_pms,1)?></td>
  </tr>

 <br>

  <tr>
    <th>Total Income</th>
    <th></th>
    <td><b><?=number_format($income_usd_ago+$income_cdf_ago+$income_usd_pms+$income_cdf_pms,1)?>$</b><hr style="height:2px; width:100%; border-width:1; color:black; background-color:black"></td>
  </tr>


   <tr>
    <th>Cost of Income</th>
    <th></th>
    <td><?=number_format(0,2)?></b><hr style="height:2px; width:100%; border-width:1; color:black; background-color:black"></td>
  </tr>
  <tr>
    <th>Gross Profit</th>
    <th></th>
    <td><b><?=number_format(($income_usd_ago+$income_cdf_ago+$income_usd_pms+$income_cdf_pms)-0,2) ?></b><hr style="height:2px; width:100%; border-width:1; color:black; background-color:black"></td>
  </tr>
  <tr>
    <th>Expenses</th>
    <th></th>
    <td><?=number_format($depense_usd,2) ?><hr style="height:2px; width:100%; border-width:1; color:black; background-color:black"></td>
  </tr>

  <tr>
    <th>Net Ordinary Income</th>
    <th></th>
    <td><b><?php

    $gross_profit = ($income_usd_ago+$income_cdf_ago+$income_usd_pms+$income_cdf_pms)-$depense_usd;
    

    $net_income = $gross_profit-$depense_usd;
    echo number_format($net_income,1);
    
    ?></b></td>
  </tr>
</table>

</body>
</html>
