<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {
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


	function index(){	
		$data['_data'] = $this->admin->show_order('banner','sort DESC');
		$data['pages'] = 'banner/index';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}

	function add($id=''){
        $id_user  = $this->session->userdata('id');
		if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('banner',array('id' => $id));              
        }else{
            $data['_btn_name']  = 'ins';   
            $data['_btn_value'] = 'Thêm mới';
        }
        if($this->input->post('ins')){
        	$arr = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status'      => $this->input->post('status'),
                'sort'        => $this->input->post('sort'),
                'created_at'  => date('Y-m-d H:i:s'),             
                'updated_at'  => date('Y-m-d H:i:s'),             
                'created_by'  => $id_user,            
                'updated_by'  => $id_user, 
    		);
    		if(!empty($_FILES['image']['name'])){ 
                $arr['image'] = time()."_".$_FILES['image']['name'];
            }    
    		$id = $this->admin->insert('banner',$arr);
    		if($id){
                if(!empty($_FILES['image']['name']))
                    move_uploaded_file($_FILES['image']['tmp_name'], './upload/banner/'. $arr['image']);
    			echo"<script>alert('Thêm thành công');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."banner/add/".$id."'</script>"; 
    		}else{
    			echo"<script>alert('Có lỗi xảy ra !');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."banner/add'</script>";
    		} 
        }elseif($this->input->post('upd')){
        	$arr = array(
                'title'         => $this->input->post('title'),
                'description'   => $this->input->post('description'),
                'status'        => $this->input->post('status'),
                // 'created_at' => date('Y-m-d H:i:s'),             
                'updated_at'    => date('Y-m-d H:i:s'),             
                // 'created_by' => $id_user,            
                'updated_by'    => $id_user, 
    		);
    		if(!empty($_FILES['image']['name'])){ 
                $arr['image'] = time()."_".$_FILES['image']['name'];            
            } 
    		$this->admin->update('banner',array('id' => $id),$arr);
    		if(!empty($_FILES['image']['name'])){                
                move_uploaded_file($_FILES['image']['tmp_name'], './upload/banner/'. $arr['image']);
                unlink('./upload/banner/'.$data['_detail']['image']);
            } 
    		redirect(BASE_URL_ADMIN."banner/add/".$id,'refresh');
        }

		
		$data['pages'] = 'banner/detail';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}

	function delete(){
		$tmp = 0;
		$id_del = explode (',' , $this->input->post('id'));
    	foreach ($id_del as $id) {
    		$image = $this->admin->show_by_id('banner',array('id' => $id));
    		$this->admin->delete('banner',array('id'=>$id));
    		if($image['image']!='')
    			unlink('./upload/banner/'. $image['image']);
    		$tmp = 1;
    	}
    	echo $tmp;
	}
   
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */