<?php
    class M_Member extends CI_Model {
        
        public function verifier($data) {
            $this->db->select('curlme_membres.*, curlme_membres.nom, curlme_membres.mdp, curlme_membres.email, curlme_membres.membre_id');
            $this->db->where(array('nom' => $data['nom'], 'mdp' => $data['mdp']));
            $this->db->or_where(array('email' => $data['nom'], 'mdp' => $data['mdp']));
            $this->db->from('curlme_membres');
            $query = $this->db->get();
            return $query->result_array();
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
