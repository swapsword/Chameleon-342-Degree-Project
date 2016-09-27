<!DOCTYPE html>
<html>
<head>
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/semantic/out/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/account_listings.css">
    <link rel="stylesheet" type="text/css" href="css/service_coefficient.css?<?php echo time(); ?>">

    <!-- JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <!-- Custom JS for button for two fiscal year's -->
    <script>
        var enable21 = false;
        var enable22 = true;
        function load21() {
            if(enable21){
                $("#d22").load('includes/sc14.php');
                enable21 = false;
                enable22 = true;
            }
        }
        function load22(){
            if(enable22){
                $("#d22").load('includes/sc15.php');
                enable22 = false;
                enable21 = true;
            }
        }

    </script>
    <style type="text/css">
        ${demo.css}
    </style>
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
            <h1 id="h1">ACCOUNT-LISTINGS</h1>
        </div>
        <!--Menu for navigation-->
        <div id="d3" class="ui blue compact menu">
            <a href="/account-listings.php" id="a1" class="item">Account-Listings</a>
            <a href="/service-coefficient.php" id="a1" class="item active">Service-Coefficient</a>
            <a href="/knvi.php" id="a1" class="item">KNVI's</a>
        </div>
    </div>
    <!--Right side of page which is loading as per navigation-->
    <div id="dbottom" class="sixteen wide column"><div id="d21" class="ui buttons">
            <button id="b21" class="ui blue active button" onclick="load21()">FY_2014</button>
            <button id="b22" class="ui blue button" onclick="load22()">FY_2015</button>
        </div>
        <div id="d22"><?php include('includes/sc14.php');?></div>
    </div>
</div>
<!-- Highcharts JS as recommended should be declared in body end-->
<script src="highcharts/js/highcharts.js"></script>
<script src="highcharts/js/modules/exporting.js"></script>
<script src="highcharts/js/modules/export-csv.js"></script>
<script src="highcharts/js/themes/sand-signika.js"></script>
</body>
</html>

