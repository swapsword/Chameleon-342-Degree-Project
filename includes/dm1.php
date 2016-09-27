<!DOCTYPE HTML>
<html>
<head>
    <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'container',
                    type: 'line'
                },
                title: {
                    text: 'Margin Trending Curve',
                    x: -20 //center
                },
                subtitle: {
                    text: 'AS_Approved_Budget_Project_Margin_% compare with average Margin',
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
                        text: 'Percent'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    labels: {
                        format: '{value}%'
                    }
                },
                tooltip: {
                    shared: true,
                    crosshairs: true
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
            $.getJSON("/includes/dm1data.php", function(json)
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
