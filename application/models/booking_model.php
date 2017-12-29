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

      public function reportData($start, $end, $payment, $confirm, $depositAcc, $finalAcc)
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

          $this->db->where($array);
          return $this->db->get('booking');
      }
}

?>
