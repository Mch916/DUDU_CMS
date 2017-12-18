<?php
/**
 *
 */
class Expense extends CI_Controller
{

    public function __construct()
    {
        Parent::__construct();
    }

    public function index()
    {
        $this->load->view('templates/rheader');
        $this->load->view('expense.php');
        $this->load->view('templates/rfooter');
    }

}

 ?>
