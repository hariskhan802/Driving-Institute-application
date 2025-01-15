<div class="page-content-wrapper">
    <div class="page-content" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-10">
                        <div class="page-title">Staff Management | Absense</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <script>
                function doAjax(id) {
                    $.ajax({
                        type: 'post',
                        url: "<?php echo site_url('/admin/staff-management/get-absense'); ?>",
                        dataType: 'json',
                        data: {staff_id: id},
                        success: function (res) {
                            if (res.length != 0) {
                                for (var i = 0; i < res.length; i++) {
                                    $(".staff_absense_" + id).append(res[i]);
                                }
                            }
                        }
                    });
                }
                $(document).ready(function () {
                    $(".card-body").on('click', '.getAbsense', function () {
                        var equal = $(this).parents(".squarebox").index() - 1;
                        var id = $(this).attr('data-id');
                        $.ajax({
                            type: 'post',
                            url: "<?php echo site_url("/staff_management/get_staff_absense"); ?>",
                            dataType: 'json',
                            data: {staff_id: id},
                            success: function (res) {
                                $("#pop_up2").modal('show');
                                $("#pop_up2").find("#pop_staff_id").val(res[equal].staff_id);
                                $("#pop_up2").find('input[name="startDate"]').val(res[equal].startDate);
                                $("#pop_up2").find('input[name="endDate"]').val(res[equal].endDate);
                                $("#pop_up2").find('textarea[name="reason"]').val(res[equal].reason);
                            }
                        });
                    });
                    $("#edit_absense").on('click', function (e) {
                        e.preventDefault();
                        var staff_id = $('#pop_up2 #pop_staff_id').val();
                        var startDate = $('#pop_up2 input[name="startDate"]').val();
                        var endDate = $('#pop_up2 input[name="endDate"]').val();
                        var reason = $('#pop_up2 textarea[name="reason"]').val();
//                        var documentsImage = $('#pop_up2 input[name="documentsImage"]').val();
                        if (startDate == "") {
                            alert("StartDate field is required");
                        } else if (endDate == "") {
                            alert("EndDate field is required");
                        } else if (reason == "") {
                            alert("Reason field is required");
                        } else {
                            $.ajax({
                                type: 'post',
                                url: "<?= site_url('/staff_management/edit_absense') ?>",
                                data: {staff_id: staff_id, startDate: startDate, endDate: endDate, reason: reason}, //, documentsImage: documentsImage
                                beforeSend: function () {
                                    $(".staff_absense_" + staff_id).html("");
                                },
                                success: function (res) {
                                    doAjax(staff_id);
                                }
                            });
                        }
                    });
                })
            </script>
            <div class="col-sm-12">
                <div class="card-box">

                    <div class="card-body ">
                        <table class="mdl-data-table ml-table-striped ml-table-bordered mdl-js-data-table mdl-data-table--selectable is-upgraded" data-upgraded=",MaterialDataTable">
                            <thead>
                                <tr>
                                    <!--<th><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select mdl-js-ripple-effect--ignore-events is-upgraded" data-upgraded=",MaterialCheckbox,MaterialRipple"><input type="checkbox" class="mdl-checkbox__input"><span class="mdl-checkbox__focus-helper"></span><span class="mdl-checkbox__box-outline"><span class="mdl-checkbox__tick-outline"></span></span><span class="mdl-checkbox__ripple-container mdl-js-ripple-effect mdl-ripple--center" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></label></th>-->
                                    <th class="mdl-data-table__cell--non-numeric">IMAGE</th>
                                    <th class="mdl-data-table__cell--non-numeric">STAFF FULL NAME</th>
                                    <th class="mdl-data-table__cell--non-numeric">Absense</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($staffs)):
                                    foreach ($staffs as $staff):
                                        ?>
                                        <tr>
                                            <!--<td><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select mdl-js-ripple-effect--ignore-events is-upgraded" data-upgraded=",MaterialCheckbox,MaterialRipple"><input type="checkbox" class="mdl-checkbox__input"><span class="mdl-checkbox__focus-helper"></span><span class="mdl-checkbox__box-outline"><span class="mdl-checkbox__tick-outline"></span></span><span class="mdl-checkbox__ripple-container mdl-js-ripple-effect mdl-ripple--center" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></label></td>-->
                                            <td class="patient-img sorting_1">
                                                <img src="<?php echo site_url("/assets/uploads/" . $staff->pro_pic); ?>" alt="">
                                            </td>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $staff->first_name . " " . $staff->middle . " " . $staff->last_name ?></td>
                                            <td class="staff_absense_<?php echo $staff->id; ?>">
                                                <script>
                                                    doAjax("<?php echo $staff->id; ?>");
                                                </script>
                                            </td>
                                            <td>
                                                <a data-toggle="modal" data-target="#pop_up" data-id="<?php echo $staff->id; ?>" class="view_absense" data-toggle="tooltip" title="Stats">
                                                    <i class="material-icons f-left">insert_chart</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--        <div class="row">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-circle btn-warning black">STAFF CHAT</button>
                    </div>	
                </div>	-->
        <!-- end chat sidebar -->
    </div>
    <!-- end footer -->
</div>
<div class="modal" tabindex="-1" role="dialog" id="pop_up">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Absense</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="pop_staff_id" value=""/>
                <label class="col-md-5">
                    Start Date
                    <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                        <input class="form-control input-height" name="startDate" size="16" placeholder="Start Date" type="text" value="" data-dtp="dtp_znDa3">
                    </div>
                </label>
                <label class="col-md-5">
                    End Date
                    <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                        <input class="form-control input-height" name="endDate" size="16" placeholder="End Date" type="text" value="" data-dtp="dtp_znDa3">
                    </div>
                </label>
                <label class="col-md-12">
                    Reason
                    <textarea class="col-md-12" name="reason"></textarea>
                </label>
                <label class="col-md-2">
                    Documents
                    <input type="file" name="userfile" id="multipleUpload"/> 
                </label>
                <div id="append_document" class="col-md-12">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="save_absense" class="btn btn-circle btn-warning"  data-dismiss="modal">Save changes</button>
                <button type="button" class="btn btn-circle btn-warning black" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="pop_up2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Absense</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="pop_staff_id" value=""/>
                <label class="col-md-5">
                    Start Date
                    <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                        <input class="form-control input-height" name="startDate" size="16" placeholder="Start Date" type="text" value="" data-dtp="dtp_znDa3">
                    </div>
                </label>
                <label class="col-md-5">
                    End Date
                    <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                        <input class="form-control input-height" name="endDate" size="16" placeholder="End Date" type="text" value="" data-dtp="dtp_znDa3">
                    </div>
                </label>
                <label class="col-md-6">
                    Reason
                    <textarea name="reason"></textarea>
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" id="edit_absense" class="btn btn-circle btn-warning"  data-dismiss="modal">Save changes</button>
                <button type="button" class="btn btn-circle btn-warning black" data-dismiss="modal">Close</button>
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
    .dtp {
        z-index: 9999999;
    }
    span.squarebox {
        background: #fbed22;
        padding: 11px;
        margin: 0 0 0 4px;
    }
    a.delete_absense {
        position: absolute;
        top: 1px;
        right: 16px;
    }
    .squarebox{
        position: relative;
    }
    a.delete_absense {
        position: absolute;
        top: -2px;
        right: 5px;
        font-size: 11px;
        COLOR: #000;
    }
</style>
<div id="myModal" class="modal delete-m fade in">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="icon-box">
                    <img src="<?php echo site_url('assets/images/delete.gif'); ?>"/>
                </div>              
                <h4 class="modal-title">Are you sure?</h4>
                <p>You want to delete these records.<br>This Process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="setUrl" value=""/>
                <button type="button" class="btn btn-info" id="redirect_delete">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".card-body").on('click', ".delete_absense", function (e) {
        e.preventDefault();
        var that = $(this);
        var id = $(this).attr('data-id');
        $("#myModal").modal("show");
        $("#setUrl").val(id);
    });
    $("#redirect_delete").on('click', function () {
        var id = $("#setUrl").val();
        var that = $(this);
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('/staff_management/delete_absense'); ?>",
            data: {absense_id: id},
            success: function (res) {
                 $("#myModal").modal("hide");
                 window.location.reload();
            }
        });
    });
</script>