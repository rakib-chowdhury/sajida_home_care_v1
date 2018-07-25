<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
$route['default_controller'] = 'home';
//$route['login'] = 'login/login_check';
//#### Patient Starts ####
$route['patient/add_patient'] = 'patient/add_patient';
$route['patient/patient_add_post'] = 'patient/patient_add_post';
$route['patient/patient_edit_post'] = 'patient/patient_edit_post';
$route['patient/manage_patients'] = 'patient/manage_patients';
$route['patient/edit_patient/(:any)'] = 'patient/edit_patient/$1';
$route['patient/view_profile/(:any)'] = 'patient/show_profile/$1';
$route['patient/reset_password'] = 'patient/reset_password';
//#### Patient Ends ####
//  have to check patient/caregiver/area_code/consultant routes
//#### Caregiver Starts ####
$route['caregiver/add_caregiver'] = 'caregiver/add_caregiver';
$route['caregiver/caregiver_add_post'] = 'caregiver/caregiver_add_post';
$route['caregiver/manage_caregiver'] = 'caregiver/manage_caregiver';
$route['caregiver/edit_caregiver/(:any)'] = 'caregiver/edit_caregiver/$1';
$route['caregiver/caregiver_edit_post'] = 'caregiver/caregiver_edit_post';
$route['caregiver/view_profile/(:any)'] = 'caregiver/show_profile/$1';
//#### Caregiver Ends ####

//#### Area Code Starts ####
$route['settings/add_area_code'] = 'settings/add_area_code';
$route['settings/area_code_add_post'] = 'settings/area_code_add_post';
$route['settings/manage_area_code'] = 'settings/manage_area_code';
$route['settings/edit_area_code/(:any)'] = 'settings/edit_area_code/$1';
$route['settings/delete_area_code'] = 'settings/delete_area_code';
//#### Area Code Ends ####

//#### Consultant Starts ####
$route['add_consultant_info'] = 'consultant/add_consultant';
$route['post_consultant_info'] = 'consultant/consultant_info_add_post';
$route['add_consultant_type'] = 'consultant/add_consultant_type';
$route['change_type_status'] = 'consultant/change_consultant_type_status';
$route['change_consultant_status'] = 'consultant/change_consultant_status';
$route['manage_consultant_info'] = 'consultant/manage_consultants';
$route['manage_consultant_type'] = 'consultant/manage_consultant_type';
$route['edit_consultant_info/(:any)'] = 'consultant/edit_consultant_info/$1';
$route['edit_consultant_type/(:any)'] = 'consultant/edit_consultant_type/$1';
$route['consultancy_type_edit_post'] = 'consultant/consultancy_type_edit_post';
$route['consultant_info_edit_post'] = 'consultant/consultant_info_edit_post';
$route['consultant/view_profile/(:any)'] = 'consultant/show_profile/$1';
$route['get_consultant_wise_events'] = 'consultant/fetch_events';
//#### Consultant Ends ####

//#### Promotional Item Starts ####
$route['promotional_items/add_promotional_items'] = 'promotional_item/add_promotional_items';
$route['promotional_items/manage_promotional_items'] = 'promotional_item/manage_promotional_items';
$route['promotional_items/edit_promotional_items/(:any)'] = 'promotional_item/edit_promotional_items/$1';
$route['promotional_items/delete_promotional_items/(:any)'] = 'promotional_item/delete_promotional_items/$1';
$route['promotional_items/add_promotional_item_category'] = 'promotional_item/add_promotional_item_category';
$route['promotional_items/category_add_post'] = 'promotional_item/category_add_post';
$route['promotional_items/promotional_item_add_post'] = 'promotional_item/promotional_item_add_post';
$route['promotional_items/track'] = 'promotional_item/track_promotional_items';
$route['manage_items/(:any)'] = 'promotional_item/manage_items/$1';
//#### Promotional Item Ends ####

//#### Admin User Starts ####
$route['admin_users/add_new_user'] = 'admin_user/add_admin_user';
$route['admin_users/manage_users'] = 'admin_user/manage_users';
$route['admin_users/edit_users/(:any)'] = 'admin_user/edit_admin_users/$1';
$route['admin_users/delete_promotional_items/(:any)'] = 'promotional_item/delete_promotional_items/$1';
$route['admin_users/add_promotional_item_category'] = 'promotional_item/add_promotional_item_category';
$route['admin_users/category_add_post'] = 'promotional_item/category_add_post';
$route['admin_users/user_add_post'] = 'admin_user/admin_user_add_post';
$route['admin_users/user_edit_post'] = 'admin_user/admin_user_edit_post';
//#### Admin User Ends ####

// ##### Schedule Starts #####
$route['schedule/add_new_schedule/(:any)'] = 'schedule/add_schedule/$1';
$route['schedule/edit_schedule/(:any)'] = 'schedule/edit_schedule/$1';
$route['schedule/manage_schedule'] = 'schedule/manage_schedule';
$route['schedule/add_consultant/(:any)'] = 'schedule/add_consultant/$1';
$route['schedule/consultant_schedule'] = 'Schedule/con_schedule_add_post';

// ##### Schedule Ends #####
$route['add_mobile_banking_method'] = 'settings/add_mobile_banking';
$route['edit_mobile_banking_method/(:any)'] = 'settings/edit_method/$1';
$route['manage_mobile_banking_method'] = 'settings/manage_mobile_banking';
$route['new_method_post'] = 'settings/method_add_post';
$route['delete_mobile_banking_method'] = 'settings/method_delete_post';
$route['mobile_banking_method_edit_post'] = 'settings/method_edit_post';
// ##### Caregiver Event Starts #####
$route['schedule/show_caregivers'] = 'schedule/show_caregiver_events';
$route['get_caregiver_wise_events'] = 'schedule/fetch_events';
// ##### Caregiver Event Ends #####

// #### Consultant Event Starts ####
$route['schedule/show_consultants'] = 'schedule/show_consultant_events';
// #### Consultant Event Ends ####

// #### Download App ####
$route['download_SF_app'] = 'common/download_SF_app';

$route['error'] = 'settings/show_error';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
