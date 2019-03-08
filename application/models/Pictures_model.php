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
    
    public function remove_from_album($imgID){
        $data = array('album_id'=> 0);
		$this->db->set($data);
		$this->db->where('img_id', $imgID);
        $res = $this->db->update('sh_images');
        return ($res) ? true : false;
    }
    
    public function delete_image($imgID, $imgName){
        $uid = $this->session->userdata('user_id');
        $filename = './assets/img/pictures/usr'.$uid."/".$imgName;

        if(file_exists($filename)){
            unlink($filename);
        }

		$this->db->where('img_id', $imgID);
        $res = $this->db->delete('sh_images');
        return ($res) ? true : false;
	}
}