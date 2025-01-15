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
    <div class="page-content" style="min-height:537.997px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-9">
                        <div class="page-title">VENUE DISCOUNT MANAGEMENT</div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo site_url('/admin/discount-management/add-venue-discount') ?>" class="btn btn-circle btn-warning">ADD DISCOUNT </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-box">
                    <div class="card-body " id="bar-parent5">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <select class="form-control" id="terms">
                                    <?php echo print_dropdown($terms); ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <select class="form-control" id="clubs">
                                    <?php echo print_dropdown($clubs); ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <select class="form-control" id="programs">
                                    <?php echo print_dropdown($programs); ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                <select class="form-control" id="venues">
                                    <?php echo print_dropdown($venues); ?>   
                                </select>
                                <div class="gap"></div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
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
                                    <th>TERM</th>
                                    <th>CLUB</th>
                                    <th>PROGRAMME</th>
                                    <th>VENUE</th>
                                    <th>DISCOUNT VALUE</th>
                                    <th>DISCOUNT TYPE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="_listings">
                                <?php
                                if (!empty($discounts)) {
                                    foreach ($discounts as $discount) {
                                        ?>
                                        <tr>
                                            <td><?php echo $discount['term_name']; ?></td>
                                            <td><?php echo $discount['club_name']; ?></td>
                                            <td><?php echo $discount['program_name']; ?></td>
                                            <td><?php echo $discount['venue_name']; ?></td>
                                            <td><?php
                                                if ($discount['discount_by'] == "fixed") {
                                                    echo $discount['value'] . " AED";
                                                } else {
                                                    echo $discount['value'];
                                                }
                                                ?></td>
                                            <td><?php echo $discount['discount_by']; ?></td>
                                            <td><a href="#myModal" class="delete_me" data-url="<?= site_url('/admin/discount-management/delete/' . $discount['id']); ?>" data-toggle="modal" title="Delete">

                                                    <i class="material-icons f-left">delete</i>

                                                </a></td>
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
    $(document).ready(function () {
        $(".delete_me").on('click', function () {
            var url = $(this).attr("data-url");
            var redirectURL = $("#setUrl").val(url);
        });

        $("#redirect_delete").on('click', function () {
            var url = $("#setUrl").val();
            window.location.href = url;
        });

        $("#search_filter").on('click', function () {
            var terms_id = $("#terms").val();
            var clubs_id = $("#clubs").val();
            var programs_id = $("#programs").val();
            var levels_id = $("#levels").val();
            var venues_id = $("#venues").val();
            $.ajax({
                type: 'post',
                url: "<?= site_url("/discount_management/filter_sessions"); ?>",
                data: {term_id: terms_id, club_id: clubs_id, program_id: programs_id, discount_type: 'venue', venue_id: venues_id},
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