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
			$data['base_url'] = base_url().'album/albums';
			$data['total_rows'] = $this->Album_model->count_album($user_id);
			$data['per_page'] = 12;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
			$data['all_albums'] = $this->Album_model->get_all_albums($user_id, $data["per_page"],$page);
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
			$data['base_url'] = base_url().'album/view_album/'.$album_id;
			$data['total_rows'] = $this->Album_model->count_all_pictures_album($album_id);
			$data['per_page'] = 12;
			$data["uri_segment"] = 4;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data["links"] = $this->pagination->create_links();
			$data['get_img_no_album'] = $this->Pictures_model->get_img_no_album();
			$data['view_album_images'] = $this->Album_model->view_album_images_pagi($data["per_page"],$page, $album_id);
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
