<div class="page-content-wrapper">
    <div class="page-content" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Staff Profile</div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <div class="card card-topline-aqua">
                        <div class="card-body no-padding height-9">
                            <div class="row">
                                <div class="profile-userpic">
                                    <img src="<?php echo site_url("/assets/uploads/" . $staff[0]['pro_pic']); ?>" class="img-responsive" alt=""> 
                                </div>
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"><?= $staff[0]['first_name'] . " " . $staff[0]['middle'] . " " . $staff[0]['last_name'] ?></div>
                            </div>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="pull-right"><?= ucfirst($staff[0]['gender']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Designation</b> <a class="pull-right"><?= $staff[0]['designation']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Date Of Birth</b> <a class="pull-right"><?= date('m-d-Y', strtotime($staff[0]['dob'])); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Age</b> <a class="pull-right"><?= abs(date('Y', strtotime($staff[0]['dob'])) - date('Y')); ?></a>
                                </li>

                            </ul>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->

                            <!-- END SIDEBAR BUTTONS -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>Account Information</header>
                        </div>
                        <div class="card-body no-padding height-9">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Personal Contact: </b> <a class="pull-right"><?= $staff[0]['p_code'] . " " . $staff[0]['personal_contact']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Work Contact</b> <a class="pull-right"><?= $staff[0]['w_code'] . " " . $staff[0]['work_contact']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Contract Date From: </b> <a class="pull-right"><?= date('m-d-Y', strtotime($staff[0]['contract_start_date'])); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Contract Date To: </b> <a class="pull-right"><?= date('m-d-Y', strtotime($staff[0]['contract_end_date'])); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Salary: </b> <a class="pull-right"><?= $staff[0]['sal_curr'] . " " . $staff[0]['salary']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Bonus: </b> <a class="pull-right"><?= $staff[0]['bonus_curr'] . " " . $staff[0]['bonus']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Passport No# </b> <a class="pull-right"><?= $staff[0]['passport_no']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Emirates ID # </b> <a class="pull-right"><?= $staff[0]['emirate_id']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Annual Leaves </b> <a class="pull-right"><?= $staff[0]['annual_leave']; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-head card-topline-aqua">
                            <header>Documents</header>
                        </div>
                        <div class="card-body no-padding height-9">

                            <ul class="list-group list-group-unbordered">
                                <?php
                                if (!empty($documents)) {
                                    foreach ($documents as $document) {
                                        ?>
                                        <li class="list-group-item">
                                            <b><?php echo $document['document_path']; ?></b>
                                            <div class="profile-desc-item pull-right">
                                                <ul>
                                                    <li><a target="_blank" href="<?php echo site_url("/assets/uploads/" . $document['document_path']) ?>">View</a></li>
                                                    <!--<li><a href="#">Email</a></li>-->
                                                </ul>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div class="row list-separated profile-stat">
                                <div class="col-md-4 col-sm-4 col-6">
                                    <div class="uppercase profile-stat-title"> <?= $staff[0]['annual_leave']; ?> </div>
                                    <div class="uppercase profile-stat-text"> Total Leaves </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-6">
                                    <div class="uppercase profile-stat-title"> <?= (!empty($absense['total_leaves'])) ? $absense['total_leaves'] : "0"; ?></div>
                                    <div class="uppercase profile-stat-text"> Absence </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-6">
                                    <div class="uppercase profile-stat-title"> <?= ((int) $staff[0]['annual_leave'] - (int) $absense['total_leaves']) ?> </div>
                                    <div class="uppercase profile-stat-text"> Remaining</div>
                                </div>
                            </div>
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
                                <!-- Nav tabs -->
                                <div class="p-rl-20">
                                    <ul class="nav customtab nav-tabs" role="tablist">
                                        <li class="nav-item"><a href="#tab1" class="nav-link" data-toggle="tab">About </a></li>
                                        <!-- <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">Leave Request</a></li> -->

                                    </ul>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active fontawesome-demo" id="tab1">
                                        <div id="biography">
                                            <div class="row m-bio">
                                                <div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
                                                    <br>
                                                    <p class="text-muted"><?= $staff[0]['first_name'] . " " . $staff[0]['middle'] . " " . $staff[0]['last_name']; ?></p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>Mobile</strong>
                                                    <br>
                                                    <p class="text-muted"><?= "(" . $staff[0]['w_code'] . ")" . $staff[0]['work_contact']; ?></p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
                                                    <br>
                                                    <p class="text-muted"><?= $staff[0]['email']; ?></p>
                                                </div>
                                                <div class="col-md-3 col-6 b-r"> <strong>Staff Order ID</strong>
                                                    <br>
                                                    <p class="text-muted"><?= $staff[0]['order_id']; ?></p>
                                                </div>

                                            </div>
                                            <hr>
                                            <h4 class="font-bold">Medical Condition</h4>
                                            <p><?= $staff[0]['medical_address']; ?></p>
                                            <hr>
                                            <h4 class="font-bold">Education/Skill</h4>
                                            <p><?= $staff[0]['qual_skill']; ?></p>
                                            <hr>
                                            <h4 class="font-bold">Next Of Kin</h4>
                                            <p>Name: <?= $staff[0]['kin_first_name']; ?></p> 
                                            <p>Phone:<?= "(" . $staff[0]['k_code'] . ")" . $staff[0]['kin_phone']; ?></p> 
                                            <p>Address: <?= $staff[0]['kin_address']; ?></p>
                                            <p>Relationship: <?= $staff[0]['replationship']; ?></p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="container-fluid">
                                            <div class="row"><h3>STATISTICS</h3></div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- END PROFILE CONTENT -->
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                <a href="<?php echo site_url('/admin/staff-management') ?>" class="btn btn-circle btn-warning black">BACK</a>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                <a href="<?php echo site_url('/admin/staff-management/edit-staff/' . encrypt_decrypt('encrypt', $staff_id)) ?>" class="btn btn-circle btn-warning black">EDIT</a>
            </div>
        </div>
    </div>

    <!-- end page content -->
    <!-- start chat sidebar -->

    <!-- end chat sidebar -->
</div>