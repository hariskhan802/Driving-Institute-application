<div class="page-content-wrapper">
    <div class="page-content" style="min-height:546px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Business Projections</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('/'); ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Business Projections</li>
                </ol>
            </div>
        </div>
        <!-- start widget -->
        <div class="card-box">
            <div class="card-body">
                <form method="GET" action="<?= $_SERVER['REQUEST_URI'] ?>">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <label>Select Term</label>
                            <select class="form-control" id="term_drp" name="term">
                                <?php print_dropdown($terms); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <label> Select Venue</label>
                            <select class="form-control" id="venues_drp" name="venues">
                                <?php print_dropdown($venues); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <label>Select Club</label>
                            <select class="form-control" id="club_drp" name="club">
                                <?php print_dropdown($clubz); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <label>Select Level</label>
                            <select class="form-control" id="levels_drp" name="levelx">
                                <?php print_dropdown($levels); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <button class="btn btn-circle btn-warning" type="submit">Search Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="state-overview">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="info-box bg-b-green">
                        <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL STUDENTS</span>
                            <span class="info-box-number"><?= $students['count']; ?></span>
                            <!--                            <div class="progress">
                                                            <div class="progress-bar" style="width: 45%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            45% Increase in 28 Days
                                                        </span>-->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="info-box bg-b-yellow">
                        <span class="info-box-icon push-bottom"><i class="material-icons">person</i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">NEW STUDENTS</span>
                            <span class="info-box-number"><?= $students['count']; ?></span>
                            <!--                            <div class="progress">
                                                            <div class="progress-bar" style="width: 40%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            40% Increase in 28 Days
                                                        </span>-->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="info-box bg-b-blue">
                        <span class="info-box-icon push-bottom"><i class="material-icons">school</i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">CHILD RETENTION</span>
                            <span class="info-box-number"><?= $students['count']; ?></span>
                            <!--                            <div class="progress">
                                                            <div class="progress-bar" style="width: 85%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            85% Increase in 28 Days
                                                        </span>-->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="info-box bg-b-pink">
                        <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">TOTAL REVENUE</span>
                            <span class="info-box-number">0</span><span>$</span>
                            <!--                            <div class="progress">
                                                            <div class="progress-bar" style="width: 50%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            50% Increase in 28 Days
                                                        </span>-->
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- end widget -->
        <!-- chart start -->
        <div class="row">
            <div class="col-sm-8">
                <div class="card card-box">
                    <div class="card-head">
                        <header>CLUB PROJECTION</header>
                        <div class="tools">

                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>

                        </div>
                    </div>
                    <div class="card-body no-padding">
                        <div class="row">
                            <!--<canvas id="canvas1" width="682" height="341" style="display: block; width: 682px; height: 341px;"></canvas>-->
                            <div id="chartContainer" style="width: 100%;"></div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card card-box">
                    <div class="card-head">
                        <header>SESSION COMPARISONS</header>
                        <div class="tools">
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>

                        </div>
                    </div>
                    <div class="card-body no-padding height-9">
                        <div class="row"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                            <canvas id="chartjs_pie" width="316" height="316" style="display: block; width: 316px; height: 316px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
       
    </div>

</div>
<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "CLUB PROJECTIONS"
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            data: [{
                    type: "column",
                    name: "Proven Oil Reserves (bn)",
                    legendText: "Proven Oil Reserves",
                    showInLegend: true,
                    dataPoints: [
                        {label: "Term1", y: <?= $clubs['swim_count']; ?>},
                        {label: "Term2", y: <?= $clubs['football_count']; ?>},
                        {label: "Term3", y: <?= $clubs['netball_count']; ?>},
                        {label: "Term4", y: <?= $clubs['tri_count']; ?>},
         
                    ]
                },
                {
                    type: "column",
                    name: "Oil Production (million/day)",
                    legendText: "Oil Production",
                    axisYType: "secondary",
                    showInLegend: true,
                    dataPoints: [
                        {label: "Term1", y: <?= $clubs['swim_count']; ?>},
                        {label: "Term2", y: <?= $clubs['football_count']; ?>},
                        {label: "Term3", y: <?= $clubs['netball_count']; ?>},
                        {label: "Term4", y: <?= $clubs['tri_count']; ?>},
         
                    ]
                },
                {
                    type: "column",
                    name: "Oil Production (million/day)",
                    legendText: "Oil Production",
                    axisYType: "secondary",
                    showInLegend: true,
                    dataPoints: [
                        {label: "Term1", y: <?= $clubs['swim_count']; ?>},
                        {label: "Term2", y: <?= $clubs['football_count']; ?>},
                        {label: "Term3", y: <?= $clubs['netball_count']; ?>},
                        {label: "Term4", y: <?= $clubs['tri_count']; ?>},
         
                    ]
                },
                {
                    type: "column",
                    name: "Oil Production (million/day)",
                    legendText: "Oil Production",
                    axisYType: "secondary",
                    showInLegend: true,
                    dataPoints: [
                        {label: "Term1", y: <?= $clubs['swim_count']; ?>},
                        {label: "Term2", y: <?= $clubs['football_count']; ?>},
                        {label: "Term3", y: <?= $clubs['netball_count']; ?>},
                        {label: "Term4", y: <?= $clubs['tri_count']; ?>},
         
                    ]
                },
                {
                    type: "column",
                    name: "Oil Production (million/day)",
                    legendText: "Oil Production",
                    axisYType: "secondary",
                    showInLegend: true,
                    dataPoints: [
                        {label: "Term1", y: <?= $clubs['swim_count']; ?>},
                        {label: "Term2", y: <?= $clubs['football_count']; ?>},
                        {label: "Term3", y: <?= $clubs['netball_count']; ?>},
                        {label: "Term4", y: <?= $clubs['tri_count']; ?>},
         
                    ]
                }]
        });
        chart.render();

        function toggleDataSeries(e) {
            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    }

//    if ($("#canvas1").length > 0) {
//        var ctx = document.getElementById("canvas1").getContext("2d");
//        window.myBar = new Chart(ctx, {
//            "type": "bar",
//            "data": {
//                "labels": ["My Swim Club", "My Football Club", "My Tri Club", "My Netball Club", "My Holiday Camp"],
//                "datasets": [{
//                        "label": "CLUBS",
//                        "data": [<?= $clubs['swim_count']; ?>, <?= $clubs['football_count']; ?>, <?= $clubs['netball_count']; ?>, <?= $clubs['holiday_count']; ?>, <?= $clubs['tri_count']; ?>],
//                        "fill": false,
//                        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)"],
//                        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)"],
//                        "borderWidth": 1
//                    }]
//            },
//            "options": {
//                "scales": {
//                    "yAxes": [{
//                            "ticks": {
//                                "beginAtZero": true
//                            }
//                        }]
//                }
//            }
//        });
//    }
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                    "data": [<?= $sessions['swim_count']; ?>, <?= $sessions['football_count']; ?>, <?= $sessions['netball_count']; ?>, <?= $sessions['holiday_count']; ?>, <?= $sessions['tri_count']; ?>],
                    backgroundColor: [
                        window.chartColors.red,
                        window.chartColors.orange,
                        window.chartColors.yellow,
                        window.chartColors.green,
                        window.chartColors.blue,
                    ],
                    label: 'SESSIONS'
                }],
            labels: [
                "My Swim Club",
                "My Football Club",
                "My Tri Club",
                "My Netball Club",
                "My Holiday Camp"
            ]
        },
        options: {
            responsive: true
        }
    };
    if ($("#chartjs_pie").length > 0) {
        var ctx = document.getElementById("chartjs_pie").getContext("2d");
        window.myPie = new Chart(ctx, config);
    }
</script>