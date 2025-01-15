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
                        <form action="<?php echo site_url('/admin/general-settings/save-terms') ?>" method="post">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="xtra_label addfont">TERM 1</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="input-append date form_datex termone col-md-3  pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="termone_start_date" size="30" type="text" value="<?php echo $terms[0]['start_month'] ?>" readonly="" placeholder="Start Date">
                                    </div>
                                    <div class="input-append date form_date_termone col-md-3  pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="termone_end_date" size="30" type="text" value="<?php echo $terms[0]['end_month'] ?>" readonly="" placeholder="End Date">
                                    </div>
                                    <div class="col-md-3  pull-left">
                                        <input type="text" name="termone_fee" readonly="" value="<?php echo $terms[0]['num_of_weeks'] ?>" class="pull-left" placeholder="No. of Weeks "/>
                                    </div>
                                    <input type="button" id="termone_week" class="btn btn-success black btn-xs" value="Calculate weeks"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="xtra_label addfont">TERM 2</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="input-append date termtwo form_datex col-md-3  pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="termtwo_start_date" size="30" type="text" value="<?php echo $terms[1]['start_month'] ?>" readonly="" placeholder="Start Date">
                                    </div>
                                    <div class="input-append date form_date_termtwo col-md-3  pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="termtwo_end_date" size="30" type="text" value="<?php echo $terms[1]['end_month'] ?>" readonly="" placeholder="End Date">
                                    </div>
                                    <div class="col-md-3  pull-left">
                                        <input type="text" name="termtwo_fee" readonly="" value="<?php echo $terms[1]['num_of_weeks'] ?>" class="pull-left" placeholder="No. of Weeks "/>
                                    </div>
                                    <input type="button" id="termtwo_week" class="btn btn-success black btn-xs" value="Calculate weeks"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="xtra_label addfont">TERM 3</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="input-append date termthree form_datex col-md-3  pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="termthree_start_date"  size="30" type="text" value="<?php echo $terms[2]['start_month'] ?>" readonly="" placeholder="Start Date">
                                    </div>
                                    <div class="input-append date form_date_termthree col-md-3  pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="termthree_end_date" size="30" type="text" value="<?php echo $terms[2]['end_month'] ?>" readonly="" placeholder="End Date">
                                    </div>
                                    <div class="col-md-3  pull-left">
                                        <input type="text" name="termthree_fee" readonly="" value="<?php echo $terms[2]['num_of_weeks'] ?>" class="pull-left" placeholder="No. of Weeks "/>
                                    </div>
                                    <input type="button" id="termthree_week" class="btn btn-success black btn-xs" value="Calculate weeks"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="xtra_label addfont">TERM 4</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="input-append date form_datex termfour col-md-3  pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="termfour_start_date" size="30" type="text" value="<?php echo $terms[3]['start_month'] ?>" readonly="" placeholder="Start Date">
                                    </div>
                                    <div class="input-append date form_date_termfour col-md-3  pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="termfour_end_date" size="30" type="text" value="<?php echo $terms[3]['end_month'] ?>" readonly="" placeholder="End Date">
                                    </div>
                                    <div class="col-md-3  pull-left">
                                        <input type="text" name="termfour_fee" readonly="" value="<?php echo $terms[3]['num_of_weeks'] ?>" class="pull-left" placeholder="No. of Weeks "/>
                                    </div>
                                    <input type="button" id="termfour_week" class="btn btn-success black btn-xs" value="Calculate weeks"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2 pull-left">
                                    <button type="submit" class="btn btn-circle btn-warning ">SAVE TERMS</button>
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
<script>
    function diff_weeks(dt2, dt1)
    {
        var diff = (dt2.getTime() - dt1.getTime()) / 1000;
        diff /= (60 * 60 * 24 * 7);
        return Math.abs(Math.round(diff));
    }
</script>
<style>
    a.yellow_btn {
        font-size: 10px;
        padding: 7px;
        background: #fbed22;
        float: left;
        height: 30px;
        color: #000;
    }
</style>