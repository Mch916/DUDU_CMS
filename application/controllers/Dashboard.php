<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('staff_model');
        // $this->load->model("booking_model");
    }

    public function index()
    {
        if(!$this->session->userdata('login')) {
            redirect('users/login');
        }

        $data['title'] = 'Dashboard';
        // $data['staffs'] = $this->staff_model->get_staff();

        $this->load->view('templates/rheader', $data);
        $this->load->view('dashboard',$data);
        $this->load->view('templates/rfooter');

    }
}
