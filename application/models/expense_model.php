<?php
/**
 *
 */
class Expense_model extends CI_Model
{

    public function __construct()
    {
      $this->load->database();
    }

    public function get_expenses($fromDate, $toDate)
    {
        $query = $this->db->select('*')->from('expense')->join('staff', 'staff.staffID = expense.staff_id')->
        where('expense_date >=', $fromDate)->where('expense_date <=', $toDate)->get();
        return $query->result_array();
    }

    public function add_expense($data)
    {
        $this->db->insert('expense', $data);
    }

    public function get_expense_by_id($id)
    {
        $query = $this->db->where('id', $id)->get('expense');
        return $query->row_array();
    }

    public function edit_expense($id, $data)
    {
        $this->db->where('id', $id)->update('expense', $data);
    }
}

 ?>
