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
    <div class="page-content" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-7">
                        <div class="page-title">Staff Management</div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-circle btn-warning" href="<?php echo site_url('/admin/staff-management/add-staff'); ?>">ADD STAFF
                        </a>
                    </div>
                    <div class="col-md-3">
                        <select id="filter_status" class="form-control">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">

                    <div class="card-body ">
                        <table class="mdl-data-table ml-table-striped ml-table-bordered mdl-js-data-table mdl-data-table--selectable is-upgraded" data-upgraded=",MaterialDataTable">
                            <thead>
                                <tr>
                                    <!--<th><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select mdl-js-ripple-effect--ignore-events is-upgraded" data-upgraded=",MaterialCheckbox,MaterialRipple"><input type="checkbox" class="mdl-checkbox__input"><span class="mdl-checkbox__focus-helper"></span><span class="mdl-checkbox__box-outline"><span class="mdl-checkbox__tick-outline"></span></span><span class="mdl-checkbox__ripple-container mdl-js-ripple-effect mdl-ripple--center" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></label></th>-->
                                    <th class="mdl-data-table__cell--non-numeric">IMAGE</th>
                                    <th class="mdl-data-table__cell--non-numeric">STAFF FULL NAME</th>
                                    <th class="mdl-data-table__cell--non-numeric">GENDER</th>
                                    <th>DESIGNATION</th>
                                    <th>CONTACT</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="_listing">
                                <?php
                                if (!empty($staffs)):
                                    foreach ($staffs as $staff):
                                        ?>
                                        <tr>
                                            <td class="patient-img sorting_1">
                                                <img src="<?php echo site_url("/assets/uploads/" . $staff->pro_pic); ?>" alt="">
                                            </td>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $staff->first_name . " " . $staff->middle . " " . $staff->last_name ?></td>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $staff->gender; ?></td>
                                            <td><?php echo $staff->designation; ?></td>
                                            <td><?php echo "(" . $staff->w_code . ")" . $staff->work_contact; ?></td>
                                            <td><?php echo ($staff->status == 1) ? '<a href="' . site_url('staff_management/change_record/?status=0&id=' . $staff->user_id) . '"><i class="material-icons">lock</i></a>' : '<a href="' . site_url('staff_management/change_record/?status=1&id=' . $staff->user_id) . '"><i class="material-icons">lock_open</i></a>'; ?></td>
                                            <td class="actions">

                                                <a href="<?php echo site_url("/admin/staff-management/staff/" . encrypt_decrypt('encrypt', $staff->staff_id)); ?>" class="" data-toggle="tooltip" title="Info">
                                                    <i class="material-icons f-left">info</i>
                                                </a>
                                                <a href="<?php echo site_url("/admin/staff-management/edit-staff/" . encrypt_decrypt('encrypt', $staff->staff_id)); ?>" class="" data-toggle="tooltip" title="Info">
                                                    <i class="material-icons f-left">edit</i>
                                                </a>
                                                <a href="#myModal" data-url="<?php echo site_url('/admin/staff-management/delete-staff/' . encrypt_decrypt('encrypt', $staff->id)) ?>" data-toggle="modal" class="delete_me" title="Delete">
                                                    <i class="material-icons f-left">delete</i>
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
        <!-- <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-circle btn-warning black">STAFF CHAT</button>
            </div>	
        </div> -->	
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
                <label class="col-md-5">
                    Start Date
                    <input type="text" id="date" name="startDate" value="" class="form-control"/> 
                </label>
                <label class="col-md-5">
                    End Date
                    <input type="text" id="date2" name="endDate" value="" class="form-control"/> 
                </label>
                <label class="col-md-6">
                    Reason
                    <input type="text" name="reason" value="" class="form-control"/> 
                </label>
                <label class="col-md-2">
                    Documents
                    <input type="file" name="userfile" id="multipleUpload"/> 
                </label>
                <div id="append_document" class="col-md-12">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  data-dismiss="modal">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
<script>
    $(document).ready(function () {
        $(".delete_me").on('click', function () {
            var url = $(this).attr("data-url");
            var redirectURL = $("#setUrl").val(url);
        });

        $("#redirect_delete").on('click', function () {
            var url = $("#setUrl").val();
            window.location.href = url;
        });

        $("#filter_status").on('change', function () {
            var status = $(this).val();
            $.ajax({
                type: 'post',
                url: "<?= site_url('/staff_management/filter_status'); ?>",
                data: {status: status},
                beforeSend: function () {
                    $("#_listing").html("");
                },
                success: function (res) {
                    $("#_listing").html(res);
                }
            })
        });
    });
</script>