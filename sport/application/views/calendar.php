<div class="page-content-wrapper">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script> -->
    <script src="<?php echo ASSETS ?>js/jquery-ui.js"></script>
    <div class="page-content" style="min-height:546px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">CALENDAR MANAGEMENT</div>
                </div>

            </div>
        </div>
        <div class="card card-box">

            <div class="card-body " id="bar-parent5">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Term</label>
                        <select class="form-control" id="term_id">
                            <?php print_dropdown($terms); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Club</label>
                        <select class="form-control"  id="club_id">
                            <?php print_dropdown($clubs); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Programme</label>
                        <select class="form-control" id="program_id">
                            <?php print_dropdown($programs); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Venue</label>
                        <select class="form-control" id="venue_id">
                            <?php print_dropdown($venues); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Day</label>
                        <select class="form-control" id="day_id">
                            <?php print_dropdown($days); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Staff</label>
                        <select class="form-control" id="staff_ajax">
                            <option value="">Assign Staff</option>
                            <?php
                            if (!empty($staffs)) {
                                foreach ($staffs as $staff) {
                                    ?>
                                    <option value="<?php echo $staff['id']; ?>"><?php echo $staff['username']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <button class="btn btn-circle btn-warning" type="button" id="search_filter">Search Filter</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Calendar Managment (students)</header>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo site_url('/admin/calendar-management/save-calendar'); ?>" method="post">
                            <div class="panel-body" id="bodys">
                                <?php
                                $data['staffs'] = $this->admin_manager->SelectAllQuery("SELECT u.* FROM users u INNER JOIN `staff` s ON u.`id`=s.`staff_id`", 'ARRAY');
                                $CI = get_instance();
                                $counts = 0;
                                
                                foreach ($all_days as $key => $day) {
                                    $askey = $key;
                                    $sessions = $CI->get_timetable($day['id']);
                                    ?>
                                    <div class="day-row row">
                                <div class="head-title">
                                    <h3 class="pull-left">DAYS/TIME</h3>
                                    <h3 class="pull-right">REASSIGN STAFF</h3>
                                </div>
                                <div class="day-title"><h2><?php echo "Sunday"; ?></h2></div>
                                <?php
                                if (!empty($session_meta)) {
                                    foreach ($session_meta as $key => $childs) {
                                        ?>
                                        <div class="hours row">
                                            <div class="col-md-3 col-sm-3"><div class="hour"><?= $childs['start_time'] . " - " . $childs['end_time']; ?></div></div>
                                            <div class="col-md-7 col-sm-7">
                                                <div class="students clear clearfix">
                                                    <div class="child" data-set=""><?= $childs['child_name']; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <select class="form-control">
                                                    <option>Select Coach</option>
                                                    <?php
                                                    foreach ($staffs as $staff) {
                                                        ?>
                                                        <option value="<?php echo $staff['id'] ?>" <?php echo ($childs['username'] == $staff['username']) ? "selected=''" : ""; ?>><?php echo $staff['username']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                                    <script>
                                        $(".childz_<?php echo $day['id']; ?>").draggable({
                                            revert: true,
                                            revertDuration: 50,
                                            containment: ".jamboo"
                                        });
                                        $(".child").droppable({
                                            drop: function (event, ui) {
                                                $(this).append($(ui.draggable));
                                                var checkMeta = $(this).parents(".repeator").attr("data-meta_id");
                                                $(this).find(".childs").attr('name', 'childs[<?= $hasKey ?>][][' + checkMeta + ']');
                                            }
                                        });
                                    </script>
                                    <?php
                                    $counts++;
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-circle btn-warning Warning">SAVE</button>
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
    .students {
        min-height: 46px;
    }
    .child{
        cursor: pointer;
    }
    .child {
        cursor: pointer;
        font-size: 12px;
        height: 40px;
        min-width: 66px;
        margin: 0 0 4px 6px;
    }
    .child_span{
        display: block;
    }
</style>


<script>
    $(document).ready(function () {
        $("#search_filter").on('click', function () {
            var day_id = $(this).val();
            var term_id = $("#term_id").val();
            var club_id = $("#club_id").val();
            var program_id = $("#program_id").val();
            var venue_id = $("#venue_id").val();
            var session_id = '<?= $session_id; ?>';

            $.ajax({
                type: 'post',
                url: "<?php echo site_url("/admin/calendar-management/calendar-ajax"); ?>",
                data: {
                    day_id: day_id,
                    club_id: club_id,
                    venue_id: venue_id,
                    program_id: program_id,
                    term_id: term_id,
                    session_id: session_id
                },
                beforeSend: function () {
                    $("#bodys").html("");
                },
                success: function (res) {
                    $("#bodys").html(res);
                }
            });
        });
    });
</script>