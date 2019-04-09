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
			$data['is_page'] = 'friends';
			$data['base_url'] = base_url().'friends/friend_list';
			$data['total_rows'] = $this->Friends_model->get_my_friends_count();
			$data['per_page'] = 10;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
			$data["my_friends"] = $this->Friends_model->get_my_friends_lists($data["per_page"],$page);
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
			$_SESSION['friend_keywords'] = isset($_SESSION['friend_keywords']) ? $_SESSION['friend_keywords'] : rtrim($this->input->get('keywords'));
			
			$data['base_url'] = base_url().'friends/search_friends';
			$data['total_rows'] = $this->Friends_model->search_keywords_count();
			$data['per_page'] = 10;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
			$data['search_results'] = $this->Friends_model->search_keywords_pagi($data["per_page"], $page);
			$this->load->view('friends/s_friend_results', $data);
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
			$data['is_page'] = 'friend_request';
			$data['base_url'] = base_url().'friends/friend_request';
			$data['total_rows'] = $this->Friends_model->get_my_friend_request_count();
			$data['per_page'] = 10;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
			$data["friend_i_request"] = $this->Friends_model->get_friend_i_request();
			$data["friend_request"] = $this->Friends_model->get_my_friend_request_pagi($data["per_page"], $page);
			$this->load->view('friends/friend_request', $data);
		}
		else
		{
			redirect('home/login');
		}
	}
}
