<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login_id') != null) {
            $this->load->model('Admin_model');
            $this->load->model('User_model');
            $this->load->model('Schedule_model');
            $this->load->library('Home_care_lib');
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function add_patient()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 4) {
            $data['area_info'] = $this->Admin_model->getAllRecords('tbl_area_code');
            $data['level_care_info'] = $this->Admin_model->getAllRecords('tbl_level_care_type');
            $data['referral_info'] = $this->Admin_model->getAllRecords('tbl_referral');
            $data['caregiver_info'] = $this->Schedule_model->get_active_caregivers();
            $data['master_body'] = $this->load->view('admin/patient/add_patient', $data, true);
            $data['active_page'] = 'Add Patient';
            $this->load->view('admin/master', $data);
        } else {
            $data['master_body'] = $this->load->view('admin/access_denied_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function manage_patients()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['get_patient_info'] = $this->User_model->get_new_patients();
        //echo '<pre>';print_r($data['get_patient_info']);die();
        $data['master_body'] = $this->load->view('admin/patient/manage_patients', $data, true);
        $data['active_page'] = 'Manage Patient';
        $this->load->view('admin/master', $data);
    }

    public function patient_add_post()
    {
        //echo '<pre>';print_r($_FILES);die();
        if (isset($_POST['patient_joining_date']) && isset($_POST['patient_name']) && isset($_POST['patient_phone']) &&
            isset($_POST['patient_dob']) && isset($_POST['patient_address']) && isset($_POST['patient_joining_date'])
        ) {
            $new_date = $this->input->post('patient_joining_date');
            //echo '<pre>';print_r($new_date);die();
            $new_date = explode('/', $new_date);
            $pt_id = $new_date[1] . $new_date[0] . substr($new_date[2], 2, 4);
            $chk_date = $new_date[2] . '-' . $new_date[0] . '-' . $new_date[1];
            // echo $chk_date;die();
            $new_date = $new_date[0] . $new_date[1] . $new_date[2];
            $dob_date = explode('/', $this->input->post('patient_dob'));
            //echo '<pre>';print_r($pt_id);die();
            $dob_date = $dob_date[2] . '-' . $dob_date[0] . '-' . $dob_date[1];
            //echo '<pre>';print_r($new_date);die();
            $table_name = 'tbl_patient_user';
            $count_patient = $this->Admin_model->count_patient($table_name, $chk_date);
            $count_patient = $count_patient + 1;
            //echo '<pre>';print_r($count_patient);die();
            $data['patient_id'] = 'PT' . $pt_id . $count_patient;
            $data['patient_name'] = $this->input->post('patient_name');
            $data['NID_number'] = $this->input->post('patient_nid');
            $data['DOB'] = $dob_date;
            $data['gender'] = $this->input->post('patient_gender');
            if ($this->input->post('patient_gender') == 'on') {
                $data['gender'] = 1;
            } else {
                $data['gender'] = 0;
            }
            $data['blood_group'] = $this->input->post('blood_group');
            $data['phone_number'] = $this->input->post('patient_phone');
            $data['email'] = $this->input->post('patient_email');
            $data['address'] = $this->input->post('patient_address');
            //$data['picture'] = $this->input->post('patient_image');
            $data['joining_date'] = $chk_date;
            // echo $data['joining_date'];die();
            $data['tbl_level_care_type_level_care_type_id'] = $this->input->post('level_care');
            $data['tbl_referral_referral_id'] = $this->input->post('referred_by');
            $data['tbl_area_code_area_code_id'] = $this->input->post('area_code');
            $data['tbl_app_user_type_app_user_type_id'] = 2; //have to check session after implementing login
            //for login
            $data55['user_id'] = $data['patient_id'];
            $data55['password'] = md5("123456");
            $data55['status'] = 1;
            $data55['tbl_app_user_type_app_user_type_id'] = 2;
            //end login
            //echo '<pre>';print_r($data);die();
            if ($_FILES['patient_image']['error'] == 4) {
                $insert_app_user = $this->Admin_model->insert_ret('tbl_app_user_login', $data55);
                $insert_id = $this->Admin_model->insert_ret('tbl_patient_user', $data);
                $patient_id = $this->Admin_model->getWhere('patient_id', "patient_id='$data[patient_id]'", 'tbl_patient_user');
            } else {
                $image_ext = explode('.', $_FILES['patient_image']['name']);
                $extension = end($image_ext);
                //echo '<pre>';print_r($image_ext);die();
                if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                    $target_path = 'uploads/patient_image/patient_image_' . rand(10 * 10, 500 * 500) . '.' . $extension;
                    //echo '<pre>';print_r($target_path);die();
                    if (move_uploaded_file($_FILES['patient_image']['tmp_name'], $target_path)) {
                        $data['picture'] = $target_path;
                        //echo '<pre>';print_r($data);die();
                        $insert_app_user = $this->Admin_model->insert_ret('tbl_app_user_login', $data55);
                        $insert_id = $this->Admin_model->insert_ret('tbl_patient_user', $data);
                        $patient_id = $this->Admin_model->getWhere('patient_id', "patient_id='$data[patient_id]'", 'tbl_patient_user');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Data Can Not Be Added. Please Insert Data Correctly.');
                }
            }
            $patient = implode($patient_id);
            if ($this->input->post('preferable_caregiver') != null) {
                $data1['tbl_patient_user_patient_id'] = $patient_id['patient_id'];
                $data1['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
                foreach ($this->input->post('preferable_caregiver') as $row) {
                    $data1['tbl_caregiver_user_caregiver_user_id'] = $row;
                    //echo '<pre>';print_r($data1);
                    $this->Admin_model->insert('tbl_preferable_caregiver_list', $data1);
                }
            }
            if (($this->input->post('emergency_contact_name') != null) &&
                ($this->input->post('emergency_contact_relationship') != null) &&
                ($this->input->post('emergency_contact_phone') != null)
            ) {
                $data2['family_contact_name'] = $this->input->post('emergency_contact_name');
                $data2['relationship'] = $this->input->post('emergency_contact_relationship');
                $data2['phone_number'] = $this->input->post('emergency_contact_phone');
                $data2['email'] = $this->input->post('emergency_contact_email');
                $data2['address'] = $this->input->post('emergency_contact_address');
                $data2['is_emergency'] = '1';
                $data2['tbl_patient_user_patient_id'] = $patient_id['patient_id'];
                $this->Admin_model->insert('tbl_patient_family_contact', $data2);
            }
            if (($this->input->post('family_contact_name_1') != null) ||
                ($this->input->post('family_contact_relationship_1') != null) ||
                ($this->input->post('family_contact_phone_1') != null) ||
                ($this->input->post('family_contact_email_1') != null) ||
                ($this->input->post('family_contact_address_1') != null)
            ) {
                $data3['family_contact_name'] = $this->input->post('family_contact_name_1');
                $data3['relationship'] = $this->input->post('family_contact_relationship_1');
                $data3['phone_number'] = $this->input->post('family_contact_phone_1');
                $data3['email'] = $this->input->post('family_contact_email_1');
                $data3['address'] = $this->input->post('family_contact_address_1');
                $data3['is_emergency'] = '0';
                $data3['tbl_patient_user_patient_id'] = $patient_id['patient_id'];
                //echo '<pre>';print_r($data3);die();
                $this->Admin_model->insert('tbl_patient_family_contact', $data3);
            }
            if (($this->input->post('family_contact_name_2') != null) ||
                ($this->input->post('family_contact_relationship_2') != null) ||
                ($this->input->post('family_contact_phone_2') != null) ||
                ($this->input->post('family_contact_email_2') != null) ||
                ($this->input->post('family_contact_address_2') != null)
            ) {
                $data4['family_contact_name'] = $this->input->post('family_contact_name_2');
                $data4['relationship'] = $this->input->post('family_contact_relationship_2');
                $data4['phone_number'] = $this->input->post('family_contact_phone_2');
                $data4['email'] = $this->input->post('family_contact_email_2');
                $data4['address'] = $this->input->post('family_contact_address_2');
                $data4['is_emergency'] = '0';
                $data4['tbl_patient_user_patient_id'] = $patient_id['patient_id'];
                //echo '<pre>';print_r($data3);die();
                $this->Admin_model->insert('tbl_patient_family_contact', $data4);
            }
            if (($this->input->post('family_contact_name_3') != null) ||
                ($this->input->post('family_contact_relationship_3') != null) ||
                ($this->input->post('family_contact_phone_3') != null) ||
                ($this->input->post('family_contact_email_3') != null) ||
                ($this->input->post('family_contact_address_3') != null)
            ) {
                $data5['family_contact_name'] = $this->input->post('family_contact_name_3');
                $data5['relationship'] = $this->input->post('family_contact_relationship_3');
                $data5['phone_number'] = $this->input->post('family_contact_phone_3');
                $data5['email'] = $this->input->post('family_contact_email_3');
                $data5['address'] = $this->input->post('family_contact_address_3');
                $data5['is_emergency'] = '0';
                $data5['tbl_patient_user_patient_id'] = $patient_id['patient_id'];
                $this->Admin_model->insert('tbl_patient_family_contact', $data5);
            }
            $this->session->set_flashdata('success_msg', 'Patient Has Been Added Successfully.');
            redirect('patient/manage_patients', 'refresh');
        } else {
            $this->session->set_flashdata('error_msg', 'Patient Can Not Be Added. Please Insert Information Correctly.');
            redirect('patient/add_patient', 'refresh');
        }
    }

    public function edit_patient($id)
    {
        $patient_id = $id;
        $data = array();
        //$data['consultant_type'] = $this->Admin_model->getAllRecords('tbl_consultant_type');
        if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
            $data['patient_info'] = $this->Admin_model->getAllPatients($patient_id);
            $data['area'] = $this->Admin_model->getAllRecords('tbl_area_code');
            $data['level_care'] = $this->Admin_model->getAllRecords('tbl_level_care_type');
            $data['referral'] = $this->Admin_model->getAllRecords('tbl_referral');
            $data['caregiver'] = $this->Admin_model->getAllRecords('tbl_caregiver_user');
            $data['get_caregiver'] = $this->Admin_model->getPreferableCaregiver($patient_id);
            $data['emergency_contact'] = $this->Admin_model->getEmergencyContact($patient_id);
            $data['family_contact'] = $this->Admin_model->getFamilyContact($patient_id);
            //  echo '<pre>';print_r($data['patient_info']);die();
            if (sizeof($data['family_contact']) != null) {
                foreach ($data['family_contact'] as $key => $row) {
                    $key = $key + 1;
                    $data["family_contact_id_$key"] = $row['patient_family_contact_id'];
                    $data["family_contact_name_$key"] = $row['family_contact_name'];
                    $data["family_contact_relationship_$key"] = $row['relationship'];
                    $data["family_contact_phone_$key"] = $row['phone_number'];
                    $data["family_contact_email_$key"] = $row['email'];
                    $data["family_contact_address_$key"] = $row['address'];
                    //$key = $key+1;
                }
            }
            //echo '<pre>';print_r($data1);die();
            if (sizeof($data['patient_info']) != null) {
                $data['top_header'] = $this->load->view('admin/top_header', '', true);
                $data['footer'] = $this->load->view('admin/footer', '', true);
                $data['active_page'] = 'Edit Patient Info';
                $data['master_body'] = $this->load->view('admin/patient/edit_patient', $data, true);
                $data['active_page'] = 'Manage Patient';
                $this->load->view('admin/master', $data);
            } else {
                $data['top_header'] = $this->load->view('admin/top_header', '', true);
                $data['footer'] = $this->load->view('admin/footer', '', true);
                $data['master_body'] = $this->load->view('admin/error_page', $data, true);
                $data['active_page'] = 'Error';
                $this->load->view('admin/master', $data);
            }
        } else {
            $data['master_body'] = $this->load->view('admin/access_denied_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function patient_edit_post()
    {
        // echo '<pre>';print_r($_POST['patient_gender']);die();
        $patient_id = $this->input->post('id');
        $contact1_id = $this->input->post('contact1_id');
        $contact2_id = $this->input->post('contact2_id');
        $contact3_id = $this->input->post('contact3_id');
        $emergency_contact = $this->input->post('emergency_contact');
        if (isset($_POST['patient_joining_date']) && isset($_POST['patient_name']) && isset($_POST['patient_phone']) &&
            isset($_POST['patient_dob']) && isset($_POST['patient_address']) && isset($_POST['patient_joining_date'])
        ) {
            $dob_date = explode('/', $this->input->post('patient_dob'));
            $dob_date = $dob_date[2] . '-' . $dob_date[0] . '-' . $dob_date[1];
            $joining_date = explode('/', $this->input->post('patient_joining_date'));
            $joining_date = $joining_date[2] . '-' . $joining_date[0] . '-' . $joining_date[1];
            $data['patient_name'] = $this->input->post('patient_name');
            $data['NID_number'] = $this->input->post('patient_nid');
            $data['DOB'] = $dob_date;
            $prev_gender = $this->Admin_model->getAllPatients($patient_id);
            if (isset($_POST['patient_gender'])) {
                if ($_POST['patient_gender'] == "on") {
                    if ($prev_gender[0]['gender'] == 1) {
                        $data['gender'] = 0;
                    } else {
                        $data['gender'] = 1;
                    }
                } else {
                    $data['gender'] = $prev_gender[0]['gender'];
                }
            }
            $data['blood_group'] = $this->input->post('blood_group');
            $data['phone_number'] = $this->input->post('patient_phone');
            $data['email'] = $this->input->post('patient_email');
            $data['address'] = $this->input->post('patient_address');
            //$data['picture'] = $this->input->post('patient_image');
            $data['joining_date'] = $joining_date;
            $data['tbl_level_care_type_level_care_type_id'] = $this->input->post('level_care');
            $data['tbl_referral_referral_id'] = $this->input->post('referred_by');
            $data['tbl_area_code_area_code_id'] = $this->input->post('area_code');
            // $data['tbl_app_user_type_app_user_type_id'] = 2; //have to check session after implementing login
            // echo '<pre>';print_r($data);die();
            $table_name1 = 'tbl_patient_user';
            //echo '<pre>';print_r($data);die();
            $image = $this->Admin_model->getWhere('picture', "patient_id='$patient_id'", 'tbl_patient_user');
            // $image = implode($image);
            //  echo '<pre>';print_r($data);die();
            if ($_FILES['patient_image']['error'] == 4) {
                $data['picture'] = $image['picture'];
                $update_id = $this->Admin_model->update_function('patient_id', $patient_id, $table_name1, $data);
                // echo 'without pic';die();
            } else {
                $image_ext = explode('.', $_FILES['patient_image']['name']);
                $extension = end($image_ext);
                if ($image['picture'] != null) {
                    // echo '<pre>';print_r($image);die();
                    $image_name = explode('.', $image['picture']);
                    $old_image_name = explode('/', $image['picture']);
                    // echo '<pre>';print_r($old_image_name);die();
                    if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                        $target_path = $image_name[0] . '.' . $extension;
                        //echo '<pre>';print_r($target_path);die();
                        unlink('uploads/patient_image/' . $old_image_name[2]);
                        if (move_uploaded_file($_FILES['patient_image']['tmp_name'], $target_path)) {
                            $data['picture'] = $target_path;
                            $update_id = $this->Admin_model->update_function('patient_id', $patient_id, $table_name1, $data);
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', 'Data Can Not Be Added. Please Insert Data Correctly.');
                        redirect('patient/edit_patient', 'refresh');
                    }
                } else {
                    // echo 'not found';die();
                    if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                        $target_path = 'uploads/patient_image/patient_image_' . rand(10 * 10, 500 * 500) . '.' . $extension;
                        //echo '<pre>';print_r($target_path);die();
                        if (move_uploaded_file($_FILES['patient_image']['tmp_name'], $target_path)) {
                            $data['picture'] = $target_path;
                            $update_id = $this->Admin_model->update_function('patient_id', $patient_id, $table_name1, $data);
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', 'Data Can Not Be Added. Please Insert Data Correctly.');
                        redirect('patient/edit_patient', 'refresh');
                    }
                }
            }
            if ($this->input->post('preferable_caregiver') != null) {
                $this->Admin_model->delete_preferable_caregiver($patient_id);
                $data1['tbl_patient_user_patient_id'] = $patient_id;
                $data1['tbl_admin_user_admin_user_id'] = 'appinion';
                foreach ($this->input->post('preferable_caregiver') as $row) {
                    $data1['tbl_caregiver_user_caregiver_user_id'] = $row;
                    $this->Admin_model->insert('tbl_preferable_caregiver_list', $data1);
                }
            }
            if ($this->input->post('preferable_caregiver') == null) {
                $this->Admin_model->delete_preferable_caregiver($patient_id);
            }
            //echo 'done';die();
            if (($this->input->post('emergency_contact_name') != null) &&
                ($this->input->post('emergency_contact_relationship') != null) &&
                ($this->input->post('emergency_contact_phone') != null)
            ) {
                $data2['family_contact_name'] = $this->input->post('emergency_contact_name');
                $data2['relationship'] = $this->input->post('emergency_contact_relationship');
                $data2['phone_number'] = $this->input->post('emergency_contact_phone');
                $data2['email'] = $this->input->post('emergency_contact_email');
                $data2['address'] = $this->input->post('emergency_contact_address');
                $data2['is_emergency'] = '1';
                $data2['tbl_patient_user_patient_id'] = $patient_id;
                $this->Admin_model->updatePatientAll("patient_family_contact_id='$emergency_contact'", 'tbl_patient_family_contact', $data2);
            }
            if (($this->input->post('family_contact_name_1')) ||
                ($this->input->post('family_contact_relationship_1')) ||
                ($this->input->post('family_contact_phone_1'))
            ) {
                $data3['family_contact_name'] = $this->input->post('family_contact_name_1');
                $data3['relationship'] = $this->input->post('family_contact_relationship_1');
                $data3['phone_number'] = $this->input->post('family_contact_phone_1');
                $data3['email'] = $this->input->post('family_contact_email_1');
                $data3['address'] = $this->input->post('family_contact_address_1');
                $data3['is_emergency'] = '0';
                $data3['tbl_patient_user_patient_id'] = $patient_id;
                if($contact1_id)
                {
                    //echo 'update';
                    $this->Admin_model->updatePatientAll("patient_family_contact_id='$contact1_id'", 'tbl_patient_family_contact', $data3);
                }
                else{
                    //echo 'insert';
                    $this->Admin_model->insert('tbl_patient_family_contact', $data3);
                }
            }
            //echo 'yes';die();
            if (($this->input->post('family_contact_name_2') != null) ||
                ($this->input->post('family_contact_relationship_2') != null) ||
                ($this->input->post('family_contact_phone_2') != null)
            ) {
                $data4['family_contact_name'] = $this->input->post('family_contact_name_2');
                $data4['relationship'] = $this->input->post('family_contact_relationship_2');
                $data4['phone_number'] = $this->input->post('family_contact_phone_2');
                $data4['email'] = $this->input->post('family_contact_email_2');
                $data4['address'] = $this->input->post('family_contact_address_2');
                $data4['is_emergency'] = '0';
                $data4['tbl_patient_user_patient_id'] = $patient_id;
               // $this->Admin_model->updatePatientAll("patient_family_contact_id='$contact2_id'", 'tbl_patient_family_contact', $data4);
                if($contact2_id)
                {
                    //echo 'update';
                    $this->Admin_model->updatePatientAll("patient_family_contact_id='$contact2_id'", 'tbl_patient_family_contact', $data4);
                }
                else{
                    //echo 'insert';
                    $this->Admin_model->insert('tbl_patient_family_contact', $data4);
                }
            }
            if (($this->input->post('family_contact_name_3') != null) ||
                ($this->input->post('family_contact_relationship_3') != null) ||
                ($this->input->post('family_contact_phone_3') != null)
            ) {
                $data5['family_contact_name'] = $this->input->post('family_contact_name_3');
                $data5['relationship'] = $this->input->post('family_contact_relationship_3');
                $data5['phone_number'] = $this->input->post('family_contact_phone_3');
                $data5['email'] = $this->input->post('family_contact_email_3');
                $data5['address'] = $this->input->post('family_contact_address_3');
                $data5['is_emergency'] = '0';
                $data5['tbl_patient_user_patient_id'] = $patient_id;
               // $this->Admin_model->updatePatientAll("patient_family_contact_id='$contact3_id'", 'tbl_patient_family_contact', $data5);
                if($contact3_id)
                {
                    //echo 'update';
                    $this->Admin_model->updatePatientAll("patient_family_contact_id='$contact3_id'", 'tbl_patient_family_contact', $data5);
                }
                else{
                    //echo 'insert';
                    $this->Admin_model->insert('tbl_patient_family_contact', $data5);
                }
            }
            //die();
            $this->session->set_flashdata('success_msg', 'Patient Info Has Been Updated Successfully.');
            redirect('patient/manage_patients', 'refresh');
        } else {
            $this->session->set_flashdata('error_msg', 'Patient Info Can Not Be Updated. Please Insert Information Correctly.');
            redirect('patient/edit_patient/' . $patient_id, 'refresh');
        }
    }

    public function show_profile($id)
    {
        $patient_id = $id;
        date_default_timezone_set('Asia/Dhaka');
        $get_date = date('Y-m-d');
        $get_date = explode('-', $get_date);
        // echo '<pre>'; print_r($get_date);die();
        $start_date = $this->home_care_lib->get_start_date($get_date[1],$get_date[0]);
        $end_date = $this->home_care_lib->get_end_date($get_date[1],$get_date[0]);
       // echo '<pre>'; print_r($start_date);die();
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['patient_info'] = $this->Admin_model->SingelGetWhereJoin('*', "patient_id='$patient_id'", 'tbl_patient_user');
        $data['appointments'] = $this->Admin_model->patient_appointment_count($patient_id);
        $data['e_contact'] = $this->Admin_model->get_e_contact($patient_id);
        //echo '<pre>';print_r($data['appointments']);die();
        $data['chart_data'] = $this->Admin_model->get_chart_data($patient_id, $start_date, $end_date);
        //echo '<pre>'; print_r($data['chart_data']);die();
        $data['medical_history'] = $this->Admin_model->get_medical_history($patient_id);
        $data['schedule_id'] = $this->Admin_model->get_schedule_id($patient_id);
        $data['p_caregiver'] = $this->Admin_model->get_preferable_caregiver('*', "tbl_patient_user_patient_id='$patient_id'", 'tbl_preferable_caregiver_list');
        $data['f_contacts'] = $this->Admin_model->SingelGetWhere('*', "tbl_patient_user_patient_id='$patient_id'", 'tbl_patient_family_contact');
        $data['total_hours'] = 0;
        if (sizeof($data['schedule_id']) != null) {
            foreach ($data['schedule_id'] as $key => $row) {
                $carehours = $this->Admin_model->get_care_hours($row->tbl_schedule_maker_schedule_maker_id);
                if (sizeof($carehours) > 0) {
                    $total_hours = $carehours[0]->carehours;
                    $data['total_hours'] += $total_hours;
                }

            }
        }
        // echo '<pre>';print_r($data['total_hours']);die();
        // $data['get_schedule'] = $this->Admin_model->get_upcoming_schedule($patient_id);
        $get_schedule = $this->Admin_model->get_upcoming_schedule($patient_id);
        //echo '<pre>';print_r($get_schedule);die();
        foreach ($get_schedule as $key=>$row)
        {
            $data['get_schedule'][$key]['caregiver_name'] = $row->caregiver_name;
            $data['get_schedule'][$key]['caregiver_user_id'] = $row->caregiver_user_id;
            $data['get_schedule'][$key]['starting_date'] = $this->home_care_lib->get_date_day_from_millisecond($row->start_time);
            $data['get_schedule'][$key]['starting_time'] = $this->home_care_lib->millisecond_to_time($row->start_time);
            $data['get_schedule'][$key]['ending_date'] = $this->home_care_lib->get_date_day_from_millisecond($row->end_time);
            $data['get_schedule'][$key]['ending_time'] = $this->home_care_lib->millisecond_to_time($row->end_time);
        }
        //echo '<pre>';print_r($data['get_schedule']);die();
        $data['get_care_history'] = $this->Admin_model->get_care_history($patient_id);
        $data['master_body'] = $this->load->view('admin/patient_profile/show_profile', $data, true);
        $data['active_page'] = 'Manage Patient';
        $this->load->view('admin/master', $data);
    }

    public function fetch_history()
    {
        $month_name = explode('-', $this->input->post('month_name'));
        $patient_id = $this->input->post('patient_id');
        $patient_name = $this->input->post('patient_name');
        $start_date = $this->home_care_lib->get_start_date($month_name[1], $month_name[0]);
        $end_date = $this->home_care_lib->get_end_date($month_name[1], $month_name[0]);
        $fetch_data = $this->Admin_model->fetch_history($patient_id, $start_date, $end_date);
        // print_r($fetch_data);die();
        $create_table = "<script type=\"text/javascript\">
                                    jQuery(document).ready(function ($) {
                                        var table4 = jQuery(\"#table-4\");

                                        table4.DataTable({
                                            dom: 'Bfrtip',
                                            buttons: [
                                                {
                                                    extend: 'excelHtml5',
                                                    title: \"$patient_name\"+'_'+\"$patient_id\"
                                                },
                                                {
                                                    extend: 'pdfHtml5',
                                                    title: \"$patient_name\"+'_'+\"$patient_id\"
                                                }
                                            ]
                                        });
                                    });
                                </script>";
        $create_table .= "<table class=\"table table-bordered datatable\" id=\"table-4\" style=\"\">
                                <thead>
                                <tr>
                                    <th style=\"background-color: #303641;color: white; width: 15%\">Caregiver Name</th>
                                    <th style=\"background-color: #303641;color: white; width: 2%\">Starting Date</th>
                                    <th style=\"background-color: #303641;color: white\">Starting Time</th>
                                    <th style=\"background-color: #303641;color: white\">Ending Date</th>
                                    <th style=\"background-color: #303641;color: white\">Ending Time</th>
                                    <th style=\"background-color: #303641;color: white\">Care Hours</th>
                                    <th style=\"background-color: #303641;color: white\">Rating</th>
                                    <th style=\"background-color: #303641;color: white\">Feedback</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
        $st = '';
        $so = '';
        $to = '';
        if (sizeof($fetch_data) > 0) {
            foreach ($fetch_data as $row) {
                if ($row->rating != null) {
                    $rating = $row->rating;
                } else {
                    $rating = 'N/A';
                }
                date_default_timezone_set('Asia/Dhaka');
                $starting_date = $this->home_care_lib->millisecond_to_time($row->clock_in_time);
                $starting_day = $this->home_care_lib->convert_date_day_format($row->schedule_date);
                $ending_date = $this->home_care_lib->millisecond_to_time($row->clock_out_time);
                $ending_date_new = $this->home_care_lib->millisecond_to_date($row->clock_out_time);
                $ending_day = $this->home_care_lib->convert_date_day_format($ending_date_new);
                $care_hours = $this->home_care_lib->millisecond_to_full_time($row->carehours);
                $create_table .= "<tr>
                                            <td><a href='" . site_url('caregiver/view_profile') . "/" . $row->caregiver_user_id . "' title='Go To Profile'>$row->caregiver_name</a></td>
                                            <td>$starting_day</td>
                                            <td>$starting_date</td>
                                            <td>$ending_day</td>
                                            <td>$ending_date</td>
                                            <td>$care_hours</td>
                                            <td>$rating</td>
                                            <td>$row->feedback</td>
                                      </tr>
                                      ";
            }
        }
        $create_table .= "</tbody>";
        echo $create_table;
    }

    public function millisecond_to_datetime($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time / 1000;
        $datetime = date('h:i A', $datetime);

        return $datetime;
    }

    public function millisecond_to_date($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time / 1000;
        $datetime = date('Y-m-d', $datetime);

        return $datetime;
    }

    public function millisecond_to_full_time($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time / 1000;
        $hours = floor($datetime / 3600);
        $minutes = floor(($datetime / 60) - ($hours * 60));
        $seconds = round($datetime - ($hours * 3600) - ($minutes * 60));
        $care_hours = $hours . ':' . $minutes . ':' . $seconds;

        return $care_hours;
    }

    /*public function get_chart_data()
    {
        $current_date = explode('-', $this->input->post('month_name'));
        $patient_id = $this->input->post('patient_id');
        $month_id = $current_date[1];
        $year_id = $current_date[0];
        $data = array();
        $care_hours = $this->Admin_model->get_patient_care_hours($patient_id, $month_id, $year_id);
        $consulting_hours = $this->Admin_model->get_patient_consulting_hours($patient_id, $month_id, $year_id);
        //print_r($consulting_hours);die();
        $index = 0;
        $temp = array();
        if ($care_hours) {
            for ($row = 0; $row < sizeof($care_hours); $row++) {
                $temp[$index]['schedule_date'] = $care_hours[$row]['schedule_date'];
                $temp[$index]['duty_hours'] = $care_hours[$row]['duty_hours'];
                $temp[$index]['consulting_hours'] = "0";
                $index++;
            }
        }
        //print_r($temp);die();
        if ($consulting_hours) {
            for ($column = 0; $column < sizeof($consulting_hours); $column++) {
                $temp[$index]['schedule_date'] = $consulting_hours[$column]['schedule_date'];
                $temp[$index]['duty_hours'] = "0";
                $temp[$index]['consulting_hours'] = $consulting_hours[$column]['duty_hours'];
                $index++;
            }
        }
        //print_r(sizeof($temp));die();
        if (sizeof($temp) > 1) {
            for ($new_row = 0; $new_row < sizeof($temp) - 1; $new_row++) {
                //print_r(sizeof($temp));die();
                // $check = "checking";
                if ($temp[$new_row]['schedule_date'] == $temp[$new_row + 1]['schedule_date']) {
                    $data[$new_row]['schedule_date'] = $temp[$new_row]['schedule_date'];
                    if ($temp[$new_row]['duty_hours'] > 0) {
                        $data[$new_row]['duty_hours'] = $temp[$new_row]['duty_hours'];
                    } else if ($temp[$new_row + 1]['duty_hours'] > 0) {
                        $data[$new_row]['duty_hours'] = $temp[$new_row + 1]['duty_hours'];
                    } else {
                        $data[$new_row]['duty_hours'] = "0";
                    }
                    if ($temp[$new_row]['consulting_hours'] > 0) {
                        $data[$new_row]['consulting_hours'] = $temp[$new_row]['consulting_hours'];
                    } else if ($temp[$new_row + 1]['consulting_hours'] > 0) {
                        $data[$new_row]['consulting_hours'] = $temp[$new_row + 1]['consulting_hours'];
                    } else {
                        $data[$new_row]['consulting_hours'] = "0";
                    }
                } else {
                    // print('yes');
                    $data[$new_row]['schedule_date'] = $temp[$new_row]['schedule_date'];
                    $data[$new_row]['duty_hours'] = $temp[$new_row]['duty_hours'];
                    $data[$new_row]['consulting_hours'] = $temp[$new_row]['consulting_hours'];
                }

            }
        } else if (sizeof($temp) == 1) {
               // print_r($temp);die();
                // $check = "checking";
                $data[0]['schedule_date'] = $temp[0]['schedule_date'];
                if ($temp[0]['duty_hours'] > 0) {
                    $data[0]['duty_hours'] = $temp[0]['duty_hours'];
                }
                else {
                    $data[0]['duty_hours'] = "0";
                }
                if ($temp[0]['consulting_hours'] > 0) {
                    $data[0]['consulting_hours'] = $temp[0]['consulting_hours'];
                }
                else {
                    $data[0]['consulting_hours'] = "0";
                }
        }
        // print_r($data);die();
        // print_r($temp);die();
        //  print_r($resp);die();
        print_r(json_encode($data));
    }*/
    public function get_chart_data()
    {
        //echo 'yes';die();
        $current_date = explode('-', $this->input->post('month_name'));
        $patient_id = $this->input->post('patient_id');
        //$month_id = $current_date[1];
      //  $year_id = $current_date[0];
        $start_date = $this->home_care_lib->get_start_date($current_date[1],$current_date[0]);
        $end_date = $this->home_care_lib->get_end_date($current_date[1],$current_date[0]);
        $data = array();
        $care_hours = $this->Admin_model->get_patient_care_hours($patient_id, $start_date, $end_date);
        $consulting_hours = $this->Admin_model->get_patient_consulting_hours($patient_id, $start_date, $end_date);
        //echo '<pre>';print_r($care_hours);die();
        $index = 0;
        $temp = array();
        if ($care_hours) {
            for ($row = 0; $row < sizeof($care_hours); $row++) {
                $temp[$index]['schedule_date'] = $care_hours[$row]['schedule_date'];
                $temp[$index]['duty_hours'] = $care_hours[$row]['duty_hours'];
                $temp[$index]['consulting_hours'] = "0";
                $index++;
            }
        }
        if ($consulting_hours) {
            for ($column = 0; $column < sizeof($consulting_hours); $column++) {
                $temp[$index]['schedule_date'] = $consulting_hours[$column]['schedule_date'];
                $temp[$index]['duty_hours'] = "0";
                $temp[$index]['consulting_hours'] = $consulting_hours[$column]['duty_hours'];
                $index++;
            }
        }
        //echo '<pre>';print_r($temp);die();
        if (sizeof($temp) > 1) {
            for ($new_row = 0; $new_row < sizeof($temp); $new_row++) {
                if($new_row == sizeof($temp)-1)
                {
                    $data[$new_row]['schedule_date'] = $temp[$new_row]['schedule_date'];
                    $data[$new_row]['duty_hours'] = $temp[$new_row]['duty_hours'];
                    $data[$new_row]['consulting_hours'] = $temp[$new_row]['consulting_hours'];
                }
                else{
                    if ($temp[$new_row]['schedule_date'] == $temp[$new_row + 1]['schedule_date']) {
                        $data[$new_row]['schedule_date'] = $temp[$new_row]['schedule_date'];
                        if ($temp[$new_row]['duty_hours'] > 0) {
                            $data[$new_row]['duty_hours'] = $temp[$new_row]['duty_hours'];
                        } else if ($temp[$new_row + 1]['duty_hours'] > 0) {
                            $data[$new_row]['duty_hours'] = $temp[$new_row + 1]['duty_hours'];
                        } else {
                            $data[$new_row]['duty_hours'] = "0";
                        }
                        if ($temp[$new_row]['consulting_hours'] > 0) {
                            $data[$new_row]['consulting_hours'] = $temp[$new_row]['consulting_hours'];
                        } else if ($temp[$new_row + 1]['consulting_hours'] > 0) {
                            $data[$new_row]['consulting_hours'] = $temp[$new_row + 1]['consulting_hours'];
                        } else {
                            $data[$new_row]['consulting_hours'] = "0";
                        }
                    } else {
                        $data[$new_row]['schedule_date'] = $temp[$new_row]['schedule_date'];
                        $data[$new_row]['duty_hours'] = $temp[$new_row]['duty_hours'];
                        $data[$new_row]['consulting_hours'] = $temp[$new_row]['consulting_hours'];
                    }
                }
            }
        } else if (sizeof($temp) == 1) {
                $data[0]['schedule_date'] = $temp[0]['schedule_date'];
                if ($temp[0]['duty_hours'] > 0) {
                    $data[0]['duty_hours'] = $temp[0]['duty_hours'];
                }
                else {
                    $data[0]['duty_hours'] = "0";
                }
                if ($temp[0]['consulting_hours'] > 0) {
                    $data[0]['consulting_hours'] = $temp[0]['consulting_hours'];
                }
                else {
                    $data[0]['consulting_hours'] = "0";
                }
        }
        //echo '<pre>';print_r($data);die();
        print_r(json_encode($data));
    }
    public function change_status()
    {
        $id = $this->input->post('status_id');
        $get_status = $this->Admin_model->get_status($id);
        if ($get_status->status == 0) {
            $data['status'] = 1;
            $this->Admin_model->change_status($id, $data);
            $this->session->set_flashdata('success_msg', 'Patient Status Has Been Changed Successfully.');
            redirect('patient/manage_patients', 'refresh');
        }
        if ($get_status->status == 1) {
            $data['status'] = 0;
            $this->Admin_model->change_status($id, $data);
            $this->session->set_flashdata('error_msg', 'Patient Status Has Been Changed Successfully.');
            redirect('patient/manage_patients', 'refresh');
        }
    }

    public function reset_password()
    {
        $data['password'] = md5("123456");
        //echo '<pre>';print_r($data);die();
        $this->Admin_model->reset_password($this->input->post('password_id'), $data);
        $this->session->set_flashdata('success_msg', 'Password Reset Successful.');
        redirect('patient/manage_patients', 'refresh');
    }

    public function history_add_post()
    {
        // echo '<pre>';print_r($_POST);die();
        if ((isset($_POST['disease']) && isset($_POST['time_period']))) {
            $data['disease'] = $this->input->post('disease');
            $data['time_period'] = $this->input->post('time_period');
            $data['activities'] = $this->input->post('activities');
            $data['medication'] = $this->input->post('medication');
            $data['created_date'] = date('Y-m-d');
            $data['tbl_patient_user_patient_id'] = $this->input->post('history_patient_id');
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
            // echo '<pre>';print_r($data);die();
            $insert_id = $this->Admin_model->insert_ret('tbl_patient_medical_history', $data);
            // echo '<pre>';print_r($insert_id);die();
            if (isset($insert_id)) {
                $this->session->set_flashdata('success_msg', 'Patient History Has Been Added Successfully.');
                redirect('patient/show_profile/' . $this->input->post('history_patient_id'), 'refresh');
            } else {
                $this->session->set_flashdata('error_msg', 'Patient History Can Not Be Added.');
                redirect('patient/show_profile/' . $this->input->post('history_patient_id'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Patient History Can Not Be Added.');
            redirect('patient/show_profile/' . $this->input->post('history_patient_id'), 'refresh');
        }
    }

    public function delete_history()
    {
        // echo '<pre>';print_r($_POST);die();
        $id = $this->input->post('history_id');
        $patient_id = $this->input->post('h_patient_id');
        $this->Admin_model->delete_history($id);
        $this->session->set_flashdata('success_msg', 'Patient History Has Been Deleted Successfully.');
        redirect('patient/show_profile/' . $patient_id, 'refresh');

    }

    public function history_edit_post()
    {
        // echo '<pre>';print_r($_POST);die();
        $id = $this->input->post('history_edit_id');
        $patient_id = $this->input->post('history_patient_edit_id');
        if ((($_POST['e_disease'] != "") && ($_POST['e_time_period'] != ""))) {
            $data['disease'] = $this->input->post('e_disease');
            $data['time_period'] = $this->input->post('e_time_period');
            $data['activities'] = $this->input->post('e_activities');
            $data['medication'] = $this->input->post('e_medication');

            $this->Admin_model->update_medical_history($id, $data);
            $this->session->set_flashdata('success_msg', 'Patient History Has Been Updated Successfully.');
            redirect('patient/show_profile/' . $patient_id, 'refresh');
            //  echo 'isset';
        } else {
            $this->session->set_flashdata('error_msg', 'Patient History Can Not Be Updated!');
            redirect('patient/show_profile/' . $patient_id, 'refresh');
            //echo 'not isset';
        }
    }
}