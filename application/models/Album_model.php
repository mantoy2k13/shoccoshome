<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function save_album($album_id){
		$data = array(
			'user_id'	 => $this->session->userdata('user_id'),
			'album_name' =>$this->input->post('album_name'),
			'album_desc' =>$this->input->post('album_desc')
		);
		if($album_id){
			$this->db->where('album_id', $album_id);
			$result = $this->db->update('sh_albums', $data);
		} else{
			$result = $this->db->insert('sh_albums', $data);
		}
		return ($result) ? true : false;
	}

	public function get_all_albums($user_id, $limit, $start) {
		$this->db->select('*')->from('sh_albums');
		$this->db->where('user_id', $user_id);
		$this->db->limit($limit, $start);
		$this->db->order_by("album_id", "desc");
		return $this->db->get()->result_array();
	}

	public function update_album($album_id, $data){
		$this->db->where('album_id', $album_id);
        $res = $this->db->update('sh_albums', $data);
        return ($res) ? true : false;
	}

	public function delete_album($album_id){
		$this->db->where('album_id', $album_id);
		$res = $this->db->delete('sh_albums');
		if($res){
			$this->db->set('album_id', 0);
			$this->db->where('album_id', $album_id);
			$res = $this->db->update('sh_images');
			return ($res) ? true : false;
		} return false;
	}

	public function get_album_details($album_id){
		$this->db->select('*')->from('sh_albums')->where('album_id', $album_id);
		return $this->db->get()->row_array();
	}

	public function view_album($album_id) {
		$this->db->select('album_name, album_desc, album_id')->from('sh_albums');
		$this->db->where('album_id', $album_id);
		return $this->db->get()->row_array();
	}

	public function view_album_images($album_id) {
		$this->db->select('*')->from('sh_images');
		$this->db->where('album_id', $album_id);
		return $this->db->get()->result_array();
	}		

	public function count_images($album_id){
		$this->db->where("album_id ", $album_id);
		$cnt = $this->db->get("sh_images");
        return ($cnt) ? $cnt->num_rows() : 0;
	}
	
	public function count_album($uid){
		$this->db->where("user_id ", $uid);
		$cnt = $this->db->get("sh_albums");
        return ($cnt) ? $cnt->num_rows() : 0;
	}
	
	public function get_single_image($album_id){
		$this->db->where("album_id ", $album_id);
        return $this->db->get("sh_images")->row_array();
	}
	public function count_all_pictures_album($album_id){
		return $this->db->where('album_id', $album_id)->get('sh_images')->num_rows();
	}

	public function view_album_images_pagi($limit, $start, $album_id) {
		$this->db->select('*')->from('sh_images');
		$this->db->where('album_id',$album_id);
		$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
	}
}