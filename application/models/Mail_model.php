<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function send_messages(){
        $mail_to = $_POST['mail_to'];
        foreach($mail_to as $mid){
            $data = array(
                'user_id'   => $this->session->userdata('user_id'),
                'mail_to'   => $mid,
                'subject'   => $this->input->post('subject'),
                'message'   => $this->input->post('message'),
                'parent_id' => $this->input->post('parent_id'),
            );

            $res = $this->db->insert('sh_mail', $data);
           
        } 
        return ($res) ? true : false;
    }

    public function update_message($mid){
        $data = array(
            'subject'   => $this->input->post('subject'),
            'message'   => $this->input->post('message')
        );
        $this->db->where('mail_id', $mid);
        $res = $this->db->update('sh_mail', $data);
        return ($res) ? true : false;
    }
    
    public function get_mails(){
        $my_id = $this->session->userdata('user_id');
        $this->db->select('*')->from('sh_mail');
		$this->db->join('sh_users', 'sh_users.id=sh_mail.user_id', 'left');
        $this->db->where('sh_mail.mail_to', $my_id);
        $this->db->where('sh_mail.drft_by_mailto', false); 
        $this->db->where('sh_mail.del_by_mailto', false);
        $this->db->order_by('mail_id', 'desc');
        return $this->db->get()->result_array();   
    }

    public function get_sent_msg(){
        $my_id = $this->session->userdata('user_id');
        $this->db->select('*')->from('sh_mail');
		$this->db->join('sh_users', 'sh_users.id=sh_mail.mail_to', 'left');
        $this->db->where('sh_mail.user_id', $my_id);
        $this->db->where('sh_mail.del_by_uid', false);
        $this->db->order_by('mail_id', 'desc');
        return $this->db->get()->result_array();   
    }

    public function get_drafts(){
        $my_id = $this->session->userdata('user_id');
        $this->db->select('*')->from('sh_mail');
		$this->db->join('sh_users', 'sh_users.id=sh_mail.user_id', 'left');
        $this->db->where('sh_mail.mail_to', $my_id);
        $this->db->where('sh_mail.drft_by_mailto', true);
        $this->db->order_by('mail_id', 'desc');
        return $this->db->get()->result_array();   
    }

    public function view_message($mid, $type){
        $this->db->select('sh_mail.*, sh_users.id, sh_users.fullname, sh_users.email')->from('sh_mail');
        $this->db->join('sh_users', 'sh_users.id=sh_mail.user_id', 'left');
        $this->db->where('sh_mail.mail_id', $mid);
        $res = $this->db->get()->result_array();

        if($type == 1){
            $this->db->set('is_read', 1);
            $this->db->where('mail_id', $mid);
            $this->db->update('sh_mail');
            return $res;
        }
        return $res;
    }

    public function move_to_drafts($mid){
        $this->db->set('drft_by_mailto', true);
        $this->db->where('mail_id', $mid);
        $this->db->update('sh_mail');
        return ($res) ? true : false;
    }

    public function delete_message($mid, $type){
        $this->db->select('sh_mail.del_by_mailto, sh_mail.del_by_uid');
        $this->db->where('mail_id', $mid);
        $data = $this->db->get("sh_mail")->result_array(0);
        $del_by_mailto  = $data[0]['del_by_mailto'];
        $del_by_uid     = $data[0]['del_by_uid'];

        if($type==1){
            if($del_by_uid){
                $this->db->where('mail_id', $mid);
                $res = $this->db->delete('sh_mail');
                return ($res) ? true : false;
            } else{
                $this->db->set('del_by_mailto', 1);
                $this->db->where('mail_id', $mid);
                $res = $this->db->update('sh_mail');
                return ($res) ? true : false;
            }
        } else{
            if($del_by_mailto){
                $this->db->where('mail_id', $mid);
                $res = $this->db->delete('sh_mail');
                return ($res) ? true : false;
            } else{
                $this->db->set('del_by_uid', 1);
                $this->db->where('mail_id', $mid);
                $res = $this->db->update('sh_mail');
                return ($res) ? true : false;
            }
        }
    }

    public function count_mail(){
		$my_id = $this->session->userdata('user_id');
		$this->db->where("mail_to ", $my_id);
		$this->db->where("is_read ", false);
		$query = $this->db->get("sh_mail");

		return $query->num_rows();
    }
    
    public function count_mail_w_notif(){
        $my_id = $this->session->userdata('user_id');
        $this->db->select('sh_mail.mail_id,sh_mail.notify, sh_mail.subject, sh_users.id, sh_users.fullname, sh_users.email')->from('sh_mail');
        $this->db->join('sh_users', 'sh_users.id=sh_mail.user_id', 'left');
		$this->db->where("sh_mail.mail_to ", $my_id);
        $this->db->where("sh_mail.notify ", false);
		$query = $this->db->get()->result_array();
		return $query;
    }
    
    public function cNotif($mid){
        $this->db->set('notify', true);
        $this->db->where('mail_id', $mid);
        $this->db->update('sh_mail');
        return ($res) ? true : false;
    }
	
}