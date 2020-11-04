<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
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
        $data['_data'] = $this->admin->show_order('users','id DESC');
        $data['pages'] = 'users/index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

	public function add($id=''){
        $id_user  = $this->session->userdata('id');
		if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('users',array('id' => $id));              
        }else{
            $data['_btn_name']  = 'ins';   
            $data['_btn_value'] = 'Thêm mới';
        }
        if($this->input->post('ins')){
            $check = $this->admin->show_by_id('users',array('username' => $this->input->post('username')));
            if(!empty($check)){
                echo"<script>alert('Tài khoản đã tồn tại');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."users/add/'</script>"; 
                exit;
            }
            $arr = array(
                'username'   => $this->input->post('username'),
                'fullname'   => $this->input->post('fullname'),
                'email'      => $this->input->post('email'),
                'phone'      => $this->input->post('phone'),                
                'address'    => $this->input->post('address'),                
                'status'     => $this->input->post('status'), 
                'created_at' => date('Y-m-d H:i:s'),             
                'updated_at' => date('Y-m-d H:i:s'),             
                'level'      => 'admin',             
            );   
            if(!empty($this->input->post('password')) && !empty($this->input->post('re_password'))){
                if($this->input->post('password') != $this->input->post('re_password')){
                    echo"<script>alert('Mật khẩu xác nhận không đúng.');</script>";
                    echo"<script>window.location='".BASE_URL_ADMIN."users/add/'</script>"; 
                    exit;
                }
                $arr['password'] = md5($this->input->post('password'));
                // $arr['password_no_hash'] = $this->input->post('password');
            }

        		
    		$id = $this->admin->insert('users',$arr);
    		if($id){
    			echo"<script>alert('Thêm thành công');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."users/add/".$id."'</script>"; 
    		}else{
    			echo"<script>alert('Có lỗi xảy ra !');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."users/add'</script>";
    		} 
        }elseif($this->input->post('upd')){
        	$arr = array(
                'fullname'   => $this->input->post('fullname'),
                'email'      => $this->input->post('email'),
                'phone'      => $this->input->post('phone'),                
                'address'    => $this->input->post('address'),                
                'status'     => $this->input->post('status'), 
                'updated_at' => date('Y-m-d H:i:s'),             
            );     

            if(!empty($this->input->post('password')) && !empty($this->input->post('re_password'))){
                if($this->input->post('password') != $this->input->post('re_password')){
                    echo"<script>alert('Mật khẩu xác nhận không đúng.');</script>";
                    echo"<script>window.location='".BASE_URL_ADMIN."users/add/".$id."'</script>"; 
                    exit;
                }
                $arr['password'] = md5($this->input->post('password'));
                // $arr['password_no_hash'] = $this->input->post('password');
            }
            $this->admin->update('users',array('id' => $id),$arr);
    		echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."users/add/".$id."'</script>"; 
        }
		
		$data['pages'] = 'users/detail';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}

	function delete(){
		$tmp = 0;
		$id_del = explode (',' , $this->input->post('id'));
    	foreach ($id_del as $id) {
    		// $image = $this->admin->show_by_id('category',array('id' => $id));
    		$this->admin->delete('users',array('id'=>$id));
    		// if($image['image']!='')
    			// unlink('./upload/category/'. $image['image']);
    		$tmp = 1;
    	}
    	echo $tmp;
	}
   
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */