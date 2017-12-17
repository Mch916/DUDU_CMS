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

  public function get_users()
  {
      return $this->db->where('user_id !=', 1)->get('user')->result_array();
  }

  public function get_user($username)
  {
      return $this->db->get_where('user', array('userName' => $username));
  }

  public function add_user($username, $password)
  {
      $userDate = array('userName' => $username, 'password' => $password);
      $this->db->insert('user', $userDate);
  }

  public function edit_user($userID, $userName, $password)
  {
      if($password) {
          $data = array('userName' => $userName, 'password' => $password );
          $this->db->where('user_id', $userID)->update('user', $data);
      }else {
          $data = array('userName' => $userName);
          $this->db->where('user_id', $userID)->update('user', $data);
      }
  }

  public function delete_user($userID)
  {
      $this->db->where('user_id', $userID)->delete('user');
  }

  public function changePW($userID, $password)
  {
      $this->db->where('user_id', $userID)->update('user', array('password' => $password));
  }
}


 ?>
