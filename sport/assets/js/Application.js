var Application = {
    init: function () {
        this.AddLevel();
        this.ProgramUploadFile();
        this.CreateProgram();
        this.AddSession();
        this.DeleteLevel();
        this.AddFacility();
        this._FacilityAddTime();
        this.AddDocumentStaff();
        this.SaveAbsense();
        this.SessionModule();
        this.SessionHolidayCamp();
    },
    AddLevel: function () {
        $("#addrow").on('click', function (e) {
            e.preventDefault();
            var documents = '';
            var documents_name = '';
            var count = $(".row_list").length;
            var LevelName = $("#level_name").val();
            var enter_capacity = $("#enter_capacity").val();
            var min_age = $("#min_age").val();
            var max_age = $("#max_age").val();
            var duration = $("#duration").val();
            var colorz = $('#maincolorPanel').colorpicker('getValue');
            var viewLInk = '';
            if (typeof $("#documents")[0].files[0] != "undefined") {
                documents = $("#documents")[0].files[0].name;
            }
            var document_value = $("#document_url").val();
            if (LevelName != '' && enter_capacity != '' && min_age != '' && max_age != '' && duration != '' && colorz != '') {
                if (document_value != "") {
                    viewLInk = '<p><a href="' + document_value + '" target="_blank">View Link</a></p>';
                } else {
                    viewLInk = '<p>No File</p>';
                }
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
                        viewLInk + '<input type="hidden" name="document[]" value="' + document_value + '"/><input type="hidden" name="documentname[]" value="' + documents + '"/>' +
                        '</div>' +
                        '<div class="col-lg-1 col-md-1 col-sm-1 col-1">' +
                        '<div id="" class="input-group colorpicker-component col-md-8 colorpicker-element">' +
                        '      <span class="input-group-addon"><i style="background:' + colorz + '"></i><input type="hidden" name="colors[]" value="' + colorz + '"/></span>' +
                        ' </div>' +
                        '</div>' +
                        '<div class="col-lg-1 col-md-1 col-sm-1 col-1">' +
                        '   <a href="javascript:void(0)" class="delete_level" data-toggle="tooltip" title="Delete">' +
                        '      <i class="fa fa-remove icon-remove"></i>' +
                        ' </a>' +
                        '</div></div>' +
                        '</div>';
                var isValid = true;
                $(".append_list").find("input[name='colors[]']").each(function () {
                    if ($(this).val() == colorz) {
                        alert("This color is already assigned.Please Choose different color");
                        isValid = false;
                        return false;
                    }
                });
                if (isValid) {
                    $(".append_list").append(elemn);
                    setTimeout(function () {
                        Application.ColorPickerz("#colorinput" + count, colorz);
                    });
                    $(".row.levels").find("input").val("");
                    $(".row.levels").find(".filename").text("");

                }
                console.log(elemn);
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
    _encodeImageFileAsURLAppend: function (element, elemn) {
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            var formates = "<input type='hidden' name='documentsImage[]' value='" + reader.result + "'/>";
            $(elemn).append(formates);
        }
        reader.readAsDataURL(file);
    },
    ProgramUploadFile: function () {
        $("#documents").on('change', function () {
            $("span.filename").text($(this)[0].files[0].name);
            $("#document_name").val($(this)[0].files[0].name);
            Application._encodeImageFileAsURL(this, "#document_url");
        });
    },
    CreateProgram: function () {
        $('select[name="club"]').on('change', function () {
            var club = $(this).find("option:selected").attr("data-name");
            if (club == "holiday") {
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
                $("input[name='per_day_cost']").removeAttr("required");
            } else if (club == "tri") {
                $(".holiday_div").hide();
                $(".holiday_div input").attr("required", false);
                $(".holiday_div input").attr("disabled", true);
                $(".holiday_div input").val('');


                $(".sfn").hide();
                $(".sfn input").removeAttr("required");
                $(".sfn input").attr("disabled", true);

                $(".sfn input").val("");

                $(".tri_club").show();
                $(".tri_club input").attr("required", true);
                $(".tri_club input").removeAttr("disabled");
                $("input[name='competition_fee']").removeAttr("required");
            } else {
                $(".holiday_div").hide();
                $(".holiday_div input").attr("required", false);
                $(".holiday_div input").attr("disabled", true);
                $(".holiday_div input").val('');

                $(".sfn input").attr("required", true);
                $("input[name='competition_fee']").removeAttr("required");
                $(".sfn input").removeAttr("disabled");
                $(".sfn").show();

                $(".tri_club").hide();
                $(".tri_club input").removeAttr("required");
                $(".tri_club input").attr("disabled", true);
                $(".tri_club input").val('');
            }
        });
    },
    AddSession: function () {
        $("#add_session").on('click', function () {


            var num_session = $("#num_session").val();
            var cost_per_session = $("#cost_per_session").val();
            var elemn = '<div class="col-md-12 session_program"><a href="javascript:;" class="closeMe">X</a><div class="col-md-2 pull-left">' + num_session + '<input type="hidden" name="num_session[]" value="' + num_session + '"/></div><div class="col-md-2 pull-left">' + cost_per_session + '<input type="hidden" name="cost_per_sessions[]" value="' + cost_per_session + '"/></div></div>';
            $("#add_sessions").append(elemn);
            $("#num_session").val('');
            $("#cost_per_session").val('');
            var session = $("#add_sessions").find(".session_program").length;
            if (session > 0) {
                $("#num_session").removeAttr("required");
                $("#cost_per_session").removeAttr("required");
            }
        });
        $(".card-body").on('click', ".closeMe", function () {
            $(this).parents(".round_box").remove();
            $(this).parents(".col-lg-4").remove();
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
    AddFacility: function () {
        $("#add_facilities").on('click', function (e) {
            e.preventDefault();
            var department = $('select[name="Facility"]').val();
            var departmentSelectd = $('select[name="Facility"]').find("option:selected").text();
            var status = $('select[name="status"]').val();
            var statusSelected = $('select[name="status"]').find("option:selected").text();
            var size = $('input[name="size"]').val();
            var measure = $('#sizes').val();
            var features = $('input[name="features"]').val();
            var rating = $('input[name="rating"]:checked').val();
            var risk_assessment = $('input[name="risk_assessment"]:checked').val();
            var inputs = $(this).parents(".day-select").find("input,select");
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
            if (!$('input[name="risk_assessment"]').is(":checked")) {
                alert("Please select risk assessment");
                isValid = false;
                return false;
            }
            if (!$('input[name="rating"]').is(":checked")) {
                alert("Please select rating");
                isValid = false;
                return false;
            }
            if (isValid) {
                var elemn = '<div class="round_box">' +
                        '<div class="col-lg-6">' +
                        '<span class="mdl-chip mdl-chip--deletable">' +
                        '<span class="mdl-chip__text">' +
                        '<span class="time">' +
                        departmentSelectd + '<input type="hidden" name="departments[]" value="' + department + '"/> | ' +
                        statusSelected + '<input type="hidden" name="statuses[]" value="' + status + '"/> | ' +
                        size + " " + measure + '<input type="hidden" name="sizes[]" value="' + size + '"/><input type="hidden" name="measure[]" value="' + measure + '"/> | ' +
                        features + '<input type="hidden" name="featuress[]" value="' + features + '"/> | ' +
                        rating + '<input type="hidden" name="ratings[]" value="' + rating + '"/> | ' +
                        risk_assessment + '<input type="hidden" name="risk_assessments[]" value="' + risk_assessment + '"/>' +
                        '</span>' +
                        '</span>' +
                        '<button type="button" class="mdl-chip__action closeme">' +
                        '<i class="material-icons">cancel</i>' +
                        '</button>' +
                        '</span>' +
                        '</div>' +
                        '</div>';
                $("#add_facility_box1").append(elemn);
                $("#venue_management_form").find("input[type='text']").val('');
                $("#venue_management_form").find("select").prop('selectedIndex', 0);
                return false;
            }
        });

        $(".page-content-wrapper").on('click', ".closeme", function () {
            $(this).parents(".append_facilites").remove();
            $(this).parents(".round_box").remove();
            $(this).parents(".result-assessment").remove();
            $(this).parents(".delete_us ").remove();
        })
    },
    _FacilityAddTime: function () {
        $("#add_venue_time").on('click', function () {
            var start_merdian = $("#venuestart_merdian").val();
            var end_merdian = $("#venueend_merdian").val();
            var start_time = $("input[name='venue_start_time']").val();
            var end_time = $("input[name='venue_end_time']").val();
            var inputs = $(this).parents(".venue_hours_box").find("input,select");
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
                var elemn = '<div class="round_box"><div class="col-lg-6"><span class="mdl-chip mdl-chip--deletable"><span class="mdl-chip__text"><span class="time">' + start_time + " " + start_merdian + '<input type="hidden" name="venue_starts_time[]" value="' + start_time + " " + start_merdian + '"/> - ' + end_time + " " + end_merdian + '<input type="hidden" name="venue_ends_time[]" value="' + end_time + " " + end_merdian + '"/></span></span><button type="button" class="mdl-chip__action closeme"><i class="material-icons">cancel</i></button></span></div></div>';
                $("#venue_hours").append(elemn);
                $(this).parents(".venue_hours_box").find("input").val("");
            }
        });

        $("#add_school_time").on('click', function () {
            var start_merdian = $("#schoolstart_merdian").val();
            var end_merdian = $("#schoolend_merdian").val();
            var years_group = $("input[name='years_group']").val();
            var start_time = $("input[name='school_start_time']").val();
            var end_time = $("input[name='school_end_time']").val();
            var inputs = $(this).parents(".school_hours_box").find("input,select");
            var that = $(this);
            var isValid = true;
            $.each(inputs, function () {
                var currentInput = $(this).val();
                if (currentInput == "") {
                    alert($(this).attr("name").replace("_", " ").toUpperCase() + " required");
                    isValid = false;
                }

            });
            if (isValid) {
                var elemn = '<div class="round_box"><div class="col-lg-6"><span class="mdl-chip mdl-chip--deletable"><span class="mdl-chip__text"><span class="time">' + years_group + ' <input type="hidden" name="years_groups[]" value="' + years_group + '"/> - ' + start_time + " " + start_merdian + '<input type="hidden" name="school_starts_time[]" value="' + start_time + " " + start_merdian + '"/> - ' + end_time + " " + end_merdian + '<input type="hidden" name="school_ends_time[]" value="' + end_time + " " + end_merdian + '"/></span></span><button type="button" class="mdl-chip__action closeme"><i class="material-icons">cancel</i></button></span></div></div>';
                $("#school_hours").append(elemn);
                $(this).parents(".school_hours_box").find("input").val("");
            }
        });

        $("#msaschool_time").on('click', function () {
            var start_merdian = $("#msastart_merdian").val();
            var end_merdian = $("#msaend_merdian").val();

            // alert(start_merdian + " "+ end_merdian);
            var select_day = $("select[name='select_day']").val();
            var select_day_text = $("select[name='select_day']").find("option:selected").text();
            var category = $("select[name='category']").val();
            var category_text = $("select[name='category']").find("option:selected").text();
            var msa_start_time = $("input[name='msa_start_time']").val();
            var msa_end_time = $("input[name='msa_end_time']").val();
            var inputs = $(this).parents(".msaaccess_hours").find("input,select");
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
                var elemn = '<div class="round_box"><div class="col-lg-6"><span class="mdl-chip mdl-chip--deletable"><span class="mdl-chip__text"><span class="time">' + select_day_text + ' | <input type="hidden" name="msa_selectday[]" value="' + select_day + '"/> ' + category_text + ' | <input type="hidden" name="msa_category[]" value="' + category + '"/> ' + msa_start_time + " " + start_merdian + '<input type="hidden" name="msa_start_time[]" value="' + msa_start_time + " " + start_merdian + '"/> - ' + msa_end_time + " " + end_merdian + '<input type="hidden" name="msa_ends_time[]" value="' + msa_end_time + " " + end_merdian + '"/> </span></span><button type="button" class="mdl-chip__action closeme"><i class="material-icons">cancel</i></button></span></div></div>';
                $("#msa_hours").append(elemn);
                $(".msaaccess_hours").find(".form_time").find("input").val("");
            }

        });
    },
    AddDocumentStaff: function () {
        $("#multipleUpload").on('change', function (e) {
            Application._encodeImageFileAsURLAppend(this, "#append_document");
            var valuex = $(this)[0].files[0].name;
            $("#append_document").append("<div class='appenddocument'>" + valuex + "<a class='closemyself'>x</a></div>");
        });

        $("#bar-parent").on('click', ".closemyself", function () {
            $(this).parents(".appenddocument").next("input").remove();
            $("#multipleUpload").val('');
            $(this).parents(".appenddocument").remove();
        });
        $(".modal").on('click', ".closemyself", function () {
            $(this).parents(".appenddocument").remove();
        });

    },
    SaveAbsense: function () {
        $(".view_absense").on('click', function () {
            var staff_id = $(this).attr("data-id");
            $("#pop_staff_id").val(staff_id);
        });
        $("#save_absense").on('click', function (e) {
            e.preventDefault();
            var documentsImage = [];
            var staff_id = $('#pop_staff_id').val();
            var startDate = $('input[name="startDate"]').val();
            var endDate = $('input[name="endDate"]').val();
            var reason = $('textarea[name="reason"]').val();

            $('input[name="documentsImage[]"]').each(function (i) {
                documentsImage[i] = $('input[name="documentsImage[]"]').eq(i).val();
            });
            if (startDate == "") {
                alert("StartDate field is required");
            } else if (endDate == "") {
                alert("EndDate field is required");
            } else if (reason == "") {
                alert("Reason field is required");
            } else {
                $.ajax({
                    type: 'post',
                    url: staffAbsense,
                    data: {staff_id: staff_id, startDate: startDate, endDate: endDate, reason: reason, documentsImage: documentsImage},
                    success: function (res) {
                        $(".staff_absense_" + staff_id).append("<span class='squarebox'><a href='#' class='getAbsense' data-id='" + staff_id + "'>" + res + "</a></span>");
                        $("#pop_up").find("input,textarea").val("");
                        $("#pop_up").find("#append_document").html("");
                        window.location.reload();
                    }
                });
            }
        });
    },
    SessionModule: function () {
        $(".by_day_btn").on('click', function () {
            var inputs = $(this).parents(".by_day_select").find("input,select");
            var dayName = $(this).parents(".by_day_select").attr("data-day");
            var start_date = $(this).parents(".by_day_select").find('input[name="start_date"]').val();
            var dayID = $(this).parents(".by_day_select").attr("data-day_id");
            var ProgramArea = $(this).parents(".by_day_select").find('select[name="program_area"]').val();
            var ProgramAreaText = $(this).parents(".by_day_select").find('select[name="program_area"]').find("option:selected").text();
            var staff = $(this).parents(".by_day_select").find('select[name="assign_staff"]').val();
            var staffText = $(this).parents(".by_day_select").find('select[name="assign_staff"]').find("option:selected").text();
            var startTime = $(this).parents(".by_day_select").find('input[name="start_time"]').val();
            var endTime = $(this).parents(".by_day_select").find('input[name="end_time"]').val();
            var start_merdian = $(this).parents(".by_day_select").find('select[name="start_merdian"]').val();
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
                $.ajax({
                    type: 'post',
                    url: check_session,
                    data: {class: 'day', startDate: start_date, day_id: dayID, start_time: startTime + " " + start_merdian, end_time: endTime, coach_id: staff},
                    success: function (res) {
                        if (res == 1) {
                            //swal("Notice!", "This session is already assigned", "warning");
                            swal("Notice!", "This session is already assigned", "warning");
                            return false;
                        } else {
                            var elmn = '<div class="col-lg-4 delete_us">' +
                                    '<span class="mdl-chip mdl-chip--deletable">' +
                                    '<span class="mdl-chip__text">' +
                                    '<span class="time">' + dayName + ' | <input type="hidden" name="startDates[]" value="' + start_date + '"><input type="hidden" name="day[]" value="' + dayID + '"><input type="hidden" name="day_name[]" value="' + dayName + '"> ' + ProgramAreaText + ' | <input type="hidden" name="program_areas[]" value="' + ProgramArea + '">  ' + staffText + ' <input type="hidden" name="staff[]" value="' + staff + '">  - ' + startTime + " " + start_merdian + '<input type="hidden" name="starts_time[]" value="' + startTime + " " + start_merdian + '"> - ' + endTime + '<input type="hidden" name="ends_time[]" value="' + endTime + '">' +
                                    '</span>' +
                                    '</span>' +
                                    '<button type="button" class="mdl-chip__action closeme">' +
                                    '<i class="material-icons">cancel</i>' +
                                    '</button>' +
                                    '</span>' + '</div>';


                            var isValids = true;
                            $(document).find('input[name="program_areas[]"]').each(function (i) {

                                var day = $(document).find("input[name='day[]']").eq(i).val();
                                var program_areas = $(this).val();
                                var staffs = $(document).find("input[name='staff[]']").eq(i).val();
                                var starts_time = $(document).find("input[name='starts_time[]']").eq(i).val();
                                var ends_time = $(document).find("input[name='ends_time[]']").eq(i).val();
                                if (day == dayID && program_areas == ProgramArea && staffs == staff && starts_time == startTime + " " + start_merdian && ends_time == endTime) {
                                    swal("Notice!", "This session is already assigned", "warning");
                                    isValids = false;
                                }
                            });

                            if (isValids) {
                                that.parents(".by_day_select").find(".by_days").append(elmn);
                                that.parents(".by_day_select").find(".date").find("input").val("");
                                that.parents(".by_day_select").find(".date").find("select").prop('selectedIndex', 0);
                            }
                        }
                    }
                })
//                that.parents(".by_day_select").find("select[name='assign_staff']").find("option[value='" + staff + "']").remove();
            }
        });
    },
    SessionHolidayCamp: function () {
        $("#sessioncreate-one").on('click', ".add_by_date_btn", function () {
            var inputs = $(this).parents(".by_date_select").find("input,select");
            var WeekName = $(this).parents(".by_date_select").attr("data-week");
            var WeekID = $(this).parents(".by_date_select").attr("data-week_id");
            var start_date = $(this).parents(".by_date_select").find('input[name="start_date"]').val();
            var end_date = $(this).parents(".by_date_select").find('input[name="end_date"]').val();
            var start_time = $(this).parents(".by_date_select").find('input[name="start_time"]').val();
            var end_time = $(this).parents(".by_date_select").find('input[name="end_time"]').val();
            var exclusion_day = $(this).parents(".by_date_select").find('select[name="exclusion_day_id"]').val();
            var exclusion_day_text = $(this).parents(".by_date_select").find('select[name="exclusion_day_id"]').find("option:selected").text();

            var start_merdian = $(this).parents(".by_date_select").find('select[name="start_merdian"]').val();
            var end_merdian = $(this).parents(".by_date_select").find('select[name="end_merdian"]').val();

            var that = $(this);
            var isValid = true;
            var exclustion = '';

            $.each(inputs, function () {
                var currentInput = $(this).val();
                if (currentInput == "") {
                    alert($(this).attr("name").replace("_", " ").toUpperCase() + " required");
                    isValid = false;
                    return false;
                }
            });
            if (isValid) {
                $.ajax({
                    type: 'post',
                    url: check_session,
                    data: {class: 'week', week_id: WeekID, startDate: start_date, endDate: end_date, start_time: start_time + " " + start_merdian, end_time: end_time, exclusion_day: exclusion_day},
                    success: function (res) {
                        if (res == 1) {
                            swal("Notice!", "This session is already assigned", "warning");
                            return false;
                        } else {
                            var isValids = true;
                            $(document).find('input[name="weekz[]"]').each(function (i) {
                                var exclusion_days = $(document).find("input[name='exclusion_days[]']").eq(i).val();
                                var weekz = $(this).val();
                                var start_datez = $(document).find("input[name='start_datez[]']").eq(i).val();
                                var end_datez = $(document).find("input[name='end_datez[]']").eq(i).val();
                                var start_timez = $(document).find("input[name='start_timez[]']").eq(i).val();
                                var end_timez = $(document).find("input[name='end_timez[]']").eq(i).val();
                                if (exclusion_days == exclusion_day && WeekID == weekz && start_datez == start_date && end_date == end_datez && start_time + " " + start_merdian == start_timez && end_time == end_timez) {
                                    swal("Notice!", "This session is already assigned", "warning");
                                    isValids = false;
                                }
                            });
                            if (exclusion_day != "na") {
                                exclustion = '<input type="hidden" name="exclusion_days[]" value="' + exclusion_day + '">' + exclusion_day_text + " | ";
                            }
                            var elmn = '<div class="col-lg-5 delete_us">' +
                                    '<span class="mdl-chip mdl-chip--deletable">' +
                                    '<span class="mdl-chip__text">' +
                                    '<span class="time">' + WeekName + ' | <input type="hidden" name="weekz[]" value="' + WeekID + '"> ' + exclustion + start_date + ' <input type="hidden" name="start_datez[]" value="' + start_date + '">  - ' + end_date + '<input type="hidden" name="end_datez[]" value="' + end_date + '"> - ' + start_time + " " + start_merdian + '<input type="hidden" name="start_timez[]" value="' + start_time + " " + start_merdian + '"> - ' + end_time + " " + end_merdian + '<input type="hidden" name="end_timez[]" value="' + end_time + " " + end_merdian + '">' +
                                    '</span>' +
                                    '</span>' +
                                    '<button type="button" class="mdl-chip__action closeme">' +
                                    '<i class="material-icons">cancel</i>' +
                                    '</button>' +
                                    '</span>' + '</div>';

                            if (isValids) {
                                that.parents(".by_date_select").find(".weeks_select").append(elmn);
                            }
                        }

                    }

                })


            }
        });
    }
};
Application.init();
