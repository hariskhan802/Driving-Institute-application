
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
$route['login'] = '/auth/index';
$route['admin/checklogin'] = '/auth/checklogin';
$route['forgot-password'] = '/auth/forgot_password';
$route['recover-password'] = '/auth/recover_password';
$route['logout'] = '/auth/logout';
$route['admin/dashboard'] = '/dashboard/index';

//Profile
$route['admin/profile'] = '/Profile/index';
$route['admin/settings'] = '/Profile/settings';
$route['admin/help'] = '/Profile/help';
$route['admin/save-profile'] = '/Profile/save_profile';
$route['admin/save-admin-profile'] = '/Profile/save_admin_profile';


//Program Management
$route['admin/program-management'] = '/program_management/index';
$route['admin/program-management/create-program'] = '/program_management/create_program';
$route['admin/program-management/save-program'] = '/program_management/save_program';
$route['admin/program-management/duplicate-record/(:any)'] = '/program_management/duplicationProgram/$1';
$route['admin/program-management/update-program'] = '/program_management/update_program';
$route['admin/program-management/edit_program/(:any)'] = '/program_management/edit_program/$1';
$route['admin/program-management/delete_program/(:any)'] = '/program_management/delete_program/$1';
$route['admin/program-management/getLevels'] = '/program_management/getLevels';
$route['admin/program-management/delete-level'] = '/program_management/delete_level';

//Session Management
$route['admin/session-management'] = '/session_management/index';
$route['admin/session-management/create-session'] = '/session_management/create_session';
$route['admin/session-management/save-session'] = '/session_management/save_session';
$route['admin/session-management/duplicate-record/(:any)'] = '/session_management/duplicationsession/$1';
$route['admin/session-management/update-session'] = '/session_management/update_session';
$route['admin/session-management/getSession'] = '/session_management/getSession';
$route['admin/session-management/check-session'] = '/session_management/check_session';

$route['admin/session-management/edit_session/(:any)'] = '/session_management/edit_session/$1';
$route['admin/session-management/delete_session/(:any)'] = '/session_management/delete_session/$1';

$route['admin/session-management/getbyparams'] = '/session_management/getbyparams';
$route['admin/session-management/getprogramlevels'] = '/session_management/getProgramLevels';
$route['admin/session-management/getSessionInfo'] = '/session_management/getSessionInfo';
$route['admin/session-management/session-info/(:any)'] = '/session_management/session_info/$1';

//Venue Management
$route['admin/venue-management/(:any)'] = '/venue_management/$1';
$route['admin/venue-management'] = '/venue_management/index';
$route['admin/venue-management/add-venue'] = '/venue_management/add_venue';
$route['admin/venue-management/save-venue'] = '/venue_management/save_venue';
$route['admin/venue-management/update-venue'] = '/venue_management/update_venue';
$route['admin/venue-management/edit-venue/(:any)'] = '/venue_management/edit_venue/$1';
$route['admin/venue-management/delete-venue/(:any)'] = '/venue_management/delete_venue/$1';
$route['admin/venue-management/venue-detials/(:any)'] = '/venue_management/venue_details/$1';


//Staff Management
$route['admin/staff-management'] = '/staff_management/index';
$route['admin/staff-management/makedata'] = '/staff_management/makedata';
$route['admin/staff-management/add-staff'] = '/staff_management/add_staff';
$route['admin/staff-management/edit-staff/(:any)'] = '/staff_management/edit_staff/$1';
$route['admin/staff-management/save-staff'] = '/staff_management/save_staff';
$route['admin/staff-management/update-staff'] = '/staff_management/update_staff';
$route['admin/staff-management/delete-staff/(:any)'] = '/staff_management/delete_staff/$1';
$route['admin/staff-management/leave-application/(:any)'] = '/staff_management/leave_application/$1';
$route['admin/staff-management/save-leave'] = '/staff_management/save_leave';
$route['admin/staff-management/absense'] = '/staff_management/absense';
$route['admin/staff-management/add-absense'] = '/staff_management/Add_absense';
$route['admin/staff-management/save-absense'] = '/staff_management/save_absense';
$route['admin/staff-management/get-absense'] = '/staff_management/get_absense';
$route['admin/staff-management/staf-leave/(:any)'] = '/staff_management/staf_leave/$1';
$route['admin/staff-management/staff-leave-request'] = '/staff_management/staff_leave_request';
$route['admin/staff-management/staff/(:any)'] = '/staff_management/staff/$1';
$route['admin/staff-management/view-leave-request/(:any)'] = '/staff-management/view_leave_request/$1';
$route['admin/staff-management/change-status/(:any)'] = '/staff-management/change_status/$1';
$route['admin/staff-management/edit-absense/(:any)'] = '/staff-management/edit_absense/$1';
$route['admin/staff-management/edit-absense/(:any)'] = '/staff-management/edit_absense/$1';
$route['admin/staff-management/update_absense'] = '/staff-management/update_absense';

//Assessment Management
$route['admin/assessment-management'] = '/assessment_management/index';
$route['admin/assessment-management/find-dates'] = '/assessment_management/find_dates';
$route['admin/assessment-management/find-all-dates'] = '/assessment_management/find_All_dates';
$route['admin/assessment-management/filter_assessment'] = '/assessment_management/filter_assessment';
$route['admin/assessment-management/filter_assessment_makeup'] = '/assessment_management/filter_assessment_makeup';
$route['admin/assessment-management/add-assessment'] = '/assessment_management/add_assessment';
$route['admin/assessment-management/save-assessment'] = '/assessment_management/save_assessment';
$route['admin/assessment-management/makeup-assessment'] = '/assessment_management/makeup_assessment';
$route['admin/assessment-management/add-makeup-assessment'] = '/assessment_management/add_makeup_assessment';
$route['admin/assessment-management/save-makeup-assessment'] = '/assessment_management/save_makeup_assessment';
$route['admin/assessment-management/delete_makeup_assessment/(:any)'] = '/assessment_management/delete_makeup_assessment/$1';
$route['admin/assessment-management/delete_assessment/(:any)'] = '/assessment_management/delete_assessment/$1';
$route['admin/assessment-management/edit_assessment/(:any)'] = '/assessment_management/edit_assessment/$1';
$route['admin/assessment-management/edit_makeup_assessment/(:any)'] = '/assessment_management/edit_makeup_assessment/$1';

//Child Management
$route['admin/child-management'] = '/child_management/index';
$route['admin/child-management/filter-child'] = '/child_management/filter_child';
$route['admin/child-management/students'] = '/child_management/students';
$route['admin/child-management/update_child_review'] = '/child_management/update_child_review';
$route['admin/child-management/delete-child/(:any)'] = '/child_management/delete_child/$1';
$route['admin/child-management/child-details/(:any)'] = '/child_management/child_details/$1';
$route['admin/child-management/child-statistics/(:any)'] = '/child_management/child_statistics/$1';
$route['admin/child-management/edit-child/(:any)'] = '/child_management/edit_child/$1';
$route['admin/child-management/update-child'] = '/child_management/update_child';

//ATTENDANCE
$route['admin/attendance-management'] = '/attendance_management/index';
$route['admin/attendance-management/student-attendance'] = '/attendance_management/student_attendance';
$route['admin/attendance-management/find_date'] = '/attendance_management/find_date';
$route['admin/attendance-management/save_attendance'] = '/attendance_management/save_attendance';
$route['admin/attendance-management/manage-attendance'] = '/attendance_management/manage_attendance';
$route['admin/attendance-management/update-attendance'] = '/attendance_management/update_attendance';
$route['admin/attendance-management/get_time'] = '/attendance_management/get_time';
$route['admin/attendance-management/mark_attendance'] = '/attendance_management/mark_attendance';
$route['admin/attendance-management/delete_attendance'] = '/attendance_management/delete_attendance';

//Calendar
$route['admin/calendar-management/calendar/(:any)'] = '/calendar_management/calendar/$1';
$route['admin/calendar-management/calendar-listings'] = '/calendar_management/calendar_listings';
$route['admin/calendar-management/calendar-ajax'] = '/calendar_management/calendar_ajax';
$route['admin/calendar-management/save-calendar'] = '/calendar_management/save_calendar';

//Discount
$route['admin/discount-management/venues-discount'] = '/discount_management/venues_discount';
$route['admin/discount-management/add-venue-discount'] = '/discount_management/add_venue_discount';
$route['admin/discount-management/save-venue-discount'] = '/discount_management/save_venue_discount';
$route['admin/discount-management/student-discount'] = '/discount_management/student_discount';
$route['admin/discount-management/add-student-discount'] = '/discount_management/add_student_discount';
$route['admin/discount-management/save-student-discount'] = '/discount_management/save_student_discount';
$route['admin/discount-management/training-fee'] = '/discount_management/Training_fee';
$route['admin/discount-management/filter_sessions'] = '/discount_management/filter_sessions';
$route['admin/discount-management/delete/(:any)'] = '/discount_management/delete/$1';

//Business Projection 
$route['admin/business_projections'] = '/business_projections/index';
$route['admin/business_projections/child'] = '/business_projections/project_by_child';
$route['admin/business_projections/find_by_child'] = '/business_projections/find_by_child';
$route['admin/business_projections/project_by_parents'] = '/business_projections/project_by_parents';
$route['admin/business_projections/assessment_entries'] = '/business_projections/assessment_entries';
$route['admin/business_projections/makeup_session_entries'] = '/business_projections/makeup_session_entries';
//Staff Timetable
$route['admin/staff-timetable'] = '/staff_timetable/index';
$route['admin/staff-timetable/timetable/(:any)'] = '/staff_timetable/timetable/$1';

//General Settings
$route['admin/general-settings'] = '/general_settings/index';
$route['admin/general-settings/vat-discount-setting'] = '/general_settings/vat_discount_setting';
$route['admin/general-settings/save-vat-discount-setting'] = '/general_settings/save_vat_discount_setting';
$route['admin/general-settings/terms-duration'] = '/general_settings/terms_duration';
$route['admin/general-settings/price-list'] = '/general_settings/price_list';
$route['admin/general-settings/save-price-list'] = '/general_settings/save_price_list';
$route['admin/general-settings/terms-condition'] = '/general_settings/terms_condition';
$route['admin/general-settings/save-terms-condition'] = '/general_settings/save_terms_condition';
$route['admin/general-settings/save-terms'] = '/general_settings/save_terms';
$route['admin/general-settings/club-images'] = '/general_settings/club_images';
$route['admin/general-settings/getWeeks'] = '/general_settings/getWeeks';

$route['admin/general-settings/save-club-images'] = '/general_settings/save_club_images';

$route['admin/general-settings/restriction'] = '/general_settings/restriction';
$route['admin/general-settings/save-restriction'] = '/general_settings/save_restriction';
$route['admin/general-settings/notification'] = '/general_settings/notification';
$route['admin/general-settings/save-notification'] = '/general_settings/save_notification';

$route['admin/general-settings/news'] = '/general_settings/news';
$route['admin/general-settings/save-news'] = '/general_settings/save_news';

//COMPANY OVERVIEW
$route['admin/company-overview'] = '/company_overview/index';
$route['admin/company-overview/save-overview'] = '/company_overview/save_overview';



include 'routes_api.php';
