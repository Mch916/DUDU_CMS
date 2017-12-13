<?php

class Works extends CI_Controller {
      public function __construct() {
         Parent::__construct();
         $this->load->model("work_model");
     }

      public function index()
      {
          $data['staff'] = $this->work_model->get_staff();

           $this->load->view('templates/rheader');
           $this->load->view('works/index.php', $data);
           $this->load->view('templates/rfooter');
      }

      public function mobile()
      {
          $data['staff'] = $this->work_model->get_staff();

           $this->load->view('templates/rheader');
           $this->load->view('works/mobile.php', $data);
           $this->load->view('templates/rfooter');
      }


      public function get_works() {
            $start = $this->input->get('start');
            $end = $this->input->get('end');

            $startdt = new DateTime('now'); // setup a local datetime
            $startdt->setTimestamp($start); // Set the date based on timestamp
            $start_format = $startdt->format('Y-m-d H:i:s');

            $enddt = new DateTime('now'); // setup a local datetime
            $enddt->setTimestamp($end); // Set the date based on timestamp
            $end_format = $enddt->format('Y-m-d H:i:s');

            $works = $this->work_model->get_works($start_format, $end_format);

            $data_works = array();

            foreach ($works->result() as $work) {
                  $data_works[] = array(
                        'id' => $work->ID,
                        'title' => $work->staff,
                        'start' => $work->start,
                        'end' => $work->end,
                        'staffID' => $work->staffID,
                        'remarks' => $work->workRemark
                  );
            }

            echo json_encode(array("events" => $data_works));
            exit();
      }

      public function add_works()
      {
              $staff = $this->input->post("staff", TRUE);
              $start = $this->input->post("start", TRUE);
              $end = $this->input->post("end", TRUE);
              $remarks = $this->input->post("remarks", TRUE);

              $staffSelect = $this->work_model->get_staff($staff);

              $sd = DateTime::createFromFormat("Y-m-d H:i", $start);
              $start = $sd->format('Y-m-d H:i:s');
              $start_date_timestamp = $sd->getTimestamp();

              $ed = DateTime::createFromFormat("Y-m-d H:i", $end);
              $end = $ed->format('Y-m-d H:i:s');
              $end_date_timestamp = $ed->getTimestamp();

              $this->work_model->add_works(array(
                 "staff" => $staffSelect->staffName,
                 "start" => $start,
                 "end" => $end,
                 "staffID" => $staffSelect->staffID,
                 "workRemark" => $remarks
                 )
              );

              $this->session->set_flashdata('work_added', 'New work has been added');

              redirect(site_url("works"));
      }

      public function edit_work()
       {
            $workRecordID = intval($this->input->post("eventid"));
            $work = $this->work_model->getWorksByID($workRecordID);
            if($work->num_rows() == 0) {
                 echo"Invalid Event";
                 exit();
            }

            $work->row();

            /* Our calendar data */
            $staff = $this->input->post("staff", TRUE);
            $start = $this->input->post("start", TRUE);
            $end = $this->input->post("end", TRUE);
            $remarks = $this->input->post("remarks", TRUE);
            $delete = intval($this->input->post("delete"));

            if(!$delete) {

                  $staffSelect = $this->work_model->get_staff($staff);

                  $sd = DateTime::createFromFormat("Y-m-d H:i", $start);
                  $start = $sd->format('Y-m-d H:i:s');
                  $start_date_timestamp = $sd->getTimestamp();

                  $ed = DateTime::createFromFormat("Y-m-d H:i", $end);
                  $end = $ed->format('Y-m-d H:i:s');
                  $end_date_timestamp = $ed->getTimestamp();

                  $this->work_model->update_works($workRecordID, array(
                     "staff" => $staffSelect->staffName,
                     "start" => $start,
                     "end" => $end,
                     "staffID" => $staffSelect->staffID,
                     "workRemark" => $remarks
                     )
                  );

            } else {
                 $this->work_model->delete_works($workRecordID);
            }

            redirect(site_url("works"));
       }

       public function update_by_drag() {

             $start = $this->input->get("start");
             $end = $this->input->get("end");
             $id = $this->input->get("workID");

             $sd = DateTime::createFromFormat("Y-m-d H:i:s", $start)->format('Y-m-d H:i:s');
             $ed = DateTime::createFromFormat("Y-m-d H:i:s", $end)->format('Y-m-d H:i:s');

             $this->work_model->update_works($id, array(
                     "start" => $sd,
                     "end" => $ed
                   )
             );
       }

}
 ?>
