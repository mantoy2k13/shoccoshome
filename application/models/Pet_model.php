<?php
class Pet_model extends CI_model{

    function __construct(){
        parent::__construct();
    }

    public function add_pet($data){
		$this->db->trans_start();
		$this->db->insert('sh_pets', $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
		}
		

    public function add_pet_image($data){
		//echo print_r($data);	
		$this->db->trans_start();
		$this->db->insert('sh_pet_images', $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $insert_id;
    }


	// user id wise
 	  public function get_pet_data($id) {
    $this -> db -> select('*');
		$this -> db -> from('sh_pets a');
		$this->db->join('sh_category b', 'b.cat_id=a.cat_id', 'left');
    $this->db->join('sh_breeds c', 'c.breed_id=a.breed_id', 'left');
		$this -> db -> where('a.user_id', $id);
		$this->db->order_by("a.pet_id", "desc");
		$query = $this->db->get();
		return $query->result();
    }

	// pet id wise
 	  public function get_all_pet_data($id) {
    $this -> db -> select('*');
		$this -> db -> from('sh_pets a');
		$this->db->join('sh_category b', 'b.cat_id=a.cat_id', 'left');
    $this->db->join('sh_breeds c', 'c.breed_id=a.breed_id', 'left');
    $this->db->join('sh_color d', 'd.color_id=a.color_id', 'left');
		$this -> db -> where('a.pet_id', $id);
		$this->db->order_by("a.pet_id", "desc");
		$query = $this->db->get();
		return $query->result();
    }


	// pet id wise
 	  public function get_single_pet_data($id) {
    $this -> db -> select('*');
		$this -> db -> from('sh_pets');
		$this -> db -> where('pet_id', $id);
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
			$this->db->select('*');
			$this->db->from('sh_category');
			$this->db->order_by("cat_name", "asc");
			$query = $this->db->get();
			return $query->result();
		}
		
		// get all pet breeds 

		public function get_all_pet_breed(){
			$this -> db -> select('*');
			$this -> db -> from('sh_breeds');
			$this->db->order_by("breed_name", "asc");
			$query = $this->db->get();
			return $query->result();
		}

		// get all pet color 

		public function get_all_pet_color(){
			$this -> db -> select('*');
			$this -> db -> from('sh_color');
			$this->db->order_by("color_id", "asc");
			$query = $this->db->get();
			return $query->result();
		}

		public function userwisecatlist($data){
			$this -> db -> select('COUNT(a.cat_id) as cat_count,cat_name,user_id');
			$this -> db -> from('sh_pets a');
			$this->db->join('sh_category b', 'b.cat_id=a.cat_id', 'left');
			$this->db->where('a.user_id', $data);
			$this->db->group_by('a.cat_id');
			$query = $this->db->get();
			return $query->result();
		}

    // breed data get pet category wise
		public function breed_data_dependancy_cat($id) {
			$this -> db -> select('*');
			$this -> db -> from('sh_breeds');
			$this -> db -> where('cat_id', $id);
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
			$this -> db -> select('u.id, p.user_id, p.pet_id,p.pet_images, p.pet_name, p.date_added');
		$this -> db -> from('sh_users u');
		$this->db->join('sh_pets p', 'u.id=p.user_id', 'inner');
		$this->db->where('u.id', $user_id);
		$this->db->order_by("p.pet_id", "desc");
		$query = $this->db->get();
		return $query->result();
		
	}

}