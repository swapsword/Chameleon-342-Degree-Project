<!DOCTYPE html>
<html>
<head>
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php include 'includes/logo.php';?>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="semantic/out/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/ma-dashboard.css?<?php echo time();?>">
    <!-- JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <!-- Custom JS for loading menu tab php file onclick -->
    <script>
        $(document).ready(function(){
            $('.ui.dropdown').dropdown({
            });
            $(".close.icon").click(function(){
                $(this).parent().hide();
            });
        });
    </script>
    <!-- JS -->
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
            <h1 id="h1">MA-ACCOUNTS</h1>
        </div>
        <!--Menu for navigation-->
        <div id="d3" class="ui blue compact menu">
            <a href="/ma-dashboard.php" id="a1" class="item active">DASHBOARD</a>
            <a href="/ma-rank.php" id="a1" class="item">ACCOUNT RANKING</a>
        </div>
    </div>
    <!--Right side of page which is loading as per navigation-->
    <div id="dbottom" class="sixteen wide column"><?php include('includes/maindex.php');?></div>
</div>
<!-- Highcharts JS as recommended should be declared in body end-->
<script src="highcharts/js/highcharts.js"></script>
<script src="highcharts/js/modules/exporting.js"></script>
<script src="highcharts/js/modules/export-csv.js"></script>
<script src="highcharts/js/themes/sand-signika.js"></script>
<script src="semantic/out/semantic.min.js"></script>
</body>
</html>