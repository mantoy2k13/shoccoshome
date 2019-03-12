<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }
    
    public function check_email($email){
        $this->db->select('*')->from('sh_users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? true : false;
    }

    public function update_profile_info($email){
        $uid = $this->session->userdata('user_id');
        $data = array(
            'fullname'      => $this->input->post('fullname'),
            'email'         => $email,
            'occupation'    => $this->input->post('occupation'),
            'mobile_number' => $this->input->post('mobile_number'),
            'gender'        => $this->input->post('gender'),
            'address'       => $this->input->post('address'),
            'country'       => $this->input->post('country'),
            'state'         => $this->input->post('state'),
            'city'          => $this->input->post('city'),
            'street'        => $this->input->post('street'),
            'zip_code'      => $this->input->post('zip_code'),
            'bio'           => $this->input->post('bio'),
            'is_complete'   => 1,
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
        $uid         = $this->session->userdata('user_id');
        $img_data    = $this->input->post('prof_img_data');
        $old_img     = $this->input->post('prof_old_img');
        $target_path = './assets/img/pictures/';
        
        $filename = './assets/img/pictures/usr'.$uid."/".$old_img;
        if(file_exists($filename)){
            unlink($filename);
        }

        if (!is_dir('./assets/img/pictures/usr'.$uid."/")) {
            mkdir('./assets/img/pictures/usr'.$uid."/");
            $target_path = './assets/img/pictures/usr'.$uid."/";
        } else{
            $target_path = "./assets/img/pictures/usr".$uid."/";
        }

        $imgName = 'p'.$uid.'_'.uniqid().".jpg"; 
        $data    = explode(',', $img_data);
        $decoded = base64_decode($data[1]);
        $status  = file_put_contents($target_path.$imgName,$decoded); 
        if($status){
            $data = array('user_img' => $imgName);
            $this->db->where('id', $uid);
            $res = $this->db->update('sh_users', $data);
            return ($res) ? true : false;
        }else{
            return false;
        }
    }

    public function get_user_info(){
        $this->db->select('*')->from('sh_users');
        $this->db->where('id', $this->session->userdata('user_id'));
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function view_bio($uid){
        $this->db->select('*')->from('sh_users');
        $this->db->where('id',$uid);
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function get_my_pets($uid){
        $this->db->select('sh_pets.pet_name, sh_pets.pet_id, sh_pets.primary_pic, sh_category.cat_name, sh_breeds.breed_name, sh_pets.description')->from('sh_pets');
        $this->db->join('sh_category', 'sh_category.cat_id=sh_pets.cat_id', 'left');
        $this->db->join('sh_breeds',   'sh_breeds.breed_id=sh_pets.breed_id', 'left');
        $this->db->where('sh_pets.user_id',$uid);
        $data = $this->db->get()->result_array();
        return $data;
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
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function compLater(){
        $this->db->set('is_complete', 2);
        $this->db->where('id', $this->session->userdata('user_id'));
        $res = $this->db->update('sh_users');
        return ($res) ? true : false;
    }

    public function getAddress(){
        $this->db->select('country,state,city,street,zip_code')->from('sh_users');
        $this->db->where('id', $this->session->userdata('user_id'));
        $data = $this->db->get()->result_array();
        return $data;
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
}