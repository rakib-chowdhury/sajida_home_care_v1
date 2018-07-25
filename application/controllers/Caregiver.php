<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caregiver extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login_id')!=null)
        {
            $this->load->model('Caregiver_model');
            $this->load->model('Admin_model');
            $this->load->library('Home_care_lib');
        }
        else
        {
            redirect(base_url().'login');
        }
    }

    public function add_caregiver()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 4) {
            $data['availability'] = $this->Caregiver_model->getAllRecords('tbl_caregiver_availability');
            $data['app_user'] = $this->Caregiver_model->getAllRecords('tbl_app_user_type');
            $data['bank_info'] = $this->Caregiver_model->getAllRecords('tbl_bank_payment');
            $data['payment_method'] = $this->Caregiver_model->getAllRecords('tbl_mobile_payment_method');
            $data['level_care_info'] = $this->Caregiver_model->getAllRecords('tbl_level_care_type');
            $data['engagement_type'] = $this->Caregiver_model->getAllRecords('tbl_caregiver_engagment_type');
            $data['master_body'] = $this->load->view('admin/caregiver/add_caregiver', $data, true);
            $data['active_page'] = 'Add Caregiver';
            $this->load->view('admin/master', $data);
        }else{
            $data['master_body'] = $this->load->view('admin/access_denied_page',$data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function manage_caregiver()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
            $data['get_caregiver_info'] = $this->Caregiver_model->get_caregivers_new();
            $data['path'] = FCPATH;
            $data['master_body'] = $this->load->view('admin/caregiver/manage_caregiver', $data, true);
            $data['active_page'] = 'Manage Caregiver';
            $this->load->view('admin/master', $data);
        }else{
            $data['master_body'] = $this->load->view('admin/access_denied_page',$data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function caregiver_add_post()
    {
        if (isset($_POST['caregiver_name']) && isset($_POST['caregiver_dob']) && isset($_POST['phone_number']) &&
            isset($_POST['caregiver_address']) && isset($_POST['joining_date'])
        ) {
            $dob = explode('/', $this->input->post('caregiver_dob'));
            $dob = $dob[2].'-'.$dob[0].'-'.$dob[1];
            $join_date = explode('/', $this->input->post('joining_date'));
            $join_date = $join_date[2].'-'.$join_date[0].'-'.$join_date[1];
            $new_date = explode('/', $this->input->post('joining_date'));
            $cg_id = $new_date[1] . $new_date[0] . substr($new_date[2], 2, 3);
            $table_name = 'tbl_caregiver_user';
            $count_caregiver = $this->Caregiver_model->count_caregiver($table_name, $join_date);
            $count_caregiver = $count_caregiver + 1;

            $data['caregiver_user_id'] = 'CG'.$cg_id .$count_caregiver;
            $caregiver_user_id = $data['caregiver_user_id'];
            $data['caregiver_name'] = $this->input->post('caregiver_name');
            $data['NID_number'] = $this->input->post('caregiver_nid');
            $data['DOB'] = $dob;
            $data['gender'] = $this->input->post('caregiver_gender');
            if ($this->input->post('caregiver_gender') == 'on') {
                $data['gender'] = 1;
            } else {
                $data['gender'] = 0;
            }
            $data['blood_group'] = $this->input->post('blood_group');
            $data['phone_number'] = $this->input->post('phone_number');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('caregiver_address');
            $data['joining_date'] = $join_date;
            $data['stored_document'] = $this->input->post('stored_document');
            $data['educational_background'] = $this->input->post('educational_background');
            $data['tbl_level_care_type_level_care_type_id'] = $this->input->post('level_care');
            $data['tbl_caregiver_engagment_type_caregiver_engagment_type_id'] = $this->input->post('tbl_caregiver_engagment_type_caregiver_engagment_type_id');
            $data['tbl_app_user_type_app_user_type_id'] = 1;
            if ($_FILES['caregiver_image']['error'] == 4) {
                $insert_id = $this->Caregiver_model->insert_ret('tbl_caregiver_user', $data);
                $caregiver_id = $this->Caregiver_model->getWhere('caregiver_user_id', "caregiver_user_id='$data[caregiver_user_id]'", 'tbl_caregiver_user');
            } else {
                $image_ext = explode('.', $_FILES['caregiver_image']['name']);
                $extension = end($image_ext);
                if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                    $target_path = 'uploads/caregiver_image/caregiver_image_' . rand(100 * 100, 500 * 500) . '.' . $extension;
                    if (move_uploaded_file($_FILES['caregiver_image']['tmp_name'], $target_path)) {
                        $data['picture'] = $target_path;
                        $insert_id = $this->Caregiver_model->insert_ret('tbl_caregiver_user', $data);
                        $caregiver_id = $this->Caregiver_model->getWhere('caregiver_user_id', "caregiver_user_id='$data[caregiver_user_id]'", 'tbl_caregiver_user');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Data Can Not Be Added. Please Insert Data Correctly.');
                }
            }
            $data7['user_id'] = $caregiver_id['caregiver_user_id'];
            $data7['password'] = md5("123456");
            $data7['status'] = 1;
            $data7['tbl_app_user_type_app_user_type_id'] = 1;
            $insert_id = $this->Caregiver_model->insert_ret('tbl_app_user_login', $data7);
            $data1 = array();
            if ($this->input->post('caregiver_availability') != null) {
                foreach ($this->input->post('caregiver_availability') as $row) {
                    $data1[$row] = 1;
                }
                $data1['tbl_caregiver_user_caregiver_user_id'] = $caregiver_user_id;
                $this->Caregiver_model->insert('tbl_caregiver_availability', $data1);
            }
            if ($this->input->post('payment_type') == 'Cash') {
                $data6['fixed_salary_rate'] = $this->input->post('fixed_salary_rate');
                $data6['hourly_salary_rate'] = $this->input->post('hourly_salary_rate');
                $data6['payment_type'] = $this->input->post('payment_type');
                $data6['bank_account_number'] = 0;
                $data6['mobile_payment_number'] = 0;
                $data6['tbl_caregiver_user_caregiver_user_id'] = $caregiver_user_id;
                $data6['tbl_caregiver_engagment_type_caregiver_engagment_type_id'] = $this->input->post('tbl_caregiver_engagment_type_caregiver_engagment_type_id');

                $this->Caregiver_model->insert('tbl_caregiver_salary', $data6);
            } else {
                $data6['fixed_salary_rate'] = $this->input->post('fixed_salary_rate');
                $data6['hourly_salary_rate'] = $this->input->post('hourly_salary_rate');
                $data6['payment_type'] = $this->input->post('payment_type');
                if($this->input->post('tbl_bank_payment_bank_id') == -1)
                {
                    $data6['tbl_bank_payment_bank_id'] = 0;
                }else{
                    $data6['tbl_bank_payment_bank_id'] = $this->input->post('tbl_bank_payment_bank_id');
                }
                $data6['bank_account_number'] = $this->input->post('bank_account_number');
                if($this->input->post('mobile_payment_method_id') == -1)
                {
                    $data6['tbl_mobile_payment_method_id'] = 0;
                }else{
                    $data6['tbl_mobile_payment_method_id'] = $this->input->post('mobile_payment_method_id');
                }
                $data6['mobile_payment_number'] = $this->input->post('mobile_payment_number');
                $data6['tbl_caregiver_user_caregiver_user_id'] = $caregiver_user_id;
                $data6['tbl_caregiver_engagment_type_caregiver_engagment_type_id'] = $this->input->post('tbl_caregiver_engagment_type_caregiver_engagment_type_id');
                $this->Caregiver_model->insert('tbl_caregiver_salary', $data6);
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
                $data2['tbl_caregiver_user_caregiver_user_id'] = $caregiver_user_id;
                $this->Caregiver_model->insert('tbl_caregiver_family_contact', $data2);
            }
            if (($this->input->post('family_contact_name_1') != null) ||
                ($this->input->post('family_contact_relationship_1') != null) ||
                ($this->input->post('family_contact_phone_1') != null)
            ) {
                $data3['family_contact_name'] = $this->input->post('family_contact_name_1');
                $data3['relationship'] = $this->input->post('family_contact_relationship_1');
                $data3['phone_number'] = $this->input->post('family_contact_phone_1');
                $data3['email'] = $this->input->post('family_contact_email_1');
                $data3['address'] = $this->input->post('family_contact_address_1');
                $data3['is_emergency'] = '0';
                $data3['tbl_caregiver_user_caregiver_user_id'] = $caregiver_user_id;
                $this->Caregiver_model->insert('tbl_caregiver_family_contact', $data3);
            }
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
                $data4['tbl_caregiver_user_caregiver_user_id'] = $caregiver_user_id;
                $this->Caregiver_model->insert('tbl_caregiver_family_contact', $data4);
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
                $data5['tbl_caregiver_user_caregiver_user_id'] = $caregiver_user_id;
                $this->Caregiver_model->insert('tbl_caregiver_family_contact', $data5);
            }
            $this->session->set_flashdata('success_msg', 'Caregiver Has Been Added Successfully.');
            redirect('caregiver/manage_caregiver', 'refresh');
            //echo 'yes';die();
        } else {
            $this->session->set_flashdata('error_msg', 'Caregiver Can Not Be Added. Please Insert Information Correctly.');
            redirect('caregiver/add_caregiver', 'refresh');
        }
    }

    public function edit_caregiver($id)
    {
        $caregiver_id = $id;
        $data = array();
        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
            $data['caregiver_info'] = $this->Caregiver_model->getAllCaregiver($caregiver_id);
            $data['level_care'] = $this->Caregiver_model->getAllRecords('tbl_level_care_type');
            $data['app_user'] = $this->Caregiver_model->getAllRecords('tbl_app_user_type');
            $data['bank_info'] = $this->Caregiver_model->getAllRecords('tbl_bank_payment');
            $data['payment_method'] = $this->Caregiver_model->getAllRecords('tbl_mobile_payment_method');
            $data['availability'] = $this->Caregiver_model->getAllRecords('tbl_caregiver_availability');
            $data['engagement_type'] = $this->Caregiver_model->getAllRecords('tbl_caregiver_engagment_type');
            $data['caregiver_salary'] = $this->Caregiver_model->getCaregiverSalary('tbl_caregiver_salary', $id);
            $data['get_caregiver'] = $this->Caregiver_model->editCaregiver($caregiver_id);
            $data['emergency_contact'] = $this->Caregiver_model->getEmergencyContact($caregiver_id);
            $data['family_contact'] = $this->Caregiver_model->getFamilyContact($caregiver_id);
            if (sizeof($data['family_contact']) != null) {
                foreach ($data['family_contact'] as $key => $row) {
                    $key = $key + 1;
                    $data["family_contact_id_$key"] = $row['caregiver_family_contact_id'];
                    $data["family_contact_name_$key"] = $row['family_contact_name'];
                    $data["family_contact_relationship_$key"] = $row['relationship'];
                    $data["family_contact_phone_$key"] = $row['phone_number'];
                    $data["family_contact_email_$key"] = $row['email'];
                    $data["family_contact_address_$key"] = $row['address'];
                }
            }
            if (sizeof($data['get_caregiver']) != null) {
                $data['top_header'] = $this->load->view('admin/top_header', '', true);
                $data['footer'] = $this->load->view('admin/footer', '', true);
                $data['active_page'] = 'Edit Patient Info';
                $data['master_body'] = $this->load->view('admin/caregiver/edit_caregiver', $data, true);
                $data['active_page'] = 'Manage Caregiver';
                $this->load->view('admin/master', $data);
            } else {
                $data['top_header'] = $this->load->view('admin/top_header', '', true);
                $data['footer'] = $this->load->view('admin/footer', '', true);
                $data['master_body'] = $this->load->view('admin/error_page', $data, true);
                $data['active_page'] = 'Error';
                $this->load->view('admin/master', $data);
            }
        }else{
            $data['master_body'] = $this->load->view('admin/access_denied_page',$data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function caregiver_edit_post()
    {
        $caregiver_id = $this->input->post('id');
        $contact1_id = $this->input->post('contact1_id');
        $contact2_id = $this->input->post('contact2_id');
        $contact3_id = $this->input->post('contact3_id');
        $emergency_contact = $this->input->post('emergency_contact');
        if (isset($_POST['joining_date']) && isset($_POST['caregiver_name']) && isset($_POST['phone_number']) &&
            isset($_POST['caregiver_dob']) && isset($_POST['caregiver_address']) && isset($_FILES['caregiver_image'])
        ) {
            $data['caregiver_name'] = $this->input->post('caregiver_name');
            $data['NID_number'] = $this->input->post('caregiver_nid');
            $birth_date = explode('/', $this->input->post('caregiver_dob'));
            $birth_date = $birth_date[2].'-'.$birth_date[0].'-'.$birth_date[1];
            $data['DOB'] = $birth_date;
            $joining_date = explode('/', $this->input->post('joining_date'));
            $joining_date = $joining_date[2].'-'.$joining_date[0].'-'.$joining_date[1];
            $prev_gender = $this->Caregiver_model->get_caregiver_gender($caregiver_id);
            if(isset($_POST['cg_gender']))
            {
                if($_POST['cg_gender'] == "on")
                {
                    if($prev_gender[0]['gender'] == 1)
                    {
                        $data['gender'] = 0;
                    }
                    else
                    {
                        $data['gender'] = 1;
                    }
                }
                else
                {
                    $data['gender'] = $prev_gender[0]['gender'];
                }
            }
            $data['blood_group'] = $this->input->post('blood_group');
            $data['phone_number'] = $this->input->post('phone_number');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('caregiver_address');
            $data['joining_date'] = $joining_date;
            $data['stored_document'] = $this->input->post('stored_document');
            $data['educational_background'] = $this->input->post('educational_background');
            $data['tbl_level_care_type_level_care_type_id'] = $this->input->post('level_care');
            $data['tbl_caregiver_engagment_type_caregiver_engagment_type_id'] = $this->input->post('tbl_caregiver_engagment_type_caregiver_engagment_type_id');
            $data['tbl_app_user_type_app_user_type_id'] = 1; //have to check session after implementing login
            $table_name1 = 'tbl_caregiver_user';
            $image = $this->Caregiver_model->getWhere('picture', "caregiver_user_id='$caregiver_id'", $table_name1);
            if ($_FILES['caregiver_image']['error'] == 4) {
                $data['picture'] = $image['picture'];
                $update_id = $this->Caregiver_model->updateCond("caregiver_user_id='$caregiver_id'", 'tbl_caregiver_user', $data);
            } else {
                $image_ext = explode('.', $_FILES['caregiver_image']['name']);
                $extension = end($image_ext);
                $image_name = explode('.', $image['picture']);
                $old_image_name = explode('/', $image['picture']);
                if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                    $target_path = $image_name[0].'.'.$extension;
                    unlink('uploads/caregiver_image/' . $old_image_name[2]);
                    if (move_uploaded_file($_FILES['caregiver_image']['tmp_name'], $target_path)) {
                        $data['picture'] = $target_path;
                        $update_id = $this->Caregiver_model->update_function('caregiver_user_id', $caregiver_id, $table_name1, $data);
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Data Can Not Be Added. Please Insert Data Correctly.');
                    redirect('caregiver/edit_caregiver', 'refresh');
                }
            }
            $this->Caregiver_model->delete_availability($caregiver_id);
            $data1 = array();
            if ($this->input->post('caregiver_availability') != null) {
                foreach ($this->input->post('caregiver_availability') as $row) {
                    $data1[$row] = 1;
                }
                $data1['tbl_caregiver_user_caregiver_user_id'] = $caregiver_id;
                $this->Caregiver_model->insert('tbl_caregiver_availability', $data1);
            }
            $data6['fixed_salary_rate'] = $this->input->post('fixed_salary_rate');
            $data6['hourly_salary_rate'] = $this->input->post('hourly_salary_rate');
            if ($this->input->post('payment_type') == 'Cash') {
                $data6['payment_type'] = 'Cash';
                $data6['tbl_bank_payment_bank_id'] = 0;
                $data6['bank_account_number'] = 0;
                $data6['tbl_mobile_payment_method_id'] = 0;
                $data6['mobile_payment_number'] = 0;
                $data6['tbl_caregiver_user_caregiver_user_id'] = $caregiver_id;
                $data6['tbl_caregiver_engagment_type_caregiver_engagment_type_id'] = $this->input->post('tbl_caregiver_engagment_type_caregiver_engagment_type_id');
            }
            //echo '<pre>';print_r($data6);die();
            if ($this->input->post('payment_type') == 'Bank') {
                $data6['payment_type'] = 'Bank';
                $data6['tbl_bank_payment_bank_id'] = $this->input->post('tbl_bank_payment_bank_id');
                $data6['bank_account_number'] = $this->input->post('bank_account_number');
                $data6['mobile_payment_number'] = 0;
                $data6['tbl_caregiver_engagment_type_caregiver_engagment_type_id'] = $this->input->post('tbl_caregiver_engagment_type_caregiver_engagment_type_id');
            }
            if ($this->input->post('payment_type') == 'Mobile') {
                $data6['payment_type'] = 'Mobile';
                $data6['bank_account_number'] = 0;
                $data6['tbl_mobile_payment_method_id'] = $this->input->post('mobile_payment_method_id');
                $data6['mobile_payment_number'] = $this->input->post('mobile_payment_number');
                $data6['tbl_caregiver_engagment_type_caregiver_engagment_type_id'] = $this->input->post('tbl_caregiver_engagment_type_caregiver_engagment_type_id');
            }
            $salary_id = $this->input->post('salary_id');
            $update_id = $this->Caregiver_model->update_function('caregiver_salary_id', $salary_id, 'tbl_caregiver_salary', $data6);
            //echo '<pre>';print_r($data6);die();
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
                $data2['tbl_caregiver_user_caregiver_user_id'] = $caregiver_id;
                $this->Caregiver_model->updateCaregiverAll("caregiver_family_contact_id='$emergency_contact'", 'tbl_caregiver_family_contact', $data2);
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
                $data3['tbl_caregiver_user_caregiver_user_id'] = $caregiver_id;
                if($contact1_id)
                {
                    $this->Caregiver_model->updateCaregiverAll("caregiver_family_contact_id='$contact1_id'", 'tbl_caregiver_family_contact', $data3);
                }
                else{
                    $this->Caregiver_model->insert('tbl_caregiver_family_contact', $data3);
                }
            }
            if (($this->input->post('family_contact_name_2')) ||
                ($this->input->post('family_contact_relationship_2')) ||
                ($this->input->post('family_contact_phone_2'))
            ) {
                $data4['family_contact_name'] = $this->input->post('family_contact_name_2');
                $data4['relationship'] = $this->input->post('family_contact_relationship_2');
                $data4['phone_number'] = $this->input->post('family_contact_phone_2');
                $data4['email'] = $this->input->post('family_contact_email_2');
                $data4['address'] = $this->input->post('family_contact_address_2');
                $data4['is_emergency'] = '0';
                $data4['tbl_caregiver_user_caregiver_user_id'] = $caregiver_id;
                if($contact2_id)
                {
                    $this->Caregiver_model->updateCaregiverAll("caregiver_family_contact_id='$contact2_id'", 'tbl_caregiver_family_contact', $data4);
                }
                else{
                    $this->Caregiver_model->insert('tbl_caregiver_family_contact', $data4);
                }
            }
            if (($this->input->post('family_contact_name_3')) ||
                ($this->input->post('family_contact_relationship_3')) ||
                ($this->input->post('family_contact_phone_3'))
            ) {
                $data5['family_contact_name'] = $this->input->post('family_contact_name_3');
                $data5['relationship'] = $this->input->post('family_contact_relationship_3');
                $data5['phone_number'] = $this->input->post('family_contact_phone_3');
                $data5['email'] = $this->input->post('family_contact_email_3');
                $data5['address'] = $this->input->post('family_contact_address_3');
                $data5['is_emergency'] = '0';
                $data5['tbl_caregiver_user_caregiver_user_id'] = $caregiver_id;
                if($contact3_id)
                {
                    $this->Caregiver_model->updateCaregiverAll("caregiver_family_contact_id='$contact3_id'", 'tbl_caregiver_family_contact', $data5);
                }
                else{
                    $this->Caregiver_model->insert('tbl_caregiver_family_contact', $data5);
                }
            }
            $this->session->set_flashdata('success_msg', 'Caregiver Has Been Updated Successfully.');
            redirect('caregiver/manage_caregiver', 'refresh');
        } else {
            $this->session->set_flashdata('error_msg', 'Caregiver Can Not Be Added. Please Insert Information Correctly.');
            redirect('caregiver/edit_caregiver', 'refresh');
        }
    }
    
    public function show_profile($id)
    {
        if($this->Caregiver_model->check_caregiver($id))
        {
            $caregiver_id = $id;
            date_default_timezone_set('Asia/Dhaka');
            $data = array();
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $get_rating = $this->Caregiver_model->get_rating($id);
            $total_rows = sizeof($get_rating);
            $rating = $this->Caregiver_model->get_only_rating($id);
            $total_rating_points = 0;
            if($total_rows > 0 && sizeof($rating) > 0)
            {
                foreach ($rating as $row)
                {
                    $total_rating_points += $row->rating;
                }
                $data['total_rating'] = $total_rating_points/sizeof($rating);
            }
            $data['caregiver_info'] = $this->Admin_model->CaregiverGetWhereJoin('*', "caregiver_user_id='$caregiver_id'", 'tbl_caregiver_user');
            $data['appointments'] = $this->Admin_model->caregiver_appointment_count($caregiver_id);
            $data['e_contact'] = $this->Admin_model->get_caregiver_e_contact($caregiver_id);
            $data['schedule_id'] = $this->Admin_model->get_caregiver_carehour($caregiver_id);
            $data['f_contacts'] = $this->Admin_model->SingelGetWhere('*', "tbl_caregiver_user_caregiver_user_id='$caregiver_id'", 'tbl_caregiver_family_contact');
            $get_financial_info = $this->Caregiver_model->get_financial_info($caregiver_id);
            if($get_financial_info)
            {
                if($get_financial_info->payment_type == 'Cash')
                {
                    $data['financial_info']['payment_type'] = $get_financial_info->payment_type;
                    $data['financial_info']['fixed_salary_rate'] = $get_financial_info->fixed_salary_rate;
                    $data['financial_info']['hourly_salary_rate'] = $get_financial_info->hourly_salary_rate;
                }
                else if($get_financial_info->payment_type == 'Bank')
                {
                    $data['financial_info']['payment_type'] = $get_financial_info->payment_type;
                    $data['financial_info']['fixed_salary_rate'] = $get_financial_info->fixed_salary_rate;
                    $data['financial_info']['hourly_salary_rate'] = $get_financial_info->hourly_salary_rate;
                    $data['financial_info']['bank_name'] = $get_financial_info->bank_name;
                    $data['financial_info']['bank_account_number'] = $get_financial_info->bank_account_number;
                }
                else if($get_financial_info->payment_type == 'Mobile')
                {
                    $data['financial_info']['payment_type'] = $get_financial_info->payment_type;
                    $data['financial_info']['fixed_salary_rate'] = $get_financial_info->fixed_salary_rate;
                    $data['financial_info']['hourly_salary_rate'] = $get_financial_info->hourly_salary_rate;
                    $data['financial_info']['payment_method_name'] = $get_financial_info->payment_method_name;
                    $data['financial_info']['mobile_payment_number'] = $get_financial_info->mobile_payment_number;
                }
            }
            //echo '<pre>';print_r($data);die();
            $data['total_hours'] = 0;
            if (sizeof($data['schedule_id']) != null) {
                foreach ($data['schedule_id'] as $key => $row) {
                    $carehours = $this->Admin_model->get_care_hours($row->tbl_schedule_maker_schedule_maker_id);
                    if(sizeof($carehours) > 0)
                    {
                        $total_hours = $carehours[0]->carehours;
                        $data['total_hours'] += $total_hours;
                    }
                }
            }
            //till this
            $data['path'] = base_url(str_replace(FCPATH,"", __DIR__ )).'/';
            $get_schedule = $this->Admin_model->caregiver_upcoming_schedule($caregiver_id);
            foreach ($get_schedule as $key=>$row)
            {
                $data['get_schedule'][$key]['patient_name'] = $row->patient_name;
                $data['get_schedule'][$key]['patient_id'] = $row->patient_id;
                $data['get_schedule'][$key]['starting_date'] = $this->home_care_lib->get_date_day_from_millisecond($row->start_time);
                $data['get_schedule'][$key]['starting_time'] = $this->home_care_lib->millisecond_to_time($row->start_time);
                $data['get_schedule'][$key]['ending_date'] = $this->home_care_lib->get_date_day_from_millisecond($row->end_time);
                $data['get_schedule'][$key]['ending_time'] = $this->home_care_lib->millisecond_to_time($row->end_time);
            }
            $data['get_care_history'] = $this->Admin_model->caregiver_care_history($caregiver_id);
            $data['master_body'] = $this->load->view('admin/caregiver_profile/show_profile', $data, true);
            $data['active_page'] = 'Manage Caregiver';
            $this->load->view('admin/master', $data);
        }
        else{
            redirect('error');
        }
    }
    
    public function fetch_history()
    {
        $month_name = explode('-', $this->input->post('month_name'));
        $caregiver_id = $this->input->post('caregiver_id');
        $caregiver_name = $this->input->post('caregiver_name');
        $start_date = $this->home_care_lib->get_start_date($month_name[1], $month_name[0]);
        $end_date = $this->home_care_lib->get_end_date($month_name[1], $month_name[0]);
        $fetch_data = $this->Admin_model->fetch_history_caregiver($caregiver_id, $start_date, $end_date);
        $dutyhours = 0;
        $overtime = 0;
        $create_table = "<script type=\"text/javascript\">
                                    jQuery(document).ready(function ($) {
                                        var table4 = jQuery(\"#table-4\");

                                        table4.DataTable({
                                            dom: 'Bfrtip',
                                            \"sScrollX\": \"100%\",
                                            buttons: [
                                                {
                                                    extend: 'excelHtml5',
                                                    title: \"$caregiver_name\"+'_'+\"$caregiver_id\"
                                                },
                                                {
                                                    extend: 'pdfHtml5',
                                                    title: \"$caregiver_name\"+'_'+\"$caregiver_id\"
                                                }
                                            ]
                                        });
                                    });
                                </script>";
        $create_table .= "<table class=\"table table-bordered datatable\" id=\"table-4\" width=\"100%\" >
                                <thead>
                                <tr>
                                    <th style=\"background-color: #303641;color: white\">Patient Name</th>
                                    <th style=\"background-color: #303641;color: white\">Level</th>
                                    <th style=\"background-color: #303641;color: white\">Starting Date</th>
                                    <th style=\"background-color: #303641;color: white\">Clock-in Time</th>
                                    <th style=\"background-color: #303641;color: white\">Ending Date</th>
                                    <th style=\"background-color: #303641;color: white\">Clock-out Time</th>
                                    <th style=\"background-color: #303641;color: white\">Duty Hours</th>
                                    <th style=\"background-color: #303641;color: white\">Over Time</th>
                                    <th style=\"background-color: #303641;color: white\">Rating</th>
                                    <th style=\"background-color: #303641;color: white\">Feedback</th>
                                    <th style=\"background-color: #303641;color: white; width: 5%\">Show Cause</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
        if (sizeof($fetch_data) > 0) {
            foreach ($fetch_data as $row) {
                //date_default_timezone_set('Asia/Dhaka');
                if($row->rating != null)
                {
                    $rating = $row->rating;
                }
                else
                {
                    $rating = 'N/A';
                }
                //date_default_timezone_set('Asia/Dhaka');
                $care_hours = $this->home_care_lib->millisecond_to_full_time($row->clock_out_time - $row->clock_in_time);
                $starting_date = $this->home_care_lib->convert_date_day_format($row->schedule_date);
                $starting_time = $this->home_care_lib->millisecond_to_time($row->clock_in_time);
                $ending_time = $this->home_care_lib->millisecond_to_time($row->clock_out_time);
                $ending_date_new = $this->home_care_lib->millisecond_to_date($row->clock_out_time);
                $ending_date = $this->home_care_lib->convert_date_day_format($ending_date_new);
                if($row->scheduled_hours > $row->carehours)
                {
                    $dutyhours = $this->home_care_lib->millisecond_to_hour_min_time($row->carehours);
                    $overtime = 0;
                }else
                {
                    $dutyhours = $this->home_care_lib->millisecond_to_hour_min_time($row->scheduled_hours);
                    $overtime = $this->home_care_lib->millisecond_to_hour_min_time($row->carehours - $row->scheduled_hours);
                }
                $create_table .= "<tr>
                                       <td><a href='".site_url('patient/view_profile')."/".$row->patient_id."' title='Go To Profile'>$row->patient_name</a></td>
                                       <td>$row->level_name</td>
                                       <td>$starting_date</td>
                                       <td>$starting_time</td>
                                       <td>$ending_date</td>
                                       <td>$ending_time</td>
                                       <td>$dutyhours</td>
                                       <td>$overtime</td>
                                       <td>$rating</td>
                                       <td>$row->feedback</td>
                                       <td>$row->caregiver_schedule_feedback</td>
                                   </tr>
                                   ";
            }
        }
        $create_table.="</tbody>";
        echo $create_table;
    }

    public function get_chart_data()
    {
        $current_date = explode('-', $this->input->post('month_name'));
        $caregiver_id = $this->input->post('caregiver_id');
        $start_date = $this->home_care_lib->get_start_date($current_date[1],$current_date[0]);
        $end_date = $this->home_care_lib->get_end_date($current_date[1],$current_date[0]);
        $data = $this->Admin_model->get_caregiver_chart_data($caregiver_id, $start_date, $end_date);
        //print_r($data);die();
        for($key = 0; $key < sizeof($data); $key++)
        {
            if($data[$key]['scheduled_hours'] > $data[$key]['carehours'])
            {
                $data[$key]['dutyhours'] = $this->home_care_lib->millisecond_to_hour_min_time($data[$key]['carehours']);
                $data[$key]['overtime'] = 0;
            }
            else{
                $data[$key]['dutyhours'] = $this->home_care_lib->millisecond_to_hour_min_time($data[$key]['scheduled_hours']);
                $data[$key]['overtime'] = $this->home_care_lib->millisecond_to_hour_min_time($data[$key]['carehours'] - $data[$key]['scheduled_hours']);
            }
        }
        print_r(json_encode($data));
    }

    public function change_status()
    {
        $id = $this->input->post('status_id');
        $get_status = $this->Admin_model->get_status($id);
        if($get_status->status == 0)
        {
            $data['status'] = 1;
            $this->Admin_model->change_status($id, $data);
            $this->session->set_flashdata('success_msg', 'Caregiver Status Has Been Changed Successfully.');
            redirect('caregiver/manage_caregiver', 'refresh');
        }
        if($get_status->status == 1)
        {
            $data['status'] = 0;
            $this->Admin_model->change_status($id, $data);
            $this->session->set_flashdata('success_msg', 'Caregiver Status Has Been Changed Successfully.');
            redirect('caregiver/manage_caregiver', 'refresh');
        }
    }
    
    public function reset_password()
    {
        $data['password'] = md5("123456");
        //echo '<pre>';print_r($data);die();
        $this->Admin_model->reset_password($this->input->post('password_id'), $data);
        $this->session->set_flashdata('success_msg', 'Password Reset Successful.');
        redirect('caregiver/manage_caregiver', 'refresh');
    }


}