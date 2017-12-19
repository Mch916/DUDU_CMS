<?php
/**
 *
 */
class Expenses extends CI_Controller
{

    public function __construct()
    {
        Parent::__construct();
        $this->load->model('expense_model');
    }

    public function index()
    {
        $this->load->view('templates/rheader');
        $this->load->view('expense.php');
        $this->load->view('templates/rfooter');
    }

    public function get_expenses()
    {
        $fromDate = $this->input->get('from');
        $toDate = $this->input->get('to');

        // $fromDate = DateTime::createFromFormat('Y-m-d', $fromDate);
        // $fromDate_format = $fromDate->format('Y-m-d');
        //
        // $toDate = DateTime::createFromFormat('Y-m-d', $toDate);
        // $toDate_format = $toDate->format('Y-m-d');

        $expense = $this->expense_model->get_expenses($fromDate, $toDate);

        echo json_encode($expense);

    }
}

 ?>
