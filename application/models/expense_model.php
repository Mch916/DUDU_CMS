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
}

 ?>
