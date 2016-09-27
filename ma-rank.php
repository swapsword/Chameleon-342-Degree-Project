<?php
session_start();
//$search_term = $_SESSION['dm'];
//$search_term1 = $_SESSION['account'];
//$search_term2 = $_SESSION['from'];
//$search_term3 = $_SESSION['to'];
// Below PHP script is written for creating the average table use for showing the ranking
require 'includes/connect.php';
mysqli_query($con, "DELETE FROM `ma-sum`");
mysqli_query($con, "ALTER TABLE `ma-sum` DROP COLUMN Rank;");
mysqli_query($con, "ALTER TABLE `ma-sum` AUTO_INCREMENT = 1");

$maketemp = "
    CREATE TEMPORARY TABLE temp_ma_sum (
      `Account_Name` varchar(255),
      `Sum_Volume` DOUBLE,
      `Sum_Percent` DOUBLE
    )
  ";
mysqli_query($con, $maketemp);
// VW is not yet included
$account = array("ALBTEL",
    "AMDEUS",
    "AUAMS",
    "AUFLGWIEN",
    "AUKAV",
    "BAYER",
    "BHTCM",
    "CHBIT",
    "CHMGRS",
    "CHSIX",
    "CMRZBNK",
    "CZCSNT",
    "CZO2",
    "DEBI",
    "DEBRSE",
    "DEKS",
    "DEMETRO",
    "DEPSTBNK",
    "DEWTELL",
    "ENBW",
    "FERRERO",
    "FLGMUC",
    "GLBFND",
    "HM",
    "HUCFB",
    "HUKBC",
    "HUNISZ",
    "ING",
    "JHNDEER",
    "MEDSTRN",
    "MERCK",
    "PLBG",
    "PLGPW",
    "PLKGP",
    "PLKW",
    "PLMAZ",
    "PLMOD",
    "PLMOFA",
    "PLNBP",
    "PLNET",
    "PLP4",
    "PLPSE",
    "PLTRN",
    "PLVCT",
    "PWC",
    "RAFFSN",
    "RURMTS",
    "RWE",
    "SIEMENS",
    "SLOTKM",
    "SLVNET",
    "SRBSBB",
    "TLMACH",
    "UNCRDT");
foreach($account as $account_name) {

    // sum per selected account/delivery manager
    $sum_dm_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM ma WHERE (Account_Identifier ='$account_name')");
    $sum_dm_pid = mysqli_fetch_row($sum_dm_pid);

    // sum for all accounts
    $sum_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM ma");
    $sum_pid = mysqli_fetch_row($sum_pid);

    // final sum percent
    $sum_percent = ($sum_dm_pid[0] / $sum_pid[0]) * 100;
    $sum_dm_pid = round($sum_dm_pid[0],2);
    $sum_percent = round($sum_percent,2);
    $result = mysqli_query($con, "insert into temp_ma_sum (Account_Name, Sum_Volume, Sum_Percent) values ('$account_name', $sum_dm_pid, $sum_percent)");
    if (!$result) {
        die('error1'.mysqli_error($con));
    }
}
$result = mysqli_query($con, "INSERT INTO `ma-sum` SELECT * FROM temp_ma_sum order by Sum_Volume DESC, Sum_Percent DESC;");
if (!$result) {
    die('error2'.mysqli_error($con));
}
$result = mysqli_query($con,"ALTER TABLE `ma-sum` ADD COLUMN `Rank` INT NOT NULL AUTO_INCREMENT PRIMARY KEY;");
if (!$result) {
    die('error3'.mysqli_error($con));
}

// Below php script is for average table
mysqli_query($con, "DELETE FROM `ma-average`");
mysqli_query($con, "ALTER TABLE `ma-average` DROP COLUMN Rank;");
mysqli_query($con, "ALTER TABLE `ma-average` AUTO_INCREMENT = 1");

$maketemp = "
    CREATE TEMPORARY TABLE temp_ma_avg (
      `Account_Name` varchar(255),
      `Average_Volume` DOUBLE,
      `Average_Percent` DOUBLE
    )
  ";
mysqli_query($con, $maketemp);
// VW is not yet included
$account = array("ALBTEL",
    "AMDEUS",
    "AUAMS",
    "AUFLGWIEN",
    "AUKAV",
    "BAYER",
    "BHTCM",
    "CHBIT",
    "CHMGRS",
    "CHSIX",
    "CMRZBNK",
    "CZCSNT",
    "CZO2",
    "DEBI",
    "DEBRSE",
    "DEKS",
    "DEMETRO",
    "DEPSTBNK",
    "DEWTELL",
    "ENBW",
    "FERRERO",
    "FLGMUC",
    "GLBFND",
    "HM",
    "HUCFB",
    "HUKBC",
    "HUNISZ",
    "ING",
    "JHNDEER",
    "MEDSTRN",
    "MERCK",
    "PLBG",
    "PLGPW",
    "PLKGP",
    "PLKW",
    "PLMAZ",
    "PLMOD",
    "PLMOFA",
    "PLNBP",
    "PLNET",
    "PLP4",
    "PLPSE",
    "PLTRN",
    "PLVCT",
    "PWC",
    "RAFFSN",
    "RURMTS",
    "RWE",
    "SIEMENS",
    "SLOTKM",
    "SLVNET",
    "SRBSBB",
    "TLMACH",
    "UNCRDT");

$trafo_total = mysqli_query($con, "SELECT * FROM ma");
$num_trafo_total = mysqli_num_rows($trafo_total);

foreach($account as $account_name) {

    // Counting the PID's
    $total = mysqli_query($con, "SELECT * FROM ma WHERE (Account_Identifier ='$account_name')");
    $num_total = mysqli_num_rows($total);

    // sum per selected account/delivery manager
    $sum_dm_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM ma WHERE (Account_Identifier ='$account_name')");
    $sum_dm_pid = mysqli_fetch_row($sum_dm_pid);

    // sum for all accounts
    $sum_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM ma");
    $sum_pid = mysqli_fetch_row($sum_pid);

    // average per selected account/delivery manager
    if($num_total == 0) {
        $avg_vol_dm_pid_var = 0;
    }else {
        $avg_vol_dm_pid_var = ($sum_dm_pid[0] / $num_total);
    }
    // average for all accounts
    $avg_vol_pid_var = ($sum_pid[0]/$num_trafo_total);

    // final average percentage
    $avg_percent = ($avg_vol_dm_pid_var/$avg_vol_pid_var) * 100;

    $avg_vol_dm_pid_var = round($avg_vol_dm_pid_var,2);
    $avg_percent = round($avg_percent,2);
    $result = mysqli_query($con, "insert into temp_ma_avg (Account_Name, Average_Volume, Average_Percent) values ('$account_name', $avg_vol_dm_pid_var, $avg_percent);");
    if (!$result) {
        die('error4'.mysqli_error($con));
    }
}
$result = mysqli_query($con, "INSERT INTO `ma-average` SELECT * FROM temp_ma_avg order by Average_Volume DESC, Average_Percent DESC;");
if (!$result) {
    die('error5'.mysqli_error($con));
}
$resultw = mysqli_query($con,"ALTER TABLE `ma-average` ADD COLUMN `Rank` INT NOT NULL AUTO_INCREMENT PRIMARY KEY;");
if (!$resultw) {
    die('error6'.mysqli_error($con));
}

?>
<!DOCTYPE html>
<html>
<head>
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="semantic/out/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/ma-rank.css?<?php echo time();?>">
    <!-- JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <!-- Custom JS for loading menu tab php file onclick -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.ui.search.selection.dropdown').dropdown({
            });
            $(".close.icon").click(function(){
                $(this).parent().hide();
            });
        });
    </script>
</head>
<body>
<div class="ui grid">
    <!--Left side of page with logo,title and menu-->
    <div id="dtop" class="sixteen wide column">
        <!--Cisco Logo with link to cisco website-->
        <div id="d1">
            <a href="<?php include 'includes/link.php';?>" class="ui small image">
                <img src="images/cisco_logo.png">
            </a>
        </div>
        <!--Page Title-->
        <div id="d2">
            <h1 id="h1">MA-ACCOUNTS</h1>
        </div>
        <!--Menu for navigation-->
        <div id="d3" class="ui blue compact menu">
            <a href="/ma-dashboard.php" id="a1" class="item">DASHBOARD</a>
            <a href="/ma-rank.php" id="a1" class="item active">ACCOUNT RANKING</a>
        </div>
    </div>
    <!--bottom side of page which is loading as per navigation-->
    <div id="dbottom" class="sixteen wide column">
        <div class="ui grid">
            <div class="six wide column"></div>
            <div class="four wide column">
                <h1>Over-All Ranking</h1>
            </div>
            <div class="six wide column"></div>
        </div>
        <div class="ui grid">
            <div class="eight wide column">
                <h3>Rank as per Sum</h3>
                <?php include('includes/ma-rank-table-sum.php');?>
            </div>
            <div class="eight wide column">
                <h3>Rank as per Average</h3>
                <?php include('includes/ma-rank-table-avg.php');?>
            </div>
        </div>
        <div class="ui grid">
            <div class="sixteen wide column">
                <?php include('includes/ma-rankindex.php');?>
            </div>
        </div>
    </div>
    <!--<!-- Highcharts JS as recommended should be declared in body end-->
    <!--<script src="highcharts/js/highcharts.js"></script>-->
    <!--<script src="highcharts/js/modules/exporting.js"></script>-->
    <!--<script src="highcharts/js/modules/export-csv.js"></script>-->
    <!--<script src="highcharts/js/themes/sand-signika.js"></script>-->
    <!--<script src="semantic/out/semantic.min.js"></script>-->
    <script src="semantic/out/semantic.min.js"></script>
</body>
</html>
