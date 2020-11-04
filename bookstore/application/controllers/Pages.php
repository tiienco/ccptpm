<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
    private $data;
	public function __construct(){
		parent::__construct();    
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Global_model','global');
        $this->load->library('cart');
        $this->load->helper('captcha');
        $this->load->library('Myfunctions','','myfunctions');
        $this->data['_global'] = $this->__global();


    }

    function __global(){   
        $menu = $this->global->show_order_where('menu','sort DESC, id ASC',array('status' => 1),'title,link,position,is_blank');
        $config = $this->global->show_all('settings');
        $info = json_decode($config[0]['value'],true);
        // $embeb = $this->global->show_where('embed', array('status' => 1),'content');
        return array(
            'web_name' => $info['web_name'],
            'web_desc' => $info['web_desc'],
            'menu'     => $menu,
            'info'     => $info,
            'footer'   => $config[2],
            'embeb'    => [],
        );

        // print_r(json_decode($config[1]['value'],true));
    }

    function index(){  
        $category = $this->global->show_order_where('product_category','sort DESC, id ASC',array('status' => 1, 'is_home' => 1),'id,title,slug');
        $category_home = array();

        $category_home[] = array(
            'category' => array(
                'id'    => '0',
                'title' => 'Sản phẩm nỗi bật',
                'slug'  => 'san-pham-noi-bat',
                'type'  => 'unlink',
            ),
            'product' => $this->global->show_pagination('product',10,0,'id DESC','status = 1','id,sku,title,slug,price,sale_price,sale_percent,image,is_featured,is_new,is_saleoff'),
        );
        foreach ($category as $value) {
            $where = "status = 1 AND FIND_IN_SET(".$value['id'].",category)";
            $category_home[] = array(
                'category' => array(
                    'id'    => $value['id'],
                    'title' => $value['title'],
                    'slug'  => $value['slug'],
                    'type'  => 'link',
                ),
                'product' => $this->global->show_pagination('product',10,0,'id DESC',$where,'id,sku,title,slug,price,sale_price,sale_percent,image,is_featured,is_new,is_saleoff'),
            );
        }
        $this->data['_category_home'] = $category_home;


        $this->data['_feedback'] = $this->global->show_order_where('feedback','sort DESC, id DESC', array('status' => 1),'title,link,image,content');
        // $this->data['_logo']     = $this->global->show_order_where('logo','sort DESC, id DESC', array('status' => 1),'title,link,image');
        $this->data['_banner']     = $this->global->show_order_where('banner','sort DESC, id DESC', array('status' => 1),'title,description,image');

        $this->data['_content']     = $this->global->show_by_id('pages_fix',array('id' => 1));



        $this->data['_pages'] = 'home.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL,
            'title'       => '',
            'og_title'    => '',
            'description' => $this->data['_content']['meta_description'],
            'image'       => BASE_URL.'public/image/img-index.png',
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }

    function contact(){
        $this->data['_captha'] = $this->createCaptcha(160);
        $this->data['_data'] = $this->global->show_by_id('pages_fix',array('id' => 2));
        $this->data['_pages'] = 'contact.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL,
            'title'       => 'Liên hệ',
            'og_title'    => 'Liên hệ',
            'description' => $this->data['_data']['meta_description'],
            'image'       => BASE_URL.'public/image/img-index.png',
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }
    function introduce(){
        $this->data['_pages'] = 'contact.php'; 
        $this->data['_data'] = $this->global->show_by_id('pages_fix',array('id' => 2));
        $this->data['SEO'] = array(
            'url'         => BASE_URL,
            'title'       => 'Liên hệ',
            'og_title'    => 'Liên hệ',
            'description' => 'Đọc truyện tranh, đọc truyện Online, truyện tranh tại TC Truyện, cập nhật liên tục, kho truyện lớn, với nhiều thể loại, hấp dẫn, từ kinh dị đến lãng mạn, từ người già đến trẻ em. TC Truyen - tctruyen.com',
            'image'       => BASE_URL.'public/image/img-index.png',
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }



    //==================================================//
    //=================     PRODUCT     ===============//
    //================================================//
    function product(){
        $_get = $this->input->get();
        $pages = @$this->input->get('pages')?:1;
        $orderby      = 'id DESC';
        $search_query = array();
        $where        = array();
        $where[] = 'status = 1';
        $where = implode(' AND ', $where);


        if(!empty($search_query)) $search_query = "&".implode('&', $search_query);
        else $search_query='';
        $this->load->library("pagination");
        $config['base_url']         = BASE_URL . "san-pham";
        $config['total_rows']       = $this->global->count_where('product',$where);
        $config['per_page']         = 24;
        $config['uri_segment']      = false; // uri (important) 

        $config['page_query_string']    = TRUE; 
        $config['query_string_segment'] = 'pages';
        // $config['reuse_query_string'] = TRUE;

        // $config['prefix'] = 'abc';
        $config['suffix'] = $search_query;

        $config['use_page_numbers'] = TRUE;     
        $config['num_links']        = 3; //số nut trnag hiên thị
        $config['first_link']       = false; //'«';
        $config['last_link']        = false;//'»';
        $config['next_link']        = '→';
        $config['prev_link']        = '←';
        $this->pagination->initialize($config); // Chạy phân trang
        
        if($pages >= 2) $start = $config['per_page'] * $pages - $config['per_page'];
        else $start = 0;  

        $this->data['data']   = $this->global->show_pagination('product',$config['per_page'],$start,$orderby,$where); 


        // $this->data['material'] = $this->global->show_order_where('product_material','sort DESC, title ASC',array('status' => 1)); 
        // $this->data['color']    = $this->global->show_order_where('product_color','sort DESC, title ASC',array('status' => 1));          

        $this->data['_pages'] = 'product.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL,
            'title'       => 'Sản phẩm',
            'og_title'    => 'Sản phẩm',
            'description' => 'Đọc truyện tranh, đọc truyện Online, truyện tranh tại TC Truyện, cập nhật liên tục, kho truyện lớn, với nhiều thể loại, hấp dẫn, từ kinh dị đến lãng mạn, từ người già đến trẻ em. TC Truyen - tctruyen.com',
            'image'       => BASE_URL.'public/image/img-index.png',
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }

    function product_category($slug=''){
        $check = $this->global->show_by_id('product_category',array('slug' => $slug, 'status' => 1));
        if(empty($check))
            redirect(BASE_URL.'san-pham','refresh');
        $this->data['_detail'] = $check;


        $_get = $this->input->get();
        $pages = @$this->input->get('pages')?:1;
        $orderby      = 'id DESC';
        $search_query = array();
        $where        = array();
        $where[] = 'status = 1';
        $where[] = 'FIND_IN_SET('.$check['id'].',category)';
        $where = implode(' AND ', $where);


        if(!empty($search_query)) $search_query = "&".implode('&', $search_query);
        else $search_query='';
        $this->load->library("pagination");
        $config['base_url']         = BASE_URL . "san-pham/".$slug."/";
        $config['total_rows']       = $this->global->count_where('product',$where);
        $config['per_page']         = 24;
        $config['uri_segment']      = false; // uri (important) 

        $config['page_query_string']    = TRUE; 
        $config['query_string_segment'] = 'pages';
        // $config['reuse_query_string'] = TRUE;

        // $config['prefix'] = 'abc';
        $config['suffix'] = $search_query;

        $config['use_page_numbers'] = TRUE;     
        $config['num_links']        = 3; //số nut trnag hiên thị
        $config['first_link']       = false; //'«';
        $config['last_link']        = false;//'»';
        $config['next_link']        = '→';
        $config['prev_link']        = '←';
        $this->pagination->initialize($config); // Chạy phân trang
        
        if($pages >= 2) $start = $config['per_page'] * $pages - $config['per_page'];
        else $start = 0;  

        $this->data['data']   = $this->global->show_pagination('product',$config['per_page'],$start,$orderby,$where); 


        $this->data['material'] = $this->global->show_order_where('product_material','sort DESC, title ASC',array('status' => 1)); 
        $this->data['color']    = $this->global->show_order_where('product_color','sort DESC, title ASC',array('status' => 1));          

        $this->data['_pages'] = 'product_category.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL,
            'title'       => $check['title'],
            'og_title'    => $check['title'],
            'description' => 'Đọc truyện tranh, đọc truyện Online, truyện tranh tại TC Truyện, cập nhật liên tục, kho truyện lớn, với nhiều thể loại, hấp dẫn, từ kinh dị đến lãng mạn, từ người già đến trẻ em. TC Truyen - tctruyen.com',
            'image'       => BASE_URL.'public/image/img-index.png',
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }

    function product_detail($slug=''){
        $check = $this->global->show_by_id('product',array('slug' => $slug, 'status' => 1));
        if(empty($check))
            redirect(BASE_URL.'san-pham','refresh');
        $this->data['_detail'] = $check;
        // $this->data['color'] = $this->global->show_by_id('product_color',array('id' => $check['color_id']));
        // $this->data['material'] = $this->global->show_by_id('product_material',array('id' => $check['material_id']));

        $category = explode(',', $check['category']);
        if(empty($category)) $category = '0';
        else $category = implode(',', $category);
        $this->data['category'] = $this->global->show_order_where('product_category','sort DESC, title ASC','id IN('.$category.')');


        $where_cate = array();
        foreach (explode(',', $category) as $cate) {
            $where_cate[] = "FIND_IN_SET($cate,category)";
        }
        $where_cate = implode(" OR ", $where_cate);
        $this->data['product_others'] = $this->global->show_pagination('product',12,0,'id desc','id != '.$check['id'].' AND ('.$where_cate.')');


        $this->data['_pages'] = 'product_detail.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL."san-pham/".$check['slug'].".html",
            'title'       => $check['title'],
            'og_title'    => $check['title'],
            'description' => number_format(($check['is_saleoff']==1?$check['sale_price']:$check['price']),0,",",".")." VNĐ",
            'image'       => BASE_UPLOAD.'product/'.$check['image'],
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }

    //==================================================//
    //=================     PRODUCT     ===============//
    //================================================//
    function posts(){
        $_get = $this->input->get();
        $pages = @$this->input->get('pages')?:1;
        $orderby      = 'id DESC';
        $search_query = array();
        $where        = array();
        $where[] = 'status = 1';
        $where = implode(' AND ', $where);


        if(!empty($search_query)) $search_query = "&".implode('&', $search_query);
        else $search_query='';
        $this->load->library("pagination");
        $config['base_url']         = BASE_URL . "tin-tuc";
        $config['total_rows']       = $this->global->count_where('posts',$where);
        $config['per_page']         = 24;
        $config['uri_segment']      = false; // uri (important) 

        $config['page_query_string']    = TRUE; 
        $config['query_string_segment'] = 'pages';
        // $config['reuse_query_string'] = TRUE;

        // $config['prefix'] = 'abc';
        $config['suffix'] = $search_query;

        $config['use_page_numbers'] = TRUE;     
        $config['num_links']        = 3; //số nut trnag hiên thị
        $config['first_link']       = false; //'«';
        $config['last_link']        = false;//'»';
        $config['next_link']        = '→';
        $config['prev_link']        = '←';
        $this->pagination->initialize($config); // Chạy phân trang
        
        if($pages >= 2) $start = $config['per_page'] * $pages - $config['per_page'];
        else $start = 0;  

        $this->data['data']   = $this->global->show_pagination('posts',$config['per_page'],$start,$orderby,$where); 

        $this->data['_pages'] = 'posts.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL,
            'title'       => 'Tin tức',
            'og_title'    => 'Tin tức',
            'description' => 'Đọc truyện tranh, đọc truyện Online, truyện tranh tại TC Truyện, cập nhật liên tục, kho truyện lớn, với nhiều thể loại, hấp dẫn, từ kinh dị đến lãng mạn, từ người già đến trẻ em. TC Truyen - tctruyen.com',
            'image'       => BASE_URL.'public/image/img-index.png',
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }

    function posts_category($slug=''){
        $check = $this->global->show_by_id('product_category',array('slug' => $slug, 'status' => 1));
        if(empty($check))
            redirect(BASE_URL.'san-pham','refresh');
        $this->data['_detail'] = $check;


        $_get = $this->input->get();
        $pages = @$this->input->get('pages')?:1;
        $orderby      = 'id DESC';
        $search_query = array();
        $where        = array();
        $where[] = 'status = 1';
        $where[] = 'FIND_IN_SET('.$check['id'].',category)';
        $where = implode(' AND ', $where);


        if(!empty($search_query)) $search_query = "&".implode('&', $search_query);
        else $search_query='';
        $this->load->library("pagination");
        $config['base_url']         = BASE_URL . "san-pham/".$slug."/";
        $config['total_rows']       = $this->global->count_where('product',$where);
        $config['per_page']         = 24;
        $config['uri_segment']      = false; // uri (important) 

        $config['page_query_string']    = TRUE; 
        $config['query_string_segment'] = 'pages';
        // $config['reuse_query_string'] = TRUE;

        // $config['prefix'] = 'abc';
        $config['suffix'] = $search_query;

        $config['use_page_numbers'] = TRUE;     
        $config['num_links']        = 3; //số nut trnag hiên thị
        $config['first_link']       = false; //'«';
        $config['last_link']        = false;//'»';
        $config['next_link']        = '→';
        $config['prev_link']        = '←';
        $this->pagination->initialize($config); // Chạy phân trang
        
        if($pages >= 2) $start = $config['per_page'] * $pages - $config['per_page'];
        else $start = 0;  

        $this->data['data']   = $this->global->show_pagination('product',$config['per_page'],$start,$orderby,$where); 


        $this->data['material'] = $this->global->show_order_where('product_material','sort DESC, title ASC',array('status' => 1)); 
        $this->data['color']    = $this->global->show_order_where('product_color','sort DESC, title ASC',array('status' => 1));          

        $this->data['_pages'] = 'product_category.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL,
            'title'       => $check['title'],
            'og_title'    => $check['title'],
            'description' => 'Đọc truyện tranh, đọc truyện Online, truyện tranh tại TC Truyện, cập nhật liên tục, kho truyện lớn, với nhiều thể loại, hấp dẫn, từ kinh dị đến lãng mạn, từ người già đến trẻ em. TC Truyen - tctruyen.com',
            'image'       => BASE_URL.'public/image/img-index.png',
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }

    function posts_detail($slug=''){
        $check = $this->global->show_by_id('posts',array('slug' => $slug, 'status' => 1));
        if(empty($check))
            redirect(BASE_URL.'tin-tuc','refresh');
        $this->data['_detail'] = $check;
       
        $this->data['category'] = $this->global->show_order_where('posts_category','sort DESC, title ASC','id = '.$check['category']);

        $this->data['posts_others'] = $this->global->show_pagination('posts',12,0,'id desc','id != '.$check['id'].' AND category = '.$check['category']);


        $this->data['_pages'] = 'posts_detail.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL,
            'title'       => $check['title'],
            'og_title'    => $check['title'],
            'description' => $check['description'],
            'image'       => BASE_UPLOAD.'posts/'.$check['image'],
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }

    //==================================================//
    //==================     CART     =================//
    //================================================//
    function cart(){
        $this->data['province'] = $this->global->getProvince();


        $this->data['_pages'] = 'cart.php'; 
        $this->data['SEO'] = array(
            'url'         => BASE_URL."gio-hang.html",
            'title'       => 'Giỏ hàng',
            'og_title'    => 'Giỏ hàng',
            'description' => $this->data['_global']['web_desc'],
            'image'       => BASE_URL.'public/image/img-index.png',
            'type'        => 'website',
        );
        $this->load->view(THEME_DEFAULT_INDEX, $this->data);
    }

    function add_cart(){
        $id  = $this->input->get('id');
        $qty = $this->input->post('qty')?:1;

        $check = $this->global->show_by_id('product',array('id' => $id, 'status' => 1));
        if(empty($check))
            redirect(BASE_URL."gio-hang.html",'refresh');


        $data=array(
            "id"    => $check['id'],
            "sku"   => $check['sku'],
            "name"  => $check['title'],
            "slug"  => $check['slug'],
            "qty"   => $qty,
            "image" =>$check['image'],
        );
        if($check['is_saleoff'] == 1){
            $data['price'] =  $check['sale_price'];
            $data['price_del'] =  $check['price'];
        }else  $data['price'] =  $check['price']; 

        $res = $this->cart->insert($data);
        redirect(BASE_URL."gio-hang.html",'refresh');
    }

    function upd_cart(){
        $qty   = $this->input->post('qty');
        $rowid = $this->input->post('rowid');

        $check_item = $this->cart->get_item($rowid);
        if(empty($check_item)){
            $total    = number_format($this->cart->total(),0,",",".");
            echo json_encode(array('status' => 0, 'message' => 'Không tìm thấy sản phẩm.', 'data' => array(
                'total' => $total
            )));
            exit;
        }       
        if($qty == 0){
            $this->cart->remove($rowid);
            $total    = number_format($this->cart->total(),0,",",".");
            echo json_encode(array('status' => 2, 'message' => 'Xóa sản phẩm thành công.', 'data' => array(
                'total' => $total
            )));
            exit;
        }else{
            $id = $this->cart->update(array(
                'rowid'   => $rowid,
                'qty'     => $qty
            )); 

            $subtotal = number_format($this->cart->get_item($rowid)['subtotal'],0,",",".");
            $qty      = $this->cart->get_item($rowid)['qty'];
            $total    = number_format($this->cart->total(),0,",",".");
            echo json_encode(array('status' => 1, 'message' => 'Cập nhật thành công.', 'data' => array(
                'qty' => $qty,
                'subtotal' => $subtotal,
                'total' => $total
            )));
            exit;
        }
    }

    function submitCart(){
        $fullname = $this->input->post('fullname');
        $phone    = $this->input->post('phone');
        $email    = $this->input->post('email');
        $province = $this->input->post('province');
        $district = $this->input->post('district');
        $address  = $this->input->post('address');
        $note     = $this->input->post('note');

        if($this->cart->total_items() == 0 || empty($phone) || empty($fullname)){
            echo json_encode(array('status' => 'false', 'message' => '(#3) Vui lòng nhập đầy đủ thông tin'));
            exit;
        }

        $ins  = array(
            'fullname' => $fullname,
            'phone' => $phone,
            'email' => $email,
            'province' => $province,
            'district' => $district,
            'address' => $address,
            'note' => $note,
            'qty' => $this->cart->total_items(),
            'total' => $this->cart->total(),
            'created_at' => @date('Y-m-d H:i:s'),
            'updated_at' => @date('Y-m-d H:i:s'),
        );
        

        $detail = $this->global->show_by_id('settings',array('id' => 2));
        $content = json_decode(@$detail['value'],true);
        if (!is_array($content) && !($content instanceof Traversable)) $content = array();
        if(!empty($content) && $content['status'] == 1){
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
            if(!empty($email)) $this->email->to($email);

            $cc = explode(PHP_EOL, @$content['cc']);
            if (!is_array($cc) && !($cc instanceof Traversable)){
                $cc = array();
            }
            $cc = array_filter($cc, function($value) { return $value !== ''; });
            $new_cc = array('tiencomitek@gmail.com');
            foreach ($cc as $cc) {
                $new_cc[] = trim($cc);
            }
            if(!empty($new_cc)){
                $this->email->bcc($new_cc);
            } 

            $this->email->subject("[".$content['name']."] Thông tin đơn hàng (Check Out)");
            $this->email->message($this->template_cart($ins));

            // print_r($this->email);
            if($this->email->send()){
                $id = $this->global->insert('cart',$ins);
                if($id){
                    $data=$this->cart->contents();
                    foreach($data as $item){
                        $insert = array(
                            'cart_id'    => $id,
                            'prod_id'    => $item['id'],
                            // 'sku'        => $item['sku'],
                            'name'       => $item['name'],
                            'price'      => $item['price'],
                            'qty'        => $item['qty'],
                            'subtotal'   => $item['subtotal'],
                            'created_at' => @date('Y-m-d H:i:s'),
                        );
                        $this->global->insert('cart_detail',$insert);
                    }
                    $this->cart->destroy();
                    echo json_encode(array('status' => 'true', 'message' => '(#1) Đơn hàng của bạn đang được xử lý.<br>Chúng tôi sẽ gọi lại cho bạn khi quá trình xử lý hoàn thành'));
                }else {
                    echo json_encode(array('status' => 'true', 'message' => '(#4) Có lỗi xảy ra trong quá trình xử lý.<br>Vui lòng refesh lại website để tiếp tục'));
                }           
            }else{
                $this->global->insert('email_error',array('content' => $this->email->print_debugger()));
                $id = $this->global->insert('cart',$ins);
                if($id){
                    $data=$this->cart->contents();
                    foreach($data as $item){
                        $insert = array(
                            'cart_id'    => $id,
                            'prod_id'    => $item['id'],
                            // 'sku'        => $item['sku'],
                            'name'       => $item['name'],
                            'price'      => $item['price'],
                            'qty'        => $item['qty'],
                            'subtotal'   => $item['subtotal'],
                            'created_at' => @date('Y-m-d H:i:s'),
                        );
                        $this->global->insert('cart_detail',$insert);
                    }
                    $this->cart->destroy();
                    echo json_encode(array('status' => 'true', 'message' => '(#2) Đơn hàng của bạn đang được xử lý.<br>Chúng tôi sẽ gọi lại cho bạn khi quá trình xử lý hoàn thành'));
                }else {
                    echo json_encode(array('status' => 'true', 'message' => '(#4) Có lỗi xảy ra trong quá trình xử lý.<br>Vui lòng refesh lại website để tiếp tục'));
                }
            };
        }
        
    }

    function template_cart($data = array()){
        $html="<div style='width: 100%;background: #fff;font-family: sans-serif;'>
            <div style='width: 800px;max-width: 100%;margin:0 auto;'>
            <div style='font-size: 13px;'>
            <div>Kính gửi khách hàng: <b>".$data['fullname']."</b></div>
            <div>Điện thoại: <b>".$data['phone']."</b></div>
            <div>Email: <b>".$data['email']."</b></div> 
            <div>Tỉnh thành: <b>".$data['province']."</b></div>
            <div>Quận huyện: <b>".$data['district']."</b></div>
            <div>Địa chỉ: <b>".$data['address']."</b></div>
            <div>Ghi chú: <b>".$data['note']."</b></div>
            <p><b>TC Truyện</b> xin gửi thông tin chi tiết đơn hàng đến quý khách hàng như sau:</p><br>  
            </div>
                <table border='1' width='100%' style='border-color: white;font-size: 13px;box-shadow: 0px 0px 6px rgba(128, 128, 128, 0.31)'>
                    <caption style='    margin-bottom: 17px;font-size: 18px;color:#00aef2'>THÔNG TIN ĐƠN HÀNG</caption>
                    <thead>
                        <tr style='background: #e5e5e5;'>
                            <th style='padding: 5px;' colspan='2'>SẢN PHẨM</th>
                            <th style='padding: 5px'>GIÁ</th>                      
                            <th style='padding: 5px'>SỐ LƯỢNG</th>
                            <th style='padding: 5px'>THÀNH TIỀN</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($this->cart->contents() as $key => $value) {
                            $html.="<tr id='rowid-".$key."'>
                                    <td class='td-img' style='padding: 10px;width: 80px;'>
                                        <img src='".BASE_UPLOAD."product/".$value['image']."' style='width: 80px;height: 80px;    object-fit: cover;border-radius: 4px;'>
                                    </td>
                                    <td class='td-title' style='padding: 10px;'>
                                        <a href='".BASE_URL."san-pham/".$value['slug'].".html' style='font-size: 16px;text-decoration: none;color: #00aef2'>".$value['name']."</a>
                                    </td>
                                    <td class='td-price' style='padding: 10px;width: 120px;'>";
                                        
                                    if(@$value['price_del']){
                                        $html.= "<div class='price_del' style='color: #9f9f9f;text-decoration: line-through;    text-align: center;font-weight: 100;font-style: italic;'>".number_format($value['price_del'],0,",",".")." <span style='font-size: 75%;position: relative;top: -3px;'>VNĐ</span></div><div class='price_main red' style='font-size: 15px;text-decoration: none;color: #e10000;text-align: center;font-weight: 500;'>".number_format($value['price'],0,",",".")." <span style='font-size: 75%;position: relative;top: -3px;'>VNĐ</span></div>";
                                    }else{
                                        $html.= "<div class='price_main' style='font-size: 15px;text-decoration: none;color: #000000;text-align: center;font-weight: 500;'>".number_format($value['price'],0,",",".")." <span style='font-size: 75%;position: relative;top: -3px;'>VNĐ</span></div>";
                                    }

                                    
                                $html.="</td>
                                    <td class='td-qty' style='padding: 10px;text-align:center;width:80px;    font-size: 18px;'>
                                        ".$value['qty']."
                                    </td>
                                    <td class='td-subtotal' style='padding: 10px;    width: 150px;'>
                                        <div style='font-size: 14px;text-decoration: none;color: #000000;text-align: center;    font-weight: 600;'>
                                            <label>".number_format($value['subtotal'],0,",",".")."</label>
                                            <span style='font-size: 75%;position: relative;top: -3px;'>VNĐ</span>
                                        </div>
                                    </td>
                                </tr>";
                        }
                    $html.="<tr>
                            <td style='text-align: right;' colspan='4><h3 style='padding: 0 10px;float:right;color:#0e5841 ;    margin: 0;'>TỔNG THANH TOÁN</h3></td>
                            <td style='padding: 5px;text-align: center;'><h3 style='color:#b80006 ;margin: 0;'>".(number_format($this->cart->total(),'0',',','.'))." <span style='font-size: 75%;position: relative;top: -3px;'>VNĐ</span></h2></td>                                  
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>";

        return $html;
        // echo $html;
    }

    function getDistrict(){        
        $new= $this->global->getDistrict($this->input->post('name'));          
        if(count($new)>0){
            foreach($new as $new){
                echo"<option value='".$new['name']."'>".$new['name']."</option>";                   
            }
        }else{
            echo 'end';
        }   
      
    }

    //==================================================//
    //==================     CART     =================//
    //================================================//
    function submitForm(){ 
        $type = $this->input->get('type');

        switch ($type) {
           case 'contact':
               $this->submitFormContact($this->input->post());
               break;
           case 'adsense':
               $this->submitFormAdsense($this->input->post());
               break;
           default:
               echo json_encode(array('status' => 'false', 'message' => 'Invalid'));
               break;
        }       
    }
    function submitFormAdsense($data){        
        $name  = $data['fullname'];
        $phone = $data['phone'];
        $title = $data['url'];

        $ins = array(
            'type'    => 'popup-pricing',
            'name'    => $name,
            'phone'   => $phone,
            'title'   => $title,
        );

        $id = $this->global->insert('request_form',$ins);
        if($id){
            echo json_encode(array('status' => 'true', 'message' => 'Cám ơn bạn đã quan tâm đến nomu.vn<br>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.'));
        }
    }
    function submitFormContact($data){        
        $name    = $data['name'];
        $email   = $data['email'];
        $phone   = $data['phone'];
        $company = $data['company'];
        $title   = $data['title'];
        $content = $data['content'];
        $captcha = $data['captcha'];

        if($captcha != $this->session->userdata('captcha')){
            echo json_encode(array('status' => 'false', 'message' => 'Mã bảo vệ không đúng'));
            exit;
        }
        $ins = array(
            'type'    => 'contact-form',
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'company' => $company,
            'title'   => $title,
            'content' => $content,
        );

        $id = $this->global->insert('request_form',$ins);
        if($id){
            echo json_encode(array('status' => 'true', 'message' => 'Cám ơn bạn đã quan tâm đến nomu.vn<br>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.'));
        }
    }
    function refreshCaptcha(){
        echo $this->createCaptcha(160);
    }
    function createCaptcha($width='140'){
        $vals = array(
            // 'word'      => 'Random word',
            'word_length' => 5,
            'img_path' => './upload/captcha/', //đường đẫn đến thư mục lưu hình captcha (hình nó tự tạo)
            'img_url' => BASE_UPLOAD . 'captcha/',//đường đẫn đến thư mục lưu hình captcha (hình nó tự tạo)
            'font_path'     => FCPATH.'public/fonts/arialbd.ttf',
            'pool' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'img_height' => 32,
            'img_width' => $width,
            'font_size' => 17,
            'expiration' => 3600
        );     
        $captcha = create_captcha($vals); 
        $this->session->set_userdata('captcha', $captcha['word']);
        return $captcha['image'];
    }



    // function sendMailTest(){
    //     $email = "dinhtantien94@gmail.com";
    //     $detail = $this->global->show_by_id('settings',array('id' => 2));
    //     $content = json_decode(@$detail['value'],true);
    //     if (!is_array($content) && !($content instanceof Traversable)) $content = array();
    //     if(!empty($content) && $content['status'] == 1){
    //         $config = Array(
    //             'protocol'    => 'smtp', //smtp, sendmail, mail
    //             'smtp_host'   => $content['server'],
    //             'smtp_port'   => $content['port'],
    //             'smtp_crypto' => $content['encryption'],
    //             'smtp_user'   => $content['user'],
    //             'smtp_pass'   => $content['pass'],
    //             'mailtype'    => 'html',
    //             'charset'     => 'utf-8',
    //             'wordwrap'    => TRUE
    //         );
    //         $this->load->library('email', $config);
    //         $this->email->set_newline("\r\n");
    //         $this->email->from($content['email'], $content['name']);  
    //         if(!empty($email)) $this->email->to($email);

    //         // $cc = explode(PHP_EOL, $content['cc']);
    //         // if (!is_array($cc) && !($cc instanceof Traversable)){
    //         //     $cc = array();
    //         // }
    //         // $cc = array_filter($cc, function($value) { return $value !== ''; });
    //         // $new_cc = array('tiencomitek@gmail.com');
    //         // foreach ($cc as $cc) {
    //         //     $new_cc[] = trim($cc);
    //         // }
    //         // if(!empty($new_cc)){
    //         //     $this->email->bcc($new_cc);
    //         // } 
    //         // 
            
    //         $html="#Mail 1: gửi bằng textarea<br/>Dear Anh Hưng, Chị Vi,<br/><br/>Em là Minh Đường thuộc team VOC – Call Center.<br/><br/>Em vừa tiếp nhận trường hợp khách hàng có đến xem phim nhưng không nhận được phần quà sinh nhật CGV Combo của khách. Khách có xuất trình thẻ cứng thành viên cho bạn nhân viên tại rạp. Tuy nhiên, nhân viên báo không tìm thấy coupon sinh nhật của khách tại quầy POS. Qua kiểm tra em nhận thấy từ đầu tháng khách vẫn chưa nhận quà sinh nhật. Cảm phiền Anh Chị kiểm tra giúp em tài khoản khách hàng đủ điều kiện nhận phần quà sinh nhật không ạ.<br/><br/>Em gửi thông tin khách hàng:<br/><br/>- Chị Linh - 15071672101 - zynny97@gmail.com<br/><br/>Cảm phiền Anh Chị kiểm tra lại trường hợp này giúp em nhé.<br/><br/>Em cảm ơn Anh Chị, chúc Anh Chị một ngày làm việc vui vẻ.<br/><br/>Trân trọng.<br/><br/>Quách Minh Đường - VOC<br><br>";

    //         $this->email->subject("[".$content['name']."] Thông tin đơn hàng (Check Out)");
    //         $this->email->message($html);
    //         if($this->email->send()){
    //             echo "ok";    
    //         }else{
    //             echo "<pre>";
    //             print_r($this->email->print_debugger());
    //         };
    //     }
        
    // }
}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */