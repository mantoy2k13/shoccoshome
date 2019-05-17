<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pictures extends CI_Controller {

    public function __construct(){
		parent::__construct();
    }

    public function pictures()
	{
		if ($this->session->userdata('user_email'))
		{
			$uid = $this->session->userdata('user_id');
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'pictures';
			$data['base_url'] = base_url().'pictures/pictures';
			$data['total_rows'] = $this->Pictures_model->count_all_pictures();
			$data['per_page'] = 20;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["links"] = $this->pagination->create_links();
			$data['all_pictures'] = $this->Pictures_model->get_my_pictures($data["per_page"], $page);
			$this->load->view('pictures/pictures', $data);
		}
		else{
			redirect('home/login');
		}
	}

    public function add_photos($type, $album_id){
        if ($this->session->userdata('user_email')){ 
            $user_email  = $this->session->userdata('user_email');
            $data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'add_photos';
            $data['type'] = $type;
            $data['album_id'] = $album_id;
            $this->load->view('pictures/add_photos', $data);
        }
        else { redirect('home/login'); }
	}
	
	public function add_all_photos($type, $album_id){
		if($this->session->userdata('user_email')){ 
			$uid = $this->session->userdata('user_id');
			$target_path = './assets/img/pictures/';
			if($this->input->post()){
				if (!is_dir('./assets/img/pictures/usr'.$uid."/")) {
					mkdir('./assets/img/pictures/usr'.$uid."/");
					$target_path = './assets/img/pictures/usr'.$uid."/";
				} else{
					$target_path = "./assets/img/pictures/usr".$uid."/";
				}
				foreach( $_POST[ 'pet_images' ] as $k=>$v ){
					$imgName = 'p'.$uid.'_'.uniqid().".jpg"; 
					$data 	 = explode(',', $v);
					$decoded = base64_decode($data[1]);
					file_put_contents($target_path.$imgName,$decoded); 
					$res = $this->Pictures_model->insert_images($imgName,$uid,$album_id);
				}
				echo ($res) ? 1 : 0;
			}
		}
		else { redirect('home/login'); }
	}

	public function remove_from_album($imgID){
        if ($this->session->userdata('user_email')){ 
			$res = $this->Pictures_model->update_img_album($imgID, 0);
			echo ($res) ? 1 : 0;
        }
        else { redirect('home/login'); }
	}

	public function delete_image($imgID, $imgName, $type){
        if ($this->session->userdata('user_email')){ 
			if($type==1){
				$res = $this->Pictures_model->delete_image($imgID, $imgName);
			}else{
				$res = $this->Pictures_model->delete_all_image();
			}
			echo ($res) ? 1 : 0;
        }
        else { redirect('home/login'); }
	}

	public function delSelectedImages($type){
        if ($this->session->userdata('user_email')){ 
			if($this->input->post()){
				foreach($this->input->post('img_id') as $k => $imgID){
					if($type==1){
						$get_name = $this->Pictures_model->get_image_name($imgID);
						$res = $this->Pictures_model->delete_image($imgID, $get_name['img_name']);
					} else{
						$res = $this->Pictures_model->update_img_album($imgID, 0);
					}
				}
				echo ($res) ? 1 : 0;
			}
        }
        else { redirect('home/login'); }
	}

	public function addPhotoAlbum($album_id){
        if ($this->session->userdata('user_email')){ 
			if($this->input->post()){
				foreach($this->input->post('imgs_id') as $k => $imgID){
					$res = $this->Pictures_model->update_img_album($imgID, $album_id);
				}
				echo ($res) ? 1 : 0;
			}
        }
        else { redirect('home/login'); }
	}
    
}