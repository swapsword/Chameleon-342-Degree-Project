<?php
session_start();
$search_term ="dm";
$search_term1 ="account";
$search_term2 ="from";
$search_term3 ="to";
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/css/dmindex.css?<?php echo time();?>">
    <!-- Custom JS -->
    <script src="/js/dmindex.js?<?php echo time();?>"></script>
</head>
<body>
<div class="ui grid">

    <!--Center of page-->
    <div id="dcenter" class="sixteen wide column">

        <!-- Delivery Manager Search box -->
        <form id="f21" class="ui form" name="search_form" method="GET" action="/trafo-dashboard.php">
            <div class="five fields">
                <div class="four wide field">
                    <input id="i1" class="ui input" type="text" name="dm" value="" placeholder="CDM id(optional...)"/>
                </div>
                <labal style="margin-top: 10px;">OR</labal>
                <div class="four wide field">
                    <select class="ui search selection dropdown" name="account">
                        <option value="">Select Account</option>
                        <option value="AA">Allianz Arena</option>
                        <option value="AUD">Audi/Porsche</option>
                        <option value="AZ">Allianz</option>
                        <option value="BAS">BASF</option>
                        <option value="BMW">BMW</option>
                        <!-- Saving your scroll sanity !-->
                        <option value="BSH">Bosch & Morzaiq</option>
                        <option value="DAI">Daimler</option>
                        <option value="DB">Deutsche Bahn</option>
                        <option value="DBK">Deutsche Bank</option>
                        <option value="DPD">Deutsche Post /DHL</option>
                        <option value="FI">Finanzinformatik</option>
                        <option value="GE">Genoverbund(VR)</option>
                        <option value="NES">Nestle</option>
                        <option value="NOV">Novartis</option>
                        <option value="ROC">Roche</option>
                        <option value="SAP">SAP</option>
                        <option value="SIE">Siemens</option>
                        <option value="VW">Volkswagen</option>
                        </select>
                </div>
                <div class="field">
                    <select class="ui search selection dropdown" name="from">
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
<!--                        <option value="2016-08-01 00:00:00">FY-2015</option>-->
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
            if(!empty($_GET['account']) || !empty($_GET['dm'])){
                if(!empty($_GET['from'])){
            $search_term = mysqli_real_escape_string($con, $_GET['dm']);
            $search_term1 = mysqli_real_escape_string($con, $_GET['account']);
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
//            $search_term3 = mysqli_real_escape_string($con, $_GET['to']);
            $_SESSION['dm'] = $search_term;
            $_SESSION['account'] = $search_term1;
            $_SESSION['from'] = $search_term2;
            $_SESSION['to'] = $search_term3;
            if($search_term == null || $search_term1 == null){
                $sth = mysqli_query($con, "SELECT * FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}') AND (CDM_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}')");

                $trafo_total = mysqli_query($con, "SELECT * FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $total = mysqli_query($con, "SELECT * FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}') AND (CDM_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}')");
                $active = mysqli_query($con, "SELECT * FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}') AND (Project_Status = 'Active') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $on_hold = mysqli_query($con, "SELECT * FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}') AND (Project_Status = 'On Hold') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $delivery_close = mysqli_query($con, "SELECT * FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}') AND (Project_Status = 'Delivery Close') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");

                // average volume calculation per selected account/delivery manager
                $avg_vol_dm_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");

                // average volume calculation for all accounts
                $avg_vol_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");

                // sum per selected account/delivery manager
                $sum_vol_dm_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' or Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $sum_vol_dm_pid = mysqli_fetch_row($sum_vol_dm_pid);

                // sum for all accounts
                $sum_vol_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $sum_vol_pid = mysqli_fetch_row($sum_vol_pid);

                // Rank as per Sum
                $sum_rank = mysqli_query($con, "SELECT `Rank` FROM sum WHERE `Account_Name`='{$search_term1}';");

                // Rank as per Average
                $avg_rank = mysqli_query($con, "SELECT `Rank` FROM average WHERE `Account_Name`='{$search_term1}';");

            }
            if($search_term != null && $search_term1 != null){
                $sth = mysqli_query($con, "SELECT * FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");

                $trafo_total = mysqli_query($con, "SELECT * FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $total = mysqli_query($con, "SELECT * FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $active = mysqli_query($con, "SELECT * FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Status = 'Active') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $on_hold = mysqli_query($con, "SELECT * FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Status = 'On Hold')AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $delivery_close = mysqli_query($con, "SELECT * FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Status = 'Delivery Close') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");

                // average volume calculation per selected account/delivery manager
                $avg_vol_dm_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");

                // average of volume calculation all accounts
                $avg_vol_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");

                // sum per selected account/delivery manager
                $sum_vol_dm_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (CDM_Identifier ='{$search_term}' AND Account_Identifier ='{$search_term1}') AND (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $sum_vol_dm_pid = mysqli_fetch_row($sum_vol_dm_pid);

                // sum for all accounts
                $sum_vol_pid = mysqli_query($con, "SELECT SUM(AS_Approved_Revenue_Budget) FROM dmcdm WHERE (Project_Activation_Date BETWEEN '{$search_term2}' AND '{$search_term3}')");
                $sum_vol_pid = mysqli_fetch_row($sum_vol_pid);

                // Rank as per Sum
                $sum_rank = mysqli_query($con, "SELECT `Rank` FROM sum WHERE `Account_Name`='{$search_term1}';");

                // Rank as per Average
                $avg_rank = mysqli_query($con, "SELECT `Rank` FROM average WHERE `Account_Name`='{$search_term1}';");

            }
            // fetch row to array
            $avg_vol_dm_pid_result = mysqli_fetch_row($avg_vol_dm_pid);
            $avg_vol_pid_result = mysqli_fetch_row($avg_vol_pid);

            // Counting the PID's
            $num_total = mysqli_num_rows($total);
            $num_active = mysqli_num_rows($active);
            $num_onhold = mysqli_num_rows($on_hold);
            $num_deliveryclose = mysqli_num_rows($delivery_close);
            $num_trafo_total = mysqli_num_rows($trafo_total);

            // checking if the no PID is there into database table
            if($num_total == 0){

                // error message if account/delivery manager is not selected or it has null value
                echo '<div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header">There was some errors with your submission</div>
                        <ul class="list">
                            <li>Selected Account/Fiscal Year has no PIDs into the Database.</li>
                        </ul>
                     </div>';
            }else{

                // average per selected account/delivery manager
                $avg_vol_dm_pid_var = ($avg_vol_dm_pid_result[0] / $num_total);

                // average for all accounts
                $avg_vol_pid_var = ($avg_vol_pid_result[0]/$num_trafo_total);

                // final average percentage
                $avg_percent = ($avg_vol_dm_pid_var/$avg_vol_pid_var) * 100;

                // final sum percent
                $sum_percent = ($sum_vol_dm_pid[0]/$sum_vol_pid[0])*100;

                // Rank as per Sum
                $sum_rank_var = mysqli_fetch_row($sum_rank);

                // Rank as per average
                $avg_rank_var = mysqli_fetch_row($avg_rank);
                ?>

<!--            Delivery Manager and account label-->
                <div id="d35" class="ui divided selection list">
                    <a class="item">
                        <div class="ui blue horizontal label">Delivery Manager</div>
                        <b id="bb1"><?php echo $search_term;?></b>
                    </a>
                    <a class="item">
                        <div class="ui blue horizontal label">Account</div>
                        <b id="bb2"><?php echo $search_term1;?></b>
                    </a>
                    <a class="item">
                        <div class="ui blue horizontal label">Fiscal Year</div>
                        <b id="bb3"><?php $fy = substr($search_term2, 0, 4); echo ((int)($fy)) + 1; ?></b>
                    </a>
                </div>

                <!-- Lables for Total , Active, OnHold , Delivery close PID's-->
                <div class="ui big labels fluid">
                    <div class="ui grid">
                        <div class="four wide column">
                            <div id="l21" class="ui grey label">Total PIDs         <br/><div id="d21" class="detail"><?php echo $num_total;?>        </div></div>
                            <div id="l25" class="ui label">Average Volume<br/><div id="d27" class="detail"><?php echo '$'.number_format($avg_vol_dm_pid_var);?></div></div>
                            <div id="l27" class="ui label">Account Sum<br/><div id="d29" class="detail">      <?php echo '$'.number_format($sum_vol_dm_pid[0]);?></div></div>
                        </div>
                        <div class="four wide column">
                            <div id="l22" class="ui grey label">Active PIDs        <br/><div id="d22" class="detail"><?php echo $num_active;?>       </div></div>
                            <div id="l26" class="ui grey label">Total TRAFO Average Volume<br/><div id="d28" class="detail"><?php echo '$'.number_format($avg_vol_pid_var);?></div></div>
                            <div id="l28" class="ui grey label">Total TRAFO Account's Sum<br/><div id="d30" class="detail"><?php echo '$'.number_format($sum_vol_pid[0]);?></div></div>
                        </div>
                        <div class="four wide column">
                            <div id="l23" class="ui grey label">On Hold PIDs       <br/><div id="d23" class="detail"><?php echo $num_onhold;?>       </div></div>
                            <div id="l29" class="ui label">Average Percent<br/><div id="d31" class="detail"><?php echo number_format($avg_percent).'%';?></div></div>
                            <div id="l31" class="ui label">Sum Percent<br/><div id="d33" class="detail"><?php echo number_format($sum_percent).'%';?></div></div>
                        </div>
                        <div class="four wide column">
                            <div id="l24" class="ui grey label">Delivery Close PIDs<br/><div id="d24" class="detail"><?php echo $num_deliveryclose;?></div></div>
                            <a href="/rank.php"><div id="l30" class="ui grey label">Rank as per Average<br/><div id="d32" class="detail"><?php echo $avg_rank_var[0];?></div></div></a>
                            <a href="/rank.php"><div id="l32" class="ui grey label">Rank as per Sum<br/><div id="d34" class="detail"><?php echo $sum_rank_var[0];?></div></div></a>
                        </div>
                    </div>
                </div>
                <div id="d25" class="ui big blue buttons">
                    <button id="b21" class="ui button active" onclick="load21()">Margin%</button>
                    <button id="b22" class="ui button" onclick="load22()">Revenue</button>
                    <button id="b23" class="ui button" onclick="load23()">Costs</button>
                </div>
                <div id="d26">
                    <?php include('dm1.php');?>
                </div>
                <?php include('dmtable.php');?>

<?php
            }
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
            }else{
                // error message if account/delivery manager is not selected or it has null value
                echo '<div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header">There was some errors with your submission</div>
                        <ul class="list">
                            <li>Select Account.</li>
                        </ul>
                     </div>';
            }
        } ?>
    </div>
</div>
</body>
</html>

