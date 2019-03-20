<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function get_avail_users($zipcode){
		$this->db->select('*')->from('sh_users');
        $this->db->where('zip_code', $zipcode);
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

    public function check_booking($uid, $bud){
        $this->db->where('user_id', $uid);
        $this->db->where('book_user_id', $bud);
        $this->db->where('book_status', 1);
        $this->db->select('*')->from('sh_book');
        return $this->db->get()->row_array();
    }

    public function cancel_booking($bid){
        $this->db->where('book_id', $bid);
        $res = $this->db->delete('sh_book');
        return ($res) ? 1 : 0;
    }

    public function booking_request($uid, $type){
        $this->db->select('*')->from('sh_book');
        $this->db->join('sh_users', 'sh_users.id=sh_book.user_id', 'left');
        $this->db->where('sh_book.book_user_id', $uid);
        $this->db->where('sh_book.book_status', $type);
        $this->db->order_by('sh_book.book_id', 'asc');
        return $this->db->get()->result_array();
    }

    public function booking_history($uid, $type){
        $this->db->select('*')->from('sh_book');
        $this->db->join('sh_users', 'sh_users.id=sh_book.book_user_id', 'left');
        $this->db->where('sh_book.user_id', $uid);
        $this->db->where('sh_book.book_status', $type);
        $this->db->order_by('sh_book.book_id', 'asc');
        return $this->db->get()->result_array();
    }
}