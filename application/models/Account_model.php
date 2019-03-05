<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }
    
    public function email_check($email){
        $this->db->select('*');
        $this->db->from('sh_users');
        $this->db->where('email',$email);
        $query=$this->db->get();
        return ($query->num_rows()>0) ? false : true;
    }

    public function updateuserdata($user_up){
        $this->db->set($user_up);
        $this->db->where('id',$user_up['id']);
        $data = $this->db->update('sh_users');
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
}