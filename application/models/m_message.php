<?php
    class M_Message extends CI_Model {
        
		public function lister() {
			$this->db->select('curlme.*, curlme.curl_id as id, curlme.curl_titre as titre, curlme.curl_description as description, curlme.curl_image as image, curlme.curl_site as site');
			$this->db->order_by('id', 'DESC');
            $this->db->from('curlme');
            
            $query = $this->db->get();
            return $query->result_array();
		}

		public function listerOne($id) {
			$this->db->select('curlme.*, curlme.curl_id as id, curlme.curl_titre as titre, curlme.curl_description as description, curlme.curl_image as image, curlme.curl_site as site');
            $this->db->where('curlme.curl_id', $id);
            $this->db->from('curlme');
            
            $query = $this->db->get();
            return $query->result_array();
		}

		public function listerUser($id_user) {
			$this->db->select('curlme.*, curlme.curl_id as id, curlme.curl_titre as titre, curlme.curl_description as description, curlme.curl_image as image, curlme.curl_site as site');
            $this->db->where('curlme.curl_user_id', $id_user);
            $this->db->order_by('id', 'DESC');
            $this->db->from('curlme');
            
            $query = $this->db->get();
            return $query->result_array();
		}
		
        public function save($imgSrc) {			
			
			$data = array(
	              'curl_titre'=>$this->input->post('nom'),
	              'curl_description'=>$this->input->post('desc'),
	              //'curl_image'=>$this->input->post('img'),
	              'curl_image'=>$imgSrc,
	              'curl_site'=>$this->input->post('site'),
	              'curl_user_id' => $this->input->post('userId')
	            );
	   		 $this->db->insert('curlme',$data);   		
        }
		
		public function deleteOne($id) {
			$this->db->where('curlme.curl_id', $id);
			$this->db->delete('curlme');
		}

		public function editOne($id) {			
			
			$data = array(
	              'curl_titre'=>$this->input->post('nom'),
	              'curl_description'=>$this->input->post('desc'),
	              //'curl_image'=>$this->input->post('img'),
	             // 'curl_image'=>$imgSrc,
	              'curl_site'=>$this->input->post('site'),
	              'curl_user_id' => $this->input->post('userId')
	            );
			$this->db->where('curlme.curl_id', $id);
	   		 $this->db->update('curlme', $data);
        }
		
		
    }
?>
