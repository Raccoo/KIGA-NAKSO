<?php
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
                    ['畜産', <?php echo $tm['畜産']['cv'] . ',' . $tm['畜産']['dv'] . ',' . ($tm['畜産']['pv'] - ($tm['畜産']['dv'] + $tm['畜産']['cv'])) ?>],
                    ['水産', <?php echo $tm['水産']['cv'] . ',' . $tm['水産']['dv'] . ',' . ($tm['水産']['pv'] - ($tm['水産']['dv'] + $tm['水産']['cv'])) ?>],
                    ['野菜', <?php echo $tm['野菜']['cv'] . ',' . $tm['野菜']['dv'] . ',' . ($tm['野菜']['pv'] - ($tm['野菜']['dv'] + $tm['野菜']['cv'])) ?>],
                    ['その他', <?php echo $tm['その他']['cv'] . ',' . $tm['その他']['dv'] . ',' . ($tm['その他']['pv'] - ($tm['その他']['dv'] + $tm['その他']['cv'])) ?>],
                    ['調味料', <?php echo $tm['調味料']['cv'] . ',' . $tm['調味料']['dv'] . ',' . ($tm['調味料']['pv'] - ($tm['調味料']['dv'] + $tm['調味料']['cv'])) ?>],
                    ['加工食品', <?php echo $tm['加工食品']['cv'] . ',' . $tm['加工食品']['dv'] . ',' . ($tm['加工食品']['pv'] - ($tm['加工食品']['dv'] + $tm['加工食品']['cv'])) ?>],
                    ['粉物', <?php echo $tm['粉物']['cv'] . ',' . $tm['粉物']['dv'] . ',' . ($tm['粉物']['pv'] - ($tm['粉物']['dv'] + $tm['粉物']['cv'])) ?>]
                ]);
                let lm_data = google.visualization.arrayToDataTable([
                    ['カテゴリー', '消費量', '廃棄量', '繰越量'],
                    ['畜産', <?php echo $lm['畜産']['cv'] . ',' . $lm['畜産']['dv'] . ',' . ($tm['畜産']['pv'] - ($tm['畜産']['dv'] + $tm['畜産']['cv'])) ?>],
                    ['水産', <?php echo $lm['水産']['cv'] . ',' . $lm['水産']['dv'] . ',' . ($tm['水産']['pv'] - ($tm['水産']['dv'] + $tm['水産']['cv'])) ?>],
                    ['野菜', <?php echo $lm['野菜']['cv'] . ',' . $lm['野菜']['dv'] . ',' . ($tm['野菜']['pv'] - ($tm['野菜']['dv'] + $tm['野菜']['cv'])) ?>],
                    ['その他', <?php echo $lm['その他']['cv'] . ',' . $lm['その他']['dv'] . ',' . ($tm['その他']['pv'] - ($tm['その他']['dv'] + $tm['その他']['cv'])) ?>],
                    ['調味料', <?php echo $lm['調味料']['cv'] . ',' . $lm['調味料']['dv'] . ',' . ($tm['調味料']['pv'] - ($tm['調味料']['dv'] + $tm['調味料']['cv'])) ?>],
                    ['加工食品', <?php echo $lm['加工食品']['cv'] . ',' . $lm['加工食品']['dv'] . ',' . ($tm['加工食品']['pv'] - ($tm['加工食品']['dv'] + $tm['加工食品']['cv'])) ?>],
                    ['粉物', <?php echo $lm['粉物']['cv'] . ',' . $lm['粉物']['dv'] . ',' . ($lm['粉物']['pv'] - ($lm['粉物']['dv'] + $lm['粉物']['cv'])) ?>]
                ]);
                let data = google.visualization.arrayToDataTable([
                    ['Category', 'WasteVolume'],
                    ['畜産', <?php echo $tm['畜産']['dv'] ?> ],
                    ['水産', <?php echo $tm['水産']['dv'] ?> ],
                    ['野菜', <?php echo $tm['野菜']['dv'] ?> ],
                    ['その他', <?php echo $tm['その他']['dv'] ?> ],
                    ['調味料', <?php echo $tm['調味料']['dv'] ?> ],
                    ['加工食品', <?php echo $tm['加工食品']['dv'] ?> ],
                    ['粉物', <?php echo $tm['粉物']['dv'] ?> ]
                ]);                let monthly_data = google.visualization.arrayToDataTable([
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