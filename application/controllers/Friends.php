<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friends extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function friend_list()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data["my_friends"] = $this->Friends_model->get_my_friends();
			$data['is_page'] = 'friends';
			$this->load->view('friends/friend_list', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function search_friends()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'friend_request';
            
            if($this->input->get('keywords')){
                $data['keywords'] = rtrim($this->input->get('keywords'));
                $data['search_results'] = $this->Friends_model->search_keywords($data['keywords']);
                $this->load->view('friends/s_friend_results', $data);
            } else{
                $this->session->set_flashdata('error_msg', 'Error viewing the page. Please check your link and try again');
                redirect('friends/friend_list');
            }
		}
		else
		{
			redirect('home/login');
		}
	}
	
	public function request_friends($uid, $type)
	{
		if ($this->session->userdata('user_email'))
		{
			if($uid && $type){
				$res = $this->Friends_model->request_friends($uid, $type);
				echo $res;
			}
		}
		else
		{
			redirect('home/login');
		}
	}
	
	public function process_request($rid, $uid, $type)
	{
		if ($this->session->userdata('user_email'))
		{
			if($rid && $uid && $type){
				$res = $this->Friends_model->process_request($rid, $uid, $type);
				echo $res;
			}
		}
		else
		{
			redirect('home/login');
		}
    }
    
    public function friend_request()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data["friend_request"] = $this->Friends_model->get_my_friend_request();
			$data['is_page'] = 'friend_request';
			$this->load->view('friends/friend_request', $data);
		}
		else
		{
			redirect('home/login');
		}
	}
}
