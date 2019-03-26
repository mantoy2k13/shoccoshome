<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function bio()
	{
        if ($this->session->userdata('user_email')){ 
            $user_email  = $this->session->userdata('user_email');
            $uid  = $this->session->userdata('user_id');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'bio';
            $data['view_bio'] = $this->Account_model->view_bio($uid);
            $data['my_pets']  = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
            $this->load->view('account/bio', $data);
        }
		else { redirect('home/login'); }
    }

    public function account_update(){
        if ($this->session->userdata('user_email'))
		{
            if($this->input->post()){   
                $old_email = $this->session->userdata('user_email');
                $new_email = $this->input->post('email');
                if($old_email != $new_email){
                    $check_email = $this->Account_model->check_email($new_email);
                    if($check_email){
                        $this->session->set_flashdata('prof_msg', 'Exist');
                        redirect('account/account');
                    } else{
                        $res = $this->Account_model->update_profile_info($new_email);
                        if($res){
                            if($this->input->post('prof_img_data')){
                                $res = $this->Account_model->update_profile_pic();
                                if($res){
                                    $this->session->set_flashdata('prof_msg', 'Updated');
                                    redirect('account/account');
                                }
                            }
                            $this->session->set_flashdata('prof_msg', 'Updated');
                            redirect('account/account');
                        } else{
                            $this->session->set_flashdata('prof_msg', 'Error');
                            redirect('account/account');
                        }
                    }
                } else{
                    $res = $this->Account_model->update_profile_info($old_email);
                    if($res){
                        if($this->input->post('prof_img_data')){
                            $res = $this->Account_model->update_profile_pic();
                            if($res){
                                $this->session->set_flashdata('prof_msg', 'Updated');
                                redirect('account/account');
                            }
                        }
                        $this->session->set_flashdata('prof_msg', 'Updated');
                        redirect('account/account');
                    } else{
                        $this->session->set_flashdata('prof_msg', 'Error');
                        redirect('account/account');
                    }
                }
            }
		}
		else { redirect('home/login'); }
    }

	public function account()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
            $data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data["user_info"] = $this->Account_model->get_user_info();
			$data['is_page'] = 'account';
            $this->load->view('account/account', $data);          
		}
		else { redirect('home/login'); }
    }
    
    public function view_bio($uid){
		if ($this->session->userdata('user_email')){ 
            $user_email       = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page']  = 'view_bio';
            $data['view_bio'] = $this->Account_model->view_bio($uid);
            $data['my_pets']  = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
            $data['user_id'] = $uid;
            $this->load->view('account/view_bio', $data);
        }
		else { redirect('home/login'); }
    }

    public function compLater(){
		if ($this->session->userdata('user_email')){ 
            echo $this->Account_model->compLater();
        }
		else { echo false; }
    }


    public function change_password(){
		if ($this->session->userdata('user_email')){ 
            $res = $this->Account_model->change_password();
            echo ($res) ? 1 : 0;
        }
		else { echo 0; }
    }

    public function setPhotoPrimary($img_name){
        if ($this->session->userdata('user_email')){ 
            echo $this->Account_model->setPrimaryImg($img_name);
        }
		else { echo false; }
    }

    public function setCoverPrimary($img_name){
        if($this->session->userdata('user_email')){
            echo $this->Account_model->setCoverImg($img_name);
        }
        else{ echo false;}
    }

    public function set_sitter_time(){
        if($this->session->userdata('user_email')){
            echo $this->Account_model->set_sitter_time();
        }
        else{ echo false;}
    }

}
