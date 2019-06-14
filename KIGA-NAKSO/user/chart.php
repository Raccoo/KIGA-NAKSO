<?php
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../json/query.php';
require_once __DIR__ . '/../json/month_json.php';
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

                let tm_data = google.visualization.arrayToDataTable([
                    ['カテゴリー', '消費分', '廃棄分', '繰越分'],
                    ['肉類', <?php if ($t_mon1['pv'] != null) {
                        echo $t_mon1['cv'] . ',' . $t_mon1['dv'] . ',' . $t_mon1['pv'] - $t_mon1['cv'] - $t_mon1['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['魚介類', <?php if ($t_mon2['pv'] != null) {
                        echo $t_mon2['cv'] . ',' . $t_mon2['dv'] . ',' . $t_mon2['pv'] - $t_mon2['cv'] - $t_mon2['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['野菜・果実', <?php if ($t_mon3['pv'] != null) {
                        echo $t_mon3['cv'] . ',' . $t_mon3['dv'] . ',' . $t_mon3['pv'] - $t_mon3['cv'] - $t_mon3['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['穀物', <?php if ($t_mon4['pv'] != null) {
                        echo $t_mon4['cv'] . ',' . $t_mon4['dv'] . ',' . $t_mon4['pv'] - $t_mon4['cv'] - $t_mon4['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['a', <?php if ($t_mon5['pv'] != null) {
                        echo $t_mon5['cv'] . ',' . $t_mon5['dv'] . ',' . $t_mon5['pv'] - $t_mon5['cv'] - $t_mon5['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['b', <?php if ($t_mon6['pv'] != null) {
                        echo $t_mon6['cv'] . ',' . $t_mon6['dv'] . ',' . $t_mon6['pv'] - $t_mon6['cv'] - $t_mon6['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['c', <?php if ($t_mon7['pv'] != null) {
                        echo $t_mon7['cv'] . ',' . $t_mon7['dv'] . ',' . $t_mon7['pv'] - $t_mon7['cv'] - $t_mon7['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>]
                ]);

                let lm_data = google.visualization.arrayToDataTable([
                    ['カテゴリー', '消費分', '廃棄分', '繰越分'],
                    ['肉類', <?php if ($l_mon1['pv'] != null) {
                        echo $l_mon1['cv'] . ',' . $l_mon1['dv'] . ',' . $l_mon1['pv'] - $l_mon1['cv'] - $l_mon1['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['魚介類', <?php if ($l_mon2['pv'] != null) {
                        echo $l_mon2['cv'] . ',' . $l_mon2['dv'] . ',' . $l_mon2['pv'] - $l_mon2['cv'] - $l_mon2['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['野菜・果実', <?php if ($l_mon3['pv'] != null) {
                        echo $l_mon3['cv'] . ',' . $l_mon3['dv'] . ',' . $l_mon3['pv'] - $l_mon3['cv'] - $l_mon3['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['穀物', <?php if ($l_mon4['pv'] != null) {
                        echo $l_mon4['cv'] . ',' . $l_mon4['dv'] . ',' . $l_mon4['pv'] - $l_mon4['cv'] - $l_mon4['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['a', <?php if ($l_mon5['pv'] != null) {
                        echo $l_mon5['cv'] . ',' . $l_mon5['dv'] . ',' . $l_mon5['pv'] - $l_mon5['cv'] - $l_mon5['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['b', <?php if ($l_mon6['pv'] != null) {
                        echo $l_mon6['cv'] . ',' . $l_mon6['dv'] . ',' . $l_mon6['pv'] - $l_mon6['cv'] - $l_mon6['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>],
                    ['c', <?php if ($l_mon7['pv'] != null) {
                        echo $l_mon7['cv'] . ',' . $l_mon7['dv'] . ',' . $l_mon7['pv'] - $l_mon7['cv'] - $l_mon7['dv'];
                    } else echo 0 . ',' . 0 . ',' . 0; ?>]
                ]);

                const options = {
                    title: '月間食材推移表',
                    isStacked: 'percent'
                };

                let options2 = {
                    title: '今月の購入量',
                    is3D: true
                };

                const chart = new google.visualization.ColumnChart(document.getElementById('previous'));
                const chart2 = new google.visualization.ColumnChart(document.getElementById('next'));
                const chart3 = new google.visualization.PieChart(document.getElementById('o'));
                // const chart4 = new google.visualization.DataTable(jsonData);

                chart.draw(tm_data, options);
                chart2.draw(lm_data, options);
                chart3.draw(datao, options2);
                // chart4.draw(..., options);
            }
        </script>
    </head>
    <body>

    <div id="previous" style="float: left; width: 45%; height: 40%"></div>
    <div id="o" style="float: right; width: 45%; height: 40%"></div>
    <div style="clear: both"></div>
    <div id="next" style="float:left;width: 45%; height: 40%"></div>
<!--    <div id="year_waste" style="margin-left: auto; width: 45%; height: 40%"></div>-->

    </body>
    </html>
<?php
require_once __DIR__ . '/../components/footer.php';