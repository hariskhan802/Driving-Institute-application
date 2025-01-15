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
                            <div class="panel-body jamboo" id="bodys">
                                <?php
                                    $data['staffs'] = $this->admin_manager->SelectAllQuery("SELECT u.* FROM users u INNER JOIN `staff` s ON u.`id`=s.`staff_id`", 'ARRAY');
                                    $CI = get_instance();
                                    $counts = 0;
                                    foreach ($all_days as $key => $day) {
                                        $askey = $key;
                                        $sessions = $CI->_get_timetable($session_id, $day['id']);
                                        $hasKey = $key;
                                ?>
                                        <div class="day-row row day_row_<?php echo $day['day_name']; ?>"  day="<?= $day['id'] ?>">
                                            <?php if ($key < 1) { ?>
                                                <div class="head-title">
                                                    <h3 class="pull-left">DAYS/TIME</h3>
                                                    <h3 class="pull-right">REASSIGN STAFF</h3>
                                                </div>
                                            <?php } ?>
                                            <div class="day-title">
                                                <h2><?php echo $day['day_name']; ?></h2>
                                            </div>
                                            <div class="hours row" id="row_<?php echo $key ?>">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="students students_<?php echo $day['id']; ?> clear clearfix">
                                                        <?php
                                                        foreach ($sessions as $session) {
                                                            if ($day['id'] == $session['day_id']) {
                                                                $levels = $CI->getLevels($session['level_id']);
                                                                $count = $levels['capacity'];
                                                                $color = $levels['color'];
                                                                $childs = $CI->getChild($session['meta_id']);
                                                                ?>
                                                                <div class="col-md-12 repeator"  data-meta_id="<?php echo $session['meta_id']; ?>">
                                                                    <div class="col-md-3 col-sm-3 pull-left hours-wrap">
                                                                        <div class="hour">
                                                                            <?php echo $session['start_time'] ?> - <?php echo $session['end_time'] ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8 col-sm-8 slot-wrap">
                                                                        <?php
                                                                        for ($i = 0; $i < $count; $i++) {
                                                                            $repeat = array_unique(explode(",", $childs['student_name']));
                                                                            $child_ids = array_unique(explode(",", $childs['child_id']));
                                                                            $name = (isset($repeat[$i])) ? $repeat[$i] : "";
                                                                            $child_id = (isset($child_ids[$i])) ? $child_ids[$i] : "";
                                                                            $valid = count($repeat);
                                                                            ?>
                                                                            <div style="color:#fff;background:<?php echo $color; ?>" class="child" level="<?= $levels['id'] ?>">
                                                                                <?php
                                                                                // if (!empty($child_id)) {
                                                                                    echo "<span class='child_span childz_" . $session['day_id'] . "'>" . $name . "<input type='hidden' class='childs' value='" . $child_id . "' name='childs[$key][][{$session['meta_id']}]'/><input type='hidden' value='{$session['coach_id']}' name='coach[$key][{$session['meta_id']}]'/><input type='hidden' value='{$levels['id']}' name='level[$key][{$session['meta_id']}]'/><input type='hidden' value='{$session['start_time']} - {$session['end_time']}' name='hours[$key][{$session['meta_id']}]'/><input type='hidden' value='{$day['id']}' name='day[$key][{$session['meta_id']}]'/></span>";
                                                                                // }
                                                                                ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <input type='hidden' value='<?= $key ?>' name='row[<?= $key ?>]'/>
                                                                    <div class="col-md-2 col-sm-2 pull-right staff-wrap">
                                                                        <select class="form-control staff_name" name="staff_id[<?=  $session['meta_id'] ?>]">
                                                                            <option>Select Coach</option>
                                                                            <?php
                                                                            foreach ($data['staffs'] as $staff) {
                                                                                ?>
                                                                                <option value="<?php echo $staff['id'] ?>" <?php echo ($staff['id'] == $session['coach_id']) ? "selected=''" : "" ?>><?php echo $staff['username']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="clear clearfix"></div>
                                                                <div class="gap"></div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
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
                                                $(this).find("input[name*='coach']").val($(this).closest('.slot-wrap').siblings('.staff-wrap').find('.staff_name').val());
                                                $(this).find("input[name*='level']").val($(this).closest('.slot-wrap').find('.child.ui-droppable').attr('level'));
                                                $(this).find("input[name*='hours']").val($(this).closest('.slot-wrap').siblings('.hours-wrap').find('.hour').text().trim());
                                                $(this).find("input[name*='day']").val($(this).closest('.day-row.row').attr('day'));

                                                $(this).find(".childs").attr('name', 'childs['+$(this).closest('.hours.row').attr('id').replace('row_', '')+'][][' + checkMeta + ']');
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
                                            <input type="hidden" name="records" class="records">
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
        $(".staff_name").on('change', function () {
            $(this).parent().siblings('.slot-wrap').find('input[type="hidden"][name*="coach"]').val($(this).val());
        });
        var records = [];
        $('.childs').each(function(){
            if($(this).val() != ""){
                records[$(this).val()] = {'hour': $(this).closest('.slot-wrap').siblings('.col-md-3.col-sm-3.pull-left').find('.hour').text().trim(), level: $(this).closest('.child.ui-droppable').attr('level')};
            }
        })
        $('.records').val(JSON.stringify(records))
    });
</script>