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

    public function count_all_pictures(){
        $uid = $this->session->userdata('user_id');
		return $this->db->where('user_id', $uid)->get('sh_images')->num_rows();
    }

    public function get_my_pictures($limit, $start) {
        $uid = $this->session->userdata('user_id');
        $this->db->where('user_id', $uid);
        $this->db->limit($limit, $start);
		return $this->db->get('sh_images')->result_array();
    }

    public function get_img_no_album(){
        $uid = $this->session->userdata('user_id');
		$this->db->where('user_id', $uid);
		$this->db->where('album_id', 0);
		return $this->db->get('sh_images')->result_array();
    }

    public function count_all_photos(){
        $uid = $this->session->userdata('user_id');
		$this->db->where("user_id ", $uid);
		$cnt = $this->db->get("sh_images");
        return ($cnt) ? $cnt->num_rows() : 0;
	}
    
    public function update_img_album($imgID, $album_id){
        $data = array('album_id'=> $album_id);
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
    
    public function delete_all_image(){
        $uid = $this->session->userdata('user_id');
        // Remove Images in directory
        $path = './assets/img/pictures/usr'.$uid;
        array_map('unlink', glob("$path/*.*"));
        rmdir($path);

        // Delete all images in database
        $this->db->where('user_id', $uid);
        $res = $this->db->empty_table('sh_images');
        return ($res) ? true : false;
    }

    public function get_image_name($imgID) {
		$this->db->select('img_name')->from('sh_images');
		$this->db->where('img_id', $imgID);
		return $this->db->get()->row_array();
    }
    
    public function get_album_name($album_id) {
		$this->db->select('album_name')->from('sh_albums');
		$this->db->where('album_id', $album_id);
		return $this->db->get()->row_array();
	}
}