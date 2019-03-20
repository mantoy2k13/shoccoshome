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
}