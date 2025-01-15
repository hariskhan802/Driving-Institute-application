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

                    <div class="page-title">Edit Child</div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="card card-box">



                    <div class="card-body" id="bar-parent">
                        <form action="<?php echo site_url('/admin/child-management/update-child'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <input type="hidden" name="child_id" value="<?= $child_id; ?>"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">Child Information</h3>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">First Name
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" required="required" value="<?= $students['firstname']; ?>" name="firstname" placeholder="Enter First Name" class="form-control input-height">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Last Name
                                            </label>
                                            <div class="col-md-7">
                                                <input type="text" name="lastname" value="<?= $students['lastname']; ?>" placeholder="Enter Last Name" class="form-control input-height">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Date Of Birth
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                                    <input class="form-control input-height" value="<?= date('d-m-Y', $students['date_of_birth']); ?>"  id="dob" name="dob" size="16" placeholder="Date Of Birth" type="text" value="">
                                                </div>
                                                <input type="hidden" id="dtp_input2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">School Name
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <select name="school_name" class="form-control input-height">
                                                        <option value="">Select School</option>
                                                        <?php
                                                        if (!empty($venues)) {
                                                            foreach ($venues as $venue) {
                                                                ?>
                                                                <option value="<?= $venue['id']; ?>" <?= ($students['venue_id'] == $venue['id']) ? "selected=''" : ""; ?>><?= $venue['venue_name']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Contact No
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" name="contact_no" value="<?= $students['contact_number']; ?>" placeholder="Enter Contact No" class="form-control input-height">
                                                </div>
                                                <input type="hidden" id="dtp_input2" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Gender
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <select class="form-control input-height" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="male" <?= ($students['gender'] == 'm') ? "selected=''" : ""; ?>>Male</option>
                                                    <option value="female" <?= ($students['gender'] == 'f') ? "selected=''" : ""; ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Medical Condition (if yes, Please specify)
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="radio" name="medical" value="1" <?= ($students['medical_condition_active'] == '1') ? "checked=''" : ""; ?>/> Yes
                                                <input type="radio" name="medical" value="0" <?= ($students['medical_condition_active'] == '0') ? "checked=''" : ""; ?>/> No
                                            </div>
                                        </div>
                                        <?php
                                        if ($students['medical_condition_active'] == 1) {
                                            ?>
                                            <div class="form-group row medical_condition">
                                                <label class="control-label col-md-5">Note
                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-7">
                                                    <textarea name="note"><?= $students['medical_condition_note']; ?></textarea>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Allow Photograph
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <input type="radio" name="photograph" value="yes" <?= ($students['photography_allowed'] == 'yes') ? "checked=''" : ""; ?>/> Yes
                                                <input type="radio" name="photograph" value="no" <?= ($students['photography_allowed'] == 'no') ? "checked=''" : ""; ?>/> No
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-5">Profile Picture</label>
                                            <div class="col-md-5 pull-left">
                                                <div class="input-group">
                                                    <input type="file" name="userfile" class="default" accept="image/x-png,image/gif,image/jpeg" >
                                                </div>
                                            </div>
                                            <div class="col-md-2 pull-left">
                                                <img src="<?= site_url('/assets/uploads/profile_pictures/' . $students['photo_path']) ?>" class="img-thumbnail"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-circle btn-warning">UPDATE CHILD</button>
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
        $('input[name="medical"]').on('change', function () {
            if ($(this).val() == "1") {
                $(".medical_condition").show();
            } else {
                $(".medical_condition").hide();
            }
        })
    });
</script>