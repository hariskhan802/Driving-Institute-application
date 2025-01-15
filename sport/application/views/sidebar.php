<!-- start sidebar menu -->
<div class="sidebar-container">
    <?php $userRole = $this->userinfo['role']; ?>
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll" class="left-sidemenu">
            <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php
                            if ($this->userinfo['username'] == "admin") {
                                $image = $this->db->query("select pic from admin_profile")->row_array();
                                ?>
                                <img src="<?php echo site_url("/assets/uploads/profile_pics/" . $image['pic']) ?>" class="img-circle user-img-circle" alt="User Image" />
                                <?php
                            } else {
                                $image = '';
                                if ($this->userinfo['role'] != "1") {
                                    $image = $this->db->query("SELECT * FROM staff WHERE staff_id='{$this->userinfo['id']}'")->row_array();
                                }
                                ?>
                                <img src="<?php echo site_url('/assets/uploads/' . $image['pro_pic']); ?>" class="img-circle user-img-circle" alt="User Image" />
                                <?php
                            }
                            ?>
                        </div>

                        <div class="pull-left info">

                            <p> <?php
                                if ($this->userinfo['username'] == "admin") {
                                    $fullName = $this->db->query("select * from admin_profile")->row_array();
                                    echo $fullName['first_name'] . " " . $fullName['last_name'];
                                } else {
                                    echo ucfirst($this->userinfo['username']);
                                }
                                ?></p>
                        </div>
                    </div>
                </li>
                <li class="nav-item start">
                    <a href="<?php echo site_url('/admin/dashboard/'); ?>" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <?php if ($userRole == 1) { ?>
                    <li class="nav-item  <?php if (getControllerName() == "program_management") echo 'active open' ?>">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                            <span class="title">Programme Management</span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item">
                                <a href="<?php print_url('/admin/program-management'); ?>" class="nav-link ">
                                    <span class="title">All Programme</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php print_url('/admin/program-management/create-program'); ?>" class="nav-link ">
                                    <span class="title">Add Programme</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  <?php if (getControllerName() == "session_management") echo 'active open' ?>">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                            <span class="title">Session Management</span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item">
                                <a href="<?php print_url('/admin/session-management'); ?>" class="nav-link ">
                                    <span class="title">All Sessions</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php print_url('/admin/session-management/create-session'); ?>" class="nav-link ">
                                    <span class="title">Add Session</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  <?php if (getControllerName() == "calendar_management") echo 'active open' ?>">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                            <span class="title">Calendar Management</span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item">
                                <a href="<?= site_url('/admin/calendar-management/calendar-listings'); ?>" class="nav-link nav-toggle">
                                    <span class="title">Calendar Management</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo site_url("/admin/child-management/"); ?>" class="nav-link nav-toggle"> <i class="material-icons">accessibility</i>
                            <span class="title">Child Management</span>
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                  <!--       <a href="<?php //echo site_url('/admin/attendance-management/student-attendance')                              ?>" class="nav-link nav-toggle"> <i class="material-icons">business</i>
                            <span class="title">Attedance Management</span>
                        </a>
                    </li> -->

                    <li class="nav-item">
                        <a href="<?php echo site_url('/admin/assessment-management/') ?>" class="nav-link nav-toggle"> <i class="material-icons">business</i>
                            <span class="title">Assessment Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('/admin/assessment-management/makeup-assessment/') ?>" class="nav-link nav-toggle"> <i class="material-icons">business</i>
                            <span class="title">Makeup Session</span>
                        </a>
                    </li>
                    <li class="nav-item  <?php if (getControllerName() == "discount_management") echo 'active open' ?>">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">event</i>
                            <span class="title">Discount Management</span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-toggle"> 
                                    <span class="title">Venue Discount</span>
                                    <i class="material-icons" style="color: #000;">arrow_drop_down</i>
                                </a>
                                <ul class="sub-menu" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?php print_url('/admin/discount-management/venues-discount'); ?>" class="nav-link ">
                                            <span class="title">All Venue Discounts</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php print_url('/admin/discount-management/add-venue-discount'); ?>" class="nav-link ">
                                            <span class="title">Add Venue Discount</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?php print_url('/admin/discount-management/training-fee'); ?>" class="nav-link ">
                                    <span class="title">Other</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?php if (getControllerName() == "venue_management") echo 'active open' ?>">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">domain</i>
                            <span class="title">Venue Management</span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item active">
                                <a href="<?php print_url('/admin/venue-management'); ?>" class="nav-link ">
                                    <span class="title">All Venue</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php print_url('/admin/venue-management/add-venue'); ?>" class="nav-link ">
                                    <span class="title">Add Venue</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?php if (getControllerName() == "staff_management") echo 'active open' ?>">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">domain</i>
                            <span class="title">Staff Management</span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item">
                                <a href="<?= site_url('/admin/staff-management'); ?>" class="nav-link nav-toggle">
                                    <span class="title">All Staffs</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('/admin/staff-management/add-staff'); ?>" class="nav-link nav-toggle">
                                    <span class="title">Add Staff</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('/admin/staff-timetable'); ?>" class="nav-link nav-toggle">
                                    <span class="title">Staff Timetable</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('/admin/staff-management/absense'); ?>" class="nav-link nav-toggle">
                                    <span class="title">Staff Absense</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('/admin/staff-management/staff-leave-request'); ?>" class="nav-link nav-toggle">
                                    <span class="title">Leave Requests</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('/admin/company-overview'); ?>" class="nav-link nav-toggle">
                            <i class="material-icons">email</i>
                            <span class="title">Company Overview</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if (getControllerName() == "business_projections") echo 'active open' ?>">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">domain</i>
                            <span class="title">Business Projections</span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item active">
                                <a href="<?php echo site_url('/admin/business_projections'); ?>" class="nav-link nav-toggle">
                                    <span class="title">Business Projections</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php print_url('/admin/business_projections/child'); ?>" class="nav-link ">
                                    <span class="title">Payment Summary</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php print_url('/admin/business_projections/project_by_parents'); ?>" class="nav-link ">
                                    <span class="title">Registered Parents</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php print_url('/admin/business_projections/assessment_entries/'); ?>" class="nav-link ">
                                    <span class="title">Assessment Entries</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php print_url('/admin/business_projections/makeup_session_entries'); ?>" class="nav-link ">
                                    <span class="title">Makeup Session Entries</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('/admin/general-settings/'); ?>" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                            <span class="title">General Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url("/admin/attendance-management"); ?>" class="nav-link nav-toggle"><i class="material-icons">domain</i>
                            <span class="title">Child Attendance</span>
                        </a>
                    </li>
    <!--                    <li class="nav-item <?php if (getControllerName() == "venue_management") echo 'active open' ?>">
                        <a href="#" class="nav-link nav-toggle"> <i class="material-icons">domain</i>
                            <span class="title">Attendance Management</span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item">
                                <a href="<?= site_url("/admin/attendance-management"); ?>" class="nav-link nav-toggle">
                                    <span class="title">Mark Attendance</span>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a href="<?php print_url('/admin/attendance-management/student-attendance'); ?>" class="nav-link ">
                                    <span class="title">Child Attendance</span>
                                </a>
                            </li>

                        </ul>
                    </li>-->
                <?php } else {
                    ?>
                    <li class="nav-item">
                        <a href="<?= site_url("/admin/attendance-management"); ?>" class="nav-link nav-toggle"> <i class="material-icons">local_library</i>
                            <span class="title">Attendance Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('/admin/staff-management/leave-application/' . encrypt_decrypt('encrypt', $this->current_user)); ?>" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                            <span class="title">Leave Request</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('/admin/child_management/students'); ?>" class="nav-link nav-toggle"> <i class="material-icons">widgets</i>
                            <span class="title">Student Management</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item">
                    <a href="<?php echo site_url("logout") ?>" class="nav-link nav-toggle">
                        <i class="material-icons">store</i>
                        <span class="title">Log out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- end sidebar menu -->

<!-- start page content -->