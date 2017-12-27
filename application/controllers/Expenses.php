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
        $this->load->model('work_model');
    }

    public function index()
    {
        if(!$this->session->userdata('login')) {
            redirect('users/login');
        }
        
        $data['staff'] = $this->work_model->get_staff();

        $this->load->view('templates/rheader');
        $this->load->view('expense.php', $data);
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

    public function add_expense()
    {
        $expense_date = $this->input->post('expenseDate');
        $staff_id = $this->input->post('staff');
        $expense_item = $this->input->post('expenseItem');
        $expense_amt = $this->input->post('expenseAmt');

        $data = array('expense_date' => $expense_date, 'staff_id' => $staff_id, 'expense_item' => $expense_item,
                    'expense_amt' => $expense_amt);

        $this->expense_model->add_expense($data);

        $this->session->set_flashdata('expense_added', 'New expense has been added');

        redirect(site_url('expenses'));
    }

    public function get_expense()
    {
        $expense_id = $this->input->get('expenseID');

        $expenseInfo = $this->expense_model->get_expense_by_id($expense_id);

        echo json_encode($expenseInfo);
    }

    public function edit_expense()
    {
        $expense_date = $this->input->post('expenseDateEdit');
        $staff_id = $this->input->post('staffEdit');
        $expense_item = $this->input->post('expenseItemEdit');
        $expense_amt = $this->input->post('expenseAmtEdit');
        $expense_id = $this->input->post('expense_id');

        $data = array('expense_date' => $expense_date, 'staff_id' => $staff_id, 'expense_item' => $expense_item,
                    'expense_amt' => $expense_amt);

        $this->expense_model->edit_expense($expense_id, $data);

        redirect(site_url('expenses'));
    }
}

 ?>
