<div class="page-content-wrapper">
    <div class="page-content" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-6">
                        <div class="page-title">Attendance Management</div>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">

                    </div>
                </div>

            </div>
        </div>

        <div class="card card-box">

            <div class="card-body " id="bar-parent5">
                <form method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                            <label>Select Day</label>
                            <select class="form-control" name="days" id="dayz" data-name="Days">
                                <option value="">Select day</option>
                                <?php foreach ($days as $day) { ?>
                                    <option value="<?= $day['id']; ?>" <?php echo ($this->input->get('days') == $day['id']) ? "selected=''" : '' ?>><?= $day['day_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <label>Select Coaches</label>       
                            <select class="form-control" id="timex" name="time">
                                <option value="">Select Time</option>
                                <?php
                                foreach ($session_time as $time) {
                                    ?>
                                    <option value="<?php echo $time['start_time'] . " - " . $time['end_time'] ?>" <?php echo ($this->input->get('time') == $time['start_time'] . " - " . $time['end_time']) ? "selected=''" : '' ?>><?php echo $time['start_time'] . " - " . $time['end_time'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <label>Select Coaches</label>		
                            <select class="form-control" name="coaches">
                                <?php print_dropdown($Coaches) ?>			
                            </select>
                        </div>
                        <input type="hidden" value="1" name="attendance"/>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <label>&nbsp;</label>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <button class="btn btn-circle btn-warning" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">

                    <div class="card-body ">
                        <div class="row">
                            <?php
                            if ($this->input->get('attendance')) {
                                $WHERE = '';
                                if ($this->input->get('days')) {
                                    $WHERE .= ' AND sm.day_id=' . $this->input->get('days');
                                }
                                if ($this->input->get('time')) {
                                    $Time = explode("-", urldecode($this->input->get('time')));
                                    $start_time = trim($Time[0]);
                                    $end_time = trim($Time[1]);
                                    $WHERE .= " AND sm.start_time='{$start_time}' AND sm.end_time='{$end_time}'";
                                }
                                if ($this->input->get('coaches')) {
                                    $WHERE .= ' AND sm.coach_id=' . $this->input->get('coaches');
                                }

                                if (!empty($by_venues)) {
                                    foreach ($by_venues as $key => $venue) {
                                        $students = $this->db->query("SELECT 
                                            s.`firstname`,
                                            s.`lastname`,
                                            v.`venue_name`,
                                            sm.`start_time`,
                                            sm.`end_time`,
                                            ss.`venue_id`,
                                            l.`color`,
                                            s.`id`,
                                            sm.`day_id`,
                                            sm.`coach_id`
                                            FROM
                                            `enrollments` e 
                                            INNER JOIN `enrollments_meta` em 
                                            ON e.`id` = em.`enroll_id` 
                                            INNER JOIN sessions_meta sm 
                                            ON sm.`meta_id` = em.`session_meta_id` 
                                            INNER JOIN `students` s 
                                            ON e.`child_id` = s.`id` 
                                            INNER JOIN sessions ss 
                                            ON ss.`id` = sm.`session_id` 
                                            INNER JOIN `venues` v 
                                            ON v.`id` = s.`venue_id` 
                                            INNER JOIN `levels` l 
                                            ON l.`id` = ss.`level_id`
                                            WHERE v.id='{$venue['id']}' $WHERE
                                            GROUP BY s.`venue_id` ")->result_array();
                                        if (!empty($students)) {
                                            $count = 0;
                                            foreach ($students as $child) {
                                                if ($venue['id'] == $child['venue_id']) {
                                                    ?>
                                                    <div class="col-md-12">
                                                        <h4 class="headin">
                                                            <?php
                                                            if ($count == 0) {
                                                                echo $venue['venue_name'];
                                                            }
                                                            ?> 
                                                            <span class="col-md-3 pull-right"><?= $child['start_time'] . " - " . $child['end_time'] ?></span>
                                                        </h4>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="child-att" style="background:<?= $child['color'] ?>">
                                                            <div class="left">
                                                                <h3><?= $child['firstname'] . " " . $child['lastname']; ?></h3>
                                                                <span>Total Ticks <span>04/08</span></span>
                                                            </div>
                                                            <?php
            $marked = $this->db->query("SELECT * FROM attendance 
                WHERE venue_id='{$child['venue_id']}'
                AND day_id='{$child['day_id']}'
                AND coach_id='{$child['coach_id']}'
                AND child_id='{$child['id']}'
                AND start_time='{$child['start_time']}'
                AND end_time='{$child['end_time']}'
                ")->row_array();
                                                            ?>
                <div class="right actions">
                    <a href="#"  class="delete_attendance" data-venue_id="<?= $child['venue_id']; ?>" data-coach_id="<?= $child['coach_id']; ?>" data-end_time="<?= $child['end_time']; ?>" data-child_id="<?= $child['id']; ?>" data-day_id="<?= $child['day_id']; ?>" data-start_time="<?= $child['start_time']; ?>" data-end_time="<?= $child['end_time']; ?>">
                        <i class="material-icons f-left">close</i>
                    </a>
                    <a class="present mark_attend <?php echo (!empty($marked))?'marked':''?>" data-venue_id="<?= $child['venue_id']; ?>" data-coach_id="<?= $child['coach_id']; ?>" data-end_time="<?= $child['end_time']; ?>" data-child_id="<?= $child['id']; ?>" data-day_id="<?= $child['day_id']; ?>" data-start_time="<?= $child['start_time']; ?>" data-end_time="<?= $child['end_time']; ?>" href="#" title="Yes">
                        <i class="material-icons f-left">check</i>
                    </a>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <?php
                                                }

                                                $count++;
                                            }
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end chat sidebar -->
    </div>
    <!-- end page container -->
</div>
<script>
    $("#program_drp").on('change', function () {
        var program_id = $(this).val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('/admin/session-management/getprogramlevels') ?>",
            data: {program_id: program_id},
            success: function (res) {
                $("#level_drp").html(res);
            }
        });


    });
    $(".mark_attend").on('click', function () {
        var venue_id = $(this).attr("data-venue_id");
        var coach_id = $(this).attr("data-coach_id");
        var end_time = $(this).attr("data-end_time");
        var child_id = $(this).attr("data-child_id");
        var day_id = $(this).attr("data-day_id");
        var start_time = $(this).attr("data-start_time");

        $.ajax({
            type: 'post',
            url: "<?php echo site_url('/admin/attendance-management/mark_attendance') ?>",
            data: {venue_id: venue_id, coach_id: coach_id, end_time: end_time, child_id: child_id, day_id: day_id, start_time: start_time},
            success: function (res) {
                alert(res);
            }
        })
    });
    $(".delete_attendance").on('click', function () {
        var venue_id = $(this).attr("data-venue_id");
        var coach_id = $(this).attr("data-coach_id");
        var end_time = $(this).attr("data-end_time");
        var child_id = $(this).attr("data-child_id");
        var day_id = $(this).attr("data-day_id");
        var start_time = $(this).attr("data-start_time");

        $.ajax({
            type: 'post',
            url: "<?php echo site_url('/admin/attendance-management/delete_attendance') ?>",
            data: {venue_id: venue_id, coach_id: coach_id, end_time: end_time, child_id: child_id, day_id: day_id, start_time: start_time},
            success: function (res) {
                alert(res);
            }
        })
    });
    $("#dayz").on('change', function () {
        var days = $(this).val();
        //$("input[name='select_day']").val(days);
        var terms = $("#termz").val();
        if (terms == "") {
            alert("please select terms");
        } else {
            $.ajax({
                type: 'post',
                url: "<?php echo site_url('/admin/attendance-management/find_date') ?>",
                data: {days: days, terms: terms},
                beforeSend: function () {
                    $("#AttendanceManager").find('.modal-body').html("");
                },
                success: function (res) {
                    $("#AttendanceManager").find('.modal-body').html(res);
                }
            })
        }
    });

    $("#AttendanceManager").on('click', ".yellow_box", function () {
        $(this).parents("#AttendanceManager").find(".yellow_box").removeClass("active_box");
        $(this).addClass("active_box");
        var text_date = $(this).text();
        $(this).parents("#AttendanceManager").find("#select_date").val(text_date);
    });
</script>
<style>
    a.yellow_box {
        font-size: 12px;
        display: inline-block;
        padding: 5px;
        background: yellow;
        color: #000;
        margin: 2px;
    }
    a.yell_box {
        font-size: 12px;
        display: inline-block;
        padding: 5px;
        background: yellow;
        color: #000;
        margin: 2px;
    }
    .active_box {
        background: black !important;
        color: yellow !important;
    }
    .clear,.clearfix{
        clear:both;
    }
    h4.headin {
        background: #171616;
        padding: 12px;
        border-radius: 15px;
        color: #fff;
    }
    .marked {
    background: #fbed22 !important;
    color: #000 !important;
}
</style>

<script>
    $("#mark_attendance").on('click', function () {
        var datev = $("#select_date").val();
        var dataSerial = $("#modalForm").serialize();
        if (datev == "") {
            alert("Please Select Date");
            return false;
        } else {
            $.ajax({
                type: 'post',
                url: "<?php echo site_url('admin/attendance-management/save_attendance') ?>",
                data: dataSerial,
                success: function (res) {
                    if (res == "0") {
                        var elemn = '<div class="alert alert-danger in alert-dismissible" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Sorry!</strong> Attendance has been already marked</div>';
                        $("#show_status").html(elemn);
                    } else {
                        var elemn = '<div class="alert alert-success in alert-dismissible" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>Success!</strong> Attendance has been successfully marked</div>';
                        $("#show_status").html(elemn);
                    }
                }
            })
        }
    });

</script>