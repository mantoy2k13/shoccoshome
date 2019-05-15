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
            $data['get_my_pets_to_sit'] = $this->Account_model->get_my_pets_to_sit($uid);
            $data['my_pets']  = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
            $data['user_id'] = $uid;
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
                            if($this->input->post('img_data')){
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
                        if($this->input->post('img_data')){
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

    public function get_user_info($uid){
        if($this->session->userdata('user_email')){
            $user_data = $this->Account_model->get_user($uid);
            $get_cat   = $this->Pet_model->get_all_pet_cat();
            $cats      = json_decode($user_data['cat_list']);
            $c = "";
            foreach($get_cat as $cat){
                if(in_array($cat['cat_id'], $cats)){
                    $c .= $cat['cat_name'].', ';
                }
            } $my_cat = array('my_cat'=>$c);
            $data = $user_data + $my_cat;
            echo ($data) ? json_encode($data) : 0;
        }
        else{ echo false;}
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

    public function setCoverPos($pos){
        if($this->session->userdata('user_email')){
            echo $this->Account_model->setCoverPos($pos);
        }
        else{ echo false;}
    }

/* Account Use Codes */
    public function set_my_dates(){
        if($this->session->userdata('user_email')){
            $book_avail_from = date ("Y-m-d H:i:s", strtotime($this->input->post('book_avail_from').' '.$this->input->post('book_time_from')));
            $book_avail_to = date ("Y-m-d H:i:s", strtotime($this->input->post('book_avail_to').' '.$this->input->post('book_time_to')));
            $res = $this->Account_model->set_my_dates($book_avail_from, $book_avail_to);
            echo ($res) ? 1 : 0;
        }
        else{ echo false;}
    }

    public function need_sitter_set_time(){
        if($this->session->userdata('user_email')){
            echo $this->Account_model->need_sitter_set_time();
        }
        else{ echo false;}
    }
    
    public function unset_dates($t){
		if ($this->session->userdata('user_email')){ 
            echo $this->Account_model->unset_dates($t);
        }
		else { echo false; }
    }

    public function uploadImg(){
        if ($this->session->userdata('user_email')){ 
            $res = $this->Account_model->update_profile_pic(); 
            echo $res ? 1 : 0;
        }
		else { echo false; }
    }
    
/* Close Account Use Codes */

    public function update_need_pet_sitter($pid){
        if($this->session->userdata('user_email')){
            echo $this->Account_model->update_need_pet_sitter($pid);
        }
        else{ echo false;}
    }


    public function send_password_recovery(){
        if($this->input->post('email')){
            $email = $this->input->post('email');
            $check_email = $this->Auth_model->email_check($email);
            if(!$check_email){
                $newPass = $this->randomPassword();
                $res = $this->Account_model->update_new_password($newPass, $email);
                if($res){
                    $this->email->from('noreply@shoccoshome.com', 'Shocco\'s Home'); 
                    $this->email->to($email); 
                    $this->email->subject('New Password Recovery');
                    $this->email->message('Hello! Your new password is "'.$newPass.'" with an email of '.$email.'. Please try to change your password after logging in to your account. Thank you!');
                    echo ($this->email->send()) ? 1 : 0;
                } else{ echo 0; }
            } else{ echo 0; }
        } else { echo 0; }
    }
    
    public function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}
