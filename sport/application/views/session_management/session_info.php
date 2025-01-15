<div class="page-content-wrapper">
    <div class="page-content" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">SESSION INFORMATION</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header><?= $sessions['session_name'] ?></header>
                        </div>
                        <div class="card-body no-padding height-9">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Term</b>
                                    <div class="profile-desc-item pull-right"><?= $sessions['term_name'] ?></div>
                                </li>
                                <li class="list-group-item">
                                    <b>Club</b>
                                    <div class="profile-desc-item pull-right"><?= $sessions['club_name'] ?></div>
                                </li>
                                <li class="list-group-item">
                                    <b>Programme</b>
                                    <div class="profile-desc-item pull-right"><?= $sessions['program_name'] ?></div>
                                </li>
                                <li class="list-group-item">
                                    <b>Level</b>
                                    <div class="profile-desc-item pull-right"><?= (!empty($sessions['level_name'])) ? $sessions['level_name'] : "N/A" ?></div>
                                </li>
                                <li class="list-group-item">
                                    <b>Venue Name</b>
                                    <div class="profile-desc-item pull-right"><?= $sessions['venue_name'] ?></div>
                                </li>
                            </ul>
                            <!-- Start Attendence Here -->
                            <!-- Code Here -->
                            <!-- End Attendence Here -->
                        </div>
                    </div>


                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="card">
                            <div class="card-topline-aqua">
                                <header></header>
                            </div>
                            <div class="white-box">
                                <div class="tab-content">
                                    <div class="tab-pane active fontawesome-demo" id="tab1">
                                        <div id="biography">
                                            <?php echo $html; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
            <a href="<?php echo site_url('/admin/session-management') ?>" class="btn btn-circle btn-warning black">BACK</a>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
            <a href="<?php print_url('/admin/session-management/edit_session/' . encrypt_decrypt('encrypt', $sessions['id'])); ?>" class="btn btn-circle btn-warning black">EDIT</a>
        </div>
        <div class="clear clearfix"></div>
    </div>
    <!-- end page content -->

</div>