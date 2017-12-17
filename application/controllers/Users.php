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
                redirect('users/login');
            }else {

                $userRow = $haveUser->row();
                if ($password == $userRow->password) {
                    //password correct
                    $userdata = array(
                        'username' => $userName,
                        'userID' => $userRow->user_id,
                        'login' => true
                    );
                    $this->session->set_userdata($userdata);
                    redirect(site_url('dashboard'));

                }else {
                    $this->session->set_flashdata('login_error', 'Password incorrect.');
                    redirect('users/login');
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

    public function create()
    {
        $userName = $this->input->post('usernameCreate');
        $password = md5($this->input->post('passwordCreate'));

        //validation rules
        $this->form_validation->set_rules( 'usernameCreate', 'Username', 'required|is_unique[user.userName]',
        array('is_unique' => 'This username already exist.'));
        $this->form_validation->set_rules( 'passwordCreate', 'Password', 'required');
        $this->form_validation->set_rules( 'passwordConfirm', 'Confirm Password', 'required|matches[passwordCreate]',
        array('matches' => 'Confirm password is not matching with the password entered'));

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/rheader.php');
            $this->load->view('user/create.php');
            $this->load->view('templates/rfooter.php');
        }else {
            $this->user_model->add_user($userName, $password);

            $this->session->set_flashdata('user_created', 'User '.$userName.' created');
            redirect('users/create');
        }
    }

    public function edit()
    {
        $userID = $this->input->post('chooseUser');
        $userName = $this->input->post('usernameEdit');
        $password = md5($this->input->post('passwordEdit'));
        $delete = $this->input->post('delete');

        //validation rules
        $this->form_validation->set_rules( 'usernameEdit', 'Username', 'required|callback_username_duplicate['.$userID.']');

        if ($this->form_validation->run() === false) {

            $data['users'] = $this->user_model->get_users();

            $this->load->view('templates/rheader.php');
            $this->load->view('user/edit.php', $data);
            $this->load->view('templates/rfooter.php');

        }else {

            if(!$delete){
                if ($this->input->post('passwordEdit') == "") {
                    $this->user_model->edit_user($userID, $userName, false);
                }else {
                    $this->user_model->edit_user($userID, $userName, $password);
                }

                $this->session->set_flashdata('user_edited', 'User '.$userName.' edited');
                redirect('users/edit');

            }else {
                $this->user_model->delete_user($userID);

                $this->session->set_flashdata('user_deleted', 'User deleted');
                redirect('users/edit');
            }
        }
    }

    public function username_duplicate($value, $id)
    {
          $users = $this->user_model->get_users();

          foreach ($users as $user) {
              if ($user['user_id'] == $id && $user['userName'] == $value) {
                  return true;
              }elseif ($user['userName'] == $value) {
                  $this->form_validation->set_message('username_duplicate', 'The username already exist.');
                  return false;
              }elseif ($user['userName'] != $value) {
                  return true;
              }
          }
    }

    public function change_pw()
    {
        if ($this->session->userdata('username') == 'admin') {
            $currentPW = $this->input->post('currentPW');
        }else {
            $currentPW = md5($this->input->post('currentPW'));
        }
        $newPW = md5($this->input->post('newPW'));

        $this->form_validation->set_rules('currentPW', 'Current password', 'required');
        $this->form_validation->set_rules('newPW', 'New password', 'required');
        $this->form_validation->set_rules('newPWConfirm', 'Confirm new password', 'required|matches[newPW]');

        if($this->form_validation->run() === false) {
            $this->load->view('templates/rheader.php');
            $this->load->view('user/change_pw.php');
            $this->load->view('templates/rfooter.php');
        }else {
            $UserRow = $this->user_model->get_user($this->session->userdata('username'))->row();
            //check if the current password match
            if ($currentPW == $UserRow->password) {
                $this->user_model->changePW($this->session->userdata('userID'), $newPW);
                $this->session->set_flashdata('changePW', 'Password updated');
                redirect('users/change_pw');
            }else {
                $this->session->set_flashdata('pw_error', 'The current password you entered is not correct');
                redirect('users/change_pw');
            }
        }

    }

}




 ?>
