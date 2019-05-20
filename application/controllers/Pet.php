<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pet extends CI_Controller{
    // construct call
    public function __construct(){
        parent::__construct();
    }

    public function my_pets()
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['is_page'] = 'my_pets';
            $data['base_url'] = base_url().'pet/my_pets';
			$data['total_rows'] = $this->Pet_model->get_pet_data_count();
			$data['per_page'] = 10;
			$data["uri_segment"] = 3;
			$this->pagination->initialize($data);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["links"] = $this->pagination->create_links();
            $data['get_pet_data'] = $this->Pet_model->get_pet_data_pagi($data["per_page"],$page);
			$this->load->view('pet/my_pets', $data);
		}
		else
		{
			redirect('home/login');
		}
	}

	public function pet_details($pet_id)
	{
		if ($this->session->userdata('user_email'))
		{
			$user_email  = $this->session->userdata('user_email');
			$data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
			$data["pet_details"] = $this->Pet_model->get_pet_details($pet_id);
			$data['is_page'] = 'pet_details';
			$this->load->view('pet/pet_details', $data);
		}
		else
		{
			redirect('home/login');
		}
    }
    
    public function get_pet_details_ajax($pet_id)
	{
		if ($this->session->userdata('user_email'))
		{
			echo json_encode($this->Pet_model->get_pet_details($pet_id));
		}
		else
		{
			redirect('home/login');
		}
	}

    public function add_new_pet(){
		if ($this->session->userdata('user_email')){
            $pet_id = $this->uri->segment(3);
            $data['pd'] = ($pet_id) ? $this->Pet_model->get_single_pet_data($pet_id) : null;
			$user_email = $this->session->userdata('user_email');
            $data["user_logindata"] = $this->Auth_model->fetchuserlogindata($user_email);
            $data['all_pictures'] = $this->Pictures_model->get_all_pictures();
			$data['is_page'] = 'add_pet';
			$this->load->view('pet/add_pet', $data);
		} else {
			redirect('home/login');
		}
    }

    public function add_this_pet(){
        if($this->input->post()){
            $pid = $this->uri->segment(3);
            $postType = $this->input->post('postType');
            $pet_id = $this->Pet_model->add_pet($postType, $pid);
            if($pet_id){
                $img_res = $this->Pet_model->insert_pet_img($postType, $pet_id);
                echo 1;
            } else {
                echo 0;
            }
        } else{
            redirect('pet/add_pet');
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
            foreach ($vaccination as $v){
                if($i!=$num){
                    $n_vacc[] = $v;
                } $i+=1;
            }
            foreach ($vaccination_date as $vd){
                if($j!=$num){
                    $n_vd[] = $vd;
                } $j+=1;
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

    public function get_pet_breeds(){
        $cat_id = $this->uri->segment(3);
        if($cat_id){
            $cat_data = $this->Pet_model->get_pet_breeds($cat_id);
            $breed_data = '<option value="">Select Breed</option>'; 
            foreach($cat_data as $cat){ extract($cat);
                $breed_data .= '<option value="'. $breed_id .'">'.$breed_name.'</option>'; 
            } echo($breed_data);
        }
        else{ echo '<option value="">Select Breed</option>'; }
    }

    public function delete_pet($pet_id){
        if($pet_id){
            $res = $this->Pet_model->delete_pet($pet_id);
            echo ($res) ? 1 : 0;
        } else{ echo 0; }
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