var Application = {
    init: function () {
        this.AddLevel();
        this.ProgramUploadFile();
        this.CreateProgram();
        this.AddSession();
        this.DeleteLevel();
        // this.AddSessionWeekRow();
        this.AddFacility();
        this._FacilityAddTime();
    },
    AddLevel: function () {
        $("#add_level_row").on('click', function (e) {
            e.preventDefault();
            var documents      = '';
            var count          = $(".row_list").length;
            var LevelName      = $("#level_name").val();
            var enter_capacity = $("#enter_capacity").val();
            var min_age        = parseInt($("#min_age").val());
            var max_age        = parseInt($("#max_age").val());
            var duration       = $("#duration").val();
            var colorz         = $('#maincolorPanel').colorpicker('getValue');
            if (typeof $("#documents")[0].files[0] != "undefined") {
                documents = $("#documents")[0].files[0].name;
            }
            var document_value = $("#document_url").val();
            if(min_age >= max_age){
                alert("Min Age should be smaller than max age!");
                return;
            }
            var color_flag = false;
            $('input[name^="colors"]').each(function() {
                if(!color_flag){
                    if($(this).val() == colorz) color_flag = true;
                }
            });
            if(color_flag == true){
                alert("Same color can't be picked more than once!");
                return;
            }
            console.log('reached here');
            if (LevelName != '' && enter_capacity != '' && min_age != '' && max_age != '' && duration != '' && colorz != '') {
                console.log('reached here 2');
                var elemn = '<div class="row_list">' +
                '<div class="row">' +
                '<div class="col-lg-2 col-md-2 col-sm-2 col-2">' +
                '<p>' + LevelName + '</p><input type="hidden" name="level_name[]" value="' + LevelName + '"/>' +
                ' </div>' +
                '<div class="col-lg-2 col-md-2 col-sm-2 col-2">' +
                '   <p>' + enter_capacity + '<input type="hidden" name="enter_capacity[]" value="' + enter_capacity + '"/></p>' +
                '</div>' +
                '<div class="col-lg-1 col-md-1 col-sm-1 col-1">' +
                '<p>' + min_age + '<input type="hidden" name="min_age[]" value="' + min_age + '"/></p>' +
                ' </div>' +
                '<div class="col-lg-1 col-md-1 col-sm-1 col-1">' +
                '   <p>' + max_age + '</p><input type="hidden" name="max_age[]" value="' + max_age + '"/>' +
                '</div>' +
                '<div class="col-lg-2 col-md-2 col-sm-2 col-2">' +
                '    <p>' + duration + ' mins <input type="hidden" name="duration[]" value="' + duration + '"/></p>' +
                '</div>' +
                '<div class="col-lg-2 col-md-2 col-sm-2 col-2">' +
                '   <p>' + documents + '</p><input type="hidden" name="document[]" value="' + document_value + '"/>' +
                '</div>' +
                '<div class="col-lg-1 col-md-1 col-sm-1 col-1">' +
                '<div id="colorinput' + count + '" class="input-group colorpicker-component col-md-8 colorpicker-element">' +
                '      <span class="input-group-addon"><i style="background:' + colorz + '"></i><input type="hidden" name="colors[]" value="' + colorz + '"/></span>' +
                ' </div>' +
                '</div>' +
                '<div class="col-lg-1 col-md-1 col-sm-1 col-1">' +
                '   <a href="javascript:void(0)" class="delete_level" data-toggle="tooltip" title="Delete">' +
                '      <i class="fa fa-remove icon-remove"></i>' +
                ' </a>' +
                '</div></div>' +
                '</div>';
                $(".append_list").append(elemn);
                setTimeout(function () {
                    Application.ColorPickerz("#colorinput" + count, colorz);
                });
                $("#level_name").val('');
                $("#enter_capacity").val(0);
                $("#min_age").val(0);
                $("#max_age").val(0);
                $("#duration").val(0);
            }
        });
    },
    ColorPickerz: function (selector, colorz) {
        $(selector).colorpicker({color: colorz});
    },
    DeleteLevel: function () {
        $(".page-content").on('click', ".delete_level", function () {
            $(this).parents(".row_list").remove();
        })
    },
    _encodeImageFileAsURL: function (element, elemn) {
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            $(elemn).val(reader.result);
        }
        reader.readAsDataURL(file);
    },
    ProgramUploadFile: function () {
        $("#documents").on('change', function () {
            Application._encodeImageFileAsURL(this, "#document_url");
        });
    },
    CreateProgram: function () {
        $('select[name="club_dropdown"]').on('change', function () {
            var club_name = this.value;
            if (club_name == 5) {
                $(".holiday_div").hide();
                $(".holiday_div input").attr("required", false);
                $(".holiday_div input").attr("disabled", true);
                $(".holiday_div input").val('');
                $(".sfn").hide();
                $(".sfn input").attr("required", true);
                $(".sfn input").removeAttr("disabled");
                $(".tri_club input").attr("required", true);
                $(".tri_club input").removeAttr("disabled");
                $(".tri_club").show();
            } else if (club_name == 4) {
                $(".holiday_div").show();
                $(".holiday_div input").attr("required", true);
                $(".holiday_div input").removeAttr("disabled");
                $(".sfn").hide();
                $(".sfn input").removeAttr("required");
                $(".sfn input").attr("disabled", true);
                $(".sfn input").val('');
                $(".tri_club").hide();
                $(".tri_club input").removeAttr("required");
                $(".tri_club input").attr("disabled", true);
                $(".tri_club input").val('');
            } else if(club_name == '1' || club_name == '2' || club_name == '3') {
                $(".holiday_div").hide();
                $(".holiday_div input").attr("required", false);
                $(".holiday_div input").attr("disabled", true);
                $(".holiday_div input").val('');
                $(".sfn input").attr("required", true);
                $(".sfn input").removeAttr("disabled");
                $(".sfn").show();
                $(".tri_club").hide();
                $(".tri_club input").removeAttr("required");
                $(".tri_club input").attr("disabled", true);
                $(".tri_club input").val('');
            } else{
                $(".holiday_div").hide();
                $(".holiday_div input").attr("required", false);
                $(".holiday_div input").attr("disabled", true);
                $(".holiday_div input").val('');
                $(".sfn input").attr("required", false);
                $(".sfn input").removeAttr("disabled");
                $(".sfn").hide();
                $(".tri_club").hide();
                $(".tri_club input").removeAttr("required");
                $(".tri_club input").attr("disabled", true);
                $(".tri_club input").val('');
            }
        });
    },
    AddSession: function () {
        $("#add_session").on('click', function () {
            var num_session      = $("#num_session").val();
            var cost_per_session = $("#cost_per_session").val();
            var elemn            = '<div class="col-md-12"><div class="col-md-6 pull-left">' + num_session + '<input type="hidden" name="num_session[]" value="' + num_session + '"/></div><div class="col-md-6 pull-left">' + cost_per_session + '<input type="hidden" name="cost_per_sessions[]" value="' + cost_per_session + '"/></div></div>';
            $("#add_sessions").append(elemn);
        });
    },
    Validation: function (params) {
        for (var key in params) {
            console.log(params[key]);
            if (params[key] == "") {
                alert(key + " field is required");
                delete params[key];
                return false;
            } else {
                return true;
            }
        }
    },
    /*AddSessionWeekRow: function () {
        $('[id^=btnAddSessionDayRow_]').on('click', function (e) {
            e.preventDefault();
            // console.log($('[id^=day_id_]').val());
            // console.log($(this).val() != "");
            console.log($('input[name="day_id"]').val());
            return;
            var day_id             = $('[id^=day_id_]').val();
            var start_hour         = $('select[name="start_hour"]').val();
            var start_min          = $('select[name="start_min"]').val();
            var start_period       = $('select[name="start_period"]').val();
            var end_time           = '';
            var level_session_time = $('input[name="level_session_time"]').val();
            var open_to            = $('select[name="open_to"]').val();
            var staff_id           = $('select[name="staff_id"]').val();
            var start_time         = start_hour + ':'+ start_min + ' ' + start_period;
            var params = {
                Day       : day_id,
                Start_time: start_time,
                Open_to   : open_to,
                Staff     : staff_id,
            };
            console.log(params);
            return;
            var validation = Application.Validation(params);
            if (validation) {
                var elemnt = '<div class="row append_session_day_row_"'+day_id+'>' +
                '<span>' + day_id + '<input type="hidden" name="day_id[]" value="' + day_id + '"/></span>' +
                '<span>' + start_time + '<input type="hidden" name="start_time[]" value="' + start_time + '"/></span>' +
                '<span>' + end_time + '<input type="hidden" name="end_time[]" value="' + end_time + '"/></span>' +
                '<span>' + level_session_time + '<input type="hidden" name="level_session_time[]" value="' + level_session_time + '"/></span>' +
                '<span>' + open_to + '<input type="hidden" name="open_to[]" value="' + open_to + '"/></span>' +
                '<span>' + staff_id + '<input type="hidden" name="staff_id[]" value="' + staff_id + '"/></span>' +
                '<a class="closeme">x</a>' +
                '</div>';
                console.log(elemnt);
                console.log("#appendSessionWeekRow_" + day_id);
                $("#appendSessionWeekRow_" + day_id).append(elemnt);
                // $("#venue_management_form").find("input[type='text']").val('');
                // $("#venue_management_form").find("select").prop('selectedIndex', 0);
                return false;
            }
        });
        /*$(".page-content-wrapper").on('click', ".closeme", function () {
            $(this).parents(".append_facilites").remove();
        })
    },*/
    /*AddSessionWeekRow: function(params){
        console.log(params);
    },*/
    AddFacility: function () {
        $("#add_facilities").on('click', function (e) {
            e.preventDefault();
            var department = $('select[name="department"]').val();
            var departmentSelectd = $('select[name="department"]').find("option:selected").text();
            var status = $('select[name="status"]').val();
            var statusSelected = $('select[name="status"]').find("option:selected").text();
            var size = $('input[name="size"]').val();
            var features = $('input[name="features"]').val();
            var rating = $('input[name="rating"]').val();
            var risk_assessment = $('input[name="risk_assessment"]').val();
            var params = {
                Departments: department,
                Status: status,
                Size: size,
                Features: features,
            };
            var validation = Application.Validation(params);
            if (validation) {
                var elemnt = '<div class="row append_facilites">' +
                '<span>' + departmentSelectd + '<input type="hidden" name="departments[]" value="' + department + '"/></span>' +
                '<span>' + statusSelected + '<input type="hidden" name="statuses[]" value="' + status + '"/></span>' +
                '<span>' + size + '<input type="hidden" name="sizes[]" value="' + size + '"/></span>' +
                '<span>' + features + '<input type="hidden" name="featuress[]" value="' + features + '"/></span>' +
                '<span>' + rating + '<input type="hidden" name="ratings[]" value="' + rating + '"/></span>' +
                '<span>' + risk_assessment + '<input type="hidden" name="risk_assessments[]" value="' + risk_assessment + '"/></span>' +
                '<a class="closeme">x</a>' +
                '</div>';
                $("#add_facility_box").append(elemnt);
                $("#venue_management_form").find("input[type='text']").val('');
                $("#venue_management_form").find("select").prop('selectedIndex', 0);
                return false;
            }
        });
        $(".page-content-wrapper").on('click', ".closeme", function () {
            $(this).parents(".append_facilites").remove();
        })
    },
    _FacilityAddTime: function () {
        $("#add_venue_time").on('click', function () {
            var start_time = $("select[name='venue_start_time']").val();
            var end_time = $("select[name='venue_end_time']").val();
            var start_post = $("select[name='venue_start_post']").val();
            var end_post = $("select[name='venue_end_post']").val();
            var params = {
                StartTime: start_time,
                EndTime: end_time,
            };
            var validation = Application.Validation(params);
            if (validation) {
                var elemnt = '<div class="row append_facilites">' +
                '<span>' + start_time + " " + start_post + '<input type="hidden" name="venue_starts_time" value="' + start_time + " " + start_post + '"/></span>' +
                '<span>' + end_time + " " + end_post + '<input type="hidden" name="venue_ends_time" value="' + end_time + " " + end_post + '"/></span>' +
                '<a href="#" class="closeme">x</a>' +
                '</div>';
                $("#venue_hours").html(elemnt);
                return false;
            }
        });
        $("#add_school_time").on('click', function () {
            var years_group = $("input[name='years_group']").val();
            var start_time = $("select[name='school_start_time']").val();
            var end_time = $("select[name='school_end_time']").val();
            var start_post = $("select[name='school_start_post']").val();
            var end_post = $("select[name='school_end_post']").val();
            var params = {
                years_group: years_group,
                start_time: start_time,
                end_time: end_time,
            };
            var validation = Application.Validation(params);
            if (validation) {
                var elemnt = '<div class="row append_facilites">' +
                '<span>' + years_group + '<input type="hidden" name="years_groups[]" value="' + years_group + '"/></span>' +
                '<span>' + start_time + " " + start_post + '<input type="hidden" name="school_starts_time[]" value="' + start_time + " " + start_post + '"/></span>' +
                '<span>' + end_time + " " + end_post + '<input type="hidden" name="school_ends_time[]" value="' + end_time + " " + end_post + '"/></span>' +
                '<a href="#" class="closeme">x</a>' +
                '</div>';
                $("#school_hours").append(elemnt);
                return false;
            }
        });
        $("#msaschool_time").on('click', function () {
            var select_day = $("select[name='select_day']").val();
            var category = $("select[name='category']").val();
            var msa_start_time = $("select[name='msa_start_time']").val();
            var msa_start_post = $("select[name='msa_start_post']").val();
            var msa_end_time = $("select[name='msa_end_time']").val();
            var msa_end_post = $("select[name='msa_end_post']").val();
            var params = {
                select_day: select_day,
                category: category,
                msa_start_time: msa_start_time,
                msa_end_time: msa_end_time,
            };
            var validation = Application.Validation(params);
            if (validation) {
                var elemnt = '<div class="row append_facilites">' +
                '<span>' + select_day + '<input type="hidden" name="msa_selectday[]" value="' + select_day + '"/></span>' +
                '<span>' + category + '<input type="hidden" name="msa_category[]" value="' + category + '"/></span>' +
                '<span>' + msa_start_time + " " + msa_start_post + '<input type="hidden" name="msa_start_time[]" value="' + msa_start_time + " " + msa_start_post + '"/></span>' +
                '<span>' + msa_end_time + " " + msa_end_post + '<input type="hidden" name="msa_ends_time[]" value="' + msa_end_time + " " + msa_end_post + '"/></span>' +
                '<a href="#" class="closeme">x</a>' +
                '</div>';
                $("#msa_hours").append(elemnt);
                return false;
            }
        });
    }
};
Application.init();