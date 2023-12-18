<!doctype html>
<html>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart','bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart(){
        var data = google.visualization.arrayToDataTable([
            ['종류', '수'],
            ['오프라인 서점',10],
            ['온라인 서점',50],
        ]);

        var options = {
            title: '제목',
            chartArea: {width: '80%'},
            hAxis: {
                title: '명',
                minValue: 0
            },
            vAxis: {
                title: '경로'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
</head>
<body>
<div id="chart_div"></div>
</body>
</html>