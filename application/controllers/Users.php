<?php
/**
 *
 */
class Users extends CI_Controller
{

    public function __construct()
    {
        Parent::__construct();
        $this->load->model('user_model');
    }

    public function login()
    {
        if($this->session->userdata('login') === true) {
            redirect('dashboard');
        }

        $userName = $this->input->post('user_name');
        if ($userName == 'admin') {
            $password = $this->input->post('password');
        }else {
            $password = md5($this->input->post('password'));
        }

        //validation rules
        $this->form_validation->set_rules( 'user_name', 'User Name', 'required');
        $this->form_validation->set_rules( 'password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/rheader.php');
            $this->load->view('user/login.php');
            $this->load->view('templates/rfooter.php');
        }else {
            //check if this user exist
            $haveUser = $this->user_model->get_user($userName);
            if ($haveUser->num_rows() == 0) {
                //if user not exist, return error
                $this->session->set_flashdata('login_error', 'User does not exist.');
                $this->load->view('templates/rheader.php');
                $this->load->view('user/login.php');
                $this->load->view('templates/rfooter.php');
            }else {

                $userRow = $haveUser->row();
                if ($password == $userRow->password) {
                    //password correct
                    $userdata = array(
                        'username' => $userName,
                        'login' => true
                    );
                    $this->session->set_userdata($userdata);
                    redirect(site_url('dashboard'));

                }else {
                    $this->session->set_flashdata('login_error', 'Password incorrect.');
                    $this->load->view('templates/rheader.php');
                    $this->load->view('user/login.php');
                    $this->load->view('templates/rfooter.php');
                }
            }
        }
    }

    public function logout()
    {
      $userdata = array('username', 'login');
      $this->session->unset_userdata($userdata);

      redirect(site_url('users/login'));
    }
}




 ?>