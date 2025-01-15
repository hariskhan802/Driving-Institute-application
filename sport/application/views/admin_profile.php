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
    <div class="page-content" style="min-height:487px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title ng-binding">My Profile</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box add-form">
                    <div class="card-body coaches">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="<?php echo site_url("/admin/save-admin-profile"); ?>" enctype="multipart/form-data" style="">
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">First Name
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" name="first_name" value="<?php echo $profile['first_name']; ?>" placeholder="Enter first name" class="form-control input-height" required="required" style="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Last Name
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" name="last_name" value="<?= $profile['last_name']; ?>" placeholder="Enter last name" class="form-control input-height"  required="required" style="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Contact No.
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-2">
                                                        <select name="code" class="form-control input-height ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required" required="required" style="">
                                                            <option value="+971">+971</option>
                                                            <option value="+92">+92</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input name="contact_number" value="<?= $profile['contact']; ?>" type="text" placeholder="Contact Number" class="form-control input-height ng-untouched ng-not-empty ng-valid ng-valid-required ng-dirty ng-valid-mask ng-valid-parse"  required="required" clean="true" mask="999-9999" style="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Address
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <textarea name="address" placeholder="Address" class="form-control-textarea ng-pristine ng-untouched ng-valid ng-not-empty" rows="5" style=""><?= $profile['address']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Profile Picture</label>
                                                    <div class="compose-editor ng-hide" style="">
                                                        <!-- ngRepeat: file in files -->
                                                        <input type="file" class="default ng-pristine ng-untouched ng-valid ng-empty" name="profile_pic" file-model="files" id="UploadFiles">
                                                    </div>
                                                    <div class="compose-editor" style="">
                                                        <div class="col-md-3 offset-md-5">
                                                            <div class="coach-img">
                                                                <img  class="img-thumbnail" id="pics" src="<?php echo site_url('/assets/uploads/profile_pics/' . $profile['pic']); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="offset-md-3 col-md-9">
                                                            <button type="submit" class="btn btn-circle btn-warning">Update Profile</button>
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
            </div>
        </div>
    </div>
</div>
<script>
    $("#UploadFiles").on('change', function () {
        change_pic(this, "#pics");
    });
    function change_pic(element, elemn) {
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            console.log(reader.result);
            $(elemn).attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }

</script>