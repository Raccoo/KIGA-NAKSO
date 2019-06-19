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
            
            <?php
                // categoly names
                define('AAA', 'a');
                define('BBB', 'b');
                define('CCC', 'c');
                define('DDD', 'd');
                define('EEE', 'e');
                define('FFF', 'f');
                define('GGG', 'g');
            ?>

            function drawChart() {

                let tm_data = google.visualization.arrayToDataTable([
                    ['カテゴリー', '消費量', '廃棄量', '繰越量'],
                    [<?php echo $AAA, $tm[$AAA]['cv'] . ',' . $tm[$AAA]['dv'] . ',' . ($tm[$AAA]['pv'] - ($tm[$AAA]['dv'] + $tm[$AAA]['cv'])) ?>],
                    [<?php echo $BBB, $tm[$BBB]['cv'] . ',' . $tm[$BBB]['dv'] . ',' . ($tm[$BBB]['pv'] - ($tm[$BBB]['dv'] + $tm[$BBB]['cv'])) ?>],
                    [<?php echo $CCC, $tm[$CCC]['cv'] . ',' . $tm[$CCC]['dv'] . ',' . ($tm[$CCC]['pv'] - ($tm[$CCC]['dv'] + $tm[$CCC]['cv'])) ?>],
                    [<?php echo $DDD, $tm[$DDD]['cv'] . ',' . $tm[$DDD]['dv'] . ',' . ($tm[$DDD]['pv'] - ($tm[$DDD]['dv'] + $tm[$DDD]['cv'])) ?>],
                    [<?php echo $EEE, $tm[$EEE]['cv'] . ',' . $tm[$EEE]['dv'] . ',' . ($tm[$EEE]['pv'] - ($tm[$EEE]['dv'] + $tm[$EEE]['cv'])) ?>],
                    [<?php echo $FFF, $tm[$FFF]['cv'] . ',' . $tm[$FFF]['dv'] . ',' . ($tm[$FFF]['pv'] - ($tm[$FFF]['dv'] + $tm[$FFF]['cv'])) ?>],
                    [<?php echo $GGG, $tm[$GGG]['cv'] . ',' . $tm[$GGG]['dv'] . ',' . ($tm[$GGG]['pv'] - ($tm[$GGG]['dv'] + $tm[$GGG]['cv'])) ?>]
                ]);

                let lm_data = google.visualization.arrayToDataTable([
                    ['カテゴリー', '消費量', '廃棄量', '繰越量'],
                    [<?php echo $AAA, $lm[$AAA]['cv'] . ',' . $lm[$AAA]['dv'] . ',' . ($lm[$GGG]['pv'] - ($lm[$GGG]['dv'] + $lm[$GGG]['cv'])) ?>],
                    [<?php echo $BBB, $lm[$BBB]['cv'] . ',' . $lm[$BBB]['dv'] . ',' . ($lm[$GGG]['pv'] - ($lm[$GGG]['dv'] + $lm[$GGG]['cv'])) ?>],
                    [<?php echo $CCC, $lm[$CCC]['cv'] . ',' . $lm[$CCC]['dv'] . ',' . ($lm[$GGG]['pv'] - ($lm[$GGG]['dv'] + $lm[$GGG]['cv'])) ?>],
                    [<?php echo $DDD, $lm[$DDD]['cv'] . ',' . $lm[$DDD]['dv'] . ',' . ($lm[$GGG]['pv'] - ($lm[$GGG]['dv'] + $lm[$GGG]['cv'])) ?>],
                    [<?php echo $EEE, $lm[$EEE]['cv'] . ',' . $lm[$EEE]['dv'] . ',' . ($lm[$GGG]['pv'] - ($lm[$GGG]['dv'] + $lm[$GGG]['cv'])) ?>],
                    [<?php echo $FFF, $lm[$FFF]['cv'] . ',' . $lm[$FFF]['dv'] . ',' . ($lm[$GGG]['pv'] - ($lm[$GGG]['dv'] + $lm[$GGG]['cv'])) ?>],
                    [<?php echo $GGG, $lm[$GGG]['cv'] . ',' . $lm[$GGG]['dv'] . ',' . ($lm[$GGG]['pv'] - ($lm[$GGG]['dv'] + $lm[$GGG]['cv'])) ?>]
                ]);

                let data = google.visualization.arrayToDataTable([
                    ['Category', 'WasteVolume'],
                    [<?php echo $AAA, $tm[$AAA]['dv'] ?> ],
                    [<?php echo $BBB, $tm[$BBB]['dv'] ?> ],
                    [<?php echo $CCC, $tm[$CCC]['dv'] ?> ],
                    [<?php echo $DDD, $tm[$DDD]['dv'] ?> ],
                    [<?php echo $EEE, $tm[$EEE]['dv'] ?> ],
                    [<?php echo $FFF, $tm[$FFF]['dv'] ?> ],
                    [<?php echo $GGG, $tm[$GGG]['dv'] ?> ]
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