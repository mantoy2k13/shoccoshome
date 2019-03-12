<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pet extends CI_Controller{
    // construct call
    public function __construct(){
        parent::__construct();
    }

    public function add_new_pet(){
		if ($this->session->userdata('user_email')){
            $pet_id = $this->uri->segment(3);
            $data['pd'] = ($pet_id) ? $this->Pet_model->get_single_pet_data($pet_id) : null;
			$user_email  = $this->session->userdata('user_email');
            $data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['all_pictures'] = $this->Pictures_model->get_all_pictures();
			$data['is_page'] = 'add_pet';
			$this->load->view('pet/add_pet', $data);
		} else {
			redirect('home/login');
		}
    }

    public function add_pet(){
        if($this->input->post()){
            $pid = $this->uri->segment(3);
            $postType = $this->input->post('postType');
            $pet_id = $this->Pet_model->add_pet($postType, $pid);
            if($pet_id){
                $img_res = $this->Pet_model->insert_pet_img($postType, $pet_id);
                if($img_res){
                    $this->session->set_flashdata('pet_msg', 'Added');
                    redirect('pet/add_new_pet/'.$pet_id);
                }
                $this->session->set_flashdata('pet_msg', 'Added');
                redirect('pet/add_new_pet'.$pet_id);
            } else {
                $this->session->set_flashdata('pet_msg', 'Error');
                redirect('pet/add_new_pet');
            }
        } else{
            redirect('pet/add_pet');
        }
    }

    public function rem_vacc_info($pet_id, $num){
        if($this->input->post()){
            $vacc = $this->Pet_model->get_vacc($pet_id);
            $vaccination = json_decode($vacc['vaccination']);
            $vaccination_date = json_decode($vacc['vaccination_date']);
            $i=0; $j=0;
            foreach ($vaccination as $v) {
                if($i!=$num){
                    $n_vacc[] = $v;
                }
                $i+=1;
            }
            foreach ($vaccination_date as $vd) {
                if($j!=$num){
                    $n_vd[] = $vd;
                }
                $j+=1;
            }

            $res = $this->Pet_model->update_vacc($pet_id,json_encode($n_vacc), json_encode($n_vd));
            echo ($res) ? 1 : 0;
        }
    }

    public function pet_image_remove($pet_id){
        if($this->input->post()){
            $pd = $this->Pet_model->get_single_pet_data($pet_id);
            foreach(json_decode($pd['pet_images']) as $img){
                if($this->input->post('imgName')!=$img){
                    $n_img[] = $img;
                }
            }
            $res = $this->Pet_model->update_pet_img($pet_id, json_encode($n_img));
            echo ($res) ? 1 : 0;
        } else{
            echo 0;
        }
    }

    public function checkPetName(){
        if($this->input->post('petName')){
            $petName = $this->input->post('petName');
            $res = $this->Pet_model->checkPetName($petName);
            echo ($res) ? 1 : 0;
        }
    }

    public function categories_wise_breed_data(){
        
        if($this->input->post('categories')){
            $categories_id = $this->input->post('categories');
            $breeddata = $this->Pet_model->breed_data_dependancy_cat($categories_id);
            $allbreeddata = '<option value="">Select Breed</option>'; 
            foreach($breeddata as $breedlist){
                $allbreeddata = $allbreeddata . '<option value="'. $breedlist->breed_id .'">'.$breedlist->breed_name.'</option>'; 
            }		
            echo $allbreeddata;	
        }
    }

    public function get_breeds($cat_id){
        if($cat_id){
            $breeddata = $this->Pet_model->breed_data_dependancy_cat($cat_id);
            $allbreeddata = '<option value="">Select Breed</option>'; 
            foreach($breeddata as $breedlist){
                $allbreeddata = $allbreeddata . '<option value="'. $breedlist->breed_id .'">'.$breedlist->breed_name.'</option>'; 
            }		
            echo $allbreeddata;	
        } else{
            echo '<option value="">-</option>';
        }
    }
	
    public function delete_pet(){
        $pet_id = $this->uri->segment(3);
        $get_pet_data=$this->Pet_model->get_single_pet_data($pet_id);
        $get_pet_names=$get_pet_data[0]->pet_images;
        $get_pet_names_jeson=json_decode($get_pet_names);
        $get_pet_names_jeson_count=count($get_pet_names_jeson);
        for($i=0; $i<$get_pet_names_jeson_count; $i++){
            $get_pet_image=$get_pet_names_jeson[$i];
            unlink($get_pet_image);
        }
        $delete_pet = $this->Pet_model->deletepet($pet_id);
        if ($delete_pet) {
            $this->session->set_flashdata('pet_msg', 'Deleted');
            redirect('home/my_pets');
        }else {
            $this->session->set_flashdata('pet_msg', 'Error');
            redirect('home/my_pets');
        }
    }

    public function setPrimaryImg($pet_id, $img_name){
		if ($this->session->userdata('user_email')){ 
            echo $this->Pet_model->setPrimaryImg($pet_id, $img_name);
        }
		else { echo false; }
    }

    public function search_pets()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'search_pets';
            $data['search_results'] = $this->Pet_model->search_pets();
            $this->load->view('pet/search_pets_results', $data);
		}
		else{
			redirect('home/login');
		}
    }
    
    public function search_pet_keywords()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'search_pets';
            $data['search_results'] = $this->Pet_model->search_pet_keywords();
            $this->load->view('pet/search_pets_results', $data);
		}
		else{
			redirect('home/login');
		}
	}

}