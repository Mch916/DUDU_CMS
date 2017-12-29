<?php

class Report extends CI_Controller
{

    public function __construct()
    {
        Parent::__construct();
        $this->load->model("booking_model");
        $this->load->model("work_model");
        $this->load->model("expense_model");
    }

    public function booking()
    {
          if(!$this->session->userdata('login')) {
              redirect('users/login');
          }

          $data['staff'] = $this->work_model->get_staff();

          $this->load->view('templates/rheader');
          $this->load->view('reports/booking_report',$data);
          $this->load->view('templates/rfooter');
    }

    public function load_booking_report_data()
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

    public function working()
    {
        if(!$this->session->userdata('login')) {
            redirect('users/login');
        }

        $data['staff'] = $this->work_model->get_staff();

        $this->load->view('templates/rheader');
        $this->load->view('reports/working_report',$data);
        $this->load->view('templates/rfooter');
    }

    public function load_working_report_data()
    {
        $fromDate = $this->input->post('from');
        $toDate = $this->input->post('to');
        $staff = $this->input->post('staff');

        $working_record = $this->work_model->reportData($fromDate, $toDate, $staff)->result();

        $data = array();

        foreach($working_record as $r) {

            $data[] = array(
                "end" => $r->end,
                "start" => $r->start,
                "staff" => $r->staff,
                "workRemark" => $r->workRemark,
                "pay" => $r->pay,
            );
          }

          echo json_encode(array("data" => $data));
    }

    public function expense()
    {
        if(!$this->session->userdata('login')) {
            redirect('users/login');
        }

        $data['staff'] = $this->work_model->get_staff();

        $this->load->view('templates/rheader');
        $this->load->view('reports/expense_report',$data);
        $this->load->view('templates/rfooter');
    }

    public function load_expense_report_data()
    {
        $fromDate = $this->input->post('from');
        $toDate = $this->input->post('to');
        $staff = $this->input->post('staff');

        $record = $this->expense_model->reportData($fromDate, $toDate, $staff)->result();

        $data = array();

        foreach($record as $r) {

            $data[] = array(
                "expense_date" => $r->expense_date,
                "staff" => $r->staffName,
                "expense_item" => $r->expense_item,
                "expense_amt" => $r->expense_amt
            );
          }

          echo json_encode(array("data" => $data));
    }

}

?>
