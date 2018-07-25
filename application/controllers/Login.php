<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        if($this->session->userdata('login_id')!=null)
        {
            redirect(base_url().'home');
        }
        else
        {
            $this->load->view('login/view_login');
        }

    }
    
    public function login_check()
    {
        $resp = array();
        $login_status = 'invalid';
        $userid= $_POST["userid"];
        $password = $_POST["password"];
        $result = $this->login_model->lcheck($userid, $password);
        if($result)
        {
            if($result[0]->status==1)
            {

                $sess_data = array('login' => true, 'user_id'=>$result[0]->admin_user_id,'name' => $result[0]->admin_name, 'login_id' => $result[0]->login_id,'user_type'=>$result[0]->tbl_admin_user_type_admin_user_type_id);
                $this->session->set_userdata($sess_data);
                $login_status = 'success';
            }
        }
        $resp['login_status'] = $login_status;
        if($login_status == 'success')
        {
            $resp['redirect_url'] = base_url().'home/';
        }
        echo json_encode($resp);

    }
    public function logout()
    {
        $data=array('login'=>'','name'=>'','login_id'=>'','user_type'=>'','user_id'=>'');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }
    public function change_password()
    {
        $user_id = $_SESSION['login_id'];
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
            $data['master_body'] = $this->load->view('admin/admin_user/change_password', $data, true);
            $data['active_page'] = 'Change Password';
            $this->load->view('admin/master', $data);
        }else{
            $data['master_body'] = $this->load->view('admin/access_denied_page',$data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }
    public function password_change_post()
    {
        $id = $_SESSION['login_id'];
        $old_password = md5($this->input->post('old_password'));
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        if($new_password == $confirm_password)
        {
            $check_password = $this->login_model->check_password($id,$old_password);
            if($check_password)
            {
                $data['password'] = md5($new_password);
                $this->login_model->change_password($id, $data);
                $this->logout();
            }
            else
            {
                $this->session->set_flashdata('error_msg', 'Incorrect Old Password!');
                redirect('Login/change_password', 'refresh');
            }
        }else{
            $this->session->set_flashdata('error_msg', 'Password Not Matched!');
            redirect('Login/change_password', 'refresh');
        }
        
    }
    public function check_old_password()
    {
        $login_id = $this->input->post('login_id');
        $password = md5($this->input->post('password'));
        $check_password = $this->login_model->check_password($login_id, $password);
        if($check_password)
        {
            echo 1;
        }else{
            echo 0;
        }
    }

}