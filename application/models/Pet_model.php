<?php
class Pet_model extends CI_model{

    function __construct(){
        parent::__construct();
    }

    public function add_pet2($data){
		$this->db->trans_start();
		$this->db->insert('sh_pets', $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
    }
    
    public function add_pet(){
        foreach($this->input->post('vaccination') as $k=>$v){ $vacc[] = $v; }
        foreach($this->input->post('vaccination_date') as $l=>$m){ $v_date[] = $m; }
        $vaccination = json_encode($vacc);
        $vacc_date   = json_encode($v_date);
		$data = array(
			'user_id'          =>$this->session->userdata('user_id'),
			'pet_name'         =>$this->input->post('pet_name'),
			'cat_id'           =>$this->input->post('cat_id'),
			'breed_id'         =>$this->input->post('breed_id'),
			'tags'             =>$this->input->post('tags'),
			'gender'           =>$this->input->post('gender'),
			'color_id'         =>$this->input->post('color_id'),
			'height'           =>$this->input->post('height'),
			'weight'           =>$this->input->post('weight'),
			'dob'              =>$this->input->post('dob'),
			'fav_food'         =>$this->input->post('fav_food'),
			'skills'           =>$this->input->post('skills'),
			'vet_clinic'       =>$this->input->post('vet_clinic'),
			'located'          =>$this->input->post('located'),
			'adoptable'        =>$this->input->post('adoptable'),
			'health_issues'    =>$this->input->post('health_issues'),
			'medications'      =>$this->input->post('medications'),
			'description'      =>$this->input->post('description'),
			'country'          =>$this->input->post('country'),
			'state'            =>$this->input->post('state'),
			'city'             =>$this->input->post('city'),
			'street'           =>$this->input->post('street'),
			'zip_code'         =>$this->input->post('zip_code'),
			'activate_notice'  =>$this->input->post('activate_notice'),
			'notice_title'     =>$this->input->post('notice_title'),
			'collar_tag'       =>$this->input->post('collar_tag'),
			'chip_no'          =>$this->input->post('chip_no'),
			'reward'           =>$this->input->post('reward'),
			'lost_location'    =>$this->input->post('lost_location'),
			'lost_date'        =>$this->input->post('lost_date'),
			'other_info'       =>$this->input->post('other_info'),
			'contact_info'     =>$this->input->post('contact_info'),
            'alt_contact_info' =>$this->input->post('alt_contact_info'),
            'vaccination'      =>$vaccination,
            'vaccination_date' =>$vacc_date
        );

        $this->db->insert('sh_pets', $data);
        $pet_id = $this->db->insert_id();
        return $pet_id;
	}

    public function insert_pet_img($pet_id){
		$uid         = $this->session->userdata('user_id');
        $target_path = './assets/img/pictures/';

        if (!is_dir('./assets/img/pictures/usr'.$uid."/")) {
            mkdir('./assets/img/pictures/usr'.$uid."/");
            $target_path = './assets/img/pictures/usr'.$uid."/";
        } else{
            $target_path = "./assets/img/pictures/usr".$uid."/";
        }

        foreach($this->input->post('pet_images') as $k=>$v){
            $imgName = 'p'.$uid.'_'.uniqid().".jpg"; 
            $data    = explode(',', $v);
            $decoded = base64_decode($data[1]);
            $status  = file_put_contents($target_path.$imgName,$decoded); 
            $pet_images[] = $imgName;
        }

        if($pet_images){
            $my_pet_img = json_encode($pet_images);
            $data = array('pet_images' => $my_pet_img, 'primary_pic' => $imgName);
            $this->db->where('pet_id', $pet_id);
            $res = $this->db->update('sh_pets', $data);
            return ($res) ? true : false;
        }else{
            return false;
        }
        
    }

    public function checkPetName($petName){
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('pet_name', $petName);
        $query = $this->db->get('sh_pets');
        return ($query->num_rows() > 0) ? true : false;
    }

	// user id wise
 	public function get_pet_data() {
        $id = $this->session->userdata('user_id');
        $this->db->select('*')->from('sh_pets a');;
		$this->db->join('sh_category b', 'b.cat_id=a.cat_id', 'left');
        $this->db->join('sh_breeds c', 'c.breed_id=a.breed_id', 'left');
		$this->db->where('a.user_id', $id);
		$this->db->order_by("a.pet_id", "desc");
		return $this->db->get()->result_array();
    }

	// pet id wise
 	  public function get_pet_details($pet_id) {
        $this->db->select('*')->from('sh_pets a');
		$this->db->join('sh_category b', 'b.cat_id=a.cat_id', 'left');
        $this->db->join('sh_breeds c', 'c.breed_id=a.breed_id', 'left');
        $this->db->join('sh_color d', 'd.color_id=a.color_id', 'left');
		$this->db->where('a.pet_id', $pet_id);
		$this->db->order_by("a.pet_id", "desc");
		return $this->db->get()->result_array();
    }

	// pet id wise
 	  public function get_single_pet_data($id) {
    $this->db->select('*');
		$this->db->from('sh_pets');
		$this->db->where('pet_id', $id);
		$this->db->order_by("pet_id", "desc");
		$query = $this->db->get();
		return $query->result();
		}
		
		//update pets table
		public function updatepetdata($pet_up){
			$this->db->set($pet_up);
			$this->db->where('pet_id',$pet_up['pet_id']);
			$data = $this->db->update('sh_pets');
			return $data;
		}


		//update pets delete iamge table
		public function updatepetimagesdata($data,$pet_images){
			$this->db->set('pet_images', $pet_images);
			$this->db->where('pet_id',$data);
			$data = $this->db->update('sh_pets');
			return $data;
		}
		
		// get all pet categories 

		public function get_all_pet_cat(){
			$this->db->select('*')->from('sh_category');
			$this->db->order_by("cat_name", "asc");
			return $this->db->get()->result_array();
		}
		
		// get all pet breeds 

		public function get_all_pet_breed(){
			$this->db->select('*')->from('sh_breeds');
			$this->db->order_by("breed_name", "asc");
			$query = $this->db->get();
			return $query->result();
		}

		// get all pet color 
		public function get_all_pet_color(){
			$this->db->select('*')->from('sh_color');
			$this->db->order_by("color_name", "asc");
			return $this->db->get()->result_array();
		}

		public function userwisecatlist($data){
			$this->db->select('COUNT(a.cat_id) as cat_count,cat_name,user_id');
			$this->db->from('sh_pets a');
			$this->db->join('sh_category b', 'b.cat_id=a.cat_id', 'left');
			$this->db->where('a.user_id', $data);
			$this->db->group_by('a.cat_id');
			$query = $this->db->get();
			return $query->result();
		}

    // breed data get pet category wise
		public function breed_data_dependancy_cat($id) {
			$this->db->select('*');
			$this->db->from('sh_breeds');
			$this->db->where('cat_id', $id);
			$query = $this->db->get();
			return $query->result();
		}
		
		// delete my pet

		public function deletepet($id){
				$this->db->where('pet_id', $id);
				$res = $this->db->delete('sh_pets');
				return ($res) ? true : false;
		}

		// get all images pictures

		public function get_all_pictures($user_id) {
			$this->db->select('u.id, p.user_id, p.pet_id,p.pet_images, p.pet_name, p.date_added');
		$this->db->from('sh_users u');
		$this->db->join('sh_pets p', 'u.id=p.user_id', 'inner');
		$this->db->where('u.id', $user_id);
		$this->db->order_by("p.pet_id", "desc");
		$query = $this->db->get();
		return $query->result();
		
	}

	public function setPrimaryImg($pet_id, $img_name){
		$this->db->set('primary_pic', $img_name);
		$this->db->where('pet_id', $pet_id);
		$res = $this->db->update('sh_pets');
		return ($res) ? true : false;
    }

    public function search_pets(){


				
				$keywords=rtrim($this->input->get('keywords'));
				$chip_no=rtrim($this->input->get('chip_no'));
				$collar_tag=rtrim($this->input->get('collar_tag'));
				$catid=rtrim($this->input->get('cat_id'));
				$breed_id=rtrim($this->input->get('breed_id'));
				$gender=rtrim($this->input->get('gender'));
				$color_id=rtrim($this->input->get('color_id'));
				$located=rtrim($this->input->get('located'));
				$zip_code=rtrim($this->input->get('zip_code'));



				$this->db->select('*');
				$this->db->from('sh_pets a');
				$this->db->join('sh_category b', 'b.cat_id=a.cat_id', 'left');
				$this->db->join('sh_breeds c', 'c.breed_id=a.breed_id', 'left');
				$this->db->join('sh_color d', 'd.color_id=a.color_id', 'left');

				$this->db->or_like('a.pet_name',$keywords);

				if($catid and $breed_id){
					$this->db->where('a.cat_id', $catid);
					$this->db->where('a.breed_id', $breed_id);
				}elseif($catid){
					 $this->db->where('a.cat_id', $catid);
				}else{

				}

				if($gender){
					$this->db->where('a.gender', $gender);
				}

				if($color_id){
					$this->db->where('a.color_id', $color_id);
				}
				

				if($located){
					$this->db->where('a.located', $located);
				}

				if($chip_no){
					$this->db->where('a.chip_no', $chip_no);
				}

				if($collar_tag){
					$this->db->where('a.collar_tag', $collar_tag);
				}
				
				$this->db->order_by("a.pet_id", "desc");
				$query = $this->db->get();
				return $query->result();
		}
		

    
    public function search_pet_keywords(){
        $input_keywords = rtrim($this->input->get('keywords'));
        $keywords = array(
            'sh_pets.pet_name'     => $input_keywords,
            'sh_pets.chip_no'      => $input_keywords,
            'sh_pets.collar_tag'   => $input_keywords,
            'sh_category.cat_name' => $input_keywords,
            'sh_breeds.breed_name' => $input_keywords,
            'sh_pets.gender'       => $input_keywords,
            'sh_color.color_name'  => $input_keywords,
            'sh_pets.located'      => $input_keywords,
            'sh_pets.zip_code'     => $input_keywords,
        );

        $this->db->select('sh_pets.*,  sh_users.*, sh_category.cat_name, sh_breeds.breed_name, sh_color.color_name')->from('sh_pets');
		    $this->db->join('sh_users',   'sh_users.id=sh_pets.user_id', 'left');
		    $this->db->join('sh_category','sh_category.cat_id=sh_pets.cat_id', 'left');
        $this->db->join('sh_breeds',  'sh_breeds.breed_id=sh_pets.breed_id', 'left');
        $this->db->join('sh_color',   'sh_color.color_id=sh_pets.color_id', 'left');
        $this->db->or_like($keywords);
        return $this->db->get()->result_array();
	}

}