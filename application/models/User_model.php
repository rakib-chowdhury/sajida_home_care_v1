<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAllRecords($tableName)
    {
        $this->db->select('*');
        $this->db->where_not_in('user_type_name', 'Super Admin');
        $result = $this->db->get($tableName);
        return $result->result_array();
    }
    public function insert_ret($tablename, $tabledata)
    {
        $this->db->insert($tablename, $tabledata);
        //$insert_id = $this->db->insert_id();
        return $this->db->insert_id();
    }
    public function get_login_info($username)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_user');
        $this->db->where('admin_user_id', $username);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_all_users()
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_user');
        $this->db->join('tbl_admin_user_type', 'tbl_admin_user_type.admin_user_type_id = tbl_admin_user.tbl_admin_user_type_admin_user_type_id', 'left');
        $this->db->join('tbl_admin_login', 'tbl_admin_login.tbl_admin_user_admin_user_id = tbl_admin_user.admin_user_id');
        $this->db->where_not_in('tbl_admin_user_type_admin_user_type_id', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function getWhere($user_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin_user');
        $this->db->join('tbl_admin_user_type', 'tbl_admin_user_type.admin_user_type_id = tbl_admin_user.tbl_admin_user_type_admin_user_type_id', 'left');
        $this->db->where('tbl_admin_user.admin_user_id', $user_id);
        $this->db->where_not_in('tbl_admin_user.tbl_admin_user_type_admin_user_type_id', 1);
        $result = $this->db->get();
        return $result->row_array();
    }
    public function update_function($columnName, $columnVal, $tableName, $data)
    {
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName, $data);
    }
    public function get_admin_status($id)
    {
        $this->db->select('status');
        $this->db->from('tbl_admin_login');
        $this->db->where('tbl_admin_login.tbl_admin_user_admin_user_id', $id);
        return $this->db->get()->row();
    }
    public function get_new_patients()
    {
        $this->db->select('*');
        $this->db->from('tbl_patient_user');
        $this->db->join('tbl_app_user_login', 'tbl_patient_user.patient_id = tbl_app_user_login.user_id');
        $this->db->join('tbl_referral', 'tbl_patient_user.tbl_referral_referral_id = tbl_referral.referral_id', 'left');
        $this->db->join('tbl_level_care_type', 'tbl_patient_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id');
        return $this->db->get()->result_array();
    }
    public function get_patient_info($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_patient_user');
        $this->db->join('tbl_level_care_type', 'tbl_patient_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id');
        $this->db->where('patient_id', $id);
        return $this->db->get()->row();
    }
    public function check_patient_status($id)
    {
        $this->db->select('tbl_app_user_login.status as status');
        $this->db->from('tbl_patient_user');
        $this->db->join('tbl_app_user_login', 'tbl_patient_user.patient_id = tbl_app_user_login.user_id');
        $this->db->where('tbl_patient_user.patient_id', $id);
        return $this->db->get()->row();
    }
    public function change_admin_status($id, $data)
    {
        $this->db->where('tbl_admin_user_admin_user_id', $id);
        $this->db->update('tbl_admin_login', $data);
    }
    public function check_emergency_contact()
    {
        $this->db->select('admin_user_id');
        $this->db->from('tbl_admin_user');
        $this->db->where('is_emergency', 1);
        return $this->db->get()->row();
    }
    public function change_emergency_contact($id, $data)
    {
        $this->db->where('admin_user_id', $id);
        $this->db->update('tbl_admin_user', $data);
    }
    public function check_admin_phone($id)
    {
        $this->db->select('admin_user_id');
        $this->db->from('tbl_admin_user');
        $this->db->where('admin_user_id', $id);
        $this->db->where('phone_number !=', null);
        return $this->db->get()->row();
    }
}

?>