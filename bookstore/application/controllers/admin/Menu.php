<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
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
        $data['_data'] = $this->admin->show_order('menu','sort DESC');
        $data['pages'] = 'menu/index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

	public function add($id=''){
        $id_user  = $this->session->userdata('id');
		if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('menu',array('id' => $id));              
        }else{
            $data['_btn_name']  = 'ins';   
            $data['_btn_value'] = 'Thêm mới';
        }
        if($this->input->post('ins')){           
            $arr = array(
                'title'      => $this->input->post('title'),
                'status'     => $this->input->post('status'),
                'link'       => $this->input->post('link'),
                'sort'       => $this->input->post('sort'),                
                'position'   => $this->input->post('position'),                
                'is_blank'   => $this->input->post('is_blank')?:0, 
                'created_at' => @date('Y-m-d H:i:s'),             
                'updated_at' => @date('Y-m-d H:i:s'),             
                'created_by' => $id_user,            
                'updated_by' => $id_user,            
            );   
        		
    		$id = $this->admin->insert('menu',$arr);
    		if($id){
                echo json_encode(array('status' => 'true', "type" => "insert", "message" => "Tạo mới thành công", "id" => $id));
                exit;
    		}else{
                echo json_encode(array('status' => 'false', "type" => "insert", "message" => "Có lỗi xảy ra !", "id" => ""));
                exit;
    		} 
        }elseif($this->input->post('upd')){
        	$arr = array(
                'title'      => $this->input->post('title'),
                'status'     => $this->input->post('status'),
                'link'       => $this->input->post('link'),
                'sort'       => $this->input->post('sort'),                
                'position'   => $this->input->post('position'),                
                'is_blank'   => $this->input->post('is_blank')?:0,             
                'updated_at' => @date('Y-m-d H:i:s'),                        
                'updated_by' => $id_user,            
            );             
            $this->admin->update('menu',array('id' => $id),$arr);    		

            echo json_encode(array('status' => 'true', "type" => "update", "message" => "Cập nhật thành công", "id" => $id));
                exit;
        }
		
		$data['pages'] = 'menu/detail';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}

	function delete(){
		$tmp = 0;
		$id_del = explode (',' , $this->input->post('id'));
    	foreach ($id_del as $id) {
    		// $image = $this->admin->show_by_id('category',array('id' => $id));
    		$this->admin->delete('menu',array('id'=>$id));
    		// if($image['image']!='')
    			// unlink('./upload/category/'. $image['image']);
    		$tmp = 1;
    	}
    	echo $tmp;
	}
   
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */