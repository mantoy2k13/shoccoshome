<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }

    public function check_email($email){
        $this->db->select('*')->from('sh_users')->where('email', $email);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? true : false;
    }

/* Working Codes ================================================================*/

    public function update_profile_info(){
        $uid    = $this->session->userdata('user_id');
        $email  = $this->input->post('email');
        $en_add = array(
            'street_number'  => $this->input->post('street_number'),
            'street_address' => $this->input->post('street_address'),
            'city'           => $this->input->post('city'),
            'state'          => $this->input->post('state'),
            'country'        => $this->input->post('country'),
            'zip_code'       => $this->input->post('zip_code'),
        );
        $data = array(
            'fullname'         => $this->input->post('fullname'),
            'email'            => $email,
            'occupation'       => $this->input->post('occupation'),
            'mobile_number'    => $this->input->post('mobile_number'),
            'gender'           => $this->input->post('gender'),
            'complete_address' => $this->input->post('complete_address'),
            'user_lat'         => $this->input->post('user_lat'),
            'user_lng'         => $this->input->post('user_lng'),
            'zip_code'         => $this->input->post('zip_code'),
            'is_smoker'        => $this->input->post('is_smoker'),
            'living_in'        => $this->input->post('living_in'),
            'bio'              => $this->input->post('bio'),
            'is_complete'      => 1,
            'en_address'       => json_encode($en_add)
        );
        $this->db->where('id', $uid);
        $res = $this->db->update('sh_users', $data);
        if($res){
            $data = array('user_email' => $email);
            $this->session->set_userdata($data);
            return true;
        }else{
            return false;
        }
    }

    public function update_profile_pic(){
        $uid = $this->session->userdata('user_id');
        if($_FILES["user_img"]){
            $target_path = './assets/img/pictures/usr'.$uid."/";
            $imgName = 'p'.'_'.uniqid().".jpg"; 
            $status = move_uploaded_file($_FILES["user_img"]["tmp_name"],
            $target_path . $imgName);
            if($status){
                $data = array('user_img' => $imgName);
                $this->db->where('id', $uid);
                $this->db->update('sh_users', $data);
                $data = array('img_name'=> $imgName, 'user_id'=>$uid, 'album_id'=>0);
                $result = $this->db->insert('sh_images', $data);
                return ($result) ? true : false;
            }else{
                return false;
            }
        }
    }

    public function get_user_info($uid){
        $this->db->select('*')->from('sh_users')->where('id', $uid);
        $this->db->order_by('book_type', 'ASC');
        $this->db->order_by('fullname', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_my_pets($uid){
        $this->db->select('sh_pets.pet_name, sh_pets.pet_id, sh_pets.primary_pic, sh_category.cat_name, sh_breeds.breed_name, sh_pets.description, sh_pets.user_id')->from('sh_pets');
        $this->db->join('sh_category', 'sh_category.cat_id=sh_pets.cat_id', 'left');
        $this->db->join('sh_breeds',   'sh_breeds.breed_id=sh_pets.breed_id', 'left');
        $this->db->where('sh_pets.user_id',$uid);
        return $this->db->get()->result_array();
    }   

    public function relative_date($time) {
        $today = strtotime(date('M j, Y'));
        $hrs = date("h:i A", $time);
        $reldays = ($time - $today)/86400;

        if ($reldays >= 0 && $reldays < 1) {
            return 'Today, '.$hrs;
        } else if ($reldays >= 1 && $reldays < 2) {
            return 'Tomorrow, '.$hrs;
        } else if ($reldays >= -1 && $reldays < 0) {
            return 'Yesterday, '.$hrs;
        }
         
        if (abs($reldays) < 7) {
            if ($reldays > 0) {
                $reldays = floor($reldays);
                return 'In ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');
            } else {
                $reldays = abs(floor($reldays));
                return $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';
            }
        }
         
        if (abs($reldays) < 182) {
            return date('l, j F',$time ? $time : time());
        } else {
            return date('l, j F, Y',$time ? $time : time());
        }
    }

    public function is_complete(){
        $this->db->select('is_complete')->from('sh_users');
        $this->db->where('id', $this->session->userdata('user_id'));
        return $this->db->get()->row_array();
    }

    public function compLater(){
        $this->db->set('is_complete', 2);
        $this->db->where('id', $this->session->userdata('user_id'));
        $res = $this->db->update('sh_users');
        return ($res) ? true : false;
    }

    public function change_password(){
        $uid     = $this->session->userdata('user_id');
        $curPass = md5($this->input->post('curPass'));
        $npass   = md5($this->input->post('npass'));
        $this->db->where('id', $uid);
        $this->db->where('password', $curPass);
        $query = $this->db->get('sh_users');
        if($query->num_rows() > 0){
            $this->db->set('password', $npass);
            $this->db->where('id', $uid);
            $res = $this->db->update('sh_users');
            return ($res) ? true : false;
        } else{
            return false;
        }
    }

    public function setPrimaryImg($img_name){
        $this->db->set('user_img', $img_name);
		$this->db->where('id', $this->session->userdata('user_id'));
		$res = $this->db->update('sh_users');
		return ($res) ? true : false;
    }

    public function setCoverImg($img_name){
        $this->db->set('cover_photo', $img_name);
        $this->db->where('id', $this->session->userdata('user_id'));
        $res = $this->db->update('sh_users');
        return ($res) ? true : false;
    }

    public function setCoverPos($pos){
        $this->db->set('cover_pos', $pos);
        $this->db->where('id', $this->session->userdata('user_id'));
        $res = $this->db->update('sh_users');
        return ($res) ? true : false;
    }

    public function set_my_dates($book_avail_from, $book_avail_to){
        $uid = $this->session->userdata('user_id');
        // foreach($this->input->post('pet_cat_list') as $cat_id){
        //     $cat_list[] = $cat_id;
        // }
        // $data = array(
        //     'book_avail_from' => $book_avail_from,
        //     'book_avail_to'   => $book_avail_to,
        //     'cat_list'        => json_encode($cat_list),
        //     'book_type'       => $this->input->post('book_type'),
        //     'book_note'       => $this->input->post('book_note'),
        //     'isAvail'         => true,
        // );
        // $this->db->where('id', $uid);
        // $res = $this->db->update('sh_users', $data);
        // return ($res) ? true : false;
        $this->db->where('user_id', $uid);
        $this->db->delete('sh_user_avail');

        foreach($this->input->post('pet_cat_list') as $cat_id){
            $cat_list[] = $cat_id;
        }

        // var_dump($book_avail_from);
        // var_dump($book_avail_to);
        // exit;

        $getDates = $this->getDatesFromRange($book_avail_from, $book_avail_to);
        foreach($getDates as $d){    
            $data = array(
                'user_id' => $uid,
                'avail_date_from' => $d,
                'avail_date_to'   => $d,
                'petcat_list'     => json_encode($cat_list),
                'book_type'       => $this->input->post('book_type'),
                'book_note'       => $this->input->post('book_note')
            );
            $res = $this->db->insert('sh_user_avail', $data);                        
        }
        return ($res) ? true : false;
    }

    function getDatesFromRange($start, $end, $format = 'Y-m-d'){
		$array = array();
		$interval = new DateInterval('P1D');
		$realEnd = new DateTime($end);
		$realEnd->add($interval);
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
		foreach($period as $date){
			$array[] = $date->format($format);
		}
		return $array;
	}

    public function get_users_images($user_id, $limit){
        $this->db->select('*')->from('sh_images');
        $this->db->where('user_id', $user_id);
        if($limit){
            $this->db->limit($limit);
        }
        return $this->db->get()->result_array();
    }

    public function unset_dates($t){
        $uid = $this->session->userdata('user_id');
        $data = array(
            'book_avail_from' => '',
            'book_avail_to'   => '',
            'cat_list'        => '',
            'book_type'       => '',
            'book_note'       => '',
            'isAvail'         => false,
        );
        $this->db->where('id', $uid);
        $res = $this->db->update('sh_users', $data);
        return ($res) ? true : false;
    }

    public function update_new_password($newPass,$email){
        $this->db->where('email', $email);
        $this->db->set('password', md5($newPass));
        $res = $this->db->update('sh_users');
        return ($res) ? true : false;
    }

    /* Close Working Codes ================================================================*/
    
}