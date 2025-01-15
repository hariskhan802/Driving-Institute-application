<div class="page-content-wrapper">
    <div class="page-content" style="min-height:595px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-3">
                        <div class="page-title">Staff Timetable</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">

                    <div class="card-body ">
                        <span class="BlackBox"><h3>MARK</h3></span>
                        <?php
                        if(!empty($timetable)){
                            foreach($timetable as $key=> $table){
                                $color = (isset($table['session']['color']))?$table['session']['color']:"";
                                ?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="yellowBox"><?= $key; ?></span>
                                    </div>
                                    <div class="col-md-9">
                                        <?php 
                                        foreach($table['meta'] as $meta) {
                                            ?>
                                            <span class="box" style="background:<?php echo $color;?>">
                                                <?php echo $meta['start_time'];?> - <?php echo $meta['end_time'];?>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php }}?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end chat sidebar -->
        </div>
        <!-- end page container -->
    </div>
    <style>
    span.yellowBox {
        background: #fbed22;
        padding: 35px;
        display: block;
        text-align: center;
        line-height: 0;
        border-bottom: 2px solid #fff;
    }
    span.BlackBox {
        background: #000;
        padding: 11px;
        display: block;
        text-align: center;
        line-height: 66px;
        border-bottom: 5px solid #fff;
        color: #fff;
    }
    .dulin {
        width: auto;
        height: auto;
        display: inline-block;
        padding: 6px;
        color: #fff;
        float: left;
        margin: 0 0 0 5px;
    }
    span.box {
        padding: 7px;
        font-size: 13px;
        margin: 5px 0 0 4px;
        display: inline-block;
    }
</style>