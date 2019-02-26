<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pet extends CI_Controller{
    // construct call
    public function __construct(){
        parent::__construct();
    }
    
    public function add_pet(){

        $uploadedImgs=$this->input->post('pet_images');
        $upimagecheck=count($uploadedImgs);
        
        define('UPLOAD_DIR', 'assets/img/pet/');
        for($i = 0; $i < $upimagecheck; $i++){
        $aa=$uploadedImgs[$i];
        $image_parts = explode(";base64,", $aa);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = UPLOAD_DIR . uniqid() . '.png';
        file_put_contents($file, $image_base64);
        $image_name[]=$file;
        }

        $uploadedImgsJson = json_encode($image_name);

		$petdata=array(
			'user_id'=>$this->input->post('user_id'),
			'pet_name'=>$this->input->post('pet_name'),
			'cat_id'=>$this->input->post('cat_id'),
			'breed_id'=>$this->input->post('breed_id'),
			'tags'=>$this->input->post('tags'),
			'gender'=>$this->input->post('gender'),
			'color_id'=>$this->input->post('color_id'),
			'height'=>$this->input->post('height'),
			'weight'=>$this->input->post('weight'),
			'dob'=>$this->input->post('dob'),
			'fav_food'=>$this->input->post('fav_food'),
			'skills'=>$this->input->post('skills'),
			'vet_clinic'=>$this->input->post('vet_clinic'),
			'located'=>$this->input->post('located'),
			'adoptable'=>$this->input->post('adoptable'),
			'description'=>$this->input->post('description'),
			'country'=>$this->input->post('country'),
			'state'=>$this->input->post('state'),
			'city'=>$this->input->post('city'),
			'street'=>$this->input->post('street'),
			'zip_code'=>$this->input->post('zip_code'),
			'activate_notice'=>$this->input->post('activate_notice'),
			'notice_title'=>$this->input->post('notice_title'),
			'collar_tag'=>$this->input->post('collar_tag'),
			'reward'=>$this->input->post('reward'),
			'lost_location'=>$this->input->post('lost_location'),
			'lost_date'=>$this->input->post('lost_date'),
			'other_info'=>$this->input->post('other_info'),
			'contact_info'=>$this->input->post('contact_info'),
            'alt_contact_info'=>$this->input->post('alt_contact_info'),
            'pet_images'=>$uploadedImgsJson,
        );

        $add_pet = $this->Pet_model->add_pet($petdata);
        if ($add_pet) {
            // $this->session->set_flashdata('success_msg', '<strong><i class="fa fa-check"></i> Success!</strong> Your pet was added successfully. Click <a href="'.base_url().'home/my_pets">here</a> to view your pet.');
            $this->session->set_flashdata('pet_msg', 'Added');
            redirect('/home/add_new_pet');
        }
        else {
            // $this->session->set_flashdata('error_msg', '<strong><i class="fa fa-times"></i> Error!</strong> There was a problem adding your pet. Please try again.');
            $this->session->set_flashdata('pet_msg', 'Error');
            redirect('/home/add_new_pet');
        }

    }

    public function update_pet(){
        $petid=$this->input->post('pet_id');

        $image_name = [];
        $uploadedImgs=$this->input->post('pet_images');
        $upimagecheck=count($uploadedImgs);
        
        define('UPLOAD_DIR', 'assets/img/pet/');
        for($i = 0; $i < $upimagecheck; $i++){
        $aa=$uploadedImgs[$i];
        $image_parts = explode(";base64,", $aa);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = UPLOAD_DIR . uniqid() . '.png';
        file_put_contents($file, $image_base64);
        $image_name[$i]=$file;
        }

        //print_r($image_name);
        $get_single_pet_data=$this->Pet_model->get_single_pet_data($petid);
        $get_pet_images=$get_single_pet_data[0]->pet_images;

        $only_pet_image= json_decode($get_pet_images);
        $final_images = array_merge($only_pet_image, $image_name);
        $count_final_images=count($final_images);
            if($count_final_images>4){
                $petid=$this->input->post('pet_id');
                $this->session->set_flashdata('update_over_img_success_msg', 'Sorry ! You Max 4 images Uploaded.');
                redirect('/home/add_new_pet/'.$petid.'');
            }else{

            $uploadedImgsJson=json_encode($final_images);
            //exit();

            $petdataupdate=array(
                'user_id'=>$this->input->post('user_id'),
                'pet_id'=>$this->input->post('pet_id'),
                'pet_name'=>$this->input->post('pet_name'),
                'cat_id'=>$this->input->post('cat_id'),
                'breed_id'=>$this->input->post('breed_id'),
                'tags'=>$this->input->post('tags'),
                'gender'=>$this->input->post('gender'),
                'color_id'=>$this->input->post('color_id'),
                'height'=>$this->input->post('height'),
                'weight'=>$this->input->post('weight'),
                'dob'=>$this->input->post('dob'),
                'fav_food'=>$this->input->post('fav_food'),
                'skills'=>$this->input->post('skills'),
                'vet_clinic'=>$this->input->post('vet_clinic'),
                'located'=>$this->input->post('located'),
                'adoptable'=>$this->input->post('adoptable'),
                'description'=>$this->input->post('description'),
                'country'=>$this->input->post('country'),
                'state'=>$this->input->post('state'),
                'city'=>$this->input->post('city'),
                'street'=>$this->input->post('street'),
                'zip_code'=>$this->input->post('zip_code'),
                'activate_notice'=>$this->input->post('activate_notice'),
                'notice_title'=>$this->input->post('notice_title'),
                'chip_no'=>$this->input->post('chip_no'),
                'collar_tag'=>$this->input->post('collar_tag'),
                'reward'=>$this->input->post('reward'),
                'lost_location'=>$this->input->post('lost_location'),
                'lost_date'=>$this->input->post('lost_date'),
                'other_info'=>$this->input->post('other_info'),
                'contact_info'=>$this->input->post('contact_info'),
                'alt_contact_info'=>$this->input->post('alt_contact_info'),
                'pet_images'=>$uploadedImgsJson,
            );
            //print_r($petdataupdate);
            $update_pet = $this->Pet_model->updatepetdata($petdataupdate);
            if ($update_pet) {
                // $this->session->set_flashdata('update_success_msg', 'Your pet update successfully.');
                $this->session->set_flashdata('pet_msg', 'Updated');
                redirect('/home/add_new_pet/'.$petid.'');
            }
            else {
                // $this->session->set_flashdata('update_error_msg', 'Your pet update not successfully.');
                $this->session->set_flashdata('pet_msg', 'Error');
                redirect('/home/add_new_pet/'.$petid.'');
            }

        }
    }

    private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,
        );
    
        $this->load->library('upload', $config);
    
        $images = array();
         $uploadedFilename = array();
    
       foreach ($files['name'] as $key => $image) {
            if(!empty($image)){
                
                $_FILES['images_file[]']['name']= $files['name'][$key];
                $_FILES['images_file[]']['type']= $files['type'][$key];
                $_FILES['images_file[]']['tmp_name']= $files['tmp_name'][$key];
                $_FILES['images_file[]']['error']= $files['error'][$key];
                $_FILES['images_file[]']['size']= $files['size'][$key];
    
                $fileName = $title .'_'. $image;
    
                $images[] = $fileName;
    
                $config['file_name'] = $fileName;
    
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload('images_file[]')) {
                    $this->upload->data();
                    array_push($uploadedFilename, $this->upload->data('file_name'));
                } else {
                    return $this->upload->display_errors();
                }
            }
       }
       return $uploadedFilename;
    }

    private function set_upload_options()
    {   
        //upload an image options
        $config = array();
        $config['upload_path'] = './upload/pet/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }

    public function pet_image_remove(){
        $path = $_POST['path'];
        $petid = $_POST['petid'];
        $linkimg='assets/img/pet/'.$path;

        $get_single_pet_data=$this->Pet_model->get_single_pet_data($petid);
        $get_pet_images=$get_single_pet_data[0]->pet_images;

        $only_pet_image= json_decode($get_pet_images); //db
        $rval = [];
        foreach($only_pet_image as $i=>$imgp) {
            if($imgp !== $linkimg) {
                $rval[$i] = $imgp;
            }
        }
        $updateimagearray=json_encode(array_values($rval));
        $deleteimage=$this->Pet_model->updatepetimagesdata($petid,$updateimagearray);
        if($deleteimage){
            unlink($linkimg);
            echo true;
        } else{
            echo false;
        }
    }

    public function categories_wise_breed_data(){
        
        if($this->input->post('categories')){
            $categories_id = $this->input->post('categories');
            $breeddata = $this->Pet_model->breed_data_dependancy_cat($categories_id);
            $allbreeddata = '<option value="" required>Select Breed</option>'; 
            foreach($breeddata as $breedlist){
                //$statedatas[$statelist->id] = $statelist->name;
                $allbreeddata = $allbreeddata . '<option value="'. $breedlist->breed_id .'">'.$breedlist->breed_name.'</option>'; 
            }		
            echo $allbreeddata;	
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
            // $this->session->set_flashdata('delete_success_msg', 'Your pet delete successfully.');
            $this->session->set_flashdata('pet_msg', 'Deleted');
            redirect('/home/my_pets');
        }else {
            // $this->session->set_flashdata('delete_error_msg', 'Your pet delete successfully.');
            $this->session->set_flashdata('pet_msg', 'Error');
            redirect('/home/my_pets');
        }
    }

}