<div class="page-content-wrapper add-form">
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
    <form method="post" action="<?php echo site_url('/admin/venue-management/update-venue'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="venue_id" value="<?php echo $venue_id; ?>"/>
        <div class="page-content" style="min-height:547px">

            <div class="page-bar">

                <div class="page-title-breadcrumb">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="page-title">EDIT VENUE</div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-sm-12">

                    <div class="card-box">

                        <div class="card-body ">

                            <div class="row">

                                <div class="col-md-12">

                                    <h3>VENUE DETAILS</h3>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Venue Name*</label>

                                        <div class="col-md-8">

                                            <input type="text" name="venue_name" required="" class="form-control" id="simpleFormEmail" value="<?= $venues['venue_name']; ?>"placeholder="Enter Venue Name" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Venue Short Code*</label>

                                        <div class="col-md-8">

                                            <input type="text" required="" name="venue_short_code" class="form-control" id="simpleFormEmail" placeholder="Enter Venue Short Code" value="<?= $venues['short_code']; ?>" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Located In*</label>

                                        <div class="col-md-8">

                                            <input type="text" required="" name="located_in" class="form-control" id="simpleFormEmail" placeholder="Enter Located In" value="<?= $venues['located_in']; ?>" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Google Map URL*</label>

                                        <div class="col-md-8">

                                            <input type="text" required="" name="venue_map" class="form-control" id="simpleFormEmail" placeholder="Enter Google Map URL" value="<?= $venues['google_map_url']; ?>" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Contact Number*</label>

                                        <div class="col-md-2">
                                            <select name="code" class="form-control input-height" required="">
                                                <option value="">Select Code</option>
                                                <option value="+91" <?php echo ($venues['c_code'] == "+91") ? "selected=''" : ""; ?>>+91</option>
                                                <option value="+92" <?php echo ($venues['c_code'] == "+92") ? "selected=''" : ""; ?>>+92</option>
                                                <option value="+971" <?php echo ($venues['c_code'] == "+971") ? "selected=''" : ""; ?>>+971</option>
                                            </select>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text"  maxlength="9" required="" name="venue_contact" class="form-control" value="<?= $venues['contact_number']; ?>" id="simpleFormEmail" placeholder="Enter Contact Number" onkeyup="this.value = this.value.replace(/[^\d]/, '')" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Email Address*</label>

                                        <div class="col-md-8">

                                            <input type="email" value="<?= $venues['email']; ?>" required="" name="venue_email" class="form-control" id="simpleFormEmail" placeholder="Enter Email Address" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Additional Description*</label>

                                        <div class="col-md-8">

                                            <textarea  required="" class="form-control-textarea" name="venue_description" placeholder="Enter Additional Description"><?= $venues['additional_description']; ?></textarea>

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">UPLOAD VENUE LOGO</label>

                                        <div class="col-md-8">

                                            <div class="compose-editor">

                                                <input type="file" name="userfile" id="documents" class="default">
                                                <img src="<?php echo site_url('/assets/uploads/' . $venues['photo_path']); ?>" id="imger"/>
                                            </div>

                                        </div>	

                                    </div>

                                </div>

                                <div class="col-md-12 add-time">
                                    <div class="col-md-12 ">	
                                        <h3>ADD TIMINGS</h3>
                                        <div class="day-select">
                                            <div class="row">
                                                <div class="col-md-5 ">
                                                    <h4>VENUE HOURS</h4>
                                                    <div class="row venue_hours_box">
                                                        <div class="col-lg-9 p-t-20">
                                                            <div class="form-control-wrapper">
                                                                <label>Start Time</label>
                                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                                                    <input  name="venue_start_time"  size="30" type="text" value=""  autocomplete="off">
                                                                    <select id="venuestart_merdian" class="form-control">
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                    <div class="clear clearfix"></div>
                                                                    <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
                                                                    <span class="add-on"><i class="fa fa-clock-o"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 p-t-20">
                                                            <div class="form-control-wrapper">
                                                                <label>End Time</label>
                                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                                                    <input  name="venue_end_time" size="30" type="text" value=""  autocomplete="off">

                                                                    <select id="venueend_merdian" class="form-control">

                                                                        <option value="AM">AM</option>

                                                                        <option value="PM">PM</option>

                                                                    </select>



                                                                    <div class="clear clearfix"></div>

                                                                    <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                                    <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-lg-4 p-t-20">

                                                            <button type="button" id="add_venue_time" class="btn btn-circle btn-warning">Add</button>

                                                        </div>

                                                    </div>



                                                    <div class="row result-assessment" id="venue_hours">
                                                        <?php
                                                        if (!empty($venue_hours)) {
                                                            foreach ($venue_hours as $venue_hour) {
                                                                ?>
                                                                <div class="round_box">
                                                                    <div class="col-lg-6">
                                                                        <span class="mdl-chip mdl-chip--deletable">
                                                                            <span class="mdl-chip__text">
                                                                                <span class="time">
                                                                                    <?= $venue_hour['start_time'] ?><input name="venue_starts_time[]" type="hidden" value="<?= $venue_hour['start_time'] ?>"  autocomplete="off" >
                                                                                    - <?= $venue_hour['end_time'] ?><input name="venue_ends_time[]" type="hidden" value="<?= $venue_hour['end_time'] ?>"  autocomplete="off">
                                                                                </span>
                                                                            </span>
                                                                            <button class="mdl-chip__action closeme" type="button">
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

                                                </div>

                                                <div class="col-md-7">

                                                    <h4>SCHOOL HOURS</h4>

                                                    <div class="row school_hours_box">

                                                        <div class="col-lg-4 p-t-20">

                                                            <div class="form-control-wrapper">

                                                                <label>Enter year group name</label>

                                                                <input type="text" name="years_group" placeholder="Enter year group name" data-dtp="dtp_SRMk9">

                                                            </div>

                                                        </div>

                                                        <div class="col-lg-7 p-t-20">

                                                            <div class="form-control-wrapper">

                                                                <label>Start Time</label>

                                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                                    <input size="30" name="school_start_time" type="text" value=""  autocomplete="off" >

                                                                    <select id="schoolstart_merdian" class="form-control">

                                                                        <option value="AM">AM</option>

                                                                        <option value="PM">PM</option>

                                                                    </select>



                                                                    <div class="clear clearfix"></div>

                                                                    <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                                    <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-lg-7 p-t-20">

                                                            <div class="form-control-wrapper">

                                                                <label>End Time</label>

                                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                                    <input name="school_end_time" size="30" type="text" value=""  autocomplete="off" >

                                                                    <select id="schoolend_merdian" class="form-control">

                                                                        <option value="AM">AM</option>

                                                                        <option value="PM">PM</option>

                                                                    </select>

                                                                    <div class="clear clearfix"></div>

                                                                    <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                                    <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-lg-2 p-t-20">

                                                            <button type="button"  id="add_school_time" class="btn btn-circle btn-warning">Add</button>

                                                        </div>



                                                    </div>

                                                    <div class="clearfix clear"></div>

                                                    <div class="row result-assessment" id="school_hours">
                                                        <?php
                                                        if (!empty($school_hours)) {
                                                            foreach ($school_hours as $school_hour) {
                                                                ?>
                                                                <div class="round_box">
                                                                    <div class="col-lg-6">
                                                                        <span class="mdl-chip mdl-chip--deletable">
                                                                            <span class="mdl-chip__text">
                                                                                <span class="time">
                                                                                    <?php echo $school_hour['year_group_name']; ?> <input name="years_groups[]" type="hidden" value="<?php echo $school_hour['year_group_name']; ?>"  autocomplete="off" > 
                                                                                    - <?php echo $school_hour['start_time']; ?><input name="school_starts_time[]" type="hidden" value="<?php echo $school_hour['start_time']; ?>"  autocomplete="off" > 
                                                                                    - <?php echo $school_hour['end_time']; ?><input name="school_ends_time[]" type="hidden" value="<?php echo $school_hour['end_time']; ?>">
                                                                                </span>
                                                                            </span>
                                                                            <button class="mdl-chip__action closeme" type="button">
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

                                                </div>

                                                <div class="col-md-12 msaaccess_hours">

                                                    <h4>MSA ACCESS HOURS</h4>

                                                    <div class="row">

                                                        <div class="col-lg-3 p-t-20">

                                                            <div class="form-control-wrapper">

                                                                <label>Select Day</label>

                                                                <select class="form-control input-height" name="select_day">

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

                                                        <div class="col-lg-3 p-t-20">

                                                            <div class="form-control-wrapper">

                                                                <label>Select Category</label>

                                                                <select name="category" class="form-control input-height">

                                                                    <option value="1">Venue</option>

                                                                    <option value="2">Community</option>

                                                                </select>

                                                            </div>

                                                        </div>

                                                        <div class="col-lg-3 p-t-20">

                                                            <div class="form-control-wrapper">

                                                                <label>Start Time</label>

                                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                                    <input name="msa_start_time" size="30" type="text" value=""  autocomplete="off" >

                                                                    <select id="msastart_merdian" class="form-control">

                                                                        <option value="AM">AM</option>

                                                                        <option value="PM">PM</option>

                                                                    </select>



                                                                    <div class="clear clearfix"></div>

                                                                    <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                                    <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-lg-3 p-t-20">

                                                            <div class="form-control-wrapper">

                                                                <label>End Time</label>

                                                                <div class="input-append date form_time" data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">

                                                                    <input name="msa_end_time" size="30" type="text" value=""  autocomplete="off" >

                                                                    <select id="msaend_merdian" class="form-control">

                                                                        <option value="AM">AM</option>

                                                                        <option value="PM">PM</option>

                                                                    </select>



                                                                    <div class="clear clearfix"></div>

                                                                    <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>

                                                                    <span class="add-on"><i class="fa fa-clock-o"></i></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-lg-2 p-t-20">

                                                            <button type="button" id="msaschool_time" class="btn btn-circle btn-warning">Add</button>

                                                        </div>

                                                    </div>

                                                    <div class="row result-assessment" id="msa_hours">
                                                        <?php
                                                        if (!empty($msa_access_hours)) {
                                                            $days = array("", "Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday");
                                                            $categories = array("", "Venue", "Community");
                                                            $Facility = array("", "Swimming Pool", "Astro - turf Pitch", "Grass Pitch", "Sports Hall", "Multi Purpose Court", "Athletics Track", "Gym", "Studio");
                                                            $Status = array("", "Indoor", "Outdoor - Shaded", "Outdoor - Unshaded");
                                                            foreach ($msa_access_hours as $msa_access_hour) {
                                                                ?>
                                                                <div class="round_box">
                                                                    <div class="col-lg-6">
                                                                        <span class="mdl-chip mdl-chip--deletable">
                                                                            <span class="mdl-chip__text"><span class="time">
                                                                                    <?php echo $days[$msa_access_hour['day_id']]; ?> | <input name="msa_selectday[]" type="hidden" value="<?php echo $msa_access_hour['day_id']; ?>"> 
                                                                                    <?php echo $categories[$msa_access_hour['category']]; ?> | <input name="msa_category[]" type="hidden" value="<?php echo $msa_access_hour['category']; ?>"> 
                                                                                    <?php echo $msa_access_hour['start_time']; ?><input name="msa_start_time[]" type="hidden" value="<?php echo $msa_access_hour['start_time']; ?>"> 
                                                                                    - <?php echo $msa_access_hour['end_time']; ?><input name="msa_ends_time[]" type="hidden" value="<?php echo $msa_access_hour['end_time']; ?>">
                                                                                </span>
                                                                            </span> 
                                                                            <button class="mdl-chip__action closeme" type="button">
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

                                                </div>

                                            </div>

                                        </div>	

                                    </div>

                                </div>

                                <div class="col-md-12 checkValidate add-time">

                                    <h3>VENUE FACILITY DETAILS</h3>



                                    <div class="day-select">

                                        <div class="gap"></div>

                                        <section id="venue_management_form">

                                            <div class="form-group row">

                                                <label class="control-label col-md-4">Select Facility

                                                    <span class="required" aria-required="true"> * </span>

                                                </label>

                                                <div class="col-md-8">

                                                    <select class="form-control input-height" name="Facility">

                                                        <option value="">Select Facility</option>

                                                        <option value="1">Swimming Pool</option>

                                                        <option value="2">Astro - turf Pitch</option>

                                                        <option value="3">Grass Pitch</option>

                                                        <option value="4">Sports Hall</option>

                                                        <option value="5">Multi Purpose Court</option>

                                                        <option value="6">Athletics Track</option>

                                                        <!--                                                        <option value="7">Gym</option>
                                                        
                                                                                                                <option value="8">Studio</option>-->

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <label class="control-label col-md-4">Select Status
                                                    <span class="required" aria-required="true"> * </span>

                                                </label>

                                                <div class="col-md-8">

                                                    <select class="form-control input-height" name="status">

                                                        <option value="">Select Status</option>

                                                        <option value="1">Outdoor - Floodlit</option>

                                                        <option value="2">Outdoor - Shaded</option>

                                                        <option value="3">Floodlit</option>

                                                        <option value="3">Outdoor, Indoor</option>

                                                    </select>

                                                </div>

                                            </div>		

                                            <div class="form-group row">

                                                <label class="control-label col-md-4">Size

                                                    <span class="required" aria-required="true"> * </span>

                                                </label>

                                                <div class="col-md-5">
                                                    <input type="text" name="size" class="form-control" id="simpleFormEmail" placeholder="Enter Size" autocomplete="off">
                                                </div>
                                                <div class="col-md-3">
                                                    <select id="sizes" class="form-control input-height">
                                                        <option value="inch">Inch</option>
                                                        <option value="sq fit">Sq Fit</option>
                                                        <option value="meter">Meter</option>
                                                        <option value="fit">Fit</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <label class="control-label col-md-4">Features <span class="required" aria-required="true"> * </span></label>

                                                <div class="col-md-8">

                                                    <input type="text" name="features" class="form-control" id="simpleFormEmail" placeholder="Features" autocomplete="off">

                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <label class="control-label col-md-4">Rating</label>

                                                <div class="col-md-8">

                                                    <div class="radio p-0">

                                                        <input type="radio" name="rating" id="optionsRadios1" value="1">

                                                        <label for="optionsRadios1">
                                                            1
                                                        </label>
                                                    </div>

                                                    <div class="radio p-0">

                                                        <input type="radio" name="rating" id="optionsRadios2" value="2">
                                                        <label for="optionsRadios2">
                                                            2
                                                        </label>

                                                    </div>

                                                    <div class="radio p-0">
                                                        <input type="radio" name="rating" id="optionsRadios3" value="3">
                                                        <label for="optionsRadios3">
                                                            3
                                                        </label>
                                                    </div>

                                                    <div class="radio p-0">
                                                        <input type="radio" name="rating" id="optionsRadios8" value="4">
                                                        <label for="optionsRadios8">
                                                            4
                                                        </label>
                                                    </div>

                                                    <div class="radio p-0">
                                                        <input type="radio" name="rating" id="optionsRadios88" value="4">
                                                        <label for="optionsRadios88">
                                                            5
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label class="control-label col-md-4">Risk Assessment</label>

                                                <div class="col-md-8">

                                                    <div class="radio p-0">

                                                        <input type="radio" name="risk_assessment" id="optionsRadios6" value="Yes" checked="">

                                                        <label for="optionsRadios6">

                                                            Yes

                                                        </label>

                                                    </div>

                                                    <div class="radio p-0">

                                                        <input type="radio" name="risk_assessment" id="optionsRadios7" value="No">

                                                        <label for="optionsRadios7">

                                                            No

                                                        </label>

                                                    </div>

                                                </div>



                                            </div>

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <button type="submit" id="add_facilities" class="btn btn-circle btn-warning">Add</button>

                                                </div>

                                            </div>

                                            <div class="gap"></div>

                                            <div class="row result-assessment" id="add_facility_box1">
                                                <?php
                                                if (!empty($venue_facilities)) {
                                                    $categories = array("", "Venue", "Community");
                                                    $Facility = array("", "Swimming Pool", "Astro - turf Pitch", "Grass Pitch", "Sports Hall", "Multi Purpose Court", "Athletics Track", "Gym", "Studio");
                                                    $Status = array("", "Indoor", "Outdoor - Shaded", "Outdoor - Unshaded");
                                                    foreach ($venue_facilities as $venue_facilitie) {
                                                        ?>
                                                        <div class="round_box">
                                                            <div class="col-lg-6">
                                                                <span class="mdl-chip mdl-chip--deletable">
                                                                    <span class="mdl-chip__text">
                                                                        <span class="time">
                                                                            <?php echo $Facility[$venue_facilitie['facility_id']]; ?><input name="departments[]" type="hidden" value="<?= $venue_facilitie['facility_id']; ?>"> 
                                                                            | <?php echo $Status[$venue_facilitie['status']]; ?><input name="statuses[]" type="hidden" value="<?= $venue_facilitie['status']; ?>"> 
                                                                            | <?php echo $venue_facilitie['size'] . " " . $venue_facilitie['measurement']; ?><input name="sizes[]" type="hidden" value="<?php echo $venue_facilitie['size']; ?>"><input type="hidden" name="measure[]" value="<?php echo $venue_facilitie['measurement']; ?>"/> 
                                                                            | <?php echo $venue_facilitie['features']; ?><input name="featuress[]" type="hidden" value="<?php echo $venue_facilitie['features']; ?>"> 
                                                                            | <?php echo $venue_facilitie['rating']; ?><input name="ratings[]" type="hidden" value="<?php echo $venue_facilitie['rating']; ?>"> 
                                                                            | <?php echo $venue_facilitie['risk_assesment_active']; ?><input name="risk_assessments[]" type="hidden" value="<?php echo $venue_facilitie['risk_assesment_active']; ?>">
                                                                        </span>
                                                                    </span>
                                                                    <button class="mdl-chip__action closeme" type="button">
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

                                        </section>



                                    </div>



                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2 pull-left">
                                    <button type="submit" class="btn btn-circle btn-warning">Update Venue</button>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                    <a href="<?= site_url('/admin/venue-management') ?>" class="btn btn-circle btn-warning black">BACK</a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- end chat sidebar -->

            </div>

            <!-- end page container -->

        </div>

    </form>



    <style>

        .add-form .card-body h3{

            padding:10px 20px !important;

        }
        fieldset.minute legend {
            display: none;
        }
        img#imger {
            width: 70px;
            height: auto;
        }

    </style>
    <script>
        $(document).ready(function () {
            $("#documents").on('change', function () {
                _encodeImageFileAsURL(this, "#imger");
            });

        });
        function _encodeImageFileAsURL(element, elemn) {
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function () {
                $(elemn).attr('src', reader.result);
            }
            reader.readAsDataURL(file);
        }
    </script>