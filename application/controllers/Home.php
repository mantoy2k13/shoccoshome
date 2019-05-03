<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'mainpage';
		$data['categories'] = $this->Pet_model->get_all_pet_cat();
		$data['my_pets'] = ($this->session->userdata('user_email')) ? $this->Account_model->get_my_pets($this->session->userdata('user_id')) : "";
		$this->load->view('frontpage/mainpage', $data);
	}
	
	public function about(){
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'about';
		$this->load->view('frontpage/about', $data);
	}

	public function contact(){
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'contact';
		$this->load->view('frontpage/contact', $data);
	}

	public function user_agreement(){
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'user_agreement';
		$this->load->view('frontpage/user_agreement', $data);
	}

	public function terms_and_conditions(){
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'terms_and_conditions';
		$this->load->view('frontpage/terms_cons', $data);
	}

	public function policy(){
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'policy';
		$this->load->view('frontpage/policy', $data);
	}

	public function booking(){
		if ($this->session->userdata('user_email')){
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'booking';
			$data['categories'] = $this->Pet_model->get_all_pet_cat();
			$data['my_pets'] = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
			$this->load->view('booking/booking_history', $data);
		}
		else{
			redirect('home/login');
		}
	}

	public function homepage(){
		if ($this->session->userdata('user_email')){
			$uid  = $this->session->userdata('user_id');
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data["get_all_users_data"]=$this->Auth_model->get_all_users_data();
			$data['is_page'] = 'homepage';
			$data['view_bio'] = $this->Account_model->view_bio($uid);
			$data['get_my_pets_to_sit'] = $this->Account_model->get_my_pets_to_sit($uid);
			$this->load->view('homepage/homepage', $data);
		}
		else{
			redirect('home/login');
		}
	}

	public function people_near_me(){
		if ($this->session->userdata('user_email')){
			if($this->input->post()){
				$_SESSION['length_value'] = $this->input->post('length_value');
				$_SESSION['length'] = $this->input->post('length');
			}
			$uid  = $this->session->userdata('user_id');
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'people_near_me';
			$data['view_bio'] = $this->Account_model->view_bio($uid);
			$data['base_url'] = base_url().'home/people_near_me';
			$data['total_rows'] = $this->Booking_model->getCountNearPeople();
			$data['per_page'] = 20;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
			$_SESSION['per_page'] = $data["per_page"];
			$_SESSION['page'] 	  = $page;
			$data['getNearPeople'] = $this->Booking_model->getNearPeople();
			$this->load->view('homepage/people_near_me', $data);
		}
		else{
			redirect('home/login');
		}
	}

	public function login(){	
		if ($this->session->userdata('user_email')){
			redirect(base_url());
		}
		else{
			$this->load->view('frontpage/login');
		}
	}

	public function register(){
		if ($this->session->userdata('user_email')){
			redirect(base_url());
		}
		else{
			$this->load->view('frontpage/register');
		}
	}

	public function forgot_password(){
		$this->load->view('frontpage/forgot_password');
	}

	public function adminpage(){
		if ($this->session->userdata('user_email')){
			$uid  = $this->session->userdata('user_id');
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data["get_all_users_data"]=$this->Auth_model->get_all_users_data();
			$data['is_page'] = 'adminpage';
			$this->load->view('admin/admin',$data);
		}
		else{
			redirect('home/login');
		}
	}

	public function userlist(){
		if($this->session->userdata('user_email')){
			$uid = $this->session->userdata('user_id');
			$user_email =$this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data["get_all_userlist"] = $this->Auth_model->get_all_users_data();
			$data['is_page'] = 'userlist';
			$this->load->view('admin/userlist',$data);
		}
	}
}
