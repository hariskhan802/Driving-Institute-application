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
    <div class="page-content add-form company-overview-form" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Company Overview</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">

                    <div class="card-body" id="bar-parent">
                        <form action="<?php echo site_url('/admin/company-overview/save-overview/') ?>" method="post" enctype="multipart/form-data" class="form-horizontal" novalidate="novalidate">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Address
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="address" placeholder="Enter Address" value="<?php echo $overview['address']; ?>" class="form-control input-height">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Phone Number
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <select name="code" class="form-control">
                                                    <option value="+971">+971</option>
                                                    <option value="+91">+91</option>
                                                    <option value="+92">+92</option>
                                                </select>
                                                <input type="text" name="phone" placeholder="Enter phone number" value="<?php echo $overview['phone']; ?>" class="form-control input-height">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Email Address
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="email" name="email" placeholder="Enter Email Address" value="<?php echo $overview['email']; ?>" class="form-control input-height">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Trade Liscence Number
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" name="trade" value="<?php echo $overview['license']; ?>" placeholder="Enter Trade Liscence Number
                                                       " class="form-control input-height"> </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-4"> Trade Liscence Expiry
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input3" data-link-format="dd-mm-yyyy">

                                                        <input class="form-control input-height" id="expiry" name="expiry" placeholder="Trade Liscence Expiry" type="text" value="<?php echo $overview['expiry']; ?>" data-dtp="dtp_gmx1i">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4"> Office Address
                                            </label>
                                            <div class="col-md-4">
                                                <div class="input-group">

                                                    <input type="text" value="<?php echo $overview['off_add']; ?>" class="form-control input-height" name="off_address" placeholder="Office Address"> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row policy">

                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="control-label col-md-12"> Policy Name
                                            </label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-height" name="Policy" placeholder="Enter Policy Name"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="control-label col-md-12"> Policy Number
                                            </label>
                                            <div class="col-md-12">
                                                <div class="input-group">

                                                    <input type="text" class="form-control input-height" name="policy_num" placeholder="Enter Policy Number"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="control-label col-md-12"> Expiry Date
                                            </label>
                                            <div class="col-md-12">
                                                <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input3" data-link-format="dd-mm-yyyy">
                                                    <input class="form-control input-height" id="expiry" name="policy_date" placeholder="Policy Expiry" type="text" value="" data-dtp="dtp_gmx1i">

                                                </div>
                                                <input type="hidden" id="dtp_input2" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="add_policy" class="btn btn-circle btn-warning">Add</button>
                                    </div>


                                </div>
                                <div class="row">
                                    <div id="append_policy">
                                        <?php
                                        if (!empty($policies)) {
                                            foreach ($policies as $policie) {
                                                ?>
                                                <div class="round_box">
                                                    <div class="col-lg-6">
                                                        <span class="mdl-chip mdl-chip--deletable">
                                                            <span class="mdl-chip__text"><span class="time"><?php echo $policie['policy_name']; ?> |
                                                                    <input type="hidden" name="Policies[]" value="<?php echo $policie['policy_name']; ?>"/> 
                                                                    <?php echo $policie['policy_number']; ?> |
                                                                    <input type="hidden" name="policy_nums[]" value="<?php echo $policie['policy_number']; ?>"/>
                                                                    <?php echo $policie['expiry_date']; ?>
                                                                    <input type="hidden" name="policy_dates[]" value="<?php echo $policie['expiry_date']; ?>"/>
                                                                </span>
                                                            </span>
                                                            <button type="button" class="mdl-chip__action closeme">
                                                                <i class="material-icons">cancel</i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <hr>
                                <div class="row document">
                                    <h3 class="col-md-12" style="background: yellow; color: #000; padding:5px 10px;">DOCUMENTS</h3>
                                    <div class="form-group row">
                                        <div class="compose-editor">
                                            <input type="file" class="default" name="multi" id="upload_multi_file" multiple="">
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="multiple_images">
                                        <?php
                                        if (!empty($documents)) {
                                            foreach ($documents as $document) {
                                                ?>
                                                <span class='thumb'>
                                                    <a class='remove_me' href='<?php echo site_url('/company_overview/delete/?id=' . $document['id']); ?>'>x</a>
                                                    <?php echo $document['image_name']; ?>
                                                </span>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-circle btn-warning">Save</button>
                                            <button type="button" class="btn btn-circle btn-warning black">Cancel</button>
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

<script>
    $(document).ready(function () {
        $("#add_policy").on('click', function (e) {
            e.preventDefault();
            var Policy = $('input[name="Policy"]').val();
            var policy_num = $('input[name="policy_num"]').val();
            var policy_date = $('input[name="policy_date"]').val();
            var inputs = $(this).parents(".policy").find("input[type='text']");
            var isValid = true;
            $.each(inputs, function () {
                var currentInput = $(this).val();
                if (currentInput == "") {
                    alert($(this).attr("name") + " required");
                    isValid = false;
                }

            });
            if (isValid) {
                var elemn = '<div class="round_box">\n\
                            <div class="col-lg-6">\n\
                            <span class="mdl-chip mdl-chip--deletable">\n\
                            <span class="mdl-chip__text"><span class="time">' + Policy +
                        ' <input type="hidden" name="Policies[]" value="' + Policy + '"/> | ' +
                        policy_num
                        + '<input type="hidden" name="policy_nums[]" value="' + policy_num + '"/>\n\
                            | ' + policy_date +
                        '<input type="hidden" name="policy_dates[]" value="' + policy_date + '"/>\n\
                            </span>\n\
                            </span>\n\
                            <button type="button" class="mdl-chip__action closeme">\n\
                            <i class="material-icons">cancel</i>\n\
                            </button>\n\
                            </span>\n\
                            </div>\n\
                            </div>';
                $("#append_policy").append(elemn);
                $(this).parents(".policy").find("input").val("");
            }
        });
        function preview(input, fileName) {
            if (input.files && input.files[0]) {
                $(input.files).each(function () {
                    var reader = new FileReader();
                    reader.readAsDataURL(this);
                    reader.onload = function (e) { //<a class='remove_me' href='#'>x</a>
                        $(".multiple_images").append("<span class='thumb'><a class='remove_me' href='#'>x</a><input type='hidden' value='" + fileName + "' name='image_name[]'/>" + fileName + "<input type='hidden' name='upload_multiples[]' value='" + e.target.result + "'/></span>");
                    }
                });
            }
        }
        $("#upload_multi_file").on('change', function (e) {
            var fileName = e.target.files[0].name;
            var file = document.querySelector('#upload_multi_file');
            preview(file, fileName);
        });
        $(".row").on('click', '.remove_me', function () {
            $(this).parents(".thumb").remove();
        });
    });
</script>

<style>
    .round_box {
        float: left;
    }
    a.remove_me {
        position: absolute;
        right: 8px;
    }
    span.thumb {
        background: #ddd;
        padding: 9px;
        position: relative;
        min-width: 148px;
        display: block;
        float: left;
        margin:0 0 0 10px; 
    }
    .company-overview-form .multiple_images span.thumb{height:auto !important;}
</style>