<?php
session_start();// Starting Session
// redirect if tried to access without login
$username=$_SESSION['username'];
$password=$_SESSION['password'];
if (empty($username) || empty($password)) {
    header('Location: http://localhost/admin.php'); // Redirecting To Admin login page
}
?>
<?php
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
$grid["caption"] = "Sorted required data for further analysis from Raw-Data";
$grid["autowidth"] = true;
$grid["sortable"] = true;
$grid["autoheight"] = true;
$grid["shrinkToFit"] = false; // dont shrink to fit on screen
$g->set_options($grid);


// select table
$g->table = "dmcdm";



$out = $g->render("list1");
?>
<!DOCTYPE html>
<html>
<head>
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php include 'logo.php';?>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/semantic/out/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="/css/admin-inside.css?<?php echo time();?>">

    <!-- JS JQUERY-->
    <link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/themes/redmond/jquery-ui.custom.css"></link>
    <link rel="stylesheet" type="text/css" media="screen" href="../phpgrid/lib/js/jqgrid/css/ui.jqgrid.css"></link>

    <script src="/phpgrid/lib/js/jquery.min.js" type="text/javascript"></script>
    <script src="/phpgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="/phpgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="/phpgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
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
        <?php echo $out?>
    </div>
</div>
</body>
</html>
