<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function add_albums(){
		$albumdata = array(
			'user_id'=> $this->input->post('user_id'),
			'album_name'=>$this->input->post('album_name'),
			'album_desc'=>$this->input->post('album_desc')
		);
		$result = $this->db->insert('sh_albums', $albumdata);
		return ($result) ? true : false;
	}

	public function get_all_albums($user_id) {
		$this->db->select('a.album_id,a.album_name, a.album_desc, a.album_img, a.created_at');
		$this->db->from('sh_albums a');
		$this->db->join('sh_users u', 'a.user_id=u.id', 'inner');
		$this->db->order_by("a.album_id", "desc");
		$this->db->where('a.user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
		
	}

	public function update_album($album_id,$data){
		$this->db->where('album_id', $album_id);
        $res = $this->db->update('sh_albums', $data);
        return ($res) ? true : false;
	}

	public function delete_album($album_id){
		$this->db->where('album_id', $album_id);
		$res = $this->db->delete('sh_albums');
		return ($res) ? true : false;
	}
			
}