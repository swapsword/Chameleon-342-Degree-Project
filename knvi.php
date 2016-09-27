<!DOCTYPE html>
<html>
<head>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/semantic/out/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/account_listings.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <style>
        #container,#containerB {
            display: inline-block;
            height: 400px;
            width: 598px;
            border: 2px solid;
        }
    </style>

    <!-- Custom JS for button for two fiscal year's -->
    <script type="text/javascript">
        //        Chart A column chart
        $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'container',
                    type: 'column'
                },
                title: {
                    text: 'Value Chain Ratio: Customer Revenue vs Cisco Revenue'
                },
                xAxis: {
                    categories: [
                        'Deutsche Telekom',
                        'Allianz',
                        'VW'
                    ]
                },
                yAxis: [{
                    min: 0,
                    title: {
                        text: 'Revenues'
                    }
                }, {
                    title: {
                        text: 'Values in Millions'
                    },
                    opposite: true
                }],
                legend: {
                    shadow: false
                },
                tooltip: {
                    shared: true,
                    valueSuffix: 'M'
                },
                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Customer Revenues',
                    color: 'rgba(165,170,217,1)',
                    data: [6270, 2300, 2456],
                    pointPadding: 0.3
                }, {
                    name: 'Cisco Revenues',
                    color: 'rgba(126,86,134,.9)',
                    data: [148, 1000, 280],
                    pointPadding: 0.4
                }]
            };
            chart = new Highcharts.Chart(options);
        });

        //        Chart B pie chart
        $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: containerB,
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Value Chain Ratio: Customer Revenue vs Cisco Revenue'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: [{
                        name: 'Deustche Telekom',
                        color: 'rgba(165,170,217,1)',
                        y: 97.7
                    },{
                        name: 'Cisco',
                        color: 'rgba(126,86,134,.9)',
                        y: 2.3
                    }]
                }]
            };
            chart = new Highcharts.Chart(options);
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
            <h1 id="h1">ACCOUNT-LISTINGS</h1>
        </div>
        <!--Menu for navigation-->
        <div id="d3" class="ui blue compact menu">
            <a href="/account-listings.php" id="a1" class="item">Account-Listings</a>
            <a href="/service-coefficient.php" id="a1" class="item">Service-Coefficient</a>
            <a href="/knvi.php" id="a1" class="item active">KNVI's</a>
        </div>
    </div>
    <!--bottom of page which is loading as per navigation-->
    <div id="dbottom" class="sixteen wide column">
        <div id="container"></div>
        <div id="containerB"></div>
    </div>
    <!-- Highcharts JS as recommended should be declared in body end-->
    <script src="highcharts/js/highcharts.js"></script>
    <script src="highcharts/js/modules/exporting.js"></script>
    <script src="highcharts/js/modules/export-csv.js"></script>
    <script src="highcharts/js/themes/sand-signika.js"></script>
</body>
</html>
