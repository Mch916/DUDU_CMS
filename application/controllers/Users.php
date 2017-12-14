<?php
/**
 *
 */
class Users extends CI_Controller
{

    function __construct()
    {
        Parent::__construct();
        $this->load->model('user_model');
    }

    
}




 ?>
