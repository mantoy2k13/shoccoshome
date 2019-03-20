<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function booking_request($type){
		if ($this->session->userdata('user_email'))
		{   
            $uid                     = $this->session->userdata('user_id');
			$user_email              = $this->session->userdata('user_email');
			$data["user_logindata"]  = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page']         = 'booking_request';
            $data['booking_request'] = $this->Booking_model->booking_request($uid, $type);
            $data['categories']      = $this->Pet_model->get_all_pet_cat();
			$data['my_pets']         = $this->Account_model->get_my_pets($uid);
			$this->load->view('booking/booking_req', $data);
		}
		else{
			redirect('home/login');
		}
    }
    
    public function booking_history($type){
		if ($this->session->userdata('user_email'))
		{   
            $uid                     = $this->session->userdata('user_id');
			$user_email              = $this->session->userdata('user_email');
			$data["user_logindata"]  = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page']         = 'booking_history';
            $data['booking_history'] = $this->Booking_model->booking_history($uid, $type);
            $data['categories']      = $this->Pet_model->get_all_pet_cat();
			$data['my_pets']         = $this->Account_model->get_my_pets($uid);
			$this->load->view('booking/booking_history', $data);
		}
		else{
			redirect('home/login');
		}
	}

    public function create_booking()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
            $data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data["user_info"] = $this->Account_model->get_user_info();
            $data['is_page'] = 'create_booking';
            $data['zipcode'] = $this->input->post('zipcode');
            $data['user_type'] = $this->input->post('user_type');
            $data['pet_list'] = $this->input->post('pet_list');
            $data['pet_cat'] = $this->input->post('pet_cat');
            $data['categories'] = $this->Pet_model->get_all_pet_cat();
		    $data['my_pets'] = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
            $this->load->view('booking/create_booking', $data);          
		}
		else { redirect('home/login'); }
    }

    public function select_and_book()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email              = $this->session->userdata('user_email');
            $data["user_logindata"]  = $this->Auth_model->fetchuserlogindata($user_email);
            $data["user_info"]       = $this->Account_model->get_user_info();
            $data['is_page']         = 'select_and_book';
            $data['zipcode']         = $this->input->post('zipcode');
            $data['user_type']       = $this->input->post('user_type');
            $data['pet_list']        = $this->input->post('pet_list');
            $data['pet_cat']         = $this->input->post('pet_cat');
            $data['categories']      = $this->Pet_model->get_all_pet_cat();
            $data['my_pets']         = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
            $data['get_avail_users'] = $this->Booking_model->get_avail_users($data['zipcode']);
            if($data['user_type']=="guest"){
                $this->load->view('booking/select_user_booking', $data);   
            }
		}
		else { redirect('home/login'); }
    }

    public function book_user()
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->book_user();
        }
        else{ echo 0;}
    }

    public function update_book_user($bid)
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->update_book_user($bid);
        }
        else{ echo 0;}
    }

    public function cancel_booking($bid)
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->cancel_booking($bid);
        }
        else{ echo 0;}
    }

}