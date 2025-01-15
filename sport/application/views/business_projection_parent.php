<div class="page-content-wrapper">
    <div class="page-content" style="min-height:546px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Registered Parents</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('/'); ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Registered Parents</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Parent Name</th>
                            <th>Relationship with child</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Complete Home Address</th>
                        </tr>
                    </thead>
                    <tbody id="_listings">
                        <?php
                        if (!empty($parents_projects)) {
                            $parent_type = array("m" => "Mother", "f" => "Father", "g" => "Guardians");
                            foreach ($parents_projects as $child_project) {
                                ?>
                                <tr>
                                    <td><?= $child_project['first_name'] . " " . $child_project['last_name']; ?></td>
                                    <td><?= $parent_type[$child_project['parent_type']]; ?></td>
                                    <td><?= $child_project['email']; ?></td>
                                    <td><?= $child_project['code'] . " " . $child_project['contact_number']; ?></td>
                                    <td><?= $child_project['address']; ?></td>
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
