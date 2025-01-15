<div class="page-content-wrapper">
    <div class="page-content" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Leave Request Staff</div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-body" id="bar-parent">
                        <?php //d($staffs['first_name']); ?>
                        <form action="<?php echo site_url('/admin/staff-management/save-leave') ?>" id="form_sample_1" method="post" class="form-horizontal leave-app">
                            <?php
                            $message = $this->session->flashdata('message');
                            if (!empty($message)) {
                                ?>
                                <div class="alert alert-success in alert-dismissible" style="margin-top:18px;">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    <strong>Success!</strong> <?php echo $message; ?>
                                </div>
                            <?php } ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>"/>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Full Name
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" name="firstname" required="" placeholder="enter first name" class="form-control input-height">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Select Date
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                                    <input class="form-control input-height" required="" size="16" placeholder="Select Date" name="select_date" type="text" value="">
                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                </div>
                                                <!--<input type="hidden" id="dtp_input2" value="">-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Joining Date
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                                    <input class="form-control input-height" size="16" required="" placeholder="Joining Date" type="text" value="" name="joining_date">
                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                </div>
                                                <!--<input type="hidden" id="dtp_input2" value="">-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Leave Category Request 
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control input-height" required="" name="department">
                                                    <option value="">Select...</option>
                                                    <option value="paid leave">Paid Leave </option>
                                                    <option value="unpaid leave">Unpaid Leave</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Reason for Leave 
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <select class="form-control input-height" required="" name="reason">
                                                    <option value="">Select...</option>
                                                    <option value="vacation / annual leave">Vacation / Annual Leave </option>
                                                    <option value="emergency leave">Emergency Leave </option>
                                                    <option value="sick leave">Sick Leave </option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4">Total Leave Days
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" required="" name="total_leave_days" placeholder="Total Leave Days" class="form-control input-height">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                                    <input class="form-control input-height" required="" name="leave_date_from" size="16" placeholder="Date of Leave From" type="text" value="">
                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                </div>
                                                <input type="hidden" id="dtp_input2" value="">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                                    <input class="form-control input-height" size="16" name="leave_date_to" placeholder="Date of Leave To" type="text" value="">
                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                </div>
                                                <!--<input type="hidden" id="dtp_input2" value="">-->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-12">If requiring cover please state the details below: Sessions – Date/Venue/Sport/Level/ Person Covering

                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-12">
                                                <textarea name="person_covering" required="" placeholder="Enter Details" class="form-control-textarea" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-12">Address/Tel No. During Leave


                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-12">
                                                <textarea name="extra_info" required="" placeholder="Enter Details" class="form-control-textarea" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 style="background: yellow; color: #000; padding:5px 10px;">UPLOAD DOCUMENTS</h3>
                                        <div class="form-group row">
                                            <div class="compose-editor">
                                                <input type="file" id="multipleUpload" class="default">
                                            </div>
                                        </div>
                                        <div id="append_document" class="col-md-12">

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div style="background: yellow; padding:10px; color: #000;">
                                            <div class="form-group row">
                                                <label class="control-label col-md-6">I hereby agree and confirm to resume duty on 

                                                </label>
                                                <div class="col-md-4">
                                                    <div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                                        <input class="form-control input-height" required="" name="resume_date" size="16" placeholder="Select Date" type="text" value="">
                                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                    </div>
                                                    <input type="hidden" id="dtp_input2" value="">
                                                </div>
                                                <label class="control-label col-md-8 offset-md-2">I would accept an action that may be initiated by the Company if I fail to report on the said date/s. 

                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <section class="signature-component">
                                                    <label>Staff Sign</label>
                                                    <input type="text" class="form-control" name="staff_sign" value="<?= $staffs['first_name'] . " " . $staffs['last_name'] ?>"/>
                                                </section>

                                            </div>
                                            <div class="col-md-6">

                                                <section class="signature-component">
                                                    <label>Management Sign</label>
                                                    <input type="text" class="form-control" name="mangement_sign" readonly="" value="My Sports Academy"/>
                                                </section>
                                            </div>
                                        </div>	

                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-circle btn-warning">Submit Request</button>
                                            <a href="<?php echo site_url('/admin/staff-management') ?>" class="btn btn-circle btn-warning black">Back</a>
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
<style>
    .clearfix,.clear{
        clear:both;
    }
    .appenddocument {
        padding: 6px 10px 6px 16px;
        background: #f3f1f1;
        width: 100%;
        margin: 3px 0 3px 0;
        position: relative;
    }
    a.closemyself {
        position: absolute;
        right: 7px;
    }
</style>