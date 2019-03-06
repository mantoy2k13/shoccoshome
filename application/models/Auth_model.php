<?php
class Auth_model extends CI_model{
    function __construct(){
        parent::__construct();
    }
    
    public function email_check($email){
        $this->db->select('*');
        $this->db->from('sh_users');
        $this->db->where('email',$email);
        $query=$this->db->get();
        return ($query->num_rows()>0) ? false : true;
    }

    public function register_user($user){
        $this->db->insert('sh_users', $user);
    }

        
    public function fetchuserlogindata($uemail){
        $this->db->select('*');
        $this->db->from('sh_users');
        $this->db->where('email', $uemail);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_all_users_data() {
        $this -> db -> select('');
		$this -> db -> from('sh_users');
        $this->db->order_by("id", "asc");
        $this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
    }

    public function userlogin($uemail,$upass){
        $this->db->select('*');
        $this->db->from('sh_users');
        $this->db->where('email', $uemail);
        $this->db->where('password', $upass);
        $query = $this->db->get();
        return $query->row();
    }

    public function check_user_if_exist($email, $password){
        $this->db->where("email", $email);
        $this->db->where("password", $password);
		$query = $this->db->get("sh_users");
        if($query->num_rows() > 0){
            foreach($query->result() as $rows){//add all data to session
				$userdata = array(
					'user_id' 		  => $rows->id,
					'fullname' 		  => $rows->fullname,
					'user_email'      => $rows->email,
                    'is_logged_in' 	  => TRUE,
                    'is_social'       => FALSE
				);
			}
            $this->session->set_userdata($userdata);
            return true;
        }
        return false;
    }


    public function loginFB(){
        $email = $this->input->post('email');
        $fullname = $this->input->post('fullname');
        $socID = $this->input->post('socID');
        $this->db->where("email", $email);
		$query = $this->db->get("sh_users");
        if($query->num_rows() > 0){
            foreach($query->result() as $rows){
				$userdata = array(
					'user_id' 		  => $rows->id,
					'fullname' 		  => $rows->fullname,
					'user_email'      => $rows->email,
                    'is_logged_in' 	  => TRUE,
                    'is_social'       => 'fb'
				);
			}
            $this->session->set_userdata($userdata);
            return true;
        } else{
            $data = array(
                'email'    => $email,
                'fullname' => $fullname
            );
            $this->db->insert('sh_users', $data);
            $uid = $this->db->insert_id();
            
            if($uid){
                define('DIRECTORY', './assets/img/profile_pics/');
                $content = file_get_contents('http://graph.facebook.com/'.$socID.'/picture?width=999');
                $filename = 'pp_'.time().'.png';
                $res = file_put_contents(DIRECTORY . $filename, $content);

                if($res){
                    $this->db->set('user_img', $filename);
                    $this->db->where('id', $uid);
                    $update = $this->db->update('sh_users');
                    if($update){
                        $userdata = array(
                            'user_id' 		  => $uid,
                            'fullname' 		  => $fullname,
                            'user_email'      => $email,
                            'is_logged_in' 	  => TRUE,
                            'is_social'       => 'fb'
                        );
                        $this->session->set_userdata($userdata);
                        return true;
                    } else{ return false; } 
                } else{ return false; } 
            } else{ return false; }   
        }
        return false;
    }
}