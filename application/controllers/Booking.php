<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function booking_list($type){
		if ($this->session->userdata('user_email'))
		{   
            $uid                     = $this->session->userdata('user_id');
			$user_email              = $this->session->userdata('user_email');
			$data["user_logindata"]  = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page']         = 'booking_list';
            $data['booking_list']    = $this->Booking_model->booking_list($uid, $type);
            $data['categories']      = $this->Pet_model->get_all_pet_cat();
			$data['my_pets']         = $this->Account_model->get_my_pets($uid);
			$this->load->view('booking/booking_list', $data);
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

    public function bookng_approvals($bid, $status)
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->bookng_approvals($bid, $status);
        }
        else{ echo 0;}
    }

    public function re_book_user($bid)
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->re_book_user($bid);
        }
        else{ echo 0;}
    }

    public function get_booking_info($bid,$type)
	{
		if($this->session->userdata('user_email')){
            echo json_encode($this->Booking_model->get_booking_info($bid,$type));
        }
        else{ echo 0;}
    }

    public function get_guest_req()
	{
		if($this->session->userdata('user_email')){
            echo json_encode($this->Booking_model->get_guest_req());
        }
        else{ echo 0;}
    }

    public function update_guest_req($bid)
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->update_guest_req($bid);
        }
        else{ echo 0;}
    }

    public function get_host_approve()
	{
		if($this->session->userdata('user_email')){
            echo json_encode($this->Booking_model->get_host_approve());
        }
        else{ echo 0;}
    }

    public function update_host_approve($bid)
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->update_host_approve($bid);
        }
        else{ echo 0;}
    }

}