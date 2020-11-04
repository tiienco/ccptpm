<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {
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


	public function index(){	
		$data['_data'] = $this->admin->show_order('cart','id DESC');
		$data['pages'] = 'cart/index';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}

	public function detail($id){
        $data['_info'] = $this->admin->show_by_id('cart',array('id' => $id)); 
		$data['_detail'] = $this->admin->show_detail_cart($id);
		$data['pages'] = 'cart/detail';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}
    public function details($id){
       $this->admin->update('cart',array('id' => $id),array('status' => 1));
       redirect(BASE_URL_ADMIN."cart/detail/".$id,'refresh');
    }

	function delete(){
		$tmp = 0;
		$id_del = explode (',' , $this->input->post('id'));
    	foreach ($id_del as $id) {
    		$this->admin->delete('cart',array('id'=>$id));
    		$tmp = 1;
    	}
    	echo $tmp;
	}

    public function deleteImg(){ 
        $name   = $this->input->post('name');    
        $id     = $this->input->post('id');  
        $list   = $this->admin->show_by_id('cart',array('id' => $id));        
        $gallery = json_decode($list['album']);    
        foreach ($gallery as $key => $value) {
            if($value == $name){   
                if(is_file("./public/images/cart/".$name)) {
                    unlink("./public/images/cart/".$name);  
                    unset($gallery[$key]);              
                    break;
                }       
              
            }       
        }
        $gallery_2 = array_values($gallery);        
        $update = array('album' => json_encode($gallery_2));
        $this->admin->update('cart',array('id' => $id),$update);
    }
   
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */