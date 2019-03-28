<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function get_avail_users($zipcode){
		$this->db->select('*')->from('sh_users');
        $this->db->where('zip_code', $zipcode);
        return $this->db->get()->result_array();   
    }

    public function get_avail_pets(){
        $zip = $this->input->post('zipcode');
       
        $this->db->select('sh_pets.*, sh_category.cat_name, sh_users.fullname, sh_breeds.breed_name, sh_color.color_name')->from('sh_pets');
        $this->db->join('sh_users',   'sh_users.id=sh_pets.user_id', 'left');
		$this->db->join('sh_category','sh_category.cat_id=sh_pets.cat_id', 'left');
        $this->db->join('sh_breeds',  'sh_breeds.breed_id=sh_pets.breed_id', 'left');
        $this->db->join('sh_color',   'sh_color.color_id=sh_pets.color_id', 'left');
        foreach($this->input->post('pet_cat') as $k=>$cat_id){
            $this->db->or_where('sh_pets.cat_id', $cat_id);
        }
        $this->db->where('sh_pets.zip_code', $zip);
        $this->db->where('sh_pets.isAvailable', true);
        return $this->db->get()->result_array();   
    }

    public function book_user(){
        $book_date_from[] = $this->input->post('date_from');
        $book_date_from[] = $this->input->post('time_start');
        $book_date_to[]   = $this->input->post('date_to');
        $book_date_to[]   = $this->input->post('time_end');
        foreach ($this->input->post('pet_list') as $k => $v) {
           $pet_list[] = $v;
        }
		$data = array(
            'user_id'        => $this->session->userdata('user_id'),
            'book_user_id'   => $this->input->post('book_user_id'),
            'book_date_from' => json_encode($book_date_from),
            'book_date_to'   => json_encode($book_date_to),
            'pet_list'       => json_encode($pet_list),
            'user_type'      => $this->input->post('user_type'),
            'message'        => $this->input->post('message'),
            'book_status'    => 1,
            'is_notify'      => 1
        );

        $res = $this->db->insert('sh_book', $data);
        return ($res) ? 1 : 0;
    }

    public function update_book_user($bid){
        $book_date_from[] = $this->input->post('date_from');
        $book_date_from[] = $this->input->post('time_start');
        $book_date_to[]   = $this->input->post('date_to');
        $book_date_to[]   = $this->input->post('time_end');
        foreach ($this->input->post('pet_list') as $k => $v) {
           $pet_list[] = $v;
        }
		$data = array(
            'book_date_from' => json_encode($book_date_from),
            'book_date_to'   => json_encode($book_date_to),
            'pet_list'       => json_encode($pet_list),
            'message'        => $this->input->post('message')
        );
        $this->db->where('book_id', $bid);
        $res = $this->db->update('sh_book', $data);
        return ($res) ? 1 : 0;
    }

    public function book_pet_user(){
        $book_date_from[] = $this->input->post('date_from');
        $book_date_from[] = $this->input->post('time_start');
        $book_date_to[]   = $this->input->post('date_to');
        $book_date_to[]   = $this->input->post('time_end');
        foreach ($this->input->post('pet_list') as $k => $v) {
           $pet_list[] = $v;
        }
		$data = array(
            'user_id'        => $this->session->userdata('user_id'),
            'book_user_id'   => $this->input->post('book_user_id'),
            'book_date_from' => json_encode($book_date_from),
            'book_date_to'   => json_encode($book_date_to),
            'pet_list'       => json_encode($pet_list),
            'user_type'      => $this->input->post('user_type'),
            'message'        => $this->input->post('message'),
            'book_status'    => 1,
            'is_notify'      => 1
        );

        $res = $this->db->insert('sh_book', $data);
        return ($res) ? 1 : 0;
    }

    public function update_book_pet_user($bid){
        $book_date_from[] = $this->input->post('date_from');
        $book_date_from[] = $this->input->post('time_start');
        $book_date_to[]   = $this->input->post('date_to');
        $book_date_to[]   = $this->input->post('time_end');
        foreach ($this->input->post('pet_list') as $k => $v) {
           $pet_list[] = $v;
        }
		$data = array(
            'book_date_from' => json_encode($book_date_from),
            'book_date_to'   => json_encode($book_date_to),
            'pet_list'       => json_encode($pet_list),
            'message'        => $this->input->post('message')
        );
        $this->db->where('book_id', $bid);
        $res = $this->db->update('sh_book', $data);
        return ($res) ? 1 : 0;
    }

    public function check_booking($uid, $bud){
        $this->db->where('user_id', $uid);
        $this->db->where('book_user_id', $bud);
        $this->db->where('book_status', 1);
        $this->db->select('*')->from('sh_book');
        return $this->db->get()->row_array();
    }

    public function bookng_approvals($bid, $status){
        $data = ($status==4) ? array('book_status' => $status, 'is_notify' => 3) : array('book_status' => $status);
        $this->db->where('book_id', $bid);
        $res = $this->db->update('sh_book', $data);
        return ($res) ? 1 : 0;
    }

    public function re_book_user($bid){
        $this->db->set('book_status', 1);
        $this->db->where('book_id', $bid);
        $res = $this->db->update('sh_book');
        return ($res) ? 1 : 0;
    }

    public function booking_list($uid, $type){
        $this->db->select('*')->from('sh_book');
        if($type==1){
            $this->db->join('sh_users', 'sh_users.id=sh_book.book_user_id', 'left');
            $this->db->where('sh_book.user_id', $uid);
        } else{
            $this->db->join('sh_users', 'sh_users.id=sh_book.user_id', 'left');
            $this->db->where('sh_book.book_user_id', $uid);
        }
        return $this->db->get()->result_array();
    }

    public function get_booking_info($bid, $type){
        $this->db->select('*')->from('sh_book');
        if($type==1){
            $this->db->join('sh_users', 'sh_users.id=sh_book.book_user_id', 'left');
            $this->db->where('sh_book.book_id', $bid);
        } else{
            $this->db->join('sh_users', 'sh_users.id=sh_book.user_id', 'left');
            $this->db->where('sh_book.book_id', $bid);
        }
        return $this->db->get()->row_array();
    }

    public function count_mgb(){
        $uid = $this->session->userdata('user_id');
        $this->db->where('book_user_id', $uid);
        $this->db->where('book_status', 1);
        $r = $this->db->get('sh_book');
        return ($r) ? $r->num_rows() : 0;
    }

    public function count_ba(){
        $uid = $this->session->userdata('user_id');
        $this->db->where('user_id', $uid);
        $this->db->where('book_status', 4);
        $r = $this->db->get('sh_book');
        return ($r) ? $r->num_rows() : 0;
    }

    public function get_guest_req(){
        $uid = $this->session->userdata('user_id');
        $this->db->select('*')->from('sh_book');
        $this->db->join('sh_users', 'sh_users.id=sh_book.user_id', 'left');
        $this->db->where('book_user_id', $uid);
        $this->db->where('is_notify', 1);
        $this->db->where('book_status', 1);
        return $this->db->get()->result_array();
    }

    public function update_guest_req($bid){
        $this->db->set('is_notify', 2);
        $this->db->where('book_id', $bid);
        $res = $this->db->update('sh_book');
        return ($res) ? 1 : 0;
    }

    public function get_host_approve(){
        $uid = $this->session->userdata('user_id');
        $this->db->select('*')->from('sh_book');
        $this->db->join('sh_users', 'sh_users.id=sh_book.book_user_id', 'left');
        $this->db->where('user_id', $uid);
        $this->db->where('is_notify', 3);
        $this->db->where('book_status', 4);
        return $this->db->get()->result_array();
    }

    public function update_host_approve($bid){
        $this->db->set('is_notify', 4);
        $this->db->where('book_id', $bid);
        $res = $this->db->update('sh_book');
        return ($res) ? 1 : 0;
    }
    
}