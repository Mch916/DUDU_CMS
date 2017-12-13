<?php

/**
 *
 */
class Work_model extends CI_model
{

      public function __construct()
      {
        $this->load->database();
      }

      public function get_staff($staffNo = 0) {

            if($staffNo === 0) {
                  $query = $this->db->get('staff');
                  return $query->result_array();
            } else {
                  $query = $this->db->get_where('staff',array('staffID' => $staffNo));
                  return $query->row();
            }

      }

      public function get_works($start, $end) {
            return $this->db->where("start >=", $start)->where("end <=", $end)->get('workrecord');
      }

      public function add_works($data) {
            $this->db->insert('workrecord',$data);
      }

      public function getWorksByID($id) {
            return $this->db->where("ID", $id)->get('workrecord');
      }

      public function update_works($id, $data) {
            $this->db->where("ID", $id)->update('workrecord',$data);
      }

      public function delete_works($id) {
            $this->db->where('ID',$id)->delete('workrecord');
      }
}

 ?>
