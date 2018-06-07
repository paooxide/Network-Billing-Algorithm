<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('application/libraries/REST_Controller.php');

class Oauth extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    /*
    Get user details
    */
    public function index_get()
    {
        if (!$this->ion_auth->logged_in()) {
            $data['success'] = false;
            $data['message'] = 'User is not logged in';
            $data['data'] = null;
            $data['extra'] = null;
            $this->response($data);
        } else {
            $user = $this->ion_auth->user()->row();
            $data['success'] = true;
            $data['message'] = 'login success';
            $data['data'] = array('groups'=>$this->ion_auth->get_users_groups($user->id)->row(),
            'user' => $user
              );
            $data['extra'] = null;
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /*
    login function
    */
    public function index_post()
    {
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean);
        $email = $request->email;
        $password = $request->password;
        $remember = true;
        if ($this->ion_auth->login($email, $password, $remember)) {
            $user = $this->ion_auth->user()->row();
            $data['success'] = true;
            $data['message'] = 'login is successful';
            $data['data'] = array('groups'=>$this->ion_auth->get_users_groups($user->id)->row(),
            'user' => $user
              );
            $data['extra'] = null;
            $this->response($data);
        } else {
            $data['message'] = 'Enter a valid email and password';
            $data['success'] = false;
            $data['data'] = null;
            $data['extra'] = null;
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }
    /*
    Log out function
    */
    public function index_delete()
    {
        $logout = $this->ion_auth->logout();
        $data['success'] = true;
        $data['message'] = 'logged out successfully';
        $data['data'] = null;
        $data['extra'] = null;
        $this->response($data);
    }

    /*
      Update pasword function
    */
    public function index_update()
    {
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean);
        $old = $request->old;
        $new = $request->new;
        $new_confirm = $request->new_confirm;

        if (!$this->ion_auth->logged_in()) {
            $data['success'] = false;
            $data['message'] = 'User is not logged in';
            $data['data'] = null;
            $data['extra'] = null;
            $this->response($data);
        }

        $user = $this->ion_auth->user()->row();

        if ($new !== $new_confirm) {
            // display the form
            // set the flash data error message if there is one
            $data['success'] = false;
            $data['message'] = 'Your new password does not match';
            $data['data'] = null;
            $data['extra'] = null;
            $this->response($data);
        } else {
            $identity = $this->session->userdata('identity');
            $change = $this->ion_auth->change_password($identity, $old, $new);

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $data['message'] = 'Password change is successful';
                $data['success'] = true;
                $data['data'] = null;
                $data['extra'] = null;
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $data['message'] = 'Password change is not successful';
                $data['success'] = false;
                $data['data'] = null;
                $data['extra'] = null;
            }
        }
    }
}
