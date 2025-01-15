<div class="page-content-wrapper program-creation">

    <div class="page-content" style="min-height:596px">
        <form id="program_creation" action="<?php echo site_url('admin/program-management/save-program'); ?>" method="POST" enctype="multipart/form-data">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="page-title">PROGRAMME CREATION</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Programme Name</label>
                                    <input type="text" name="program_name" required="" class="form-control" placeholder="Enter Programme Name ">

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Select Club</label>
                                    <select class="form-control" name="club" required="">
                                        <option value="">All</option>
                                        <option value="1" data-name="swim">My Swim Club</option>
                                        <option value="2" data-name="football">My Football Club</option>
                                        <option value="3" data-name="netball">My Netball Club</option>
                                        <option value="4" data-name="holiday">My Holiday Camps</option>
                                        <option value="5" data-name="tri">My Tri Club</option>
                                    </select>
                                </div>
                            </div>
                            <div class="gap"></div>
                            <div class="row sfn" style="display:none;">

                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Cost Per Session</label>
                                    <input type="text" name="cost_per_session" required="" class="form-control" placeholder="Enter">

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Annual Reg Fee</label>
                                    <input type="text" name="annual_reg_free" required="" class="form-control" placeholder="Enter">

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Competition Fee</label>
                                    <input type="text" name="competition_fee" class="form-control" placeholder="Enter">

                                </div>

                            </div>

                            <div class="row holiday_div" style="display: none;">

                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Full Week Cost</label>
                                    <input type="text" name="full_week_cost" required="" class="form-control" placeholder="Enter">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Daily Cost</label>
                                    <input type="text" name="daily_cost" required="" class="form-control" placeholder="Enter">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <label>Exclusion per day cost</label>
                                    <input type="text" name="per_day_cost" class="form-control" placeholder="Enter">

                                </div>
                            </div>

                            <div class="tri_club" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <label>Session Card Cost</label>
                                        <input type="text" name="session_card_cost" required="" class="form-control" placeholder="Enter 10 Session Card Cost">

                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <label>Annual Reg. Fee</label>
                                        <input type="text" name="annual_reg_free" required="" class="form-control" placeholder="Enter">

                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                        <label>Competition Fee</label>
                                        <input type="text" name="competition_fee" class="form-control" placeholder="Enter">

                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <label>No of session per week</label>
                                        <input type="number" id="num_session" min="0" required="" class="form-control" value="" placeholder="No.Session p/wk">

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <label>Cost Per Session</label>
                                        <input type="number" id="cost_per_session" min="0"  required="" class="form-control" value="" placeholder="Cost Per Session">

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <button type="button" id="add_session" class="btn btn-circle btn-warning">Add Session</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row result-sessions">
                                <div class="col-md-12">
                                    <div id="add_sessions"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-box levelbox">
                        <div class="card-body">   
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="heading"><h3>Add level to the programme</h3></div>

                                </div>

                            </div>

                            <div class="row levels">

                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <label>Level Name</label>
                                    <input type="text" class="form-control" id="level_name" placeholder="Enter Level Name">

                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <label>Capacity</label>
                                    <input type="text" class="form-control" placeholder="Enter Capacity" id="enter_capacity">

                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                    <label>Min.Age</label>
                                    <input type="text" class="form-control" placeholder="Min" id="min_age">

                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                    <label>Max.Age</label>
                                    <input type="text" class="form-control" placeholder="Max" id="max_age">

                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <label>Duration(in minutes)</label>
                                    <input type="text" class="form-control" placeholder="Duration(in minutes)" id="duration">

                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                    <label>Upload File</label>
                                    <div class="dz-default dz-message dropzone form-horizontal dz-clickable" style="position:relative;">

                                        <span>upload File</span>

                                        <input type="file" id="documents" class="dz-hidden-input" style="opacity: 0; position: absolute; top: 0px; left: 0px; height: 40px; width: auto;">

                                        <input type="hidden" id="document_name" name="document_name"/>
                                        <input type="hidden" id="document_url" name="document_url"/>

                                    </div>
                                    <span class="filename"></span>
                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                    <label>Color</label>
                                    <div id="maincolorPanel" class="input-group colorpicker-component col-md-8 colorpicker-element">

                                        <span class="input-group-addon"><i style="background-color: rgb(170, 51, 153);"></i></span>

                                    </div>

                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1 col-1">

                                    <button type="button" id="addrow" class="btn yellow btn-outline btn-circle m-b-10">ADD</button>

                                </div>

                            </div>



                            <div class="append_list result-bar">

                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-lg-1 col-md-1 col-sm-1 col-1">

                            <a href="<?= site_url('/admin/program-management/') ?>" class="btn btn-circle btn-warning black">BACK</a>

                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-1 col-1">

                            <button id="sub_create" type="submit" class="btn btn-circle btn-warning ">SAVE PROGRAMME</button>

                        </div>

                    </div>

                    </form>

                    <!-- end chat sidebar -->

                </div>

            </div>

            <script>
                $(document).ready(function () {
                    $(".result-sessions").on("click", ".closeMe", function () {
                        $(this).parents(".session_program").remove();

                    });
                    $("select[name='club']").on('change', function () {
                        if ($(this).val() == "4") {
                            $(".levelbox").hide();
                        } else {
                            $(".levelbox").show();
                        }
                    })

                    $("#sub_create").on('click', function (e) {
                        var $myForm = $('#myForm');

                        if ($('#program_creation')[0].checkValidity()) {
                            e.preventDefault();
                            $("#myModal").modal("show");
                        }

                    });

                    $("#redirect_delete").on('click', function () {
                        $("#program_creation").submit();
                    });

                });
            </script>

            <style>
                button.cancel {
                    display: inline-block !important;
                }
            </style>

            <div id="myModal" class="modal delete-m save-m fade in">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="icon-box">
                                <img class="markas" src="<?php echo site_url('assets/images/question.png'); ?>"/>
                            </div>              
                            <h4 class="modal-title">Do you really want to save?</h4>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="setUrl" value=""/>
                            <button type="button" class="btn btn-info" id="redirect_delete">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                img.markas {
                    width: 20%;
                }
            </style>