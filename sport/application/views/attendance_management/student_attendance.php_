<div class="page-content-wrapper">
    <div class="page-content" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-9">
                        <div class="page-title">ATTENDANCE MANAGEMENT</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <table class="mdl-data-table ml-table-striped ml-table-bordered  mdl-data-table--selectable is-upgraded">
                            <thead>
                                <tr>
                                    <th>CHILD NAME</th>
                                    <th>COACH NAME</th>
                                    <th>TERM</th>
                                    <th>VENUE</th>
                                    <th>CLUB</th>
                                    <th>PROGRAMME</th>
                                    <th>LEVEL</th>
                                    <th>DAY</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($attendances)) {
                                    foreach ($attendances as $attendance) {
                                        ?>
                                        <tr>
                                            <td><?php echo $attendance['child_name']; ?></td>
                                            <td><?php echo $attendance['coach_name']; ?></td>
                                            <td><?php echo $attendance['term_name']; ?></td>
                                            <td><?php echo $attendance['venue_name']; ?></td>
                                            <td><?php echo $attendance['club_name']; ?></td>
                                            <td><?php echo $attendance['program_name']; ?></td>
                                            <td><?php echo $attendance['level_name']; ?></td>
                                            <td><?php echo $attendance['day_name']; ?></td>
                                            <td><a href="#" class="attendance_manage" data-attendance_id="<?php echo $attendance['id']; ?>" title="Manage" class="pull-left"><i class="material-icons">layers</i></a></td>
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
        <!-- end chat sidebar -->
    </div>
</div>
<div class="modal fade" id="attendance_dialog" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pull-left text-left">Student Attedance</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post">

                <div class="modal-body" id="attendance_body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="attend_id" name="attend_id" value=""/>
                    <button type="button" class="btn btn-success" id="update_attendance">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <div id="updated_res"><div>
                        </form>
                    </div>
                </div>
        </div>
        <script>
            $(".attendance_manage").on("click", function () {
                var attendance_id = $(this).attr("data-attendance_id");
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url("/admin/attendance-management/manage-attendance"); ?>",
                    data: {
                        id: attendance_id
                    },
                    success: function (res) {
                        $("#attendance_dialog").modal('show');
                        $("#attendance_dialog").find("#attend_id").val(attendance_id);
                        $("#attendance_dialog").find("#attendance_body").html(res);
                    }
                });

            });
            $("#attendance_dialog").on('click', ".yellow_box", function () {

                $(this).parents("#attendance_dialog").find(".yellow_box").removeClass("active_box");

                $(this).addClass("active_box");

                var text_date = $(this).text();

                $(this).parents("#attendance_dialog").find("#select_date").val(text_date);

            });
            $("#update_attendance").on('click', function () {
                var term_id = $("#term_id").val();
                var club_id = $("#club_id").val();
                var venue_id = $("#venue_id").val();
                var program_id = $("#program_id").val();
                var level_id = $("#level_id").val();
                var coach_id = $("#coach_id").val();
                var child_id = $("#child_id").val();
                var day_id = $("#day_id").val();
                var select_date = $("#select_date").val();
                var attend_id = $("#attend_id").val();
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/attendance-management/update-attendance'); ?>",
                    data: {attend_id: attend_id, select_date: select_date, term_id: term_id, club_id: club_id, venue_id: venue_id, program_id: program_id, level_id: level_id, coach_id: coach_id, child_id: child_id, day_id: day_id},
                    success: function (res) {
                        $("#updated_res").html(res);
                    }
                });
            });
        </script>
        <style>
            .clear,.clearfix{
                clear:both;
            }
            a.yellow_box {
                font-size: 12px;
                display: inline-block;
                padding: 5px;
                background: yellow;
                color: #000;
                margin: 2px;
            }
            .active_box {
                background: black !important;
                color: yellow !important;
            }
        </style>