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

        <link href="<?php echo ASSETS; ?>css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
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
        <!-- favicon -->
        <link rel="shortcut icon" href="http://mysportsacademydubai.com/wp-content/uploads/2016/08/cropped-ico-180x180.png" />
        <script src="<?php echo ASSETS; ?>plugins/jquery/jquery.min.js"></script>

    </head>
    <!-- END HEAD -->
    <body class="login-page">

        <div class="col-md-4 col-centered margin-top-70">

            <form class="form-horizontal form-material" method="post" id="loginform" action="<?php echo site_url('/recover-password/') ?>">
                <div class="col-centered logo-a margin-bottom-20 text-center">
                    <img src="<?php echo site_url('assets/images/HUB-final-logo.png'); ?>"/>
                </div>
                <div class="form-ar">
                    <h3 class="box-title m-b-20">Forgot Password</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <label>Enter Email Address</label>
                            <input class="form-control" type="email" name="email" required="" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-circle btn-warning btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Send</button>
                        </div>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-md-12 text-center">
                        <?php
                        $message = $this->session->flashdata("message");
                        if (!empty($message)) {
                            ?>
                            <div class="alert alert-danger in alert-dismissible col-md-12 col-centered r-m">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                <strong>Error!</strong> <?php echo $message; ?>
                            </div>
                        <?php } ?>
                        <?php
                        $message = $this->session->flashdata("messages");
                        if (!empty($message)) {
                            ?>
                            <div class="alert alert-success in alert-dismissible col-md-12 col-centered r-m">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                <strong>Success!</strong> <?php echo $message; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>

        <style>
            .r-m{
                margin:0px !important;
            }
            .r-p{
                padding:0px !important;
            }
            .r-p-m{
                margin:0px !important;
                padding:0px !important;
            }
            .col-centered{
                float: none;
                margin: 0 auto;
                margin-top: 100px;
            }
            body{
                background:#FBED22 !important;
            }
            .margin-bottom-20{
                margin-bottom: 20px;
            }
            input[name="email"],input[name="password"]{
                padding:7px !important;
            }
        </style>
        <script src="<?php echo ASSETS; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>