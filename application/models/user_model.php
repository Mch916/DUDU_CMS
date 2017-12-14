<?php
/**
 *
 */
class User_model extends CI_Model
{

  public function __construct()
  {
      $this->load->database();
  }

  public function get_user($username)
  {
      return $this->db->get_where('user', array('userName' => $username));
  }
  
}


 ?>
