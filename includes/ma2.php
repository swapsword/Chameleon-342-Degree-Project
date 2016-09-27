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
                    type: 'line'
                },
                title: {
                    text: 'Milestone Curve',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Actual_Revenue vs AS_Approved_Cost_Budget',
                    x: -20
                },
                xAxis: {
                    categories: [''],
                    labels: {
                        rotation: -45
                    },
                    type: 'datetime',
                    dateTimeLabelFormats: {
                        day: '%e - %b'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Millions'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    shared: true,
                    crosshairs: true,
                    valuePrefix: '$'
                },
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'vertical',
                    x: 0,
                    y: 0
                },
                credits: {
                    enabled: false
                },
                series: []
            };
            $.getJSON("/includes/ma2data.php", function(json)
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
</head>
<body>
<div id="container" style="min-width: 250px; height: 400px; max-width:1000px; margin: 0 auto"></div>

</body>
</html>