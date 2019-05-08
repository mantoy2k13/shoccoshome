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
            $_SESSION['zipcode']     = ($this->input->post('zipcode')) ? rtrim($this->input->post('zipcode')) : $_SESSION['zipcode'];
            $_SESSION['user_type']   = ($this->input->post('user_type')) ? rtrim($this->input->post('user_type')) : $_SESSION['user_type'];
            $data['categories']      = $this->Pet_model->get_all_pet_cat();
            $data['my_pets']         = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
            $data['base_url'] = base_url().'booking/select_and_book';
            $data['per_page'] = 20;
            $data["uri_segment"] = 3;
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            if($_SESSION['user_type']=="guest"){
                $data['total_rows'] = $this->Booking_model->get_avail_users(null, null, 1);
                $this->pagination->initialize($data);
                $data["links"] = $this->pagination->create_links();
                $data['get_avail_users'] = $this->Booking_model->get_avail_users($data["per_page"], $page, 2);
                $this->load->view('booking/select_user_booking', $data);   
            } else{
                if($this->input->post('pet_cat')){
                    $ids = array();
                    foreach($this->input->post('pet_cat') as $k=>$cat_id){
                        $ids[] = $cat_id;
                    }
                    $_SESSION['pet_cat'] = json_encode($ids);
                }
                $data['total_rows'] = $this->Booking_model->get_avail_pets(null, null, 1);
                $this->pagination->initialize($data);
                $data["links"] = $this->pagination->create_links();
                $data['get_avail_pets'] = $this->Booking_model->get_avail_pets($data["per_page"], $page, 2);
                $this->load->view('booking/select_pet_booking', $data);
            }
		}
		else { 
            $_SESSION['is_in_book'] = true;
            redirect('home/login'); 
        }
    }

    public function book_user_pets($uid){
		if ($this->session->userdata('user_email')){ 
            $user_email       = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page']  = 'book_user_pets';
            $data['view_bio'] = $this->Account_model->view_bio($uid);
            $data['user_id'] = $uid;
            $this->load->view('booking/book_user_pets', $data);
        }
		else { redirect('home/login'); }
    }

    public function book_this_user($uid){
		if ($this->session->userdata('user_email')){ 
            $user_email       = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page']  = 'book_this_user';
            $data['view_bio'] = $this->Account_model->view_bio($uid);
            $data['my_pets']  = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
            $data['user_id'] = $uid;
            $this->load->view('booking/book_this_user', $data);
        }
		else { redirect('home/login'); }
    }

    public function booking_as_host()
	{
        if ($this->session->userdata('user_email')){ 
            $user_email  = $this->session->userdata('user_email');
            $uid  = $this->session->userdata('user_id');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page']    = 'booking_as_host';
            $data['bio']        = $this->Account_model->view_bio($uid);
            $data['categories'] = $this->Pet_model->get_all_pet_cat();
            $data['get_my_pets_to_sit'] = $this->Account_model->get_my_pets_to_sit($uid);
            $this->load->view('booking/booking_as_host', $data);
        }
		else { redirect('home/login'); }
    }

    public function booking_set_dates()
	{
        if ($this->session->userdata('user_email')){ 
            $user_email  = $this->session->userdata('user_email');
            $uid  = $this->session->userdata('user_id');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'booking_set_dates';
            $data['view_bio'] = $this->Account_model->view_bio($uid);
            $data['get_my_pets_to_sit'] = $this->Account_model->get_my_pets_to_sit($uid);
            $data['my_pets']  = $this->Account_model->get_my_pets($this->session->userdata('user_id'));
            $this->load->view('booking/booking_set_dates', $data);
        }
		else { redirect('home/login'); }
    }

    public function get_single_pet_ajax($pid)
	{
		if($this->session->userdata('user_email')){
            echo json_encode($this->Pet_model->get_single_pet_data($pid));
        }
        else{ echo 0;}
    }

    public function get_user_pets_ajax($uid)
	{
		if($this->session->userdata('user_email')){
            echo json_encode($this->Account_model->get_my_pets($uid));
        }
        else{ echo 0;}
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

    public function book_pet_user()
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->book_pet_user();
        }
        else{ echo 0;}
    }

    public function update_book_pet_user($bid)
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->update_book_pet_user($bid);
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

    public function getNearUsers()
	{
		if($this->session->userdata('user_email')){
            echo json_encode($this->Booking_model->getNearPeople());
        }
        else{ echo 0;}
    }

    public function getNearUsers2()
	{
		if($this->session->userdata('user_email')){
            $nearPeople = $this->Booking_model->getNearPeople();
            $i=0;
            if($nearPeople){
                foreach($nearPeople as $p){
                    if($p['sitter_availability'] && $p['isAvail']){
                        $dates = json_decode($p['sitter_availability']);
                        $title = $p['fullname'].' (Host)';
                        $start = $dates[0];
                        $end   = date('Y-m-d', strtotime($dates[1] . ' +1 day'));
                        $data  = array('id'=>$i,'title'=>$title,'start'=>$start,'end'=> $end);
                        $user_dates[] = $data;

                        $r = $this->Booking_model->get_avail_pets_date($p['id']);
                        $title = $p['fullname'].' (Guest)';
                        $ndf = json_decode($r['ns_date_from']); 
                        $ndt = json_decode($r['ns_date_to']); 
                        $start = $ndf[0];
                        $end   = date('Y-m-d', strtotime($ndt[0] . ' +1 day'));
                        $datas  = array('id'=>$i,'title'=>$title,'start'=>$start,'end'=> $end,'color'=>'#376afa');
                        $user_dates[] = $datas;
                    }

                    if(!$p['sitter_availability'] && $p['isAvail']){
                        $r = $this->Booking_model->get_avail_pets_date($p['id']);
                        $title = $p['fullname'].' (Guest)';
                        $ndf = json_decode($r['ns_date_from']); 
                        $ndt = json_decode($r['ns_date_to']); 
                        $start = $ndf[0];
                        $end   = date('Y-m-d', strtotime($ndt[0] . ' +1 day'));
                        $datas  = array('id'=>$i,'title'=>$title,'start'=>$start,'end'=> $end,'color'=>'#376afa');
                        $user_dates[] = $datas;
                    }

                    $i++;
                }
            } else{
                $data  = array('id'=>0,'title'=>'','start'=>'','end'=> '');
                $user_dates[] = $data;
            }
            echo json_encode($user_dates);
        }
        else{ echo 0;}
    }

    public function setMyLocation()
	{
		if($this->session->userdata('user_email')){
            $lat = $this->input->post('lat');
            $lng = $this->input->post('lng');
            $_SESSION['cur_lat'] = $lat;
            $_SESSION['cur_lng'] = $lng;
            $_SESSION['length_value'] = 50;
            $_SESSION['length'] = 'km';
            echo 'home/people_near_me';
        }
        else{ echo 0;}
    }

    public function get_my_avail_pets($uid)
	{
		if($this->session->userdata('user_email')){
            echo $this->Booking_model->get_my_avail_pets($uid);
        }
        else{ echo 0;}
    }

    public function get_avail_host()
	{
		if($this->session->userdata('user_email')){
            $get_avail_host = $this->Booking_model->get_avail_host();
            if($get_avail_host){
                foreach($get_avail_host as $p){
                    $book_type = ($p['fullname']) ? ' (HOST)' : ' (GUEST)';
                    $title = $p['fullname'].$book_type;
                    // $end   = date('Y-m-d', strtotime($p['fullname'] . ' +1 day'));
                    $start = date('Y-m-d', strtotime($p['book_avail_from']));
                    $end   = date('Y-m-d', strtotime($p['book_avail_to']));
                    $data  = array('id'=>$p['id'],'title'=>$title,'start'=>$start,'end'=> $end);
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

}