<!DOCTYPE HTML>
<html>
<head>
    <!-- Highchart API custom JS, different for different charts -->
    <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: container,
                    type: 'column'
                },
                title: {
                    text: 'Coefficient'
                },
                subtitle: {
                    text: '1)Service Coefficient = Service/Product' +
                    ' 2)TS Coefficient = TS/Product ' + ' 3)AS Coefficient = AS/Product'
                },
                xAxis: {
                    categories: ['']
                },
                yAxis: {
                    title: {
                        text: 'Percent'
                    },
                    labels: {
                        format: '{value}%'
                    }
                },
                legend: {
                },
                tooltip: {
                    shared: true,
                    crosshairs: true,
                    valueSuffix: '%'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                credits: {
                    enabled: false
                },
                series: []
            };
            $.getJSON("includes/sc14data.php", function(json)
            {
                var len = json.length;
                for(i=0;i<len;i++){
                    if(i===0){
                        options.xAxis.categories = json[i]['data'];
                    }else{
                        j = i-1;
                        options.series[j] = json[i];
                    }
                }
                chart = new Highcharts.Chart(options);
            });
        });
    </script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="/data-tables/media/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="/data-tables/media/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../css/sctable.css">

    <!-- DataTables jQuery -->
    <script type="text/javascript" charset="utf8" src="/data-tables/media/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/data-tables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/data-tables/media/js/dataTables.jqueryui.min.js"></script>

    <!-- DataTables Custom JS-->
    <script type="text/javascript" charset="utf8" src="../js/sc14table.js"></script>
</head>
<body>
<!-- div for loading the highchart graph -->
<div id="container" style="min-width: 250px; height: 500px; max-width:1000px; margin: 0 auto"></div>

<!-- div for loading the DataTables-->
<div style="min-width: 250px; height: 100%; max-width:1000px; margin: 0 auto">
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Account</th>
            <th>Product_Coefficient</th>
            <th>TS_Coefficient</th>
            <th>AS_Coefficient</th>
        </tr>
        </thead>
    </table>
</body>
</html>
