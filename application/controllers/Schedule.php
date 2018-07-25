<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->model('Promotional_item_model');
        if ($this->session->userdata('login_id') != null) {
            $this->load->model('Schedule_model');
            $this->load->model('User_model');
            $this->load->library('Home_care_lib');
        } else {
            redirect(base_url() . 'login');
        }
    }

    // ##### New Patient Schedule Starts #####
    public function manage_schedule()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 4){
            $data['patients'] = $this->Schedule_model->get_all_active_patients();
            $data['master_body'] = $this->load->view('admin/schedule/manage_schedule', $data, true);
            $data['active_page'] = 'New Patient Schedule';
            $this->load->view('admin/master', $data);
        }else{
            $data['master_body'] = $this->load->view('admin/access_denied_page',$data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function add_schedule($id)
    {
        $data = array();
        $curr_day = date("l");
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['caregiver_info'] = $this->Schedule_model->get_caregiver($id);
        $data['service_types'] = $this->Schedule_model->get_services();
        $data['patient_info'] = $this->User_model->get_patient_info($id);
        $chk_status = $this->User_model->check_patient_status($id);
        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 4){
            if ($chk_status->status == 1) {
                $data['caregivers'] = $this->Schedule_model->get_caregivers();
                $data['available_caregivers'] = $this->Schedule_model->get_available_caregivers($id, $curr_day);
                $get_schedules = $this->Schedule_model->get_all_schedules($id);
                if($get_schedules)
                {
                    for($key = 0; $key < sizeof($get_schedules); $key++)
                    {
                        $data['schedules'][$key]['caregiver_patient_schedule_id'] = $get_schedules[$key]['caregiver_patient_schedule_id'];
                        $data['schedules'][$key]['patient_id'] = $get_schedules[$key]['patient_id'];
                        $data['schedules'][$key]['patient_name'] = $get_schedules[$key]['patient_name'];
                        $data['schedules'][$key]['caregiver_user_id'] = $get_schedules[$key]['caregiver_user_id'];
                        $data['schedules'][$key]['caregiver_name'] = $get_schedules[$key]['caregiver_name'];
                        $data['schedules'][$key]['schedule_maker_id'] = $get_schedules[$key]['schedule_maker_id'];
                        $data['schedules'][$key]['schedule_date'] = $get_schedules[$key]['schedule_date'];
                        $data['schedules'][$key]['view_schedule_date'] = $this->home_care_lib->convert_date_day_format($get_schedules[$key]['schedule_date']);
                        $data['schedules'][$key]['start_time'] = $get_schedules[$key]['start_time'];
                        $data['schedules'][$key]['clock_in_time'] = $get_schedules[$key]['clock_in_time'];
                        $data['schedules'][$key]['end_time'] = $get_schedules[$key]['end_time'];
                        $data['schedules'][$key]['clock_out_time'] = $get_schedules[$key]['clock_out_time'];
                    }
                }
                $data['master_body'] = $this->load->view('admin/schedule/add_schedule', $data, true);
                $data['active_page'] = 'New Patient Schedule';
                $this->load->view('admin/master', $data);
            } else {
                $data['master_body'] = $this->load->view('admin/error_page', $data, true);
                $data['active_page'] = 'Error';
                $this->load->view('admin/master', $data);
            }
        }else{
            $data['master_body'] = $this->load->view('admin/access_denied_page',$data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }

    }

    public function chk_modal()
    {
        $id = $this->input->post('id');
        $data['result'] = $this->Schedule_model->get_caregiver($id);
        echo json_encode($data);
    }
    
    public function get_day_name($id)
    {
        $day_name = "";
        if ($id == 1) {
            $day_name = 'Monday';
        }
        if ($id == 2) {
            $day_name = 'Tuesday';
        }
        if ($id == 3) {
            $day_name = 'Wednesday';
        }
        if ($id == 4) {
            $day_name = 'Thursday';
        }
        if ($id == 5) {
            $day_name = 'Friday';
        }
        if ($id == 6) {
            $day_name = 'Saturday';
        }
        if ($id == 0) {
            $day_name = 'Sunday';
        }
        return $day_name;
    }

    public function get_p_c()
    {
        $table_data1 = "";
        $patient = $this->input->post('patient_id');
        $patient_name = $this->input->post('patient_name');
        $day_id = $this->input->post('day_name');
        $s_date = $this->input->post('ee');
        $day_name = $this->get_day_name($day_id);
        $result = $this->Schedule_model->get_all_caregivers($patient, $day_name);
        $available_caregivers= $this->Schedule_model->get_available_caregivers($patient, $day_name);
        $create_table = "<table class=\"table table-bordered table-responsive\" style=\"\">
                                <tr>
                                    <th style=\"background-color: #303641;color: white\">Preferable Caregiver List</th>
                                </tr>
                                ";
        if($result)
        {
            foreach ($result as $row) {

                $create_table .= "<tr>
                                            <td><a href='#' onclick='show_modal(\"$row->caregiver_name\",\"$patient_name\", \"$s_date\",\"$patient\",\"$row->caregiver_user_id\")'>$row->caregiver_name</a></td>
                                      </tr>
                                      ";
            }
        }
        else
        {
            $create_table .= "<tr>
                                            <td>No Caregiver Available</td>
                                      </tr>
                                      ";
        }
        $create_table .= "<script type=\"text/javascript\">
                                    jQuery(document).ready(function ($) {
                                        var table8 = jQuery('#table-4');
                                        // Initialize DataTable
                                        table8.DataTable({
                                            \"aLengthMenu\": [[10, 25, 50, -1], [10, 25, 50, \"All\"]],
                                            \"bStateSave\": true,
                                            \"bLengthChange\": false
                                        });
                                        // Initalize Select Dropdown after DataTables is created
                                        table8.closest('.dataTables_wrapper').find('select').select2({
                                        minimumResultsForSearch: -1
                                        });
                                    });
                                </script>";
        $create_table .= "<table class=\"table table-bordered datatable\" id=\"table-4\" style=\"\">
                                <thead>
                                <tr>
                                    <th style=\"background-color: #303641;color: white\">Caregiver Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
        if($available_caregivers)
        {

            foreach ($available_caregivers as $row) {
                
                $create_table .= "<tr>
                                            <td><a href='#' onclick='show_modal(\"$row->caregiver_name\",\"$patient_name\", \"$s_date\",\"$patient\",\"$row->caregiver_user_id\")'>$row->caregiver_name</a></td>
                                      </tr>
                                      ";
            }
        }
        else
        {
            $create_table .= "<tr>
                                            <td>No Caregiver Available</td>
                                      </tr>
                                      ";
        }
        $create_table .= "</tbody>";
        echo $create_table;
    }

    // public function schedule_add_post()
    // {
    //     if (isset($_POST)) {
    //         date_default_timezone_set('Asia/Dhaka');
    //         $schedule_date = explode('/', $this->input->post('schedule_date'));
    //         $schedule_date = $schedule_date[2] . '-' . $schedule_date[0] . '-' . $schedule_date[1];
    //         $start_time = explode(' ', $this->input->post('start_time'));
    //         $start_time = $schedule_date . ' ' . $start_time[0];

    //         $start_time = strtotime($start_time) * 1000;
    //         $ending_date = $this->input->post('ending_date');
    //         $end_time = explode(' ', $this->input->post('end_time'));
    //         $end_time = $ending_date . ' ' . $end_time[0];
    //         $end_time = strtotime($end_time) * 1000;
    //         $data['schedule_date'] = $schedule_date;
    //         $data['start_time'] = $start_time;
    //         $data['end_time'] = $end_time;
    //         $data['created_date'] = date('Y-m-d');
    //         $data['status'] = 0;
    //         $data['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
    //         $data['tbl_service_type_service_type_id'] = 1;
    //         $check_cg = $this->Schedule_model->check_cg_schedule($this->input->post('caregiver_id'), $start_time, $end_time);
    //         if(sizeof($check_cg) > 0)
    //         {
    //             if($check_cg[0]->clock_out_time)
    //             {
    //                 $check_clock_out = $this->Schedule_model->check_clock_out($check_cg[0]->schedule_maker_id, $start_time);
    //                 if($check_clock_out)
    //                 {
    //                     $insert_id = $this->Schedule_model->insert_ret('tbl_schedule_maker', $data);
    //                     if (isset($insert_id)) {
    //                         //$schedule_maker_id = $insert_id;
    //                         $data1['tbl_schedule_maker_schedule_maker_id'] = $insert_id;
    //                         $data1['tbl_caregiver_user_caregiver_user_id'] = $this->input->post('caregiver_id');
    //                         $data1['tbl_patient_user_patient_id'] = $this->input->post('patient_id');
    //                         $tbl_patient_caregiver_schedule_id = $this->Schedule_model->insert_ret('tbl_caregiver_patient_schedule', $data1);
    //                         if (isset($tbl_patient_caregiver_schedule_id)) {
    //                             $this->session->set_flashdata('success_msg', 'Schedule Has Been Added Successfully.');
    //                             redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
    //                         }
    //                     } else {
    //                         $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
    //                         redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
    //                     }
    //                 }
    //                 else
    //                 {
    //                     $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
    //                     redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
    //                 }
    //             }
    //             else
    //             {
    //                 $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
    //                 redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
    //             }
    //         }
    //         else
    //         {
    //             $insert_id = $this->Schedule_model->insert_ret('tbl_schedule_maker', $data);
    //             //  echo '<pre>';print_r($insert_id);die();
    //             if (isset($insert_id)) {
    //                 //$schedule_maker_id = $insert_id;
    //                 $data1['tbl_schedule_maker_schedule_maker_id'] = $insert_id;
    //                 $data1['tbl_caregiver_user_caregiver_user_id'] = $this->input->post('caregiver_id');
    //                 $data1['tbl_patient_user_patient_id'] = $this->input->post('patient_id');
    //                 $tbl_patient_caregiver_schedule_id = $this->Schedule_model->insert_ret('tbl_caregiver_patient_schedule', $data1);
    //                 if (isset($tbl_patient_caregiver_schedule_id)) {
    //                     $this->session->set_flashdata('success_msg', 'Schedule Has Been Added Successfully.');
    //                     redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
    //                 }
    //             } else {
    //                 $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
    //                 redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
    //             }
    //         }
    //     }
    // }
    public function schedule_add_post()
    {
        if (isset($_POST)) {
            date_default_timezone_set('Asia/Dhaka');
            $schedule_date = $this->home_care_lib->format_date($this->input->post('schedule_date'));
            $start_time = $this->home_care_lib->convert_date_time_to_millisecond($schedule_date, $this->input->post('start_time'));
            $end_time = $this->home_care_lib->convert_date_time_to_millisecond($this->input->post('ending_date'), $this->input->post('end_time'));
            $data['schedule_date'] = $schedule_date;
            $data['start_time'] = $start_time;
            $data['end_time'] = $end_time;
            $data['created_date'] = date('Y-m-d');
            $data['status'] = 0;
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
            $data['tbl_service_type_service_type_id'] = 1;
            $check_cg = $this->Schedule_model->check_cg_schedule($this->input->post('caregiver_id'), $start_time+1000, $end_time+1000);
            $check_pt = $this->Schedule_model->check_pt_schedule($this->input->post('patient_id'), $start_time+1000, $end_time+1000);
            //echo '<pre>';print_r($check_pt);die();
            if($check_pt) {
                $this->session->set_flashdata('error_msg', 'Patient Already Has A Schedule During This Period!');
                redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
            }
            else {
                if((sizeof($check_cg) > 0))
                {
                    if($check_cg[0]->clock_out_time)
                    {
                        $check_clock_out = $this->Schedule_model->check_clock_out($check_cg[0]->schedule_maker_id, $start_time);
                        if($check_clock_out)
                        {
                            $insert_id = $this->Schedule_model->insert_ret('tbl_schedule_maker', $data);
                            if (isset($insert_id)) {
                                $data1['tbl_schedule_maker_schedule_maker_id'] = $insert_id;
                                $data1['tbl_caregiver_user_caregiver_user_id'] = $this->input->post('caregiver_id');
                                $data1['tbl_patient_user_patient_id'] = $this->input->post('patient_id');
                                $tbl_patient_caregiver_schedule_id = $this->Schedule_model->insert_ret('tbl_caregiver_patient_schedule', $data1);
                                if (isset($tbl_patient_caregiver_schedule_id)) {
                                    $this->session->set_flashdata('success_msg', 'Schedule Has Been Added Successfully.');
                                    redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
                                }
                            } else {
                                $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
                                redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
                            }
                        }
                        else
                        {
                            $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
                            redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
                        redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
                    }
                }
                else
                {
                    $insert_id = $this->Schedule_model->insert_ret('tbl_schedule_maker', $data);
                    if (isset($insert_id)) {
                        $data1['tbl_schedule_maker_schedule_maker_id'] = $insert_id;
                        $data1['tbl_caregiver_user_caregiver_user_id'] = $this->input->post('caregiver_id');
                        $data1['tbl_patient_user_patient_id'] = $this->input->post('patient_id');
                        $tbl_patient_caregiver_schedule_id = $this->Schedule_model->insert_ret('tbl_caregiver_patient_schedule', $data1);
                        if (isset($tbl_patient_caregiver_schedule_id)) {
                            $this->session->set_flashdata('success_msg', 'Schedule Has Been Added Successfully.');
                            redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
                        redirect('schedule/add_schedule/' . $this->input->post('patient_id'), 'refresh');
                    }
                }
            }
        }
    }

    public function schedule_edit_post()
    {
        if (isset($_POST)) {
            date_default_timezone_set('Asia/Dhaka');
            $schedule_date = $this->input->post('e_starting_date');
            $start_time = $this->home_care_lib->convert_date_time_to_millisecond($schedule_date, $this->input->post('e_start_time'));

            $ending_date = $this->input->post('e_ending_date');
            $end_time = $this->home_care_lib->convert_date_time_to_millisecond($ending_date, $this->input->post('e_end_time'));
            $schedule_maker_id = $this->input->post('schedule_maker_id');
            $caregiver_patient_schedule = $this->input->post('caregiver_patient_schedule');
            $data['schedule_date'] = $schedule_date;
            $data['start_time'] = $start_time;
            $data['end_time'] = $end_time;
            $data['created_date'] = date('Y-m-d');
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
            $data['tbl_service_type_service_type_id'] = 1;
            $check_availability = $this->Schedule_model->get_schedule_edit_availability($this->input->post('e_caregiver_name'), $data['start_time'], $data['end_time']-1000, $schedule_maker_id);
            $check_pt_availability = $this->Schedule_model->check_pt_availability($this->input->post('e_patient_id'), $data['start_time'], $data['end_time']-1000, $schedule_maker_id);
            if($check_availability || $check_pt_availability)
            {
                $this->session->set_flashdata('error_msg', 'Patient/Caregiver not available. Schedule Can Not Be Updated');
                redirect('schedule/add_schedule/' . $this->input->post('e_patient_id'), 'refresh');
            }
            else
            {
                if($end_time > $start_time)
                {
                    $this->Schedule_model->update_function('schedule_maker_id', $_POST['schedule_maker_id'], 'tbl_schedule_maker', $data);
                    $data1['tbl_schedule_maker_schedule_maker_id'] = $schedule_maker_id;
                    $data1['tbl_caregiver_user_caregiver_user_id'] = $this->input->post('e_caregiver_name');
                    $data1['tbl_patient_user_patient_id'] = $this->input->post('e_patient_id');
                    $this->Schedule_model->update_function('caregiver_patient_schedule_id', $caregiver_patient_schedule, 'tbl_caregiver_patient_schedule', $data1);
                    $this->session->set_flashdata('success_msg', 'Schedule Has Been Updated Successfully.');
                    redirect('schedule/add_schedule/' . $this->input->post('e_patient_id'), 'refresh');
                }
                else{
                    $this->session->set_flashdata('error_msg', 'End date/time cannot be higher than start date/time');
                    redirect('schedule/add_schedule/' . $this->input->post('e_patient_id'), 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Updated');
            redirect('schedule/add_schedule/' . $this->input->post('e_patient_id'), 'refresh');
        }
    }

    public function check_cg_availability()
    {
        $cg_id = $this->input->post('cg_id');
        $start_time = $this->input->post('starting_time');
        $end_time = $this->input->post('ending_time');
        //print_r($start_time.' '.$end_time);die();
        $check_schedule = $this->Schedule_model->check_cg_schedule($cg_id, $start_time+1000, $end_time+1000);
        //print_r($check_schedule);die();
        if(sizeof($check_schedule) > 0)
        {
            if($check_schedule[0]->clock_out_time)
            {
                $check_clock_out = $this->Schedule_model->check_clock_out($check_schedule[0]->schedule_maker_id, $start_time);
                if($check_clock_out)
                {
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                echo 0;
            }
        }
        else
        {
            echo 1;
        }
    }

    // ##### New Patient Schedule Ends #####

    // ##### Caregiver Events List Starts #####
    public function show_caregiver_events()
    {
        date_default_timezone_set('Asia/Dhaka');
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['caregivers'] = $this->Schedule_model->get_active_caregivers();
        $data['master_body'] = $this->load->view('admin/caregiver_events/show_events', $data, true);
        $data['active_page'] = 'Caregiver Event List';
        $this->load->view('admin/master', $data);
    }

    public function fetch_events()
    {
        $get_caregiver = $this->input->post('caregiver_id');
        $get_month = $this->input->post('month_id');
        $get_year = $this->input->post('year_id');
        $event_result = $this->Schedule_model->get_caregiver_wise_events($get_caregiver, $get_year, $get_month);
        $create_table = "<script type=\"text/javascript\">
                                    jQuery(document).ready(function ($) {
                                        var table4 = jQuery(\"#table-4\");

                                        table4.DataTable({
                                            \"aLengthMenu\": [[10, 25, 50, -1], [10, 25, 50, \"All\"]],
                                            \"bStateSave\": true,
                                            \"responsive\": true,
                                            \"columnDefs\": [ { 
                                                \"defaultContent\": \"-\", 
                                                \"targets\": \"_all\"} ]
                                        });
                                        table4.closest('.dataTables_wrapper').find('select').select2({
                                            minimumResultsForSearch: -1
                                        });
                                    });
                                </script>";
        $create_table .= "<table class=\"table table-bordered datatable\" id=\"table-4\" width=\"100%\">
                                <thead>
                                <tr>
                                    <th style=\"background-color: #303641;color: white\">Patient Name</th>
                                    <th style=\"background-color: #303641;color: white\">Patient Address</th>
                                    <th style=\"background-color: #303641;color: white\">Caregiver Name</th>
                                    <th style=\"background-color: #303641;color: white\">Starting Time</th>
                                    <th style=\"background-color: #303641;color: white\">Clock-In Time</th>
                                    <th style=\"background-color: #303641;color: white\">Ending Time</th>
                                    <th style=\"background-color: #303641;color: white\">Clock-Out Time</th>
                                    <th style=\"background-color: #303641;color: white\">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
        if($event_result)
        {
            foreach ($event_result as $key=>$row)
            {
                $start_time = $this->home_care_lib->millisecond_to_datetime($row->start_time);
                $end_time = $this->home_care_lib->millisecond_to_datetime($row->end_time);
                $clock_in_time = "";
                $clock_out_time = "";
                $schedule_date = $this->home_care_lib->convert_date_day_format($row->schedule_date);
                if($row->clock_in_time)
                {
                    $clock_in_time = $this->home_care_lib->millisecond_to_datetime($row->clock_in_time);
                }
                if($row->clock_out_time)
                {
                    $clock_out_time = $this->home_care_lib->millisecond_to_datetime($row->clock_out_time);
                }
                $create_table .= "<tr>
                                            <td><a href='".site_url('patient/view_profile')."/".$row->patient_id."' title='Go To Profile'>$row->patient_name</a></td>
                                            <td>$row->address </td>
                                            <td><a href='".site_url('caregiver/view_profile')."/".$row->caregiver_user_id."' title='Go To Profile'>$row->caregiver_name</a></td>
                                            <td>$start_time</td>
                                            <td>$clock_in_time</td>
                                            <td>$end_time</td>
                                            <td>$clock_out_time</td>
                                            <td><a href='javascript:void(0)' onclick='setModal(\"$row->patient_name\", \"$row->caregiver_name\", \"$row->schedule_date\", \"$row->start_time\", \"$row->end_time\", \"$row->schedule_maker_id\", \"$row->clock_in_time\", \"$row->clock_out_time\")'><button type=\"button\" class=\"btn btn-primary\"><i class=\"entypo-clock\"></i></button></a></td>
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

    public function get_selected_schedule()
    {
        $id = $this->input->post('caregiver_id');
        $data['result'] = $this->Schedule_model->get_selected_schedule($id);
        foreach ($data['result'] as &$row)
        {
            $row['schedule_date'] = $this->home_care_lib->convert_date_day_format($row['schedule_date']);
        }
        echo json_encode($data);
    }

    public function get_selected_consultant_schedule()
    {
        $id = $this->input->post('consultant_id');
        //echo $id;die();
        $data['result'] = $this->Schedule_model->get_selected_consultant_schedule($id);
        echo '<pre>';print_r($data);die();
        echo json_encode($data);
    }
    

    public function clocking_add_post()
    {
        if (isset($_POST['c_start_time']) || isset($_POST['c_end_time'])) {
            date_default_timezone_set('Asia/Dhaka');
            $schedule_maker_id = $this->input->post('schedule_maker_id');
            $start = $this->input->post('clocking_test');
            if (($start == 0) && ($this->input->post('c_end_time') == "") && ($this->input->post('c_start_time'))) {
                $start_time = $this->input->post('c_schedule_date') . ' ' . $this->input->post('c_start_time');
                $data['status'] = 1;
                $data['clock_in_time'] = strtotime($start_time) * 1000;
                $this->Schedule_model->update_function('schedule_maker_id', $schedule_maker_id, 'tbl_schedule_maker', $data);
                $this->session->set_flashdata('success_msg', 'ClockIn/ClockOut Has Been Updated');
                redirect('schedule/show_caregivers', 'refresh');
            }

            if (($start == 1) && ($this->input->post('c_end_time'))) {
                $clock_in = $this->Schedule_model->get_clock_in($schedule_maker_id);
                $data['clock_in_time'] = $clock_in->clock_in_time;
                $end_time = $this->input->post('c_ending_date') . ' ' . $this->input->post('c_end_time');
                $data['clock_out_time'] = strtotime($end_time) * 1000;
                $data['status'] = 2;
                $data['carehours'] = $data['clock_out_time'] - $clock_in->clock_in_time;
                $data['feedback_to_be_given'] = 1;
                $this->Schedule_model->update_function('schedule_maker_id', $schedule_maker_id, 'tbl_schedule_maker', $data);
                $this->session->set_flashdata('success_msg', 'ClockIn/ClockOut Has Been Updated');
                redirect('schedule/show_caregivers', 'refresh');
            }
            if (!($this->input->post('c_start_time')) || !($this->input->post('c_end_time'))) {
                $this->session->set_flashdata('error_msg', 'ClockIn/ClockOut Can Not Be Updated');
                redirect('schedule/show_caregivers', 'refresh');
            } else {
                $this->session->set_flashdata('error_msg', 'You Have To Clock In First');
                redirect('schedule/show_caregivers', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_msg', 'ClockIn/ClockOut Can Not Be Updated');
            redirect('schedule/show_caregivers', 'refresh');
        }
    }
    // ##### Caregiver Events List Ends #####

    // ##### Consultant Schedule Starts #####
    public function add_consultant($id)
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['consultant_list'] = $this->Schedule_model->get_consultant();
        $data['patient_info'] = $this->User_model->get_patient_info($id);
        $data['service_types'] = $this->Schedule_model->get_services();
        if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 4) {
            if (sizeof($data['consultant_list']) != null) {
                $data['schedules'] = $this->Schedule_model->get_all_con_schedules($id);
                $data['master_body'] = $this->load->view('admin/schedule/add_consultant', $data, true);
                $data['active_page'] = 'New Patient Schedule';
                $this->load->view('admin/master', $data);
            } else {
                $data['master_body'] = $this->load->view('admin/error_page', $data, true);
                $data['active_page'] = 'Error';
                $this->load->view('admin/master', $data);
            }
        }else{
            $data['master_body'] = $this->load->view('admin/access_denied_page',$data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }

    }

    public function con_clocking_add_post()
    {
        if (isset($_POST)) {
            date_default_timezone_set('Asia/Dhaka');
            $schedule_maker_id = $this->input->post('schedule_maker_id');
            $start = $this->input->post('clocking_test');
            if (($start == "Invalid date") && ($this->input->post('c_end_time') == null)) {
                $start_time = $this->input->post('c_schedule_date') . ' ' . $this->input->post('c_start_time');
                $data['clock_in_time'] = strtotime($start_time) * 1000;
                $data['status'] = 1;
                $this->Schedule_model->update_function('schedule_maker_id', $schedule_maker_id, 'tbl_schedule_maker', $data);
                $this->session->set_flashdata('success_msg', 'ClockIn/ClockOut Has Been Updated');
                redirect('schedule/show_consultants', 'refresh');
            }
            if (($start != "Invalid date") && ($this->input->post('c_end_time') == null)) {
                $clock_in = $this->Schedule_model->get_clock_in($schedule_maker_id);
                $end_time = $this->input->post('c_schedule_date') . ' ' . $start;
                $data['clock_out_time'] = strtotime($end_time) * 1000;
                $data['status'] = 2;
                $data['carehours'] = $data['clock_out_time'] - $clock_in->clock_in_time;
                $data['feedback_to_be_given'] = 1;
                $this->Schedule_model->update_function('schedule_maker_id', $schedule_maker_id, 'tbl_schedule_maker', $data);
                $this->session->set_flashdata('success_msg', 'ClockIn/ClockOut Has Been Updated');
                redirect('schedule/show_consultants', 'refresh');
            }
            if (($start != "Invalid date") && ($this->input->post('c_end_time') != null)) {
                $clock_in = $this->Schedule_model->get_clock_in($schedule_maker_id);
                $end_time = $this->input->post('c_ending_date') . ' ' . $this->input->post('c_end_time');
                $data['clock_in_time'] = $clock_in->clock_in_time;
                $data['clock_out_time'] = strtotime($end_time) * 1000;
                $data['status'] = 2;
                $data['feedback_to_be_given'] = 1;
                $data['carehours'] = $data['clock_out_time'] - $clock_in->clock_in_time;
                $this->Schedule_model->update_function('schedule_maker_id', $schedule_maker_id, 'tbl_schedule_maker', $data);
                $this->session->set_flashdata('success_msg', 'ClockIn/ClockOut Has Been Updated');
                redirect('schedule/show_consultants', 'refresh');
            }

            if (empty($this->input->post('c_start_time')) && empty($this->input->post('c_end_time'))) {
                $this->session->set_flashdata('error_msg', 'ClockIn/ClockOut Can Not Be Updated');
                redirect('schedule/show_consultants', 'refresh');
            } else {
                $this->session->set_flashdata('error_msg', 'You Have To Clock In First');
                redirect('schedule/show_consultants', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_msg', 'ClockIn/ClockOut Can Not Be Updated');
            redirect('schedule/show_consultants', 'refresh');
        }
    }

    public function con_schedule_add_post()
    {
        if (isset($_POST)) {
            date_default_timezone_set('Asia/Dhaka');
            $schedule_date = explode('/', $this->input->post('schedule_date'));
            $schedule_date = $schedule_date[2] . '-' . $schedule_date[0] . '-' . $schedule_date[1];
            $start_time = explode(' ', $this->input->post('start_time'));
            $start_time = $schedule_date . ' ' . $start_time[0];

            $start_time = strtotime($start_time) * 1000;
            $ending_date = $this->input->post('ending_date');
            $end_time = explode(' ', $this->input->post('end_time'));
            $end_time = $ending_date . ' ' . $end_time[0];
            $end_time = strtotime($end_time) * 1000;
            $data['schedule_date'] = $schedule_date;
            $data['start_time'] = $start_time;
            $data['end_time'] = $end_time;
            $data['created_date'] = date('Y-m-d');
            $data['status'] = 1;
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
            $data['tbl_service_type_service_type_id'] = 2;
            $check_con = $this->Schedule_model->check_con_schedule($this->input->post('consultant_id'), $start_time, $end_time);
            if(sizeof($check_con) > 0)
            {
                $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
                redirect('schedule/add_consultant/' . $this->input->post('patient_id'), 'refresh');
            }
            else{
                $insert_id = $this->Schedule_model->insert_ret('tbl_schedule_maker', $data);
                if (isset($insert_id)) {
                    $data1['tbl_schedule_maker_schedule_maker_id'] = $insert_id;
                    $data1['tbl_consultant_user_consultant_user_id'] = $this->input->post('consultant_id');
                    $data1['tbl_patient_user_patient_id'] = $this->input->post('patient_id');
                    $tbl_patient_caregiver_schedule_id = $this->Schedule_model->insert_ret('tbl_consultant_patient_schedule', $data1);
                    if (isset($tbl_patient_caregiver_schedule_id)) {
                        $this->session->set_flashdata('success_msg', 'Schedule Has Been Added Successfully.');
                        redirect('schedule/add_consultant/' . $this->input->post('patient_id'), 'refresh');
                    }
                }
                else {
                    $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Added');
                    redirect('schedule/add_consultant/' . $this->input->post('patient_id'), 'refresh');
                }
            }

        }
    }

    public function check_con_timing()
    {
        $consultant_id = $this->input->post('consultant');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $check_con = $this->Schedule_model->get_con_schedule($consultant_id, $start_time, $end_time);
        if(sizeof($check_con) > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

    public function con_schedule_edit_post()
    {
        if (isset($_POST)) {
            date_default_timezone_set('Asia/Dhaka');
            $schedule_date = $this->input->post('e_starting_date');
            $start_time = explode(' ', $this->input->post('e_start_time'));
            $start_time = $schedule_date . ' ' . $start_time[0];
            $start_time = strtotime($start_time) * 1000;
            
            $ending_date = $this->input->post('e_ending_date');
            $end_time = explode(' ', $this->input->post('e_end_time'));
            $end_time = $ending_date . ' ' . $end_time[0];
            $end_time = strtotime($end_time) * 1000;
            // echo '<pre>';print_r($end_time);die();
            $schedule_maker_id = $this->input->post('schedule_maker_id');
            $caregiver_patient_schedule = $this->input->post('caregiver_patient_schedule');
            $data['schedule_date'] = $schedule_date;
            $data['start_time'] = $start_time;
            $data['end_time'] = $end_time;
            $data['created_date'] = date('Y-m-d');
            $data['status'] = 0;
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
            $data['tbl_service_type_service_type_id'] = 2;
            $check_schedule = $this->Schedule_model->get_con_schedule($this->input->post('e_caregiver_id'), $start_time, $end_time);
            if(sizeof($check_schedule) > 0)
            {
                $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Updated');
                redirect('schedule/add_consultant/' . $this->input->post('e_patient_id'), 'refresh');
            }
            else
            {
                $this->Schedule_model->update_function('schedule_maker_id', $schedule_maker_id, 'tbl_schedule_maker', $data);
                $data1['tbl_schedule_maker_schedule_maker_id'] = $schedule_maker_id;
                $data1['tbl_consultant_user_consultant_user_id'] = $this->input->post('e_caregiver_id');
                $data1['tbl_patient_user_patient_id'] = $this->input->post('e_patient_id');
                $this->Schedule_model->update_function('tbl_schedule_maker_schedule_maker_id', $schedule_maker_id, 'tbl_consultant_patient_schedule', $data1);
                $this->session->set_flashdata('success_msg', 'Schedule Has Been Updated Successfully.');
                redirect('schedule/add_consultant/' . $this->input->post('e_patient_id'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Schedule Can Not Be Updated');
            redirect('schedule/add_consultant/' . $this->input->post('e_patient_id'), 'refresh');
        }
    }

    public function con_schedule_delete()
    {
        $this->load->model('Admin_model');
        $id = $this->input->post('d_schedule_id');
        $patient_id = $this->input->post('d_patient_id');
        $schedule_maker = $this->input->post('d_schedule_maker');
        $this->Admin_model->delete_function('tbl_consultant_patient_schedule', 'consultant_patient_schedule_id', $id);
        $this->Admin_model->delete_function('tbl_schedule_maker', 'schedule_maker_id', $schedule_maker);
        $this->session->set_flashdata('success_msg', 'Consultant Schedule Deleted Successfully');
        redirect('schedule/add_consultant/' . $patient_id, 'refresh');
    }

    public function schedule_delete()
    {
        $this->load->model('Admin_model');
        $id = $this->input->post('del_schedule_id');
        $patient_id = $this->input->post('del_patient_id');
        $schedule_maker = $this->input->post('del_schedule_maker');
        $this->Admin_model->delete_function('tbl_caregiver_patient_schedule', 'caregiver_patient_schedule_id', $id);
        $this->Admin_model->delete_function('tbl_schedule_maker', 'schedule_maker_id', $schedule_maker);
        $this->session->set_flashdata('success_msg', 'Caregiver Schedule Deleted Successfully');
        redirect('schedule/add_schedule/' . $patient_id, 'refresh');
    }

    public function show_consultant_events()
    {
        date_default_timezone_set('Asia/Dhaka');
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['consultants'] = $this->Schedule_model->get_active_consultants();
        $data['master_body'] = $this->load->view('admin/consultant_events/show_events', $data, true);
        $data['active_page'] = 'Consultant Event List';
        $this->load->view('admin/master', $data);
    }

}