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

        $columns = array(
                            0 =>'title',
                            1 =>'start',
                            2 => 'end',
                            3 => 'people',
                            4 =>'drinks',
                            5 => 'isConfirm',
                            6 => 'payment_status',
                            7 => 'deposit_acc',
                            8 => 'final_acc',
                            9 => 'remarks',
                            10 => 'deposit',
                            11 => 'total_amt'
                        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->booking_model->all_booking_count($fromDate, $toDate,
        $payment, $confirm, $depositAcc, $finalAcc);

        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $bookings = $this->booking_model->all_booking( $limit, $start, $order,
            $dir, $fromDate, $toDate, $payment, $confirm, $depositAcc, $finalAcc);
        }
        else {
            $search = $this->input->post('search')['value'];

            $bookings =  $this->booking_model->booking_search( $limit, $start, $search,
            $order, $dir, $fromDate, $toDate, $payment, $confirm, $depositAcc, $finalAcc);

            $totalFiltered = $this->booking_model->booking_search_count($search, $fromDate,
            $toDate, $payment, $confirm, $depositAcc, $finalAcc);
        }

        $data = array();
        if(!empty($bookings))
        {
            foreach ($bookings as $booking)
            {
                  $data[] = array(
                      "id" => $booking->ID,
                      "title" => $booking->title,
                      "end" => $booking->end,
                      "start" => $booking->start,
                      "people" => $booking->noOfPpl,
                      "drinks" => $booking->drinks,
                      "isConfirm" => $booking->isConfirm,
                      "total_amt" => $booking->total_amt,
                      "deposit" => $booking->deposit,
                      "payment_status" => $booking->payment_status,
                      "deposit_acc" => $booking->deposit_acc,
                      "final_acc" =>$booking->final_acc,
                      "remarks" => $booking->remarks
                  );
             }
         }

         $json_data = array(
                      "draw"            => intval($this->input->post('draw')),
                      "recordsTotal"    => intval($totalData),
                      "recordsFiltered" => intval($totalFiltered),
                      "data"            => $data
                      );

         echo json_encode($json_data);

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

        $columns = array(
                              0 =>'start',
                              1 =>'end',
                              2=> 'staff',
                              3=> 'workRemark',
                              4=> 'pay'
                          );

  		$limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$_POST['order'][0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->work_model->all_work_count($fromDate, $toDate, $staff);

        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $works = $this->work_model->all_work($limit, $start, $order, $dir,
            $fromDate, $toDate, $staff);
        }
        else {
            $search = $this->input->post('search')['value'];

            $works =  $this->work_model->work_search($limit, $start, $search,
            $order, $dir, $fromDate, $toDate, $staff);

            $totalFiltered = $this->work_model->work_search_count($search,$fromDate,
            $toDate, $staff);
          }

          $data = array();
          if(!empty($works))
          {
              foreach ($works as $work)
              {

                  $nestedData['start'] = $work->start;
                  $nestedData['end'] = $work->end;
                  $nestedData['staff'] = $work->staff;
                  $nestedData['workRemark'] = $work->workRemark;
                  $nestedData['pay'] = $work->pay;

                  $data[] = $nestedData;

              }
          }

          $json_data = array(
                      "draw"            => intval($this->input->post('draw')),
                      "recordsTotal"    => intval($totalData),
                      "recordsFiltered" => intval($totalFiltered),
                      "data"            => $data
                      );

          echo json_encode($json_data);

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

        $columns = array(
                            0 =>'expense_date',
                            1 =>'staffName',
                            2=> 'expense_item',
                            3=> 'expense_amt'
                        );

		$limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$_POST['order'][0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->expense_model->all_expense_count($fromDate, $toDate, $staff);

        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $expenses = $this->expense_model->all_expense($limit, $start, $order, $dir,
            $fromDate, $toDate, $staff);
        }
        else {
            $search = $this->input->post('search')['value'];

            $expenses =  $this->expense_model->expense_search($limit, $start, $search,
            $order, $dir, $fromDate, $toDate, $staff);

            $totalFiltered = $this->expense_model->expense_search_count($search,$fromDate,
            $toDate, $staff);
        }

        $data = array();
        if(!empty($expenses))
        {
            foreach ($expenses as $expense)
            {

                $nestedData['expense_date'] = $expense->expense_date;
                $nestedData['staff'] = $expense->staffName;
                $nestedData['expense_item'] = $expense->expense_item;
                $nestedData['expense_amt'] = $expense->expense_amt;

                $data[] = $nestedData;

            }
        }

        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);




    }


}

?>
