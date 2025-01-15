<div class="page-content-wrapper">
<div class="page-content" style="min-height:596px">
<div class="page-bar">
<div class="page-title-breadcrumb">
<div class=" pull-left">
<div class="page-title">STUDENT PROFILE</div>
</div>
<?php $gender = array('m' => 'Male', 'f' => 'Female'); ?>
</div>
</div>
<div class="row">
<div class="col-md-12">
<!-- BEGIN PROFILE SIDEBAR -->
<div class="profile-sidebar">
<div class="card card-topline-aqua">
<div class="card-head card-topline-aqua">
<header>About Me</header>
</div>
<div class="card-body no-padding height-9">
<div class="row">
    <div class="profile-userpic">
        <img src="<?php echo site_url("/assets/uploads/profile_pictures/" . $child['photo_path']); ?>" class="img-responsive" alt=""> </div>
    </div>
    <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
            <b>Name</b>
            <div class="profile-desc-item pull-right"><?= $child['firstname'] . " " . $child['lastname'] ?></div>
        </li>

        <li class="list-group-item">
            <b>Phone No</b>
            <div class="profile-desc-item pull-right"><?= $child['contact_number'] ?></div>
        </li>
        <li class="list-group-item">
            <b>Gender</b> <a class="pull-right"><?= $gender[$child['gender']]; ?></a>
        </li>
        <li class="list-group-item">
            <b>Date Of Birth</b> <a class="pull-right"><?= date('d-m-Y', strtotime($child['date_of_birth'])); ?></a>
        </li>
        <li class="list-group-item">
            <b>Age</b> <a class="pull-right"><?= abs(date('Y', strtotime($child['date_of_birth'])) - date('Y')); ?></a>
        </li>
    </ul>
    <!-- END SIDEBAR USER TITLE -->
    <!-- SIDEBAR BUTTONS -->

    <!-- END SIDEBAR BUTTONS -->
</div>
</div>
</div>
<!-- END BEGIN PROFILE SIDEBAR -->
<!-- BEGIN PROFILE CONTENT -->
<div class="profile-content">
<div class="row">
<div class="card col-md-12">
    <div class="card-topline-aqua">

    </div>
    <div class="white-box">
        <!-- Nav tabs -->
        <div class="p-rl-20">
            <ul class="nav customtab nav-tabs" role="tablist">
                <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">About </a></li>
                <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">About Parents</a></li>
                <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">Sessions</a></li>
                <li class="nav-item"><a href="#tab4" class="nav-link" data-toggle="tab">Statistics</a></li>
                <li class="nav-item"><a href="#tab5" class="nav-link" data-toggle="tab">Discounts</a></li>
            </ul>
            <br/>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active fontawesome-demo" id="tab1">
                <div id="biography">
                    <h4 class="font-bold">Medical Condition</h4>
                    <p><?= $child['medical_condition_note']; ?></p>
                    <hr>
                    <h4 class="font-bold">Photography Allowed <span style="background: yellow; color: #000;"><?= $child['photography_allowed']; ?></span></h4>
                    <hr>
                    <h4 class="font-bold">Area of Strength</h4>
                    <p><?= $statistics['strength']; ?></p>
                    <hr>
                    <h4 class="font-bold">Area of Development</h4>
                    <p><?= $statistics['development']; ?></p>
                    <hr>
                    <h4 class="font-bold">Coaches Comments | <?= $coach_comment['coach_name']; ?></h4>
                    <p><?= $statistics['comments']; ?></p>
                </div>
            </div>
            <div class="tab-pane fontawesome-demo" id="tab2">
                <div class="container-fluid">
                    <div class="container-fluid">
                        <div class="row"><h3>PARENTS INFORMATION</h3></div>
                        <div class="row">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Name</b>
                                    <div class="profile-desc-item pull-right"><?= $child['first_name'] . " " . $child['last_name'] ?></div>
                                </li>
                                <li class="list-group-item">
                                    <b>Relationship</b>
                                    <?php
                                    $guradian_type = array(
                                        'm' => 'Mother',
                                        'f' => 'Father',
                                        'g' => 'Guardians',
                                    );
                                    ?>
                                    <div class="profile-desc-item pull-right"><?= $guradian_type[$child['parent_type']]; ?></div>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone No</b>
                                    <div class="profile-desc-item pull-right"><?= "(" . $child['code'] . ") " . $child['contact_number'] ?></div>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="pull-right"><?= $child['address']; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fontawesome-demo" id="tab3">

                <div class="container-fluid">
                    <div class="row">
                        <div class="card card-box">
                            <div class="card-body " id="bar-parent5">
                                <div class="container-fluid">
                                    <div class="row"><h3>SESSIONS BOOKED</h3></div>
                                    <div class="row">
                                        <div class="full-width p-rl-20">
                                            <div class="card card-box">

                                                <div class="card-body " id="bar-parent5">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label>Select Clubs</label>
                                                            <select class="form-control" id="clubs">
                                                                <?= print_dropdown($clubs); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label>Select Programme</label>
                                                            <select class="form-control"  id="program">
                                                                <?= print_dropdown($programs); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label>Select Levels</label>
                                                            <select class="form-control" id="levels">

                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <button class="btn btn-circle btn-warning" type="button" id="search_filter">Search Filter</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="full-width p-rl-20">

                                            <table class="mdl-data-table ml-table-striped ml-table-bordered mdl-js-data-table is-upgraded" data-upgraded=",MaterialDataTable">
                                                <thead>
                                                    <tr>
                                                        <th>CLUB</th>
                                                        <th>PROGRAM</th>
                                                        <th>LEVEL</th>
                                                        <th>TERM</th>
                                                        <th>DAY</th>
                                                        <th>TIME</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="_listings">
                                                    <?php
                                                    if (!empty($sessions)) {
                                                        foreach ($sessions as $session) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $session['club_name']; ?></td>
                                                                <td><?= $session['program_name']; ?></td>
                                                                <td><?= $session['level_name']; ?></td>

                                                                <td><?= $session['term_name']; ?></td>     
                                                                <td><?= $session['day']; ?></td>  
                                                                <td><?= $session['start_time']." ".$session['end_time']; ?></td>                                                        </tr>
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
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fontawesome-demo" id="tab4">
               
                <div class="row">
                    <form method="post" action="<?php echo site_url('/admin/child-management/update_child_review'); ?>">
                        <input type="hidden" name="child_id" value="<?php echo $child_id; ?>">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 pull-left">
                            <label>Select Club</label>
                            <select class="form-control" id="clubs">
                                <?php echo print_dropdown($clubs); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 pull-left">
                            <label>Select Terms</label>
                            <select class="form-control" id="terms">
                                <?php echo print_dropdown($terms); ?>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 pull-left">
                            <label>CURRENT LEVEL</label>
                            <?php 
                            echo $child['level_name']; ?>
                        </div>
                        <div class="gap"></div>
                        <div class="clear clearfix"><br/></div>
                        <div class="col-md-3 pull-left box_ul">
                            <ul>
                                <li>Exceeding</li>
                                <li>Meeting</li>
                                <li>Developing</li>
                                <li>New to this</li>
                            </ul>
                        </div>
                        <div class="col-md-6 pull-left">
                            <div id="chartContainer" style="height: 370px;margin: 0px auto;"></div>
                        </div>

                        <div class="gap"></div>
                        <div class="clear clearfix"></div>
                        <div class="clear clearfix"><br/><br/></div>
                        <div clas="col-md-12">
                            <div class="col-md-7">
                                <label><strong>CHILD'S CURRENT SCORE</strong> (From 1-4)</label>
                            </div>
                            <div class="col-md-12">
                                <div class='box_input'><input type="text" name="n1" value="<?= (int) $statistics['n1'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n2" value="<?= (int) $statistics['n2'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n3" value="<?= (int) $statistics['n3'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n4" value="<?= (int) $statistics['n4'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n5" value="<?= (int) $statistics['n5'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n6" value="<?= (int) $statistics['n6'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n7" value="<?= (int) $statistics['n7'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n8" value="<?= (int) $statistics['n8'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n9" value="<?= (int) $statistics['n9'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                                <div class='box_input'><input type="text" name="n10" value="<?= (int) $statistics['n10'] ?>" maxlength="1" oninput="this.value=this.value.replace(/[^1-4]/g,'');"/></div>
                            </div>
                            <div class="clear clearfix"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label>Area of Strength </label>
                                <input type="text" class="form-control" name="strength" value="" placeholder="Area of Strength ">
                            </div>
                            <div class="col-md-12">
                                <label>Area for Development </label>
                                <input type="text" name="development" class="form-control" value="Butterfly Stroke" name="" placeholder="Area for Development">
                            </div>
                            <div class="col-md-12">
                                <label>Coaches comments </label>
                                <textarea name="comments" class="form-control" placeholder="Coaches comments"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button name="submit" class="btn btn-secondary">Save & Update</button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="attendance" style="height: 300px; width: 100%;"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fontawesome-demo" id="tab5">
                <div class="row discountBox">

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-2 col-3">
                            <label>Select Term</label> 
                            <select class="form-control" id="term_id" name="terms">
                                <?php echo print_dropdown($terms); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-3">
                            <label>Select Club</label> 
                            <select class="form-control" id="club_id" name="clubs">
                                <?php echo print_dropdown($clubs); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-3">
                            <label>Select Levels</label>
                            <select class="form-control" id="program_id" name="programs">
                                <?php echo print_dropdown($levels); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-3">
                            <label>Select Venue</label> 
                            <select class="form-control" id="venue_id" name="venue">
                                <?php echo print_dropdown($venues); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-3">
                            <label>Enter Value</label> 
                            <input type="text" class="form-control" id="enter_value" name="enter_value"/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-3">
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
                        <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                            <button class="btn btn-circle btn-warning Warning" type="button" id="add_venue_discount">Add</button>
                        </div>
                    </div>
                </div>
                <form id="discount_form" action="<?php echo site_url('/admin/discount-management/save-student-discount'); ?>" method="post">
                    <input type="hidden" name="child_id" id="child_idx" value="<?php echo $child_id; ?>">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="panel-body" id="bodys">
                                <?php
     ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                       $ClubsName = array("", "My Swim Club", "My Football Club", "My Tri Club", "My Netball Club", "My Holiday Camps");
                                if (!empty($discounts)) {
                                    foreach ($discounts as $discount) {
                                        ?>
                                        <div class="round_box">
                                            <div class="col-lg-6">
                                                <span class="mdl-chip mdl-chip--deletable">
                                                    <span class="mdl-chip__text">
                                                        <span class="time">

                                                            <?= $discount['term_name']; ?> <input name="terms_id[]" type="hidden" value="<?= $discount['term_id']; ?>">
                                                            - <?= $ClubsName[$discount['club_id']]; ?><input name="clubs_id[]" type="hidden" value="<?= $discount['club_id']; ?>"> 
                                                            - <?= $discount['level_name']; ?><input name="levels_id[]" type="hidden" value="<?= $discount['level_id']; ?>"> 
                                                            - <?= $discount['short_code']; ?> <input name="venues_id[]" type="hidden" value="<?= $discount['venue_id']; ?>"> -
                                                            <input name="students_id[]" type="hidden" value="<?= $discount['student_id']; ?>"> -  <?= $discount['student_id'] . " " . $discount['discount_by']; ?>
                                                            <input name="values[]" type="hidden" value="<?= $discount['value']; ?>">
                                                            <input name="type[]" type="hidden" value="<?= $discount['discount_by']; ?>">
                                                        </span>
                                                    </span>
                                                    <button class="mdl-chip__action closeme" type="button">
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
    </div>
</div>
</div>

</div>
<!-- END PROFILE CONTENT -->
</div>
</div>
</div>

</div>
<script>
$("#search_filter").on('click', function () {
var clubs_id = $("#clubs").val();
var programs_id = $("#program").val();
var levels_id = $("#levels").val();
$.ajax({
type: 'post',
url: "<?= site_url("/child_management/filter_students"); ?>",
data: {club_id: clubs_id, program_id: programs_id, level_id: levels_id, child_id: "<?= $child_id; ?>"},
beforeSend: function () {
$("#_listings").html("");
},
success: function (res) {
$("#_listings").html(res);
}
});
});
$("#program").on('change', function () {
var program_id = $(this).val();
$.ajax({
type: 'post',
url: "<?php echo site_url('/admin/session-management/getprogramlevels') ?>",
data: {program_id: program_id},
success: function (res) {
$("#levels").html(res);
}
});
});</script>

<script>

window.onload = function () {
CanvasJS.addColorSet("greenShades",
[//colorSet Array
rgb2hex("<?= $child['color'] ?>"),
rgb2hex("<?= $child['color'] ?>"),
rgb2hex("<?= $child['color'] ?>"),
rgb2hex("<?= $child['color'] ?>"),
rgb2hex("<?= $child['color'] ?>")
]);
var chart = new CanvasJS.Chart("chartContainer",
{
colorSet:  "greenShades",
axisY:{
title: "",
tickLength: 0,
lineThickness:0,
margin:0,
valueFormatString:" " //comment this to show numeric values
},
data: [
{
type: "column",
dataPoints: [
{x: 1, y: <?= (int) $statistics['n1'] ?>},
{x: 2, y: <?= (int) $statistics['n2'] ?>},
{x: 3, y: <?= (int) $statistics['n3'] ?>},
{x: 4, y: <?= (int) $statistics['n4'] ?>},
{x: 5, y: <?= (int) $statistics['n5'] ?>},
{x: 6, y: <?= (int) $statistics['n6'] ?>},
{x: 7, y: <?= (int) $statistics['n7'] ?>},
{x: 8, y: <?= (int) $statistics['n8'] ?>},
{x: 9, y: <?= (int) $statistics['n9'] ?>},
{x: 10, y: <?= (int) $statistics['n10'] ?>}
]
}
]
});
//        var chart = new CanvasJS.Chart("chartContainer", {
//            animationEnabled: true,
//            theme: "light2", // "light1", "light2", "dark1", "dark2"
//            colorSet: "greenShades",
//            title: {
//                text: ""
//            },
//            axisY: {
//                title: ""
//            },
//            data: [{
//                    type: "bar",
//                    showInLegend: true,
//                    legendMarkerColor: "grey",
////		legendText: "",
//                    dataPoints: [
//                        {label: "Exceeding", y: 1},
//                        {label: "Meeting", y: 2},
//                        {label: "Developing", y: 3},
//                        {label: "New to This", y: 8}
//                    ]
//                }]
//        });
chart.render();
CanvasJS.addColorSet("pieShape",["#000000","#FBED22"]);
var attendance = new CanvasJS.Chart("attendance", {

colorSet:  "pieShape",
animationEnabled: true,
data: [{
type: "pie",
startAngle: 0,
yValueFormatString: "##0.00'%'",
indexLabel: "{label} {y}",

dataPoints: [
{y: 0, label: "PRESENT"},
{y: 1, label: "ABSENT"},
]
}]
});
attendance.render();
}
function rgb2hex(orig) {
var rgb = orig.replace(/\s/g, '').match(/^rgba?\((\d+),(\d+),(\d+)/i);
return (rgb && rgb.length === 4) ? "#" +
("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : orig;
}
</script>

<style>
form {
display: block;
width: 100%;
}
.box_ul li {
list-style: none;
padding: 0px;
height: 70px;
text-align: right;
}
.gap {
height: 20px;
clear: both;
}
.clear{
clear:both;
}
.box_input input {
width: 100%;
background: #fbed22;
border: none;
text-align: center;
height: 100%;
}
.box_ul ul {
margin-top: 67px;
}
.box_input {
float: left;
width: 6%;
margin: 0 0 0 9px;
height: 41px;
}
</style>
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
var inputs = $(this).parents(".discountBox").find("input,select");
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
var term_id = $("#term_id").val();
var term_text = $("#term_id").find("option:selected").text();
var club_id = $("#club_id").val();
var club_text = $("#club_id").find("option:selected").text();
var program_id = $("#program_id").val();
var program_text = $("#program_id").find("option:selected").text();
var venue_id = $("#venue_id").val();
var venue_text = $("#venue_id").find("option:selected").text();
var student_id = $("#child_idx").val();
var value = $('#enter_value').val();
var discount = $('#discount_type').val();
var elemn = '<div class="round_box">'
+ '<div class="col-lg-6">'
+ '<span class="mdl-chip mdl-chip--deletable">'
+ '<span class="mdl-chip__text"><span class="time">'
+ term_text
+ '<input type="hidden" name="terms_id[]" value="' + term_id + '"/> - '
+ club_text
+ '<input type="hidden" name="clubs_id[]" value="' + club_id + '"/> - '
+ program_text
+ '<input type="hidden" name="levels_id[]" value="' + program_id + '"/> - '
+ venue_text
+ '<input type="hidden" name="venues_id[]" value="' + venue_id + '"/> - '
+ '<input type="hidden" name="students_id[]" value="' + student_id + '"/> - '
+ value + " " + discount
+ '<input type="hidden" name="values[]" value="' + value + '"/>'
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
$(this).parents(".discountBox").find("input").val("");
$(this).parents(".discountBox").find("select").prop('selectedIndex', 0);
}
});

</script>