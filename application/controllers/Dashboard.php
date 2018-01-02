<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('expense_model');
        $this->load->model("booking_model");
    }

    public function index()
    {
        if(!$this->session->userdata('login')) {
            redirect('users/login');
        }

        $data['title'] = 'Dashboard';
        $data['month_income'] = $this->booking_model->monthIncome();
        $data['month_expense'] = $this->expense_model->monthExpense();
        $data['Todayfinal'] = $this->booking_model->finalPaymentToday();

        $this->load->view('templates/rheader', $data);
        $this->load->view('dashboard',$data);
        $this->load->view('templates/rfooter');

    }

}
