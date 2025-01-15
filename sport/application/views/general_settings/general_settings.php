<div class="page-content-wrapper program-creation">
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
                <div class="card-box gnset">
                    <div class="card-body">   
                        <div class="row">
                            <div class="roundbox col-xs-6 col-sm-3 text-center text-bold">
                                <i class="material-icons ap_fonts">loyalty</i>
                                <h3><a href="<?= site_url('/admin/general-settings/vat-discount-setting'); ?>">VAT</a></h3>

                            </div>
                            <div class="roundbox col-xs-6 col-sm-3 text-center text-bold">
                                <i class="material-icons ap_fonts">note_add</i>
                                <h3><a href="<?= site_url('/admin/general-settings/terms-duration'); ?>">TERM DURATIONS</a></h3>
                            </div>
                            <div class="roundbox col-xs-6 col-sm-3 text-center text-bold">
                                <i class="material-icons ap_fonts">photo_library</i>
                                <h3><a href="<?= site_url('/admin/general-settings/club-images'); ?>">CLUB IMAGES</a></h3>
                            </div>
                            <div class="roundbox col-xs-6 col-sm-3 text-center text-bold">
                                <i class="material-icons ap_fonts">not_interested</i>
                                <h3><a href="<?= site_url('/admin/general-settings/restriction'); ?>">RESTRICTIONS</a></h3>
                            </div>
                            <div class="roundbox col-xs-6 col-sm-3 text-center text-bold">
                                <i class="material-icons ap_fonts">notifications_active</i>
                                <h3><a href="<?= site_url('/admin/general-settings/notification'); ?>">NOTIFICATIONS</a></h3>
                            </div>
                            <div class="roundbox col-xs-6 col-sm-3 text-center text-bold">
                                <i class="material-icons ap_fonts">rss_feed</i>
                                <h3><a href="<?= site_url('/admin/general-settings/news'); ?>">NEWS</a></h3>
                            </div>
                            <div class="roundbox col-xs-6 col-sm-3 text-center text-bold">
                                <i class="material-icons ap_fonts">description</i>
                                <h3><a href="<?= site_url('/admin/general-settings/terms-condition'); ?>">TERMS & CONDITION</a></h3>
                            </div>
                            <div class="roundbox col-xs-6 col-sm-3 text-center text-bold">
                                <i class="material-icons ap_fonts">attach_money</i>
                                <h3>
                                    <a href="<?= site_url('/admin/general-settings/price-list'); ?>">PRICE LIST</a>
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end chat sidebar -->
            </div>
        </div>
    </div>
    <!-- end page container -->


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
    .roundbox h3 a{
        color:#000;
        text-decoration: none;
    }
</style>