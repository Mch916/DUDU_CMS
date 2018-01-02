<?php

class Booking_Model extends CI_Model
{
      public function __construct()
      {
        $this->load->database();
      }

      public function get_events($start, $end, $isConfirm = null)
      {
          $this->db->where("start >=", $start)->where("end <=", $end);
          if ($isConfirm !== null)
          {
              $this->db->where("isConfirm", $isConfirm);
          }
          return $this->db->get("booking");
      }

      public function add_event($data)
      {
        $this->db->insert("booking", $data);
      }

      public function get_event($id)
      {
        return $this->db->where("ID", $id)->get("booking");
      }

      public function update_event($id, $data)
      {
        $this->db->where("ID", $id)->update("booking", $data);
      }

      public function delete_event($id)
      {
        $this->db->where("ID", $id)->delete("booking");
      }

      public function monthIncome()
      {
          $first_date = new DateTime('first day of this month');
          $first_date = $first_date->format('Y-m-d');

          $last_date = new DateTime('last day of this month');
          $last_date = $last_date->format('Y-m-d');

          $query = $this->db->select_sum('total_amt')->where('start >=',$first_date)
          ->where('start <=',$last_date)->where('isConfirm', 1)->get('booking');

          return $query->row_array();
      }

      public function finalPaymentToday()
      {
          $today = new DateTime();
          $endoftoday = new DateTime();

          $endoftoday->add(new DateInterval('P1D'));
          $today = $today->format('Y-m-d');
          $endoftoday = $endoftoday->format('Y-m-d');

          $query = $this->db->select('title, total_amt, deposit')->where('start >=',$today)
          ->where('start <',$endoftoday)->where('isConfirm', 1)->get('booking');

          $results = $query->result_array();

          $finalResult = array();

          $row = array();

          foreach ($results as $result) {
              $row['customerName'] = preg_replace('/[0-9]/','', $result['title']);
              $row['finalPayment'] = (int)$result['total_amt'] - (int)$result['deposit'];

              $finalResult[] = $row;
          }

          return $finalResult;
      }

      public function where_array($start, $end, $payment, $confirm, $depositAcc, $finalAcc)
      {
          $array = array('start >=' => $start, 'end <=' => $end);

          if ($payment != 'all') {
              $array['payment_status'] = $payment;
          }

          if ($confirm != 'all') {
              $array['isConfirm'] = $confirm;
          }

          if ($depositAcc != 'all') {
              $array['deposit_acc'] = $depositAcc;
          }

          if ($finalAcc != 'all') {
              $array['final_acc'] = $finalAcc;
          }

          return $array;
      }

      public function all_booking_count($start, $end, $payment, $confirm, $depositAcc, $finalAcc)
      {
          $array = $this->where_array($start, $end, $payment, $confirm, $depositAcc, $finalAcc);

          $query = $this->db->where($array)->get('booking');

          return $query->num_rows();
      }

      public function all_booking($limit, $start, $order, $dir, $fromDate, $toDate,
      $payment, $confirm, $depositAcc, $finalAcc)
      {
          $array = $this->where_array($fromDate, $toDate, $payment, $confirm, $depositAcc, $finalAcc);

          $query = $this->db->where($array)->order_by($order, $dir)->get('booking');

           if($query->num_rows()>0)
           {
               return $query->result();
           }
           else
           {
               return null;
           }
      }

      public function booking_search( $limit, $start, $search, $order, $dir, $fromDate,
      $toDate, $payment, $confirm, $depositAcc, $finalAcc)
      {
          $array = $this->where_array($fromDate, $toDate, $payment, $confirm, $depositAcc, $finalAcc);

          $query = $this
                  ->db
                  ->where($array)
                  ->group_start()
                  ->where('title LIKE', '%'.$search.'%')
                  ->or_where('start LIKE', '%'.$search.'%')
                  ->or_where('end LIKE', '%'.$search.'%')
                  ->or_where('remarks LIKE', '%'.$search.'%')
                  ->or_where('payment_status LIKE', '%'.$search.'%')
                  ->group_end()
                  ->order_by($order, $dir)
                  ->get('booking');


          if($query->num_rows()>0)
          {
              return $query->result();
          }
          else
          {
              return null;
          }
      }

      public function booking_search_count($search, $fromDate, $toDate, $payment,
      $confirm, $depositAcc, $finalAcc)
      {
          $array = $this->where_array($fromDate, $toDate, $payment, $confirm, $depositAcc, $finalAcc);

          $query = $this
                  ->db
                  ->where($array)
                  ->group_start()
                  ->where('title LIKE', '%'.$search.'%')
                  ->or_where('start LIKE', '%'.$search.'%')
                  ->or_where('end LIKE', '%'.$search.'%')
                  ->or_where('remarks LIKE', '%'.$search.'%')
                  ->or_where('payment_status LIKE', '%'.$search.'%')
                  ->group_end()
                  ->get('booking');

        return $query->num_rows();
      }
}

?>
