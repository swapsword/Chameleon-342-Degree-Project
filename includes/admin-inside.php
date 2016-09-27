<?php
/** Staring Session**/
session_start();

/** redirecting to admin.php login page if tried to access without login**/
$username=$_SESSION['username'];
$password=$_SESSION['password'];
if (empty($username) || empty($password)) {
    header('Location: http://localhost/admin.php'); // Redirecting To Admin login page
}
?>

<?php
/** Below are setting of properties of raw data list table view**/

/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 2.0.0
 * @license: see license.txt included in package
 */

/**
 * Basic Grid Sample
 * You can use inline edit mode or dialog edit mode
 */
include_once("../phpgrid/config.php");

include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");

// Database config file to be passed in phpgrid constructor
$db_conf = array(
    "type"         => PHPGRID_DBTYPE,
    "server"     => PHPGRID_DBHOST,
    "user"         => PHPGRID_DBUSER,
    "password"     => PHPGRID_DBPASS,
    "database"     => PHPGRID_DBNAME
);

$g = new jqgrid($db_conf);


//property for setting the column size and horizontal scrolling
$grid["caption"] = "Raw Data";
$grid["autowidth"] = true;
$grid["sortable"] = true;
$grid["autoheight"] = true;
$grid["shrinkToFit"] = false; // dont shrink to fit on screen
$g->set_options($grid);


// select table
$g->table = "avdata";



$out = $g->render("list1");
?>

<!DOCTYPE html>
<html>
<head>
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php include 'logo.php';?>
    <!-- Semantic-UI library:- CSS -->
    <link rel="stylesheet" type="text/css" href="/semantic/out/semantic.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/css/admin-inside.css?<?php echo time();?>">

    <!-- JS JQUERY-->
    <link rel="stylesheet" type="text/css" media="screen" href="/phpgrid/lib/js/themes/redmond/jquery-ui.custom.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/phpgrid/lib/js/jqgrid/css/ui.jqgrid.css">

    <!-- PHP grid JS Library-->
    <script src="/phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
    <script src="/phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="/phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="/phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<script>
//    Semantic UI JS property for dropdown and hiding the error when click on error message cross icon
    $(document).ready(function(){
        $('.ui.dropdown').dropdown({
        });
        $(".close.icon").click(function(){
            $(this).parent().hide();
        });
    });
</script>
<body>
<div class="ui grid">
    <!--Left side of page with logo,title and menu-->
    <div id="dtop" class="sixteen wide column">
        <!--Cisco Logo with link to cisco website-->
        <div id="d1">
            <a href="<?php include 'link.php';?>" class="ui small image">
                <img src="/images/cisco_logo.png">
            </a>
        </div>
        <!--Page Title-->
        <div id="d2">
            <h1 id="h1">ADMIN PANEL</h1>
        </div>
        <!--Menu for navigation-->
        <div id="d3" class="ui blue compact menu">
            <a href="/includes/admin-inside.php" id="a1" class="item active">ADD PID</a>
            <a href="/includes/delete.php" id="a1" class="item">EDIT/DELETE PID</a>
        </div>
        <b id="logout"><a href="http://localhost/logout.php">Log Out</a></b>
    </div>
    <!--Right side of page which is loading as per navigation-->
    <div id="dbottom" class="sixteen wide column">
        <!--Instruction message-->
        <div class="ui message">
            <div class="header">
                Instruction
            </div>
            <ul class="list">
                <li>Below is raw data list downloading from http://ecm-sso.cisco.com/doclinkredirect.html?redirect=/objectId/090dcae183b9afe3/versionLabel/CURRENT. This list is updated weekly with new PID's.</li>
                <li>Please refer below table for checking new PID is added or not.</li>
                <li>If the new PID is found then then please enter it into the field below and press ADD button for adding it to database.</li>
            </ul>
        </div>
        <!--Form for entering the PID for adding it into the database table dmcdm-->
        <h3>Enter PID for adding it to database</h3>
        <form class="ui form" name="add_form" method="POST" action="">
            <div class="four fields">
                <div class="four wide field">
                    <input class="ui input" type="text" name="pid" value="" placeholder="Enter PID for adding it into database"/>
                </div>
                <div class="four wide field">
                    <input class="ui input" type="text" name="cdm" value="" placeholder="CDM Cisco Id"/>
                </div>
                <div class="four wide field">
                    <select class="ui search selection dropdown" name="select_account">
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
                    <input id="i2" class="ui button" type="submit" name="add" value="ADD">
                </div>
            </div>
        </form>
        <div><h1></h1></div>
        <?php
        /* Connecting to database */
        require 'connect.php';
        /* error generation and code run after pressing add button*/
        if(isset($_POST['add'])) {
            if (!empty($_POST['pid']) && !empty($_POST['cdm']) && !empty($_POST['select_account'])) {
                $pid = mysqli_real_escape_string($con, $_POST['pid']);
                $result = mysqli_query($con,"SELECT `Project_Code` FROM opdata.dmcdm where `Project_Code`='{$pid}';");
                $pid_match = mysqli_fetch_row($result);
                $result1 = mysqli_query($con,"SELECT * FROM opdata.avdata where `Project_Code`='{$pid}';");
                $insert = mysqli_fetch_row($result1);
                if($pid == $pid_match[0]){
                    // error message if pid is found/match into database table dmcdm
                    echo '<div class="ui error message">
                            <i class="close icon"></i>
                            <div class="header">PID already present</div>
                            <ul class="list">
                                <li>Please delete the old one first in EDIT/DELETE PID tab table.</li>
                                <li>After deleting add it.</li>
                            </ul>
                          </div>';
                }else{
                    if(empty($insert)){
                        // error message if pid is not found/match into database table avdata
                        echo '<div class="ui error message">
                                <i class="close icon"></i>
                                <div class="header">Enter PID does not exist into the Raw Data List</div>
                                <ul class="list">
                                    <li>Please check whether enter PID exist into the raw data list and if present then try again.</li>
                                </ul>
                              </div>';
                    }else{
                        /* Main code for Inserting selected PID row from raw data list database table avdata to database table dmcdm */
                        /* PID not found, so continue to add this PID into the database table dmcdm */
                        $result = mysqli_query($con,"SELECT * FROM opdata.avdata where `Project_Code`='{$pid}';");
                        $insert = mysqli_fetch_row($result);
                        $id = $insert[0];
                        array_shift($insert); // taking first element id from the array out
                        $select_account = mysqli_real_escape_string($con, $_POST['select_account']);
                        $cdm = mysqli_real_escape_string($con, $_POST['cdm']);
                        array_unshift($insert,$select_account,$cdm); // passing cdm and account identifier into the array
                        //print_r($insert);
                        /*Below is the query for inserting the above array into the database table dmcdm*/
                        $result = mysqli_query($con,"INSERT INTO opdata.dmcdm (Id,Account_Identifier, CDM_Identifier, Project_Code, Project_Name,
                                                    Project_Class, Project_Status, Delivery_Manager, Project_Manager, Global_Deal_ID, Local_Deal_ID,
                                                    SO_Numbers, Project_Activation_Date, End_Customer_Name, End_Customer_GUID_Name, End_Customer_GUID,
                                                    AS_Approved_Cost_Budget, AS_Approved_Revenue_Budget, AS_Approved_Budget_Project_Margin_$,
                                                    `AS_Approved_Budget_Project_Margin_%`, Actual_Total_Costs, `Actual_Cost_w/o_PreSales`, Actual_PreSales_Cost,
                                                    Actual_Revenue) VALUES ('0','$insert[0]','$insert[1]','$insert[2]','$insert[3]','$insert[4]','$insert[5]','$insert[6]','$insert[7]',
                                                    '$insert[8]','$insert[9]','$insert[10]','$insert[11]','$insert[12]','$insert[13]','$insert[14]','$insert[15]','$insert[16]','$insert[17]',
                                                    '$insert[18]','$insert[19]','$insert[20]','$insert[21]','$insert[22]')");
                        // Error generation if the query fails
                        if (!$result) {
                            die('error'.mysqli_error($con));
                        }else{
                            // Success message for query
                            echo '<div class="ui success message">
                                    <i class="close icon"></i>
                                    <div class="header">
                                        PID is Successfully added into the Database.
                                    </div>
                                  </div>';
                        }
//                        echo $_POST['cdm'];
//                        echo $_POST['select_account'];
                    }
                }
            }else{
                // error message if no value is entered into the field
                echo '<div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header">Please enter the PID, CDM CISCO ID and select account.</div>
                     </div>';
            }
        }
        ?>
        <?php echo $out?>
    </div>
</div>
<script src="/semantic/out/semantic.min.js"></script>
</body>
</html>


