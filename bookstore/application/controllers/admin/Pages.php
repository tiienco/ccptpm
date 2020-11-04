<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	public function __construct(){
		parent::__construct();	
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Admin_model','admin');

		//$this->router->fetch_class(); // gét controlle ex : banner
		//$this->router->fetch_method(); // get method ex : index
        if($this->session->userdata('type') == 'user')
            redirect(BASE_URL_ADMIN."login",'refresh');
		if(!$this->session->userdata('id'))
			redirect(BASE_URL_ADMIN."login",'refresh');
	}


    //========================= HOME
    function home(){
        if($this->input->post('submit')){
            $upd = array(
                'content' => json_encode(array('description' => $this->input->post('description'))),
                'meta_keyword' => $this->input->post('meta_keyword'),
                'meta_description' => $this->input->post('meta_description'),            
                
            );
            $this->admin->update('pages_fix',array('id' => 1),$upd);
            
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."pages/home'</script>";
        }
        $data['_data'] = $this->admin->show_by_id('pages_fix',array('id' => 1));
        $data['pages'] = 'pages/home';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    //========================= CONTACT
    function contact(){
        if($this->input->post('submit')){
            $upd = array(
                'content' => json_encode(array('description' => $this->input->post('description'),'google_map' => $this->input->post('google_map'))),
                'meta_keyword' => $this->input->post('meta_keyword'),
                'meta_description' => $this->input->post('meta_description'),            
                
            );
            $this->admin->update('pages_fix',array('id' => 2),$upd);
            
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."pages/contact'</script>";
        }
        $data['_data'] = $this->admin->show_by_id('pages_fix',array('id' => 2));
        $data['pages'] = 'pages/contact';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

   
   
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */


