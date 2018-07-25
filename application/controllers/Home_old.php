<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login_id')!=null)
        {
            $this->load->model('Home_model');
            $this->load->library('Home_care_lib');
        }
        else
        {
            redirect(base_url().'login');
        }
    }
    public function index()
    {
        $data=array();
        $data['top_header']=$this->load->view('admin/top_header','',true);
       // echo '<pre>';print_r($data);die();
        $data['footer']=$this->load->view('admin/footer','',true);
        $data['active_caregivers'] = $this->Home_model->count_data_active_caregivers();
        $data['total_caregivers'] = $this->Home_model->count_data('tbl_caregiver_user');
        $care_hours = $this->Home_model->get_all_carehours('tbl_schedule_maker');
        //echo '<pre>';print_r($care_hours);die();
        $today_date = date('Y-m-d');
        //$data['care_hours'] = $care_hours[0]->carehours/3600000;
        $data['care_hours'] = $this->home_care_lib->millisecond_to_hour_min_time($care_hours[0]->carehours);
        //print_r($data['care_hours']);die();
        $data['active_clients'] = $this->Home_model->count_data_active_clients();
        $data['total_clients'] = $this->Home_model->count_data('tbl_patient_user');
        $data['total_devices'] = $this->Home_model->count_devices();
        $data['get_age'] = $this->Home_model->get_all_patients('tbl_patient_user', $today_date);
        $curr_date = explode('-', date('Y-m-d'));
        $month = $curr_date[1];
        //echo $month;die();
        $data['get_caregiver_schedules'] = $this->Home_model->get_schedules($month);
       // echo '<pre>';print_r($data['get_caregiver_schedules']);die();
        $data['master_body']=$this->load->view('admin/home/view_home',$data,true);
        $data['active_page'] = 'Home';
        $this->load->view('admin/master',$data);
    }

    public function operation_of_clocked_in_time($scheduled_time)
    {
        date_default_timezone_set('Asia/Dhaka');
        $date = date('m/d/Y H:i:s', time());
        $now = strtotime($date)*1000;

        if ($now <= $scheduled_time)
            return "Scheduled";
        else
            return "Delayed";
    }

    public function check_over_time($end_time)
    {
        date_default_timezone_set('Asia/Dhaka');
        $date = date('m/d/Y H:i:s', time());
        $now = strtotime($date)*1000;

        if ($now >= $end_time)
            return "Over Time";
        else
            return "Active";
    }

    public function millisecond_to_datetime($millisecond_time)
    {
        date_default_timezone_set('Asia/Dhaka');

        $datetime = $millisecond_time/1000;
        $datetime = date('F d, Y h:i A', $datetime);

        return $datetime;
    }

    public function fetch_history()
    {
        $selected_date = $this->input->post('month_name');
        $fetch_data = $this->Home_model->get_schedules_selected($selected_date);
        //print_r($fetch_data);die();
        $create_table = "<script type=\"text/javascript\">
                                    jQuery(document).ready(function ($) {
                                        var table4 = jQuery(\"#table-4\");

                                        table4.DataTable({
                                            \"aLengthMenu\": [[10, 25, 50, -1], [10, 25, 50, \"All\"]],
                                            \"bStateSave\": false,
                                            \"columnDefs\": [ { 
                                                \"defaultContent\": \"-\", 
                                                \"targets\": \"_all\"} ]
                                        });
                                        table4.closest('.dataTables_wrapper').find('select').select2({
                                            minimumResultsForSearch: -1
                                        });
                                    });
                                </script>";
        $create_table .= "<table class=\"table table-bordered datatable\" id=\"table-4\" style=\"\">
                                <thead>
                                <tr>
                                    <th style=\"background-color: #303641;color: white\">Patient Name</th>
                                    <th style=\"background-color: #303641;color: white\">Patient Address</th>
                                    <th style=\"background-color: #303641;color: white\">Caregiver Name</th>
                                    <th style=\"background-color: #303641;color: white\">Caregiver Phone</th>
                                    <th style=\"background-color: #303641;color: white\">Starting Time</th>
                                    <th style=\"background-color: #303641;color: white\">Clock-In Time</th>
                                    <th style=\"background-color: #303641;color: white\">Ending Time</th>
                                    <th style=\"background-color: #303641;color: white\">Clock-Out Time</th>
                                    <th style=\"background-color: #303641;color: white\">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
        if (sizeof($fetch_data) > 0) {
            foreach ($fetch_data as $row) {
                $status = "-";
                $start_time = $this->millisecond_to_datetime($row->start_time);
                $end_time = $this->millisecond_to_datetime($row->end_time);

                if(!($row->clock_in_time))
                {
                    $schedule_status = $this->operation_of_clocked_in_time($row->start_time);
                    if($schedule_status == "Scheduled")
                    {
                        $status = "<div class=\"label label-success\">$schedule_status</div>";
                    }
                    else{
                        $status = "<div class=\"label label-danger\">$schedule_status</div>";
                    }
                    $clock_in_time = "N/A";
                    $clock_out_time = "N/A";
                }
                else if($row->clock_in_time && !($row->clock_out_time))
                {
                    $check_overtime = $this->check_over_time($row->end_time);
//                    $status = "<div class=\"label label-success\">Active</div>";
//                    $clock_in_time = $this->millisecond_to_datetime($row->clock_in_time);
//                    $clock_out_time = "N/A";
                    if($check_overtime == "Active")
                    {
                        $status = "<div class=\"label label-success\">$check_overtime</div>";
                        $clock_in_time = $this->millisecond_to_datetime($row->clock_in_time);
                        $clock_out_time = "N/A";
                    }
                    else{
                        $status = "<div class=\"label label-warning\">$check_overtime</div>";
                        $clock_in_time = $this->millisecond_to_datetime($row->clock_in_time);
                        $clock_out_time = "N/A";
                    }
                }
                else
                {
                    $status = "<div class=\"label label-primary\">Completed</div>";
                    $clock_in_time = $this->millisecond_to_datetime($row->clock_in_time);
                    $clock_out_time = $this->millisecond_to_datetime($row->clock_out_time);;
                }

                $create_table .= "<tr>
                                            <td><a href='".site_url('patient/view_profile')."/".$row->patient_id."' title='Go To Profile'>$row->patient_name</a></td>
                                            <td>$row->patient_address </td>
                                            <td><a href='".site_url('caregiver/view_profile')."/".$row->caregiver_user_id."' title='Go To Profile'>$row->caregiver_name</a></td>
                                            <td>$row->cg_phone</td>
                                            <td>$start_time</td>
                                            <td>$clock_in_time</td>
                                            <td>$end_time</td>
                                            <td>$clock_out_time</td>
                                            <td>$status</td>
                                      </tr>
                                      ";
            }
        }
        else
        {
            $create_table .= "<tr>
                                            <td colspan='9' style='text-align: center; color: red'>No Data Found</td>
                                      </tr>
                                      ";
        }
        $create_table.="</tbody>";
        echo $create_table;
    }
}