<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friends_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function search_keywords($keywords){
        $this->db->select('*')->from('sh_users');
        $this->db->or_like(array('fullname' => $keywords, 'email' => $keywords));
        return $this->db->get()->result_array();   
	}
	
	public function get_my_pets($uid){
		$this->db->select('sh_pets.pet_name,sh_pets.pet_id,sh_category.cat_name')->from('sh_pets');
		$this->db->join('sh_category', 'sh_category.cat_id=sh_pets.cat_id', 'left');
        $this->db->where('sh_pets.user_id', $uid);
        return $this->db->get()->result_array();   
	}
	
	public function get_my_friends(){
		$uid = $this->session->userdata('user_id');
		$this->db->select('*')->from('sh_friends');
		$this->db->join('sh_users', 'sh_users.id=sh_friends.friend_id', 'left');
		$this->db->where('sh_friends.user_id', $uid);
        return $this->db->get()->result_array();   
    }
	
	public function get_my_friend_request(){
		$uid = $this->session->userdata('user_id');
		$this->db->select('*')->from('sh_friend_request');
		$this->db->join('sh_users', 'sh_users.id=sh_friend_request.user_id', 'left');
		$this->db->where('sh_friend_request.user_req_to ', $uid);
		return $this->db->get()->result_array();   
	}

	public function get_friend_i_request(){
		$uid = $this->session->userdata('user_id');
		$this->db->select('*')->from('sh_friend_request');
		$this->db->join('sh_users', 'sh_users.id=sh_friend_request.user_req_to', 'left');
		$this->db->where('sh_friend_request.user_id', $uid);
		return $this->db->get()->result_array();   
	}
	
	public function request_friends($uid, $type){
		$my_id = $this->session->userdata('user_id');
		switch($type){
			case 1:
				$data = array(
					'user_id' => $my_id,
					'user_req_to' => $uid,
				);
				$res = $this->db->insert('sh_friend_request', $data);
			break;
			case 2:
				$this->db->where('user_id', $my_id);
				$this->db->where('user_req_to', $uid);
				$res = $this->db->delete('sh_friend_request');
			break;
			case 3:
				$this->db->where('user_id', $my_id);
				$this->db->where('friend_id', $uid);
				$res = $this->db->delete('sh_friends');

				$this->db->where('user_id', $uid);
				$this->db->where('friend_id', $my_id);
				$res = $this->db->delete('sh_friends');

			break;
			case 4:
				$this->db->where('user_id', $my_id);
				$this->db->where('friend_id', $uid);
				$res = $this->db->delete('sh_friend_request');

				$data = array(
					'user_id' => $my_id,
					'friend_id' => $uid,
				);
				$res = $this->db->insert('sh_friends', $data);

			break;
		}
        
		return ($res) ? true : false;
	}

	public function process_request($rid, $uid, $type){
		$my_id = $this->session->userdata('user_id');
		switch($type){
			case 1:
				$this->db->where('req_id', $rid);
				$res = $this->db->delete('sh_friend_request');

				$data = array(
					'user_id' => $my_id,
					'friend_id' => $uid,
				);
				$res = $this->db->insert('sh_friends', $data);

				$data = array(
					'user_id' => $uid,
					'friend_id' => $my_id,
				);
				$res = $this->db->insert('sh_friends', $data);
			break;
			case 2:
				$this->db->where('req_id', $rid);
				$res = $this->db->delete('sh_friend_request');
			break;
		}
        
		return ($res) ? true : false;
	}

	public function check_friend_request($uid){
		$my_id = $this->session->userdata('user_id');
		$this->db->where("user_id", $my_id);
        $this->db->where("user_req_to", $uid);
		$query = $this->db->get("sh_friend_request");

		return ($query->num_rows() > 0) ? true : false;
	}
	
	public function check_if_friends($uid){
		$my_id = $this->session->userdata('user_id');
		$this->db->where("user_id", $my_id);
        $this->db->where("friend_id", $uid);
		$query = $this->db->get("sh_friends");

		return ($query->num_rows() > 0) ? true : false;
	}
	
	public function check_request_friend(){
		$my_id = $this->session->userdata('user_id');
		$this->db->where("user_id", $my_id);
		$query = $this->db->get("sh_friend_request");

		return ($query->num_rows() > 0) ? true : false;
	}

	public function count_friend_request(){
		$my_id = $this->session->userdata('user_id');
		$this->db->where("user_req_to ", $my_id);
		$query = $this->db->get("sh_friend_request");

		return $query->num_rows();
	}
	public function get_my_friends_count(){
		$uid = $this->session->userdata('user_id');
		$this->db->select('*')->from('sh_friends');
		$this->db->join('sh_users', 'sh_users.id=sh_friends.friend_id', 'left');
        $this->db->where('sh_friends.user_id', $uid);
        return $this->db->get()->num_rows();   
	}
	public function get_my_friends_pagi($limit, $start){
		$uid = $this->session->userdata('user_id');
		$this->db->select('*')->from('sh_friends');
		$this->db->join('sh_users', 'sh_users.id=sh_friends.friend_id', 'left');
		$this->db->where('sh_friends.user_id', $uid);
		$this->db->limit($limit,$start);
        return $this->db->get()->result_array();   
	}
	public function search_keywords_count($keywords){
        $this->db->select('*')->from('sh_users');
        $this->db->or_like(array('fullname' => $keywords, 'email' => $keywords));
        return $this->db->get()->num_rows();   
	}
	public function search_keywords_pagi($keywords, $limit,$start){
		$this->db->select('*')->from('sh_users');
		$this->db->limit($limit,$start);
		$this->db->or_like(array('fullname' => $keywords, 'email' => $keywords));
        return $this->db->get()->result_array();   
	}
	public function get_my_friend_request_pagi($limit, $start){
		$uid = $this->session->userdata('user_id');
		$this->db->select('*')->from('sh_friend_request');
		$this->db->join('sh_users', 'sh_users.id=sh_friend_request.user_id', 'left');
		$this->db->where('sh_friend_request.user_req_to ', $uid);
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();   
	}
	public function get_my_friend_request_count(){
		$uid = $this->session->userdata('user_id');
		$this->db->select('*')->from('sh_friend_request');
		$this->db->join('sh_users', 'sh_users.id=sh_friend_request.user_id', 'left');
		$this->db->where('sh_friend_request.user_req_to ', $uid);
		return $this->db->get()->num_rows();   
	}
}
