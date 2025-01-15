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
                        <form action="<?php echo site_url('admin/general-settings/save-vat-discount-setting'); ?>" method="post">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="xtra_label addfont">VAT %</label>
                                    <input type="text" class="form-control xtra_input" value="<?php echo $vats['vat']; ?>" name="vat" placeholder="Enter Percentage" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                    <button type="submit" class="btn btn-circle btn-warning ">SAVE</button>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                    <a href="<?= site_url('/admin/general-settings/'); ?>" class="btn btn-circle btn-warning black">BACK</a>
                                </div>
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
    .clearfix,.clear{clear:both;}

</style>