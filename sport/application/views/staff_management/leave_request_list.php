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
                    <div class="col-md-10">
                        <div class="page-title">Leave Requests</div>
                    </div>
                </div>

            </div>
        </div>




        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">

                    <div class="card-body ">
                        <table class="mdl-data-table ml-table-striped ml-table-bordered mdl-js-data-table  is-upgraded" data-upgraded=",MaterialDataTable">
                            <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>STAFF FULL NAME</th>
                                    <th>GENDER</th>
                                    <th>AVAILABLE</th>
                                    <th>BALANCE</th>
                                    <th>LEAVE REQUESTS</th>
                                    <th>STATUS</th>
                                    <th>VIEW FORM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($leave_applications)) {
                                    foreach ($leave_applications as $leave) {
                                        ?>
                                        <tr>
                                            <td class="patient-img sorting_1">
                                                <img src="<?php echo site_url('/assets/uploads/' . $leave['pro_pic']) ?>" alt="">
                                            </td>
                                            <td><?php echo $leave['first_name'] . " " . $leave['middle'] . " " . $leave['last_name']; ?></td>
                                            <td><?php echo $leave['gender']; ?></td>
                                            <td><?php echo $leave['annual_leave']; ?></td>
                                            <td>
                                                <?php
                                                $date1 = date('Y-m-d', strtotime($leave['date_leave_from']));
                                                $date2 = date('Y-m-d', strtotime($leave['date_leave_to']));
                                                $start = strtotime($date1);
                                                $end = strtotime($date2);
                                                echo $days_between = ceil(abs($end - $start) / 86400);
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('/admin/staff-management/change-status/' . $leave['leave_id'] . "/?status=0") ?>" data-toggle="tooltip" title="No" class="<?= ($leave['leave_status']==0)?'active':''?>">
                                                    <i class="material-icons f-left">close</i>
                                                </a>
                                                <a href="<?php echo site_url('/admin/staff-management/change-status/' . $leave['leave_id'] . "/?status=1") ?>" class="<?= ($leave['leave_status']==1)?'active':''?>" data-toggle="tooltip" title="Yes">
                                                    <i class="material-icons f-left">check</i></a>
                                            </td>
                                            <td>
                                                <?php
                                                if ($leave['leave_status'] == "1") {
                                                    echo '<span class="label label-success">Approved</span>';
                                                    
                                                } else {
                                                    echo '<span class="label label-warning ">Not Approved</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('/admin/staff-management/view-leave-request/' . $leave['leave_id']); ?>" data-toggle="tooltip" title="No">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-circle btn-warning black">Save &amp; Update</button>
            </div>	
        </div>	

        <!-- end chat sidebar -->
    </div>
    <!-- end page container -->
</div>