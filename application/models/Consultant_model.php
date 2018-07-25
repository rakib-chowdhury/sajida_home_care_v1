<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consultant_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    //for Consultant Controller
    public function getAllRecords($tableName)
    {
        $this->db->select('*');
        $result = $this->db->get($tableName);
        return $result->result_array();
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

    public function updateCond($cond, $tableName, $data)
    {
        $this->db->where($cond);
        $this->db->update($tableName, $data);
    }
    public function update_function($columnName, $columnVal, $tableName, $data)
    {
        //echo 'yes';die();
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName, $data);
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

    public function get_all_consultants()
    {
        $this->db->select('*, tbl_consultant_user.status as status');
        $this->db->from('tbl_consultant_user');
        $this->db->join('tbl_consultant_type', 'tbl_consultant_type.consultant_type_id=tbl_consultant_user.tbl_consultant_type_consultant_type_id');
        $this->db->join('tbl_consultant_salary', 'tbl_consultant_salary.tbl_consultant_user_consultant_user_id=tbl_consultant_user.consultant_user_id');
        $result = $this->db->get();
        return $result->result();
    }
    public function getWhereConsultant($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_user');
        $this->db->join('tbl_consultant_type', 'tbl_consultant_type.consultant_type_id=tbl_consultant_user.tbl_consultant_type_consultant_type_id', 'left');
        $this->db->join('tbl_consultant_salary', 'tbl_consultant_salary.tbl_consultant_user_consultant_user_id=tbl_consultant_user.consultant_user_id', 'left');
        $this->db->where('tbl_consultant_user.consultant_user_id', $id);
        $result = $this->db->get();
        return $result->result();
    }

    public function check_consultancy_type($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_type');
        $this->db->where('tbl_consultant_type.consultant_type_id', $id);
        $result = $this->db->get();
        return $result->result();
    }
    public function get_consultant_type_status($id)
    {
        $this->db->select('status');
        $this->db->from('tbl_consultant_type');
        $this->db->where('consultant_type_id', $id);
        $result = $this->db->get();
        return $result->result();
    }
    public function get_consultant_status($id)
    {
        $this->db->select('status');
        $this->db->from('tbl_consultant_user');
        $this->db->where('consultant_user_id', $id);
        $result = $this->db->get();
        return $result->result();
    }

    public function change_status($columnName, $id, $table_name, $data)
    {
        // echo $data;die();
        $this->db->where($columnName, $id);
        $this->db->update($table_name, $data);
    }

    public function get_served_appointments($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        return $this->db->count_all_results();
    }

    public function get_consultant_wise_events($get_consultant, $get_year, $get_month)
    {
        //echo $get_consultant;die();
        $this->db->select('*, tbl_patient_user.address as address, tbl_consultant_user.name as consultant_name');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_consultant_patient_schedule', 'tbl_schedule_maker.schedule_maker_id = tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->join('tbl_consultant_user', 'tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id=tbl_consultant_user.consultant_user_id');
        $this->db->join('tbl_patient_user', 'tbl_consultant_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id');
        $this->db->join('tbl_level_care_type', 'tbl_patient_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id','left');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $get_consultant);
        $this->db->where('YEAR(tbl_schedule_maker.schedule_date) =', $get_year);
        $this->db->where('MONTH(tbl_schedule_maker.schedule_date) =', $get_month);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_total_rating($id)
    {
        $this->db->select_sum('tbl_schedule_maker.rating');
        $this->db->from('tbl_consultant_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->where('tbl_schedule_maker.rating !=', 0);
        return $this->db->get()->row();
    }
    public function consultant_appointment_count($id)
    {
        $this->db->select('*');
        $this->db->join('tbl_schedule_maker', 'tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $id);
        return $this->db->count_all_results('tbl_consultant_patient_schedule');
    }
    public function get_financial_info($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_salary');
        $this->db->join('tbl_bank_payment', 'tbl_consultant_salary.tbl_bank_payment_bank_id = tbl_bank_payment.bank_id', 'left');
        $this->db->join('tbl_mobile_payment_method', 'tbl_consultant_salary.tbl_mobile_payment_method_id = tbl_mobile_payment_method.payment_method_id', 'left');
        $this->db->where('tbl_consultant_salary.tbl_consultant_user_consultant_user_id', $id);
        return $this->db->get()->row();
    }
    public function get_consultant_carehour($id)
    {
        $this->db->select('sum(tbl_schedule_maker.clock_out_time - tbl_schedule_maker.clock_in_time) as total_care_hours');
        $this->db->join('tbl_schedule_maker', 'tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->from('tbl_consultant_patient_schedule');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $id);
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $result = $this->db->get();
        return $result->row();
    }
    public function consultant_upcoming_schedule($consultant_id)
    {
        $this->db->select('tbl_patient_user.patient_name, tbl_patient_user.patient_id, tbl_schedule_maker.start_time, tbl_schedule_maker.end_time');
        $this->db->from('tbl_consultant_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id');
        $this->db->join('tbl_patient_user', 'tbl_consultant_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id');
        $this->db->join('tbl_consultant_user', 'tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id=tbl_consultant_user.consultant_user_id');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $consultant_id);
        $this->db->where('tbl_schedule_maker.clock_in_time', null);
        $where = "(tbl_schedule_maker.schedule_date = CURDATE() or tbl_schedule_maker.schedule_date > NOW())";
        $this->db->where($where);
        $this->db->order_by('tbl_schedule_maker.schedule_date ASC');
        $result = $this->db->get();
        return $result->result();
    }
    public function consultant_care_history($consultant_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id');
        //$this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_consultant_user', 'tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id=tbl_consultant_user.consultant_user_id');
        $this->db->join('tbl_service_type', 'tbl_schedule_maker.tbl_service_type_service_type_id=tbl_service_type.service_type_id');
        $this->db->where('tbl_schedule_maker.clock_in_time !=', null);
        $this->db->where('tbl_schedule_maker.clock_out_time !=', null);
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $consultant_id);
        $this->db->order_by('tbl_schedule_maker.schedule_date ASC');
        $result = $this->db->get();
        return $result->result();
    }
}

?>