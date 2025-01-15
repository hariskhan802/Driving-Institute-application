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

                        <div class="page-title">ASSESSMENT MANGEMENT ENTRIES</div>

                    </div>

                    <div class="col-md-3">

                        <a href="<?php echo site_url('/admin/assessment-management/add-assessment') ?>" class="btn btn-circle btn-warning">ADD ASSESSMENT</a>

                    </div>
                    <div class="col-md-3">

                        <!--                        <div class="form-group">
                        
                                                    <div class="input-group search input-group-sm">
                        
                                                        <input type="text" class="form-control" placeholder="Search" autocomplete="off">
                        
                                                        <span class="input-group-btn">
                        
                                                            <button type="button" class="btn btn-info btn-flat">Go!</button>
                        
                                                        </span>
                        
                                                    </div>
                        
                                                </div>-->

                                            </div>

                                        </div>



                                    </div>

                                </div>

                                <div class="card card-box">



                                    <div class="card-body " id="bar-parent5">

                                        <div class="row">

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">

                                                <label>Select Term</label>
                                                <select class="form-control" id="terms">
                                                    <?php echo print_dropdown($terms); ?>
                                                </select>

                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                <label>Select Venue</label>
                                                <select class="form-control" id="venues">
                                                    <?php echo print_dropdown($venues); ?>
                                                </select>

                                            </div>

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                <label>Select Club</label>
                                                <select class="form-control" id="clubs">
                                                 <option value="">All</option>
                                                 <option value="1">My Swim Club</option>
                                                 <option value="5">My Tri Club</option>

                                             </select>

                                         </div>

                                         <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                            <label>Select Day</label>
                                            <select class="form-control" id="days">
                                                <?php echo print_dropdown($days); ?>
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

                                            <table class="mdl-data-table ml-table-striped ml-table-bordered mdl-js-data-table  is-upgraded" data-upgraded=",MaterialDataTable">

                                                <thead>

                                                    <tr>

                                                        <th>VENUE</th>

                                                        <th>CLUB</th>

                                                        <th>PROGRAMME NAME</th>

                                                        <th>TERMS</th>

                                                        <th>DATE</th>

                                                        <th>DAYS</th>

                                                        <th>TIME</th>

                                                        <th>ACTION</th>

                                                    </tr>

                                                </thead>

                                                <tbody id="_listings">

                                                    <?php
            $extra_program=array("","Try Tri","Development & Performance");
                                                    if (!empty($assessments)) {
                                                    
                                                        foreach ($assessments as $assessment) {
                                                           
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $assessment['short_code']; ?></td>
                                                                <td><?php echo $assessment['club_name']; ?></td>
                                                                <td>
                                                                    <?php 
                                                                    if($assessment['club_id'] == "5" ){
                                                                echo $extra_program[$assessment['session_type']];
                                                                    }else{
                                                                       echo $programName= $assessment['program_name'];
                                                                   }
                                                                     ?>
                                                                        
                                                                    </td>
                                                                <td><?php echo $assessment['term_name']; ?></td>
                                                                <td><?php echo $assessment['date']; ?></td>
                                                                <td><?php echo $assessment['day']; ?></td>
                                                                <td><?php echo $assessment['start_time'] . "-" . $assessment['end_time']; ?></td>
                                                                <td class="actions">
                                                                    <a href="<?php print_url('/admin/assessment-management/edit_assessment/' . encrypt_decrypt('encrypt', $assessment['id'])); ?>" title="Edit">
                                                                        <i class="material-icons f-left">edit</i>
                                                                    </a>
                                                                    <a href="#myModal" class="delete_me" data-url="<?php print_url('/admin/assessment-management/delete_assessment/' . encrypt_decrypt('encrypt', $assessment['id'])); ?>" data-toggle="modal"  data-toggle="tooltip" title="Delete">
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



                            <!-- end chat sidebar -->

                        </div>

                        <!-- end page container -->

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
                                var venues_id = $("#venues").val();
                                var day = $("#days").find("option:selected").text();
                                if (day == "Select Day") {
                                    day = '';
                                }
                                $.ajax({
                                    type: 'post',
                                    url: "<?= site_url("/admin/assessment-management/filter_assessment"); ?>",
                                    data: {term_id: terms_id, club_id: clubs_id, venue_id: venues_id, day: day},
                                    beforeSend: function () {
                                        $("#_listings").html("");
                                    },
                                    success: function (res) {
                                        $("#_listings").html(res);
                                    }
                                })
                            });
    });//
</script>