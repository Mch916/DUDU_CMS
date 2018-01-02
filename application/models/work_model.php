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

      public function where_array($start, $end, $staff)
      {
          $array = array('start >=' => $start, 'end <=' => $end);

          if ($staff != 'all') {
              $array['staffID'] = $staff;
          }

          return $array;
      }

      public function all_work_count($fromDate,$toDate,$staff)
      {
          $array = $this->where_array($fromDate,$toDate,$staff);

          $query = $this
                  ->db
                  ->where($array)
                  ->get('workrecord');

          return $query->num_rows();
      }

      public function all_work($limit,$start,$col,$dir,$fromDate,$toDate,$staff)
      {
          $array = $this->where_array($fromDate,$toDate,$staff);

          $query = $this
                  ->db
                  ->where($array)
                  ->order_by($col,$dir)
                  ->get('workrecord');

          if($query->num_rows()>0)
          {
              return $query->result();
          }
          else
          {
              return null;
          }

      }

      public function work_search($limit,$start,$search,$col,$dir,$fromDate,$toDate,$staff)
      {
          $array = $this->where_array($fromDate,$toDate,$staff);

          $query = $this
                  ->db
                  ->where($array)
                  ->group_start()
                  ->where('start LIKE', '%'.$search.'%')
                  ->or_where('end LIKE', '%'.$search.'%')
                  ->or_where('workRemark LIKE', '%'.$search.'%')
                  ->or_where('staff LIKE', '%'.$search.'%')
                  ->group_end()
                  ->order_by($col,$dir)
                  ->get('workrecord');


          if($query->num_rows()>0)
          {
              return $query->result();
          }
          else
          {
              return null;
          }
      }

      public function work_search_count($search,$fromDate,$toDate,$staff)
      {
          $array = $this->where_array($fromDate,$toDate,$staff);

          $query = $this
                  ->db
                  ->where($array)
                  ->group_start()
                  ->where('start LIKE', '%'.$search.'%')
                  ->or_where('end LIKE', '%'.$search.'%')
                  ->or_where('workRemark LIKE', '%'.$search.'%')
                  ->or_where('staff LIKE', '%'.$search.'%')
                  ->group_end()
                  ->get('workrecord');

          return $query->num_rows();
      }
}

 ?>
