<div class="page-content-wrapper">
    <link href="<?= site_url('/assets/css/validationEngine.jquery.css') ?>" rel="stylesheet"/>
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
                        <div class="page-title ng-binding">Settings</div>
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
                                        <form id="formID" method="post" enctype="multipart/form-data" style="">
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">New Password
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="password" name="password" id="password" value="" placeholder="Enter Password" class="validate[required] form-control input-height" style="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Confirm Password
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="password" name="cpassword" id="cpassword" value="" placeholder="Enter Confirm Password" class="validate[required,equals[password]] form-control input-height" style="">
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="offset-md-3 col-md-9">
                                                            <button type="submit" class="btn btn-circle btn-warning">Update Password</button>
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
<script src="<?php echo site_url('/assets/js/languages/jquery.validationEngine-en.js') ?>"></script>
<script src="<?php echo site_url('/assets/js/jquery.validationEngine.js') ?>"></script>
<script>
        $(document).ready(function () {
            $("#formID").validationEngine();
        });
</script>