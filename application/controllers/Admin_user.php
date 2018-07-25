<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login_id')!=null && $_SESSION['user_type'] != 4)
        {
            $this->load->model('User_model');
        }
        else
        {
            redirect(base_url().'login');
        }
    }

    public function add_admin_user()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['user_type'] = $this->User_model->getAllRecords('tbl_admin_user_type');
        $data['master_body'] = $this->load->view('admin/admin_user/add_user', $data, true);
        $data['active_page'] = 'Add Admin User';
        $this->load->view('admin/master', $data);
    }
    
    public function admin_user_add_post()
    {
        if(isset($_POST))
        {
            $data['admin_user_id'] = $this->input->post('admin_user_id');
            $data['admin_name'] = $this->input->post('admin_name');
            $data['DOB'] = $this->input->post('DOB');
            if ($this->input->post('gender') == 'on') {
                $data['gender'] = 1;
            } else {
                $data['gender'] = 0;
            }
            $data['phone_number'] = $this->input->post('phone_number');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['tbl_admin_user_type_admin_user_type_id'] = $this->input->post('tbl_admin_user_type_admin_user_type_id');
            $chk = $this->User_model->insert_ret('tbl_admin_user', $data);
            if(isset($chk))
            {
                $password = 'welcome';
                $data1['password'] = md5("welcome");
                $data1['status'] = 1;
                $data1['tbl_admin_user_admin_user_id'] = $data['admin_user_id'];
                $chk = $this->User_model->insert_ret('tbl_admin_login', $data1);
                if(isset($chk))
                {
                    $this->session->set_flashdata('success_msg', 'User Has Been Added Successfully.');
                    redirect('admin_users/add_new_user', 'refresh');
                }
            }
        }
    }
    
    public function check_user_id()
    {
        $id = $this->input->post('user_name');
        $data['result'] = $this->User_model->get_login_info($id);
        echo json_encode($data);
    }
    
    public function manage_users()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['users'] = $this->User_model->get_all_users();
        $data['master_body'] = $this->load->view('admin/admin_user/manage_users', $data, true);
        $data['active_page'] = 'Manage Admin User';
        $this->load->view('admin/master', $data);
    }
    
    public function edit_admin_users($id)
    {
        $user_id = $id;
        $new_id = str_replace('%20', ' ', $user_id);
        $data = array();
        $data['user_type'] = $this->User_model->getAllRecords('tbl_admin_user_type');
        $data['user_info'] = $this->User_model->getWhere($new_id);
        if (sizeof($data['user_info']) != null) {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['master_body'] = $this->load->view('admin/admin_user/edit_user', $data, true);
            $data['active_page'] = 'Manage Admin User';
            $this->load->view('admin/master', $data);
        } else {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['master_body'] = $this->load->view('admin/error_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }
    
    public function admin_user_edit_post()
    {
        $id = $this->input->post('id');
        if(isset($_POST))
        {
            $data['admin_name'] = $this->input->post('admin_name');
            $data['DOB'] = $this->input->post('DOB');
            if($this->input->post('user_gender') == null)
            {
                if($this->input->post('gender') == 1)
                {
                    $data['gender'] = 0;
                }
                else
                {
                    $data['gender'] = 1;
                }
            }
            if($this->input->post('user_gender') == 'on')
            {
                $data['gender'] = $this->input->post('gender');
            }
            $data['phone_number'] = $this->input->post('phone_number');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['tbl_admin_user_type_admin_user_type_id'] = $this->input->post('tbl_admin_user_type_admin_user_type_id');
            $this->User_model->update_function('admin_user_id', $id, 'tbl_admin_user', $data);
            $this->session->set_flashdata('success_msg', 'Data Has Been Updated Successfully.');
            redirect('admin_users/manage_users', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('error_msg', 'Data Can Not Be Updated. Please Try Again.');
            redirect('admin_users/edit_users/'.$id, 'refresh');
        }
    }

    public function change_status()
    {
        $id = $this->input->post('admin_id');
        $check_status = $this->User_model->get_admin_status($id);
        if($check_status->status == 0)
        {
            $data['status'] = 1;
            $this->User_model->change_admin_status($id, $data);
            $this->session->set_flashdata('success_msg', 'Admin Status Has Been Changed Successfully.');
            redirect('admin_users/manage_users', 'refresh');
        }
        else if($check_status->status == 1)
        {
            $data['status'] = 0;
            $this->User_model->change_admin_status($id, $data);
            $this->session->set_flashdata('success_msg', 'Admin Status Has Been Changed Successfully.');
            redirect('admin_users/manage_users', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('error_msg', 'Admin Status Can Not Be Changed!');
            redirect('admin_users/manage_users', 'refresh');
        }
    }

    public function emergency_contact()
    {
        $id = $this->input->post('admin_id');
        $check_phone = $this->User_model->check_admin_phone($id);
        if($check_phone)
        {
            $check_emergency = $this->User_model->check_emergency_contact();
            if($check_emergency)
            {
                $data['is_emergency'] = 0;
                $this->User_model->change_emergency_contact($check_emergency->admin_user_id, $data);
                $new_data['is_emergency'] = 1;
                $this->User_model->change_emergency_contact($id, $new_data);
                $this->session->set_flashdata('success_msg', 'Emergency Contact Has Been Updated Successfully.');
                redirect('admin_users/manage_users', 'refresh');
            }
            else
            {
                $new_data['is_emergency'] = 1;
                $this->User_model->change_emergency_contact($id, $new_data);
                $this->session->set_flashdata('success_msg', 'Emergency Contact Has Been Added Successfully.');
                redirect('admin_users/manage_users', 'refresh');
            }
        }
        else
        {
            $this->session->set_flashdata('error_msg', 'You have To Add Phone Number In Order To Make This User As Emergency Contact!');
            redirect('admin_users/manage_users', 'refresh');
        }

    }
}