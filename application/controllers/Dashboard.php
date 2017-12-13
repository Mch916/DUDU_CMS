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
        $data['title'] = 'Dashboard';
        // $data['staffs'] = $this->staff_model->get_staff();

        $this->load->view('templates/rheader', $data);
        $this->load->view('main/dashboard',$data);
        $this->load->view('templates/rfooter');

    }
}
