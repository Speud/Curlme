<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
		
        public function index()
		{
			$this->load->model('M_Message');
			$dataList['message'] = $this->M_Message->lister(); 
			$dataLayout['vue'] = $this->load->view('lister', $dataList, true);
            
			$this->lister();
		}
        
        public function lister()
        {
            $dataLayout['titre'] = 'CURL ME ! - Emmanuel Samu';
			
            $dataLayout['vue'] = $this->load->view('lister', $dataLayout, true);

            $this->load->view('layout', $dataLayout);
        }
		
		public function curler() {
			
			$this->load->library('curl');	
			
			$url= $this->input->post('message');
			/* si l'utilisateur n'a pas de http */
			if (preg_match('#^(www.)(.*)#i', $url)) {
				
				$url = 'http://' . $url;
			}
			/* si l'utilisateur n'a pas de http:// ni de www  */
			if (!preg_match('#^(http(s)?:\/\/)(.*)$#i', $url)) {	
				$url = 'http://www.' . $url;	
			} 
			
			
				/* récupération du site */
				$curlData = $this->curl->simple_get($url);
				
				$dataLayout['curl_site'] = $url;
				
				/* récupération du titre du site */
				if(preg_match('#<title>(.*?)<\/title>#i', $curlData, $curlTitle)) {
					$dataLayout['curl_titre'] = $curlTitle[1];
				}
				/* récupération de la description du site */
				if(preg_match('#name="description" content="(.*?)"#i', $curlData, $curlDescription)) {
					$dataLayout['curl_description'] = $curlDescription[1];
				}
				/* récupération des images du site  */
				if(preg_match_all('#<img.* src="(.*?)"#i', $curlData, $curlImages)) {
					$dataLayout['img'] = $curlImages;
				}
				
				$dataLayout['titre'] = 'CURL ME ! - Emmanuel Samu';
			
				$dataLayout['vue'] = $this->load->view('lister', $dataLayout, true);
			
				$this->load->view('layout', $dataLayout);
		}
		
		public function ajouter() {
			$this->load->model('M_Message');
			$this->M_Message->save();
			
			redirect($this->load->view('layout'));
		}
		
		public function supprimer($id) {
			$this->load->model('M_Message');
			
			$id = $this->uri->segment(3);
			$this->M_Message->deleteOne($id);
			

			if($this->input->is_ajax_request()) {
				echo "Le lien a été supprimé avec succès";
			} else {
				$dataLayout['titre'] = 'CURL ME ! - Suppression du lien';
				$dataLayout['vue'] = "ok";
				$dataLayout['vue'] = $this->load->view('ok', $dataLayout, true);
				$this->load->view('layout', $dataLayout);
			}
		}

}