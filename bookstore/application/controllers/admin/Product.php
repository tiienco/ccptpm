<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
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
        $data['_data'] = $this->admin->show_order('product','id DESC');
        $data['pages'] = 'product/index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

	function add($id=''){
        $id_user  = $this->session->userdata('id');
		if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('product',array('id' => $id));              
        }else{
            $data['_btn_name']  = 'ins';   
            $data['_btn_value'] = 'Thêm mới';
        }

        $data['category'] = $this->admin->show_order_where('product_category','sort DESC,id DESC',array('status' => 1));
        $data['material'] = $this->admin->show_order_where('product_material','sort DESC,id DESC',array('status' => 1));
        $data['color'] = $this->admin->show_order_where('product_color','sort DESC,id DESC',array('status' => 1));


        if($this->input->post('ins')){          
            $arr = array(
                'title'            => $this->input->post('title'),
                'slug'             => $this->input->post('slug'),
                'status'           => $this->input->post('status'),
                'type'             => $this->input->post('type'),
                'price'            => $this->input->post('price'),
                'is_new'           => $this->input->post('is_new'),
                'sale_percent'     => $this->input->post('sale_percent'),
                'sale_price'       => $this->input->post('sale_price'),
                'is_saleoff'       => $this->input->post('is_saleoff'),
                'category'         => implode(',', $this->input->post('category')),
                'is_featured'      => $this->input->post('is_featured'),
                'sku'              => $this->input->post('sku'),
                'material_id'      => $this->input->post('material_id'),
                'color_id'         => $this->input->post('color_id'),
                'content'          => $this->input->post('content'),
                'meta_keyword'     => $this->input->post('meta_keyword'),
                'meta_description' => $this->input->post('meta_description'),
                'created_at'       => date('Y-m-d H:i:s'),
                'created_by'       => $id_user,
                'updated_at'       => date('Y-m-d H:i:s'),                        
                'updated_by'       => $id_user, 
            );

            if(!empty($_FILES['image']['name']))
                $arr['image'] = time()."_".$_FILES['image']['name'];
            

            $img_list = array();
            if(!empty($_FILES['image_list']['name'][0])){
                for($i=0; $i<count($_FILES['image_list']['name']); $i++){
                    $img_list[$i] = time()."_".$_FILES['image_list']['name'][$i];                     
                } 
            }
            $arr['image_list'] = json_encode($img_list);

            $id = $this->admin->insert('product',$arr);
            if($id){   
                if(!empty($_FILES['image']['name'])){
                    move_uploaded_file($_FILES['image']['tmp_name'], './upload/product/'. $arr['image']);
                }
                if(!empty($_FILES['image_list']['name'][0])){
                    for($i=0; $i<count($_FILES['image_list']['name']); $i++){
                        move_uploaded_file($_FILES['image_list']['tmp_name'][$i],'./upload/product/'.$img_list[$i]);                 
                    } 
                }
              
                echo"<script>alert('Tạo mới thành công');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."product/add/".$id."'</script>"; 
            }else{
                echo"<script>alert('Có lỗi xảy ra !');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."product/add/'</script>"; 
            } 
        }elseif($this->input->post('upd')){
        	$arr = array(
                'title'            => $this->input->post('title'),
                'slug'             => $this->input->post('slug'),
                'status'           => $this->input->post('status'),
                'type'             => $this->input->post('type'),
                'price'            => $this->input->post('price'),
                'is_new'           => $this->input->post('is_new'),
                'sale_percent'     => $this->input->post('sale_percent'),
                'sale_price'       => $this->input->post('sale_price'),
                'is_saleoff'       => $this->input->post('is_saleoff'),
                'category'         => implode(',', $this->input->post('category')),
                'is_featured'      => $this->input->post('is_featured'),
                'sku'              => $this->input->post('sku'),
                'material_id'      => $this->input->post('material_id'),
                'color_id'         => $this->input->post('color_id'),
                'content'          => $this->input->post('content'),
                'meta_keyword'     => $this->input->post('meta_keyword'),
                'meta_description' => $this->input->post('meta_description'),
                // 'created_at'       => date('Y-m-d H:i:s'),
                // 'created_by'       => $id_user,
                'updated_at'       => date('Y-m-d H:i:s'),                        
                'updated_by'       => $id_user, 
            );
            if(!empty($_FILES['image']['name']))
                $arr['image'] = time()."_".$_FILES['image']['name'];
            

            $image_list_old = json_decode(@$data['_detail']['image_list'],true);
            if (!is_array($image_list_old) && !($image_list_old instanceof Traversable)) $image_list_old = array();

            $img_list = array();
            if(!empty($_FILES['image_list']['name'][0])){
                for($i=0; $i<count($_FILES['image_list']['name']); $i++){
                    $img_list[$i] = time()."_".$_FILES['image_list']['name'][$i];                     
                } 
            }
            $image_list_old = array_merge($image_list_old,$img_list);
            $image_list_old = array_filter($image_list_old, function($value) { return $value !== ''; });
            $image_list_old = array_values($image_list_old);

            $arr['image_list'] = json_encode($image_list_old);  

            $this->admin->update('product',array('id' => $id),$arr); 

            if(!empty($_FILES['image']['name'])){                
                move_uploaded_file($_FILES['image']['tmp_name'], './upload/product/'. $arr['image']);
                @unlink('./upload/product/'.$data['_detail']['image']);
            } 

            if(!empty($_FILES['image_list']['name'][0])){
                for($i=0; $i<count($_FILES['image_list']['name']); $i++){
                    move_uploaded_file($_FILES['image_list']['tmp_name'][$i],'./upload/product/'.$img_list[$i]);                 
                } 
            }

    		echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."product/add/".$id."'</script>"; 
        }
		
		$data['pages'] = 'product/detail';
		$this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
	}


    function deleteImgProd(){
        $id = $this->input->post('id');
        $img = $this->input->post('img');

        $check = $this->admin->show_by_id('product',array('id' => $id),'image_list');
        $image_list = json_decode(@$check['image_list'],true);
        if (!is_array($image_list) && !($image_list instanceof Traversable)) $image_list = array();
        $key = array_search($img, $image_list);
        if($key!== false){
            unset($image_list[$key]);
            $image_list = array_values($image_list);
            $this->admin->update('product',array('id' => $id),array('image_list' => json_encode($image_list)));
            @unlink('./upload/product/'. $img);
            echo json_encode(array('status' => 'true', 'message' => 'Delete success.'));
        }else echo json_encode(array('status' => 'false', 'message' => 'Delete missing.'));

    }
	function delete(){
		$tmp = 0;
		$id_del = explode (',' , $this->input->post('id'));
    	foreach ($id_del as $id) {
    		$image = $this->admin->show_by_id('product',array('id' => $id));
    		$this->admin->delete('product',array('id'=>$id));
    		if($image['image']!='')
    			@unlink('./upload/product/'. $image['image']);

            $image_list= json_decode(@$image['image_list'],true);
            if (!is_array($image_list) && !($image_list instanceof Traversable)) $image_list = array();
            foreach ($image_list as $img) {
                @unlink('./upload/product/'. $img);
            }

    		$tmp = 1;
    	}
    	echo $tmp;
	}


    // =====================  CATEGORY ==========================//
    function category_index(){   
        $data['_data'] = $this->admin->show_order('product_category','id DESC');
        $data['pages'] = 'product/category_index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function category_add($id=''){
        $id_user  = $this->session->userdata('id');
        if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('product_category',array('id' => $id));              
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
                'is_home'    => $this->input->post('is_home'),                
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $id_user,
                'updated_at' => date('Y-m-d H:i:s'),                        
                'updated_by' => $id_user, 
            );
            
            $id = $this->admin->insert('product_category',$arr);
            if($id){         
                echo"<script>alert('Tạo mới thành công');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."product/category_add/".$id."'</script>"; 
            }else{
                echo"<script>alert('Có lỗi xảy ra !');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."product/category_add/'</script>"; 
            } 
        }elseif($this->input->post('upd')){
            $arr = array(
                'title'      => $this->input->post('title'),
                'slug'       => $this->input->post('slug'),
                'status'     => $this->input->post('status'),                
                'sort'       => $this->input->post('sort'), 
                'is_home'    => $this->input->post('is_home'),               
                // 'created_at' => date('Y-m-d H:i:s'),
                // 'created_by' => $id_user,
                'updated_at' => date('Y-m-d H:i:s'),                        
                'updated_by' => $id_user, 
            );        
           
            $this->admin->update('product_category',array('id' => $id),$arr);          
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."product/category_add/".$id."'</script>"; 
        }
        
        $data['pages'] = 'product/category_detail';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function category_delete(){
        $tmp = 0;
        $id_del = explode (',' , $this->input->post('id'));
        foreach ($id_del as $id) {
            $this->admin->delete('product_category',array('id'=>$id));
            $tmp = 1;
        }
        echo $tmp;
    }

    // =====================  MATERIAL  ==========================//
    function material_index(){   
        $data['_data'] = $this->admin->show_order('product_material','id DESC');
        $data['pages'] = 'product/material_index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function material_add($id=''){
        $id_user  = $this->session->userdata('id');
        if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('product_material',array('id' => $id));              
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
            
            $id = $this->admin->insert('product_material',$arr);
            if($id){         
                echo"<script>alert('Tạo mới thành công');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."product/material_add/".$id."'</script>"; 
            }else{
                echo"<script>alert('Có lỗi xảy ra !');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."product/material_add/'</script>"; 
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
           
            $this->admin->update('material_category',array('id' => $id),$arr);          
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."product/material_add/".$id."'</script>"; 
        }
        
        $data['pages'] = 'product/material_detail';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function material_delete(){
        $tmp = 0;
        $id_del = explode (',' , $this->input->post('id'));
        foreach ($id_del as $id) {
            $this->admin->delete('product_material',array('id'=>$id));
            $tmp = 1;
        }
        echo $tmp;
    }

    // =====================  COLOR  ==========================//
    function color_index(){   
        $data['_data'] = $this->admin->show_order('product_color','id DESC');
        $data['pages'] = 'product/color_index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function color_add($id=''){
        $id_user  = $this->session->userdata('id');
        if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('product_color',array('id' => $id));              
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
            
            $id = $this->admin->insert('product_color',$arr);
            if($id){         
                echo"<script>alert('Tạo mới thành công');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."product/color_add/".$id."'</script>"; 
            }else{
                echo"<script>alert('Có lỗi xảy ra !');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."product/color_add/'</script>"; 
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
           
            $this->admin->update('product_color',array('id' => $id),$arr);          
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."product/color_add/".$id."'</script>"; 
        }
        
        $data['pages'] = 'product/color_detail';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function color_delete(){
        $tmp = 0;
        $id_del = explode (',' , $this->input->post('id'));
        foreach ($id_del as $id) {
            $this->admin->delete('color_category',array('id'=>$id));
            $tmp = 1;
        }
        echo $tmp;
    }
   
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */


