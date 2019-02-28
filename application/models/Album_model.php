<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function add_albums($albumdata){
		$this->db->trans_start();
		$this->db->insert('sh_albums', $albumdata);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
	}

	public function get_all_albums($user_id) {
		$this -> db -> select('a.album_id,a.album_name, a.album_desc, a.album_img, a.created_at');
		$this -> db -> from('sh_albums a');
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
			
}