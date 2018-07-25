<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Caregiver_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    //for Caregiver Controller
    public function getAllRecords($tableName)
    {
        $this->db->select('*');
        $result = $this->db->get($tableName);
        return $result->result_array();
    }
    public function get_caregivers_new()
    {
        $this->db->select('*, tbl_caregiver_user.phone_number as phone_number,tbl_caregiver_user.address as address, tbl_caregiver_family_contact.phone_number as cg_phone');
        $this->db->from('tbl_caregiver_user');
        $this->db->join('tbl_app_user_login', 'tbl_caregiver_user.caregiver_user_id = tbl_app_user_login.user_id');
        $this->db->join('tbl_caregiver_family_contact', 'tbl_caregiver_user.caregiver_user_id = tbl_caregiver_family_contact.tbl_caregiver_user_caregiver_user_id');
        $this->db->join('tbl_level_care_type', 'tbl_caregiver_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id');
        $this->db->where('tbl_caregiver_family_contact.is_emergency', 1);
        return $this->db->get()->result_array();
    }
    public function count_caregiver($table_name, $new_date)
    {
        $this->db->from($table_name);
        $this->db->where('joining_date', $new_date);
        //$result = $this->db->count();
        return $this->db->count_all_results();
    }
    public function insert_ret($tablename, $tabledata)
    {
        $this->db->insert($tablename, $tabledata);
        //$insert_id = $this->db->insert_id();
        return $this->db->insert_id();
    }
    public function getWhere($selector, $condition, $tablename)
    {
        $this->db->select($selector);
        $this->db->from($tablename);
        $this->db->where($condition);
        $result = $this->db->get();
        return $result->row_array();
    }
    public function insert($tablename, $tabledata)
    {
        $this->db->insert($tablename, $tabledata);
    }
    public function getAllCaregiver($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_user');
        $this->db->join('tbl_caregiver_engagment_type', 'tbl_caregiver_engagment_type.caregiver_engagment_type_id=tbl_caregiver_user.tbl_caregiver_engagment_type_caregiver_engagment_type_id', 'left');
        $this->db->join('tbl_app_user_type', ' tbl_app_user_type.app_user_type_id=tbl_caregiver_user.tbl_app_user_type_app_user_type_id', 'left');
        $this->db->join('tbl_caregiver_availability', ' tbl_caregiver_availability.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->join('tbl_caregiver_family_contact', 'tbl_caregiver_family_contact.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->join('tbl_level_care_type', 'tbl_level_care_type.level_care_type_id=tbl_caregiver_user.tbl_level_care_type_level_care_type_id', 'left');
        $this->db->where('tbl_caregiver_user.caregiver_user_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function editCaregiver($id)
    {
        $this->db->select('*, tbl_caregiver_user.phone_number as cg_phone,tbl_caregiver_user.address as cg_address');
        $this->db->from('tbl_caregiver_user');
        $this->db->join('tbl_caregiver_engagment_type', 'tbl_caregiver_engagment_type.caregiver_engagment_type_id=tbl_caregiver_user.tbl_caregiver_engagment_type_caregiver_engagment_type_id', 'left');
        $this->db->join('tbl_app_user_type', ' tbl_app_user_type.app_user_type_id=tbl_caregiver_user.tbl_app_user_type_app_user_type_id', 'left');
        $this->db->join('tbl_caregiver_availability', ' tbl_caregiver_availability.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->join('tbl_caregiver_family_contact', 'tbl_caregiver_family_contact.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->join('tbl_level_care_type', 'tbl_level_care_type.level_care_type_id=tbl_caregiver_user.tbl_level_care_type_level_care_type_id', 'left');
        $this->db->where('tbl_caregiver_user.caregiver_user_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function getCaregiverSalary($table_name, $id)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('tbl_caregiver_user_caregiver_user_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function getEmergencyContact($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_family_contact');
        $this->db->where('tbl_caregiver_user_caregiver_user_id', $id);
        $this->db->where('is_emergency', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function getFamilyContact($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_family_contact');
        $this->db->where('tbl_caregiver_user_caregiver_user_id', $id);
        $this->db->where('is_emergency', 0);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function get_caregiver_gender($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_user');
        $this->db->where('caregiver_user_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function updateCond($cond, $tableName, $data)
    {
        $this->db->where($cond);
        $this->db->update($tableName, $data);
    }
    public function update_function($columnName, $columnVal, $tableName, $data)
    {
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName, $data);
    }
    public function delete_availability($id)
    {
        $this->db->where('tbl_caregiver_user_caregiver_user_id', $id);
        $this->db->delete('tbl_caregiver_availability');
    }
    public function updateCaregiverAll($condition, $table_name, $data)
    {
        $this->db->where($condition);
        $this->db->update($table_name, $data);
    }
    public function get_rating($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_caregiver_user_caregiver_user_id', $id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        return $this->db->get()->result();
    }
    public function get_only_rating($id)
    {
        $this->db->select('tbl_schedule_maker.rating');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_caregiver_user_caregiver_user_id', $id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->where('tbl_schedule_maker.rating !=', 0);
        return $this->db->get()->result();
    }
    public function get_financial_info($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_salary');
        $this->db->join('tbl_bank_payment', 'tbl_caregiver_salary.tbl_bank_payment_bank_id = tbl_bank_payment.bank_id', 'left');
        $this->db->join('tbl_mobile_payment_method', 'tbl_caregiver_salary.tbl_mobile_payment_method_id = tbl_mobile_payment_method.payment_method_id', 'left');
        $this->db->where('tbl_caregiver_salary.tbl_caregiver_user_caregiver_user_id', $id);
        return $this->db->get()->row();
    }

    public function check_caregiver($id)
    {
        $this->db->select('tbl_caregiver_user.caregiver_name');
        $this->db->from('tbl_caregiver_user');
        $this->db->join('tbl_app_user_login', 'tbl_app_user_login.user_id = tbl_caregiver_user.caregiver_user_id');
        $this->db->where('caregiver_user_id', $id);
        return $this->db->get()->result();
    }
}

?>