<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    // for Home Controller
    public function count_data_active_caregivers()
    {
        $this->db->select('*');
        $this->db->join('tbl_app_user_login', 'tbl_caregiver_user.caregiver_user_id = tbl_app_user_login.user_id');
        $this->db->where('tbl_app_user_login.status', 1);
        return $this->db->count_all_results('tbl_caregiver_user');
    }
    public function count_data($table_name)
    {
        return $this->db->count_all_results($table_name);
    }
    public function get_all_carehours($table_name)
    {
        $this->db->select_sum('carehours');
        $this->db->from($table_name);
        $this->db->where('carehours !=', null);
        $this->db->where('clock_in_time !=', null);
        $this->db->where('clock_out_time !=', null);
        return $this->db->get()->result();
    }
    public function count_data_active_clients()
    {
        $this->db->select('*');
        $this->db->join('tbl_app_user_login', 'tbl_patient_user.patient_id = tbl_app_user_login.user_id');
        $this->db->where('tbl_app_user_login.status', 1);
        return $this->db->count_all_results('tbl_patient_user');
    }
    public function count_devices()
    {
        $this->db->select('*');
        $this->db->where('is_accepted', 1);
        return $this->db->count_all_results('tbl_promotional_item_request');
    }
    public function get_all_patients($table_name, $today_date)
    {
        $this->db->select("DATEDIFF(DOB, '.date(\"Y-m-d\").') as age");
        $this->db->from($table_name);
        return $this->db->get()->result();
    }
    public function get_schedules($month)
    {
        $this->db->select('*, tbl_patient_user.gender as patient_gender, tbl_patient_user.phone_number as patient_phone, tbl_patient_user.address as patient_address');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_caregiver_patient_schedule', 'tbl_schedule_maker.schedule_maker_id=tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id');
        $this->db->where('MONTH(tbl_schedule_maker.schedule_date)', $month);
        return $this->db->get()->result();
    }
    public function get_schedules_selected($month)
    {
        $this->db->select('*, tbl_patient_user.gender as patient_gender, tbl_patient_user.phone_number as patient_phone, tbl_patient_user.address as patient_address, tbl_caregiver_user.phone_number as cg_phone');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_caregiver_patient_schedule', 'tbl_schedule_maker.schedule_maker_id=tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id');
        $this->db->where('tbl_schedule_maker.schedule_date', $month);
        return $this->db->get()->result();
    }
}

?>