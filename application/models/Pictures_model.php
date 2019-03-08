<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pictures_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }

    public function insert_images($imgName, $uid, $album_id){
		$data = array('img_name'=> $imgName, 'user_id'=>$uid, 'album_id'=>$album_id);
		$result = $this->db->insert('sh_images', $data);
		return ($result) ? true : false;
    }
    
    public function get_all_pictures(){
        $uid = $this->session->userdata('user_id');
		$this->db->where('user_id', $uid);
		return $this->db->get('sh_images')->result_array();
	}
}