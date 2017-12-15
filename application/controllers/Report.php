<?php

class Report extends CI_Controller
{

    public function __construct()
    {
        Parent::__construct();
        $this->load->model("booking_model");
        $this->load->model("work_model");
    }

    public function index()
    {
          if(!$this->session->userdata('login')) {
              redirect('users/login');
          }

          $data['staff'] = $this->work_model->get_staff();

          $this->load->view('templates/rheader');
          $this->load->view('booking/index.php', $data);
          $this->load->view('templates/rfooter');
    }


}

?>
