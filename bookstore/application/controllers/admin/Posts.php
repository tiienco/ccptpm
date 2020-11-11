<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
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
        $data['_data'] = $this->admin->show_order('posts','id DESC');
        $data['pages'] = 'posts/index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

	function add($id=''){
        $id_user  = $this->session->userdata('id');
		if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('posts',array('id' => $id));              
        }else{
            $data['_btn_name']  = 'ins';   
            $data['_btn_value'] = 'Thêm mới';
        }

        $data['category'] = $this->admin->show_order_where('posts_category','sort DESC,id DESC',array('status' => 1));


        if($this->input->post('ins')){           
            $arr = array(
                'title'            => $this->input->post('title'),
                'slug'             => $this->input->post('slug'),
                'status'           => $this->input->post('status'),
                'category'         => $this->input->post('category'),
                'description'      => $this->input->post('description'),
                'content'          => $this->input->post('content'),
                // 'is_footer'     => $this->input->post('is_footer'),
                'meta_keyword'     => $this->input->post('meta_keyword'),
                'meta_description' => $this->input->post('meta_description'),
                'created_at'       => date('Y-m-d H:i:s'),
                'created_by'       => $id_user,
                'updated_at'       => date('Y-m-d H:i:s'),                        
                'updated_by'       => $id_user, 
            );

            if(!empty($_FILES['image']['name']))
                $arr['image'] = time()."_".$_FILES['image']['name'];
            
            $id = $this->admin->insert('posts',$arr);
            if($id){         
               
                if(!empty($_FILES['image']['name'])){
                    move_uploaded_file($_FILES['image']['tmp_name'], './upload/posts/'. $arr['image']);
                }

                echo json_encode(array('status' => 'true', "type" => "insert", "message" => "Tạo mới thành công", "id" => $id));
                exit;
                // echo"<script>alert('Tạo mới thành công');</script>";
                // echo"<script>window.location='".BASE_URL_ADMIN."posts/add/".$id."'</script>"; 
            }else{
                echo json_encode(array('status' => 'false', "type" => "insert", "message" => "Có lỗi xảy ra !", "id" => ""));
                exit;
                // echo"<script>alert('Có lỗi xảy ra !');</script>";
                // echo"<script>window.location='".BASE_URL_ADMIN."posts/add/'</script>"; 
            } 
        }elseif($this->input->post('upd')){
        	$arr = array(
                'title'            => $this->input->post('title'),
                'slug'             => $this->input->post('slug'),
                'status'           => $this->input->post('status'),
                'category'         => $this->input->post('category'),
                'description'      => $this->input->post('description'),
                'content'          => $this->input->post('content'),
                // 'is_footer'     => $this->input->post('is_footer'),
                'meta_keyword'     => $this->input->post('meta_keyword'),
                'meta_description' => $this->input->post('meta_description'),
                // 'created_at'       => date('Y-m-d H:i:s'),
                // 'created_by'       => $id_user,
                'updated_at'       => date('Y-m-d H:i:s'),                        
                'updated_by'       => $id_user, 
            );
            
            if(!empty($_FILES['image']['name']))
                $arr['image'] = time()."_".$_FILES['image']['name'];


            $this->admin->update('posts',array('id' => $id),$arr); 
            if(!empty($_FILES['image']['name'])){                
                move_uploaded_file($_FILES['image']['tmp_name'], './upload/posts/'. $arr['image']);
                @unlink('./upload/posts/'.$data['_detail']['image']);
            }    
            echo json_encode(array('status' => 'true', "type" => "update", "message" => "Cập nhật thành công", "id" => $id));
                exit;         
    		// echo"<script>alert('Cập nhật thành công');</script>";
            // echo"<script>window.location='".BASE_URL_ADMIN."posts/add/".$id."'</script>"; 
        }
		
		$data['pages'] = 'posts/detail';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}

	function delete(){
		$tmp = 0;
		$id_del = explode (',' , $this->input->post('id'));
    	foreach ($id_del as $id) {
    		$image = $this->admin->show_by_id('posts',array('id' => $id));
    		$this->admin->delete('posts',array('id'=>$id));
    		if($image['image']!='')
    			@unlink('./upload/posts/'. $image['image']);
    		$tmp = 1;
    	}
    	echo $tmp;
	}

    function category_index(){   
        $data['_data'] = $this->admin->show_order('posts_category','id DESC');
        $data['pages'] = 'posts/category_index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function category_add($id=''){
        $id_user  = $this->session->userdata('id');
        if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('posts_category',array('id' => $id));              
        }else{
            $data['_btn_name']  = 'ins';   
            $data['_btn_value'] = 'Thêm mới';
        }
        if($this->input->post('ins')){           
            $arr = array(
                'title'      => $this->input->post('title'),
                'slug'       => $this->input->post('slug'),
                'status'     => $this->input->post('status'),                
                'sort'       => $this->input->post('sort'),                
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $id_user,
                'updated_at' => date('Y-m-d H:i:s'),                        
                'updated_by' => $id_user, 
            );

            if(!empty($_FILES['image']['name']))
                $arr['image'] = time()."_".$_FILES['image']['name'];
            
            $id = $this->admin->insert('posts_category',$arr);
            if($id){   
                echo json_encode(array('status' => 'true', "type" => "insert", "message" => "Tạo mới thành công", "id" => $id));
                exit;      
                // echo"<script>alert('Tạo mới thành công');</script>";
                // echo"<script>window.location='".BASE_URL_ADMIN."posts/category_add/".$id."'</script>"; 
            }else{
                echo json_encode(array('status' => 'false', "type" => "insert", "message" => "Có lỗi xảy ra !", "id" => ""));
                exit;
                // echo"<script>alert('Có lỗi xảy ra !');</script>";
                // echo"<script>window.location='".BASE_URL_ADMIN."posts/category_add/'</script>"; 
            } 
        }elseif($this->input->post('upd')){
            $arr = array(
                'title'      => $this->input->post('title'),
                'slug'       => $this->input->post('slug'),
                'status'     => $this->input->post('status'),                
                'sort'       => $this->input->post('sort'),                
                // 'created_at' => date('Y-m-d H:i:s'),
                // 'created_by' => $id_user,
                'updated_at' => date('Y-m-d H:i:s'),                        
                'updated_by' => $id_user, 
            );        
           
            $this->admin->update('posts_category',array('id' => $id),$arr);  
            echo json_encode(array('status' => 'true', "type" => "update", "message" => "Cập nhật thành công", "id" => $id));
                exit;        
            // echo"<script>alert('Cập nhật thành công');</script>";
            // echo"<script>window.location='".BASE_URL_ADMIN."posts/category_add/".$id."'</script>"; 
        }
        
        $data['pages'] = 'posts/category_detail';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function category_delete(){
        $tmp = 0;
        $id_del = explode (',' , $this->input->post('id'));
        foreach ($id_del as $id) {
            // $image = $this->admin->show_by_id('posts',array('id' => $id));
            $this->admin->delete('posts_category',array('id'=>$id));
            // if($image['image']!='')
                // @unlink('./upload/posts/'. $image['image']);
            $tmp = 1;
        }
        echo $tmp;
    }
   
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */