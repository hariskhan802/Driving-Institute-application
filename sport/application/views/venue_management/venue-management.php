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
                    <div class="col-md-10">
                        <div class="page-title">Venue Management</div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo site_url('/admin/venue-management/add-venue'); ?>" class="btn btn-circle btn-warning">ADD Venue</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-12">

                <div class="card-box">



                    <div class="card-body ">

                        <table class="mdl-data-table ml-table-striped ml-table-bordered mdl-data-table--selectable is-upgraded">

                            <thead>

                                <tr>

                                    <th>IMAGE</th>

                                    <th>VENUE(Code)</th>

                                    <th>MAP</th>

                                    <th class="located-in">LOCATED IN</th>

                                    <th>CONTACT</th>

                                    <th>ACTION</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php
                                if (!empty($venues)) {

                                    foreach ($venues as $venue) {
                                        ?>

                                        <tr>

                                            <td class="patient-img sorting_1">

                                                <img src="<?php echo site_url('/assets/uploads/' . $venue->photo_path) ?>" alt="">

                                            </td>

                                            <td><?php echo $venue->short_code; ?></td>

                                            <td><a target="_blank" href="<?php echo $venue->google_map_url; ?>">LINK</a></td>

                                            <td class="located-in" width="200"><?php echo $venue->located_in; ?></td>

                                            <td><?php echo '(' . $venue->c_code . ') ' . $venue->contact_number; ?></td>

                                            <td class="actions">
                                                <a href="<?php echo site_url('admin/venue-management/venue-detials/' . $venue->id) ?>" title="Info">

                                                    <i class="material-icons f-left">info</i>
                                                </a>
                                                <a href="<?php echo site_url("/admin/venue-management/edit-venue/" . encrypt_decrypt('encrypt', $venue->id)) ?>" data-toggle="tooltip" title="Edit">

                                                    <i class="material-icons f-left">edit</i>

                                                </a>
                                                <a class="delete_me" href="#testmodal" data-url="<?php echo site_url("/admin/venue-management/delete-venue/" . encrypt_decrypt('encrypt', $venue->id)) ?>" data-toggle="modal"  title="Delete">

                                                    <i class="material-icons f-left">delete</i>

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

                <a href="<?php echo site_url('/venue_management/export_venue');?>" class="btn btn-circle btn-warning black">EXPORT LIST TO EXCEL</a>

            </div>	

        </div>	



        <!-- end chat sidebar -->

    </div>



    <div id="programInfo" class="modal fade" role="dialog">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title text-center">Venue Details</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body">

                    <p></p>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>

    </div>

    <div id="testmodal" class="modal delete-m fade in">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="icon-box">
                        <img src="<?php echo site_url('assets/images/delete.gif'); ?>"/>
                    </div>
                                    
                    <h4 class="modal-title">Are you sure?</h4>
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="setUrl" value=""/>
                    <button type="button" class="btn btn-danger" id="redirect_delete">Yes</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(".fetch_venues").on('click', function (e) {

            e.preventDefault();

            var venue_id = $(this).attr("data-id");

            $.ajax({
                type: 'post',
                url: "<?php echo site_url('/admin/venue-management/getVenue') ?>",
                data: {
                    venue_id: venue_id

                },
                success: function (res) {

                    $("#programInfo").find(".modal-body").html(res);

                }

            });

        });



    </script>


    <script>
        $(document).ready(function () {
            $("#myModal").modal('hide');
            $(".delete_me").on('click', function () {
                var url = $(this).attr("data-url");
                var redirectURL = $("#setUrl").val(url);
            });

            $("#redirect_delete").on('click', function () {
                var url = $("#setUrl").val();
                window.location.href = url;
            });
        });
    </script>

<style>
    fieldset.minute legend {
        display: none;
    }
</style>