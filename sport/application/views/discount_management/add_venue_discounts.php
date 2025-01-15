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
                <div class="pull-left">
                    <div class="page-title">
                        VENUE DISCOUNT MANAGEMENT
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-box">
            <div class="card-body" id="bar-parent5">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Term</label> 
                        <select class="form-control" id="term_id" name="terms">
                            <?php echo print_dropdown($terms); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Club</label> 
                        <select class="form-control" id="club_id" name="clubs">
                            <?php echo print_dropdown($clubs); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Programme</label>
                        <select class="form-control" id="program_id" name="programs">
                            <?php echo print_dropdown($programs); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Select Venue</label> 
                        <select class="form-control" id="venue_id" name="venue">
                            <?php echo print_dropdown($venues); ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Enter Value</label> 
                        <input type="text" class="form-control" id="enter_value" name="enter_value"/>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                        <label>Discount Type</label>
                        <select class="form-control" name="discount_type" id="discount_type">
                            <option value="">Select Discount Type</option>
                            <option value="%">
                                Percentage ( % )
                            </option>
                            <option value="fixed">
                                Fixed
                            </option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-circle btn-warning Warning" type="button" id="add_venue_discount">Add</button>
            </div>
        </div>
        <form id="discount_form" action="<?php echo site_url('/admin/discount-management/save-venue-discount'); ?>" method="post">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card-box">
                        <div class="card-body">
                            <div class="panel-body" id="bodys"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="pull-right">
                        <button class="btn btn-circle btn-warning Warning" type="submit" id="submit_check">SAVE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $("#discount_form").on('submit', function (e) {

        var inputs = $(this).find("input").length;
        if (inputs < 1) {
            alert("Please add discount");
            return false;
        } else {
            return true;
        }
    })
    $("#add_venue_discount").on('click', function () {
        var inputs = $(this).parents("#bar-parent5").find("input,select");
        var that = $(this);
        var isValid = true;
        $.each(inputs, function () {
            var currentInput = $(this).val();
            if (currentInput == "") {
                alert($(this).attr("name").replace("_", " ").toUpperCase() + " required");
                isValid = false;
                return false;
            }
        });
        if (isValid) {
            var values = '';
            var term_id = $("#term_id").val();
            var term_text = $("#term_id").find("option:selected").text();
            var club_id = $("#club_id").val();
            var club_text = $("#club_id").find("option:selected").text();
            var program_id = $("#program_id").val();
            var program_text = $("#program_id").find("option:selected").text();
            var venue_id = $("#venue_id").val();
            var venue_text = $("#venue_id").find("option:selected").text();
            var value = $('#enter_value').val();

            var discount = $('#discount_type').val();

            if (discount == "fixed") {
                values = value + " " + "AED";
            } else {
                values = value;
            }
            var elemn = '<div class="round_box">'
                    + '<div class="col-lg-6">'
                    + '<span class="mdl-chip mdl-chip--deletable">'
                    + '<span class="mdl-chip__text"><span class="time">'
                    + term_text
                    + '<input type="hidden" name="terms_id[]" value="' + term_id + '"/> - '
                    + club_text
                    + '<input type="hidden" name="clubs_id[]" value="' + club_id + '"/> - '
                    + program_text
                    + '<input type="hidden" name="programs_id[]" value="' + program_id + '"/> - '
                    + venue_text
                    + '<input type="hidden" name="venues_id[]" value="' + venue_id + '"/> - '
                    + values + " " + discount
                    + '<input type="hidden" name="values[]" value="' + values + '"/>'
                    + '<input type="hidden" name="type[]" value="' + discount + '"/>'
                    + '</span>'
                    + '</span>'
                    + '<button type="button" class="mdl-chip__action closeme">'
                    + '<i class="material-icons">cancel</i>'
                    + '</button>'
                    + '</span>'
                    + '</div>'
                    + '</div>';
            $("#bodys").append(elemn);
            $(this).parents("#bar-parent5").find("input").val("");
            $(this).parents("#bar-parent5").find("select").prop('selectedIndex', 0);
        }
    });

</script>