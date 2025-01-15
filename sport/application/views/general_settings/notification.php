<div class="page-content-wrapper program-creation">
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
    <div class="page-content" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-7">
                        <div class="page-title">GENERAL SETTINGS</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body">   
                        <form action="<?php echo site_url('/admin/general-settings/save-notification/') ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Notification</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-body">
                                    <div class="row" id="filters">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                            <label>Select Club</label> 
                                            <select class="form-control" id="club_drp" name="club" required="">
                                                <?php echo print_dropdown($clubs); ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                            <label>Select Programme</label>
                                            <select class="form-control" id="program_drp" name="program" required="">
                                                <?php echo print_dropdown($programs); ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                            <label>Select Venue</label> 
                                            <select class="form-control" id="venues_drp" name="venues" required="">
                                                <?php echo print_dropdown($venues); ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-2 col-3">
                                            <label>Email Address</label> 
                                            <select class="form-control" id="emailAddress" name="emailAddress">
                                                <?php
                                                foreach ($Coaches as $Coache) {
                                                    echo "<option value='" . $Coache['email'] . "'>" . $Coache['email'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                            <input type="button" class="btn btn-circle btn-warning " id="add_notification" value="Add"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="gap"></div>
                                        <div class="col-md-12" id="append_noti">
                                            <?php
                                            if (!empty($notifications)) {
                                                foreach ($notifications as $notification) {
                                                    ?>
                                                    <div class="noti_box col-md-12">
                                                        <div class="col-md-2 pull-left">
                                                            <?php echo $notification['club_name']; ?>
                                                            <input type="hidden" name="clubs[]" value="<?php echo $notification['club_id']; ?>"/>
                                                        </div>
                                                        <div class="col-md-2 pull-left">
                                                            <?php echo $notification['program_name']; ?>
                                                            <input type="hidden" name="programs[]" value="<?php echo $notification['program_id']; ?>"/>
                                                        </div>
                                                        <div class="col-md-2 pull-left">
                                                            <?php echo $notification['venue_name']; ?>
                                                            <input type="hidden" name="venue[]" value="<?php echo $notification['venue_id']; ?>"/>
                                                        </div>
                                                        <div class="col-md-2 pull-left">
                                                            <?php echo $notification['email_address']; ?>
                                                            <input type="hidden" name="email[]" value="<?php echo $notification['email_address']; ?>"/>
                                                        </div>
                                                        <div class="col-md-2 pull-left">
                                                            <a href="#" class="delete_noti pull-left"><i class="material-icons">delete_sweep</i></a>
                                                        </div>
                                                    </div>
                                                    <div class="clear clearfix"></div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="clear"></div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 pull-left">
                                <button type="submit" class="btn btn-circle btn-warning ">SAVE NOTIFICATION</button>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                <a href="<?= site_url('/admin/general-settings/'); ?>" class="btn btn-circle btn-warning black">BACK</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end chat sidebar -->
            </div>
        </div>
    </div>
    <!-- end page container -->

    <!-- start footer -->



    <!-- end footer -->

</div>
<style>
    .roundbox {
        padding: 24px;
        position: relative;
        border-radius: 20px;
        border: 1px solid #ddd;
        background: #fbed22;
        margin:20px;
    }
    .ap_fonts{
        font-size:28px;
    }
    label.xtra_label {
        float: left;
        width: 130px;
        padding: 6px;
        background: #fbed22;

    }
    .gap {
        height: 23px;
        clear: both;
        display: block;
        width: 100%;
    }
    .addfont {
        font-size: 19px !important;
        text-align: center;
    }
    .xtra_input {
        float: left;
        width: 60% !important;
        display: block;
        border-radius: 0px 10px 10px 0px !important;
        padding: 21px !important;
    }
    .image_show {
        border: 1px solid #ddd;
        padding: 2px;
    }
    .clearfix,.clear{clear:both;}

</style>
<script>
    $(document).ready(function () {
        $("#append_noti").on('click', ".delete_noti", function () {
            $(this).parents(".noti_box").remove();
        });
        $("#add_notification").on('click', function () {
            var club_id = $("#club_drp").val();
            var club_text = $("#club_drp").find("option:selected").text();

            var program_id = $("#program_drp").val();
            var program_text = $("#program_drp").find("option:selected").text();

            var venue_id = $("#venues_drp").val();
            var venue_text = $("#venues_drp").find("option:selected").text();

            var emailAddress = $("#emailAddress").val();
            var inputs = $(this).parents("#filters").find("input,select");
            var that = $(this);
            var isValid = true;
            $.each(inputs, function () {
                var currentInput = $(this).val();
                if (currentInput == "") {
                    alert($(this).attr("name").replace("_", " ").toUpperCase() + " required");
                    isValid = false;
                    return false;
                }
            });
            if (isValid) {
                var element = '<div class="noti_box col-md-12">' +
                        '<div class="col-md-2 pull-left">' + club_text +
                        '<input type="hidden" name="clubs[]" value="' + club_id + '"/>' +
                        '</div>' +
                        '<div class="col-md-2 pull-left">' + program_text +
                        '<input type="hidden" name="programs[]" value="' + program_id + '"/>' +
                        '</div>' +
                        '<div class="col-md-2 pull-left">' + venue_text +
                        '<input type="hidden" name="venue[]" value="' + venue_id + '"/>' +
                        '</div>' +
                        '<div class="col-md-2 pull-left">' + emailAddress +
                        '<input type="hidden" name="email[]" value = "' + emailAddress + '"/>' +
                        '</div>' +
                        '<div class="col-md-2 pull-left">' +
                        '<a href="#" class="delete_noti pull-left"> <i class="material-icons">delete_sweep</i></a>' +
                        '</div>' +
                        '</div>';
                $("#append_noti").append(element);
            }
        });
    });
</script>