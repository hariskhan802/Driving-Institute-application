<div class="page-content-wrapper program-creation">
    <div class="page-content" style="min-height:596px">
        <form action="<?php echo site_url('admin/program-management/update-program'); ?>" method="POST" enctype="multipart/form-data">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="page-title">EDIT PROGRAM</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $msg = $this->session->flashdata("msg");
            if (!empty($msg)):
                ?>
                <script>
                    swal("Updated!", "success");
                </script>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Programme Name</label>
                                    <input type="hidden" name="program_id" value="<?php echo $program['id']; ?>"/>
                                    <input type="text" name="program_name" required="" value="<?php echo $program['program_name']; ?>" class="form-control" placeholder="Enter Program Name">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Select Club</label>
                                    <select class="form-control" name="club" required="">
                                        <option>Select Club</option>
                                        <option value="1" data-name="swim" <?php echo ($program['club_id'] == "1") ? "selected=''" : ""; ?>>My Swim Club</option>
                                        <option value="2" data-name="football" <?php echo ($program['club_id'] == "2") ? "selected=''" : ""; ?>>My Football Club</option>
                                        <option value="5" data-name="tri" <?php echo ($program['club_id'] == "5") ? "selected=''" : ""; ?>>My Tri Club</option>
                                        <option value="3" data-name="netball" <?php echo ($program['club_id'] == "3") ? "selected=''" : ""; ?>>My Netball Club</option>
                                        <option value="4" data-name="holiday" <?php echo ($program['club_id'] == "4") ? "selected=''" : ""; ?>>My Holiday Camp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="gap"></div>
                            <div class="row sfn" style="<?php echo ($program['club_id'] != '5' && $program['club_id'] != '4') ? "" : "display:none;" ?>">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Cost Per Session</label>
                                    <input type="text" name="cost_per_session" required="" value="<?php echo $program['cost_per_session'] ?>" class="form-control" placeholder="Enter Cost Per Session">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Annual Reg Fee</label>
                                    <input type="text" name="annual_reg_free" required="" value="<?php echo $program['annual_reg_fee'] ?>" class="form-control" placeholder="Enter Annual Reg Fee">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Competition Fee</label>
                                    <input type="text" name="competition_fee" required="" value="<?php echo $program['competition_fee'] ?>"  class="form-control" placeholder="Competition Fee">
                                </div>
                            </div>
                            <div class="row holiday_div" style="<?php echo ($program['club_id'] == '4') ? "" : "display:none;" ?>">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Full Week Cost</label>
                                    <input type="text" name="full_week_cost" required="" value="<?php echo $program['full_week_cost'] ?>" class="form-control" placeholder="Enter Full Week Cost">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Daily Cost</label>
                                    <input type="text" name="daily_cost" required="" value="<?php echo $program['daily_cost'] ?>" class="form-control" placeholder="Enter Daily Cost">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Exclusion per day cost</label>
                                    <input type="text" name="per_day_cost" required="" value="<?php echo $program['exclusion_per_day_cost'] ?>" class="form-control" placeholder="Exclusion per day cost">
                                </div>
                            </div>
                            <div class="tri_club" style="<?php echo ($program['club_id'] == '5') ? "" : "display:none;" ?>">
                                <div class="row">

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <label>Session Card Cost</label>
                                        <input type="text" name="session_card_cost" value="<?php echo $program['session_card_cost'] ?>" required="" class="form-control" placeholder="Enter 10 Session Card Cost">

                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <label>Annual Reg. Fee</label>
                                        <input type="text" name="annual_reg_free" required="" value="<?php echo $program['annual_reg_fee'] ?>" class="form-control" placeholder="Enter Annual Reg. Fee">

                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <label>Competition Fee</label>
                                        <input type="text" name="competition_fee" required="" class="form-control" placeholder="Competition Fee" value="<?php echo $program['competition_fee'] ?>">

                                    </div>

                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <label>No of session per week</label>
                                        <input type="number" id="num_session" min="0" required="" class="form-control" value="0" placeholder="No.Session p/wk">

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <label>Cost Per Session</label>
                                        <input type="number" id="cost_per_session" min="0"  required="" class="form-control" value="0" placeholder="Cost Per Session">

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <input type="button" id="add_session" class="btn btn-circle btn-warning" value="Add Session">
                                    </div>
                                </div>
                            </div>
                            <div class="row result-sessions">
                                <div class="col-md-12">
                                    <div id="add_sessions">
                                        <?php
                                        if (!empty($program_session)) {
                                            foreach ($program_session as $p_session) {
                                                ?>
                                                <div class="col-md-12 session_program"><a href="javascript:;" class="closeMe">X</a><div class="col-md-2 pull-left"><?php echo $p_session['num_of_sessions']; ?><input type="hidden" name="num_session[]" value="<?php echo $p_session['num_of_sessions']; ?>"/></div><div class="col-md-2 pull-left"><?php echo $p_session['cost_per_session']; ?><input type="hidden" name="cost_per_sessions[]" value="<?php echo $p_session['cost_per_session']; ?>"/></div></div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div></div>
                    <?php
                    if ($program['club_id'] != "4") {
                        ?>
                        <div class="card-box">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="heading"><h3>Add Level to the Program</h3></div>
                                    </div>
                                </div>
                                <div class="row levels">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <label>Level Name</label>
                                        <input type="text" class="form-control" id="level_name" placeholder="Enter Level Name">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <label>Capacity</label>
                                        <input type="text" class="form-control" placeholder="Enter Capacity" id="enter_capacity">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                        <label>Min.Age</label>
                                        <input type="text" class="form-control" placeholder="Min" id="min_age">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                        <label>Max.Age</label>
                                        <input type="text" class="form-control" placeholder="Max" id="max_age">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <label>Duration(in minutes)</label>
                                        <input type="text" class="form-control" placeholder="Duration(in minutes)" id="duration">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <label>Upload File</label>
                                        <div class="dz-default dz-message dropzone form-horizontal dz-clickable">
                                            <span>upload File</span>
                                            <input type="file" id="documents" class="dz-hidden-input" style="opacity: 0; position: absolute; top: 0px; left: 0px; height: 40px; width: auto;">
                                            <input type="hidden" id="document_name" name="document_name"/>
                                            <input type="hidden" id="document_url" name="document_url"/>
                                        </div>
                                        <span class="filename"></span>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                        <label>Color</label>
                                        <div id="maincolorPanel" class="input-group colorpicker-component col-md-8 colorpicker-element">
                                            <span class="input-group-addon"><i style="background-color: rgb(170, 51, 153);"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                        <button type="button" id="addrow" class="btn yellow btn-outline btn-circle m-b-10">ADD</button>
                                    </div>
                                </div>

                                <div class="append_list result-bar">
                                    <?php
                                    if (!empty($levels)) {
                                        foreach ($levels as $level) {
                                            ?>
                                            <div class="row_list" data-id="<?php echo $level['id']; ?>">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                                        <p><?php echo $level['level_name']; ?></p>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                                        <p><?php echo $level['capacity']; ?></p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                                        <p><?php echo $level['age_min']; ?></p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                                        <p><?php echo $level['age_max']; ?></p>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                                        <p><?php echo $level['duration']; ?> mins </p>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                                        <?php
                                                        if (!empty($level['file_path'])) {
                                                            ?>
                                                            <p><a href="<?= site_url('/assets/uploads/' . $level['file_path']); ?>" target="_blank">View Link</a></p>
                                                        <?php } else { ?>
                                                            <p>No File</p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                                        <div class="input-group colorpicker-component col-md-8 colorpicker-element" id="colorinput0">
                                                            <span class="input-group-addon"><i style="background-color:<?php echo $level['color']; ?>"></i>

                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                                        <a class="delete_level_ajax" data-toggle="tooltip" href="javascript:void(0)" data-id="<?php echo $level['id']; ?>" title="Delete"><i class="fa fa-remove icon-remove"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                            <a href="<?php echo site_url('/admin/program-management/'); ?>" class="btn btn-circle btn-warning black">BACK</a>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                            <button type="submit" class="btn btn-circle btn-warning ">SAVE PROGRAM</button>
                        </div>
                    </div>
                    </form>
                    <!-- end chat sidebar -->
                </div>
            </div>

            <script>
                $(document).ready(function () {
                    var club_name = "<?= $program['club_id']; ?>";
                    if (club_name == 5) {
                        $(".holiday_div").hide();
                        $(".holiday_div input").attr("required", false);
                        $(".holiday_div input").attr("disabled", true);
                        $(".holiday_div input").val('');
                        $(".sfn").hide();
                        $(".sfn input").removeAttr("required");
                        $(".sfn input").attr("disabled", true);
                        $(".sfn input").val("");
                    } else if (club_name == 4) {
                        $(".holiday_div").show();
                        $(".holiday_div input").attr("required", true);
                        $(".holiday_div input").removeAttr("disabled");
                        $(".sfn").hide();
                        $(".sfn input").removeAttr("required");
                        $(".sfn input").attr("disabled", true);
                        $(".sfn input").val('');
                        $(".tri_club").hide();
                        $(".tri_club input").removeAttr("required");
                        $(".tri_club input").attr("disabled", true);
                        $(".tri_club input").val('');
                    } else {
                        $(".holiday_div").hide();
                        $(".holiday_div input").attr("required", false);
                        $(".holiday_div input").attr("disabled", true);

                        $(".holiday_div input").val('');

                        $(".sfn input").attr("required", true);
                        $(".sfn input").removeAttr("disabled");
                        $(".sfn").show();

                        $(".tri_club").hide();
                        $(".tri_club input").removeAttr("required");
                        $(".tri_club input").attr("disabled", true);
                        $(".tri_club input").val('');
                    }

                    $(".delete_level_ajax").on('click', function (e) {
                        e.preventDefault();
                        $("#myModal").modal('show');
                        var id = $(this).attr('data-id');
                        $("#myModal").find("#level_id").val(id);
                    });
                    $("#redirect_delete").on('click', function () {
                        var deleID = $("#level_id").val();
                        $.ajax({
                            type: 'post',
                            url: "<?php echo site_url('/admin/program-management/delete-level/'); ?>",
                            data: {
                                id: deleID,
                            },
                            success: function (res) {
                                if (res == "1") {
                                    $(".row_list[data-id='" + deleID + "']").remove();
                                    $("#myModal").modal('hide');
                                }
                            }
                        });
                    })
                    $(".closeMe").on('click', function () {
                        $(this).parents(".session_program").remove();
                    });
                });
            </script>
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
                            <input type="hidden" id="level_id" value=""/>
                            <button type="button" class="btn btn-info" id="redirect_delete">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>