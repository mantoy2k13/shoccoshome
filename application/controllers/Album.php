<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller {

    public function albums()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$user_id = $data['user_logindata']->id;
			$data['user_id'] = $user_id;
			$data['is_page'] = 'albums';
			$data['all_pictures'] = $this->Pet_model->get_all_pictures($user_id);
			$this->load->view('pet/albums', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function add_album(){
	
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
				echo $this->input->post('album_name');
				echo '<br />';
				echo $this->input->post('album_desc');
				echo $this->input->post('user_id');
			// $user_id = $data['user_logindata']->id;
			// $data['is_page'] = 'albums';
			// $data['all_pictures'] = $this->Pet_model->get_all_pictures($user_id);
			// $this->load->view('pet/albums', $data);
	}

}
