<?php
    class Member extends CI_Controller {
        
        public function index() {
            $this->load->helper('form');
            
            $this->load->model('M_Member');
            $data['connected'] = $this->M_Member->isLoggedIn();
            $data['usernameSession'] = $this->session->userdata('username'); 

            $data['titre'] = 'CURL ME ! - Connexion';
            $data['vue'] = $this->load->view('member_form', $data, true);
            $this->load->view('layout', $data);
            
        }
        
        public function login() {
            $this->load->model('M_Member');

            $this->load->library('encrypt');
            
            $data['mdp'] = $this->input->post('mdpLogin');
            $data['mdp'] = $this->encrypt->sha1($data['mdp']);

            $data['nom'] = $this->input->post('nameLogin');
            $data['email'] = $this->input->post('nameLogin');

            if($this->M_Member->verifier($data)) {
                $data['infoMembre'] = $this->M_Member->verifier($data);

                $newSession = array(
                       'username'  => $data['nom'],
                       'logged_in' => TRUE,
                       'id' => $data['infoMembre'][0]['membre_id']
                   );
                $this->session->set_userdata($newSession);

              redirect('message');  
            }
            else {
               
                $data['error'] = 'Bad login / password';
                
            }

            $data['connected'] = $this->M_Member->isLoggedIn(); 

            $data['titre'] = 'CURL ME ! - Connexion';  
            $data['vue'] = $this->load->view('member_form', $data, true);
            $this->load->view('layout', $data);
                
        }

         public function logout(){
            $this->session->sess_destroy();
            redirect('message');
        }

        public function signup(){
            $this->load->model('M_Member');

            $this->load->library('form_validation');
            $this->form_validation->set_rules('nom', 'name', 'required');
            $this->form_validation->set_rules('mdp', 'password', 'required');
            $this->form_validation->set_rules('mdp_confirm', 'password_confirm', 'required|matches[mdp]');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');

            if ($this->form_validation->run() == FALSE)
            {
                $data['erreur'] = 'Field is missing';
            }
            else
            {
                $this->M_Member->enregistrer();
                $data['successful'] = 'Your account has been created';
            }

     
            $data['connected'] = $this->M_Member->isLoggedIn(); 

            $data['titre'] = 'CURL ME ! - Connexion';  
            $data['vue'] = $this->load->view('member_form', $data, true);
            $this->load->view('layout', $data);
        }
    }   
?>
