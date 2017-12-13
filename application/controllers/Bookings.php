<?php

class Bookings extends CI_Controller
{

     public function __construct() {
        Parent::__construct();
        $this->load->model("booking_model");
        $this->load->model("work_model");
    }

     public function index()
     {
          $data['staff'] = $this->work_model->get_staff();

          $this->load->view('templates/rheader');
          $this->load->view('booking/index.php', $data);
          $this->load->view('templates/rfooter');
     }

     public function mobile()
     {
       $data['staff'] = $this->work_model->get_staff();

       $this->load->view('templates/rheader');
       $this->load->view('booking/mobile.php', $data);
       $this->load->view('templates/rfooter');
     }

     public function get_events($confirm = 0)
     {
          // Our Start and End Dates
          $start = $this->input->get("start");
          $end = $this->input->get("end");

          $startdt = new DateTime('now'); // setup a local datetime
          $startdt->setTimestamp($start); // Set the date based on timestamp
          $start_format = $startdt->format('Y-m-d H:i:s');

          $enddt = new DateTime('now'); // setup a local datetime
          $enddt->setTimestamp($end); // Set the date based on timestamp
          $end_format = $enddt->format('Y-m-d H:i:s');

          $events = $this->booking_model->get_events($start_format, $end_format, $confirm);

          $data_events = array();

          foreach($events->result() as $r) {

              $data_events[] = array(
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

            echo json_encode(array("events" => $data_events));
            exit();
    }

    public function add_event()
    {
            $title = $this->input->post("title", TRUE);
            $start = $this->input->post("start", TRUE);
            $end = $this->input->post("end", TRUE);
            $noOfPpl = $this->input->post("noOfPpl", TRUE);
            $drinks = $this->input->post("drinks", TRUE);
            $isConfirm = $this->input->post("isConfirm", TRUE);
            $total_amt = $this->input->post("total_amt", TRUE);
            $deposit = $this->input->post("deposit", TRUE);
            $payment = $this->input->post("payment", TRUE);
            $deposit_acc = $this->input->post("depositAcc", TRUE);
            $final_acc = $this->input->post("finalAcc", TRUE);
            $remarks = $this->input->post("remarks", TRUE);

            $sd = DateTime::createFromFormat("Y-m-d H:i", $start);
            $start = $sd->format('Y-m-d H:i:s');
            $start_date_timestamp = $sd->getTimestamp();

            $ed = DateTime::createFromFormat("Y-m-d H:i", $end);
            $end = $ed->format('Y-m-d H:i:s');
            $end_date_timestamp = $ed->getTimestamp();

            if ($payment == 'Deposit') {
                $final_acc = "";
            }

            $this->booking_model->add_event(array(
               "title" => $title,
               "start" => $start,
               "end" => $end,
               "noOfPpl" => $noOfPpl,
               "drinks" => $drinks,
               "isConfirm" => $isConfirm,
               "total_amt" => $total_amt,
               "deposit" => $deposit,
               "payment_status" => $payment,
               "deposit_acc" => $deposit_acc,
               "final_acc" =>$final_acc,
               "remarks" => $remarks
               )
            );

            $this->session->set_flashdata('booking_added', 'New Booking has been added');

            redirect(site_url("bookings"));
    }

    public function edit_event()
     {
          $eventid = intval($this->input->post("eventid"));
          $event = $this->booking_model->get_event($eventid);
          if($event->num_rows() == 0) {
               echo"Invalid Event";
               exit();
          }

          $event->row();

          /* Our calendar data */
          $title = $this->input->post("title", TRUE);
          $start = $this->input->post("start", TRUE);
          $end = $this->input->post("end", TRUE);
          $noOfPpl = $this->input->post("noOfPpl", TRUE);
          $drinks = $this->input->post("drinks", TRUE);
          $isConfirm = $this->input->post("isConfirm", TRUE);
          $total_amt = $this->input->post("total_amt", TRUE);
          $deposit = $this->input->post("deposit", TRUE);
          $payment = $this->input->post("payment", TRUE);
          $deposit_acc = $this->input->post("depositAcc", TRUE);
          $final_acc = $this->input->post("finalAcc", TRUE);
          $remarks = $this->input->post("remarks", TRUE);
          $delete = intval($this->input->post("delete"));

          if(!$delete) {

            $sd = DateTime::createFromFormat("Y-m-d H:i", $start);
            $start = $sd->format('Y-m-d H:i:s');
            $start_date_timestamp = $sd->getTimestamp();

            $ed = DateTime::createFromFormat("Y-m-d H:i", $end);
            $end = $ed->format('Y-m-d H:i:s');
            $end_date_timestamp = $ed->getTimestamp();

            if ($payment == 'Deposit') {
                $final_acc = "";
            }

               $this->booking_model->update_event($eventid,
                    array(
                       "title" => $title,
                       "start" => $start,
                       "end" => $end,
                       "noOfPpl" => $noOfPpl,
                       "drinks" => $drinks,
                       "isConfirm" => $isConfirm,
                       "total_amt" => $total_amt,
                       "deposit" => $deposit,
                       "payment_status" => $payment,
                       "deposit_acc" => $deposit_acc,
                       "final_acc" =>$final_acc,
                       "remarks" => $remarks
                    )
               );

          } else {
               $this->booking_model->delete_event($eventid);
          }

          redirect(site_url("bookings"));
     }

     public function update_by_drag()
     {
          $start = $this->input->get("start");
          $end = $this->input->get("end");
          $id = $this->input->get("bookingID");

          $sd = DateTime::createFromFormat("Y-m-d H:i:s", $start)->format('Y-m-d H:i:s');
          $ed = DateTime::createFromFormat("Y-m-d H:i:s", $end)->format('Y-m-d H:i:s');

          $this->booking_model->update_event($id, array(
                  "start" => $sd,
                  "end" => $ed
                )
          );

     }

     public function get_staff($staffNumber)
     {

     }

}

?>
