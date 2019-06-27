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
                ['カテゴリー', '消費量', '廃棄量'],
                ['畜産', <?php echo $tm['a']['cv'] . ',' . $tm['a']['dv'] ?>],
                ['水産', <?php echo $tm['b']['cv'] . ',' . $tm['b']['dv'] ?>],
                ['農産', <?php echo $tm['c']['cv'] . ',' . $tm['c']['dv'] ?>],
                ['その他', <?php echo $tm['d']['cv'] . ',' . $tm['d']['dv'] ?>],
                ['調味料', <?php echo $tm['e']['cv'] . ',' . $tm['e']['dv'] ?>],
                ['加工食品', <?php echo $tm['f']['cv'] . ',' . $tm['f']['dv'] ?>],
                ['粉物', <?php echo $tm['g']['cv'] . ',' . $tm['g']['dv'] ?>]
            ]);

            let pie_pv = google.visualization.arrayToDataTable([
                ['Category', 'Purchase'],
                ['畜産', <?php echo $tm['a']['pv'] ?>],
                ['水産', <?php echo $tm['b']['pv'] ?>],
                ['農産', <?php echo $tm['c']['pv'] ?>],
                ['その他', <?php echo $tm['d']['pv'] ?>],
                ['調味料', <?php echo $tm['e']['pv'] ?>],
                ['加工食品', <?php echo $tm['f']['pv'] ?>],
                ['粉物', <?php echo $tm['g']['pv'] ?>]
            ]);

            let pie_all_cv_dv = google.visualization.arrayToDataTable([
                ['Category', 'Purchase'],
                ['消費', <?php echo $ctmac_cv ?>],
                ['廃棄', <?php echo $ctmac_dv ?>]
            ]);

            let data = google.visualization.arrayToDataTable([
                ['Category', '畜産', '水産', '農産', 'その他', '調味料', '加工食品', '粉物', {role: 'annotations'}],
                ['今月',
                    <?php echo $tm['a']['cv'] ?>
                    ,<?php echo $tm['b']['cv'] ?>
                    ,<?php echo $tm['c']['cv'] ?>
                    ,<?php echo $tm['d']['cv'] ?>
                    ,<?php echo $tm['e']['cv'] ?>
                    ,<?php echo $tm['f']['cv'] ?>
                    ,<?php echo $tm['g']['cv'] ?>
                    , ''
                ],
                ['先月',
                    <?php echo $lm['a']['cv'] ?>
                    ,<?php echo $lm['b']['cv'] ?>
                    ,<?php echo $lm['c']['cv'] ?>
                    ,<?php echo $lm['d']['cv'] ?>
                    ,<?php echo $lm['e']['cv'] ?>
                    ,<?php echo $lm['f']['cv'] ?>
                    ,<?php echo $lm['g']['cv'] ?>
                    , ''
                ],
                ['１年前',
                    <?php echo $year_ago_cv['a']['cv'] ?>
                    ,<?php echo $year_ago_cv['b']['cv'] ?>
                    ,<?php echo $year_ago_cv['c']['cv'] ?>
                    ,<?php echo $year_ago_cv['d']['cv'] ?>
                    ,<?php echo $year_ago_cv['e']['cv'] ?>
                    ,<?php echo $year_ago_cv['f']['cv'] ?>
                    ,<?php echo $year_ago_cv['g']['cv'] ?>
                    , ''
                ]
            ]);
            let monthly_data = google.visualization.arrayToDataTable([
                ['monthly', '消費量', '廃棄量'],
                <?php
                foreach ($result as $r) {
                    echo "['" . $r['record'] . "'," . $r['cv'] . "," . $r['dv'] . "],";
                }
                if (count($result) < 12) {
                    for ($i = 1; $i < (12 - count($result)); $i++) {
                        echo "['-',0,0],";
                    }
                }
                ?>
            ]);

            const options_cd = {
                title: '今月の食材別消費・廃棄した比率',
                <!-- ジャンル別 -->
                width: 800,
                height: 350,
                isStacked: 'percent',
            };

            const options_pie = {
                title: '今月の食材別購入比率',
                pieHole: 0.4,
            };

            const options_pie_all = {
                title: '今月の全食材 消費・廃棄した比率',
                pieHole: 0.4,
            };

            const options_con = {
                title: '今月の食材別消費比率',
                width: 600,
                height: 400,
                legend: {position: 'right', maxLines: 3},
                bar: {groupWidth: '75%'},
                isStacked: 'percent'
            };

            const options_year = {
                title: '１年間の食材の消費・廃棄した比率',
                width: 600,
                height: 350,
                isStacked: 'percent',
            };

            const chartPer = new google.visualization.BarChart(document.getElementById('per'));
            chartPer.draw(data, options_con);
            const chartYear = new google.visualization.ColumnChart(document.getElementById('year'));
            chartYear.draw(monthly_data, options_year);
            const chartCv = new google.visualization.ColumnChart(document.getElementById('cv'));
            chartCv.draw(tm_data, options_cd);
            const chartPiePV = new google.visualization.PieChart(document.getElementById('piePV'));
            chartPiePV.draw(pie_pv, options_pie);
            const chartPieAll = new google.visualization.PieChart(document.getElementById('pieAll'));
            chartPieAll.draw(pie_all_cv_dv, options_pie_all);
        }
    </script>
</head>
<body>
<div id="per" style="float: left; width: 45%; height: 40%"></div>
<div id="piePV" style="float: right; width: 45%; height: 40%"></div>
<div id="pieAll" style="float: right; width: 45%; height: 40%"></div>
<div style="clear: both"></div>
<div id="cv" style="float:left;width: 45%; height: 40%"></div>
<div id="year" style="margin-left: auto; width: 45%; height: 40%"></div>
</body>
</html>