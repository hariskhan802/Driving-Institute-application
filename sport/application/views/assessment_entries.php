<div class="page-content-wrapper">
    <div class="page-content" style="min-height:546px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">ENROLL ASSESSMENTS</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('/'); ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">ENROLL ASSESSMENTS</li>
                </ol>
            </div>
        </div>
<!--        <div class="card-box">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Term</label>
                        <select class="form-control" id="term_drp" name="term" required="">
                            <?php print_dropdown($terms); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label> Select Venue</label>
                        <select class="form-control" id="venues_drp" name="venues" required="">
                            <?php print_dropdown($venues); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Club</label>
                        <select class="form-control" id="club_drp" name="club" required="">
                            <?php print_dropdown($clubs); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Level</label>
                        <select class="form-control" id="levels_drp" name="levelx" required="">
                            <?php print_dropdown($levels); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <button class="btn btn-circle btn-warning" type="button" id="search_filter">Search Filter</button>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-12">
             
                <table class="mdl-data-table ml-table-striped ml-table-bordered mdl-js-data-table is-upgraded">
                    <thead>
                        <tr>
                            <th>Child Name</th>
                            <th>Club</th>
                            <th>Level</th>
                            <th>Venue</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($enroll_assessment)) {
                            foreach ($enroll_assessment as $enroll) {
                                ?>
                                <tr>
                                    <td><?= $enroll['child_name'] ?></td>
                                    <td><?= $enroll['club_name'] ?></td>
                                    <td><?= $enroll['level_name'] ?></td>
                                    <td><?= $enroll['venue_name'] ?></td>
                                    <td><?= $enroll['date'] ?></td>
                                    <td><?= $enroll['day'] ?></td>
                                    <td><?= $enroll['start_time'] ?></td>
                                    <td><?= $enroll['end_time'] ?></td>
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
<script>
    $(document).ready(function () {
        $("#search_filter").on('click', function () {
            var terms_id = $("#term_drp").val();
            var clubs_id = $("#club_drp").val();
            var levels_id = $("#levels_drp").val();
            var venues_id = $("#venues_drp").val();
            $.ajax({
                type: 'post',
                url: "<?= site_url("/admin/business_projections/find_by_child"); ?>",
                data: {term_id: terms_id, club_id: clubs_id, level_id: levels_id, venue_id: venues_id},
                beforeSend: function () {
                    $("#_listings").html("");
                },
                success: function (res) {
                    $("#_listings").html(res);
                }
            })
        });
    })
</script>
