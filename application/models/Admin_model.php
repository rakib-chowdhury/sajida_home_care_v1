<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    //for Caregiver Controller
    public function CaregiverGetWhereJoin($selector, $condition, $tablename)
    {
        $this->db->select($selector);
        $this->db->from($tablename);
        $where = '(' . $condition . ')';
        $this->db->join('tbl_level_care_type','tbl_caregiver_user.tbl_level_care_type_level_care_type_id=tbl_level_care_type.level_care_type_id','left');
        $this->db->where($where);
        $result = $this->db->get();
        return $result->result();
    }
    public function caregiver_appointment_count($id)
    {
        $this->db->select('*');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $id);
        return $this->db->count_all_results('tbl_caregiver_patient_schedule');
    }
    public function get_caregiver_e_contact($id)
    {
        $this->db->select('family_contact_name, phone_number');
        $this->db->from('tbl_caregiver_family_contact');
        $this->db->where('is_emergency', 1);
        $this->db->where('tbl_caregiver_user_caregiver_user_id', $id);
        $result = $this->db->get();
        return $result->result();
    }
    public function get_caregiver_carehour($id)
    {
        $this->db->select('tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $id);
        $this->db->where('tbl_schedule_maker.carehours !=', null);
        $result = $this->db->get();
        return $result->result();
    }
    public function SingelGetWhere($selector, $condition, $tablename)
    {
        $this->db->select($selector);
        $this->db->from($tablename);
        $where = '(' . $condition . ')';
        $this->db->where($where);
        $result = $this->db->get();
        return $result->result();
    }
    public function get_care_hours($id)
    {
        $this->db->select('carehours');
        $this->db->from('tbl_schedule_maker');
        $this->db->where('schedule_maker_id', $id);
        $this->db->where('clock_in_time !=', null);
        $result = $this->db->get();
        return $result->result();
    }
    public function caregiver_upcoming_schedule($caregiver_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id', 'left');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $caregiver_id);
        $this->db->where('tbl_schedule_maker.clock_in_time', null);
        $where = "(tbl_schedule_maker.schedule_date = CURDATE() or tbl_schedule_maker.schedule_date > NOW())";
        $this->db->where($where);
        $this->db->order_by('schedule_date ASC');
        $result = $this->db->get();
        return $result->result();
    }
    public function caregiver_care_history($caregiver_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id');
        //$this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id');
        $this->db->join('tbl_service_type', 'tbl_schedule_maker.tbl_service_type_service_type_id=tbl_service_type.service_type_id');
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $caregiver_id);
        $this->db->order_by('tbl_schedule_maker.schedule_date ASC');
        $result = $this->db->get();
        return $result->result();
    }
    public function fetch_history_caregiver($caregiver_id, $start_date, $end_date)
    {
        //  echo $prev_month;die();
        //echo $start_date.' '.$end_date;die();
        $this->db->select('*, (tbl_schedule_maker.end_time-tbl_schedule_maker.start_time) as scheduled_hours');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_caregiver_schedule_feedback','tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_caregiver_schedule_feedback.tbl_schedule_maker_schedule_maker_id', 'left');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id = tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_level_care_type', 'tbl_patient_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id', 'left');
        $this->db->join('tbl_schedule_maker','tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id', 'left');
        $this->db->join('tbl_service_type', 'tbl_schedule_maker.tbl_service_type_service_type_id=tbl_service_type.service_type_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        //$this->db->order_by('tbl_schedule_maker.schedule_date', 'desc');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $caregiver_id);
        $this->db->where('tbl_schedule_maker.schedule_date >=', $start_date);
        $this->db->where('tbl_schedule_maker.schedule_date <=', $end_date);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
       // $this->db->order_by('tbl_schedule_maker.schedule_date', 'desc');
        $result = $this->db->get();
        return $result->result();
    }
    /*public function get_caregiver_chart_data($caregiver_id, $month_id, $year_id)
    {
        $this->db->select("tbl_caregiver_user.caregiver_name  as name, (tbl_schedule_maker.schedule_date) as schedule_date, (tbl_schedule_maker.end_time-tbl_schedule_maker.start_time)/3600000 as dutyhours, ((tbl_schedule_maker.clock_out_time-tbl_schedule_maker.clock_in_time)-(tbl_schedule_maker.end_time-tbl_schedule_maker.start_time))/3600000 as overtime");
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_user.caregiver_user_id = tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id');
        $this->db->join('tbl_schedule_maker', 'tbl_schedule_maker.schedule_maker_id = tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->where('YEAR(tbl_schedule_maker.schedule_date) =', $year_id);
        $this->db->where('MONTH(tbl_schedule_maker.schedule_date) =', $month_id);
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $caregiver_id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->order_by('DAY(tbl_schedule_maker.schedule_date)', 'ASC');
        $result = $this->db->get();
        return $result->result_array();
    }*/
    public function get_caregiver_chart_data($caregiver_id, $start_date, $end_date)
    {
        $this->db->select("tbl_caregiver_user.caregiver_name  as name, (tbl_schedule_maker.schedule_date) as schedule_date, (tbl_schedule_maker.clock_out_time-tbl_schedule_maker.clock_in_time)/3600000 as dutyhours, ((tbl_schedule_maker.clock_out_time-tbl_schedule_maker.clock_in_time)-(tbl_schedule_maker.end_time-tbl_schedule_maker.start_time))/3600000 as overtime, (tbl_schedule_maker.end_time-tbl_schedule_maker.start_time) as scheduled_hours, tbl_schedule_maker.carehours");
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_user.caregiver_user_id = tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id');
        $this->db->join('tbl_schedule_maker', 'tbl_schedule_maker.schedule_maker_id = tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->where('tbl_schedule_maker.schedule_date >=', $start_date);
        $this->db->where('tbl_schedule_maker.schedule_date <=', $end_date);
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $caregiver_id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->order_by('DAY(tbl_schedule_maker.schedule_date)', 'ASC');
        $result = $this->db->get();
        return $result->result_array();
    }
    public function get_status($id)
    {
        $this->db->select('status');
        $this->db->from('tbl_app_user_login');
        $this->db->where('user_id', $id);
        return $this->db->get()->row();
    }
    public function change_status($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('tbl_app_user_login', $data);
    }
    public function reset_password($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('tbl_app_user_login', $data);
    }
    // Caregiver ends

    //for Patient Controller
    public function getAllRecords($tableName)
    {
        $this->db->select('*');
        $result = $this->db->get($tableName);
        return $result->result_array();
    }
    public function count_patient($table_name, $new_date)
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
    public function getAllPatients($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_patient_user');
        $this->db->join('tbl_area_code', 'tbl_area_code.area_code_id=tbl_patient_user.tbl_area_code_area_code_id', 'left');
        $this->db->join('tbl_referral', 'tbl_referral.referral_id=tbl_patient_user.tbl_referral_referral_id', 'left');
        //$this->db->join('tbl_patient_family_contact', 'tbl_patient_family_contact.tbl_patient_user_patient_id=tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_level_care_type', 'tbl_level_care_type.level_care_type_id=tbl_patient_user.tbl_level_care_type_level_care_type_id', 'left');
        $this->db->where('tbl_patient_user.patient_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function getPreferableCaregiver($patient_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_preferable_caregiver_list');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_user.caregiver_user_id=tbl_preferable_caregiver_list.tbl_caregiver_user_caregiver_user_id', 'left');
        $this->db->where('tbl_preferable_caregiver_list.tbl_patient_user_patient_id', $patient_id);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function getEmergencyContact($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_patient_family_contact');
        $this->db->where('tbl_patient_user_patient_id', $id);
        $this->db->where('is_emergency', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function getFamilyContact($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_patient_family_contact');
        $this->db->where('tbl_patient_user_patient_id', $id);
        $this->db->where('is_emergency', 0);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function update_function($columnName, $columnVal, $tableName, $data)
    {
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName, $data);
    }
    public function delete_preferable_caregiver($id)
    {
        $this->db->where('tbl_patient_user_patient_id', $id);
        $this->db->delete('tbl_preferable_caregiver_list');
    }
    public function updatePatientAll($condition, $table_name, $data)
    {
        $this->db->where($condition);
        $this->db->update($table_name, $data);
    }
    public function SingelGetWhereJoin($selector, $condition, $tablename)
    {
        $this->db->select($selector);
        $this->db->from($tablename);
        $where = '(' . $condition . ')';
        $this->db->join('tbl_level_care_type','tbl_patient_user.tbl_level_care_type_level_care_type_id=tbl_level_care_type.level_care_type_id','left');
        $this->db->join('tbl_area_code','tbl_patient_user.tbl_area_code_area_code_id=tbl_area_code.area_code_id','left');
        $this->db->where($where);
        $result = $this->db->get();
        return $result->result();
    }
    public function patient_appointment_count($id)
    {
        $this->db->select('*');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $id);
        return $this->db->count_all_results('tbl_caregiver_patient_schedule');
    }
    public function get_e_contact($id)
    {
        $this->db->select('family_contact_name, phone_number');
        $this->db->from('tbl_patient_family_contact');
        $this->db->where('is_emergency', 1);
        $this->db->where('tbl_patient_user_patient_id', $id);
        $result = $this->db->get();
        return $result->result();
    }
    public function get_chart_data($patient_id, $start_date, $end_date)
    {
        $this->db->select("tbl_patient_user.patient_name  as name, (tbl_schedule_maker.schedule_date) as schedule_date, (tbl_schedule_maker.end_time-tbl_schedule_maker.start_time)/3600000 as dutyhours, ((tbl_schedule_maker.clock_out_time-tbl_schedule_maker.clock_in_time)-(tbl_schedule_maker.end_time-tbl_schedule_maker.start_time))/3600000 as overtime");
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_patient_user', 'tbl_patient_user.patient_id = tbl_caregiver_patient_schedule.tbl_patient_user_patient_id');
        $this->db->join('tbl_schedule_maker', 'tbl_schedule_maker.schedule_maker_id = tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
      //  $this->db->where('YEAR(tbl_schedule_maker.schedule_date) =', $year_id);
      //  $this->db->where('MONTH(tbl_schedule_maker.schedule_date) =', $month_id);
        $this->db->where('tbl_schedule_maker.schedule_date >=', $start_date);
        $this->db->where('tbl_schedule_maker.schedule_date <=', $end_date);
        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $patient_id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->order_by('DAY(tbl_schedule_maker.schedule_date)', 'ASC');
        $result = $this->db->get();
        return $result->result_array();
    }
    public function get_patient_care_hours($patient_id, $start_date, $end_date)
    {
        $this->db->select("tbl_patient_user.patient_name  as name, (tbl_schedule_maker.schedule_date) as schedule_date, sum((tbl_schedule_maker.clock_out_time-tbl_schedule_maker.clock_in_time)/3600000) as duty_hours");
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_patient_user', 'tbl_patient_user.patient_id = tbl_caregiver_patient_schedule.tbl_patient_user_patient_id');
        $this->db->join('tbl_schedule_maker', 'tbl_schedule_maker.schedule_maker_id = tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->where('tbl_schedule_maker.schedule_date >=', $start_date);
        $this->db->where('tbl_schedule_maker.schedule_date <=', $end_date);
        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $patient_id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->order_by('DAY(tbl_schedule_maker.schedule_date)', 'ASC');
        $this->db->group_by('tbl_schedule_maker.schedule_date');
        $result = $this->db->get();
        return $result->result_array();
    }
    public function get_patient_consulting_hours($patient_id, $start_date, $end_date)
    {
        $this->db->select("tbl_patient_user.patient_name  as name, (tbl_schedule_maker.schedule_date) as schedule_date, sum((tbl_schedule_maker.clock_out_time-tbl_schedule_maker.clock_in_time)/3600000) as duty_hours");
        $this->db->from('tbl_consultant_patient_schedule');
        $this->db->join('tbl_patient_user', 'tbl_patient_user.patient_id = tbl_consultant_patient_schedule.tbl_patient_user_patient_id');
        $this->db->join('tbl_schedule_maker', 'tbl_schedule_maker.schedule_maker_id = tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->where('tbl_schedule_maker.schedule_date >=', $start_date);
        $this->db->where('tbl_schedule_maker.schedule_date <=', $end_date);
        $this->db->where('tbl_consultant_patient_schedule.tbl_patient_user_patient_id', $patient_id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->order_by('DAY(tbl_schedule_maker.schedule_date)', 'ASC');
        $this->db->group_by('tbl_schedule_maker.schedule_date');
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function get_medical_history($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_patient_medical_history');
        $this->db->join('tbl_patient_user', 'tbl_patient_user.patient_id = tbl_patient_medical_history.tbl_patient_user_patient_id');
        $this->db->where('tbl_patient_medical_history.tbl_patient_user_patient_id', $id);
        return $this->db->get()->result();
    }
    public function get_schedule_id($id)
    {
        $this->db->select('tbl_schedule_maker_schedule_maker_id');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->where('tbl_patient_user_patient_id', $id);
        $result = $this->db->get();
        return $result->result();
    }
    public function get_preferable_caregiver($selector, $condition, $tablename)
    {
        $this->db->select($selector);
        $this->db->from($tablename);
        $this->db->join('tbl_caregiver_user', 'tbl_preferable_caregiver_list.tbl_caregiver_user_caregiver_user_id= tbl_caregiver_user.caregiver_user_id', 'left');
        $where = '(' . $condition . ')';
        $this->db->where($where);
        $result = $this->db->get();
        return $result->result();
    }
    public function get_upcoming_schedule($patient_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id', 'left');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $patient_id);
        $this->db->where('tbl_schedule_maker.clock_in_time', null);
        $where = "(tbl_schedule_maker.schedule_date = CURDATE() or tbl_schedule_maker.schedule_date > NOW())";
        $this->db->where($where);
        $this->db->order_by('schedule_date ASC');
        $result = $this->db->get();
        return $result->result();
    }
    public function get_care_history($patient_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id', 'left');
        //$this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->join('tbl_service_type', 'tbl_schedule_maker.tbl_service_type_service_type_id=tbl_service_type.service_type_id', 'left');
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $patient_id);
        $this->db->order_by('tbl_schedule_maker.schedule_date ASC');
        $result = $this->db->get();
        return $result->result();
    }
    public function fetch_history($patient, $start_date, $end_date)
    {
        //  echo $prev_month;die();
        $this->db->select('*');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker','tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id', 'left');
        $this->db->join('tbl_caregiver_schedule_feedback','tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_caregiver_schedule_feedback.tbl_schedule_maker_schedule_maker_id', 'left');
        $this->db->join('tbl_service_type', 'tbl_schedule_maker.tbl_service_type_service_type_id=tbl_service_type.service_type_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->where('tbl_patient_user_patient_id', $patient);
        $this->db->where('tbl_schedule_maker.schedule_date >=', $start_date);
        $this->db->where('tbl_schedule_maker.schedule_date <=', $end_date);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        //$this->db->order_by('tbl_schedule_maker.schedule_date', 'desc');
       // $this->db->order_by(DATE_FORMAT('tbl_schedule_maker.schedule_date','%Y-%m-%d'),'DESC');
        $result = $this->db->get();
        return $result->result();
    }
    public function delete_history($id)
    {
        $this->db->where('patient_medical_history_id', $id);
        $this->db->delete('tbl_patient_medical_history');
    }
    public function update_medical_history($id, $data)
    {
        $this->db->where('patient_medical_history_id', $id);
        $this->db->update('tbl_patient_medical_history', $data);
    }
    // Patient Ends

    // for Settings Controller
    public function updateCond($cond, $tableName, $data)
    {
        $whr= '('.$cond.')';
        $this->db->where($whr);
        $this->db->update($tableName, $data);
    }
    public function delete_function($tableName, $columnName, $columnVal)
    {
        $this->db->where($columnName, $columnVal);
        $this->db->delete($tableName);
    }
    public function get_all_consultants($tableName)
    {
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->join('tbl_consultant_type', 'tbl_consultant_type.consultant_type_id=tbl_consultant_user.tbl_consultant_type_consultant_type_id');
        $result = $this->db->get();
        return $result->result();
    }
    public function count_data($table_name)
    {
        return $this->db->count_all($table_name);
    }
    public function get_consultant($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_user');
        $this->db->where('consultant_user_id', $id);
        $result = $this->db->get();
        return $result->result();
    }
    public function getWhereConsultant($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_user');
        $this->db->join('tbl_consultant_type', 'tbl_consultant_type.consultant_type_id=tbl_consultant_user.tbl_consultant_type_consultant_type_id', 'left');
        $this->db->where('tbl_consultant_user.consultant_user_id', $id);
        $result = $this->db->get();
        return $result->result();
    }
    public function updateConsultant($id, $data)
    {
        $this->db->where('consultant_user_id', $id);
        $this->db->update('tbl_consultant_user', $data);
    }
    public function get_consultant_status($id)
    {
        $this->db->select('status');
        $this->db->from('tbl_consultant_user');
        $this->db->where('consultant_user_id', $id);
        return $this->db->get()->row();
    }
    public function change_consultant_status($id, $data)
    {
        $this->db->where('consultant_user_id', $id);
        $this->db->update('tbl_consultant_user', $data);
    }
    public function check_method($method_name)
    {
        $this->db->select('*');
        $this->db->from('tbl_mobile_payment_method');
        $this->db->where('payment_method_name', $method_name);
        return $this->db->get()->row();
    }
}

?>