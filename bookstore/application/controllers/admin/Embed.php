<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Embed extends CI_Controller {
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
        $data['_data'] = $this->admin->show_order('embed','sort DESC');
        $data['pages'] = 'embed/index';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function add($id=''){
        $user_id = $this->session->userdata('id');
        if($id){
            $data['_btn_name']  = 'upd';   
            $data['_btn_value'] = 'Cập nhật';  
            $data['_detail']    = $this->admin->show_by_id('embed',array('id' => $id));              
        }else{
            $data['_btn_name']  = 'ins';   
            $data['_btn_value'] = 'Thêm mới';
        }
        if($this->input->post('ins')){
            $arr = array(
                'title'      => $this->input->post('title'),
                'status'     => $this->input->post('status'),
                'content'    => $this->input->post('content'),
                'created_at' => @date('Y-m-d H:i:s'),
                'updated_at' => @date('Y-m-d H:i:s'),
                'created_by' => $user_id,
                'updated_by' => $user_id,
            );           
            $id = $this->admin->insert('embed',$arr);
            if($id){               
                echo"<script>alert('Thêm thành công');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."embed/add/".$id."'</script>"; 
            }else{
                echo"<script>alert('Có lỗi xảy ra !');</script>";
                echo"<script>window.location='".BASE_URL_ADMIN."embed/add'</script>";
            }          

        }elseif($this->input->post('upd')){
            $arr = array(
                'title'      => $this->input->post('title'),
                'status'     => $this->input->post('status'),
                'content'    => $this->input->post('content'),
                // 'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => @date('Y-m-d H:i:s'),
                // 'created_by' => $user_id,
                'updated_by' => $user_id,
            );     

            $this->admin->update('embed',array('id' => $id),$arr);           
            redirect(BASE_URL_ADMIN."embed/add/".$id);
            redirect(BASE_URL_ADMIN."embed/add/".$id,'refresh');
        }       
        $data['pages'] = 'embed/detail';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function delete(){
        $tmp = 0;
        $id_del = explode (',' , $this->input->post('id'));
        foreach ($id_del as $id) {
            // $image = $this->admin->show_by_id('embed',array('id' => $id));
            $this->admin->delete('embed',array('id'=>$id));
            $tmp = 1;
        }
        echo $tmp;
    }
   
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */