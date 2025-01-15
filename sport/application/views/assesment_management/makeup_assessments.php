<div class="page-content-wrapper">
    <div class="page-content" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-3">
                        <div class="page-title">MAKEUP SESSION MANAGEMENT</div>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo site_url('/admin/assessment-management/add-makeup-assessment') ?>" class="btn btn-circle btn-warning">ADD MAKEUP SESSIONS</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-box">

            <div class="card-body " id="bar-parent5">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Term</label>
                        <select class="form-control" id="terms">
                            <?php echo print_dropdown($terms); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Venue</label>
                        <select class="form-control"id="venues">
                            <?php echo print_dropdown($venues); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Club</label>
                        <select class="form-control" id="clubs">
                            <?php echo print_dropdown($clubs); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Day</label>
                        <select class="form-control" id="days">
                            <?php echo print_dropdown($days); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <button class="btn btn-circle btn-warning" type="button" id="search_filter">Search Filter</button>
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
                                    <th>VENUE</th>
                                    <th>CLUB</th>
                                    <th>TERMS</th>
                                    <th>DAYS</th>
                                    <th>TIME</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="_listings">
                                <?php
                                if (!empty($assessments)) {
                                    foreach ($assessments as $assessment) {
                                        $assessment_id = $assessment['id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $assessment['venue_name']; ?></td>
                                            <td><?php echo $assessment['club_name']; ?></td>
                                            <td><?php echo $assessment['term_name']; ?></td>
                                            <td><?php echo $assessment['program_name']; ?></td>
                                            <td><?php echo $assessment['start_time'] . "-" . $assessment['end_time']; ?></td>
                                            <td>
                                                <a href="<?php print_url('/admin/assessment-management/edit_makeup_assessment/' . encrypt_decrypt('encrypt', $assessment_id)); ?>">
                                                    <i class="material-icons f-left">edit</i>
                                                </a>
                                                <a href="#myModal" class="delete_me" data-url="<?php print_url('/admin/assessment-management/delete_makeup_assessment/' . encrypt_decrypt('encrypt', $assessment_id)); ?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
                                                    <i class="material-icons f-left">delete</i>
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
    </div>
    <!-- end chat sidebar -->
</div>
<!-- end page container -->
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
    $(document).ready(function () {
        $(".delete_me").on('click', function () {
            var url = $(this).attr("data-url");
            var redirectURL = $("#setUrl").val(url);
        });

        $("#redirect_delete").on('click', function () {
            var url = $("#setUrl").val();
            window.location.href = url;
        });

        $("#search_filter").on('click', function () {
            var terms_id = $("#terms").val();
            var clubs_id = $("#clubs").val();
            var venues_id = $("#venues").val();
            var day = $("#days").find("option:selected").text();
            if (day == "Select Day") {
                day = '';
            }
            $.ajax({
                type: 'post',
                url: "<?= site_url("/admin/assessment-management/filter_assessment_makeup"); ?>",
                data: {term_id: terms_id, club_id: clubs_id, venue_id: venues_id, day: day},
                beforeSend: function () {
                    $("#_listings").html("");
                },
                success: function (res) {
                    $("#_listings").html(res);
                }
            })
        });
    });
</script>
</div>