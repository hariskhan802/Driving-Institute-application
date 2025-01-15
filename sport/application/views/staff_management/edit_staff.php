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
                    <div class="page-title">Edit Staff</div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="card card-box">



                    <div class="card-body" id="bar-parent">

                        <form action="<?php echo site_url('/admin/staff-management/update-staff'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="staff_id" value="<?= $staff_id; ?>"/>
                            <div class="form-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Basic Information</h3>
                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Staff Order ID

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <input type="text" required="required" name="order_id" placeholder="Enter Staff Order ID" class="form-control input-height" value="<?php echo $staffs['order_id']; ?>">

                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <label class="control-label col-md-4">First Name

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <input type="text" required="required" name="firstname" placeholder="Enter First Name" class="form-control input-height" value="<?php echo $staffs['first_name']; ?>">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Middle Name

                                            </label>

                                            <div class="col-md-8">

                                                <input type="text" name="middle" placeholder="Enter Middle Name" class="form-control input-height" value="<?php echo $staffs['middle']; ?>">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Last Name

                                            </label>

                                            <div class="col-md-8">

                                                <input type="text" name="lastname" value="<?php echo $staffs['last_name']; ?>" placeholder="Enter Last Name" class="form-control input-height">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Date Of Birth

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">

                                                    <input class="form-control input-height"  id="dob" name="dob" size="16" placeholder="Date Of Birth" type="text" value="<?php echo date('d-m-Y', strtotime($staffs['dob'])); ?>">

                                                </div>

                                                <input type="hidden" id="dtp_input2" value="">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Age

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-group">

                                                    <input class="form-control input-height" name="age" size="16" value="<?php echo $staffs['age']; ?>" placeholder="Age" type="text">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Designation

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <input type="text" required="required" name="rollNo" placeholder="Designation" value="<?php echo $staffs['designation']; ?>"  class="form-control input-height"> </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Gender

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <select class="form-control input-height" name="gender">

                                                    <option value="">Select...</option>

                                                    <option value="male" <?php echo ($staffs['gender'] == "male") ? "selected=''" : ""; ?> >Male</option>

                                                    <option value="female" <?php echo ($staffs['gender'] == "female") ? "selected=''" : ""; ?>>Female</option>

                                                </select>

                                            </div>

                                        </div>

                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Account Information</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4"> Personal Contact Number

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-group">

                                                    <input type="text" required="required" class="form-control input-height" name="personal_phone" placeholder="Personal Contact Number" value="<?php echo date('d-m-y', strtotime($staffs['personal_contact'])); ?>" > </div>
                                                <select name="p_code" class="form-control">
                                                    <option value="+971" <?php echo ($staffs['p_code'] == "+971") ? "selected=''" : ""; ?>>+971</option>
                                                    <option value="+92" <?php echo ($staffs['p_code'] == "+92") ? "selected=''" : ""; ?>>+92</option>
                                                    <option value="+91" <?php echo ($staffs['p_code'] == "+91") ? "selected=''" : ""; ?>>+91</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4"> Work Contact Number
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" required="required" class="form-control input-height" name="contact_phone" placeholder="Work Contact Number" value="<?php echo date('d-m-Y', strtotime($staffs['work_contact'])); ?>"> </div>
                                                <select name="w_code" class="form-control">
                                                    <option value="+971" <?php echo ($staffs['w_code'] == "+971") ? "selected=''" : ""; ?>>+971</option>
                                                    <option value="+92" <?php echo ($staffs['w_code'] == "+92") ? "selected=''" : ""; ?>>+92</option>
                                                    <option value="+91" <?php echo ($staffs['w_code'] == "+91") ? "selected=''" : ""; ?>>+91</option>
                                                </select>

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Email Address

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-group">


                                                    <input type="email" class="form-control input-height" name="email" placeholder="Enter Email" value="<?php echo $staffs['email']; ?>"> </div>

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Create Password

                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="Password" class="form-control input-height" name="password" placeholder="*****"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Contract Start Date
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-8">

                                                <!-- <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">

                                                    <input class="form-control input-height" size="16" name="contract_start_date" placeholder="Start Date" type="text" value="" autocomplete="off">

                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>

                                                </div> -->

                                                <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
                                                    <input class="form-control input-height"  id="contract_start_date" name="contract_start_date" size="16" placeholder="Registration Date" type="text" value="<?php echo date('d-m-Y', strtotime($staffs['contract_start_date'])); ?>">
                                                </div>
                                                <input type="hidden" id="dtp_input3" value="">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Contract End Date

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <!-- <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">

                                                    <input class="form-control input-height" name="contract_end_date" size="16" placeholder="End Date" type="text" value="" autocomplete="off">

                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>

                                                </div>
                                                -->
                                                <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input4" data-link-format="yyyy-mm-dd">

                                                    <input class="form-control input-height"  id="contract_start_date" name="contract_end_date" size="16" placeholder="Registration Date" type="text" value="<?php echo date('d-m-Y', strtotime($staffs['contract_end_date'])); ?>">

                                                </div>
                                                <input type="hidden" id="dtp_input4" value="">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Salary

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7">
                                                <div class="input-group ph-form">
                                                    <select name="sal_curr" class="form-control">
                                                        <option value="AED" <?php echo ($staffs['sal_curr'] == "AED") ? "selected=''" : ""; ?>>AED</option>
                                                        <option value="USD" <?php echo ($staffs['sal_curr'] == "USD") ? "selected=''" : ""; ?>>USD</option>
                                                        <option value="AUD" <?php echo ($staffs['sal_curr'] == "AUD") ? "selected=''" : ""; ?>>AUD</option>
                                                    </select>
                                                    <input type="text" name="salary" placeholder="Salary" class="form-control input-height" value="<?php echo $staffs['salary']; ?>"> </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Bonus Detail

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-7"><div class="input-group ph-form">
                                                    <select name="sal_curr" class="form-control">
                                                        <option value="AED" <?php echo ($staffs['bonus_curr'] == "AED") ? "selected=''" : ""; ?>>AED</option>
                                                        <option value="USD" <?php echo ($staffs['bonus_curr'] == "USD") ? "selected=''" : ""; ?>>USD</option>
                                                        <option value="AUD" <?php echo ($staffs['bonus_curr'] == "AUD") ? "selected=''" : ""; ?>>AUD</option>
                                                    </select>
                                                    <input name="bonus" type="text" placeholder="Bonus Detail" value="<?php echo $staffs['bonus']; ?>" class="form-control input-height"> </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Passport Number

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <input name="passport" type="text" placeholder="Passport Number" value="<?php echo $staffs['passport_no']; ?>" class="form-control input-height"> </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Emirates ID

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <input name="emirate_id" type="text" placeholder="Emirates ID" value="<?php echo $staffs['emirate_id']; ?>"class="form-control input-height"> </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Annual Leaves

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <input name="annual_leaves" type="text" placeholder="Annual Leaves" class="form-control input-height" value="<?php echo $staffs['annual_leave']; ?>"> </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Define Portal Roles

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <select class="form-control" required="" name="defined_role">

                                                    <option value="">Select</option>

                                                    <option value="2" <?php echo ($staffs['role'] == "2") ? "selected=''" : ""; ?>>Coach</option>

                                                    <option value="3" <?php echo ($staffs['role'] == "3") ? "selected=''" : ""; ?>>Management</option>

                                                    <option value="4" <?php echo ($staffs['role'] == "4") ? "selected=''" : ""; ?>>Department Heads</option>

                                                    <option value="5" <?php echo ($staffs['role'] == "5") ? "selected=''" : ""; ?>>Site Lead</option>

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

                                                <input type="file" name="userfile"  class="default" accept="image/x-png,image/gif,image/jpeg" >

                                            </div>

                                        </div>

                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Add Documents</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Documents

                                            </label>

                                            <div class="compose-editor">

                                                <input type="file" class="default" name="multipleUpload" id="multipleUpload" accept="image/x-png,image/gif,image/jpeg" >

                                            </div>

                                            <div class="clear"></div>

                                            <div id="append_document" class="col-md-12">
                                                <?php
                                                if (!empty($documents)) {
                                                    foreach ($documents as $document) {
                                                        ?>
                                                        <div class="appenddocument">

                                                            <a href="<?= site_url('/assets/uploads/' . $document['document_path']) ?>" target="_blank">View Document</a>
                                                            <a class="closemyself delete_self" data-id="<?php echo $document['id']; ?>">x</a>
                                                        </div>

                                                        <?php
                                                    }
                                                }
                                                ?>


                                            </div>

                                        </div>

                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Qualification/Skills</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Description

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <textarea name="qualification" placeholder="address" class="form-control-textarea" rows="5"><?php echo $staffs['qual_skill']; ?></textarea>

                                            </div>

                                        </div>



                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Next Of Kin</h3>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Full Name

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <input type="text" required="required" name="kin_firstname" placeholder="Enter Full name" class="form-control input-height" value="<?php echo $staffs['kin_first_name']; ?>">

                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Relationship

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <input type="text" required="required" name="replationship" placeholder="Relationship" class="form-control input-height" value="<?php echo $staffs['replationship']; ?>">

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4"> Phone Number

                                            </label>

                                            <div class="col-md-7">

                                                <div class="input-group ph-form">
                                                    <select name="k_code" class="form-control">
                                                        <option value="+971">+971</option>
                                                        <option value="+92">+92</option>
                                                        <option value="+91">+91</option>
                                                    </select>


                                                    <input type="text" required="required" class="form-control input-height" name="kin_phone" placeholder="Phone Number" value="<?php echo $staffs['kin_phone']; ?>"> </div>

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="control-label col-md-4">Address

                                                <span class="required" aria-required="true"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <textarea name="kin_address" placeholder="address" class="form-control-textarea" rows="5">
                                                    <?php echo $staffs['kin_address']; ?>
                                                </textarea>

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

                                                <textarea name="med_address" class="form-control" id="med_address" placeholder="Write briefly about staff's medical condition" class="Detail" rows="5"> <?php echo $staffs['medical_address']; ?></textarea>

                                            </div>

                                        </div>







                                    </div>

                                </div>

                                <div class="form-actions">

                                    <div class="row">

                                        <div class="col-md-9">

                                            <button type="submit" class="btn btn-circle btn-warning">UPDATE STAFF</button>

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
        $(".delete_self").on('click', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: "<?php echo site_url('/staff_management/delete_document'); ?>",
                data: {document_id: id},
                success: function () {

                }
            });
        });
    });

</script>