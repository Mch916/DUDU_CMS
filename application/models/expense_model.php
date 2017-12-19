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
        $query = $this->db->where('expense_date >=', $fromDate)->where('expense_date <=', $toDate)->get('expense');
        return $query->result_array();
    }
}

 ?>
