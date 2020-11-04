<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();	
		$this->load->library('session');
		$this->load->helper('url');


		//$this->router->fetch_class(); // gét controlle ex : banner
		//$this->router->fetch_method(); // get method ex : index
        if($this->session->userdata('type') == 'user' || !$this->session->userdata('id')){
        	$this->session->sess_destroy();
            redirect(BASE_URL_ADMIN."login",'refresh');
        }

	}


	public function index(){	
		$data['pages'] = 'dashboard';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}

}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */