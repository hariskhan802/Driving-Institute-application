<!DOCTYPE html>

<html lang="en">

    <!-- BEGIN HEAD -->

    <head>

        <meta charset="utf-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta name="description" content="Responsive Admin Template" />

        <meta name="author" content="SmartUniversity" />

        <title>MSA PORTAL</title>

        <!-- google font -->

        <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />

        <!-- icons -->
        <link href="<?php echo ASSETS; ?>fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS; ?>fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS; ?>fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
        <!--bootstrap -->
        <link rel="stylesheet" href="<?php echo ASSETS; ?>plugins/material/material.min.css">
        <link rel="stylesheet" href="<?php echo ASSETS; ?>css/material_style.css">
        <link rel="stylesheet" href="<?php echo ASSETS; ?>plugins/material-datetimepicker/bootstrap-material-datetimepicker.css" />
        <link href="<?php echo ASSETS; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo ASSETS; ?>plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo ASSETS; ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" media="screen">
        <!-- Material Design Lite CSS -->
        <link href="<?php echo ASSETS; ?>css/theme/light/theme_style.css?ver=2" rel="stylesheet" id="rt_style_components" type="text/css" />
        <link href="<?php echo ASSETS; ?>css/theme/light/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS; ?>css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS; ?>css/pages/formlayout.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS; ?>css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS; ?>css/theme/light/theme-color.css" rel="stylesheet" type="text/css" />
        <!-- dropzone -->
        <link href="<?php echo ASSETS; ?>plugins/dropzone/dropzone.css" rel="stylesheet" media="screen">
        <!--tagsinput-->
        <link href="<?php echo ASSETS; ?>plugins/jquery-tags-input/jquery-tags-input.css" rel="stylesheet">
        <!--select2-->
        <link href="<?php echo ASSETS; ?>plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo ASSETS; ?>plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo ASSETS; ?>plugins/sweetalert/sweetalert.css?ver=1.6"/>
        <!-- favicon -->
        <link rel="shortcut icon" href="http://mysportsacademydubai.com/wp-content/uploads/2016/08/cropped-ico-180x180.png" />
        <script src="<?php echo ASSETS; ?>plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo ASSETS; ?>plugins/sweetalert/sweetalert.min.js" charset="UTF-8"></script>
        <script src="<?php echo ASSETS; ?>plugins/sweetalert/jquery.sweet-alert.custom.js" charset="UTF-8"></script>
        <script src="<?php echo ASSETS; ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" charset="UTF-8"></script>
        <script src="<?php echo ASSETS; ?>js/canvasjs.min.js" charset="UTF-8"></script>
        <script src="<?php echo ASSETS; ?>plugins/chart-js/Chart.bundle.js"></script>
        <script src="<?php echo ASSETS; ?>plugins/chart-js/utils.js"></script>
    </head>

    <!-- END HEAD -->

    <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">

        <div class="page-wrapper">

            <!-- start header -->

            <div class="page-header navbar navbar-fixed-top">

                <div class="page-header-inner ">

                    <!-- logo start -->

                    <div class="page-logo">

                        <a href="<?php print_url('/') ?>">

                            <span class="logo-icon material-icons">
                                <img src="<?php echo ASSETS; ?>images/logo-icon.png"></span>

                            <span class="logo-default"><img src="<?php echo ASSETS; ?>images/logo.png"></span> </a>

                    </div>

                    <!-- logo end -->

                    <ul class="nav navbar-nav navbar-left in">

                        <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>

                    </ul>



                    <!-- start mobile menu -->

                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">

                        <span></span>

                    </a>

                    <!-- end mobile menu -->

                    <!-- start header menu -->

                    <div class="top-menu">

                        <ul class="nav navbar-nav pull-right">

                            <li><a href="javascript:;" class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>

                            <!-- start notification dropdown -->

                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">

                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <i class="fa fa-bell-o"></i>

                                    <span class="badge headerBadgeColor1"> 6 </span>

                                </a>

                                <ul class="dropdown-menu">

                                    <li class="external">

                                        <h3><span class="bold">Notifications</span></h3>

                                        <span class="notification-label purple-bgcolor">New 6</span>

                                    </li>

                                    <li>

                                        <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">just now</span>

                                                    <span class="details">

                                                        <span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-check"></i></span>

                                                        Congratulations!. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">3 mins</span>

                                                    <span class="details">

                                                        <span class="notification-icon circle purple-bgcolor"><i class="fa fa-user o"></i></span>

                                                        <b>John Micle </b>is now following you. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">7 mins</span>

                                                    <span class="details">

                                                        <span class="notification-icon circle blue-bgcolor"><i class="fa fa-comments-o"></i></span>

                                                        <b>Sneha Jogi </b>sent you a message. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">12 mins</span>

                                                    <span class="details">

                                                        <span class="notification-icon circle pink"><i class="fa fa-heart"></i></span>

                                                        <b>Ravi Patel </b>like your photo. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">15 mins</span>

                                                    <span class="details">

                                                        <span class="notification-icon circle yellow"><i class="fa fa-warning"></i></span> Warning! </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="javascript:;">

                                                    <span class="time">10 hrs</span>

                                                    <span class="details">

                                                        <span class="notification-icon circle red"><i class="fa fa-times"></i></span> Application error. </span>

                                                </a>

                                            </li>

                                        </ul>

                                        <div class="dropdown-menu-footer">

                                            <a href="javascript:void(0)"> All notifications </a>

                                        </div>

                                    </li>

                                </ul>

                            </li>

                            <!-- end notification dropdown -->

                            <!-- start message dropdown -->

                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">

                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <i class="fa fa-envelope-o"></i>

                                    <span class="badge headerBadgeColor2"> 2 </span>

                                </a>

                                <ul class="dropdown-menu">

                                    <li class="external">

                                        <h3><span class="bold">Messages</span></h3>

                                        <span class="notification-label cyan-bgcolor">New 2</span>

                                    </li>

                                    <li>

                                        <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="<?php echo ASSETS; ?>/img/prof/prof2.jpg" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Sarah Smith </span>

                                                        <span class="time">Just Now </span>

                                                    </span>

                                                    <span class="message"> Jatin I found you on LinkedIn... </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="<?php echo ASSETS; ?>/img/prof/prof3.jpg" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> John Deo </span>

                                                        <span class="time">16 mins </span>

                                                    </span>

                                                    <span class="message"> Fwd: Important Notice Regarding Your Domain Name... </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="<?php echo ASSETS; ?>/img/prof/prof1.jpg" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Rajesh </span>

                                                        <span class="time">2 hrs </span>

                                                    </span>

                                                    <span class="message"> pls take a print of attachments. </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="<?php echo ASSETS; ?>/img/prof/prof8.jpg" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Lina Smith </span>

                                                        <span class="time">40 mins </span>

                                                    </span>

                                                    <span class="message"> Apply for Ortho Surgeon </span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="#">

                                                    <span class="photo">

                                                        <img src="<?php echo ASSETS; ?>/img/prof/prof5.jpg" class="img-circle" alt=""> </span>

                                                    <span class="subject">

                                                        <span class="from"> Jacob Ryan </span>

                                                        <span class="time">46 mins </span>

                                                    </span>

                                                    <span class="message"> Request for leave application. </span>

                                                </a>

                                            </li>

                                        </ul>

                                        <div class="dropdown-menu-footer">

                                            <a href="#"> All Messages </a>

                                        </div>

                                    </li>

                                </ul>

                            </li>

                            <!-- end message dropdown -->

                            <!-- start manage user dropdown -->

                            <li class="dropdown dropdown-user">

                                <?php 
                                $userRole = $this->userinfo['role']; ?>

                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <?php
                                    if ($this->userinfo['username'] == "admin") {
                                        $image = $this->db->query("select pic from admin_profile")->row_array();
                                        ?>
                                        <img src="<?php echo site_url("/assets/uploads/profile_pics/" . $image['pic']) ?>" class="img-circle" alt="User Image" />
                                        <?php
                                    } else {
                                        $image = '';
                                        if ($this->userinfo['role'] != "1") {
                                            $image = $this->db->query("SELECT * FROM staff WHERE staff_id='{$this->userinfo['id']}'")->row_array();
                                        }
                                        ?>
                                        <img src="<?php echo site_url('/assets/uploads/' . $image['pro_pic']); ?>" class="img-circle" alt="User Image" />
                                        <?php
                                    }
                                    ?>
                                    <span class="username username-hide-on-mobile"> 
                                        <?php
                                        if ($this->userinfo['username'] == "admin") {
                                            $fullName = $this->db->query("select * from admin_profile")->row_array();
                                            echo $fullName['first_name'] . " " . $fullName['last_name'];
                                        } else {
                                            echo ucfirst($this->userinfo['username']);
                                        }
                                        ?>
                                    </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-default">

                                    <li>

                                        <a href="<?= site_url("/admin/profile/") ?>">

                                            <i class="icon-user"></i> Profile </a>

                                    </li>
                                    <?php
                                    if ($this->userinfo['username'] == "admin") {
                                        $image = $this->db->query("select pic from admin_profile")->row_array();
                                        ?>
                                        <li>
                                            <a href="<?= site_url('/admin/settings'); ?>">
                                                <i class="icon-settings"></i> Settings
                                            </a>
                                        </li>
                                    <?php }
                                    ?>
                                    <!--                                    <li>
                                                                            <a href="#">
                                                                                <i class="icon-directions"></i> Help
                                                                            </a>
                                                                        </li>-->
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="<?php echo site_url('logout'); ?>">
                                            <i class="icon-logout"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- end manage user dropdown -->



                        </ul>

                    </div>

                </div>

            </div>

            <!-- end header -->

            <!-- start color quick setting -->

            <div class="quick-setting-main">

                <button class="control-sidebar-btn btn" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></button>



            </div>

            <!-- end color quick setting -->

            <!-- start page container -->

            <div class="page-container">