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
                    <div class="page-title">MAKEUP SESSIONS</div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <form action="<?php echo site_url('/assessment_management/update_makeup_assessment'); ?>" method="POST">
                            <input type="hidden" name="makeup_id" value="<?= $makeup_id;?>"/>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <label>Select Level</label>
                                    <select class="form-control" name="level" id="level">
                                        <option value="">All</option>
                                        <?php
                                        if (!empty($levels)) {
                                            foreach ($levels as $level) {
                                                ?>
                                                <option value="<?php echo $level->id ?>" <?= ($makeup['level_id']==$level->id)?"selected=''":"";?>><?php echo $level->level_name; ?></option>
                                                <?php
                                            }
                                        }
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
                                                    <option value="<?php echo $club->id; ?>" <?= ($makeup['club_id']==$club->id)?"selected=''":"";?>><?php echo $club->club_name; ?></option>
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
                                                <option value="<?php echo $term->id ?>" <?= ($makeup['term_id']==$term->id)?"selected=''":"";?>><?php echo $term->term_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <label>Select Program</label>
                                    <select class="form-control" name="program">
                                        <option value="">All</option>
                                        <?php
                                        if (!empty($programs)) {
                                            foreach ($programs as $program) {
                                                ?>
                                                <option value="<?php echo $program->id ?>" <?= ($makeup['program_id']==$program->id)?"selected=''":"";?>><?php echo $program->program_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                            </div>
                            <div class="day-select">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3 pull-left">
                                    <label>First Venue</label>
                                    <select class="form-control" name="venue">
                                        <?php
                                        echo print_dropdown($venues);
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3 pull-left">
                                    <label>Select Day</label>
                                    <select class="form-control" name="first_day">
                                        <?php
                                        echo print_dropdown($days);
                                        ?>
                                    </select>
                                </div>
                                <div class="clear clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-control-wrapper date-s">
                                            <label>Select Date</label>
                                            <div id="dat_box">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9" id="section1">
                                        <div class="col-md-5 p-t-20 pull-left">
                                            <div class="form-control-wrapper">
                                                <label>Start Time</label>
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
                                        <div class="col-md-5 p-t-20 pull-left">
                                            <div class="form-control-wrapper">
                                                <label>End Time</label>
                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                                    <input name="end_time" id="etime" size="30" type="text" value="" readonly="">
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
                                        <div class="col-md-2 p-t-20 pull-left">
                                            <div class="form-control-wrapper">
                                                <label>Capacity</label>
                                                <input type="text" id="capacity"  name="capacity" class="form-control" placeholder="Capacity"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20 pull-left">
                                            <button type="button" id="add_datewise1" class="btn btn-circle btn-warning">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="select_day1"/>
                                    <div class="add_times1">
                                        <?php
                                        if(!empty($assessments_first_makeup)){
                                            foreach($assessments_first_makeup as $first_makeup){
                                                ?>

                                                <div class="row deleteUs">
                                                    <div class="col-lg-3 pull-left">
                                                        <span class="mdl-chip mdl-chip--deletable">
                                                            <span class="mdl-chip__text">
                                                                <?= $first_makeup['short_code'];?>
                                                                <?= $first_makeup['club_name'];?> | <?= $first_makeup['term_name'];?> |
                                                                <?= $first_makeup['program_name'];?>
                                                                <?= $first_makeup['date'];?>
                                                                <?= $first_makeup['date'];?> | 
                                                                <span class="time">
                                                                    <?= $first_makeup['start_time'];?> | 
                                                                    <?= $first_makeup['end_time'];?> | <?= $first_makeup['day'];?> | 
                                                                    <?= $first_makeup['capacoty'];?>

                                                                </span>
                                                            </span>
                                                            <button class="mdl-chip__action closeme"  data-id="<?= $first_makeup['meta_id']  ;?>" type="button">
                                                                <i class="material-icons">cancel</i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="clear clearfix"></div>
                                    <div class="gap"></div>
                                </div>
                            </div>
                            <div class="day-select">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3 pull-left">
                                    <label>Second Venue</label>
                                    <select class="form-control" name="venue_id_two">
                                        <?php
                                        echo print_dropdown($venues);
                                        ?>

                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3 pull-left">
                                    <label>Select Day</label>
                                    <select class="form-control" name="second_day">
                                        <?php
                                        echo print_dropdown($days);
                                        ?>
                                    </select>
                                </div>
                                <div class="clear clearfix"></div>
                                <div class="row gribes">

                                    <div class="col-md-12">
                                        <div class="form-control-wrapper date-s">
                                            <label>Select Date</label>
                                            <div id="dat_box2">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9" id="section2">
                                        <div class="col-md-5 p-t-20 pull-left">
                                            <div class="form-control-wrapper">
                                                <label>Start Time</label>
                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                                    <input name="start_time" id="stime2" size="30" type="text" value="" readonly="" >
                                                    <select id="start_merdian_two" class="form-control">
                                                        <option value="AM">AM</option>
                                                        <option value="PM">PM</option>
                                                    </select>
                                                    <div class="clear clearfix"></div>
                                                    <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
                                                    <span class="add-on"><i class="fa fa-clock-o"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 p-t-20 pull-left">
                                            <div class="form-control-wrapper">
                                                <label>End Time</label>
                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                                    <input name="end_time" id="etime2" size="30" type="text" value="" readonly="">
                                                    <select id="end_merdian_two" class="form-control">
                                                        <option value="AM">AM</option>
                                                        <option value="PM">PM</option>
                                                    </select>
                                                    <div class="clear clearfix"></div>
                                                    <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
                                                    <span class="add-on"><i class="fa fa-clock-o"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 p-t-20 pull-left">
                                            <div class="form-control-wrapper">
                                                <label>Capacity</label>
                                                <input type="text" id="capacity2"  name="capacity" class="form-control" placeholder="Capacity"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20 pull-left">
                                            <input type='hidden' id='select_date_two' name='select_date_two' value=''/>
                                            <button type="button" id="add_datewise2" class="btn btn-circle btn-warning">Add</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <input type="hidden" name="select_day2"/>
                                    <div class="add_times2">
                                        <?php
                                        if(!empty($assessments_second_makeup)){
                                            foreach($assessments_second_makeup as $first_makeup){
                                                ?>

                                                <div class="row deleteUs">
                                                    <div class="col-lg-3 pull-left">
                                                        <span class="mdl-chip mdl-chip--deletable">
                                                            <span class="mdl-chip__text">
                                                                <?= $first_makeup['short_code'];?>
                                                                <?= $first_makeup['club_name'];?> | <?= $first_makeup['term_name'];?> | 
                                                                <?= $first_makeup['program_name'];?>
                                                                <?= $first_makeup['date'];?>
                                                                <?= $first_makeup['date'];?> | 
                                                                <span class="time">
                                                                    <?= $first_makeup['start_time'];?> | 
                                                                    <?= $first_makeup['end_time'];?> | <?= $first_makeup['day'];?> | 
                                                                    <?= $first_makeup['capacoty'];?>

                                                                </span>
                                                            </span>
                                                            <button class="mdl-chip__action closeme" data-id="<?= $first_makeup['meta_id']  ;?>" type="button">
                                                                <i class="material-icons">cancel</i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                            }}
                                            ?>
                                        </div>
                                        <div class="clear clearfix"></div>
                                        <div class="gap"></div>
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                    <a href="<?= site_url('/assessment-management/makeup-assessment/') ?>" class="btn btn-circle btn-warning black">BACK</a>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                    <button type="submit" class="btn btn-circle btn-warning">SAVE</button>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("select[name='second_day']").on('change', function () {
                var days = $(this).val();
                var terms = $("select[name='terms']").val();
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/assessment-management/find-dates') ?>",
                    data: {days: days,terms:terms},
                    beforeSend: function () {
//$("#dat_box").html('');
$("#dat_box2").html('');
},
success: function (res) {
//$("#dat_box").html(res);
$("#dat_box2").html(res);
}
})

            });

            $("select[name='first_day']").on('change', function () {
                var days = $(this).val();
                var terms = $("select[name='terms']").val();
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/assessment-management/find-dates') ?>",
                    data: {days: days,terms:terms},
                    beforeSend: function () {
                        $("#dat_box").html('');
// $("#dat_box2").html('');
},
success: function (res) {
    $("#dat_box").html(res);
//$("#dat_box2").html(res);
}
})

            });
            $(".page-content").on('click', ".yellow_box", function (e) {
                e.preventDefault();
                $(this).parents(".day-select").find(".yellow_box").removeClass("active_box");
                $(this).addClass("active_box");
                var text_date = $(this).text();
                $(this).parents(".gribes").find("#select_date_two").val(text_date);
                $(this).parents(".page-content").find("#select_date").val(text_date);
            });
            $("#add_datewise1").on('click', function (e) {
                e.preventDefault();
                var start_merdian = $("#start_merdian").val();
                var end_merdian = $("#end_merdian").val();
                var first_days = $("select[name='first_day']").val();
                var first_days_text = $("select[name='first_day']").find("option:selected").text();
                if ($("select[name='level']").val() == "") {
                    alert("Please select level first");
                } else if ($("select[name='clubs']").val() == "") {
                    alert("Please select clubs first");
                } else if ($("#capacity").val() == "") {
                    alert("Please enter capacity first");
                } else if ($("select[name='venue']").val() == "") {
                    alert("Please select venue first");
                } else if ($("select[name='terms']").val() == "") {
                    alert("Please select terms first");
                } else if ($("#section1").find("#days").val() == "") {
                    alert("Please select day first");
                } else if ($("#section1").find("#select_date").val() == "") {
                    alert("Please select date first");
                } else if ($("#section1").find("#stime").val() == "") {
                    alert("Please select start time");
                } else if ($("#section1").find("#etime").val() == "") {
                    alert("Please select end time");
                } else if ($("#section1").find("#etime").val() == "") {
                    alert("Please select end time");
                } else {
                    var elem = '<div class="row deleteUs"><div class="col-lg-2 pull-left"><input type="hidden" name="venues[]" value="' + $("select[name='venue']").val() + '"/>' + $("select[name='venue']").find("option:selected").text() +
                    '</div><div class="col-lg-2 pull-left"><input type="hidden" name="clubez[]" value="' + $("select[name='clubs']").val() + '"/>' + $("select[name='clubs']").find("option:selected").text() +
                    '</div><div class="col-lg-2 pull-left"><input type="hidden" name="termsz[]" value="' + $("select[name='terms']").val() + '"/>' + $("select[name='terms']").find("option:selected").text() +
                    '</div><div class="col-lg-3 pull-left"><input type="hidden" name="programs[]" value="' + $("select[name='program']").val() + '"/>' + $("select[name='program']").find("option:selected").text() + '</div><div class="col-lg-3 pull-left"><span class="mdl-chip mdl-chip--deletable"><span class="mdl-chip__text"><input type="hidden" name="select_dates[]" value="' + $("#select_date").val() + '"/>' + $("#select_date").val() + ' | <span class="time"><input type="hidden" name="start_times[]" value="' + $("#stime").val() + " " + start_merdian + '" />' + $("#stime").val() + " " + start_merdian + ' - <input type="hidden" name="end_times[]" value="' + $("#etime").val() + " " + end_merdian + '" />' + $("#etime").val() + " " + end_merdian + '| ' +" "+ first_days_text +'<input type="hidden" name="first_days_text[]" value="'+first_days_text+'"/>'+ $("#capacity").val() + '<input type="hidden" name="capacities1[]" value="' + $("#capacity").val() + '"/></span></span><button type="button" class="mdl-chip__action closeme"><i class="material-icons">cancel</i></button></span></div></div> ';
                    $(".add_times1").append(elem);
                    $("#stime").val('');
                    $("#etime").val('');
                    $("#select_date").val('');
                    $("#dat_box").find(".yellow_box").removeClass("active_box");
                }
            });
            $("#add_datewise2").on('click', function (e) {
                e.preventDefault();
                var start_merdian = $("#start_merdian_two").val();
                var end_merdian = $("#end_merdian_two").val();
                var second_day = $("select[name='second_day']").val();
                var second_days_text = $("select[name='second_day']").find("option:selected").text();
                if ($("#section2").find("select[name='venue']").val() == "") {
                    alert("Please select venue first");
                } else if ($("select[name='venue_id_two']").val() == "") {
                    alert("Please select venue first");
                } else if ($("#capacity2").val() == "") {
                    alert("Please enter capacity first");
                } else if ($("select[name='clubs']").val() == "") {
                    alert("Please select clubs first");
                } else if ($("select[name='venue']").val() == "") {
                    alert("Please select venue first");
                } else if ($("select[name='terms']").val() == "") {
                    alert("Please select terms first");
                } else if ($("#days2").val() == "") {
                    alert("Please select day first");
                } else if ($("#select_date_two").val() == "") {
                    alert("Please select date first");
                } else if ($("#stime2").val() == "") {
                    alert("Please select start time");
                } else if ($("#etime2").val() == "") {
                    alert("Please select end time");
                } else {
                    var elem = '<div class="row deleteUs"><div class="col-lg-2 pull-left"><input type="hidden" name="venues_two[]" value="' + $("select[name='venue']").val() + '"/>' + $("select[name='venue']").find("option:selected").text() +
                    '</div><div class="col-lg-2 pull-left"><input type="hidden" name="clubez_two[]" value="' + $("select[name='clubs']").val() + '"/>' + $("select[name='clubs']").find("option:selected").text() +
                    '</div><div class="col-lg-2 pull-left"><input type="hidden" name="termsz_two[]" value="' + $("select[name='terms']").val() + '"/>' + $("select[name='terms']").find("option:selected").text() +
                    '</div><div class="col-lg-3 pull-left"><input type="hidden" name="programs_two[]" value="' + $("select[name='program']").val() + '"/>' + $("select[name='program']").find("option:selected").text() + '</div><div class="col-lg-3 pull-left"><span class="mdl-chip mdl-chip--deletable"><span class="mdl-chip__text"><input type="hidden" name="select_dates_two[]" value="' + $("#select_date").val() + '"/>' + $("#select_date").val() + ' | <span class="time"><input type="hidden" name="start_times_two[]" value="' + $("#stime2").val() + " " + start_merdian + '" />' + $("#stime2").val() + " " + start_merdian + ' - <input type="hidden" name="end_times_two[]" value="' + $("#etime2").val() + " " + end_merdian + '" />' + $("#etime2").val() + " " + end_merdian + ' | ' +" "+ second_days_text +'<input type="hidden" name="second_days_text[]" value="'+second_days_text+'"/>'+ $("#capacity2").val() + '<input type="hidden" name="capacities2[]" value="' + $("#capacity2").val() + '"/></span></span><button type="button" class="mdl-chip__action"><i class="material-icons">cancel</i></button></span></div></div> ';
                    $(".add_times2").append(elem);
                    $("#stime").val('');
                    $("#etime").val('');
                    $("#dat_box2").find(".yellow_box").removeClass("active_box");
                }
            });
            $(".day-select").on('click', ".closeme", function () {
                $(this).parents(".deleteUs").remove();
            });

            $(".day-select").on('click',".closeme",function(e){
                e.preventDefault();
                var id= $(this).attr("data-id");
                var that = $(this);
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/assessment_management/delete_makeup') ?>",
                    data: {id: id},
                    success: function (res) {
                        that.parents(".deleteUs").remove();
                    }
                })
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