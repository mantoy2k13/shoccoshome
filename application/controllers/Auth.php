<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    // construct call
    public function __construct(){
        parent::__construct();
    }
    
    public function register_user(){
        $user=array(
            'email'=>$this->input->post('email'),
            'password'=>md5($this->input->post('password'))
        );
        
        $email_check=$this->Auth_model->email_check($user['email']);
        if($email_check){
             $this->Auth_model->register_user($user);
             $this->session->set_flashdata('email_update_success_msg', 'Please login now!');
             redirect('home/login');
        }else{
             $this->session->set_flashdata('error_msg', 'Email already taken.');
             redirect('home/register');
        }

    }

    public function user_login(){
        if($this->input->post()){
			$email 	  = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$check_user = $this->Auth_model->check_user_if_exist($email, $password);
			if($check_user){
                if(isset($_SESSION['is_in_book'])){
                    unset($_SESSION['is_in_book']);
                    redirect('booking/booking_as_host');
                } else{
                    redirect('home/homepage');
                }
				
			} else{ 
                $this->session->set_flashdata('error_msg', 'Incorrect email address or password.');
                redirect('home/login');
            }
		}else{
			redirect('home/login');
		}
    }

    public function user_logout(){
        $this->session->sess_destroy();
		redirect(base_url());
    }
} 