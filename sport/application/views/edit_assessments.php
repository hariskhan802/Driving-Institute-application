<div class="page-content-wrapper">
    <?php
    $swal = $this->session->flashdata("popup");
    if (!empty($swal)) {
        ?>
        <script>
            swal("Success", "<?php echo $swal; ?>", "success");
        </script>
        <?php
    }
    ?>
    <div class="page-content" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Assessment Management</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <label>Select Venue</label>
                                <select class="form-control" name="venue" required="">
                                    <?php
                                    echo print_dropdown($venues);
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <label>Select Club</label>
                                <select class="form-control" name="clubs">
                                    <option  value="">All</option>
                                    <?php
                                    $array = array("2", "3", "4");
                                    if (!empty($clubs)) {
                                        foreach ($clubs as $club) {
                                            if (!in_array($club->id, $array)) {
                                                ?>
                                                <option value="<?php echo $club->id; ?>" <?php echo ($assessments['club_id'] == $club->id) ? "selected=''" : "" ?>><?php echo $club->club_name; ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <label>Select Term</label>
                                <select class="form-control" name="terms">
                                    <option value="">All</option>
                                    <?php
                                    if (!empty($terms)) {
                                        foreach ($terms as $term) {
                                            ?>
                                            <option value="<?php echo $term->id ?>" <?php echo ($assessments['term_id'] == $term->id) ? "selected=''" : "" ?>><?php echo $term->term_name ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <label>Select Programme</label>
                                <select class="form-control" name="program">
                                    <option value="">All</option>
                                </select>

                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <label>Select Day</label>
                                <select class="form-control" name="day" id="days">

                                    <option>Select Day</option>

                                    <option value="1">Sunday</option>

                                    <option value="2">Monday</option>

                                    <option value="3">Tuesday</option>

                                    <option value="4">Wednesday</option>

                                    <option value="5">Thursday</option>

                                    <option value="6">Friday</option>

                                    <option value="7">Saturday</option>

                                </select>

                            </div>

                        </div>

                        <div class="day-select">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-control-wrapper date-s">

                                        <label>Select Date</label>

                                        <div id="dat_box">



                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row">


                                <div class="col-md-3">

                                    <div class="form-control-wrapper">

                                        <label>Start Time</label>

                                            <!--  <input type="time" id="stime" class="floating-label mdl-textfield__input" placeholder="Start Time" data-dtp="dtp_l2cPL"> -->

                                        <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                            <input name="start_time" id="stime" size="30" type="text" value="" readonly="" >

                                            <select id="start_merdian" class="form-control">

                                                <option value="AM">AM</option>

                                                <option value="PM">PM</option>

                                            </select>



                                            <div class="clear clearfix"></div>

                                            <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                            <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                        </div>



                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-control-wrapper">

                                        <label>End Time</label>

                                            <!-- <input type="time" id="etime"class="floating-label mdl-textfield__input" placeholder="End Time"> -->

                                        <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                            <input name="end_time" id="etime" size="30" type="text" value="" readonly="" >
                                            <select id="end_merdian" class="form-control">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            <div class="clear clearfix"></div>
                                            <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
                                            <span class="add-on"><i class="fa fa-clock-o"></i></span>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-control-wrapper">
                                        <label>Capacity</label>
                                        <input type="text" id="capacity"  name="capacity" class="form-control" placeholder="Capacity"/>
                                    </div>
                                </div>
                                <div class="col-lg-2">

                                    <button type="button" id="add_datewise" class="btn btn-circle btn-warning">Add</button>

                                </div>





                            </div>



                            <div class="row">
                                <?php //d($assessments); ?>
                                <form action="<?php echo site_url('/admin/assessment-management/save-assessment') ?>" method="post" id="form_time">

                                    <input type="hidden" name="select_day"/>

                                    <input type="hidden" name="childs" id="childs"/>

                                    <div class="add_times">
                                        <div class="row deleteUs">
                                            <div class="col-lg-3 pull-left">
                                                <span class="mdl-chip mdl-chip--deletable">
                                                    <span class="mdl-chip__text">
                                                        <input name="venues" type="hidden" value="<?= $assessments['venue_id']; ?>"><?= $assessments['short_code']; ?> | 
                                                        <input name="clubez" type="hidden" value="<?= $assessments['club_id']; ?>"><?= $assessments['club_name']; ?> | 
                                                        <input name="termsz" type="hidden" value="<?= $assessments['term_id']; ?>"><?= $assessments['term_name']; ?>| 
                                                        <input name="programs" type="hidden" value="<?= $assessments['program_id']; ?>"><?= $assessments['program_name']; ?> |
                                                        <input name="select_dates" type="hidden" value="<?= $assessments['date']; ?>"><?= $assessments['date']; ?> | 
                                                        <span class="time">
                                                            <input name="start_times" type="hidden" value="<?= $assessments['start_time']; ?>"><?= $assessments['start_time']; ?> - 
                                                            <input name="end_times" type="hidden" value="<?= $assessments['end_time']; ?>"><?= $assessments['end_time']; ?> | <?= $assessments['capacity']; ?>
                                                            <input name="capacities" type="hidden" value="<?= $assessments['capacity']; ?>">
                                                        </span>
                                                    </span>
                                                    <button class="mdl-chip__action closeme" type="button">
                                                        <i class="material-icons">cancel</i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear clearfix"></div>

                                    <div class="gap"></div>

                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                        <a href="<?= site_url('/admin/assessment-management/') ?>" class="btn btn-circle btn-warning black">BACK</a>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                        <button type="submit" class="btn btn-circle btn-warning">UPDATE</button>
                                    </div>

                                </form>



                            </div>

                        </div>



                    </div>

                </div>

            </div>

        </div>



    </div>

</div>

<script>

    $(document).ready(function () {

        $("#days").on('change', function () {

            var days = $(this).val();

            $("input[name='select_day']").val(days);

            var terms = $("select[name='terms']").val();

            if (terms == "") {

                alert("please select terms");

            } else {

                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/assessment-management/find-dates') ?>",
                    data: {days: days, terms: terms},
                    beforeSend: function () {

                        $("#dat_box").html('');

                    },
                    success: function (res) {

                        $("#dat_box").html(res);

                    }

                })

            }

        });



        $("#child").on('change', function () {

            var child = $(this).val();

            $("#childs").val(child);

        });





        var dates = [];
        $(".page-content").on('click', ".yellow_box", function () {
//            $(this).parents(".day-select").find(".yellow_box").removeClass("active_box");
            $(this).toggleClass("active_box");
            var text_date = $(this).text();
            $(this).parents(".page-content").find("#select_date").val(text_date);
        });

        $("#add_datewise").on('click', function (e) {
            e.preventDefault();
            var start_merdian = $("#start_merdian").val();
            var end_merdian = $("#end_merdian").val();
            var capacity = $("#capacity").val();
            $("select[name='venue']").val();
            if ($("select[name='venue']").val() == "") {
                alert("Please select venue first");
            } else if ($("select[name='clubs']").val() == "") {
                alert("Please select clubs first");

            } else if ($("select[name='program']").val() == "") {

                alert("Please select program first");

            } else if ($("select[name='terms']").val() == "") {

                alert("Please select terms first");

            } else if ($("#days").val() == "") {

                alert("Please select day first");

            } else if ($("#select_date").val() == "") {

                alert("Please select date first");

            } else if ($("#stime").val() == "") {

                alert("Please select start time");

            } else if ($("#etime").val() == "") {

                alert("Please select end time");

            } else if ($("#capacity").val() == "") {

                alert("Please enter capacity");

            } else {

                var elem = '<div class="row deleteUs">' +
                        '<div class="col-lg-3 pull-left"><span class="mdl-chip mdl-chip--deletable"><span class="mdl-chip__text"><input type="hidden" name="venues" value="' + $("select[name='venue']").val() + '"/>' + $("select[name='venue']").find("option:selected").text() + '| <input type="hidden" name="clubez" value="' + $("select[name='clubs']").val() + '"/>' + $("select[name='clubs']").find("option:selected").text() + '| <input type="hidden" name="termsz" value="' + $("select[name='terms']").val() + '"/>' + $("select[name='terms']").find("option:selected").text() + '| <input type="hidden" name="programs" value="' + $("select[name='program']").val() + '"/>' + $("select[name='program']").find("option:selected").text() + ' | <input type="hidden" name="select_dates" value="' + $("#select_date").val() + '"/>' + $("#select_date").val() + ' | <span class="time"><input type="hidden" name="start_times" value="' + $("#stime").val() + " " + start_merdian + '" />' + $("#stime").val() + " " + start_merdian + ' - <input type="hidden" name="end_times" value="' + $("#etime").val() + " " + end_merdian + '" />' + $("#etime").val() + " " + end_merdian + ' | ' + capacity + '<input type="hidden" name="capacities" value="' + capacity + '" /></span></span><button type="button" class="mdl-chip__action closeme"><i class="material-icons">cancel</i></button></span></div></div> ';
                $(".add_times").html(elem);
                $("#stime").val('');
                $("#etime").val('');
                $("#select_date").val('');
                $("#dat_box").find(".yellow_box").removeClass("active_box");
            }

        });
        $("#form_time").on('click', ".closeme", function () {
            $(this).parents(".deleteUs").remove();
        });
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

    .active_box {

        background: black !important;

        color: yellow !important;

    }

    .clear,.clearfix{

        clear: both;

    }

    .add_times,#form_time {

        width: 100%;

    }

</style>
<script>
    $(document).ready(function () {
        $('select[name="clubs"]').on('change', function () {
            if ($(this).val() != "5") {
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/session_management/getProgramclubs'); ?>",
                    data: {
                        club_id: $(this).val(),
                    },
                    beforeSend: function (res) {
                        $('select[name="program"]').html("");
                    },
                    success: function (res) {
                        $('select[name="program"]').html(res);
                    }
                });
            } else {
                var elm = "<option value=''>All</option><option value='1'>Try Tri</option><option value='2'>Development & Performance</option>";
                $('select[name="program"]').html(elm);
            }

        });

        $.ajax({
            type: 'post',
            url: "<?php echo site_url('/session_management/getProgramclubs'); ?>",
            data: {
                club_id: <?= $assessments['club_id']; ?>,
            },
            beforeSend: function (res) {
                $('select[name="program"]').html("");
            },
            success: function (res) {
                $('select[name="program"]').html(res);
            }
        });


    })
    $(window).on('load', function () {
        var terms = $('select[name="terms"]').val();
        var days = $('select[name="day"]').val();
        setTimeout(function () {
            $.ajax({
                type: 'post',
                url: "<?php echo site_url('/admin/assessment-management/find-dates') ?>",
                data: {days: days, terms: terms},
                beforeSend: function () {
                    $("#dat_box").html('');
                },
                success: function (res) {
                    $("#dat_box").html(res);
                }
            })

        }, 200)
    })
</script>