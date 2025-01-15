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

    $swal_error = $this->session->flashdata("error_popup");

    if (!empty($swal_error)) {
        ?>
        <script>

            swal("Oops", "<?php echo $swal_error; ?>", "error");

        </script>
        <?php
    }
    ?>
    <div class="page-content add-form" style="min-height:596px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Staff</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-body" id="bar-parent">
                        <form action="<?php echo site_url('/admin/staff-management/update_absense') ?>" method="POST">
                            <input type="hidden" name="absense_id" value="<?php echo $absense['id']; ?>"/>
                            <input type="hidden" name="staff_id" value="<?php echo $absense['staff_id']; ?>"/>
                            <div class="row">
                                <div class="col-md-7">
                                    <label class="col-md-12">
                                        Start Date
                                        <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                            <input class="form-control input-height" name="startDate" size="16" placeholder="Start Date" type="text" value="<?php echo date('d-m-Y', strtotime($absense['startDate'])) ?>" data-dtp="dtp_znDa3">
                                        </div>
                                    </label>
                                    <label class="col-md-12">
                                        End Date
                                        <div class="input-group date form_datex " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                            <input class="form-control input-height" name="endDate" size="16" placeholder="End Date" type="text" value="<?php echo date('d-m-Y', strtotime($absense['endDate'])) ?>" data-dtp="dtp_znDa3">
                                        </div>
                                    </label>
                                    <label class="col-md-12">
                                        Reason
                                        <textarea name="reason"><?php echo $absense['reason']; ?></textarea>
                                    </label>
                                    <label class="col-md-12">
                                        Documents
                                        <input type="file" name="userfile" id="multipleUpload"/> 
                                    </label>
                                    <div id="append_document" class="col-md-12">

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <h3 style="padding:10px;">DOCUMENTS</h3>
                                    <hr/>
                                    <?php
                                    $documents = explode(",", $absense['documents']);
                                    $document_id = explode(",", $absense['document_id']);
                                    if (!empty($documents)) {
                                        foreach ($documents as $key => $document) {
                                            if (!empty($document)) {
                                                echo '<div class="appenddocument"><a href="' . site_url("/assets/uploads/" . $document) . '" target="_blank">View Document</a><a class="closemyself delete_self" data-id="' . $document_id[$key] . '">x</a></div>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                    <br/>
                                    <button id="sub_create" type="submit" class="btn btn-circle btn-warning ">UPDATE</button>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                                    <br/>
                                    <a href="<?php echo site_url('/admin/staff-management/absense')?>" class="btn btn-circle btn-warning black">BACK</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .clearfix,.clear{
        clear:both;
    }
    .appenddocument {
        padding: 6px 10px 6px 16px;
        background: #f3f1f1;
        width: 100%;
        margin: 3px 0 3px 0;
        position: relative;
    }
    a.closemyself {
        position: absolute;
        right: 7px;
    }
</style>

<script>
    $(document).ready(function () {
        $('input[name="med_con"]').on('change', function () {
            if ($(this).val() == "1") {
                $("#med_address").show();
            } else {
                $("#med_address").hide();
            }
        })
        $(".delete_self").on('click', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: "<?php echo site_url('/staff_management/delete_document'); ?>",
                data: {document_id: id},
                success: function () {

                }
            });
        });
    });

</script>