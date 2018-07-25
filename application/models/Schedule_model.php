<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    //for Patient Controller
    public function get_active_caregivers()
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_user');
        $this->db->join('tbl_app_user_login', 'tbl_caregiver_user.caregiver_user_id = tbl_app_user_login.user_id');
        $this->db->where('tbl_app_user_login.status', 1);
        $result = $this->db->get();
        return $result->result();
    }
    // Patient Ends
    
    //for Schedule Controller
    public function get_all_active_patients()
    {
        $this->db->select('*, max(tbl_schedule_maker.schedule_date) as schedule_date');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_caregiver_patient_schedule', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id = tbl_patient_user.patient_id', 'right');
        $this->db->join('tbl_app_user_login', 'tbl_patient_user.patient_id = tbl_app_user_login.user_id');
        $this->db->join('tbl_level_care_type', 'tbl_patient_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id');
        $this->db->group_by('tbl_patient_user.patient_id');
        $this->db->where('tbl_app_user_login.status', 1);
        $result = $this->db->get();
        return $result->result();
    }
    public function get_caregiver($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_preferable_caregiver_list');
        $this->db->join('tbl_patient_user', 'tbl_preferable_caregiver_list.tbl_patient_user_patient_id = tbl_patient_user.patient_id','left');
        $this->db->join('tbl_caregiver_user', 'tbl_preferable_caregiver_list.tbl_caregiver_user_caregiver_user_id = tbl_caregiver_user.caregiver_user_id','left');
        $this->db->where('tbl_preferable_caregiver_list.tbl_patient_user_patient_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function get_services()
    {
        $this->db->select('*');
        $this->db->from('tbl_service_type');
        $result = $this->db->get();
        return $result->result();
    }
    public function get_caregivers()
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_user');
        //$this->db->join('tbl_admin_user', 'tbl_admin_user.admin_user_id = tbl_schedule_maker.tbl_admin_user_admin_user_id', 'left');
        $result = $this->db->get();
        return $result->result();
    }
    public function get_available_caregivers($patient, $day_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_availability');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_availability.tbl_caregiver_user_caregiver_user_id = tbl_caregiver_user.caregiver_user_id','left');
        $this->db->join('tbl_app_user_login', 'tbl_caregiver_user.caregiver_user_id = tbl_app_user_login.user_id');
        $this->db->where('tbl_app_user_login.status', 1);
        $this->db->where($day_id, 1);
        $result = $this->db->get();
        return $result->result();
    }
//    public function get_all_schedules($id)
//    {
//        $this->db->select('*');
//        $this->db->from('tbl_caregiver_patient_schedule');
//        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id', 'left');
//        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
//        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id = tbl_patient_user.patient_id','left');
//        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $id);
//        $result = $this->db->get();
//        return $result->result_array();
//    }
    public function get_all_schedules($id)
    {
        $this->db->select('tbl_caregiver_patient_schedule.caregiver_patient_schedule_id,tbl_patient_user.patient_id, tbl_patient_user.patient_name, tbl_caregiver_user.caregiver_user_id, tbl_caregiver_user.caregiver_name, tbl_schedule_maker.schedule_maker_id,tbl_schedule_maker.schedule_date, tbl_schedule_maker.start_time, tbl_schedule_maker.end_time, tbl_schedule_maker.clock_in_time, tbl_schedule_maker.clock_out_time');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id = tbl_patient_user.patient_id','left');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_caregivers($patient, $day_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_availability');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_availability.tbl_caregiver_user_caregiver_user_id = tbl_caregiver_user.caregiver_user_id','left');
        $this->db->join('tbl_app_user_login', 'tbl_caregiver_user.caregiver_user_id = tbl_app_user_login.user_id');
        $this->db->join('tbl_preferable_caregiver_list', 'tbl_caregiver_availability.tbl_caregiver_user_caregiver_user_id = tbl_preferable_caregiver_list.tbl_caregiver_user_caregiver_user_id','left');
        $this->db->join('tbl_patient_user', 'tbl_preferable_caregiver_list.tbl_patient_user_patient_id = tbl_patient_user.patient_id','left');
        $this->db->where($day_id, 1);
        $this->db->where('tbl_app_user_login.status', 1);
        $this->db->where('tbl_preferable_caregiver_list.tbl_patient_user_patient_id', $patient);
        $result = $this->db->get();
        return $result->result();
    }

    public function check_cg_schedule($caregiver_id, $start, $end)
    {
        $this->db->select('*');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_caregiver_patient_schedule', 'tbl_schedule_maker.schedule_maker_id = tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $caregiver_id);
//        $where = "($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)";
        //$where = "($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)";
        $where = "(($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time) or (tbl_schedule_maker.start_time BETWEEN $start AND $end))";
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function check_pt_schedule($patient_id, $start, $end)
    {
        //echo $patient_id;die();
        $this->db->select('*');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_caregiver_patient_schedule', 'tbl_schedule_maker.schedule_maker_id = tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $patient_id);
        //$where = "($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)";
        //$where = "($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)";
        $where = "(($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)
        or (tbl_schedule_maker.start_time BETWEEN $start AND $end))";
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function check_clock_out($schedule_maker_id, $start_time)
    {
        $this->db->select('clock_out_time');
        $this->db->from('tbl_schedule_maker');
        $this->db->where('schedule_maker_id', $schedule_maker_id);
        $this->db->where('tbl_schedule_maker.clock_out_time <', $start_time);
        return $this->db->get()->row();
    }

    public function insert_ret($tablename, $tabledata)
    {
        $this->db->insert($tablename, $tabledata);
        //$insert_id = $this->db->insert_id();
        return $this->db->insert_id();
    }

    public function get_schedule_edit_availability($caregiver_id, $start, $end, $schedule_maker_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_schedule_maker.schedule_maker_id !=', $schedule_maker_id);
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $caregiver_id);
        //$where = "($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)";
        $where = "(($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)
        or (tbl_schedule_maker.start_time BETWEEN $start AND $end))";
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function check_pt_availability($patient_id, $start, $end, $schedule_maker_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_caregiver_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_schedule_maker.schedule_maker_id !=', $schedule_maker_id);
        $this->db->where('tbl_caregiver_patient_schedule.tbl_patient_user_patient_id', $patient_id);
        //$where = "($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)";
        $where = "(($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)
        or (tbl_schedule_maker.start_time BETWEEN $start AND $end))";
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function update_function($columnName, $columnVal, $tableName, $data)
    {
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName, $data);
    }

    public function get_selected_schedule($id)
    {
        $this->db->select('*, tbl_patient_user.address as address ');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_caregiver_patient_schedule', 'tbl_schedule_maker.schedule_maker_id = tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_level_care_type', 'tbl_patient_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id','left');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $id);
        $this->db->where('tbl_schedule_maker.schedule_date >= CURDATE()');
        $this->db->where('tbl_schedule_maker.schedule_date <= NOW() + INTERVAL 1 WEEK');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_selected_consultant_schedule($id)
    {
        $this->db->select('*, tbl_patient_user.address as address ');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_consultant_patient_schedule', 'tbl_schedule_maker.schedule_maker_id = tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->join('tbl_consultant_user', 'tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id=tbl_consultant_user.consultant_user_id');
        $this->db->join('tbl_patient_user', 'tbl_consultant_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id');
        $this->db->join('tbl_level_care_type', 'tbl_patient_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $id);
        $this->db->where('tbl_schedule_maker.schedule_date >= CURDATE()');
        $this->db->where('tbl_schedule_maker.schedule_date <= CURDATE() + INTERVAL 1 WEEK');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_clock_in($schedule)
    {
        $this->db->select('clock_in_time');
        $this->db->from('tbl_schedule_maker');
        $this->db->where('schedule_maker_id', $schedule);
        return $this->db->get()->row();
    }

    public function get_consultant()
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_user');
        return $this->db->get()->result();
    }

    public function get_all_con_schedules($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id=tbl_schedule_maker.schedule_maker_id', 'left');
        $this->db->join('tbl_consultant_user', 'tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id=tbl_consultant_user.consultant_user_id', 'left');
        $this->db->join('tbl_patient_user', 'tbl_consultant_patient_schedule.tbl_patient_user_patient_id = tbl_patient_user.patient_id','left');
        $this->db->where('tbl_consultant_patient_schedule.tbl_patient_user_patient_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function check_con_schedule($consultant_id, $start, $end)
    {
        $this->db->select('*');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_consultant_patient_schedule', 'tbl_schedule_maker.schedule_maker_id = tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $consultant_id);
        $where = "($start BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time or $end BETWEEN tbl_schedule_maker.start_time AND tbl_schedule_maker.end_time)";
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function get_con_schedule($consultant_id, $start_time, $end_time)
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_patient_schedule');
        $this->db->join('tbl_schedule_maker', 'tbl_consultant_patient_schedule.tbl_schedule_maker_schedule_maker_id = tbl_schedule_maker.schedule_maker_id');
        $this->db->where('tbl_consultant_patient_schedule.tbl_consultant_user_consultant_user_id', $consultant_id);
        $this->db->where('"'. $start_time. '" BETWEEN start_time and end_time');
        $this->db->or_where('"'. $end_time. '" BETWEEN start_time and end_time');
        return $this->db->get()->result();
    }

    public function get_active_consultants()
    {
        $this->db->select('*');
        $this->db->from('tbl_consultant_user');
        //$this->db->join('tbl_admin_user', 'tbl_admin_user.admin_user_id = tbl_schedule_maker.tbl_admin_user_admin_user_id', 'left');
        // $this->db->join('tbl_app_user_login', 'tbl_consultant_user.consultant_user_id = tbl_app_user_login.user_id');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_p_caregiver($patient,$day_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_preferable_caregiver_list');
        $this->db->join('tbl_patient_user', 'tbl_preferable_caregiver_list.tbl_patient_user_patient_id = tbl_patient_user.patient_id','left');
        $this->db->join('tbl_caregiver_user', 'tbl_preferable_caregiver_list.tbl_caregiver_user_caregiver_user_id = tbl_caregiver_user.caregiver_user_id','left');
        $this->db->where('tbl_preferable_caregiver_list.tbl_patient_user_patient_id', $patient);
        $this->db->where("tbl_caregiver_availability.$day_id", 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_caregiver_wise_events($get_caregiver, $get_year, $get_month)
    {
        $this->db->select('*, tbl_patient_user.address as address ');
        $this->db->from('tbl_schedule_maker');
        $this->db->join('tbl_caregiver_patient_schedule', 'tbl_schedule_maker.schedule_maker_id = tbl_caregiver_patient_schedule.tbl_schedule_maker_schedule_maker_id', 'left');
        $this->db->join('tbl_caregiver_user', 'tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id=tbl_caregiver_user.caregiver_user_id', 'left');
        $this->db->join('tbl_patient_user', 'tbl_caregiver_patient_schedule.tbl_patient_user_patient_id=tbl_patient_user.patient_id', 'left');
        $this->db->join('tbl_level_care_type', 'tbl_patient_user.tbl_level_care_type_level_care_type_id = tbl_level_care_type.level_care_type_id','left');
        $this->db->where('tbl_caregiver_patient_schedule.tbl_caregiver_user_caregiver_user_id', $get_caregiver);
        $this->db->where('YEAR(tbl_schedule_maker.schedule_date) =', $get_year);
        $this->db->where('MONTH(tbl_schedule_maker.schedule_date) =', $get_month);
        $result = $this->db->get();
        return $result->result();
    }
}

?>