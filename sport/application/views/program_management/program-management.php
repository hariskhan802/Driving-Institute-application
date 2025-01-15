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

                    <div class="col-md-7">

                        <div class="page-title">PROGRAMME CREATION</div>

                    </div>

                    <div class="col-md-2">
                        <a href='<?php echo site_url('/admin/program-management/create-program'); ?>' class="btn btn-circle btn-warning">ADD PROGRAMME</a>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control" id="only_clubs">
                                <?php print_dropdown($clubs); ?>
                            </select>
                        </div>
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
                                    <th>PROGRAMME NAME</th>
                                    <th>CLUB</th>
                                    <th>COST PER SESSION</th>
                                    <th>LEVELS</th>
                                    <th>TOTAL LEVELS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="_listing">
                                <?php
                                if (!empty($programs)) {
                                    foreach ($programs as $program) {
                                        $colours = explode(",", $program['colors']);
                                        ?>
                                        <tr>
                                            <td><?php echo $program['program_name']; ?></td>
                                            <td><?php echo $program['club_name']; ?></td>
                                            <td><?php echo $program['cost_per_session']; ?></td>
                                            <td>
                                                <?php
                                                foreach ($colours as $colour) {
                                                    echo '<span class="colorbox" style="background:' . str_replace("|", ',', $colour) . '"></span>';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo (!empty(array_filter($colours))) ? count($colours) : 'N/A'; ?></td>
                                            <td class="actions">
                                                <a href="<?php echo site_url('/admin/program-management/edit_program/' . encrypt_decrypt('encrypt', $program['id'])); ?>" class="" data-toggle="tooltip" title="Edit">
                                                    <i class="material-icons f-left">edit</i>
                                                </a> 
                                                <!--                                                <a href="#" class="" data-toggle="tooltip" title="Session">
                                                
                                                                                                    <i class="material-icons f-left">perm_contact_calendar</i>
                                                
                                                                                                </a>-->
                                                <a href="<?php echo site_url('/admin/program-management/duplicate-record/' . encrypt_decrypt('encrypt', $program['id'])); ?>" class="" data-toggle="tooltip" title="Duplicate">
                                                    <i class="material-icons f-left">library_add</i>
                                                </a>
                                                <a href="#myModal" class="delete_me" data-url="<?php echo site_url('/admin/program-management/delete_program/' . encrypt_decrypt('encrypt', $program['id'])); ?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
                                                    <i class="material-icons f-left">delete</i>
                                                </a>
                                                <a href="#" class="fetch_levels" data-id="<?php echo $program['id']; ?>" data-toggle="modal" data-target="#programInfo" title="Info">
                                                    <i class="material-icons f-left">info</i>
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



        <!-- end chat sidebar -->

    </div>

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
    <div id="programInfo" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn yellow btn-outline btn-circle" data-dismiss="modal">Close</button>
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

            $(".fetch_levels").on('click', function (e) {
                e.preventDefault();
                var program_id = $(this).attr("data-id");
                $.ajax({
                    type: 'post',
                    url: "<?php echo site_url('/admin/program-management/getLevels') ?>",
                    data: {
                        program_id: program_id
                    },
                    success: function (res) {
                        $("#programInfo").find(".modal-body").html(res);
                        console.log(program_id);
                    }
                });
            });

        });
    </script>
    <style>
        span.colorbox {
            width: 30px;
            height: 30px;
            display: inline-block;
        }
        .modal-body h2 {
            background: #fbed22;
            padding: 10px;
        }
        table.table tr th {
            background: #191919;
            color: #fbed22;
        }
        table.table tbody tr:nth-child(even) {background-color: #f2f2f2;}
    </style>

    <script>
        $(document).ready(function () {
            $("#only_clubs").on('change', function () {
                    $.ajax({
                        type: 'post',
                        url: "<?= site_url('/program_management/get_program_by_club') ?>",
                        data: {club_id: $(this).val()},
                        beforeSend: function () {
                            $("#_listing").html("");
                        },
                        success: function (res) {
                            $("#_listing").html(res);
                        }
                    });
            });
        });
    </script>