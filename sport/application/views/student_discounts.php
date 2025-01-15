<div class="page-content-wrapper">
    <div class="page-content" style="min-height:537.997px">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class="row">
                    <div class="col-md-9">
                        <div class="page-title">DISCOUNT MANAGEMENT</div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo site_url('/admin/discount-management/add-student-discount') ?>" class="btn btn-circle btn-warning">ADD DISCOUNT </a>
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
                                    <th>STUDENT</th>
                                    <th>TERM</th>
                                    <th>CLUB</th>
                                    <th>LEVEL</th>
                                    <th>VENUE</th>
                                    <th>DISCOUNT VALUE</th>
                                    <th>DISCOUNT TYPE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($discounts)) {
                                    foreach ($discounts as $discount) {
                                        ?>
                                        <tr>
                                            <td><?php echo $discount['full_name']; ?></td>
                                            <td><?php echo $discount['term_name']; ?></td>
                                            <td><?php echo $discount['club_name']; ?></td>
                                            <td><?php echo $discount['level_name']; ?></td>
                                            <td><?php echo $discount['venue_name']; ?></td>
                                            <td><?php echo $discount['value']; ?></td>
                                            <td><?php echo $discount['discount_by']; ?></td>
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
</div>