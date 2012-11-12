<?php
    class M_Member extends CI_Model {
        
        public function verifier($data) {
            $query = $this->db->get_where('curlme_membres', array('nom' => $data['nom'], 'mdp' => $data['mdp']));

            return $query->result_array();
            //return $query->row_array(); 
            //return $query->num_rows();
        }

        public function enregistrer(){
        	$this->load->library('encrypt');
            
            $data['mdp'] = $this->input->post('mdp');
            $data['mdp'] = $this->encrypt->sha1($data['mdp']);

            $data = array(
	              'nom'=>$this->input->post('nom'),
	              'mdp'=>$data['mdp'],
	              'email'=>$this->input->post('email')
	            );

	   		 $this->db->insert('curlme_membres',$data);
        }

         public function isLoggedIn(){
             if($this->session->userdata('logged_in'))
             { return true; } else { return false; }
        }

    }
?>
