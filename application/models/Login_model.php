<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function lcheck($user_id,$pass)
    {
        $data=array(
            'tbl_admin_login.tbl_admin_user_admin_user_id'=>$user_id,
            'tbl_admin_login.password'=>md5($pass)
        );
        $query =  $this->db->select('*')->from('tbl_admin_login')->join('tbl_admin_user', 'tbl_admin_user.admin_user_id=tbl_admin_login.tbl_admin_user_admin_user_id')->where($data)->get();
        return $query->result();
    }
    public function check_password($id, $password)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_login');
        $this->db->where('login_id', $id);
        $this->db->where('password', $password);
        $result = $this->db->get();
        return $result->result();
    }
    public function change_password($id, $data)
    {
        $this->db->where('login_id', $id);
        $this->db->update('tbl_admin_login', $data);
    }
}
