<div class="page-content-wrapper program-creation">
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
    <div class="page-content training-fee" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-7">
                        <div class="page-title">Other Discounts</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body">   
                        <form action="<?php echo site_url('admin/general-settings/save-vat-discount-setting'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="xtra_label">Discounts for all clubs applicable on Training Fees only</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 watt">
                                    <div class="row">
                                        <h3 class="col-md-3">Siblings</h3>
                                        <input type="text" name="sibling_fee" value="" class="col-md-2" placeholder="Enter Discount"/>
                                        <select name="sibling_currency" class="form-control col-md-1">
                                            <option value="AED">AED</option>
                                            <option value="%">%</option>
                                        </select>
                                        <select name="sibling_venue"  class="form-control col-md-4">
                                            <?php print_dropdown(returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'))) ?>
                                        </select>
                                        <button type="button" class="btn btn-circle btn-warning pull-right" id="add_sibiling">ADD</button>
                                    </div>
                                </div>
                                <div id="append_siblings">
                                    <?php
                                    if (!empty($siblings)) {
                                        foreach ($siblings as $sibling) {
                                            ?>
                                            <dixv class="round_box pull-left">
                                                <div class="col-lg-6">
                                                    <span class="mdl-chip mdl-chip--deletable">
                                                        <span class="mdl-chip__text">
                                                            <span class="time">
                                                                <?php echo $sibling['discount'] . " " . $sibling['currency'] . " " . $sibling['venue_id']; ?>
                                                            </span>
                                                        </span>
                                                        <button type="button" data-id="<?= $sibling['id']; ?>" class="mdl-chip__action closeme">
                                                            <i class="material-icons">cancel</i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-md-12 watt">
                                    <div class="row">
                                        <h3 class="col-md-3">Multi-sessions</h3>
                                        <input type="text" value="" name="mulit_fee" class="col-md-2" placeholder="Enter Discount"/>
                                        <select name="mulit_currency" class="form-control col-md-1">
                                            <option value="AED">AED</option>
                                            <option value="%">%</option>
                                        </select>
                                        <select name="mulit_venue" class="form-control col-md-4">
                                            <?php print_dropdown(returnVenues(array('keys' => 'id, venue_name', 'format' => 'dropdown'))) ?>
                                        </select>
                                        <button type="button" class="btn btn-circle btn-warning pull-right" id="add_multi_sesion">ADD</button>
                                    </div>
                                </div>

                                <div id="append_mutli">
                                    <?php
                                    if (!empty($multi_session)) {
                                        foreach ($multi_session as $sibling) {
                                            ?>
                                            <dixv class="round_box pull-left">
                                                <div class="col-lg-6">
                                                    <span class="mdl-chip mdl-chip--deletable">
                                                        <span class="mdl-chip__text">
                                                            <span class="time">
                                                                <?php echo $sibling['discount'] . " " . $sibling['currency'] . " " . $sibling['venue_id']; ?>
                                                            </span>
                                                        </span>
                                                        <button type="button" data-id="<?= $sibling['id']; ?>" class="mdl-chip__action closeme">
                                                            <i class="material-icons">cancel</i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-right">
                                        <button type="submit" class="btn btn-circle btn-warning ">SAVE</button>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-right">
                                        <a href="<?= site_url('admin/dashboard/')?>" class="btn btn-circle btn-warning black">BACK</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
                <!-- end chat sidebar -->
            </div>
        </div>
    </div>
    <!-- end page container -->

    <!-- start footer -->



    <!-- end footer -->

</div>
<style>
.roundbox {
    padding: 24px;
    position: relative;
    border-radius: 20px;
    border: 1px solid #ddd;
    background: #fbed22;
    margin:20px;
}
.ap_fonts{
    font-size:28px;
}
label.xtra_label {
    float: left;
    width: 130px;
    padding: 6px;
    background: #fbed22;

}
.addfont {
    font-size: 19px !important;
    text-align: center;
}
.xtra_input {
    float: left;
    width: 60% !important;
    display: block;
    border-radius: 0px 10px 10px 0px !important;
    padding: 21px !important;
}
.clearfix,.clear{clear:both;}
select[name='sibling_currency'], select[name='mulit_currency'] {
    border-radius: 0px !important;
}
</style>
<script>
    $(document).ready(function () {
        $("#add_sibiling").on('click', function () {
            var inputs = $(this).parents(".watt").find("input,select");
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
                var sibling_fee = $("input[name='sibling_fee']").val();
                var sibling_currency = $("select[name='sibling_currency']").val();
                var sibling_venue = $("select[name='sibling_venue']").val();
                var sibling_text = $("select[name='sibling_venue']").find("option:selected").text();
                var elemn = '<div class="round_box pull-left">'
                + '<div class="col-lg-6">'
                + '<span class="mdl-chip mdl-chip--deletable">'
                + '<span class="mdl-chip__text"><span class="time">'
                + sibling_fee + " " + sibling_currency
                + '<input type="hidden" name="sibling_fees[]" value="' + sibling_fee + '"/> - '
                + sibling_text
                + '<input type="hidden" name="sibling_curr[]" value="' + sibling_currency + '"/><input type="hidden" name="sibling_venues[]" value="' + sibling_venue + '"/>'
                + '</span>'
                + '</span>'
                + '<button type="button" class="mdl-chip__action closeme">'
                + '<i class="material-icons">cancel</i>'
                + '</button>'
                + '</span>'
                + '</div>'
                + '</div>';
                $("#append_siblings").append(elemn);
                $(this).parents(".watt").find("input").val("");
                $(this).parents(".watt").find("select").prop('selectedIndex', 0);
            }
        });
        $("#add_multi_sesion").on('click', function () {
            var inputs = $(this).parents(".matt").find("input,select");
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
                var sibling_fee = $("input[name='mulit_fee']").val();
                var sibling_currency = $("select[name='mulit_currency']").val();
                var sibling_venue = $("select[name='mulit_venue']").val();
                var sibling_text = $("select[name='mulit_venue']").find("option:selected").text();
                var elemn = '<div class="round_box pull-left">'
                + '<div class="col-lg-6">'
                + '<span class="mdl-chip mdl-chip--deletable">'
                + '<span class="mdl-chip__text"><span class="time">'
                + sibling_fee + " " + sibling_currency
                + '<input type="hidden" name="mulit_fees[]" value="' + sibling_fee + '"/> - '
                + sibling_text
                + '<input type="hidden" name="mulit_curr[]" value="' + sibling_currency + '"/><input type="hidden" name="mulit_venues[]" value="' + sibling_venue + '"/>'
                + '</span>'
                + '</span>'
                + '<button type="button" class="mdl-chip__action closeme">'
                + '<i class="material-icons">cancel</i>'
                + '</button>'
                + '</span>'
                + '</div>'
                + '</div>';
                $("#append_mutli").append(elemn);
                $(this).parents(".matt").find("input").val("");
                $(this).parents(".matt").find("select").prop('selectedIndex', 0);
            }
        });

        $(".closeme").on('click', function () {
            var id = $(this).attr("data-id");
            $.ajax({
                type: 'post',
                url: "<?php echo site_url('/discount_management/delete_quick'); ?>",
                data: {id: id},
                success: function (res) {
                    console.log(res);
                }
            });
        })
    });
</script>