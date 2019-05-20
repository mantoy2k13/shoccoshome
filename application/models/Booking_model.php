<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    /* New Booking steps ================================================================*/
    public function book_me_now($book_id){
        foreach ($this->input->post('pet_list') as $v) {
           $pet_list[] = $v;
        }
		$data = array(
            'book_by'        => $this->session->userdata('user_id'),
            'book_to'        => $this->input->post('book_to'),
            'book_date_from' => $this->input->post('book_avail_from').' '.$this->input->post('book_time_from'),
            'book_date_to'   => $this->input->post('book_avail_to').' '.$this->input->post('book_time_to'),
            'pet_list'       => json_encode($pet_list),
            'user_type'      => $this->input->post('user_type'),
            'short_message'  => $this->input->post('short_message'),
            'book_status'    => 1,
            'is_notify'      => 1
        );

        if($book_id){
            $this->db->where('book_id', $book_id);
            $res = $this->db->update('sh_book', $data);
        } else{
            $this->db->insert('sh_book', $data);
            $res = $this->db->insert_id();
        }
        
        return ($res) ? $res : false;
    }

    public function get_book_info($book_id){
        $this->db->select('*')->from('sh_book')->where('book_id', $book_id);
        return $this->db->get()->row_array();
    }

    public function get_booking_info($bid, $type){
        $this->db->select('*')->from('sh_book');
        if($type==1 ){
            $this->db->join('sh_users', 'sh_users.id=sh_book.book_to', 'left');
            $this->db->where('sh_book.book_id', $bid);
        } else{
            $this->db->join('sh_users', 'sh_users.id=sh_book.book_by', 'left');
            $this->db->where('sh_book.book_id', $bid);
        }
        return $this->db->get()->row_array();
    }

    public function check_booking($book_by, $book_to){
        $this->db->where('book_by', $book_by);
        $this->db->where('book_to', $book_to);
        $this->db->where('book_status', 1);
        $this->db->select('*')->from('sh_book');
        return $this->db->get()->row_array();
    }

    public function booking_approvals($bid, $status){
        $data = ($status==4) ? array('book_status' => $status, 'is_notify' => 3) : array('book_status' => $status);
        $this->db->where('book_id', $bid);
        $res = $this->db->update('sh_book', $data);
        return ($res) ? 1 : 0;
    }

    public function booking_history($uid, $type){
        $this->db->select('*')->from('sh_book');
        if($type==1){
            $this->db->join('sh_users', 'sh_users.id=sh_book.book_to', 'left');
            $this->db->where('sh_book.book_by', $uid);
        } else{
            $this->db->join('sh_users', 'sh_users.id=sh_book.book_by', 'left');
            $this->db->where('sh_book.book_to', $uid);
        }
        return $this->db->get()->result_array();
    }

    public function count_mgb(){
        $uid = $this->session->userdata('user_id');
        $this->db->where('book_to', $uid);
        $this->db->where('book_status', 1);
        $r = $this->db->get('sh_book');
        return ($r) ? $r->num_rows() : 0;
    }

    public function count_ba(){
        $uid = $this->session->userdata('user_id');
        $this->db->where('book_by', $uid);
        $this->db->where('book_status', 4);
        $r = $this->db->get('sh_book');
        return ($r) ? $r->num_rows() : 0;
    }

    public function get_guest_req(){
        $uid = $this->session->userdata('user_id');
        $this->db->select('*')->from('sh_book');
        $this->db->join('sh_users', 'sh_users.id=sh_book.book_by', 'left');
        $this->db->where('book_to', $uid);
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
        $this->db->join('sh_users', 'sh_users.id=sh_book.book_to', 'left');
        $this->db->where('book_by', $uid);
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

    public function get_all_available_user(){
        $uid = $this->session->userdata('user_id');
        $length_value = (isset($_SESSION['length_value'])) ? $_SESSION['length_value'] : 50;
        $length_type  = (isset($_SESSION['length_type'])) ? $_SESSION['length_type'] : 'km';
        $lat = isset($_SESSION['cur_lat']) ? $_SESSION['cur_lat'] : $this->input->post('cur_lat');
        $lng = isset($_SESSION['cur_lng']) ? $_SESSION['cur_lng'] : $this->input->post('cur_lng');
        if($length_type=='km'){
            $radiusKm  = ((int) $length_value); 
        }

        if($length_type=='mi'){
            $radiusKm  = ((int) $length_value)  * 0.621371192; 
        }

        if($length_type=='m'){
            $radiusKm  = ((int) $length_value)  * 0.001; 
        }
        $current_date = date('Y-m-d');

        $proximity = $this->mathGeoProximity($lat, $lng, $radiusKm);
        $this->db->select('*')->from('sh_users');
        $this->db->where('user_lat BETWEEN "'. number_format($proximity['latitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['latitudeMax'], 12, '.', '').'"');
        $this->db->where('user_lng BETWEEN "'. number_format($proximity['longitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['longitudeMax'], 12, '.', '').'"');
        $this->db->where('STR_TO_DATE(book_avail_from, "%Y-%m-%d") >=', $current_date);
        $this->db->where('isAvail', true);
        return $this->db->get()->result_array();
    }

    /* Close New Booking steps ================================================================*/
    

    public function getNearUsers($lat, $lng){
        $uid = $this->session->userdata('user_id');
        $radiusKm  = 50;
        $proximity = $this->mathGeoProximity($lat, $lng, $radiusKm);
        $this->db->select('*')->from('sh_users');
        $this->db->where('user_lat BETWEEN "'. number_format($proximity['latitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['latitudeMax'], 12, '.', '').'"');
        $this->db->where('user_lng BETWEEN "'. number_format($proximity['longitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['longitudeMax'], 12, '.', '').'"');
        $this->db->where('id !=', $uid);
        return $this->db->get()->result_array();
    }

    public function getCountNearPeople(){
        $uid = $this->session->userdata('user_id');
        $lat = isset($_SESSION['cur_lat']) ? $_SESSION['cur_lat'] : '';
        $lng = isset($_SESSION['cur_lng']) ? $_SESSION['cur_lng'] : '';
        $radiusKm  = 50;
        $proximity = $this->mathGeoProximity($lat, $lng, $radiusKm);
        $this->db->select('*')->from('sh_users');
        $this->db->where('user_lat BETWEEN "'. number_format($proximity['latitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['latitudeMax'], 12, '.', '').'"');
        $this->db->where('user_lng BETWEEN "'. number_format($proximity['longitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['longitudeMax'], 12, '.', '').'"');
        $this->db->where('id !=', $uid);
        $this->db->where('isAvail', true);
        return $this->db->get()->num_rows();
    }

    public function getNearPeople(){
        $limit        = $_SESSION['per_page'];
        $start        = $_SESSION['page'];
        $length_value = $_SESSION['length_value'];
        $length       = $_SESSION['length'];
        $uid = $this->session->userdata('user_id');
        $lat = isset($_SESSION['cur_lat']) ? $_SESSION['cur_lat'] : '';
        $lng = isset($_SESSION['cur_lng']) ? $_SESSION['cur_lng'] : '';

        if($length=='km'){
            $radiusKm  = ((int) $length_value); 
        }

        if($length=='mi'){
            $radiusKm  = ((int) $length_value)  * 0.621371192; 
        }

        if($length=='m'){
            $radiusKm  = ((int) $length_value)  * 0.001; 
        }

        $proximity = $this->mathGeoProximity($lat, $lng, $radiusKm);
        $this->db->select('*')->from('sh_users');
        $this->db->where('user_lat BETWEEN "'. number_format($proximity['latitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['latitudeMax'], 12, '.', '').'"');
        $this->db->where('user_lng BETWEEN "'. number_format($proximity['longitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['longitudeMax'], 12, '.', '').'"');
        $this->db->where('id !=', $uid);
        $this->db->where('isAvail', true);
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

    public function get_available_user(){
        $uid = $this->session->userdata('user_id');
        $lat = isset($_SESSION['cur_lat']) ? $_SESSION['cur_lat'] : $this->input->post('cur_lat');
        $lng = isset($_SESSION['cur_lng']) ? $_SESSION['cur_lng'] : $this->input->post('cur_lng');
        $radiusKm  = 50; 
        $proximity = $this->mathGeoProximity($lat, $lng, $radiusKm);
        $this->db->select('*')->from('sh_users');
        $this->db->where('user_lat BETWEEN "'. number_format($proximity['latitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['latitudeMax'], 12, '.', '').'"');
        $this->db->where('user_lng BETWEEN "'. number_format($proximity['longitudeMin'], 12, '.', ''). '" and "'. number_format($proximity['longitudeMax'], 12, '.', '').'"');
        if($this->input->post('book_avail_from') && $this->input->post('book_avail_to')){
            $book_avail_from = date('Y-m-d', strtotime($this->input->post('book_avail_from')));
            $book_avail_to   = date('Y-m-d', strtotime($this->input->post('book_avail_to')));
            $this->db->where('STR_TO_DATE(book_avail_from, "%Y-%m-%d") >=', $book_avail_from);
            $this->db->where('STR_TO_DATE(book_avail_to, "%Y-%m-%d") <=', $book_avail_to);
        } else{
            $current_date = date('Y-m-d');
            $this->db->where('STR_TO_DATE(book_avail_from, "%Y-%m-%d") >=', $current_date);
        }
        
        $this->db->where('isAvail', true);
        $this->db->where('book_type', $this->input->post('book_type'));
        return $this->db->get()->result_array();
    }

    

    /* Working and Important Formula ================================================================*/

    // calculate geographical proximity
    public function mathGeoProximity( $latitude, $longitude, $radius){
        // $radius = $miles ? $radius : ($radius * 0.621371192);
        $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
        $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
        $lat_min = $latitude - ($radius / 69);
        $lat_max = $latitude + ($radius / 69);

        return array(
            'latitudeMin'  => $lat_min,
            'latitudeMax'  => $lat_max,
            'longitudeMin' => $lng_min,
            'longitudeMax' => $lng_max
        );
    }

    // calculate geographical distance between 2 points
    public function mathGeoDistance( $lat1, $lng1, $lat2, $lng2, $miles = false ){
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lng1 *= $pi80;
        $lat2 *= $pi80;
        $lng2 *= $pi80;

        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return ($miles ? ($km * 0.621371192) : $km);
    }

    /* Close Working and Important Formula ==========================================================*/

    
}