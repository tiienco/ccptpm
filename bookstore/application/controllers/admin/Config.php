<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {
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




    function setting(){
        if($this->input->post('submit')){
            $_detail = $this->admin->show_by_id('settings',array('id' => 1));
            $content = json_decode(@$_detail['value'],true);
            if (!is_array($content) && !($content instanceof Traversable)) $content = array();

            $content['web_name']     = $this->input->post('web_name');
            $content['web_desc']     = $this->input->post('web_desc');
            // $content['company_name'] = $this->input->post('company_name');
            // $content['company_desc'] = $this->input->post('company_desc');
            // $content['address']      = $this->input->post('address');
            $content['hotline']      = $this->input->post('hotline');
            $content['phone']        = $this->input->post('phone');
            // $content['email']        = $this->input->post('email');
            // $content['website']      = $this->input->post('website');
            // $content['timework_1']   = $this->input->post('timework_1');
            // $content['timework_2']   = $this->input->post('timework_2');
            // $content['timework_3']   = $this->input->post('timework_3');
            // $content['copyright']    = $this->input->post('copyright');
            $content['facebook']     = $this->input->post('facebook');
            $content['youtube']      = $this->input->post('youtube');           
            // $content['background']   = $this->input->post('background');
            // $content['color']        = $this->input->post('color');
            $content['custom_css']   = $this->input->post('custom_css');

            if(!empty($_FILES['favicon']['name'])){ 
                $content['favicon'] = 'favicon.ico';
            } 
            if(!empty($_FILES['logo_head']['name'])){ 
                $content['logo_head'] = "logo_header.png";
            } 
            // if(!empty($_FILES['logo_foot']['name'])){ 
                // $content['logo_foot'] = "logo_footer.png";
            // }   
            $this->admin->update('settings',array('id' => 1),array('value' => json_encode($content)));
            if(!empty($_FILES['favicon']['name'])){                
                move_uploaded_file($_FILES['favicon']['tmp_name'], './upload/images/'. $content['favicon']);
            } 
            if(!empty($_FILES['logo_head']['name'])){                
                move_uploaded_file($_FILES['logo_head']['tmp_name'], './upload/images/'. $content['logo_head']);
            } 
            // if(!empty($_FILES['logo_foot']['name'])){                
            //     move_uploaded_file($_FILES['logo_foot']['tmp_name'], './upload/images/'. $content['logo_foot']);
            // } 
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."config/setting'</script>";
        }
        $data['_data'] = $this->admin->show_by_id('settings',array('id' => 1));
        $data['pages'] = 'config/setting';
        $data['title'] = 'SETTING';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);

        // $data['_data'] = $this->admin->show_order('menu','sort DESC');
        // $data['pages'] = 'pages/menu/index';
        // $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function footer(){
        if($this->input->post('submit')){
            $upd = array(
                'value' => $this->input->post('footer')
            );
            $this->admin->update('settings',array('id' => 3),$upd);
            
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."config/footer'</script>";
        }
        $data['_data'] = $this->admin->show_by_id('settings',array('id' => 3));
        $data['pages'] = 'config/footer';
        $data['title'] = 'Footer';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function description(){
        if($this->input->post('submit')){
            $upd = array(
                'value' => $this->input->post('description')
            );
            $this->admin->update('settings',array('id' => 4),$upd);
            
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."config/description'</script>";
        }
        $data['_data'] = $this->admin->show_by_id('settings',array('id' => 4));
        $data['pages'] = 'config/description';
        $data['title'] = 'Giới thiệu ngắn';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function email(){
        if($this->input->post('submit')){
            $upd = array(
                'name'       => $this->input->post('name'),
                'email'      => $this->input->post('email'),
                'user'       => $this->input->post('user'),
                'pass'       => $this->input->post('pass'),
                'server'     => $this->input->post('server'),
                'port'       => $this->input->post('port'),
                'encryption' => $this->input->post('encryption'),
                'status'     => $this->input->post('status'),
            );   
           
            $this->admin->update('settings',array('id' => 2),array('value' => json_encode($upd)));         
            echo"<script>alert('Cập nhật thành công');</script>";
            echo"<script>window.location='".BASE_URL_ADMIN."config/email'</script>";
        }
        $data['_data'] = $this->admin->show_by_id('settings',array('id' => 2));
        $data['pages'] = 'config/email';
        $data['title'] = 'Email';
        $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    }

    function sendmail(){
        $detail = $this->admin->show_by_id('settings',array('id' => 2));
        $content = json_decode(@$detail['value'],true);
        if (!is_array($content) && !($content instanceof Traversable)) $content = array();

        if(empty($content)){
            echo "Chưa thiết lập email";exit;
        }



        $config = Array(
            'protocol'    => 'smtp', //smtp, sendmail, mail
            'smtp_host'   => $content['server'],
            'smtp_port'   => $content['port'],
            'smtp_crypto' => $content['encryption'],
            'smtp_user'   => $content['user'],
            'smtp_pass'   => $content['pass'],
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'wordwrap'    => TRUE
        );
        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
        $this->email->from($content['email'], $content['name']);      
        $this->email->to($content['email']);

        $cc = explode(PHP_EOL, $content['cc']);
        if (!is_array($cc) && !($cc instanceof Traversable)){
            $cc = array();
        }
        $cc = array_filter($cc, function($value) { return $value !== ''; });
        $new_cc = array();
        foreach ($cc as $cc) {
            $new_cc[] = trim($cc);
        }
        if(!empty($new_cc)){
            $this->email->bcc($new_cc);
        } 

        $this->email->subject("[".$content['name']."] check send mail ". date('Y-m-d H:i'));
        $this->email->message("Config to success ". date('Y-m-d H:i'));

        if($this->email->send()){
            echo ":Config success<br>";              
        }else{
            echo "error<br>";
            print_r($this->email->print_debugger());
        };
    }


    // function about_us(){
    //     if($this->input->post('submit')){
    //         $this->admin->update('config',array('id' => 1),array('content' => $this->input->post('content')));
    //         echo"<script>alert('Cập nhật thành công');</script>";
    //     }
    //     $data['_data'] = $this->admin->show_by_id('config',array('id' => 1));
    //     $data['pages'] = 'pages/config';
    //     $data['title'] = 'GIỚI THIỆU';
    //     $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    // }
    // function contact(){
    //     if($this->input->post('submit')){
    //         $this->admin->update('config',array('id' => 2),array('content' => $this->input->post('content')));
    //         echo"<script>alert('Cập nhật thành công');</script>";
    //     }
    //     $data['_data'] = $this->admin->show_by_id('config',array('id' => 2));
    //     $data['pages'] = 'pages/config';
    //     $data['title'] = 'LIÊN HỆ';
    //     $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    // }

    // function account($id=''){
    //     if($id){
    //         $data['_btn_name']  = 'upd';   
    //         $data['_btn_value'] = 'Cập nhật';  
    //         $data['_detail']    = $this->admin->show_by_id('user',array('id' => $id));              
    //     }else{
    //         $data['_btn_name']  = 'ins';   
    //         $data['_btn_value'] = 'Thêm mới';
    //     }
    //     if($this->input->post('ins')){
    //         $arr = array(
    //             'fullname'      => $this->input->post('fullname'),
    //             'username'       => $this->input->post('username'),
    //             'password'        => $this->input->post('password'),
    //             'pass_md5'        => md5($this->input->post('password')),              
    //             'public'     => $this->input->post('public'),               
    //             'datecreate' => time(),
    //         );          
    //         $id = $this->admin->insert('user',$arr);
    //         if($id){              
    //             echo"<script>alert('Thêm thành công');</script>";
    //             echo"<script>window.location='".BASE_URL_ADMIN."config/account/".$id."'</script>"; 
    //         }else{
    //             echo"<script>alert('Có lỗi xảy ra !');</script>";
    //             echo"<script>window.location='".BASE_URL_ADMIN."config/account'</script>";
    //         } 
    //     }elseif($this->input->post('upd')){
    //         $arr = array(
    //             'fullname'      => $this->input->post('fullname'),
    //             'username'       => $this->input->post('username'),
    //             // 'password'        => $this->input->post('password'),
    //             // 'pass_md5'        => md5($this->input->post('password')),              
    //             'public'     => $this->input->post('public'),   
    //         );           
    //         if($this->input->post('password')!=''){
    //             $arr['password'] = $this->input->post('password');
    //             $arr['pass_md5'] = md5($this->input->post('password'));
    //         }
    //         $this->admin->update('user',array('id' => $id),$arr);
           
    //         redirect(BASE_URL_ADMIN."config/account/".$id,'refresh');
    //     }
    //     $data['_data'] = $this->admin->show_order('user','id DESC');
    //     $data['pages'] = 'pages/user';
    //     $data['title'] = 'LIÊN HỆ';
    //     $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    // }
    // function delAccount($id){
    //     $this->admin->delete('user',array('id' => $id));
    //     echo"<script>alert('Xóa thành công');</script>";
    //     echo"<script>window.location='".BASE_URL_ADMIN."config/account/'</script>"; 
    // }

    // public function online(){    
    //     $data['_data'] = $this->admin->show_order('counter','id','DESC');
    //     $data['pages'] = 'pages/online';
    //     $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    // }

    // function distribu(){
    //     if($this->input->post('submit')){
    //     	// echo 1;exit;
    //     	// print_r($this->input->post());
    //         $this->admin->update('config',array('id' => 17),array('content' => $this->input->post('content'),'slug' => $this->input->post('slug'),'type' => $this->input->post('type'),'title' => $this->input->post('title')));
    //         echo"<script>alert('Cập nhật thành công');</script>";
    //         echo"<script>window.location='".BASE_URL_ADMIN."config/distribu'</script>";
    //     }
    //     $data['_data'] = $this->admin->show_by_id('config',array('id' => 17));
    //     $data['pages'] = 'pages/dynamic';
    //     $data['title'] = $data['_data']['title'];
    //     $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    // }
    // function blog(){
    //     if($this->input->post('submit')){
    //     	// echo 1;exit;
    //     	// print_r($this->input->post());
    //         $this->admin->update('config',array('id' => 18),array('content' => $this->input->post('content'),'slug' => $this->input->post('slug'),'type' => $this->input->post('type'),'title' => $this->input->post('title')));
    //         echo"<script>alert('Cập nhật thành công');</script>";
    //         echo"<script>window.location='".BASE_URL_ADMIN."config/distribu'</script>";
    //     }
    //     $data['_data'] = $this->admin->show_by_id('config',array('id' => 18));
    //     $data['pages'] = 'pages/dynamic';
    //     $data['title'] = $data['_data']['title'];
    //     $this->load->view(DEFAULT_VIEW_ADMIN_INDEX,$data);
    // }
    // function dynamic($id){
    // 	if($this->input->post('submit')){
    //     	// echo 1;exit;
    //     	// print_r($this->input->post());
    //         $this->admin->update('config',array('id' => $id),array('content' => $this->input->post('content'),'slug' => $this->input->post('slug'),'type' => $this->input->post('type'),'title' => $this->input->post('title')));
    //         echo"<script>alert('Cập nhật thành công');</script>";

    //         if($id == 17)
    //         	echo"<script>window.location='".BASE_URL_ADMIN."config/distribu'</script>";
    //        	else echo"<script>window.location='".BASE_URL_ADMIN."config/blog'</script>";
    //     }
    // }
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */