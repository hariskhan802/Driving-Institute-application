<div class="page-content-wrapper">
    <div class="page-content" style="min-height:546px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Payment Summary</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('/'); ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Payment Summary</li>
                </ol>
            </div>
        </div>
        <div class="card-box">
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
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Child Name</th>
                            <th>Venue</th>
                            <th>Club</th>
                            <th>Level</th>
                            <th>Package</th>
                            <th>Cost</th>
                            <th>Training Fee</th>
                            <th>Reg Fee</th>
                            <th>Discount</th>
                            <th>Saving</th>
                            <th>Total</th>
                            <th>VAT</th>
                            <th>Total Payable</th>
                        </tr>
                    </thead>
                    <tbody id="_listings">
                        <?php
                        if (!empty($child_projects)) {
                            foreach ($child_projects as $child_project) {
                                ?>
                                <tr>
                                    <td><?= $child_project['child_name']; ?></td>
                                    <td><?= $child_project['venue_name']; ?></td>
                                    <td><?= $child_project['club_name']; ?></td>
                                    <td><?= $child_project['level_name']; ?></td>
                                    <td><?= $child_project['package']; ?></td>
                                    <td><?= $child_project['daily_cost']; ?></td>
                                    <td><?= $child_project['competition_fee']; ?></td>
                                    <td><?= $child_project['annual_reg_fee']; ?></td>
                                    <td><?= $child_project['discount']; ?></td>
                                    <td><?= (int) $child_project['gross_total'] - (int) $child_project['discount']; ?></td>
                                    <td><?= $child_project['individual_total']; ?></td>
                                    <td><?= $child_project['vat_total']; ?></td>
                                    <td><?= $child_project['vat_total']; ?></td>
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
