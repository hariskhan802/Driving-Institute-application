<div class="page-content-wrapper">
    <div class="page-content" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-3">
                        <div class="page-title">Staff Timetable</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 add-form">
                <div class="card-box">
                    <div class="card-body ">
                        <form action="<?php echo site_url("/staff_timetable/timetable_result/") ?>" method="post">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <select class="form-control" id="terms" name="terms">
                                        <?php print_dropdown($terms); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <select class="form-control" id="clubs" name="clubs">
                                        <?php print_dropdown($clubs); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <select class="form-control" id="programs" name="programs">
                                        <option value="">Select Programme</option>
                                        <?php print_dropdown($programs); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <select class="form-control" id="levels" name="levels">
                                        <option value="">Select Levels</option>
                                    </select>
                                </div>
                            </div>
                            <div class="gap"></div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <select class="form-control" id="staffs" name="coaches">
                                        <?php print_dropdown($Coaches); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <button class="btn btn-circle btn-warning" type="submit">Search Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-box">

                    <div class="card-body" id="result_box">

                        <?php
                        if (empty($html)) {
                            $CI = & get_instance();
                            foreach ($days as $day) {
                                $sessions = $CI->get_timetable($day['id']);
                                ?>
                                <div class="row">
                                    <div class="col-lg-12 col-md-6 col-sm-12 col-12" style="">
                                        <h3 class="paddar"><?php echo $day['day_name'] ?></h3>
                                    </div>
                                    <?php
                                    foreach ($sessions as $session) {
                                        $startTimez = explode(",", $session['start_time']);
                                        $endTimez = explode(",", $session['end_time']);
                                        $finalTime = array();
                                        foreach ($startTimez as $key => $startTime) {
                                            $finalTime[] = $startTime . " - " . $endTimez[$key];
                                        }
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-3 box_session" style="background:<?php echo $session['color'] ?>">
                                            <h4><?php echo $session['club_name']; ?></h4>
                                            <p><strong><?php echo $session['program_name']; ?> | </strong><strong><?php echo $session['venue_name']; ?></strong> </p>
                                            <h2><?php echo $session['first_name'] . " " . $session['last_name']; ?></h2>
                                            <?php
                                            if (!empty($finalTime)) {
                                                foreach ($finalTime as $finalx) {
                                                    ?>
                                                    <span class="time_box"><?= $finalx; ?></span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        } else {
                            echo $html;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end chat sidebar -->
    </div>
    <!-- end page container -->
</div>
<style>
    span.colorbox {
        width: 40px;
        height: 30px;
        display: inline-block;
        text-align: center;
        color: #fff;
        margin: 0 0 0 3px;
    }
    h3.paddar {
        padding: 12px 12px 12px 23px !important;
    }
    .box_session {
        margin: 0 0 20px 30px;
        border-radius: 10px;
        color:#fff;
    }
    .box_session h4 {
        font-weight: bold;
        color: #fff;
    }
</style>
<script>
    $(document).ready(function () {
        $("#clubs").on('change', function () {
            var club_id = $(this).val();
            $.ajax({
                type: 'post',
                url: "<?= site_url('/session_management/getProgramclubs') ?>",
                data: {club_id: club_id},
                success: function (res) {
                    $("#programs").html(res);
                }
            })
        });

        $("#programs").on('change', function () {
            var program_id = $(this).val();
            $.ajax({
                type: 'post',
                url: "<?= site_url('/session_management/getProgramLevels') ?>",
                data: {program_id: program_id},
                success: function (res) {
                    $("#levels").html(res);
                }
            })
        });
    });
</script>