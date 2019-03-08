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
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data['is_page'] = 'pictures';
			$data['all_pictures'] = $this->Pictures_model->get_all_pictures();
			$this->load->view('pictures/pictures', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

    public function add_photos(){
        if ($this->session->userdata('user_email')){ 
            $user_email  = $this->session->userdata('user_email');
            $data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'add_photos';
            $this->load->view('pictures/add_photos', $data);
        }
        else { redirect('home/login'); }
	}
	
	public function add_all_photos($is_page){
		if($this->session->userdata('user_email')){ 
			$album_id = $this->input->post('album_id');
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
					$data = explode(',', $v);
					$decoded = base64_decode($data[1]);
					$status =file_put_contents($target_path.$imgName,$decoded); 
					if($status){
						$res = $this->Pictures_model->insert_images($imgName,$uid,$album_id);
					}else{
						$this->session->set_flashdata('upl_msg', 'Error');
						if($is_page=="add_photos") { redirect('pictures/add_photos'); }
						else{ redirect('album/view_album/'.$album_id); }
						
					}
				}

				if($res){
					$this->session->set_flashdata('upl_msg', 'Added');
					if($is_page=="add_photos") { redirect('pictures/pictures'); }
					else{ redirect('album/view_album/'.$album_id); }
				} else{
					$this->session->set_flashdata('upl_msg', 'Error');
					if($is_page=="add_photos") { redirect('pictures/add_photos'); }
					else{ redirect('album/view_album/'.$album_id); }
				}
			}
		}
		else { redirect('home/login'); }
	}

	public function remove_from_album($imgID){
        if ($this->session->userdata('user_email')){ 
			$res = $this->Pictures_model->remove_from_album($imgID);
			echo ($res) ? 1 : 0;
        }
        else { redirect('home/login'); }
	}

	public function delete_image($imgID, $imgName){
        if ($this->session->userdata('user_email')){ 
			$res = $this->Pictures_model->delete_image($imgID, $imgName);
			echo ($res) ? 1 : 0;
        }
        else { redirect('home/login'); }
	}
    
}