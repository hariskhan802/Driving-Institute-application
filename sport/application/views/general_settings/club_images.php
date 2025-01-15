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
    <div class="page-content" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-7">
                        <div class="page-title">GENERAL SETTINGS</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body">   
                        <form action="<?php echo site_url('/admin/general-settings/save-club-images');  ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label class="xtra_label addfont" style="background:<?php echo (!empty($swim_club['image_path']))? $swim_club['color']:""; ?>">SWIM</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="maincolorPaneloo" class="col-md-1 pull-left input-group colorpicker-component colorpicker-element">
                                        <span class="input-group-addon"><i style="background-color: rgb(170, 51, 153);"></i></span>
                                        <input type="hidden" name="swim_color" value="rgb(170, 51, 153)"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <label>Club Image</label>
                                        <input name="swim_upload" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($swim_club['image_path']))?site_url('/assets/uploads/clubs/').$swim_club['image_path']:""; ?>" class="thumbnail"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <label>Club Logo</label>
                                        <input name="swim_upload_header" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($swim_club['helper_text_image']))?site_url('/assets/uploads/clubs/').$swim_club['helper_text_image']:""; ?>" class="thumbnail"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="xtra_label addfont" style="background:<?php echo (!empty($football_club['image_path']))? $football_club['color']:""; ?>">FOOTBALL</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="maincolorPaneloo1" class="col-md-1 pull-left input-group colorpicker-component colorpicker-element">
                                        <span class="input-group-addon"><i style="background-color: rgb(170, 51, 153);"></i></span>
                                        <input type="hidden" name="football_color" value="rgb(170, 51, 153)"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <label>Club Image</label>
                                        <input name="football_upload" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($football_club['image_path']))?site_url('/assets/uploads/clubs/').$football_club['image_path']:""; ?>" class="thumbnail"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <label>Club Logo</label>
                                        <input name="football_upload_header" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($football_club['helper_text_image']))?site_url('/assets/uploads/clubs/').$football_club['helper_text_image']:""; ?>" class="thumbnail"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="xtra_label addfont" style="background:<?php echo (!empty($netball_club['image_path']))? $netball_club['color']:""; ?>">NETBALL</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="maincolorPaneloo2" class="col-md-1 pull-left input-group colorpicker-component colorpicker-element">
                                        <span class="input-group-addon"><i style="background-color: rgb(170, 51, 153);"></i></span>
                                        <input type="hidden" name="netball_color" value="rgb(170, 51, 153)"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="netball_upload" class="documents" size="30" type="file"/>

                                        <img src="<?php echo (!empty($netball_club['image_path']))?site_url('/assets/uploads/clubs/').$netball_club['image_path']:""; ?>" class="thumbnail"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <label>Club Logo</label>
                                        <input name="netball_upload_header" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($netball_club['helper_text_image']))?site_url('/assets/uploads/clubs/').$netball_club['helper_text_image']:""; ?>" class="thumbnail"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="xtra_label addfont" style="background:<?php echo (!empty($tri_club['image_path']))? $tri_club['color']:""; ?>">TRI</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="maincolorPaneloo3" class="col-md-1 pull-left input-group colorpicker-component colorpicker-element">
                                        <span class="input-group-addon"><i style="background-color: rgb(170, 51, 153);"></i></span>
                                        <input type="hidden" name="tri_color" value="rgb(170, 51, 153)"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="tri_upload" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($tri_club['image_path']))?site_url('/assets/uploads/clubs/').$tri_club['image_path']:""; ?>" class="thumbnail"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <label>Club Logo</label>
                                        <input name="tri_upload_header" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($tri_club['helper_text_image']))?site_url('/assets/uploads/clubs/').$tri_club['helper_text_image']:""; ?>" class="thumbnail"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="xtra_label addfont" style="background:<?php echo (!empty($holiday_club['image_path']))? $holiday_club['color']:""; ?>">HOLIDAY</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="maincolorPaneloo4" class="col-md-1 pull-left input-group colorpicker-component colorpicker-element">
                                        <span class="input-group-addon"><i style="background-color: rgb(170, 51, 153);"></i></span>
                                        <input type="hidden" name="holiday_color" value="rgb(170, 51, 153)"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <input name="holiday_upload" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($holiday_club['image_path']))?site_url('/assets/uploads/clubs/').$holiday_club['image_path']:""; ?>" class="thumbnail"/>
                                    </div>
                                    <div class="image_show col-md-6 pull-left"  data-date-format="dd MM yyyy" data-date="2013-02-21T15:25:00Z">
                                        <label>Club Logo</label>
                                        <input name="holiday_upload_header" class="documents" size="30" type="file"/>
                                        <img src="<?php echo (!empty($holiday_club['helper_text_image']))?site_url('/assets/uploads/clubs/').$holiday_club['helper_text_image']:""; ?>" class="thumbnail"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-2 pull-left">
                                    <button type="submit" class="btn btn-circle btn-warning ">SAVE CLUB</button>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                    <a href="<?= site_url('/admin/general-settings/'); ?>" class="btn btn-circle btn-warning black">BACK</a>
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
.image_show {
    border: 1px solid #ddd;
    padding: 2px;
}
img.thumbnail {
    width: 10%;
    float: right;
}
.clearfix,.clear{clear:both;}

</style>

<script>
    $(document).ready(function(){
        $(".documents").on('change', function () {
            _encodeImageFileAsURL(this, ".image_show");
        });

        $('#maincolorPaneloo').colorpicker({ 
            color: "<?= $swim_club['color']?>", 
            format: "rgb",

        }).on('changeColor.colorpicker', function(event){
            if(typeof event.value !='undefined')
                $('input[name="swim_color"]').val(event.value)
        });
        $('#maincolorPaneloo1').colorpicker({ color: "<?= $football_club['color']?>", format: "rgb"}).on('changeColor.colorpicker', function(event){
            if(typeof event.value !='undefined')
                $('input[name="football_color"]').val(event.value)
        });
        $('#maincolorPaneloo2').colorpicker({ color: "<?= $netball_club['color']?>", format: "rgb"}).on('changeColor.colorpicker', function(event){
            if(typeof event.value !='undefined')
                $('input[name="netball_color"]').val(event.value)
        });; 
        $('#maincolorPaneloo3').colorpicker({ color: "<?= $tri_club['color']?>", format: "rgb"}).on('changeColor.colorpicker', function(event){
            if(typeof event.value !='undefined')
                $('input[name="tri_color"]').val(event.value)
        });; 
        $('#maincolorPaneloo4').colorpicker({ color: "<?= $holiday_club['color']?>", format: "rgb"}).on('changeColor.colorpicker', function(event){
            if(typeof event.value !='undefined')
                $('input[name="holiday_color"]').val(event.value)
        });;

    });
    function _encodeImageFileAsURL(element, elemn) {
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            $(element).parents(".image_show").find("img").attr('src',reader.result);
        }
        reader.readAsDataURL(file);
    }
</script>