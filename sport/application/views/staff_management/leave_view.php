<html>
<head>
    <title>Leave Application Form</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet" >
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="middle">
        <div class="row">
            <div class="header">
                <div class="logo">
                    <div class="col-md-2 pull-left">
                        <img src="<?php echo site_url('/assets/images/logo_icon_big.png'); ?>"/>
                    </div>
                    <div class="col-md-8 pull-left">
                        <h2>MSA Sports Services LLC</h2>
                        <p>Office 308 Diamond Business Center 1-B 		
                            Al Barsha South Third Dubai UAE PO Box 125335		
                            Tel: +9714 2447848 Email: info@mysportsacademydubai.com 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="gap"></div>
            <h4 class="text-center"><strong>LEAVE APPLICATION FORM</strong></h4>
        </div>
        <div class="gap"></div>
        <div class="row">
            <div class="col-md-12">
                <p><strong>Date : </strong><span style="text-decoration:underline"><?= date('Y-m-d', strtotime($leave_request["created_at"])); ?></span></p>
                <p><strong>Employee Name : </strong><span style="text-decoration:underline"><?= $leave_request["first_name"] . " " . $leave_request["last_name"]; ?></span></p>
                <p><strong>Joining Date : </strong><span style="text-decoration:underline"><?= $leave_request["joining_date"]; ?></span></p>
            </div>
        </div>
        <div class="gap"></div>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Leave Category Requested</strong></p>
                <p><?= strtoupper($leave_request['paid_leave']); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Reason for Leave</strong></p>
                <p><?= ucfirst($leave_request['reason_leave']); ?></p>
            </div>
        </div>
        <div class="gap"></div>
        <div class="row">
            <div class="col-md-12">
                <p>If requiring cover please state the details below: Sessions – Date/Venue/Sport/Level/Person Covering</p>
                <p style="text-decoration: underline;"><?= $leave_request['person_covering']; ?></p>
            </div>
        </div>
        <div class="gap"></div>
        <div class="row">
            <div class="col-md-12">
                <p><strong>Total Leave Days: </strong> <span style="border-bottom: 1px solid #000;text-align: center;width: 300px; display: inline-block;"><?php echo $leave_request['total_leave_day']; ?></span></p>
                <p><strong>Total Leave Days: </strong> <span style="border-bottom: 1px solid #000;text-align: center;width: 150px; display: inline-block;"><?php echo $leave_request['date_leave_from']; ?></span>FROM<span style="border-bottom: 1px solid #000;text-align: center;width: 150px; display: inline-block;"><?php echo $leave_request['date_leave_to']; ?></span></p>
                <p><strong>Address/Tel No. During Leave: </strong> <span style="border-bottom: 1px solid #000;text-align: center;width: 400px; display: inline-block;"><?php echo $leave_request['kin_address']; ?></span></p>
            </div>
        </div>
        <div class="gap"></div>
        <div class="row">
            <div class="col-md-12">
                <p>I hereby agree and confirm to resume duty on <span style="text-decoration:underline"><?= $leave_request["joining_date"]; ?></span>.  I would accept an action that may be initiated by the Company if I fail to report on the said date/s.  </p>
            </div>
        </div>
        <div class="gap"></div>
        <div class="row">
            <div class="col-md-5 add_margin">
                <p><strong>Employee Signature:</strong> <span class="sign">     <?= $leave_request["first_name"] . " " . $leave_request["last_name"]; ?></span> </p>
            </div>
            <div class="col-md-5 add_margin pull-right">
                <p><strong>Management Signature:</strong> <span class="sign"> <?= ($leave_request['status']=="1")?$leave_request['management_sign']:""; ?></span> </p>
            </div>
        </div>
    </div>
    <style>
    .middle {
        margin: 0 auto;
        width: 60%;
        border: 1px solid rgba(0,0,0,0.1);
        overflow: hidden;
        padding: 50px;
    }
    .clear{
        clear:both;
    }
    .gap{
        height:40px;
    }
    span.sign {
        border-bottom: 1px solid #0f0f0f;
        width: 311px;
        display: block;
        padding: 10px 0 0 0;
    }
    .add_margin{
        margin-right: 10px;
    }
</style>

</body>
</html>