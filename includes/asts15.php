<!DOCTYPE HTML>
<html>
<head>
    <script type="text/javascript">
        $(document).ready(function() {
            Highcharts.setOptions({
                lang: {
                    thousandsSep: ','
                }
            });
            var options = {
                chart: {
                    renderTo: 'container',
                    type: 'bar'
                },
                title: {
                    text: 'Product vs Differentiated services',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Fiscal Year 2015 Product/AS/TS view',
                    x: -20
                },
                xAxis: {
                    categories: ['']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Millions'
                    }
                },
                plotOptions: {
                    series: {
                        stacking: 'normal'
                    }
                },
                tooltip: {
                    shared: true,
                    crosshairs: true,
                    revesed: true,
                    valuePrefix: '$'
                },
                legend: {
                    reversed: true
                },
                credits: {
                    enabled: false
                },
                series: []
            };
            $.getJSON("includes/asts15data.php", function(json)
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

    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="/data-tables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/data-tables/media/js/dataTables.jqueryui.min.js"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="../js/asts15table.js"></script>
</head>
<body>
<div id="container" style="min-width: 250px; height: 500px; max-width:1000px; margin: 0 auto"></div>
<div style="min-width: 250px; height: 100%; max-width:1000px; margin: 0 auto">
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Account</th>
            <th>Product</th>
            <th>Advanced_Services</th>
            <th>Technical_Services</th>
        </tr>
        </thead>
    </table>
</div>
</body>
</html>
