<div class="page-content-wrapper">
  
    <div class="page-content" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-6">
                        <div class="page-title">Statistics</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-7">
                                    <input type="hidden" name="student_id" value="<?= $student_id; ?>"/>
                                    <div class="col-md-12">
                                        <label>Area of Strength </label>
                                        <input type="text" class="form-control" name="strength" value="<?php echo (isset($child_data['strength']) && !empty($child_data['strength'])) ? $child_data['strength'] : "" ?>" placeholder="Area of Strength "/>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Area for Development </label>
                                        <input type="text" class="form-control" value="<?php echo (isset($child_data['development']) && !empty($child_data['development'])) ? $child_data['development'] : '' ?>" name="development" placeholder="Area for Development"/>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Coaches comments</label>
                                        <textarea name="comments" class="form-control" placeholder="Coaches comments"><?php echo (isset($child_data['comments']) && !empty($child_data['comments'])) ? $child_data['comments'] : '' ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <br/>
                                <button class="btn btn-circle btn-warning" type="submit" id="search_filter">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
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