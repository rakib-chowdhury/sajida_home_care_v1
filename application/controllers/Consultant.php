<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultant extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login_id') != null) {
            $this->load->model('Consultant_model');
            $this->load->library('Home_care_lib');
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function add_consultant()
    {
        //echo 'yes';die();
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 4) {
            $data['consultant_type'] = $this->Consultant_model->getAllRecords('tbl_consultant_type');
            $data['bank_info'] = $this->Consultant_model->getAllRecords('tbl_bank_payment');
            $data['payment_method'] = $this->Consultant_model->getAllRecords('tbl_mobile_payment_method');
            $data['master_body'] = $this->load->view('admin/consultant/add_consultant_info', $data, true);
            $data['active_page'] = 'Add Consultant Info';
            $this->load->view('admin/master', $data);
        } else {
            $data['master_body'] = $this->load->view('admin/access_denied_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function edit_consultant_info($id)
    {
        $id = $id;
        //echo '<pre>';print_r($id);die();
        $data = array();
        if(($_SESSION['user_type'] == 1) || ($_SESSION['user_type'] == 2) || ($_SESSION['user_type'] == 3) || ($_SESSION['user_type'] == 4))
        {
            $data['consultant_type'] = $this->Consultant_model->getAllRecords('tbl_consultant_type');
            $data['get_consultant_info'] = $this->Consultant_model->getWhereConsultant($id);
            //echo '<pre>';print_r($data);die();
            if (sizeof($data['get_consultant_info']) != null) {
                $data['top_header'] = $this->load->view('admin/top_header', '', true);
                $data['footer'] = $this->load->view('admin/footer', '', true);
                $data['bank_info'] = $this->Consultant_model->getAllRecords('tbl_bank_payment');
                $data['payment_method'] = $this->Consultant_model->getAllRecords('tbl_mobile_payment_method');
                $data['active_page'] = 'Edit Consultant Info';
                $data['master_body'] = $this->load->view('admin/consultant/edit_consultant_info', $data, true);
                $data['active_page'] = 'Manage Consultant Info';
                $this->load->view('admin/master', $data);
            } else {
                $data['top_header'] = $this->load->view('admin/top_header', '', true);
                $data['footer'] = $this->load->view('admin/footer', '', true);
                $data['master_body'] = $this->load->view('admin/error_page', $data, true);
                $data['active_page'] = 'Error';
                $this->load->view('admin/master', $data);
            }
        }
        else {
            $data['master_body'] = $this->load->view('admin/access_denied_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function consultant_info_edit_post()
    {
       // echo '<pre>';print_r($_POST);die();
        $consultant_id = $this->input->post('id');
        $salary_id = $this->input->post('salary_id');
        if($_POST['name'] && $_POST['phone_number'] && $_POST['email'] && $_POST['tbl_consultant_type_consultant_type_id']
            && $_POST['fixed_salary_rate'] && $_POST['payment_type'])
        {
            $data['name'] = $this->input->post('name');
            $data['phone_number'] = $this->input->post('phone_number');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['description'] = $this->input->post('description');
            $data['tbl_consultant_type_consultant_type_id'] = $this->input->post('tbl_consultant_type_consultant_type_id');
            //echo '<pre>';print_r($data);die();
            $salary_data['fixed_session_rate'] = $this->input->post('fixed_salary_rate');
            $payment_type = $this->input->post('payment_type');
            $salary_data['payment_type'] = $payment_type;
            if($payment_type == "Bank")
            {
                $salary_data['tbl_bank_payment_bank_id'] = $this->input->post('tbl_bank_payment_bank_id');
                $salary_data['bank_account_number'] = $this->input->post('bank_account_number');
            }
            else if ($payment_type == "Mobile")
            {
                $salary_data['tbl_mobile_payment_method_id'] = $this->input->post('mobile_payment_method_id');
                $salary_data['mobile_payment_number'] = $this->input->post('mobile_payment_number');
            }
            else{
                $salary_data['tbl_bank_payment_bank_id'] = 0;
                $salary_data['bank_account_number'] = 0;
                $salary_data['tbl_mobile_payment_method_id'] = 0;
                $salary_data['mobile_payment_number'] = 0;
            }
            $this->Consultant_model->update_function('consultant_user_id', $consultant_id, 'tbl_consultant_user', $data);
            $this->Consultant_model->update_function('consultant_salary_id', $salary_id, 'tbl_consultant_salary', $salary_data);
            //echo '<pre>';print_r($salary_data);die();
            $this->session->set_flashdata('success_msg', 'Consultant Info Updated Successfully');
            redirect('manage_consultant_info', 'refresh');
        }
        else{
            $this->session->set_flashdata('error_msg', 'Consultant type Can Not Be Updated');
            redirect('edit_consultant_type/'.$consultant_id, 'refresh');
        }
    }

    public function edit_consultant_type($id)
    {
        //echo '<pre>';print_r($id);die();
        $data = array();
        //echo '<pre>';print_r($data);die();
        $check_consultancy_type = $this->Consultant_model->check_consultancy_type($id);
        if ($check_consultancy_type) {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['active_page'] = 'Manage Consultant Info';
            $data['consultancy_type'] = $check_consultancy_type;
            $data['master_body'] = $this->load->view('admin/settings/consultant_type/edit_consultant_type', $data, true);
            $data['active_page'] = 'Manage Consultant Info';
            $this->load->view('admin/master', $data);
        } else {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['master_body'] = $this->load->view('admin/error_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function manage_consultants()
    {
        //echo 'yes';die();
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
            $data['get_consultant_info'] = $this->Consultant_model->get_all_consultants();
            //echo '<pre>';print_r($data['get_consultant_info']);die();
            $data['master_body'] = $this->load->view('admin/consultant/manage_consultant_info', $data, true);
            $data['active_page'] = 'Manage Consultant Info';
            $this->load->view('admin/master', $data);
        } else {
            $data['master_body'] = $this->load->view('admin/access_denied_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function manage_consultant_type()
    {
        //echo 'yes';die();
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
            $data['consultant_types'] = $this->Consultant_model->getAllRecords('tbl_consultant_type');
            $data['master_body'] = $this->load->view('admin/settings/consultant_type/manage_consultant_type', $data, true);
            $data['active_page'] = 'Manage Consultant Type';
            $this->load->view('admin/master', $data);
        } else {
            $data['master_body'] = $this->load->view('admin/access_denied_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function add_consultant_type()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
            $data['master_body'] = $this->load->view('admin/settings/consultant_type/add_consultant_type', $data, true);
            $data['active_page'] = 'New Consultant Type';
            $this->load->view('admin/master', $data);
        } else {
            $data['master_body'] = $this->load->view('admin/access_denied_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function consultant_info_add_post()
    {
        //echo '<pre>';print_r($_POST);die();
        if (!isset($_POST)) {
            $this->session->set_flashdata('error_msg', 'Consultant Can Not Be Added');
            redirect('settings/manage_consultant_info', 'refresh');
        } else {
            $table_name = 'tbl_consultant_user';
            $count_consultant = $this->Consultant_model->count_data($table_name);
            $count_consultant = $count_consultant + 1;
            $data['consultant_user_id'] = 'C'.$this->home_care_lib->get_id(date('m/d/Y')).$count_consultant;
            $data['name'] = $this->input->post('name');
            $data['phone_number'] = $this->input->post('phone_number');
            $data['email'] = $this->input->post('email');
            $data['address'] = $this->input->post('address');
            $data['description'] = $this->input->post('description');
            $data['status'] = 1;
            $data['tbl_consultant_type_consultant_type_id'] = $this->input->post('tbl_consultant_type_consultant_type_id');
            $salary_data['fixed_session_rate'] = $this->input->post('fixed_salary_rate');
            $payment_type = $this->input->post('payment_type');
            $salary_data['payment_type'] = $payment_type;
            if($payment_type == "Bank")
            {
                $salary_data['tbl_bank_payment_bank_id'] = $this->input->post('tbl_bank_payment_bank_id');
                $salary_data['bank_account_number'] = $this->input->post('bank_account_number');
            }
            else if ($payment_type == "Mobile")
            {
                $salary_data['tbl_mobile_payment_method_id'] = $this->input->post('mobile_payment_method_id');
                $salary_data['mobile_payment_number'] = $this->input->post('mobile_payment_number');
            }
            else{
                $salary_data['tbl_bank_payment_bank_id'] = 0;
                $salary_data['bank_account_number'] = 0;
                $salary_data['tbl_mobile_payment_method_id'] = 0;
                $salary_data['mobile_payment_number'] = 0;
            }
            $salary_data['tbl_consultant_user_consultant_user_id'] = $data['consultant_user_id'];
            //echo '<pre>';print_r($salary_data);die();
            $chk_consultant = $this->Consultant_model->get_consultant($this->input->post('consultant_user_id'));
            if (sizeof($chk_consultant) == null) {
                $chk = $this->Consultant_model->insert_ret('tbl_consultant_user', $data);
                if (isset($chk)) {
                    $this->Consultant_model->insert_ret('tbl_consultant_salary', $salary_data);
                    $this->session->set_flashdata('success_msg', 'Consultant Added Successfully');
                    redirect('manage_consultant_info', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Consultant Already Exists');
                redirect('add_consultant_info', 'refresh');
            }
        }
    }

    public function consultant_type_add_post()
    {
        if (isset($_POST)) {
            $data['type_name'] = $this->input->post('name');
            $data['created_on'] = date('Y-m-d');
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['login_id']; //have to check session after implementing login
            $this->Admin_model->insert('tbl_consultant_type', $data);
            $this->session->set_flashdata('success_msg', 'Consultant type Added Successfully');
            redirect('settings/add_consultant_info', 'refresh');

        } else {
            $this->session->set_flashdata('error_msg', 'Consultant type Can Not Be Added');
            redirect('settings/add_consultant_type', 'refresh');
        }
    }

    public function consultancy_type_edit_post()
    {
        $id = $this->input->post('consultant_type_id');
        $check_consultancy_type = $this->Consultant_model->check_consultancy_type($id);
        if ($check_consultancy_type && $_POST) {
            $data['type_name'] = $this->input->post('type_name');
          // echo '<pre>';print_r($data);die();
            $this->Consultant_model->update_function('consultant_type_id', $id, 'tbl_consultant_type', $data);
            $this->session->set_flashdata('success_msg', 'Consultant type Updated Successfully');
            redirect('manage_consultant_type', 'refresh');

        } else {
            $this->session->set_flashdata('error_msg', 'Consultant type Can Not Be Updated');
            redirect('edit_consultant_type/'.$id, 'refresh');
        }
    }

    public function change_consultant_type_status()
    {
        $id = $this->input->post('status_id');
        $get_status = $this->Consultant_model->get_consultant_type_status($id);
        $table_name = 'tbl_consultant_type';
        $columnName = 'consultant_type_id';
        if($get_status[0]->status == 1)
        {
            $data['status'] = 0;
            $this->Consultant_model->change_status($columnName, $id, $table_name, $data);
        }
        if($get_status[0]->status == 0)
        {
            $data['status'] = 1;
            $this->Consultant_model->change_status($columnName, $id, $table_name, $data);
        }
        $this->session->set_flashdata('success_msg', 'Status Updated Successfully');
        redirect('manage_consultant_type', 'refresh');
    }

    public function change_consultant_status()
    {
       // echo 'yes';die();
        $id = $this->input->post('status_id');
        $get_status = $this->Consultant_model->get_consultant_status($id);
        $table_name = 'tbl_consultant_user';
        $columnName = 'consultant_user_id';
        //print_r($id);die();
        if($get_status[0]->status == 1)
        {
            $data['status'] = 0;
            $this->Consultant_model->change_status($columnName, $id, $table_name, $data);
        }
        if($get_status[0]->status == 0)
        {
            $data['status'] = 1;
            $this->Consultant_model->change_status($columnName, $id, $table_name, $data);
        }
        $this->session->set_flashdata('success_msg', 'Consultant Status Updated Successfully');
        redirect('manage_consultant_info', 'refresh');
    }

    public function show_profile($id)
    {
        //echo $id;die();
        $consultant_id = $id;
        date_default_timezone_set('Asia/Dhaka');
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['consultant_info'] = $this->Consultant_model->getWhereConsultant($consultant_id);
        if($data['consultant_info'])
        {
            $served_appointments = $this->Consultant_model->get_served_appointments($consultant_id);
            //$total_rating = $this->Consultant_model->get_total_rating($consultant_id);
            if($served_appointments)
            {
                $total_rating = $this->Consultant_model->get_total_rating($consultant_id);
                if($total_rating)
                {
                    $data['total_rating'] = $total_rating->rating/$served_appointments;
                }
                else{
                    $data['total_rating'] = 0;
                }
            }
            else{
                $data['total_rating'] = 0;
            }
            $data['appointments'] = $this->Consultant_model->consultant_appointment_count($consultant_id);
            $get_financial_info = $this->Consultant_model->get_financial_info($consultant_id);
            if($get_financial_info)
            {
                if($get_financial_info->payment_type == 'Cash')
                {
                    $data['financial_info']['payment_type'] = $get_financial_info->payment_type;
                    $data['financial_info']['fixed_salary_rate'] = $get_financial_info->fixed_session_rate;
                }
                else if($get_financial_info->payment_type == 'Bank')
                {
                    $data['financial_info']['payment_type'] = $get_financial_info->payment_type;
                    $data['financial_info']['fixed_salary_rate'] = $get_financial_info->fixed_session_rate;
                    $data['financial_info']['bank_name'] = $get_financial_info->bank_name;
                    $data['financial_info']['bank_account_number'] = $get_financial_info->bank_account_number;
                }
                else if($get_financial_info->payment_type == 'Mobile')
                {
                    $data['financial_info']['payment_type'] = $get_financial_info->payment_type;
                    $data['financial_info']['fixed_salary_rate'] = $get_financial_info->fixed_session_rate;
                    $data['financial_info']['payment_method_name'] = $get_financial_info->payment_method_name;
                    $data['financial_info']['mobile_payment_number'] = $get_financial_info->mobile_payment_number;
                }
            }
            $total_care_hours = $this->Consultant_model->get_consultant_carehour($consultant_id);
            if($total_care_hours)
            {
                $data['total_hours'] = $total_care_hours->total_care_hours;
            }
            else{
                $data['total_hours'] = 0;
            }
            $get_schedule = $this->Consultant_model->consultant_upcoming_schedule($consultant_id);
            if($get_schedule)
            {
                foreach ($get_schedule as $key=>$row)
                {
                    $data['get_schedule'][$key]['patient_name'] = $row->patient_name;
                    $data['get_schedule'][$key]['patient_id'] = $row->patient_id;
                    $data['get_schedule'][$key]['starting_date'] = $this->home_care_lib->get_date_day_from_millisecond($row->start_time);
                    $data['get_schedule'][$key]['starting_time'] = $this->home_care_lib->millisecond_to_time($row->start_time);
                    $data['get_schedule'][$key]['ending_date'] = $this->home_care_lib->get_date_day_from_millisecond($row->end_time);
                    $data['get_schedule'][$key]['ending_time'] = $this->home_care_lib->millisecond_to_time($row->end_time);
                }
            }
            $data['get_care_history'] = $this->Consultant_model->consultant_care_history($consultant_id);
            //echo '<pre>';print_r($data);die();
            $data['master_body'] = $this->load->view('admin/consultant/show_profile', $data, true);
            $data['active_page'] = 'Manage Consultant Info';
            $this->load->view('admin/master', $data);
        }
        else{
            redirect('error');
        }
    }

    public function fetch_events()
    {
        $get_consultant = $this->input->post('consultant_user_id');
        $get_month = $this->input->post('month_id');
        $get_year = $this->input->post('year_id');
        //print_r($get_month);die();
        $event_result = $this->Consultant_model->get_consultant_wise_events($get_consultant, $get_year, $get_month);
        //echo '<pre>';print_r($event_result);die();
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
                                    <th style=\"background-color: #303641;color: white\">Consultant Name</th>
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
                                            <td><a href='".site_url('consultant/view_profile')."/".$row->consultant_user_id."' title='Go To Profile'>$row->consultant_name</a></td>
                                            <td>$start_time</td>
                                            <td>$clock_in_time</td>
                                            <td>$end_time</td>
                                            <td>$clock_out_time</td>
                                            <td><a href='javascript:void(0)' onclick='setModal(\"$row->patient_name\", \"$row->consultant_name\", \"$row->schedule_date\", \"$row->start_time\", \"$row->end_time\", \"$row->schedule_maker_id\", \"$row->clock_in_time\", \"$row->clock_out_time\")'><button type=\"button\" class=\"btn btn-primary\"><i class=\"entypo-clock\"></i></button></a></td>
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