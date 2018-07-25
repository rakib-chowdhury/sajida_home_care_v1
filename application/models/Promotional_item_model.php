<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promotional_item_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    // for Promotional Item Controller
    public function get_all_items()
    {
        $this->db->select('*');
        $this->db->from('tbl_promotional_items');
        $this->db->join('tbl_promotional_category', 'tbl_promotional_category.promotional_category_id = tbl_promotional_items.tbl_promotional_category_promotional_category_id', 'left');
        $result = $this->db->get();
        return $result->result();
    }
    public function getAllRecords($tableName)
    {
        $this->db->select('*');
        $result = $this->db->get($tableName);
        return $result->result_array();
    }
    public function insert($tablename, $tabledata)
    {
        $this->db->insert($tablename, $tabledata);
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
        $this->db->join('tbl_promotional_category', 'tbl_promotional_category.promotional_category_id = tbl_promotional_items.tbl_promotional_category_promotional_category_id', 'left');
        $this->db->where($condition);
        $result = $this->db->get();
        return $result->row_array();
    }
    public function update_function($columnName, $columnVal, $tableName, $data)
    {
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName, $data);
    }
    public function get_status($id)
    {
        $this->db->select('status');
        $this->db->from('tbl_promotional_items');
        $this->db->where('promotional_item_id', $id);
        $result = $this->db->get();
        return $result->result();
    }
    public function change_status($columnName, $id, $table_name, $data)
    {
        // echo $data;die();
        $this->db->where($columnName, $id);
        $this->db->update($table_name, $data);
    }
    public function delete_function($tableName, $columnName, $columnVal)
    {
        $this->db->where($columnName, $columnVal);
        $this->db->delete($tableName);
    }
    public function get_all_requests($val)
    {
        $this->db->select('*');
        $this->db->from('tbl_promotional_item_request');
        $this->db->join('tbl_promotional_items', 'tbl_promotional_item_request.tbl_promotional_items_pomotional_item_id = tbl_promotional_items.promotional_item_id', 'left');
        $this->db->join('tbl_admin_user', 'tbl_promotional_item_request.tbl_admin_user_admin_user_id = tbl_admin_user.admin_user_id', 'left');
        $this->db->join('tbl_patient_user', 'tbl_promotional_item_request.tbl_patient_user_patient_id = tbl_patient_user.patient_id', 'left');
        $this->db->where('is_accepted', $val);
        $result = $this->db->get();
        return $result->result();
    }

    public function check_item_availability($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_promotional_items');
        $this->db->where('promotional_item_id', $id);
        $this->db->where('item_quantity >', 0);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result();
    }
}

?>