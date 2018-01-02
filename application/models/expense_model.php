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

    public function monthExpense()
    {
      $first_date = new DateTime('first day of this month');
      $first_date = $first_date->format('Y-m-d');

      $last_date = new DateTime('last day of this month');
      $last_date = $last_date->format('Y-m-d');

      $query = $this->db->select_sum('expense_amt')->where('expense_date >=',$first_date)
      ->where('expense_date <=',$last_date)->get('expense');

      return $query->row_array();
    }

    public function all_expense_count($fromDate,$toDate,$staff)
    {
        $array = array('expense_date >=' => $fromDate, 'expense_date <=' => $toDate);

        if ($staff != 'all') {
            $array['staff_id'] = $staff;
        }

        $query = $this
                ->db
                ->join('staff', 'staff_id = staffID')
                ->where($array)
                ->get('expense');


        return $query->num_rows();
    }

    public function all_expense($limit,$start,$col,$dir,$fromDate,$toDate,$staff)
    {
        $array = array('expense_date >=' => $fromDate, 'expense_date <=' => $toDate);

        if ($staff != 'all') {
            $array['staff_id'] = $staff;
        }

       $query = $this
                ->db
                ->join('staff', 'staff_id = staffID')
                ->where($array)
                // ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('expense');

        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }

    }

    public function expense_search($limit,$start,$search,$col,$dir,$fromDate,$toDate,$staff)
    {
        $array = array('expense_date >=' => $fromDate, 'expense_date <=' => $toDate);

        if ($staff != 'all') {
            $array['staff_id'] = $staff;
        }

        $query = $this
                ->db
                ->join('staff', 'staff_id = staffID')
                ->where($array)
                ->group_start()
                ->where('expense_date LIKE', '%'.$search.'%')
                ->or_where('staffName LIKE', '%'.$search.'%')
                ->or_where('expense_item LIKE', '%'.$search.'%')
                ->or_where('expense_amt LIKE', '%'.$search.'%')
                ->group_end()
                // ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('expense');


        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function expense_search_count($search,$fromDate,$toDate,$staff)
    {
        $array = array('expense_date >=' => $fromDate, 'expense_date <=' => $toDate);

        if ($staff != 'all') {
            $array['staff_id'] = $staff;
        }

        $query = $this
                ->db
                ->join('staff', 'staff_id = staffID')
                ->where($array)
                ->group_start()
                ->where('expense_date LIKE', '%'.$search.'%')
                ->or_where('staffName LIKE', '%'.$search.'%')
                ->or_where('expense_item LIKE', '%'.$search.'%')
                ->or_where('expense_amt LIKE', '%'.$search.'%')
                ->group_end()
                ->get('expense');

        return $query->num_rows();
    }
}

 ?>
