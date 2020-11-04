<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();	
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Admin_model','admin');
	}
	
	public function index(){
        if($this->session->userdata('id')){
        	redirect(BASE_URL_ADMIN."dashboard",'refresh');
        }
		$data['_error'] = '';
		if($this->input->post('username')){
			$check = $this->admin->show_by_id('users',array('username' => $this->input->post('username'),'password' => md5($this->input->post('password')),'status' => 1, 'level' => 'admin'));
			if(!empty($check)){
				$this->session->set_userdata('id',$check['id']);
				$this->session->set_userdata('level',$check['level']);
				$this->session->set_userdata('fullname',$check['fullname']);
				$this->session->set_userdata('username',$check['username']);
				$this->session->set_userdata('avatar',($check['avatar']?:'avatar.jpg'));
				redirect(BASE_URL_ADMIN."dashboard",'refresh');
			}else{
				$data['_error'] = 'Invalid username';
			}
		}		
        $this->load->view('admin/login',$data);
	}   	
   	function logout(){
   		$this->session->sess_destroy();
   		redirect(BASE_URL_ADMIN."login",'refresh');
   	}
	
}

