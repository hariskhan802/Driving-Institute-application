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
                    <div class="col-md-6">
                        <div class="page-title">Child Management</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-box">
            <div class="card-body " id="bar-parent5">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <select class="form-control" id="terms">
                            <?php print_dropdown($terms); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <select class="form-control" id="clubs">
                            <?php print_dropdown($clubs); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <select class="form-control" id="programs">
                            <option value="">Select Program</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <select class="form-control" id="levels">
                            <option value="">Select Levels</option>
                        </select>
                    </div>
                </div>
                <div class="gap"></div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <select class="form-control" id="venues">
                            <?php print_dropdown($venues); ?>
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
                        <table class="mdl-data-table ml-table-striped ml-table-bordered  mdl-data-table--selectable is-upgraded">
                            <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>CHILD FULL NAME </th>
                                    <th>GENDER</th>
                                    <th>VENUE</th>
                                    <!-- <th>EMAIL ADDRESS</th> -->
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="_listings">
                                <?php
                                if (!empty($students)) {
                                    $gender = array('m' => 'Male', 'f' => 'Female');
                                    foreach ($students as $student) {
                                        ?>
                                        <tr>
                                            <td class="patient-img sorting_1">
                                                <img src="<?php echo site_url("/assets/uploads/profile_pictures/" . $student['photo_path']); ?>" alt="">
                                            </td>
                                            <td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
                                            <td><?php echo $gender[$student['gender']]; ?></td>
                                            <td><?php echo $student['venue_name']; ?></td>
                                            <!-- <td>aftab@gmail.com</td> -->
                                            <td class="actions">
                                                <a href="<?php echo site_url("/admin/child-management/child-statistics/" . encrypt_decrypt('encrypt', $student['id'])); ?>" class="" data-toggle="tooltip" title="Statistics">
                                                    <i class="material-icons f-left">question_answer</i>
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
                <button type="button" class="btn btn-circle btn-warning black">EXPORT LIST TO EXCEL</button>
            </div>	
        </div>	

        <!-- end chat sidebar -->
    </div>
    <!-- end page container -->
    <script>
        $("#clubs").on('change', function () {
            var club_id = $(this).val();
            $.ajax({
                type: 'post',
                url: "<?= site_url('/session_management/getProgramclubs') ?>",
                data: {club_id: club_id},
                success: function (res) {
                    $("#programs").html(res);
                }
            })
        });
        $("#programs").on('change', function () {
            var program_id = $(this).val();
            $.ajax({
                type: 'post',
                url: "<?= site_url('/session_management/getProgramLevels') ?>",
                data: {program_id: program_id},
                success: function (res) {
                    $("#levels").html(res);
                }
            })
        });

        $("#search_filter").on('click', function () {
            var terms_id = $("#terms").val();
            var clubs_id = $("#clubs").val();
            var programs_id = $("#programs").val();
            var levels_id = $("#levels").val();
            var venues_id = $("#venues").val();
            $.ajax({
                type: 'post',
                url: "<?= site_url("/admin/child-management/filter-child"); ?>",
                data: {club_id: clubs_id, program_id: programs_id, level_id: levels_id, venue_id: venues_id},
                beforeSend: function () {
                    $("#_listings").html("");
                },
                success: function (res) {
                    $("#_listings").html(res);
                }
            })
        });

    </script>
</div>