<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	public function __construct(){
		parent::__construct();
    }

    public function pagination_settings(){
        $data["use_page_numbers"] = TRUE;
        $data["full_tag_open"] = '<ul class="pagination">';
        $data["full_tag_close"] = '</ul>';
        $data["first_tag_open"] = '<li class="page-item">';
        $data["first_tag_close"] = '</a></li>';
        $data["last_tag_open"] = '<li class="page-item">';
        $data["last_tag_close"] = '</li>';
        $data["next_link"] = 'Next';
        $data["next_tag_open"] = '<li class="page-item">';
        $data["next_tag_close"] = '</li>';
        $data["prev_link"] = 'Previous';
        $data["prev_tag_open"] = '<li class="page-item">';
        $data["prev_tag_close"] = '</li>';
        $data["cur_tag_open"] = '<li class="page-item active"><a class="page-link" href="javascript:;">';
        $data["cur_tag_close"] = '</a></li>';
        $data["num_tag_open"] = '<li class="page-item">';
        $data["num_tag_close"] = '</li>';
        $data["num_links"] = 2;
        $data['attributes'] = array('class' => 'page-link');
        return $data;
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
            'fullname'         => $this->input->post('fullname'),
            'email'            => $email,
            'occupation'       => $this->input->post('occupation'),
            'mobile_number'    => $this->input->post('mobile_number'),
            'gender'           => $this->input->post('gender'),
            'complete_address' => $this->input->post('complete_address'),
            'user_lat'         => $this->input->post('user_lat'),
            'user_lng'         => $this->input->post('user_lng'),
            'zip_code'         => $this->input->post('zip_code'),
            'bio'              => $this->input->post('bio'),
            'is_complete'      => 1,
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
        if (!is_dir('./assets/img/pictures/usr'.$uid."/")) {
            mkdir('./assets/img/pictures/usr'.$uid."/");
            $target_path = './assets/img/pictures/usr'.$uid."/";
        } else{
            $target_path = "./assets/img/pictures/usr".$uid."/";
        }

        $imgName = 'p'.'_'.uniqid().".jpg"; 
        $data = explode(',', $this->input->post('img_data'));
        $decoded = base64_decode($data[1]);
        $status = file_put_contents($target_path.$imgName,$decoded); 
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
        $this->db->select('sh_pets.pet_name, sh_pets.pet_id, sh_pets.primary_pic, sh_category.cat_name, sh_breeds.breed_name, sh_pets.description, sh_pets.isAvailable')->from('sh_pets');
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
        $this->db->select('complete_address,zip_code')->from('sh_users');
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
        foreach($this->input->post('pet_cat_list') as $cat_id){
            $cat_list[] = $cat_id;
        }
        $data = array(
            'book_avail_from' => $book_avail_from,
            'book_avail_to'   => $book_avail_to,
            'cat_list'        => json_encode($cat_list),
            'book_type'       => $this->input->post('book_type'),
            'book_note'       => $this->input->post('book_note'),
            'isAvail'         => true,
        );
        $this->db->where('id', $uid);
        $res = $this->db->update('sh_users', $data);
        return ($res) ? true : false;
    }

    public function need_sitter_set_time(){
        $uid = $this->session->userdata('user_id');
        $ns_date_from[] = $this->input->post('ns_date_from');
        $ns_date_from[] = $this->input->post('ns_time_start');
        $ns_date_to[] = $this->input->post('ns_date_to');
        $ns_date_to[] = $this->input->post('ns_time_end');
        $ndf = json_encode($ns_date_from);
        $ndt = json_encode($ns_date_to);
        $emptyDate = array(
            'ns_date_from' => '',
            'ns_date_to'   => '',
            'isAvailable'  => false,
        );

        $ures = $this->db->update('sh_pets', $emptyDate);
        if($ures){
            $data = array(
                'ns_date_from' => $ndf,
                'ns_date_to'   => $ndt,
                'isAvailable'  => true,
            );

            foreach($this->input->post('pet_list') as $k=>$v){
                $this->db->where('pet_id', $v);
                $this->db->update('sh_pets', $data);
            }
            $data = array('isAvail'=>true);
            $this->db->where('id', $uid);
            $res = $this->db->update('sh_users', $data);
            return ($res) ? 1 : 0;
        } else{
            return 0;
        }
    }

    public function update_need_pet_sitter($pid){
        $ns_date_from[] = $this->input->post('ns_date_from');
        $ns_date_from[] = $this->input->post('ns_time_start');
        $ns_date_to[] = $this->input->post('ns_date_to');
        $ns_date_to[] = $this->input->post('ns_time_end');
        $ndf = json_encode($ns_date_from);
        $ndt = json_encode($ns_date_to);
        $data = array(
            'ns_date_from' => $ndf,
            'ns_date_to'   => $ndt
        );

        $this->db->where('pet_id', $pid);
        $res = $this->db->update('sh_pets', $data);
        return ($res) ? 1 : 0;
    }

    public function get_date(){
        $this->db->select('sitter_availability')->from('sh_users');
        $this->db->where('id',$this->session->userdata('user_id'));
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function get_users_images($user_id, $limit){
        $this->db->select('*')->from('sh_images');
        $this->db->where('user_id', $user_id);
        if($limit){
            $this->db->limit($limit);
        }
        return $this->db->get()->result_array();
    }

    public function get_my_pets_to_sit($uid){
        $this->db->select('*')->from('sh_pets');
        $this->db->join('sh_category', 'sh_category.cat_id=sh_pets.cat_id', 'left');
        $this->db->join('sh_breeds',   'sh_breeds.breed_id=sh_pets.breed_id', 'left');
        $this->db->where('user_id', $uid);
        $this->db->where('isAvailable',true);
        $data = $this->db->get()->result_array();
        return $data;
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

    public function resetDate($t){
        $uid = $this->session->userdata('user_id');
        $emptyDate1 = array(
            'ns_date_from' => '',
            'ns_date_to'   => '',
            'isAvailable'  => false,
        );

        if($t==1){
            $this->db->select('pet_id')->from('sh_pets')->where('isAvailable', true);
            $checkPet = $this->db->get()->num_rows();
            $emptyDate2 = ($checkPet > 0) ? array('sitter_availability' => '') : array('sitter_availability' => '', 'isAvail'=>false);
            $this->db->where('id', $uid);
            $res = $this->db->update('sh_users', $emptyDate2);
        } else{
            $this->db->where('id', $uid);
            $this->db->where('sitter_availability !=', '');
            $checkAvail = $this->db->get('sh_users')->num_rows();

            if($checkAvail == 0){
                $this->db->set('isAvail', false);
                $this->db->where('id', $uid);
                $this->db->update('sh_users');
            }

            $this->db->where('user_id', $uid);
            $res = $this->db->update('sh_pets', $emptyDate1);
        }
        
        return ($res) ? 1 : 0;
    }

    public function update_new_password($newPass,$email){
        $this->db->where('email', $email);
        $this->db->set('password', md5($newPass));
        $res = $this->db->update('sh_users');
        return ($res) ? true : false;
    }
}