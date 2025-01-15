</div>
<!-- end page container -->

<!-- start footer -->
<style>
    .quick-setting-main{
        display: none;
    }
    fieldset.hour {
        background: transparent;
    }
    fieldset.hour:nth-child(1) {
        display: none;
    }
    fieldset.hour legend {
        display: none;
    }
    .datetimepicker-hours table thead,.datetimepicker-minutes  table thead{
        display: none;
    }
    .datetimepicker-hours table,.datetimepicker-minutes table{
        width: 100%;
    }
    fieldset.minute legend {
        display: none;
    }
    th.today {
        text-indent: -999em;
        line-height: 0;
    }
    th.today:after {
        content: "Current Time";
        text-indent: 0;
        display: block;
        line-height: initial;
    }
</style>
<div class="page-footer">

    <div class="page-footer-inner">MSA HUB | 

        <a href="adinstudios.net" target="_blank" class="makerCss">ADIN STUDIOS</a>

    </div>

    <div class="scroll-to-top">

        <i class="icon-arrow-up"></i>

    </div>

</div>

<!-- end footer -->

</div>

<!-- start js include path -->

<script>
    var SITEURL = "<?php echo site_url('/'); ?>";
    var staffAbsense = "<?php echo site_url('/admin/staff-management/add-absense'); ?>";
    var check_session = "<?php echo site_url('/admin/session-management/check-session'); ?>";
</script>

<script src="<?php echo ASSETS; ?>plugins/popper/popper.js"></script>

<script src="<?php echo ASSETS; ?>plugins/jquery-blockui/jquery.blockui.min.js"></script>

<script src="<?php echo ASSETS; ?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- bootstrap -->

<script src="<?php echo ASSETS; ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo ASSETS; ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="<?php echo ASSETS; ?>plugins/sparkline/jquery.sparkline.js"></script>

<script src="<?php echo ASSETS; ?>js/pages/sparkline/sparkline-data.js"></script>


<script src="<?php echo ASSETS; ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker-init.js?ver=1" charset="UTF-8"></script>

<script src="<?php echo ASSETS; ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>



<script src="<?php echo ASSETS; ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js?ver=3.9" charset="UTF-8"></script>



<!-- Common js-->

<script type="text/javascript">

    var global_terms = [];

    var global_programs = [];

    var global_levels = [];

    $(function () {

        global_terms = <?php write(returnTerms()); ?>;

        if (global_terms != [])
            global_terms = global_terms.data;

        global_programs = <?php write(returnPrograms()); ?>;

        if (global_programs != [])
            global_programs = global_programs.data;

        global_levels = <?php write(returnLevels()); ?>;

        if (global_levels != [])
            global_levels = global_levels.data;

    })

</script>

<script src="<?php echo ASSETS; ?>js/app.js"></script>

<script src="<?php echo ASSETS; ?>js/layout.js"></script>

<script src="<?php echo ASSETS; ?>js/theme-color.js"></script>

<!-- material -->

<script src="<?php echo ASSETS; ?>plugins/material/material.min.js"></script>

<!-- chart js -->





<script src="<?php echo ASSETS; ?>js/pages/chart/chartjs/home-data.js"></script>

<script src="<?php echo ASSETS; ?>plugins/material/material.min.js"></script>

<script src="<?php echo ASSETS; ?>plugins/material-datetimepicker/moment-with-locales.min.js"></script>

<script src="<?php echo ASSETS; ?>plugins/material-datetimepicker/bootstrap-material-datetimepicker.js"></script>

<script src="<?php echo ASSETS; ?>plugins/material-datetimepicker/datetimepicker.js"></script>

<!-- summernote -->

<script src="<?php echo ASSETS; ?>plugins/summernote/summernote.js"></script>

<script src="<?php echo ASSETS; ?>js/pages/summernote/summernote-data.js"></script>

<script src="<?php echo ASSETS; ?>js/Application.js?ver=2.6"></script>
<script>
    $('.form_datex input[type="text"]').bootstrapMaterialDatePicker({weekStart: 0, time: false, format: 'DD-MM-YYYY'});
//=============================================//

    $('.form_date_termone input[type="text"]').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        format: 'DD-MM-YYYY'
    }).on('change', function (e, date) {

//        var date1 = $(this).parents(".input-append").prev(".termone").find("input[type='text']").val();
//
//        var firstDate = new Date(date1);
//        var lastDate = new Date(date._d);
//
//        var year2 = firstDate.getFullYear();
//        var month2 = firstDate.getMonth();
//        var day2 = firstDate.getDate();
//
//        var year1 = lastDate.getFullYear();
//        var month1 = lastDate.getMonth();
//        var day1 = lastDate.getDate();
//
//        var dt1 = new Date(year1, month1, day1);
//        // console.log(dt1);
//        var dt2 = new Date(year2, month2, day2);
//        console.log(nWeeksone(dt1, dt2));
//
//        $(this).parents(".input-append").next("input[type='text']").val(nWeeksone(dt1, dt2));
    });


    $('.form_date_termtwo input[type="text"]').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        format: 'DD-MM-YYYY'
    }).on('change', function (e, date) {

//        var date1 = $(this).parents(".input-append").prev(".termtwo").find("input[type='text']").val();
//
//        var firstDate = new Date(date1);
//        var lastDate = new Date(date._d);
//
//        console.log(firstDate + " " + lastDate);
//
//        var year2 = firstDate.getFullYear();
//        var month2 = firstDate.getMonth();
//        var day2 = firstDate.getDate();
//
//        var year1 = lastDate.getFullYear();
//        var month1 = lastDate.getMonth();
//        var day1 = lastDate.getDate();
//
//        var dt1 = new Date(year1, month1, day1);
//        // console.log(dt1);
//        var dt2 = new Date(year2, month2, day2);
//        var fee = $('input[name="termone_fee"]').val();
//        var weeks = parseInt(nWeekstwo(dt1, dt2)) - parseInt(fee);
//        $(this).parents(".input-append").next("input[type='text']").val(weeks);
    });

    $('.form_date_termthree input[type="text"]').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        format: 'DD-MM-YYYY'
    }).on('change', function (e, date) {

//        var date1 = $(this).parents(".input-append").prev(".termthree").find("input[type='text']").val();
//
//        var firstDate = new Date(date1);
//        var lastDate = new Date(date._d);
//
//        var year2 = firstDate.getFullYear();
//        var month2 = firstDate.getMonth();
//        var day2 = firstDate.getDate();
//
//        var year1 = lastDate.getFullYear();
//        var month1 = lastDate.getMonth();
//        var day1 = lastDate.getDate();
//
//        var dt1 = new Date(year1, month1, day1);
//        // console.log(dt1);
//        var dt2 = new Date(year2, month2, day2);
//
//
//        var fee = $('input[name="termone_fee"]').val();
//        var fee2 = $('input[name="termtwo_fee"]').val();
//        var weeks = parseInt(nWeeksthree(dt1, dt2)) - parseInt(fee) - parseInt(fee2);
//        $(this).parents(".input-append").next("input[type='text']").val(weeks);


        // $(this).parents(".input-append").next("input[type='text']").val(nWeeksthree(dt1, dt2));
    });

    $('.form_date_termfour input[type="text"]').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false,
        format: 'DD-MM-YYYY'
    }).on('change', function (e, date) {

//        var date1 = $(this).parents(".input-append").prev(".termfour").find("input[type='text']").val();
//
//        var firstDate = new Date(date1);
//        var lastDate = new Date(date._d);
//
//        var year2 = firstDate.getFullYear();
//        var month2 = firstDate.getMonth();
//        var day2 = firstDate.getDate();
//
//        var year1 = lastDate.getFullYear();
//        var month1 = lastDate.getMonth();
//        var day1 = lastDate.getDate();
//
//        var dt1 = new Date(year1, month1, day1);
//        // console.log(dt1);
//        var dt2 = new Date(year2, month2, day2);
//
//        var fee = $('input[name="termone_fee"]').val();
//        var fee2 = $('input[name="termtwo_fee"]').val();
//        var fee3 = $('input[name="termthree_fee"]').val();
//        var weeks = parseInt(nWeeksthree(dt1, dt2)) - parseInt(fee) - parseInt(fee2) - parseInt(fee3);
//        $(this).parents(".input-append").next("input[type='text']").val(weeks);
        // $(this).parents(".input-append").next("input[type='text']").val(nWeeksfour(dt1, dt2));
    });

//===========================================//


    $('#dob').bootstrapMaterialDatePicker({weekStart: 0, time: false}).on('change', function (e, date) {
        var dates = new Date(date._d).toLocaleString();
        var newdate = new Date(dates);
        var BirthDate = newdate.getFullYear();
        console.log(BirthDate);

        var d = Date(Date.now());

        // Converting the number of millisecond in date string 
        a = d.toString();
        var cdates = new Date(a).toLocaleString();
        var cnewdate = new Date(cdates);
        var cBirthDate = cnewdate.getFullYear();
        var age = cBirthDate - BirthDate;
        $('input[name="age"]').val(age);
    });

    function nWeeksone(date1, date2) {
        var WEEK = 1000 * 60 * 60 * 24 * 7;

        var date1ms = date1.getTime();
        var date2ms = date2.getTime();

        var diff = Math.abs(date2ms - date1ms);

        return Math.floor(diff / WEEK);
    }
    function nWeekstwo(date1, date2) {
        var WEEK = 1000 * 60 * 60 * 24 * 7;

        var date1ms = date1.getTime();
        var date2ms = date2.getTime();

        var diff = Math.abs(date2ms - date1ms);

        return Math.floor(diff / WEEK);
    }
    function nWeeksthree(date1, date2) {
        var WEEK = 1000 * 60 * 60 * 24 * 7;

        var date1ms = date1.getTime();
        var date2ms = date2.getTime();

        var diff = Math.abs(date2ms - date1ms);

        return Math.floor(diff / WEEK);
    }
    function nWeeksfour(date1, date2) {
        var WEEK = 1000 * 60 * 60 * 24 * 7;

        var date1ms = date1.getTime();
        var date2ms = date2.getTime();

        var diff = Math.abs(date2ms - date1ms);

        return Math.floor(diff / WEEK);
    }

    $("#termone_week").on('click', function (e) {
        e.preventDefault();
        var date1 = $("input[name='termone_start_date']").val();
        var date2 = $("input[name='termone_end_date']").val();
        $.ajax({
            type: "post",
            url: "<?= site_url('/admin/general-settings/getWeeks'); ?>",
            data: {
                start_data: date1,
                end_data: date2
            },
            success: function (res) {
                $("input[name='termone_fee']").val(res);
            }
        });

    });
    $("#termtwo_week").on('click', function (e) {
        e.preventDefault();
        var date1 = $("input[name='termtwo_start_date']").val();
        var date2 = $("input[name='termtwo_end_date']").val();
        $.ajax({
            type: "post",
            url: "<?= site_url('/admin/general-settings/getWeeks'); ?>",
            data: {
                start_data: date1,
                end_data: date2
            },
            success: function (res) {
                $("input[name='termtwo_fee']").val(res);
            }
        });

    });
    $("#termfour_week").on('click', function (e) {
        e.preventDefault();
        var date1 = $("input[name='termfour_start_date']").val();
        var date2 = $("input[name='termfour_end_date']").val();
        $.ajax({
            type: "post",
            url: "<?= site_url('/admin/general-settings/getWeeks'); ?>",
            data: {
                start_data: date1,
                end_data: date2
            },
            success: function (res) {
                $("input[name='termfour_fee']").val(res);
            }
        });

    });
    $("#termthree_week").on('click', function (e) {
        e.preventDefault();
        var date1 = $("input[name='termthree_start_date']").val();
        var date2 = $("input[name='termthree_end_date']").val();
        $.ajax({
            type: "post",
            url: "<?= site_url('/admin/general-settings/getWeeks'); ?>",
            data: {
                start_data: date1,
                end_data: date2
            },
            success: function (res) {
                $("input[name='termthree_fee']").val(res);
            }
        });

    });



//    $("input[name='end_time']").on('focus', function () {
//        var time = $(this).parents(".by_day_select").find("input[name='start_time']").val();
//        var duration = $("#duration").val();
//        if (time != "") {
//            $(this).val(addMinutes(time, duration));
//        }
//    });
    function addMinutes(time, minsToAdd) {
        function D(J) {
            return (J < 10 ? '0' : '') + J
        }
        var piece = time.split(':');
        var mins = piece[0] * 60 + +piece[1] + +minsToAdd;
        return D(mins % (24 * 60) / 60 | 0) + ':' + D(mins % 60);
    }
    $('.form_time').datetimepicker({
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0,
        format: 'HH:ii',
        showMeridian: true,
        escape: true,
    }).on('changeDate', function (ev) {
        var time = $(this).parents(".by_day_select").find("input[name='start_time']").val();
        var meridan = $(this).parents(".by_day_select").find("select[name='start_merdian']").val();
        var duration = $("#duration").val();
        var finalTime = changeTime(time, meridan, duration);
//    var time = $(this).parents(".by_day_select").find("input[name='start_time']").val();
//    var duration = $("#duration").val();
        if (time != "") {
            $(this).parents(".by_day_select").find("input[name='end_time']").val(finalTime);
        }
    });
    $("select[name='start_merdian']").on('change', function () {
        var meridian = $(this).val();
        var startTime = $(this).parents(".input-append").find("input[name='start_time']").val();
        var duration = $("#duration").val();
        var finalTime = changeTime(startTime, meridian, duration);
        if (startTime != "") {
            $(this).parents(".by_day_select").find("input[name='end_time']").val(finalTime);
        }
    });
    function changeTime(time, meridan, duration) {
        var now = moment(); // get "now"
        var tims = time + " " + meridan;
        var finalTime = convertTo24Hour(tims);
        var formatted = moment(finalTime, "hh:mm A");
        var timezz = moment(formatted).add(duration, "minutes").format("hh:mm A");
        return timezz;
    }
    function convertTo24Hour(time) {
        var hours = parseInt(time.substr(0, 2));
        if (time.indexOf('am') != -1 && hours == 12) {
            time = time.replace('12', '00');
        }
        if (time.indexOf('pm') != -1 && hours < 12) {
            time = time.replace(hours, (hours + 12));
        }
        return time.replace(/(am|pm)/, '');
    }
</script>

<!-- end js include path -->

</body>

</html>