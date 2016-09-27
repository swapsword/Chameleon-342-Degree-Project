<!DOCTYPE html>
<html>
<head>
</head>
<body>
<!--        Added new ------------------------------------------------------------------------------------------------->
<div class="ui grid">
    <div class="six wide column"></div>
    <div class="six wide column">
        <h1>Ranking as per Fiscal Year</h1>
    </div>
    <div class="four wide column"></div>
</div>
<div class="sixteen wide column">
<!-- Delivery Manager Search box -->
<form id="f21" class="ui form" name="search_form" method="GET" action="/rank.php">
    <div class="two fields">
        <div class="field">
            <select id="s1" class="ui search selection dropdown" name="from">
                <option value="">Select Fiscal Year</option>
                <option value="2011-08-01 00:00:00">2012</option>
                <option value="2012-08-01 00:00:00">2013</option>
                <option value="2013-08-01 00:00:00">2014</option>
                <option value="2014-08-01 00:00:00">2015</option>
                <option value="2015-08-01 00:00:00">2016</option>
                <option value="2016-08-01 00:00:00">2017</option>
                <option value="2017-08-01 00:00:00">2018</option>
                <option value="2018-08-01 00:00:00">2019</option>
                <option value="2019-08-01 00:00:00">2020</option>
                <option value="2020-08-01 00:00:00">2021</option>
                <option value="2021-08-01 00:00:00">2022</option>
                <option value="2022-08-01 00:00:00">2023</option>
                <option value="2023-08-01 00:00:00">2024</option>
                <option value="2024-08-01 00:00:00">2025</option>
            </select>
        </div>
        <div class="field">
            <input id="i2" class="ui button" type="submit" name="search" value="GO">
        </div>
    </div>
</form>
<?php
require 'connect.php';
/* Below are the calculation for Total , Active, OnHold , Delivery close PID's*/
if(isset($_GET['search'])) {
    if(!empty($_GET['from'])){
        $search_term2 = mysqli_real_escape_string($con, $_GET['from']);
        if ($search_term2 == "2011-08-01 00:00:00"){
            $search_term3 = "2012-07-31 00:00:00";
        }elseif($search_term2 == "2012-08-01 00:00:00"){
            $search_term3 = "2013-07-31 00:00:00";
        }elseif($search_term2 == "2013-08-01 00:00:00"){
            $search_term3 = "2014-07-31 00:00:00";
        }elseif($search_term2 == "2014-08-01 00:00:00"){
            $search_term3 = "2015-07-31 00:00:00";
        }elseif($search_term2 == "2015-08-01 00:00:00"){
            $search_term3 = "2016-07-31 00:00:00";
        }elseif($search_term2 == "2016-08-01 00:00:00"){
            $search_term3 = "2017-07-31 00:00:00";
        }else{
            $search_term3 = "";
        }
        mysqli_query($con, "DELETE FROM sumfy");
        mysqli_query($con, "ALTER TABLE sumfy DROP COLUMN Rank;");
        mysqli_query($con, "ALTER TABLE sumfy AUTO_INCREMENT = 1");

        $maketemp = "
    CREATE TEMPORARY TABLE temp_sumfy (
      `Account_Name` varchar(255),
      `Sum_Volume` DOUBLE,
      `Sum_Percent` DOUBLE
    )
  ";
        mysqli_query($con, $maketemp);
// VW is not yet included
        $account = array("AA","AUD","AZ","BAS","BMW","BSH","DAI","DB","DBK","DPD","FI","GE","NES","NOV","ROC","SAP","SIE");
        foreach($account as $account_name) {

            // sum per selected account/delivery manager
            $sum_dm_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (Account_Identifier ='$account_name') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
            $sum_dm_pid = mysqli_fetch_row($sum_dm_pid);

            // sum for all accounts
            $sum_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
            $sum_pid = mysqli_fetch_row($sum_pid);

            // final sum percent
            $sum_percent = ($sum_dm_pid[0] / $sum_pid[0]) * 100;
            $sum_dm_pid = round($sum_dm_pid[0],2);
            $sum_percent = round($sum_percent,2);
            $result = mysqli_query($con, "insert into temp_sumfy (Account_Name, Sum_Volume, Sum_Percent) values ('$account_name, $sum_dm_pid, $sum_percent')");
            if (!$result) {
                die('error1'.mysqli_error($con));
            }
        }
        $result = mysqli_query($con, "INSERT INTO sumfy SELECT * FROM temp_sumfy order by Sum_Volume DESC, Sum_Percent DESC;");
        if (!$result) {
            die('error2'.mysqli_error($con));
        }
        $result = mysqli_query($con,"ALTER TABLE sumfy ADD COLUMN `Rank` INT NOT NULL AUTO_INCREMENT PRIMARY KEY;");
        if (!$result) {
            die('error3'.mysqli_error($con));
        }

// Below php script is for average table
        mysqli_query($con, "DELETE FROM averagefy");
        mysqli_query($con, "ALTER TABLE averagefy DROP COLUMN Rank;");
        mysqli_query($con, "ALTER TABLE averagefy AUTO_INCREMENT = 1");

        $maketemp = "
    CREATE TEMPORARY TABLE temp_avgfy (
      `Account_Name` varchar(255),
      `Average_Volume` DOUBLE,
      `Average_Percent` DOUBLE
    )
  ";
        mysqli_query($con, $maketemp);
// VW is not yet included
        $account = array("AA","AUD","AZ","BAS","BMW","BSH","DAI","DB","DBK","DPD","FI","GE","NES","NOV","ROC","SAP","SIE");

        $trafo_total = mysqli_query($con, "SELECT * FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
        $num_trafo_total = mysqli_num_rows($trafo_total);

        foreach($account as $account_name) {

            // Counting the PID's
            $total = mysqli_query($con, "SELECT * FROM dmcdm WHERE (Account_Identifier ='$account_name') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
            $num_total = mysqli_num_rows($total);

            // sum per selected account/delivery manager
            $sum_dm_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (Account_Identifier ='$account_name') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
            $sum_dm_pid = mysqli_fetch_row($sum_dm_pid);

            // sum for all accounts
            $sum_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
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
            $result = mysqli_query($con, "insert into temp_avgfy (Account_Name, Average_Volume, Average_Percent) values ('$account_name', $avg_vol_dm_pid_var, $avg_percent);");
            if (!$result) {
                die('error4'.mysqli_error($con));
            }
        }
        $result = mysqli_query($con, "INSERT INTO averagefy SELECT * FROM temp_avgfy order by Average_Volume DESC, Average_Percent DESC;");
        if (!$result) {
            die('error5'.mysqli_error($con));
        }
        $resultw = mysqli_query($con,"ALTER TABLE averagefy ADD COLUMN `Rank` INT NOT NULL AUTO_INCREMENT PRIMARY KEY;");
        if (!$resultw) {
            die('error6'.mysqli_error($con));
        }
        ?>
        <!--            Delivery Manager and account label-->
        <div id="d35" class="ui divided selection list">
            <a class="item">
                <div class="ui blue horizontal label">Fiscal Year</div>
                <b id="bb3"><?php $fy = substr($_GET['from'], 0, 4); echo ((int)($fy)) + 1; ?></b>
            </a>
        </div>
        <div class="ui grid">
            <div class="eight wide column">
                <h3>Rank as per Sum</h3>
                <?php include('rank-table-sumfy.php');?>
            </div>
            <div class="eight wide column">
                <h3>Rank as per Average</h3>
                <?php include('rank-table-avgfy.php');?>
            </div>
        </div>
        <?php
    }else{
        // error message if account/delivery manager is not selected or it has null value
        echo '<div class="ui error message">
                    <i class="close icon"></i>
                    <div class="header">There was some errors with your submission</div>
                    <ul class="list">
                        <li>Please select Fiscal Year.</li>
                    </ul>
                </div>';
    }
}
?>
<!--<!-- Highcharts JS as recommended should be declared in body end-->
<!--<script src="highcharts/js/highcharts.js"></script>-->
<!--<script src="highcharts/js/modules/exporting.js"></script>-->
<!--<script src="highcharts/js/modules/export-csv.js"></script>-->
<!--<script src="highcharts/js/themes/sand-signika.js"></script>-->
<!--<script src="semantic/out/semantic.min.js"></script>-->
</div>
</body>
</html>
