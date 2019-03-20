<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct(){
        parent::__construct();
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
        else{ echo false;}
    }

}