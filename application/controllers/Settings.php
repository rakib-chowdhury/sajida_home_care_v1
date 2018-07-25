<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (($this->session->userdata('login_id') != null) && ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 4)) {
            $this->load->model('Admin_model');
        } else {
            redirect(base_url() . 'login');
        }
    }

    //####Area Code####
    public function add_area_code()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['master_body'] = $this->load->view('admin/settings/area_code/add_area_code', $data, true);
        $data['active_page'] = 'New Area Code';
        $this->load->view('admin/master', $data);
    }

    public function area_code_add_post()
    {
        if (isset($_POST)) {
            $data['name'] = $this->input->post('name');
            $data['area_code_id'] = $this->input->post('area_code');
            $data['location'] = $this->input->post('location');
            $chk_area = $this->Admin_model->SingelGetWhere('*', 'area_code_id=' . $this->input->post('area_code'), 'tbl_area_code');
            if (sizeof($chk_area) == null) {
                $chk = $this->Admin_model->insert_ret('tbl_area_code', $data);
                if (isset($chk)) {
                    $this->session->set_flashdata('success_msg', 'Area Code Added Successfully');
                    redirect('settings/manage_area_code', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Area Code Already Exists');
                redirect('settings/add_area_code', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Area Code Can Not Be Added');
            redirect('settings/add_area_code', 'refresh');
        }
    }

    public function manage_area_code()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['get_area_codes'] = $this->Admin_model->getAllRecords('tbl_area_code');
        $data['master_body'] = $this->load->view('admin/settings/area_code/manage_area_code', $data, true);
        $data['active_page'] = 'Manage Area Code';
        $this->load->view('admin/master', $data);
    }

    public function edit_area_code($id)
    {
        if (!preg_match("/^[0-9]*$/", $id)) {
            redirect('error');
        } else {
            $area = $id;
            $selector = '*';
            $condition = 'area_code_id=' . $area;
            $table_name = 'tbl_area_code';
            $data = array();
            $data['get_area_code'] = $this->Admin_model->getWhere($selector, $condition, $table_name);
            if (sizeof($data['get_area_code']) != null) {
                $data['top_header'] = $this->load->view('admin/top_header', '', true);
                $data['footer'] = $this->load->view('admin/footer', '', true);
                $data['master_body'] = $this->load->view('admin/settings/area_code/edit_area_code', $data, true);
                $data['active_page'] = 'Manage Area Code';
                $this->load->view('admin/master', $data);
            } else {
                $data['top_header'] = $this->load->view('admin/top_header', '', true);
                $data['footer'] = $this->load->view('admin/footer', '', true);
                $data['master_body'] = $this->load->view('admin/error_page', $data, true);
                $data['active_page'] = 'Error';
                $this->load->view('admin/master', $data);
            }
        }
    }

    public function area_code_edit_post()
    {
        $id = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['area_code_id'] = $this->input->post('area_code');
        $data['location'] = $this->input->post('location');
        $chk_area = $this->Admin_model->SingelGetWhere('*', 'area_code_id=' . $this->input->post('area_code'), 'tbl_area_code');
        if ((sizeof($chk_area) == null) || ($chk_area[0]->area_code_id == $id)) {
            $this->Admin_model->updateCond('area_code_id=' . $id, 'tbl_area_code', $data);
            $this->session->set_flashdata('success_msg', 'Area Code Updated Successfully');
            redirect('settings/manage_area_code', 'refresh');
        } else {
            $this->session->set_flashdata('error_msg', 'Area Code Already Exists');
            redirect('settings/manage_area_code', 'refresh');
        }
    }

    public function delete_area_code($id)
    {
        $id = $id;
        $this->Admin_model->delete_function('tbl_area_code', 'area_code_id', $id);
        $this->session->set_flashdata('success_msg', 'Area Code Deleted Successfully');
        redirect('settings/manage_area_code', 'refresh');
    }
    //####Area Code Ends####

    //####Consultant####
    public function manage_consultant_info()
    {
        //echo '<pre>';print_r($data);die();
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['get_consultant_info'] = $this->Admin_model->get_all_consultants('tbl_consultant_user');
        $data['master_body'] = $this->load->view('admin/settings/consultant_type/manage_consultant_info', $data, true);
        $data['active_page'] = 'Manage Consultant Info';
        $this->load->view('admin/master', $data);
    }

    public function add_consultant_info()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['consultant_type'] = $this->Admin_model->getAllRecords('tbl_consultant_type');
        $data['master_body'] = $this->load->view('admin/settings/consultant_type/add_consultant_info', $data, true);
        $data['active_page'] = 'New Consultant Info';
        $this->load->view('admin/master', $data);
    }

    public function add_consultant_type()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['master_body'] = $this->load->view('admin/settings/consultant_type/add_consultant_type', $data, true);
        $data['active_page'] = 'Add Consultant Type';
        $this->load->view('admin/master', $data);
    }

    public function consultant_type_add_post()
    {
        if (isset($_POST)) {
            $data['type_name'] = $this->input->post('name');
            $data['created_on'] = date('Y-m-d');
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['login_id']; //have to check session after implementing login
            $this->Admin_model->insert('tbl_consultant_type', $data);
            $this->session->set_flashdata('success_msg', 'Consultant type Added Successfully');
            redirect('settings/add_consultant_info', 'refresh');

        } else {
            $this->session->set_flashdata('error_msg', 'Consultant type Can Not Be Added');
            redirect('settings/add_consultant_type', 'refresh');
        }
    }

    public function consultant_info_add_post()
    {
        if (!isset($_POST)) {
            $this->session->set_flashdata('error_msg', 'Consultant Can Not Be Added');
            redirect('settings/manage_consultant_info', 'refresh');
        } else {
            $new_date = date('Y-m-d');
            $new_date = explode('-', $new_date);
            $ct_id = $new_date[2] . $new_date[1] . substr($new_date[0], 2, 4);
            $new_date = $new_date[2] . $new_date[1] . $new_date[0];
            $table_name = 'tbl_consultant_user';
            $count_consultant = $this->Admin_model->count_data($table_name);
            $count_consultant = $count_consultant + 1;
            if ($count_consultant == 0) {
                $data['consultant_user_id'] = 'C' . $ct_id . '1';
            } else {
                $data['consultant_user_id'] = 'C' . $ct_id . $count_consultant;
            }

            $data['name'] = $this->input->post('name');
            $data['phone_number'] = $this->input->post('phone_number');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['description'] = $this->input->post('description');
            $data['tbl_consultant_type_consultant_type_id'] = $this->input->post('tbl_consultant_type_consultant_type_id');
            $chk_consultant = $this->Admin_model->get_consultant($this->input->post('consultant_user_id'));
            if (sizeof($chk_consultant) == null) {
                $chk = $this->Admin_model->insert_ret('tbl_consultant_user', $data);
                if (isset($chk)) {
                    $this->session->set_flashdata('success_msg', 'Consultant Added Successfully');
                    redirect('settings/manage_consultant_info', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Consultant Already Exists');
                redirect('settings/add_consultant_info', 'refresh');
            }
        }
    }

    public function edit_consultant_info($id)
    {
        $id = $id;
        //echo '<pre>';print_r($id);die();
        $data = array();
        $data['consultant_type'] = $this->Admin_model->getAllRecords('tbl_consultant_type');
        $data['get_consultant_info'] = $this->Admin_model->getWhereConsultant($id);
        //echo '<pre>';print_r($data);die();
        if (sizeof($data['get_consultant_info']) != null) {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['active_page'] = 'Edit Consultant Info';
            $data['master_body'] = $this->load->view('admin/settings/consultant_type/edit_consultant_info', $data, true);
            $data['active_page'] = 'Manage Consultant Info';
            $this->load->view('admin/master', $data);
        } else {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['master_body'] = $this->load->view('admin/error_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function consultant_info_edit_post()
    {
        $id = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['phone_number'] = $this->input->post('phone_number');
        $data['email'] = $this->input->post('email');
        $data['address'] = $this->input->post('address');
        $data['description'] = $this->input->post('description');
        $data['tbl_consultant_type_consultant_type_id'] = $this->input->post('tbl_consultant_type_consultant_type_id');
        $chk_consultant = $this->Admin_model->get_consultant($this->input->post('consultant_user_id'));
        if ((sizeof($chk_consultant) == null) || ($chk_consultant[0]->consultant_user_id == $id)) {
            $this->Admin_model->updateConsultant($id, $data);
            $this->session->set_flashdata('success_msg', 'Consultant Info Updated Successfully');
            redirect('settings/manage_consultant_info', 'refresh');
        } else {
            $this->session->set_flashdata('error_msg', 'Consultant Info Already Exists');
            redirect('settings/edit_consultant_info', 'refresh');
        }
    }

    public function delete_consultant_info($id)
    {
        $id = $id;
        $this->Admin_model->delete_function('tbl_consultant_user', 'consultant_user_id', $id);
        $this->session->set_flashdata('success_msg', 'Consultant Info Deleted Successfully');
        redirect('settings/manage_consultant_info', 'refresh');
    }

    public function check_consultant_id()
    {
        $new_date = date('YY-m-d');
        $new_date = explode('-', $new_date);
        $new_date = implode($new_date);
        $table_name = 'tbl_consultant_user';
        $count_consultant = $this->Admin_model->count_data($table_name);
        $count_consultant = $count_consultant + 1;
        //echo '<pre>';print_r($count_consultant);die();
        if ($count_consultant == 0) {
            $data['consultant_user_id'] = 'C-' . $new_date . '1';
        } else {
            $data['consultant_user_id'] = 'C-' . $new_date . '-' . $count_consultant;
        }
        echo json_encode($data);
    }

    public function show_error()
    {
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['master_body'] = $this->load->view('admin/error_page', $data, true);
        $data['active_page'] = 'Error';
        $this->load->view('admin/master', $data);
    }

    public function change_status()
    {
        $id = $this->input->post('status_id');
        $get_status = $this->Admin_model->get_consultant_status($id);
        if ($get_status->status == 0) {
            $data['status'] = 1;
            $this->Admin_model->change_consultant_status($id, $data);
            $this->session->set_flashdata('success_msg', 'Consultant Status Has Been Changed Successfully.');
            redirect('settings/manage_consultant_info', 'refresh');
        }
        if ($get_status->status == 1) {
            $data['status'] = 0;
            $this->Admin_model->change_consultant_status($id, $data);
            $this->session->set_flashdata('success_msg', 'Consultant Status Has Been Changed Successfully.');
            redirect('settings/manage_consultant_info', 'refresh');
        }
    }

    public function reset_password()
    {
        $data['password'] = md5("123456");
        $this->Admin_model->reset_password($this->input->post('password_id'), $data);
        $this->session->set_flashdata('success_msg', 'Password Reset Successful.');
        redirect('settings/manage_consultant_info', 'refresh');
    }

    //####Consultant Ends####

    //####Referral Starts####
    public function add_referral_info()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['master_body'] = $this->load->view('admin/settings/referral_info/add_referral_info', $data, true);
        $data['active_page'] = 'New Referral Info';
        $this->load->view('admin/master', $data);
    }

    public function referral_info_add_post()
    {
        if ($this->input->post('referral_name') == null || $this->input->post('organization') == null || $this->input->post('designation') == null) {
            $this->session->set_flashdata('error_msg', 'Referral Can Not Be Added');
            redirect('settings/manage_referral_info', 'refresh');
        } else {
            $data['referral_name'] = $this->input->post('referral_name');
            $data['organization'] = $this->input->post('organization');
            $data['designation'] = $this->input->post('designation');
            $chk = $this->Admin_model->insert_ret('tbl_referral', $data);
            $this->session->set_flashdata('success_msg', 'Referral Info Added Successfully');
            redirect('settings/manage_referral_info', 'refresh');
        }
    }

    public function manage_referral_info()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['get_referral_info'] = $this->Admin_model->getAllRecords('tbl_referral');
        $data['master_body'] = $this->load->view('admin/settings/referral_info/manage_referral_info', $data, true);
        $data['active_page'] = 'Manage Referral Info';
        $this->load->view('admin/master', $data);
    }

    //####Referral Ends####

    public function add_bank()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['master_body'] = $this->load->view('admin/settings/bank_info/add_bank', $data, true);
        $data['active_page'] = 'Add Bank Info';
        $this->load->view('admin/master', $data);
    }

    public function manage_bank()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['banks'] = $this->Admin_model->getAllRecords('tbl_bank_payment');
        $data['master_body'] = $this->load->view('admin/settings/bank_info/manage_bank', $data, true);
        $data['active_page'] = 'Manage Bank Info';
        $this->load->view('admin/master', $data);
    }

    public function bank_add_post()
    {
        if ($this->input->post('bank_name') == null) {
            $this->session->set_flashdata('error_msg', 'Bank Name Can Not Be Added');
            redirect('settings/manage_bank', 'refresh');
        } else {
            $data = array();
            $data['bank_name'] = $this->input->post('bank_name');
            $data['tbl_admin_login_login_id'] = $_SESSION['login_id'];
            $chk = $this->Admin_model->insert_ret('tbl_bank_payment', $data);
            if ($chk) {
                $this->session->set_flashdata('success_msg', 'Bank Info Added Successfully');
                redirect('settings/manage_bank', 'refresh');
            } else {
                $this->session->set_flashdata('error_msg', 'Bank Info Can Not Be Added!');
                redirect('settings/manage_bank', 'refresh');
            }
        }
    }
    public function edit_bank($id)
    {
        $bank = $id;
        $selector = '*';
        $condition = 'bank_id=' . $bank;
        $table_name = 'tbl_bank_payment';
        $data = array();
        $data['bank'] = $this->Admin_model->getWhere($selector, $condition, $table_name);
        if ($data['bank']) {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['master_body'] = $this->load->view('admin/settings/bank_info/edit_bank', $data, true);
            $data['active_page'] = 'Manage Bank Info';
            $this->load->view('admin/master', $data);
        } else {
            redirect('error');
        }
    }
    public function bank_edit_post()
    {
        $id = $this->input->post('id');
        $selector = '*';
        $condition = 'bank_id=' . $id;
        $table_name = 'tbl_bank_payment';
        $chk = $this->Admin_model->getWhere($selector, $condition, $table_name);
        if ($chk) {
            if($this->input->post('bank_name') != null)
            {
                $data = array();
                $data['bank_name'] = $this->input->post('bank_name');
                $data['tbl_admin_login_login_id'] = $_SESSION['login_id'];
                $this->Admin_model->updateCond('bank_id=' . $id, 'tbl_bank_payment', $data);
                $this->session->set_flashdata('success_msg', 'Bank Info Updated Successfully');
                redirect('settings/manage_bank', 'refresh');
            }
            else{
                $this->session->set_flashdata('error_msg', 'Bank Info Can Not Be Updated!');
                redirect('settings/manage_bank', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Bank Not Found!');
            redirect('settings/manage_bank', 'refresh');
        }
    }
    public function delete_bank()
    {
        $id = $this->input->post('id');
        $selector = '*';
        $condition = 'bank_id=' . $id;
        $table_name = 'tbl_bank_payment';
        $chk = $this->Admin_model->getWhere($selector, $condition, $table_name);
        if($chk)
        {
            $this->Admin_model->delete_function($table_name, 'bank_id', $id);
            $this->session->set_flashdata('success_msg', 'Bank Info Deleted Successfully');
            redirect('settings/manage_bank', 'refresh');
        }
        else{
            $this->session->set_flashdata('error_msg', 'Bank Not Found!');
            redirect('settings/manage_bank', 'refresh');
        }
    }
    public function add_mobile_banking()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['master_body'] = $this->load->view('admin/settings/mobile_banking_info/add_method', $data, true);
        $data['active_page'] = 'Add Mobile Banking Method';
        $this->load->view('admin/master', $data);
    }

    public function method_add_post()
    {
        if($_POST['method_name'])
        {
            $data = array();
            $data['payment_method_name'] = $this->input->post('method_name');
            $insert = $this->Admin_model->insert_ret('tbl_mobile_payment_method', $data);
            if($insert)
            {
                $this->session->set_flashdata('success_msg', 'Mobile Banking Method Added Successfully');
                redirect('manage_mobile_banking_method', 'refresh');
            }
            else{
                $this->session->set_flashdata('error_msg', 'Mobile Banking Method Can Not Be Added');
                redirect('add_mobile_banking_method', 'refresh');
            }
        }
        else{
            $this->session->set_flashdata('error_msg', 'Invalid Input');
            redirect('manage_mobile_banking_method', 'refresh');
        }
    }

    public function manage_mobile_banking()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['methods'] = $this->Admin_model->getAllRecords('tbl_mobile_payment_method');
        $data['master_body'] = $this->load->view('admin/settings/mobile_banking_info/manage_method', $data, true);
        $data['active_page'] = 'Manage Mobile Banking Methods';
        $this->load->view('admin/master', $data);
    }

    public function edit_method($id)
    {
        $selector = '*';
        $condition = 'payment_method_id=' . $id;
        $table_name = 'tbl_mobile_payment_method';
        $data = array();
        $data['method_info'] = $this->Admin_model->getWhere($selector, $condition, $table_name);
        //echo '<pre>';print_r($data);die();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if($data['method_info'])
        {
            $data['master_body'] = $this->load->view('admin/settings/mobile_banking_info/edit_method', $data, true);
            $data['active_page'] = 'Manage Mobile Banking Methods';
            $this->load->view('admin/master', $data);
        }
        else{
            $data['master_body'] = $this->load->view('admin/error_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function method_edit_post()
    {
        $id = $this->input->post('id');
        $data['payment_method_name'] = $this->input->post('method_name');
        $chk_method = $this->Admin_model->check_method($this->input->post('method_name'));
        if ($chk_method) {
            $this->session->set_flashdata('error_msg', 'Mobile Banking Method Already Exists');
            redirect('edit_mobile_banking_method'.'/'.$id, 'refresh');
        } else {
            $this->Admin_model->updateCond('payment_method_id=' . $id, 'tbl_mobile_payment_method', $data);
            $this->session->set_flashdata('success_msg', 'Mobile Banking Method Updated Successfully');
            redirect('manage_mobile_banking_method', 'refresh');
        }
    }

    public function method_delete_post()
    {
        $id = $this->input->post('id');
        $selector = '*';
        $condition = 'payment_method_id=' . $id;
        $table_name = 'tbl_mobile_payment_method';
        $chk = $this->Admin_model->getWhere($selector, $condition, $table_name);
        if($chk)
        {
            $this->Admin_model->delete_function($table_name, 'payment_method_id', $id);
            $this->session->set_flashdata('success_msg', 'Mobile Banking Method Deleted Successfully');
            redirect('manage_mobile_banking_method', 'refresh');
        }
        else{
            $this->session->set_flashdata('error_msg', 'Mobile Banking Method Not Found!');
            redirect('manage_mobile_banking_method', 'refresh');
        }
    }
}