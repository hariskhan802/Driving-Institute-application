<div class="page-content-wrapper">
    <div class="page-content" style="min-height:537.997px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-10">
                        <div class="page-title">STUDENT DISCOUNT MANAGEMENT</div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo site_url('/admin/discount-management/add-student-discount') ?>" class="btn btn-circle btn-warning">ADD DISCOUNT </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-box">
                    <div class="card-body " id="bar-parent5">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <label>Select Term</label>
                                <select class="form-control" id="terms">
                                    <?php echo print_dropdown($terms); ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <label>Select Club</label>
                                <select class="form-control" id="clubs">
                                    <?php echo print_dropdown($clubs); ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <label>Select Programme</label>
                                <select class="form-control" id="programs">
                                    <?php echo print_dropdown($programs); ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <label>Select Venue</label>
                                <select class="form-control" id="venues">
                                    <?php echo print_dropdown($venues); ?>   
                                </select>
                                
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <button class="btn btn-circle btn-warning" type="button" id="search_filter">Search Filter</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-box">
                    <div class="card-body ">
                        <table class="mdl-data-table ml-table-striped ml-table-bordered  mdl-data-table--selectable is-upgraded">
                            <thead>
                                <tr>
                                    <th>STUDENT</th>
                                    <th>TERM</th>
                                    <th>CLUB</th>
                                    <th>LEVEL</th>
                                    <th>VENUE</th>
                                    <th>DISCOUNT VALUE</th>
                                    <th>DISCOUNT TYPE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($discounts)) {
                                    foreach ($discounts as $discount) {
                                        ?>
                                        <tr>
                                            <td><?php echo $discount['full_name']; ?></td>
                                            <td><?php echo $discount['term_name']; ?></td>
                                            <td><?php echo $discount['club_name']; ?></td>
                                            <td><?php echo $discount['level_name']; ?></td>
                                            <td><?php echo $discount['venue_name']; ?></td>
                                            <td><?php echo $discount['value']; ?></td>
                                            <td><?php echo $discount['discount_by']; ?></td>
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
        <!-- end chat sidebar -->
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#search_filter").on('click', function () {
            var terms_id = $("#terms").val();
            var clubs_id = $("#clubs").val();
            var programs_id = $("#programs").val();
            var levels_id = $("#levels").val();
            var venues_id = $("#venues").val();
            $.ajax({
                type: 'post',
                url: "<?= site_url("/discount_management/filter_sessions"); ?>",
                data: {term_id: terms_id, club_id: clubs_id, program_id: programs_id, discount_type: 'student', venue_id: venues_id},
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