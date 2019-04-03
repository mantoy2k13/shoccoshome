<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function mail(){
		if ($this->session->userdata('user_email')){ redirect('mail/inbox#messages'); }
		else { redirect('home/login'); }
    }
    
    public function sents(){
		if ($this->session->userdata('user_email')){ redirect('mail/sent_messages#messages'); }
		else { redirect('home/login'); }
    }
    
    public function drafts(){
		if ($this->session->userdata('user_email')){ redirect('mail/draft_messages#messages'); }
		else { redirect('home/login'); }
	}
    
	public function inbox()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email             = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page']        = 'mail';
			$data['base_url'] = base_url().'mail/inbox';
			$data['total_rows'] = $this->Mail_model->get_mails_count();
			$data['per_page'] = 10;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
            $data['get_mails']      = $this->Mail_model->get_mails($data["per_page"], $page);
            $data['my_friends']     = $this->Friends_model->get_my_friends_pagi($data["per_page"], $page);
			$this->load->view('mail/mail', $data);
			
		}
		else
		{
			redirect('home/login');
		}
    }
    
    public function sent_messages()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email             = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page']        = 'sents';
			$data['base_url'] = base_url().'mail/sent_messages';
			$data['total_rows'] = $this->Mail_model->get_sent_msg_count();
			$data['per_page'] = 10;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
            $data['get_sent_msg']   = $this->Mail_model->get_sent_msg_pagi($data["per_page"],$data);
            $data['my_friends']     = $this->Friends_model->get_my_friends_pagi($data["per_page"], $page);
			$this->load->view('mail/sents', $data);
		}
		else
		{
			redirect('home/login');
		}
    }
    
    public function draft_messages()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email             = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page']        = 'drafts';
			$data['base_url'] = base_url().'mail/draft_messages';
			$data['total_rows'] = $this->Mail_model->get_drafts_count();
			$data['per_page'] = 10;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
            $data['get_drafts']     = $this->Mail_model->get_drafts_pagi($data["per_page"],$page);
           	$data['my_friends']     = $this->Friends_model->get_my_friends();
			$this->load->view('mail/drafts', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

    public function send_message()
	{
		if ($this->session->userdata('user_email'))
		{
			if($this->input->post()){
                $res = $this->Mail_model->send_messages();
                if($res){
                    $this->session->set_flashdata('mail_msg', 'Sent');
                    redirect('mail/sent_messages#messages');
                } else{
                    $this->session->set_flashdata('mail_msg', 'Error');
                    redirect('mail/sent_messages#messages');
                }
            }
		}
		else { redirect('home/login'); }
	}
	
	public function update_message($mid)
	{
		if ($this->session->userdata('user_email'))
		{
			if($this->input->post()){
                $res = $this->Mail_model->update_message($mid);
                if($res){
					$this->session->set_flashdata('mail_msg', 'Updated');
                    redirect('mail/sent_messages#messages');
                } else{
					$this->session->set_flashdata('mail_msg', 'Error');
                    redirect('mail/sent_messages#messages');
                }
            }
		}
		else { redirect('home/login'); }
    }

    public function view_message($mid, $type)
	{
		if ($this->session->userdata('user_email'))
		{
			$res = $this->Mail_model->view_message($mid, $type);
            echo ($res) ? json_encode($res) : false;
		}
		else { redirect('home/login'); }
    }
    
    public function cntUnrMsg()
	{
		if ($this->session->userdata('user_email'))
		{
			$res = $this->Mail_model->count_mail();
            echo $res;
		}
		else { redirect('home/login'); }
	}

	public function cntMsgNotfif()
	{
		if ($this->session->userdata('user_email'))
		{
			$res = $this->Mail_model->count_mail_w_notif();
            echo json_encode($res);
		}
		else { redirect('home/login'); }
	}

	public function cNotif($mid)
	{
		if ($this->session->userdata('user_email'))
		{
			$res = $this->Mail_model->cNotif($mid);
            echo $res;
		}
		else { redirect('home/login'); }
	}

	public function move_to_drafts($mid)
	{
		if ($this->session->userdata('user_email'))
		{
			$res = $this->Mail_model->move_to_drafts($mid);
            echo $res;
		}
		else { redirect('home/login'); }
	}
    
    public function delete_message($mid, $type)
	{
		if ($this->session->userdata('user_email'))
		{
			$res = $this->Mail_model->delete_message($mid, $type);
            echo $res;
		}
		else { redirect('home/login'); }
	}

}
