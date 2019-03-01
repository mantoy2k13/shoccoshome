<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'mainpage';
		$data['categories'] = $this->Pet_model->get_all_pet_cat();
		$data['my_pets'] = ($this->session->userdata('user_email')) ? $this->Account_model->get_my_pets($this->session->userdata('user_id')) : "";

		$this->load->view('frontpage/mainpage', $data);
	}
	
	public function about()
	{
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'about';
		$this->load->view('frontpage/about', $data);
	}

	public function contact()
	{
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'contact';
		$this->load->view('frontpage/contact', $data);
	}

	public function user_agreement()
	{
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'user_agreement';
		$this->load->view('frontpage/user_agreement', $data);
	}

	public function terms_and_conditions()
	{
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'terms_and_conditions';
		$this->load->view('frontpage/terms_cons', $data);
	}

	public function policy()
	{
		@$user_email  = $this->session->userdata('user_email');
		$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
		$data['is_page'] = 'policy';
		$this->load->view('frontpage/policy', $data);
	}

	public function news_feed()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'news_feed';
			$this->load->view('post/news_feed', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function new_post()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'new_post';
			$this->load->view('post/new_post', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function my_pets()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$userid=$data["user_logindata"]->id;

			$pet_data = $this->Pet_model->get_pet_data($userid);
			$data['get_pet_data']=$pet_data;

			$data['is_page'] = 'my_pets';
			$this->load->view('pet/my_pets', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function add_new_pet()
	{
		if ($this->session->userdata('user_email'))
		{
			$id = $this->uri->segment(3);
			$data["get_single_pet_data"]=$this->Pet_model->get_single_pet_data($id);

			$data["get_all_pet_cat"]=$this->Pet_model->get_all_pet_cat();
			$data["get_all_pet_breed"]=$this->Pet_model->get_all_pet_breed();
			$data["get_all_pet_color"]=$this->Pet_model->get_all_pet_color();


			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'add_pet';
			$this->load->view('pet/add_pet', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function pet_details()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);

			$id = $this->uri->segment(3);
			$data["get_all_pet_data"]=$this->Pet_model->get_all_pet_data($id);

			$data['is_page'] = 'pet_details';
			$this->load->view('pet/pet_details', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function booking()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'booking';
			$data['categories'] = $this->Pet_model->get_all_pet_cat();
			$data['my_pets'] = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
			$this->load->view('booking/booking', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function booking_list()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'booking_list';
			$this->load->view('booking/booking_list', $data);
		}
		else
		{
			redirect('home/login');
		}
	}
	
	public function pictures()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$user_id = $data['user_logindata']->id;
			$data['is_page'] = 'pictures';
			$data['all_pictures'] = $this->Pet_model->get_all_pictures($user_id);
			$this->load->view('pet/pictures', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function homepage()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data["get_all_users_data"]=$this->Auth_model->get_all_users_data();
			$data['is_page'] = 'homepage';
			$this->load->view('homepage/homepage', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function login()
	{
		$this->load->view('frontpage/login');
	}

	public function register()
	{
		$this->load->view('frontpage/register');
	}

	public function forgot_password()
	{
		$this->load->view('frontpage/forgot_password');
	}
}
