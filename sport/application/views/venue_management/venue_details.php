<div class="page-content-wrapper">
    <div class="page-content" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Venue Details</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <div class="card card-topline-aqua">
                        <div class="card-body no-padding height-9">
                            <div class="row">
                                <div class="profile-userpic">
                                    <img src="<?php echo site_url('/assets/uploads/' . $venues['photo_path']) ?>" class="img-responsive" alt=""> </div>
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"><?= $venues['venue_name'] ?></div>
                            </div>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Venue Short Code</b> <a class="pull-right"><?= $venues['short_code'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone No</b> <a class="pull-right"><?= "(" . $venues['c_code'] . ") " . $venues['contact_number']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email: </b> <a class="pull-right"><?= $venues['email']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>LOCATED IN</b> <a class="pull-right" target="_blank" href="<?= $venues['google_map_url']; ?>">Map Links</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Addition Description</b><p><?= $venues['additional_description']; ?></p>
                                </li>
                            </ul>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <!-- END SIDEBAR BUTTONS -->
                        </div>
                    </div>
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="card">
                            <div class="card-topline-aqua">
                                <header></header>
                            </div>
                            <div class="white-box">
                                <!-- Nav tabs -->
                                <div class="p-rl-20">
                                    <ul class="nav customtab nav-tabs" role="tablist">
                                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">VENUE DETAILS</a></li>
                                        <li class="nav-item"><a href="#tab2" class="nav-link " data-toggle="tab">SESSION BOOKED</a></li>

                                    </ul>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <div class="container-fluid">
                                            <?php
                                            $days = array("", "Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday");

                                            $categories = array("", "Venue", "Community");

                                            $Status = array(
                                                "",
                                                "Outdoor - Floodlit",
                                                "Outdoor - Shaded",
                                                "Floodlit",
                                                "Outdoor, Indoor",
                                            );
                                            $Facilities = array(
                                                "",
                                                "Swimming Pool",
                                                "Astro - turf Pitch",
                                                "Grass Pitch",
                                                "Sports Hall",
                                                "Multi Purpose Court",
                                                "Athletics Track",
                                            );
                                            $Facility = array("", "Swimming Pool", "Astro - turf Pitch", "Grass Pitch", "Sports Hall", "Multi Purpose Court", "Athletics Track", "Gym", "Studio");
                                            $Status = array("", "Indoor", "Outdoor - Shaded", "Outdoor - Unshaded");
                                            $venue_db = $this->db->query("SELECT * FROM `venues` WHERE id='{$venue_id}'")->row_array();
                                            $venue_hours = $this->db->query("SELECT * FROM `venue_hours` WHERE venue_id='{$venue_id}'")->result_array();
                                            $table = '<div class="row">';
                                            $table .= '<div class="seprapte col-md-12">';
                                            $table .= '<h3>Venue Hours</h3>';
                                            $table .= '<table class="table">';
                                            $table .= '<thead>';
                                            $table .= '<tr>';
                                            $table .= '<th>Venue Start Time</th>';
                                            $table .= '<th>Venue End Time</th>';
                                            $table .= '</tr>';
                                            $table .= '</thead>';
                                            $table .= '<tbody>';
                                            if (!empty($venue_hours)) {
                                                foreach ($venue_hours as $venue_hour) {
                                                    $table .= '<tr>';
                                                    $table .= '<td>' . $venue_hour['start_time'] . '</td>';
                                                    $table .= '<td>' . $venue_hour['end_time'] . '</td>';
                                                    $table .= '</tr>';
                                                }
                                            }
                                            $table .= '</tbody>';
                                            $table .= '</table>';
                                            $table .= '</div>';
                                            // SCHOOL
                                            $school_dbs = $this->db->query("SELECT 
                                        vtsh.`year_group_name`,
                                        vtsh.`start_time`,
                                        vtsh.`end_time` 
                                        FROM
                                        `venues` v 
                                        LEFT JOIN `venue_timing_school_hours` vtsh 
                                        ON v.`id` = vtsh.`venue_id` 
                                        WHERE v.id = '{$venue_id}'")->result_array();

                                            $table .= '<div class="seprapte col-md-12">';
                                            $table .= '<h3>School Hours</h3>';
                                            $table .= '<table class="table">';
                                            $table .= '<thead>';
                                            $table .= '<tr>';
                                            $table .= '<th>Group Name</th>';
                                            $table .= '<th>School Start Time</th>';
                                            $table .= '<th>School End Time</th>';
                                            $table .= '</tr>';
                                            $table .= '</thead>';
                                            $table .= '<tbody>';
                                            if (!empty($school_dbs)) {
                                                foreach ($school_dbs as $school_db) {
                                                    $table .= '<tr>';
                                                    $table .= '<td>' . $school_db['year_group_name'] . '</td>';
                                                    $table .= '<td>' . $school_db['start_time'] . '</td>';
                                                    $table .= '<td>' . $school_db['end_time'] . '</td>';
                                                    $table .= '</tr>';
                                                }
                                            }
                                            $table .= '</tbody>';
                                            $table .= '</table>';
                                            $table .= '</div>';

                                            // MSA HOURS
                                            $msa_dbs = $this->db->query("SELECT 
                                        vtmah.`day_id`,
                                        vtmah.`category`,
                                        vtmah.`start_time`,
                                        vtmah.`end_time` 
                                        FROM
                                        `venues` v 
                                        LEFT JOIN `venue_timing_msa_access_hours` vtmah 
                                        ON v.`id` = vtmah.`venue_id` 
                                        WHERE v.id = '{$venue_id}' ")->result_array();

                                            $table .= '<div class="seprapte col-md-12">';
                                            $table .= '<h3>MSA Hours</h3>';
                                            $table .= '<table class="table">';
                                            $table .= '<thead>';
                                            $table .= '<tr>';
                                            $table .= '<th>Day</th>';
                                            $table .= '<th>Category</th>';
                                            $table .= '<th>School Start Time</th>';
                                            $table .= '<th>School End Time</th>';
                                            $table .= '</tr>';
                                            $table .= '</thead>';
                                            $table .= '<tbody>';
                                            if (!empty($msa_dbs)) {
                                                foreach ($msa_dbs as $msa_db) {
                                                    $table .= '<tr>';
                                                    $table .= '<td>' . $days[$msa_db['day_id']] . '</td>';
                                                    $table .= '<td>' . $categories[$msa_db['category']] . '</td>';
                                                    $table .= '<td>' . $msa_db['start_time'] . '</td>';
                                                    $table .= '<td>' . $msa_db['end_time'] . '</td>';
                                                    $table .= '</tr>';
                                                }
                                            }
                                            $table .= '</tbody>';
                                            $table .= '</table>';
                                            $table .= '</div>';

                                            // Facility
                                            $facility_dbs = $this->db->query("SELECT 
                                        vf.`facility_id`,
                                        vf.`status`,
                                        vf.`size`,
                                        vf.`features`,
                                        vf.`measurement`,
                                        vf.`rating`,
                                        vf.`risk_assesment_active`
                                        FROM
                                        `venues` v 
                                        LEFT JOIN `venue_facilities` vf 
                                        ON v.`id` = vf.`venue_id` 
                                        WHERE v.id = '{$venue_id}' ")->result_array();

                                            $table .= '<div class="seprapte col-md-12">';
                                            $table .= '<table class="table">';
                                            $table .= '<h3>VENUE FACILITY</h3>';
                                            $table .= '<thead>';
                                            $table .= '<tr>';
                                            $table .= '<th>Facility</th>';
                                            $table .= '<th>Status</th>';
                                            $table .= '<th>Size</th>';
                                            $table .= '<th>Features</th>';
                                            $table .= '<th>Rating</th>';
                                            $table .= '<th>Risk Active</th>';
                                            $table .= '</tr>';
                                            $table .= '</thead>';
                                            $table .= '<tbody>';
                                            if (!empty($facility_dbs)) {
                                                foreach ($facility_dbs as $facility_db) {
                                                    $table .= '<tr>';
                                                    $table .= '<td>' . $Facilities[$facility_db['facility_id']] . '</td>';
                                                    $table .= '<td>' . $Status[$facility_db['status']] . '</td>';
                                                    $table .= '<td>' . $facility_db['size'] . " " . $facility_db['measurement'] . '</td>';
                                                    $table .= '<td>' . $facility_db['features'] . '</td>';
                                                    $table .= '<td>' . $facility_db['rating'] . '</td>';
                                                    $table .= '<td>' . $facility_db['risk_assesment_active'] . '</td>';
                                                    $table .= '</tr>';
                                                }
                                            }
                                            $table .= '</tbody>';
                                            $table .= '</table>';
                                            $table .= '</div>';

                                            $table .= '</div>';
                                            echo $table;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="container-fluid">
                                            <div class="row"><h3>SESSIONS BOOKED</h3></div>
                                            <div class="row">
                                                <div class="full-width p-rl-20">
                                                    <div class="card card-box">

                                                        <div class="card-body " id="bar-parent5">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                                    <label>Select Clubs</label>
                                                                    <select class="form-control" id="clubs">
                                                                        <?= print_dropdown($clubs); ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                                    <label>Select Programme</label>
                                                                    <select class="form-control"  id="program">
                                                                        <?= print_dropdown($programs); ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                                    <label>Select Levels</label>
                                                                    <select class="form-control" id="levels">

                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                                    <button class="btn btn-circle btn-warning" type="button" id="search_filter">Search Filter</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="full-width p-rl-20">

                                                    <table class="mdl-data-table ml-table-striped ml-table-bordered mdl-js-data-table is-upgraded" data-upgraded=",MaterialDataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>SESSION</th>
                                                                <th>CLUB</th>
                                                                <th>PROGRAMME</th>
                                                                <th>LEVEL</th>
                                                                <th>TERM</th>
                                                                <th>DAY</th>
                                                                <th>TIME</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="_listings">
                                                            <?php
                                                            if (!empty($sessions)) {
                                                                foreach ($sessions as $session) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $session['session_name']; ?></td>
                                                                        <td><?= $session['club_name']; ?></td>
                                                                        <td><?= $session['program_name']; ?></td>
                                                                        <td><?= $session['level_name']; ?></td>
                                                                        <td><?= $session['term_name']; ?></td>
                                                                        <td><?= $session['day']; ?></td>
                                                                        <td><?= $session['start_time']." ".$session['end_time']; ?></td>
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
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                    <a href="<?= site_url('/admin/venue-management') ?>" class="btn btn-circle btn-warning black">BACK</a>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                    <a href="<?= site_url('/admin/venue-management/edit-venue/' . encrypt_decrypt('encrypt', $venue_id)) ?>" class="btn btn-circle btn-warning black">EDIT</a>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- end page content -->

    <!-- end chat sidebar -->
</div>
<style>
    .seprapte h3 {
        background: #fbed22;
        color: #000;
        padding: 10px;
        border-radius: 13px;
        font-size: 20px !important;
        font-weight: bold;
    }
    table.table thead tr th {
        background: #000;
        color: #fff;
    }   
</style>
<script>
    $("#program").on('change', function () {
        var program_id = $(this).val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url('/admin/session-management/getprogramlevels') ?>",
            data: {program_id: program_id},
            success: function (res) {
                $("#levels").html(res);
            }
        });
    });

    $("#search_filter").on('click', function () {
        var clubs_id = $("#clubs").val();
        var programs_id = $("#program").val();
        var levels_id = $("#levels").val();
        var venue_id = "<?= $venue_id ?>";
        $.ajax({
            type: 'post',
            url: "<?= site_url("/venue_management/filter_venue"); ?>",
            data: {club_id: clubs_id, program_id: programs_id, level_id: levels_id, venue_id: venue_id},
            beforeSend: function () {
                $("#_listings").html("");
            },
            success: function (res) {
                $("#_listings").html(res);
            }
        })
    });
</script>