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
          $this->load->view('report.php',$data);
          $this->load->view('templates/rfooter');
    }

    public function load_report_data()
    {
        $fromDate = $this->input->post('from');
        $toDate = $this->input->post('to');
        $payment = $this->input->post('payment');
        $confirm = $this->input->post('confirm');
        $depositAcc = $this->input->post('depositacc');
        $finalAcc = $this->input->post('finalacc');

        $booking_record = $this->booking_model->reportData($fromDate, $toDate, $payment, $confirm, $depositAcc, $finalAcc)->result();

        $data = array();

        foreach($booking_record as $r) {

            $data[] = array(
                "id" => $r->ID,
                "title" => $r->title,
                "end" => $r->end,
                "start" => $r->start,
                "people" => $r->noOfPpl,
                "drinks" => $r->drinks,
                "isConfirm" => $r->isConfirm,
                "total_amt" => $r->total_amt,
                "deposit" => $r->deposit,
                "payment_status" => $r->payment_status,
                "deposit_acc" => $r->deposit_acc,
                "final_acc" =>$r->final_acc,
                "remarks" => $r->remarks
            );
          }

          echo json_encode(array("data" => $data));
    }

}

?>
