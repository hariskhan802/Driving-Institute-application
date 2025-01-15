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
                        <form action="<?php echo site_url('/admin/general-settings/save-news') ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>NEWS</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Latest News</label>
                                            <textarea class="form-control textarea"></textarea>
                                        </div>
                                        <div class="clear clearfix"></div>
                                        <div class="gap"></div>
                                        <div class="col-md-12">
                                            <input type="button" class="btn btn-circle btn-warning " id="add_restriction" value="Add"/>
                                        </div>
                                        <div class="clear clearfix"></div>
                                        <div class="gap"></div>
                                        <div id="append_news" class="col-md-12">
                                            <?php
                                            if (!empty($news)) {
                                                foreach ($news as $new) {
                                                    ?>
                                                    <div class="col-md-12 box_news">
                                                        <p class="col-md-6 pull-left">
                                                            <?php echo $new['description'] ?>
                                                            <input type="hidden" name="news[]" value="<?php echo $new['description'] ?>"/>
                                                        </p>
                                                        <!--<a href="#" class="pull-left"><i class="material-icons">edit</i></a>-->
                                                        <a href="#" class="delete_news pull-left"><i class="material-icons">delete_sweep</i></a>
                                                    </div>
                                                    <div class="clear clearfix"></div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                <button type="submit" class="btn btn-circle btn-warning ">SAVE NEWS</button>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 pull-left">
                                    <a href="<?= site_url('/admin/general-settings/'); ?>" class="btn btn-circle btn-warning black">BACK</a>
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
    .clearfix,.clear{clear:both;}
    .textarea{
        min-height:200px;
    }

</style>
<script>
    $(document).ready(function () {
        $("#add_restriction").on('click', function () {
            var text = $("textarea").val();
            if (text == "") {
                alert("Please enter news");
            } else {
                var elmn = '<div class="col-md-12 box_news">' +
                        '<p class="col-md-6 pull-left">' + text + '</p>' +
                        '<input type="hidden" name="news[]" value="' + text + '"/>' +
                        '<a href="#" class="pull-left delete_news"><i class="material-icons">delete_sweep</i></a>' +
                        '</div>' +
                        '<div class="clear clearfix"></div>';
                $("#append_news").append(elmn);
                $("textarea").val("");
            }
        });
        $("#append_news").on('click', ".delete_news", function () {
            $(this).parents(".box_news").next("div").remove();
            $(this).parents(".box_news").remove();
        });
    });
</script>