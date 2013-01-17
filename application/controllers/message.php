<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
		public function __construct() {
            parent::__construct();
        }
        public function index()
		{
			$this->load->model('M_Message');
			$dataLayout['message'] = $this->M_Message->lister();
			
			$dataLayout['vue'] = $this->load->view('lister', $dataLayout, true);
            
			$this->lister();
		}
        
        public function lister()
        {
        	$this->load->model('M_Member');
			$dataLayout['connected'] = $this->M_Member->isLoggedIn(); 
			$dataLayout['usernameSession'] = $this->session->userdata('username');
			$dataLayout['id_user'] = $this->session->userdata('id'); 

            $dataLayout['titre'] = 'CURL ME ! - Emmanuel Samu';
			
            $dataLayout['vue'] = $this->load->view('lister', $dataLayout, true);

            $this->load->view('layout', $dataLayout);
        }

        public function listerOne($id)
        {
        	$this->load->model('M_Member');
			$dataLayout['connected'] = $this->M_Member->isLoggedIn(); 
			$dataLayout['usernameSession'] = $this->session->userdata('username'); 
			$dataLayout['id_user'] = $this->session->userdata('id'); 

			$this->load->model('M_Message');
			$id = $this->uri->segment(3);
			$dataLayout['message'] = $this->M_Message->listerOne($id);

            $dataLayout['titre'] = 'CURL ME ! - Edit link';
            $dataLayout['vue'] = $this->load->view('editer', $dataLayout, true);

            $this->load->view('layout', $dataLayout);
        }

        public function listerUser($id_user)
        {
        	$this->load->model('M_Member');
			$dataLayout['connected'] = $this->M_Member->isLoggedIn(); 
			$dataLayout['usernameSession'] = $this->session->userdata('username'); 
			$dataLayout['id_user'] = $this->session->userdata('id'); 

			$this->load->model('M_Message');
			$dataLayout['message'] = $this->M_Message->listerUser($id_user);

            $dataLayout['titre'] = 'CURL ME ! - My links';
            $dataLayout['vue'] = $this->load->view('lister', $dataLayout, true);

            $this->load->view('layout', $dataLayout);
        }
		
		public function curler() {
			$this->load->library('curl');	

			$url= $this->input->post('message');

			/* si l'utilisateur n'a pas de http */
			/* si l'utilisateur n'a pas de http:// ni de www  */
			if (preg_match('#^(www.)(.*)#i', $url)) {
				$url = 'http://' . $url;
			} 

			if (!preg_match('#^(http(s)?:\/\/)(.*)$#i', $url)) {	
				$url = 'http://www.' . $url;	
			}

				/* récupération du site */
				$curlData = $this->curl->simple_get($url);

				if($curlData == '') {
					$dataLayout['error'] = 'This is not a website !';
					$this->load->model('M_Member');
					$dataLayout['connected'] = $this->M_Member->isLoggedIn(); 
					$dataLayout['usernameSession'] = $this->session->userdata('username');
					$dataLayout['id_user'] = $this->session->userdata('id'); 

					$dataLayout['titre'] = 'CURL ME ! - Emmanuel Samu';
				
					$dataLayout['vue'] = $this->load->view('lister', $dataLayout, true);
				
					$this->load->view('layout', $dataLayout);
				} else {

					$dataLayout['curl_site'] = $url;
					
					/* récupération du titre du site */
					if(preg_match('#<title>(.*?)<\/title>#i', $curlData, $curlTitle)) {
						$dataLayout['curl_titre'] = html_entity_decode($curlTitle[1]);
					} 
					/* récupération de la description du site */
					if(preg_match('#name="description" content="(.*?)"#i', $curlData, $curlDescription)) {
						$dataLayout['curl_description'] = $curlDescription[1];
					}
					/* récupération des images du site  */
					if(preg_match_all('#<img.* src="(.*?)"#i', $curlData, $curlImages)) {
						$dataLayout['img'] = $curlImages;
					}
				
				$this->load->model('M_Member');
				$dataLayout['connected'] = $this->M_Member->isLoggedIn(); 
				$dataLayout['usernameSession'] = $this->session->userdata('username');
				$dataLayout['id_user'] = $this->session->userdata('id'); 

				$dataLayout['titre'] = 'CURL ME ! - Emmanuel Samu';
			
				$dataLayout['vue'] = $this->load->view('lister', $dataLayout, true);
			
				$this->load->view('layout', $dataLayout);	
			}
		}
		
		public function ajouter() {
			$this->load->model('M_Member');
			$dataLayout['connected'] = $this->M_Member->isLoggedIn(); 
			$dataLayout['usernameSession'] = $this->session->userdata('username'); 

			$this->load->model('M_Message');
			

			if($this->input->post('img') == '') {
				$imgSrc = '';
			} else {

				/* code pour aller insérer l'image dans un dossier upload */
				$test = file_get_contents($this->input->post('img'));
				$typeImage = getimagesize($this->input->post('img'));
				$type = explode("/", $typeImage['mime']);
				
				// genere une clé aléatoire
				function random_str()
				{
				    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
				        mt_rand( 0, 0x0fff ) | 0x4000,
				        mt_rand( 0, 0x3fff ) | 0x8000,
				        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
				}
				$nomImage = random_str();

				$fp = fopen('web/upload/' . $nomImage . '.' . $type[1], "w");
				fwrite($fp, $test);
				fclose($fp); 

					$config['image_library'] = 'gd2';
					$config['source_image'] = 'web/upload/' . $nomImage . '.' . $type[1];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 150;
					$config['height'] = 75;

					$this->load->library('image_lib', $config);

					$this->image_lib->resize();

					$imgSrc = $nomImage . '.' . $type[1];
				}

				$this->M_Message->save($imgSrc);
				redirect($this->load->view('layout'));				
		}
		
		public function supprimer($id) {
			$this->load->model('M_Member');
			$dataLayout['connected'] = $this->M_Member->isLoggedIn(); 
			$dataLayout['usernameSession'] = $this->session->userdata('username'); 

			$this->load->model('M_Message');
			
			$id = $this->uri->segment(3);
			$this->M_Message->deleteOne($id);
			

			if($this->input->is_ajax_request()) {
				echo ('Well done! The link has been deleted');
			} else {
				$dataLayout['titre'] = 'CURL ME ! - Link deleted';
				$dataLayout['vue'] = "ok";
				$dataLayout['vue'] = $this->load->view('ok', $dataLayout, true);
				$this->load->view('layout', $dataLayout);
			}
		}

		public function modifier($id) {
			$this->load->model('M_Member');
			$dataLayout['connected'] = $this->M_Member->isLoggedIn(); 
			$dataLayout['usernameSession'] = $this->session->userdata('username'); 

			$this->load->model('M_Message');

			$dataLayout['message'] = $this->M_Message->listerOne($id);

			$id = $this->uri->segment(3);
			$this->M_Message->editOne($id);

			$dataLayout['titre'] = 'CURL ME ! - Link edited';
			$dataLayout['vue'] = $this->load->view('lister', $dataLayout, true);

			$this->load->view('layout', $dataLayout);

			redirect($this->load->view('layout'));
		}

}