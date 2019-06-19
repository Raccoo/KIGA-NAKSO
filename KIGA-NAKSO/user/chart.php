<?php
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../json/query.php';
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
                    ['カテゴリー', '消費量', '廃棄量', '繰越量'],
                    ['a', <?php echo $tm['a']['cv'] . ',' . $tm['a']['dv'] . ',' . ($tm['a']['pv'] - ($tm['a']['dv'] + $tm['a']['cv'])) ?>],
                    ['b', <?php echo $tm['b']['cv'] . ',' . $tm['b']['dv'] . ',' . ($tm['b']['pv'] - ($tm['b']['dv'] + $tm['b']['cv'])) ?>],
                    ['c', <?php echo $tm['c']['cv'] . ',' . $tm['c']['dv'] . ',' . ($tm['c']['pv'] - ($tm['c']['dv'] + $tm['c']['cv'])) ?>],
                    ['d', <?php echo $tm['d']['cv'] . ',' . $tm['d']['dv'] . ',' . ($tm['d']['pv'] - ($tm['d']['dv'] + $tm['d']['cv'])) ?>],
                    ['e', <?php echo $tm['e']['cv'] . ',' . $tm['e']['dv'] . ',' . ($tm['e']['pv'] - ($tm['e']['dv'] + $tm['e']['cv'])) ?>],
                    ['f', <?php echo $tm['f']['cv'] . ',' . $tm['f']['dv'] . ',' . ($tm['f']['pv'] - ($tm['f']['dv'] + $tm['f']['cv'])) ?>],
                    ['g', <?php echo $tm['g']['cv'] . ',' . $tm['g']['dv'] . ',' . ($tm['g']['pv'] - ($tm['g']['dv'] + $tm['g']['cv'])) ?>]
                ]);

                let lm_data = google.visualization.arrayToDataTable([
                    ['カテゴリー', '消費量', '廃棄量', '繰越量'],
                    ['a', <?php echo $lm['a']['cv'] . ',' . $lm['a']['dv'] . ',' . ($lm['g']['pv'] - ($lm['g']['dv'] + $lm['g']['cv'])) ?>],
                    ['b', <?php echo $lm['b']['cv'] . ',' . $lm['b']['dv'] . ',' . ($lm['g']['pv'] - ($lm['g']['dv'] + $lm['g']['cv'])) ?>],
                    ['c', <?php echo $lm['c']['cv'] . ',' . $lm['c']['dv'] . ',' . ($lm['g']['pv'] - ($lm['g']['dv'] + $lm['g']['cv'])) ?>],
                    ['d', <?php echo $lm['d']['cv'] . ',' . $lm['d']['dv'] . ',' . ($lm['g']['pv'] - ($lm['g']['dv'] + $lm['g']['cv'])) ?>],
                    ['e', <?php echo $lm['e']['cv'] . ',' . $lm['e']['dv'] . ',' . ($lm['g']['pv'] - ($lm['g']['dv'] + $lm['g']['cv'])) ?>],
                    ['f', <?php echo $lm['f']['cv'] . ',' . $lm['f']['dv'] . ',' . ($lm['g']['pv'] - ($lm['g']['dv'] + $lm['g']['cv'])) ?>],
                    ['g', <?php echo $lm['g']['cv'] . ',' . $lm['g']['dv'] . ',' . ($lm['g']['pv'] - ($lm['g']['dv'] + $lm['g']['cv'])) ?>]
                ]);

                let data = google.visualization.arrayToDataTable([
                    ['Category', 'WasteVolume'],
                    ['a', <?php echo $tm['a']['dv'] ?> ],
                    ['b', <?php echo $tm['b']['dv'] ?> ],
                    ['c', <?php echo $tm['c']['dv'] ?> ],
                    ['d', <?php echo $tm['d']['dv'] ?> ],
                    ['e', <?php echo $tm['e']['dv'] ?> ],
                    ['f', <?php echo $tm['f']['dv'] ?> ],
                    ['g', <?php echo $tm['g']['dv'] ?> ]
                ]);

                let monthly_data = google.visualization.arrayToDataTable([
                    //【急募】横軸のバグ対処['record']
                    ['monthly', '消費量', '廃棄量', '繰越量'],
                    <?php
                        foreach ( $result as $r ) {
                            echo "['" . $r['record'] . "'," . $r['cv'] . "," . $r['dv'] . "," . ($r['pv'] - ($r['dv'] + $r['cv'])) . "],";
                        }
                        if ( count($result) < 12 ) {
                            for ( $i = 1 ; $i < (12 - count($result)) ; $i++ ) {
                                echo "['-',0,0,0],";
                            }
                        }
                    ?>
                ]);

                const tm_options = {
                    title: '今月の食材推移表',
                    isStacked: true
                };

                const lm_options = {
                    title: '先月の食材推移表',
                    isStacked: true
                };

                let yen_options = {
                    title: '今月の食材廃棄量',
                    width: 650,
                    height: 350,
                    is3D: true
                };

                let options = {
                    title: '1年間の食材推移表',
                    isStacked: true
                };

                const chart = new google.visualization.ColumnChart(document.getElementById('previous'));
                const chart2 = new google.visualization.ColumnChart(document.getElementById('next'));
                const chart3 = new google.visualization.PieChart(document.getElementById('o'));
                const chart4 = new google.visualization.ColumnChart(document.getElementById('year_waste'));
                chart.draw(tm_data, tm_options);
                chart2.draw(lm_data, lm_options);
                chart3.draw(data, yen_options);
                chart4.draw(monthly_data, options);
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