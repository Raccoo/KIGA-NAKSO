<!---<?php echo $result[0]['sum']; ?>-->
<?php
require_once __DIR__ . '/../components/header.php'
?>
<html>
<head>
    <link href="../css/KIGA-NAKSO.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">


        google.load('visualization', '1', {'packages': ['corechart']});
        google.setOnLoadCallback(drawChart);

        function drawChart() {

            let data = google.visualization.arrayToDataTable([
                ['カテゴリー', '消費分', '廃棄分', '繰越分'],
                ['肉類', 16.08, 14.74, 10.27],
                ['魚介類', 14.99, 11.01, 9.97],
                ['野菜・果実', 12.91, 6.36, 9.81],
                ['穀物', 12.98, 8.97, 10.03]
            ]);
            const options = {
                title: '月間食材推移表',
                isStacked: true

            };

            let datac = new google.visualization.DataTable();
            datac.addColumn('string', 'Love');
            datac.addColumn('number', 'Votes');
            datac.addRow(['Rust', 30]);
            datac.addRow(['Ruby', 20]);
            datac.addRow(['R', 10]);

            let options2 = {
                title: '円グラフ',
                width: 500,
                height: 300,
                is3D: true
            };

            const chart = new google.visualization.ColumnChart(document.getElementById('previous'));
            const chart2 = new google.visualization.ColumnChart(document.getElementById('next'));
            const chart3 = new google.visualization.PieChart(document.getElementById('o'));
            const chart4 = new google.visualization.ColumnChart(document.getElementById('year_waste'));
            chart.draw(data, options);
            chart2.draw(data, options);
            chart3.draw(data, options2);
            chart4.draw(data, options);
        }
    </script>
</head>
<body>

<div id="previous" style="float: left; width: 45%; height: 40%"></div>
<div id="o" style="float: right; width: 45%; height: 40%"></div>
<div style="clear: both"></div>
<div id="next" style="float:left;width: 45%; height: 40%"></div>
<div id="year_waste" style="margin-left: auto; width: 45%; height: 40%"></div>

</body>
</html>
<?php
require_once __DIR__ . '/../components/footer.php';