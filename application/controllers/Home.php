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

	public function my_newsfeeds(){
		if ($this->session->userdata('user_email')){
			$uid  						= $this->session->userdata('user_id');
			$user_email 				= $this->session->userdata('user_email');
			$data["user_logindata"] 	= $this->Auth_model->fetchuserlogindata($user_email);
			$data["get_all_users_data"] = $this->Auth_model->get_all_users_data();
			$data['is_page'] 			= 'my_newsfeeds';
			$data['view_bio'] 			= $this->Account_model->get_user_info($uid);
			$this->load->view('homepage/my_newsfeeds', $data);
		}
		else{
			redirect('home/login');
		}
	}

	public function my_calendar(){
		if ($this->session->userdata('user_email')){
			$uid  						= $this->session->userdata('user_id');
			$user_email 				= $this->session->userdata('user_email');
			$data["user_logindata"] 	= $this->Auth_model->fetchuserlogindata($user_email);
			$data["get_all_users_data"] = $this->Auth_model->get_all_users_data();
			$data['is_page'] 			= 'my_calendar';
			$data['view_bio'] 			= $this->Account_model->get_user_info($uid);
			$this->load->view('homepage/my_calendar', $data);
		}
		else{
			redirect('home/login');
		}
	}

	public function set_radius_length(){
		if ($this->session->userdata('user_email')){
			if($this->input->post()){
				$_SESSION['length_value'] = $this->input->post('length_value');
				$_SESSION['length_type']  = $this->input->post('length_type');
				redirect('home/'.$this->input->post('my_link'));
			} else{
				redirect('home/'.$this->input->post('my_link'));
			}
		}
		else{
			redirect('home/login');
		}
	}

	public function get_all_available_user()
	{
		if($this->session->userdata('user_email')){
            $get_all_available_user = $this->Booking_model->get_all_available_user();
            if($get_all_available_user){
                foreach($get_all_available_user as $p){
                    $book_type = ($p['book_type']==1) ? ' (HOST)' : ' (GUEST)';
                    $color = ($p['book_type']==2) ? '#fa5637' : '#2f59f3';
                    $title = $p['fullname'].$book_type;
                    $start = date('Y-m-d', strtotime($p['book_avail_from']));
                    $end   = date('Y-m-d', strtotime($p['book_avail_to'].' +1 day'));
                    $data  = array('id'=>$p['id'],'title'=>$title,'start'=>$start,'end'=> $end, 'color' => $color);
                    $user_dates[] = $data;
                }
            } else{
                $data  = array('id'=>0,'title'=>'','start'=>'','end'=> '');
                $user_dates[] = $data;
            }
            echo json_encode($user_dates);
        }
        else{ echo 0;}
    }

	public function my_map(){
		if ($this->session->userdata('user_email')){
			$uid  						= $this->session->userdata('user_id');
			$user_email 				= $this->session->userdata('user_email');
			$data["user_logindata"] 	= $this->Auth_model->fetchuserlogindata($user_email);
			$data["get_all_users_data"] = $this->Auth_model->get_all_users_data();
			$data['is_page'] 			= 'my_map';
			$data['view_bio'] 			= $this->Account_model->get_user_info($uid);
			$this->load->view('homepage/my_map', $data);
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
}
