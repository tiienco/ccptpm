
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta property="fb:app_id" content="303037890411533">	
		<meta property="fb:pages"  content="2084092308372774">
		

		<link rel="shortcut icon" href="<?php echo BASE_UPLOAD."images/".$_global['info']['favicon'] ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo BASE_UPLOAD."images/".$_global['info']['favicon'] ?>" type="image/x-icon">

		<title>
			<?php echo (@$SEO['title']?$SEO['title']." | ":'')?><?php echo @$_global['web_name']?>
		</title>

		<meta name ="description" 	content="<?php echo @$SEO['description']?:@$_global['web_desc']?>">
		<meta name="thumbnail" 		content="<?php echo @$SEO['image'] ?>">

		<meta property="og:url"         content="<?php echo @$SEO['url'] ?>" />
		<meta property="og:type"        content="<?php echo @$SEO['type']?:'website' ?>" />
		<meta property="og:description"	content="<?php echo @$SEO['description']?:@$_global['web_desc'] ?>" />
		<meta property="og:image"       content="<?php echo @$SEO['image'] ?>" /><!--  225x350 --><!-- 1200x444 -->
		<meta property="og:image:alt"   content="<?php echo $SEO['og_title'] ?>" />
		<meta property="og:title"       content="<?php echo $SEO['og_title'] ?>" />
		<meta property="og:site_name" 	content="Nón Mủ">

		<meta itemprop="name" 			content="<?php echo $SEO['og_title'] ?>">
		<meta itemprop="description" 	content="<?php echo @$SEO['description']?:@$_global['web_desc'] ?>">
		<meta itemprop="image" 			content="<?php echo @$SEO['image'] ?>"/>


		<script src="<?php echo BASE_JS ?>jquery.min.js"></script>
		<script> 
			var BASE_URL = "<?php echo BASE_URL ?>";
		</script>
		<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=vietnamese" rel="stylesheet"> -->
		<link rel='stylesheet' href='<?php echo BASE_CSS ?>roboto.css'>		
		<link rel="stylesheet" href="<?php echo BASE_CSS ?>font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo BASE_CSS ?>bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo BASE_CSS ?>animate.css">
		<link rel="stylesheet" href="<?php echo BASE_PLUGIN ?>lazyload/jquery.lazyloadxt.spinner.css">
		<link rel="stylesheet" href="<?php echo BASE_PLUGIN ?>owl-carousel/owl.carousel.css"> 
		<link rel="stylesheet" href="<?php echo BASE_PLUGIN ?>owl-carousel/owl.theme.css">
		<link rel="stylesheet" href="<?php echo BASE_PLUGIN ?>owl-carousel/owl.transitions.css" >
		<link rel="stylesheet" href="<?php echo BASE_PLUGIN ?>uniform/uniform.css" >
		<link rel="stylesheet" href="<?php echo BASE_CSS ?>custom.css">	
	</head>
	<body>		
		<div id='header'>
			<div class='promotion'></div>
			<div class='header-top'></div>
			<header class='main-header hidden-xs'>
				<div class='container'>
					<div class='col-sm-4 logo-main'>
						<a href='<?php echo BASE_URL ?>'>
							<img src='<?php echo BASE_UPLOAD."images/".$_global['info']['logo_head'] ?>' style="max-height: 40px;">
						</a>
					</div>
					<div class='col-sm-8 hidden-xs'>
						<ul class='ul-header'>
							<li>
								<div>HOTLINE</div>
								<div><?php echo $_global['info']['hotline']?></div>	
							</li>
							<li>
								<a class="contact" href="<?php echo BASE_URL ?>gio-hang.html">GIỎ HÀNG</a>	
							</li>
						</ul>
					</div>
				</div>
			</header>
			<nav class="navbar navbar-default menu-bar" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand visible-xs" href="<?php echo BASE_URL ?>">
							<img src='<?php echo BASE_UPLOAD."images/".$_global['info']['logo_head'] ?>'  style='max-height: 40px;'>
						</a>

					</div>
			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<?php 
							foreach ($_global['menu'] as $menu) {
								echo "<li><a href='".$menu['link']."' ".($menu['is_blank']==1?'target="_blank"':"").">".$menu['title']."</a></li>";
							}
							?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		</div>


		<div id="body">			
			<?php $this->load->view(THEME_DEFAULT.$_pages) ?>
		</div>
		
		<div id='footer'>
			<div class='container'>
				<div class='row'>
					<div class='col-sm-12 text-center'>
						<?php echo ($_global['footer']['value']);?>
					</div>
				</div>
			</div>
		</div>
		<div id='copyright'>
			<div class='container'>
				<div class='row'>
					<div class='col-sm-12 text-center'>
						© Copyright 2020 tctruyen.com, All rights reserved
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="<?php echo BASE_JS ?>bootstrap.min.js"></script>
	<script src="<?php echo BASE_PLUGIN ?>lazyload/jquery.lazyloadxt.js"></script>
	<script src="<?php echo BASE_PLUGIN ?>owl-carousel/owl.carousel.min.js"></script>
	<script src="<?php echo BASE_PLUGIN ?>uniform/jquery.uniform.min.js"></script>
	<script src="<?php echo BASE_JS ?>bootstrap-transition.js"></script>
	<script src="<?php echo BASE_JS ?>jquery.corner.js"></script>
	<script src="<?php echo BASE_JS ?>jquery.hideseek.min.js"></script>
	<script src="<?php echo BASE_JS ?>jquery.elevatezoom.js"></script>
	<!-- <script src="<?php echo BASE_JS ?>isotope.pkgd.min.js"></script> -->
	<script src="<?php echo BASE_JS ?>custom.js"></script>

	<div id="fb-root"></div>
	<script>
	_loadFbSDk=function(){
	(function(d, s, id) {
	   	var js, fjs = d.getElementsByTagName(s)[0];
	   	if (d.getElementById(id)) return;
	  	js = d.createElement(s); js.id = id;
	  	js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2";
	  	fjs.parentNode.insertBefore(js, fjs);
	 	}(document, 'script', 'facebook-jssdk'));
	};
	$(window).on('load', function() {
		setTimeout("_loadFbSDk()",500);
	});

	</script>
</html>

<div id='backToTop'>
	<i class="fa fa-caret-up" aria-hidden="true"></i>
</div>

<?php 
foreach ($_global['embeb'] as $value) {
	echo $value['content'];
}
?>



<!-- Modal -->
<div id="adsense" class="modal fade form-adsense" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form action="javascript:void(0)" method="POST" onsubmit="submitAdsense(this)">
					<div class='row'>
						<div class='col-sm-6 text-center'>
							<img src="<?php echo BASE_UPLOAD ?>images/baogia.jpg" style="max-width: 100%">	
						</div>
						<div class='col-sm-6'>
							<h4 class='adsense-h4'>Bạn có thể liên hệ với chúng tôi theo 2 cách:</h4>

							<div class='steps'>
								<label>Cách 1:</label>
								<span>Gọi cho chúng tôi <b>(<?php echo $_global['info']['hotline']?>)</b> để được tư vấn ngay</span>
							</div>

							<button type="button" class="btn btn-warning btn-sm form-control" onclick="window.location='tel:1234'">GỌI <?php echo $_global['info']['hotline']?> NGAY !</button>
							<hr>
							<div class='steps'>
								<label>Cách 2:</label>
								<span>Điền số điện thoại, chúng tôi sẽ gọi lại tư vấn cho bạn trong 30 phút.</span>
							</div>
							<input type="text" name="fullname" class="form-control input-sm" required="required" placeholder="Họ tên/Công ty">

							<input type="text" name="phone" class="form-control input-sm" placeholder="Số điện thoại" required>
							<input type="hidden" name="url" class="form-control input-sm" value="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}" ?>">

	

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-sm form-control">GỌI LẠI CHO TÔI NGAY</button>
						  	</div>
						</div>
					</div>
					
			  	</form>
			</div>	
		</div>
	</div>
</div>

