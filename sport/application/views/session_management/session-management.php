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

    <div class="page-content">

        <div class="page-bar">

            <div class="page-title-breadcrumb">

                <div class="row">

                    <div class="col-md-3">

                        <div class="page-title">SESSION MANAGEMENT</div>

                    </div>

                    <div class="col-md-6">

                        <a href='<?php print_url('/admin/session-management/create-session'); ?>' class="btn btn-circle btn-warning">ADD SESSION</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="card card-box session-management">
            <div class="card-body " id="bar-parent5">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Term</label>
                        <select class="form-control" id="terms">
                            <?php print_dropdown($terms); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Club</label>
                        <select class="form-control" id="clubs">
                            <?php print_dropdown($clubs); ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Programme</label>
                        <select class="form-control" id="programs">
                            <option value="">All</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 levelz">
                        <label>Select Level</label>
                        <select class="form-control" id="levels">
                            <option value="">All</option>
                        </select>
                    </div>
                </div>
                <div class="gap"></div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                        <label>Select Venues</label>
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
            <div class="col-sm-12 listing">
                <div class="card-box">
                    <div class="card-body ">
                        <table class="mdl-data-table ml-table-striped ml-table-bordered  mdl-data-table--selectable is-upgraded">
                            <thead>
                                <tr>
                                    <th>SESSION NAME</th>
                                    <th>TERM</th>
                                    <th>CLUB NAME</th>
                                    <th>PROGRAMME</th>
                                    <th>LEVEL</th>
                                    <th>VENUE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="_listings">
                                <?php
                                if (!empty($sessions)) {
                                    foreach ($sessions as $session) {
                                        ?>
                                        <tr>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $session['session_name']; ?></td>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $session['term_name']; ?></td>
                                            <td><?php echo $session['club_name']; ?></td>
                                            <td><?php echo $session['program_name']; ?></td>
                                            <td><?php echo (!empty($session['level_name'])) ? $session['level_name'] : "N/A"; ?></td>
                                            <td><?php echo $session['short_code']; ?></td>
                                            <td class="actions">
                                                <a href="<?php print_url('/admin/session-management/session-info/' . encrypt_decrypt('encrypt', $session['id'])); ?>" title="Info">
                                                    <i class="material-icons f-left">info</i>
                                                </a>
                                                <a href="<?php print_url('/admin/session-management/edit_session/' . encrypt_decrypt('encrypt', $session['id'])); ?>" class="" data-toggle="tooltip" title="Session">
                                                    <i class="material-icons f-left">edit</i>
                                                </a>
                                                <a href="#myModal" class="delete_me" data-href="<?php print_url('/admin/session-management/delete_session/' . encrypt_decrypt('encrypt', $session['id'])); ?>"  data-toggle="modal" title="Delete">
                                                    <i class="material-icons f-left">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr><td colspan="6"><center><i>No Records Found</i></center></td></tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#clubs").on('change', function () {
            var club_id = $(this).val();
            if (club_id == "4") {
                $(".levelz").hide();
            } else {
                $(".levelz").show();
            }
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
                url: "<?= site_url("/session_management/filter_sessions"); ?>",
                data: {term_id: terms_id, club_id: clubs_id, program_id: programs_id, level_id: levels_id, venue_id: venues_id},
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
    $(".card-box").on('click', ".delete_me", function () {
        var url = $(this).attr("data-href");
        var redirectURL = $("#setUrl").val(url);
    });
    $("#redirect_delete").on('click', function () {
        var url = $("#setUrl").val();
        window.location.href = url;
    });
</script>