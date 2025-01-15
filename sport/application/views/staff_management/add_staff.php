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



    $swal_error = $this->session->flashdata("error_popup");

    if (!empty($swal_error)) {
        ?>

        <script>

            swal("Oops", "<?php echo $swal_error; ?>", "error");

        </script>

        <?php
    }
    ?>

    <div class="page-content add-form" style="min-height:596px">

        <div class="page-bar">

            <div class="page-title-breadcrumb">

                <div class=" pull-left">

                    <div class="page-title">Add Staff</div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="card card-box">



                    <div class="card-body" id="bar-parent">

                        <form action="<?php echo site_url('/admin/staff-management/save-staff'); ?>" method="post" enctype="multipart/form-data">

                            <div class="form-body">

                                <div class="row">

                                    <div class="col-md-6">



                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Basic Information</h3>
                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Staff Order ID

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <input type="text" required="required" name="order_id" placeholder="Enter Staff Order ID" class="form-control input-height">

                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <label class="control-label col-md-5">First Name

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <input type="text" required="required" name="firstname" placeholder="Enter First Name" class="form-control input-height">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Middle Name

                                            </label>

                                            <div class="col-md-7">

                                                <input type="text" name="middle" placeholder="Enter Middle Name" class="form-control input-height">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Last Name

                                            </label>

                                            <div class="col-md-7">

                                                <input type="text" name="lastname" placeholder="Enter Last Name" class="form-control input-height">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Date Of Birth

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">

                                                    <input class="form-control input-height"  id="dob" name="dob" size="16" placeholder="Date Of Birth" type="text" value="">

                                                </div>

                                                <input type="hidden" id="dtp_input2" value="">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Age

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <div class="input-group">

                                                    <input class="form-control input-height" name="age" size="16" placeholder="Age" type="text" value="">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Designation

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <input type="text" required="required" name="rollNo" placeholder="Designation" class="form-control input-height"> </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Gender

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <select class="form-control input-height" name="gender">

                                                    <option value="">Select...</option>

                                                    <option value="male">Male</option>

                                                    <option value="female">Female</option>

                                                </select>

                                            </div>

                                        </div>

                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Account Information</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5"> Personal Contact Number

                                            </label>

                                            <div class="col-md-7">

                                                <div class="input-group ph-form">
                                                    <select name="p_code" class="form-control">
                                                        <option value="+971">+971</option>
                                                        <option value="+92">+92</option>
                                                        <option value="+91">+91</option>
                                                    </select>
                                                    <input type="text" required="required" class="form-control input-height" name="personal_phone" placeholder="Personal Contact Number">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5"> Work Contact Number
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group ph-form">
                                                    <select name="w_code" class="form-control">
                                                        <option value="+971">+971</option>
                                                        <option value="+92">+92</option>
                                                        <option value="+91">+91</option>
                                                    </select>
                                                    <input type="text" required="required" class="form-control input-height" name="contact_phone" placeholder="Work Contact Number"> 

                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Email Address

                                            </label>

                                            <div class="col-md-7">

                                                <div class="input-group">


                                                    <input type="email" class="form-control input-height" name="email" placeholder="Enter Email"> </div>

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Create Password

                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="Password" class="form-control input-height" name="password" placeholder="*****"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Contract Start Date
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">

                                                <!-- <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">

                                                    <input class="form-control input-height" size="16" name="contract_start_date" placeholder="Start Date" type="text" value="" autocomplete="off">

                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>

                                                </div> -->

                                                <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input3" data-link-format="dd-mm-yyyy">

                                                    <input class="form-control input-height"  id="contract_start_date" name="contract_start_date" size="16" placeholder="Registration Date" type="text" value="">

                                                </div>
                                                <input type="hidden" id="dtp_input3" value="">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Contract End Date

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <!-- <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">

                                                    <input class="form-control input-height" name="contract_end_date" size="16" placeholder="End Date" type="text" value="" autocomplete="off">

                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>

                                                </div>
                                                -->
                                                <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input4" data-link-format="dd-mm-yyyy">

                                                    <input class="form-control input-height"  id="contract_start_date" name="contract_end_date" size="16" placeholder="Registration Date" type="text" value="">

                                                </div>
                                                <input type="hidden" id="dtp_input4" value="">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Salary

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">
                                                <div class="input-group ph-form">
                                                    <select name="sal_curr" class="form-control">
                                                        <option value="AED">AED</option>
                                                        <option value="USD">USD</option>
                                                        <option value="AUD">AUD</option>
                                                    </select>
                                                    <input type="text" name="salary" placeholder="Salary" class="form-control input-height"> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Bonus Detail

                                                <span class="required" aria-required="true"> * </span>

                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group ph-form">
                                                    <select name="bonus_curr" class="form-control">
                                                        <option value="AED">AED</option>
                                                        <option value="USD">USD</option>
                                                        <option value="AUD">AUD</option>
                                                    </select>
                                                    <input name="bonus" type="text" placeholder="Bonus Detail" value="" class="form-control input-height"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Passport Number

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <input name="passport" type="text" placeholder="Passport Number" class="form-control input-height"> </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Emirates ID

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <input name="emirate_id" type="text" placeholder="Emirates ID" class="form-control input-height"> </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Annual Leaves

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <input name="annual_leaves" type="text" placeholder="Annual Leaves" class="form-control input-height"> </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Define Portal Roles

                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control" required="" name="defined_role">
                                                    <option value="">Select</option>
                                                    <option value="3">Management</option>
                                                    <option value="4">Department Heads</option>
                                                    <option value="5">Site Lead</option>
                                                    <option value="2">Coach</option>
                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Add Profile Pic</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Profile Picture

                                            </label>

                                            <div class="compose-editor">

                                                <input type="file" name="userfile" required="" class="default" accept="image/x-png,image/gif,image/jpeg" >

                                            </div>

                                        </div>

                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Add Documents</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Documents

                                            </label>

                                            <div class="compose-editor">

                                                <input type="file" class="default" name="multipleUpload" id="multipleUpload" accept="image/x-png,image/gif,image/jpeg" >

                                            </div>

                                            <div class="clear"></div>

                                            <div id="append_document" class="col-md-12">



                                            </div>

                                        </div>

                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Qualification/Skills</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Description

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <textarea name="qualification" placeholder="Add staff description" class="form-control-textarea" rows="5"></textarea>

                                            </div>

                                        </div>



                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Next Of Kin</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Full Name

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <input type="text" required="required" name="kin_firstname" placeholder="Enter Full name" class="form-control input-height">

                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Relationship

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <input type="text" required="required" name="replationship" placeholder="Relationship" class="form-control input-height">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5"> Phone Number

                                            </label>

                                            <div class="col-md-7">

                                                <div class="input-group ph-form">

                                                    <select name="k_code" class="form-control">
                                                        <option value="+971">+971</option>
                                                        <option value="+92">+92</option>
                                                        <option value="+91">+91</option>
                                                    </select>
                                                    <input type="text" required="required" class="form-control input-height" name="kin_phone" placeholder="Phone Number"> </div>

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-5">Address

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <textarea name="kin_address" placeholder="address" class="form-control-textarea" rows="5"></textarea>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-12 text-left">Medical Condition

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="clearfix clear"></div>

                                            <div class="col-md-12">

                                                <div class="radio p-0 pull-left col-md-4">

                                                    <input type="radio" name="med_con" id="optionsRadios1" value="1" checked="">

                                                    <label for="optionsRadios1">

                                                        Yes

                                                    </label>

                                                </div>

                                                <div class="radio p-0 pull-left col-md-4">

                                                    <input type="radio" name="med_con" id="optionsRadios2" value="2">

                                                    <label for="optionsRadios2">

                                                        No

                                                    </label>

                                                </div>

                                            </div>

                                            <div class="clearfix clear"></div>

                                            <div class="col-md-12">

                                                <textarea name="med_address" class="form-control" id="med_address"placeholder="Write briefly about staff's medical condition" class="Detail" rows="5"></textarea>

                                            </div>

                                        </div>







                                    </div>

                                </div>

                                <div class="form-actions">

                                    <div class="row">

                                        <div class="col-md-9">

                                            <button type="submit" class="btn btn-circle btn-warning">ADD STAFF</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

    .clearfix,.clear{

        clear:both;

    }

    .appenddocument {

        padding: 6px 10px 6px 16px;

        background: #f3f1f1;

        width: 100%;

        margin: 3px 0 3px 0;

        position: relative;

    }

    a.closemyself {

        position: absolute;

        right: 7px;

    }

</style>

<script>
    $(document).ready(function () {
        $('input[name="med_con"]').on('change', function () {
            if ($(this).val() == "1") {
                $("#med_address").show();
            } else {
                $("#med_address").hide();
            }
        })
    });
</script>