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

    public function reportData($fromDate, $toDate, $staff)
    {
        $array = array('expense_date >=' => $fromDate, 'expense_date <=' => $toDate);

        if ($staff != 'all') {
            $array['staff_id'] = $staff;
        }

        $this->db->select('*');
        $this->db->from('expense');
        $this->db->join('staff', 'staff_id = staffID');

        $this->db->where($array);

        return $this->db->get();
    }
}

 ?>
