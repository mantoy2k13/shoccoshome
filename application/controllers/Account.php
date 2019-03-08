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
            $this->load->view('account/bio', $data);
        }
		else { redirect('home/login'); }
    }
    
    public function account_update(){
        $user=array(
            'fullname'=>$this->input->post('fullname'),
            'occupation'=>$this->input->post('occupation'),
            'email'=>$this->input->post('email'),
            'mobile_number'=>$this->input->post('mobile_number'),
            'gender'=>$this->input->post('gender'),
            'address'=>$this->input->post('address'),
            'country'=>$this->input->post('country'),
            'state'=>$this->input->post('state'),
            'city'=>$this->input->post('city'),
            'street'=>$this->input->post('street'),
            'zip_code'=>$this->input->post('zip_code'),
            'bio'=>$this->input->post('bio'),
            'is_complete'=>1,
        );

        // image uploding
        if (!empty($_FILES['user_img']['name'])) {

            $ext = explode('.', $_FILES['user_img']['name']);
            $filename = 'pp_'.time();
            $_FILES['user_img']['name'];
            $user['user_img'] = $filename.'.'.$ext[1];
            $config['file_name']            = $filename;
            $config['upload_path']          = './assets/img/profile_pics/';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('user_img')) {
                $this->session->set_flashdata('prof_msg', 'ErrorImg');
            }
            else {
                $useremail=$this->input->post('email');
                $userdetils=$this->Auth_model->fetchuserlogindata($useremail);
                $userimage=$userdetils->user_img;
					 if($userimage){
                $proimglink= 'assets/img/profile_pics/'.$userimage;
                unlink($proimglink);
					 }
                $this->session->set_flashdata('prof_msg', 'Updated');
            }
          
         }
        
        $check_cs_email=$this->session->userdata('user_email');
        $check_c_email=$this->input->post('email');
        if($check_cs_email!==$check_c_email){
            $email_check=$this->Account_model->email_check($user['email']);
            if(!$email_check){
                $this->session->set_flashdata('prof_msg', 'Exist');
                 redirect('account/account');
                }else{
                    $updateddata = $this->Account_model->updateuserdata($user);
                    if ($updateddata) {
                        $this->session->set_flashdata('prof_msg', 'Updated');
                        redirect('home/login');
                    }
                    else {
                        $this->session->set_flashdata('prof_msg', 'Error');
                        redirect('account/account');
                    }
                }
        }else{
            $updateddata = $this->Account_model->updateuserdata($user);
            if ($updateddata) {
                $this->session->set_flashdata('prof_msg', 'Updated');
                redirect('account/account');
            }
            else {
                $this->session->set_flashdata('prof_msg', 'Error');
                redirect('account/account');
            }
        }
    }

    public function change_password(){
        if ($this->session->userdata('user_email'))
		{
            $res = $this->Account_model->change_password();
            echo ($res) ? 1 : 0;
		}
		else { echo 0; }
    }

	public function account()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
            $data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'account';
            $this->load->view('account/account', $data);          
		}
		else { redirect('home/login'); }
    }
    
    public function view_bio($uid){
		if ($this->session->userdata('user_email')){ 
            $user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'view_bio';
            $data['view_bio'] = $this->Account_model->view_bio($uid);
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

}
