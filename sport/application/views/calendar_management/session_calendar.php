<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-3">
                        <div class="page-title">CALENDAR MANAGEMENT</div>
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
                            <option value="">Select Programme</option>
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
                                    <th></th>
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
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $session['id']; ?></td>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $session['session_name']; ?></td>
                                            <td class="mdl-data-table__cell--non-numeric"><?php echo $session['term_name']; ?></td>
                                            <td><?php echo $session['club_name']; ?></td>
                                            <td><?php echo $session['program_name']; ?></td>
                                            <td><?php echo $session['level_name']; ?></td>
                                            <td><?php echo $session['short_code']; ?></td>
                                            <td class="actions">
                                                <a href="<?php print_url('/admin/calendar-management/calendar/' . encrypt_decrypt('encrypt', $session['term_id'].'/'.$session['club_id'].'/'.$session['program_id'])); ?>" title="Info">
                                                    <i class="material-icons f-left">device_hub</i>
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
                url: "<?= site_url("/calendar_management/filter_sessions"); ?>",
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
<div id="myModal" class="modal fade in">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons"></i>
                </div>				
                <h4 class="modal-title">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="setUrl" value=""/>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="redirect_delete">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".card-box").on('click', ".delete_me", function () {
        var url = $(this).attr("data-url");
        var redirectURL = $("#setUrl").val(url);
    });

    $("#redirect_delete").on('click', function () {
        var url = $("#setUrl").val();
        window.location.href = url;
    });
</script>