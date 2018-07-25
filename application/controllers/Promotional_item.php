<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotional_item extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->model('Promotional_item_model');
        if(($this->session->userdata('login_id')!=null) && ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 4))
        {
            $this->load->model('Promotional_item_model');
            $this->load->library('Home_care_lib');
        }
        else
        {
            redirect(base_url().'login');
        }
    }
    //### Promotional Item ####
    
    public function manage_promotional_items()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['promo_items'] = $this->Promotional_item_model->get_all_items();
        $data['master_body'] = $this->load->view('admin/promotional_items/manage_promotional_item', $data, true);
        $data['active_page'] = 'Manage Promotional Items';
        $this->load->view('admin/master', $data);
    }

    public function add_promotional_items()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['categories'] = $this->Promotional_item_model->getAllRecords('tbl_promotional_category');
        $data['master_body'] = $this->load->view('admin/promotional_items/add_promotional_item', $data, true);
        $data['active_page'] = 'New Promotional Items';
        $this->load->view('admin/master', $data);
    }

    public function add_promotional_item_category()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $data['master_body'] = $this->load->view('admin/promotional_items/add_promotional_item_category', $data, true);
        $data['active_page'] = 'Add Promotional Item Category';
        $this->load->view('admin/master', $data);
    }

    public function category_add_post()
    {
        if (isset($_POST)) {
            $data['category_name'] = $this->input->post('category_name');
            $data['created_on'] = date('Y-m-d');
            $this->Promotional_item_model->insert('tbl_promotional_category', $data);
            $this->session->set_flashdata('success_msg', 'Category Added Successfully');
            redirect('promotional_items/add_promotional_items', 'refresh');

        } else {
            $this->session->set_flashdata('error_msg', 'Consultant type Can Not Be Added');
            redirect('promotional_items/add_promotional_item_category', 'refresh');
        }
    }

    public function promotional_item_add_post()
    {
        if (!isset($_POST)) {
            $this->session->set_flashdata('error_msg', 'Item Can Not Be Added');
            redirect('promotional_items/add_promotional_items', 'refresh');
        } else {
            $data['promotional_name'] = $this->input->post('promotional_name');
            $data['item_quantity'] = $this->input->post('item_quantity');
            $data['item_description'] = $this->input->post('item_description');
            $data['item_price'] = $this->input->post('item_price');
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
            $data['status'] = 1;
            $data['tbl_promotional_category_promotional_category_id'] = $this->input->post('tbl_promotional_category_promotional_category_id');
            if ($_FILES['item_picture']['error'] == 4) {
                $chk = $this->Promotional_item_model->insert_ret('tbl_promotional_items', $data);
                if (isset($chk)) {
                    $this->session->set_flashdata('success_msg', 'Item Added Successfully');
                    redirect('promotional_items/manage_promotional_items', 'refresh');
                }
            } else {
                $image_ext = explode('.', $_FILES['item_picture']['name']);
                $extension = end($image_ext);
                if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                    $target_path = 'uploads/promotional_items/promo_item_' . rand(100 * 1000, 5000 * 5000) . '.' . $extension;
                    if (move_uploaded_file($_FILES['item_picture']['tmp_name'], $target_path)) {
                        $data['item_picture'] = $target_path;
                        $insert_id = $this->Promotional_item_model->insert_ret('tbl_promotional_items', $data);
                        if (isset($insert_id)) {
                            $this->session->set_flashdata('success_msg', 'Item Added Successfully');
                            redirect('promotional_items/manage_promotional_items', 'refresh');
                        }
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Data Can Not Be Added. Please Insert Data Correctly.');
                    redirect('promotional_items/add_promotional_items', 'refresh');
                }
            }
        }
    }

    public function edit_promotional_items($id)
    {
        $promotional_item_id = $id;
        $selector = '*';
        $condition = 'promotional_item_id=' . $promotional_item_id;
        $table_name = 'tbl_promotional_items';
        $data = array();
        $data['categories'] = $this->Promotional_item_model->getAllRecords('tbl_promotional_category');
        $data['item'] = $this->Promotional_item_model->getWhere($selector, $condition, $table_name);
        if (sizeof($data['item']) != null) {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['master_body'] = $this->load->view('admin/promotional_items/edit_promotional_item', $data, true);
            $data['active_page'] = 'Manage Promotional Items';
            $this->load->view('admin/master', $data);
        } else {
            $data['top_header'] = $this->load->view('admin/top_header', '', true);
            $data['footer'] = $this->load->view('admin/footer', '', true);
            $data['master_body'] = $this->load->view('admin/error_page', $data, true);
            $data['active_page'] = 'Error';
            $this->load->view('admin/master', $data);
        }
    }

    public function promotional_item_edit_post()
    {
        $id = $this->input->post('id');
        $prev_image = $this->input->post('prev_image');
        if (!isset($_POST)) {
            $this->session->set_flashdata('error_msg', 'Item Can Not Be Added');
            redirect('promotional_items/add_promotional_items', 'refresh');
        } else {
            $data['promotional_name'] = $this->input->post('promotional_name');
            $data['item_quantity'] = $this->input->post('item_quantity');
            $data['item_description'] = $this->input->post('item_description');
            $data['item_price'] = $this->input->post('item_price');
            $data['tbl_admin_user_admin_user_id'] = $_SESSION['user_id'];
            $data['tbl_promotional_category_promotional_category_id'] = $this->input->post('tbl_promotional_category_promotional_category_id');
            if ($_FILES['item_picture']['error'] == 4) {
                $this->Promotional_item_model->update_function('promotional_item_id', $id, 'tbl_promotional_items', $data);
                $this->session->set_flashdata('success_msg', 'Item Added Successfully');
                redirect('promotional_items/manage_promotional_items', 'refresh');
            } else {
                $image_ext = explode('.', $_FILES['item_picture']['name']);
                $extension = end($image_ext);
                if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'PNG') {
                    $target_path = 'uploads/promotional_items/promo_item_' . rand(100 * 1000, 5000 * 5000) . '.' . $extension;
                    unlink('./uploads/promotional_items/' . $prev_image);
                    if (move_uploaded_file($_FILES['item_picture']['tmp_name'], $target_path)) {
                        $data['item_picture'] = $target_path;
                        $this->Promotional_item_model->update_function('promotional_item_id', $id, 'tbl_promotional_items', $data);
                        $this->session->set_flashdata('success_msg', 'Item Updated Successfully');
                        redirect('promotional_items/manage_promotional_items', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Item Can Not Be Updated. Please Insert Data Correctly.');
                    redirect('promotional_items/add_promotional_items', 'refresh');
                }
            }
        }
    }

    public function change_status()
    {
        $id = $this->input->post('status_id');
        $get_status = $this->Promotional_item_model->get_status($id);
        $table_name = 'tbl_promotional_items';
        $columnName = 'promotional_item_id';
        if($get_status[0]->status == 1)
        {
            $data['status'] = 0;
            $this->Promotional_item_model->change_status($columnName, $id, $table_name, $data);
        }
        if($get_status[0]->status == 0)
        {
            $data['status'] = 1;
            $this->Promotional_item_model->change_status($columnName, $id, $table_name, $data);
        }
        $this->session->set_flashdata('success_msg', 'Status Updated Successfully');
        redirect('promotional_items/manage_promotional_items', 'refresh');
    }

    public function delete_promotional_items()
    {
        $id = $this->input->post('id');
        $this->Promotional_item_model->delete_function('tbl_promotional_items', 'promotional_item_id', $id);
        $this->session->set_flashdata('success_msg', 'Item Deleted Successfully');
        redirect('promotional_items/manage_promotional_items', 'refresh');
    }

    //######### Track Promotional Items ###########
    public function track_promotional_items()
    {
        $data = array();
        $data['top_header'] = $this->load->view('admin/top_header', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $r_value = 0;
        $data['promo_item_request'] = $this->Promotional_item_model->get_all_requests($r_value);
        foreach ($data['promo_item_request'] as &$row)
        {
            $row->date = $this->home_care_lib->convert_date_day_format($row->date);
        }
        $r_value = 1;
        $data['promo_item_approved'] = $this->Promotional_item_model->get_all_requests($r_value);
        foreach ($data['promo_item_approved'] as &$row)
        {
            $row->date = $this->home_care_lib->convert_date_day_format($row->date);
        }
        $data['master_body'] = $this->load->view('admin/promotional_items/track_promotional_item', $data, true);
        $data['active_page'] = 'Track Promotional Items';
        $this->load->view('admin/master', $data);
    }
    
    public function manage_items()
    {
        $id = $this->input->post('status_id');
        $item_id = $this->input->post('item_id');
        $check_item = $this->Promotional_item_model->check_item_availability($item_id);
        if($check_item)
        {
            $data1['is_accepted'] = 1;
            $this->Promotional_item_model->change_status('promotional_item_request_id', $id, 'tbl_promotional_item_request', $data1);
            $data2['item_quantity'] = $check_item[0]->item_quantity - 1;
            $this->Promotional_item_model->update_function('promotional_item_id', $item_id, 'tbl_promotional_items', $data2);
            $this->session->set_flashdata('success_msg', 'Item Approved Successfully');
            redirect('promotional_items/track', 'refresh');
        }
        else{
            $this->session->set_flashdata('error_msg', 'Item Currently Not Available! Please Try Again Later!');
            redirect('promotional_items/track', 'refresh');
        }
    }
}