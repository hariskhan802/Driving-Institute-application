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
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-6">
                        <div class="page-title">EDIT SESSION</div>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </div>

        <form action="<?php echo site_url("/admin/session-management/update-session") ?>" method='post'>

            <input type="hidden" name="session_id" value="<?= $sessions['id'] ?>"/>

            <div class="row">



                <div class="col-sm-12">



                    <div class="card-box">



                        <div class="card-body">







                            <div class="row">



                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">


                                    <label> Select Venue</label>
                                    <select class="form-control" id="venues_drp" name="venues" required="">

                                        <?php print_dropdown($venues); ?>
                                    </select>



                                </div>



                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">


                                    <label>Select Term</label>
                                    <select class="form-control" id="term_drp" name="term" disabled="" required="">



                                        <?php print_dropdown($terms); ?>



                                    </select>



                                </div>



                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">


                                    <label>Select Club</label>
                                    <select class="form-control" id="club_drp" name="club" required="">



                                        <?php print_dropdown($clubs); ?>



                                    </select>



                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Enter Session Name</label>
                                    <input type="text" name="session_name" id="session_name" class="form-control" placeholder="Enter Session Name" value="<?= $sessions['session_name'] ?>" required="">

                                </div>



                            </div>



                            <div class="gap"></div>



                            <div class="row">



                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">


                                    <label>Select Programme</label>
                                    <select class="form-control" id="program_drp" name="program" required="">



                                        <?php print_dropdown($programs); ?>



                                    </select>



                                </div>



                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">


                                    <label>Select Lavel</label>
                                    <select class="form-control" id="level_drp" name="level" required="">



                                        <?php print_dropdown($levels); ?>



                                    </select>
                                    <input type="hidden" id="duration" value="<?= $sessions['duration'] ?>"/>



                                </div>



                            </div>







                        </div>



                    </div>



                    <div class="gap"></div>



                    <div id="area">



                        <div class="sessioncreate-one" id="sessioncreate-one">







                        </div>



                    </div>



                    <div class="sessioncreate-two" id="sessioncreate-two" style="display: none;">



                        <div class="row by_sunday by_day_select" data-day="Sunday" data-day_id="1">



                            <div class="col-md-12">



                                <div class="card-box">



                                    <div class="card-body">



                                        <div class="row session-day">



                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 daywise">



                                                <h3 class="day">Sunday</h3>



                                            </div>







                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <div class="form-control-wrapper">



                                                    <label>Start Time</label>



                                                    <div class="input-append  date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">





                                                        <input name="start_time" autocomplete="off" size="30" type="text" value=""  >


                                                        <select name="start_merdian" class="form-control">

                                                            <option value="AM">AM</option>

                                                            <option value="PM">PM</option>

                                                        </select>



                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>



                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>



                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 display_none">



                                                <div class="form-control-wrapper">



                                                    <label>End Time</label>



                                                    <div class="input-append row date " data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">



                                                        <input name="end_time" autocomplete="off" size="30" type="text" value=""  >


                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Programme Area</label>



                                                <select class="form-control" name="program_area">



                                                    <option value="1">Open to All</option>



                                                    <option value="2">Venue Only</option>



                                                </select>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Assign Staff</label>



                                                <select class="form-control" name="assign_staff">



                                                    <option value="">Assign Staff</option>



                                                    <?php
                                                    if (!empty($staffs)) {



                                                        foreach ($staffs as $staff) {
                                                            ?>



                                                            <option value="<?php echo $staff['id']; ?>"><?php echo $staff['username']; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>



                                                </select>



                                            </div>







                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">



                                                <button type="button" class="by_day_btn btn yellow btn-outline btn-circle m-b-10" id="sunday_btn">ADD</button>



                                            </div>



                                        </div>



                                        <div class="by_days row">
                                            <?php
                                            $CI = get_instance();
                                            echo $CI->getSessionResult("1", $session_id);
                                            ?>
                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                        <div class="row by_monday by_day_select" data-day="Monday" data-day_id="2">



                            <div class="col-md-12">



                                <div class="card-box">



                                    <div class="card-body">



                                        <div class="row session-day">



                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 daywise">



                                                <h3 class="day">Monday</h3>



                                            </div>







                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <div class="form-control-wrapper">



                                                    <label>Start Time</label>



                                                    <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                        <input name="start_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <select name="start_merdian" class="form-control">

                                                            <option value="AM">AM</option>

                                                            <option value="PM">PM</option>

                                                        </select>



                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>



                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>



                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 display_none">



                                                <div class="form-control-wrapper">



                                                    <label>End Time</label>



                                                    <div class="input-append date " data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                        <input name="end_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Programme Area</label>



                                                <select class="form-control" name="program_area">



                                                    <option value="1">Open to All</option>



                                                    <option value="2">Venue Only</option>







                                                </select>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Assign Staff</label>



                                                <select class="form-control" name="assign_staff">



                                                    <option value="">Assign Staff</option>



                                                    <?php
                                                    if (!empty($staffs)) {



                                                        foreach ($staffs as $staff) {
                                                            ?>



                                                            <option value="<?php echo $staff['id']; ?>"><?php echo $staff['username']; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>



                                                </select>



                                            </div>







                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">



                                                <button type="button" class="by_day_btn btn yellow btn-outline btn-circle m-b-10">ADD</button>



                                            </div>



                                        </div>



                                        <div class="by_days row">

                                            <?php
                                            $CI = get_instance();
                                            echo $CI->getSessionResult("2", $session_id);
                                            ?>





                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                        <div class="row by_Tuesday by_day_select" data-day="Tuesday" data-day_id="3">



                            <div class="col-md-12">



                                <div class="card-box">



                                    <div class="card-body">



                                        <div class="row session-day">



                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 daywise">



                                                <h3 class="day">Tuesday</h3>



                                            </div>







                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <div class="form-control-wrapper">



                                                    <label>Start Time</label>



                                                    <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">



                                                        <input name="start_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <select name="start_merdian" class="form-control">

                                                            <option value="AM">AM</option>

                                                            <option value="PM">PM</option>

                                                        </select>

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>



                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 display_none">



                                                <div class="form-control-wrapper">



                                                    <label>End Time</label>



                                                    <div class="input-append date " data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                        <input name="end_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Programme Area</label>



                                                <select class="form-control" name="program_area">



                                                    <option value="1">Open to All</option>



                                                    <option value="2">Venue Only</option>



                                                </select>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Assign Staff</label>



                                                <select class="form-control" name="assign_staff">



                                                    <option value="">Assign Staff</option>



                                                    <?php
                                                    if (!empty($staffs)) {



                                                        foreach ($staffs as $staff) {
                                                            ?>



                                                            <option value="<?php echo $staff['id']; ?>"><?php echo $staff['username']; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>



                                                </select>



                                            </div>







                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">



                                                <button type="button" class="by_day_btn btn yellow btn-outline btn-circle m-b-10" id="sunday_btn">ADD</button>



                                            </div>



                                        </div>



                                        <div class="by_days row">




                                            <?php
                                            $CI = get_instance();
                                            echo $CI->getSessionResult("3", $session_id);
                                            ?>


                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                        <div class="row by_Tuesday by_day_select" data-day="Wednesday" data-day_id="4">



                            <div class="col-md-12">



                                <div class="card-box">



                                    <div class="card-body">



                                        <div class="row session-day">



                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 daywise">



                                                <h3 class="day">Wednesday</h3>



                                            </div>







                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <div class="form-control-wrapper">



                                                    <label>Start Time</label>



                                                    <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">



                                                        <input name="start_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <select name="start_merdian" class="form-control">

                                                            <option value="AM">AM</option>

                                                            <option value="PM">PM</option>

                                                        </select>

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>



                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>



                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 display_none">



                                                <div class="form-control-wrapper">



                                                    <label>End Time</label>



                                                    <div class="input-append date " data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                        <input name="end_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Programme Area</label>



                                                <select class="form-control" name="program_area">



                                                    <option value="1">Open to All</option>



                                                    <option value="2">Venue Only</option>



                                                </select>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Assign Staff</label>



                                                <select class="form-control" name="assign_staff">



                                                    <option value="">Assign Staff</option>



                                                    <?php
                                                    if (!empty($staffs)) {



                                                        foreach ($staffs as $staff) {
                                                            ?>



                                                            <option value="<?php echo $staff['id']; ?>"><?php echo $staff['username']; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>



                                                </select>



                                            </div>







                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">



                                                <button type="button" class="by_day_btn btn yellow btn-outline btn-circle m-b-10" id="sunday_btn">ADD</button>



                                            </div>



                                        </div>



                                        <div class="by_days row">



                                            <?php
                                            $CI = get_instance();
                                            echo $CI->getSessionResult("4", $session_id);
                                            ?>



                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                        <div class="row by_Tuesday by_day_select" data-day="Thursday" data-day_id="5">



                            <div class="col-md-12">



                                <div class="card-box">



                                    <div class="card-body">



                                        <div class="row session-day">



                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 daywise">



                                                <h3 class="day">Thursday</h3>



                                            </div>







                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <div class="form-control-wrapper">



                                                    <label>Start Time</label>



                                                    <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">



                                                        <input name="start_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <select name="start_merdian" class="form-control">

                                                            <option value="AM">AM</option>

                                                            <option value="PM">PM</option>

                                                        </select>

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>



                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>



                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 display_none">



                                                <div class="form-control-wrapper">



                                                    <label>End Time</label>



                                                    <div class="input-append date " data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                        <input name="end_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Programme Area</label>



                                                <select class="form-control" name="program_area">



                                                    <option value="1">Open to All</option>



                                                    <option value="2">Venue Only</option>



                                                </select>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Assign Staff</label>



                                                <select class="form-control" name="assign_staff">



                                                    <option value="">Assign Staff</option>



                                                    <?php
                                                    if (!empty($staffs)) {



                                                        foreach ($staffs as $staff) {
                                                            ?>



                                                            <option value="<?php echo $staff['id']; ?>"><?php echo $staff['username']; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>



                                                </select>



                                            </div>







                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">



                                                <button type="button" class="by_day_btn btn yellow btn-outline btn-circle m-b-10" id="sunday_btn">ADD</button>



                                            </div>



                                        </div>



                                        <div class="by_days row">



                                            <?php
                                            $CI = get_instance();
                                            echo $CI->getSessionResult("5", $session_id);
                                            ?>



                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                        <div class="row by_friday by_day_select" data-day="Friday" data-day_id="6">



                            <div class="col-md-12">



                                <div class="card-box">



                                    <div class="card-body">



                                        <div class="row session-day">



                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 daywise">



                                                <h3 class="day">Friday</h3>



                                            </div>







                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <div class="form-control-wrapper">



                                                    <label>Start Time</label>



                                                    <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">



                                                        <input name="start_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <select name="start_merdian" class="form-control">

                                                            <option value="AM">AM</option>

                                                            <option value="PM">PM</option>

                                                        </select>

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>



                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>



                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 display_none">



                                                <div class="form-control-wrapper">



                                                    <label>End Time</label>



                                                    <div class="input-append date " data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                        <input name="end_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Programme Area</label>



                                                <select class="form-control" name="program_area">



                                                    <option value="1">Open to All</option>



                                                    <option value="2">Venue Only</option>







                                                </select>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Assign Staff</label>



                                                <select class="form-control" name="assign_staff">



                                                    <option value="">Assign Staff</option>



                                                    <?php
                                                    if (!empty($staffs)) {



                                                        foreach ($staffs as $staff) {
                                                            ?>



                                                            <option value="<?php echo $staff['id']; ?>"><?php echo $staff['username']; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>



                                                </select>



                                            </div>







                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">



                                                <button type="button" class="by_day_btn btn yellow btn-outline btn-circle m-b-10">ADD</button>



                                            </div>







                                        </div>



                                        <div class="by_days row">


                                            <?php
                                            $CI = get_instance();
                                            echo $CI->getSessionResult("6", $session_id);
                                            ?>




                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>



                        <div class="row by_Tuesday by_day_select" data-day="Saturday" data-day_id="7">



                            <div class="col-md-12">



                                <div class="card-box">



                                    <div class="card-body">



                                        <div class="row session-day">



                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 daywise">



                                                <h3 class="day">Saturday</h3>



                                            </div>







                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <div class="form-control-wrapper">



                                                    <label>Start Time</label>



                                                    <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">



                                                        <input name="start_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <select name="start_merdian" class="form-control">

                                                            <option value="AM">AM</option>

                                                            <option value="PM">PM</option>

                                                        </select>

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>



                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>



                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 display_none">



                                                <div class="form-control-wrapper">



                                                    <label>End Time</label>



                                                    <div class="input-append date form_time " data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                        <input name="end_time" autocomplete="off" size="30" type="text" value=""  >

                                                        <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                    </div>



                                                </div>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Programme Area</label>



                                                <select class="form-control" name="program_area">



                                                    <option value="1">Open to All</option>



                                                    <option value="2">Venue Only</option>



                                                </select>



                                            </div>



                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">



                                                <label>Assign Staff</label>



                                                <select class="form-control" name="assign_staff">



                                                    <option value="">Assign Staff</option>



                                                    <?php
                                                    if (!empty($staffs)) {



                                                        foreach ($staffs as $staff) {
                                                            ?>



                                                            <option value="<?php echo $staff['id']; ?>"><?php echo $staff['username']; ?></option>



                                                            <?php
                                                        }
                                                    }
                                                    ?>



                                                </select>



                                            </div>







                                            <div class="col-lg-1 col-md-1 col-sm-1 col-1">



                                                <button type="button" class="by_day_btn btn yellow btn-outline btn-circle m-b-10" id="sunday_btn">ADD</button>



                                            </div>



                                        </div>



                                        <div class="by_days row">



                                            <?php
                                            $CI = get_instance();
                                            echo $CI->getSessionResult("7", $session_id);
                                            ?>



                                        </div>



                                    </div>



                                </div>



                            </div>



                        </div>







                    </div>



                </div>



                <div class="col-md-12">



                    <div class="pull-left">

                        <a href="<?= site_url('/admin/session-management') ?>" class="btn btn-circle btn-warning black">BACK</a>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-circle btn-warning ">UPDATE SESSION</button>
                    </div>
                </div>



            </div>



        </form>



    </div>



    <script>



        $(document).ready(function () {

            var club_id = "<?php echo $sessions['club_id']; ?>";
            if (club_id != "4") {
                $("#sessioncreate-two").show();
            } else {
                var term = returnSelectedTerm("<?php echo $sessions['term_id']; ?>");
                var return_terms = term.responseJSON;
                term_id = return_terms[0].id;
                term_num_of_weeks = return_terms[0].num_of_weeks;
                sessionStorage.weeks = term_num_of_weeks;
                addHolidayWeekRows(sessionStorage.weeks);
            }

            $("#level_drp").on('change', function () {
                var duration = $(this).find("option:selected").attr('data-duration');
                $("#duration").val(duration);
            });
            sessionStorage.clear();
            var venue_id = null;
            var term_id = null;
            var term_num_of_weeks = 0;
            var club_id = null;
            var session_name = null;
            var program_id = null;
            var level_id = null;
            $('#venues_drp').on('change', function () {



                venue_id = this.value;
            });
            $('#term_drp').on('change', function () {



                var term = returnSelectedTerm($(this).val());
                var return_terms = term.responseJSON;
                term_id = return_terms[0].id;
                term_num_of_weeks = return_terms[0].num_of_weeks;
                sessionStorage.weeks = term_num_of_weeks;
            });
            $('#level_drp').on('change', function () {
                var club_id = $('#club_drp').val();
                var program_id = null;
                var level_id = null;
                if (club_id == "4") {
                    $("#sessioncreate-two").hide();
                    $("#sessioncreate-one").show();
                    $("#sessioncreate-one").html('');
                    addHolidayWeekRows(sessionStorage.weeks);
                    $("#area").show();
                    $("#session_name").attr("placeholder", "Enter Camp Name");
                } else {
                    $("#sessioncreate-two").show();
                    $("#sessioncreate-one").hide();
                    $("#area").hide();
                    $("#session_name").attr("placeholder", "Enter Session Name")
                }
            });
//            $('#club_drp').on('change', function () {
//
//
//
//                club_id = this.value;
//
//
//
//                program_id = null;
//
//
//
//                level_id = null;
//
//
//
//                if (club_id == "4") {
//
//
//
//                    $("#sessioncreate-two").hide();
//
//
//
//                    $("#sessioncreate-one").show();
//
//
//
//                    $("#sessioncreate-one").html('');
//
//
//
//                    addHolidayWeekRows(sessionStorage.weeks);
//
//
//
//                    $("#area").show();
//
//
//
//                    $("#session_name").attr("placeholder", "Enter Camp Name");
//
//
//
//                } else {
//
//
//
//                    $("#sessioncreate-two").show();
//
//
//
//                    $("#sessioncreate-one").hide();
//
//
//
//                    $("#area").hide();
//
//
//
//                    $("#session_name").attr("placeholder", "Enter Session Name")
//
//
//
//                }
//
//
//
//            });



            $('#program_drp').on('change', function () {



                program_id = this.value;
            });
            $('#session_name').keyup(function () {



                session_name = null;
                if (this.value != null || this.value == 'undefined' || this.value == '')
                    session_name = this.value;
            });
            $('#level_drp').on('change', function () {



                level_id = this.value;
                var level = returnSelectedLevel(level_id);
                var return_level = level.responseJSON;
                if (return_level != 'undefined' || !return_level || return_level != '')
                    $("#level_session_time").val(return_level[0].duration);
            });
            function addHolidayWeekRows(num_of_weeks = 0){



                for (var i = 1; i <= num_of_weeks; i++) {

                    returnRows(i, "<?php echo $sessions['id'] ?>");

                    var element = '<div class="row by_date_select" data-week="WEEK' + i + '" data-week_id="' + i + '">'



                            + '<div class="col-md-12">'



                            + '<div class="card-box">'



                            + '<div class="card-body">'



                            + '<div class="row session-day">'



                            + '<div class="col-lg-1 col-md-1 col-sm-1 col-1">'



                            + '<h3 class="day">WEEK ' + i + '</h3>'



                            + '</div>'



                            + '<div class="col-lg-2 col-md-2 col-sm-2 col-2">'



                            + '<div class="form-control-wrapper">'



                            + '<label>Start Date</label>'



                            + '<div class="input-append date form_datex" data-date-format="dd MM yyyy" data-date="2013-02-21">'



                            + '<input size="30" type="text" value=""  name="start_date">'



                            + '<span class="add-on"><i class="fa fa-calendar icon-th"></i></span>'



                            + '</div>'



                            + '</div>'



                            + '</div>'



                            + '<div class="col-lg-2 col-md-2 col-sm-2 col-2">'



                            + '<div class="form-control-wrapper">'



                            + '<label>End Date</label>'



                            + '<div class="input-append date form_datex" data-date-format="dd MM yyyy" data-date="2013-02-21">'



                            + '<input size="30" type="text" value=""  name="end_date">'



                            + '<span class="add-on"><i class="fa fa-calendar icon-th"></i></span>'



                            + '</div>'



                            + '</div>'



                            + '</div>'



                            + '<div class="col-lg-2 col-md-2 col-sm-2 col-2">'



                            + '<div class="form-control-wrapper">'



                            + '<label>Start Time</label>'



                            + '<div class="input-append date form_time" data-date-format="hh:mm" data-date="T15:25:00Z">'



                            + '<input size="30" type="text" value=""  name="start_time" autocomplete="off">'

                            + '<select name="start_merdian" class="form-control">'

                            + '<option value="AM">AM</option>'

                            + '<option value="PM">PM</option>'

                            + '</select>'

                            + '<span class="add-on"><i class="fa fa-clock-o"></i></span>'



                            + '</div>'



                            + '</div>'



                            + '</div>'

                            + '<div class="col-lg-2 col-md-2 col-sm-2 col-2 display_none">'



                            + '<div class="form-control-wrapper">'



                            + '<label>End Time</label>'



                            + '<div class="input-append date form_time" data-date-format="hh:mm" data-date="T15:25:00Z">'



                            + '<input size="30" type="text" value=""  name="end_time" autocomplete="off">'

                            + '<span class="add-on"><i class="fa fa-clock-o"></i></span>'

                            + '</div>'

                            + '</div>'

                            + '</div>'


                            + '<div class="col-lg-2 col-md-2 col-sm-2 col-2">'



                            + '<div class="form-control-wrapper">'



                            + '<label>Exclusion Day</label>'



                            + '<select class="form-control" name="exclusion_day_id">'



                            + '<option value="1">Sunday</option>'



                            + '<option value="2">Monday</option>'



                            + '<option value="3">Tuesday</option>'



                            + '<option value="4">Wednesday</option>'



                            + '<option value="5">Thursday</option>'



                            + '<option value="" selected>N/A</option>'



                            + '</select>'



                            + '</div>'



                            + '</div>'



                            + '<div class="col-lg-1 col-md-1 col-sm-1 col-1">'



                            + '<button type="button" class="add_by_date_btn btn yellow btn-outline btn-circle m-b-10">ADD</button>'



                            + '</div>'



                            + '</div>'



                            + '<div class="weeks_select row">'


                            + '</div>'

                            + '</div>'



                            + '</div>'



                            + '</div>'



                            + '</div>';
                    $("#sessioncreate-one").append(element);
                    $('.form_datex input[type="text"]').bootstrapMaterialDatePicker({weekStart: 0, time: false, format: 'DD-MM-YYYY'});
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
                        showMeridian: true
                    }).on('changeDate', function (ev) {
                        var time = $(this).parents(".by_date_select").find("input[name='start_time']").val();
                        var meridan = $(this).parents(".by_date_select").find("select[name='start_merdian']").val();
                        var duration = $("#duration").val();
                        var finalTime = changeTime(time, meridan, duration);
                        if (time != "") {
                            $(this).parents(".by_date_select").find("input[name='end_time']").val(finalTime);
                        }
                    });
                }
            }
            $("select[name='start_merdian']").on('change', function () {
                var meridian = $(this).val();
                var startTime = $(this).parents(".input-append").find("input[name='start_time']").val();
                var duration = $("#duration").val();
                var finalTime = changeTime(startTime, meridian, duration);
                if (startTime != "") {
                    $(this).parents(".by_day_select").find("input[name='end_time']").val(finalTime);
                }
            });

            $(document).on('change', ".session-day select[name='start_merdian']", function () {
                var meridian = $(this).val();
                var startTime = $(this).parents(".input-append").find("input[name='start_time']").val();
                var duration = $("#duration").val();
                var finalTime = changeTime(startTime, meridian, duration);

                if (startTime != "") {
                    $(this).parents(".by_date_select").find("input[name='end_time']").val(finalTime);
                }
            });
            function returnRows(id, session_id) {
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/session-management/getSessionInfo') ?>",
                    data: {session_id: session_id, week_id: id},
                    success: function (res) {
                        $('div[data-week_id="' + id + '"]').find(".weeks_select").html(res);
                    }
                });
            }

            function addMinutes(time, minsToAdd) {
                function D(J) {
                    return (J < 10 ? '0' : '') + J
                }
                var piece = time.split(':');
                var mins = piece[0] * 60 + +piece[1] + +minsToAdd;
                return D(mins % (24 * 60) / 60 | 0) + ':' + D(mins % 60);
            }



            function AddSessionWeekRow(id) {
                event.preventDefault();
                var day_id = id;
                var start_time = $('input[name="start_time" autocomplete="off"]').val();
                var end_time = null;
                var level_session_time = $('input[name="level_session_time"]').val();
                var open_to = $('select[name="open_to"]').val();
                var staff_id = $('select[name="staff_id"]').val();
                end_time = addMinutes(start_time, level_session_time);
                var params = {
                    Day: day_id,
                    Start_time: start_time,
                    End_time: end_time,
                    Open_to: open_to,
                    Staff: staff_id,
                };
                var validation = Application.Validation(params);
                if (validation) {
                    var element = '<div class="row append_session_day_row_' + day_id + '">' +
                            '<input type="hidden" name="day_id[]" value="' + day_id + '"/>' +
                            '<div class="col-lg-2 col-md-2 col-sm-2 col-2">' +
                            '<div class="form-control-wrapper">' +
                            '<label>Start Time: ' + start_time + '<input type="hidden" name="start_time[]" value="' + start_time + '"/>' + '</label>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-lg-2 col-md-2 col-sm-2 col-2">' +
                            '<div class="form-control-wrapper">' +
                            '<label>End Time: ' + end_time + '<input type="hidden" name="end_time[]" value="' + end_time + '"/>' + '</label>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-lg-2 col-md-2 col-sm-2 col-2">' +
                            '<label>Open To: ' + open_to + '<input type="hidden" name="open_to[]" value="' + open_to + '"/>' + '</label>' +
                            '</div>' +
                            '<div class="col-lg-2 col-md-2 col-sm-2 col-2">' +
                            '<label>Assigned To: ' + staff_id + '<input type="hidden" name="staff_id[]" value="' + staff_id + '"/>' + '</label>' +
                            '</div>' +
                            '<div class="col-lg-1 col-md-1 col-sm-1 col-1">' +
                            '<button type="button" class="btn yellow btn-outline btn-circle m-b-10 closeme" >X</button>' +
                            '</div>' +
                            '</div>';
                    console.log("#appendSessionWeekRow_" + day_id);
                    $("#appendSessionWeekRow_" + day_id).append(element);
                    return false;
                }



            }
            function returnSelectedLevel(level_id) {
                var checkdata = $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/session-management/getbyparams') ?>",
                    data: {key: 'id', value: level_id, table: "levels"},
                    dataType: 'json',
                    async: false,
                    success: function (res) {
                        return res[0];
                    }
                });
                return checkdata;
            }

            function returnSelectedTerm(term_id) {
                var checkdata = $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/session-management/getbyparams') ?>",
                    data: {key: 'id', value: term_id, table: "terms"},
                    dataType: 'json',
                    async: false,
                    success: function (res) {
                        return res[0];
                    }
                });
                return checkdata;
            }
            $("#program_drp").on('change', function () {
                var program_id = $(this).val();
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/session-management/getprogramlevels') ?>",
                    data: {program_id: program_id},
                    success: function (res) {
                        $("#level_drp").html(res);
                    }
                })
            });
        });
        $(".page-content").on('change', 'select[name="start_merdian"]', function () {
            var sele = $(this).val();
            $(this).parents(".col-lg-2").next(".display_none").find('select[name="end_merdian"]').find('option[value="' + sele + '"]').attr("selected", "selected");
        });
        $(window).on('load', function () {
            $("#term_drp").removeAttr("disabled");
        });
    </script>
