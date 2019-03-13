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
			$data['is_page'] = 'albums';
			$data['all_albums'] = $this->Album_model->get_all_albums($user_id);
			$this->load->view('pictures/albums', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function add_album(){
	
		if ($this->session->userdata('user_email'))
		{
				$insert_album = $this->Album_model->add_albums();
				if ($insert_album) {
					$this->session->set_flashdata('album_msg', 'Added');
					redirect('album/albums');
				}
				else {
					$this->session->set_flashdata('album_msg', 'Error');
					redirect('album/albums');
				}
		}
		else
		{
			redirect('home/login');
		}
	}

	public function update_album($album_id){
		if ($this->session->userdata('user_email')){
			$albumdata = array(
				'album_name'=> $this->input->post('album_name'),
				'album_desc'=>$this->input->post('album_desc'));
			$update_album = $this->Album_model->update_album($album_id,$albumdata);
			if ($update_album) {
				$this->session->set_flashdata('album_msg', 'Updated');
				redirect('album/albums');
			}
			else {
				$this->session->set_flashdata('album_msg', 'Error');
				redirect('album/albums');
			}
		}
		else{
			redirect('home/login');
		}
	}

	public function delete_album($album_id){
		if($this->session->userdata('user_email')){
			$delete_album = $this->Album_model->delete_album($album_id);
			if ($delete_album) {
				$this->session->set_flashdata('album_msg', 'Deleted');
				redirect('album/albums');
			}
			else {
				$this->session->set_flashdata('album_msg', 'Error');
				redirect('album/albums');
			}
		}
		else{
			redirect('home/login');
		}
	}
	public function getalbum(){
		if($this->session->userdata('user_email')){
			$this->Album_model->get_album();
		}
		else{
			redirect('home/login');
		}			
	}

	public function view_album($album_id){
		if($this->session->userdata('user_email')){
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'view_album';
			$data['view_album'] = $this->Album_model->view_album($album_id);
			$data['view_album_images'] = $this->Album_model->view_album_images($album_id);
			$data['get_img_no_album'] = $this->Pictures_model->get_img_no_album();
			$this->load->view('pictures/view_album', $data);
		}
		else{
			redirect('home/login');
		}			
	}

	public function add_photos_to_album($album_id){
		if($this->session->userdata('user_email')){
			$res = $this->Album_model->add_photos_to_album($album_id);
		}
		else{
			redirect('home/login');
		}			
	}

}
