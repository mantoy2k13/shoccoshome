<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album_model extends CI_Model {

		public function __construct(){
		parent::__construct();
		}
		
			public function add_albums($albumdata){
				$this->db->trans_start();
				$this->db->insert('sh_albums', $albumdata);
				$insert_id = $this->db->insert_id();
				$this->db->trans_complete();
				return $insert_id;
			}
			
}