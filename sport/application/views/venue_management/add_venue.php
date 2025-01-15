<div class="page-content-wrapper add-form">



    <form method="post" action="<?php echo site_url('/admin/venue-management/save-venue'); ?>" enctype="multipart/form-data">

        <div class="page-content" style="min-height:547px">

            <div class="page-bar">

                <div class="page-title-breadcrumb">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="page-title">ADD VENUE</div>

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

                                            <input type="text" name="venue_name" required="" class="form-control" id="simpleFormEmail" placeholder="Enter Venue Name" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Venue Short Code*</label>

                                        <div class="col-md-8">

                                            <input type="text" required="" name="venue_short_code" class="form-control" id="simpleFormEmail" placeholder="Enter Venue Short Code" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Located In*</label>

                                        <div class="col-md-8">

                                            <input type="text" required="" name="located_in" class="form-control" id="simpleFormEmail" placeholder="Enter Located In" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Google Map URL*</label>

                                        <div class="col-md-8">

                                            <input type="text" required="" name="venue_map" class="form-control" id="simpleFormEmail" placeholder="Enter Google Map URL" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Contact Number*</label>

                                        <div class="col-md-2">

                                            <select name="code" class="form-control input-height" required="">

                                                <option value="">Select Code</option>

                                                <option value="+91">+91</option>

                                                <option value="+92">+92</option>

                                                <option value="+971" selected="">+971</option>

                                            </select>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text"   maxlength="9" required="" name="venue_contact" class="form-control" id="simpleFormEmail" placeholder="Enter Contact Number" autocomplete="off"  onkeyup="this.value = this.value.replace(/[^\d]/, '')">
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Email Address*</label>

                                        <div class="col-md-8">

                                            <input type="email" required="" name="venue_email" class="form-control" id="simpleFormEmail" placeholder="Enter Email Address" autocomplete="off">

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">Additional Description*</label>

                                        <div class="col-md-8">

                                            <textarea  required="" class="form-control-textarea" name="venue_description" placeholder="Enter Additional Description"></textarea>

                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-md-4" for="simpleFormEmail">UPLOAD VENUE LOGO</label>

                                        <div class="col-md-8">

                                            <div class="compose-editor">

                                                <input type="file" name="userfile" id="documents" class="default">
                                                <img src="" id="imger"/>
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

                                                                    <input  name="venue_start_time"  size="30" type="text" value="">

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

                                                                    <input  name="venue_end_time" size="30" type="text" value="">

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

                                                                    <input size="30" name="school_start_time" type="text" value="">

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

                                                                    <input name="school_end_time" size="30" type="text" value="">

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

                                                                    <input name="msa_start_time" size="30" type="text" value="">

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

                                                                    <input name="msa_end_time" size="30" type="text" value="">

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
                                                        <input type="radio" name="rating" id="optionsRadios4" value="4">
                                                        <label for="optionsRadios4">
                                                            4
                                                        </label>
                                                    </div>
                                                    <div class="radio p-0">
                                                        <input type="radio" name="rating" id="optionsRadios5" value="5">
                                                        <label for="optionsRadios5">
                                                            5
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label class="control-label col-md-4">Risk Assessment</label>

                                                <div class="col-md-8">

                                                    <div class="radio p-0">

                                                        <input type="radio" name="risk_assessment" id="optionsRadios6" value="Yes">

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



                                            </div>

                                        </section>



                                    </div>



                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-circle btn-warning">Add Venue</button>
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