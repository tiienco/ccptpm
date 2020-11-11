<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Admin Manager</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<script src="<?php echo BASE_ADMIN_JS ?>jquery-3.0.0.min.js"></script>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo BASE_ADMIN_CSS ?>font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo BASE_ADMIN_CSS ?>bootstrap.min.css">


		<link rel="stylesheet" href="<?php echo BASE_ADMIN_PLUGIN?>datatable/css/dataTables.bootstrap.css" type="text/css" />

		<link rel='stylesheet' href='<?php echo BASE_ADMIN_PLUGIN?>uniform/uniform.css' type='text/css' /> 
		<link rel='stylesheet' href='<?php echo BASE_ADMIN_PLUGIN?>select2/css/select2.min.css' type='text/css' /> 

		<link href="<?php echo BASE_ADMIN_CSS ?>AdminLTE.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo BASE_ADMIN_CSS ?>skin-black-light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo BASE_ADMIN_CSS ?>style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			var BASE_URL_ADMIN = "<?php echo BASE_URL_ADMIN ?>";
		</script>
		<script src="<?php echo BASE_ADMIN_JS ?>bootstrap.min.js"></script>
		<script src='<?php echo BASE_ADMIN_PLUGIN ?>uniform/jquery.uniform.min.js'></script> 
		<script src="<?php echo BASE_ADMIN_PLUGIN ?>datatable/js/jquery.dataTables.js"></script>
		<script src="<?php echo BASE_ADMIN_PLUGIN ?>datatable/js/dataTables.bootstrap.js"></script>
		<script src="<?php echo BASE_ADMIN_PLUGIN ?>slimScroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo BASE_ADMIN_PLUGIN ?>ckeditor/ckeditor.js" type="text/javascript"></script> 
		<script src="<?php echo BASE_ADMIN_PLUGIN ?>inputmask/jquery.mask.js" type="text/javascript"></script> 
		<script src="<?php echo BASE_ADMIN_PLUGIN ?>select2/js/select2.full.min.js" type="text/javascript"></script> 

		<link href="<?php echo BASE_ADMIN_PLUGIN ?>craftpip/css/jquery-confirm.min.css" rel="stylesheet" type="text/css" /> 
		<script src="<?php echo BASE_ADMIN_PLUGIN ?>craftpip/js/jquery-confirm.js"></script>
		<script src="<?php echo BASE_ADMIN_JS ?>notify.min.js"></script>

		<script src="<?php echo BASE_ADMIN_JS ?>app.js" type="text/javascript"></script> 
		<script src="<?php echo BASE_ADMIN_JS ?>admin.js" type="text/javascript"></script> 
		<script>
		function alias(alias){
			var str = alias;
			str= str.replace(/  /g," ");
			str= str.replace(/ /g,"-");
			str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g,"a");
			str= str.replace(/B/g,"b");
			str= str.replace(/C/g,"c");
			str= str.replace(/đ|D|Đ/g,"d");
			str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g,"e");
			str= str.replace(/F/g,"f");
			str= str.replace(/G/g,"g");
			str= str.replace(/H/g,"h");
			str= str.replace(/ì|í|ị|ỉ|ĩ|I|Ì|Í|Ị|Ỉ|Ĩ/g,"i");
			str= str.replace(/J/g,"j");
			str= str.replace(/K/g,"k");
			str= str.replace(/L/g,"l");
			str= str.replace(/M/g,"m");
			str= str.replace(/N/g,"n");
			str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g,"o");
			str= str.replace(/P/g,"p");
			str= str.replace(/Q/g,"q");
			str= str.replace(/R/g,"r");
			str= str.replace(/S/g,"s");
			str= str.replace(/T/g,"t");
			str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g,"u");
			str= str.replace(/V/g,"v");
			str= str.replace(/W/g,"w");
			str= str.replace(/X/g,"x");
			str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ|Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ/g,"y");
			str= str.replace(/Z/g,"z");
			str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|<|>|\?|\/|,|\.|\:|\;|\'|\"|\“|\”|\&|\#|\[|\]|~|$|_/g,""); 
			return str;
		}
</script>
	</head>
	<body class="skin-black-light sidebar-mini fixed">
	<div class="wrapper">

	<header class="main-header">
		<!-- Logo -->
		<a href="index2.html" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>A</b>LT</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>Admin</b>LTE</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo BASE_ADMIN_IMAGE."user.png"?>" class="user-image"/>
							<span class="hidden-xs"><?php echo $this->session->userdata('fullname')?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header">
								<img src="<?php echo BASE_ADMIN_IMAGE."user.png"?>" class="img-circle"/>
								<p>
									<?php echo $this->session->userdata('fullname')?>
									<small><?php echo date('Y M d, H:i a')?></small>
								</p>
							</li>

							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="#" class="btn btn-default btn-flat" disabled>Profile</a>
								</div>
								<div class="pull-right">
									<a href="<?php echo BASE_URL_ADMIN?>login/logout" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
					<li>
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<aside class="main-sidebar">
		<?php $this->load->view(DEFAULT_VIEW_ADMIN_THEME.'sidebar_left') ?>
	</aside>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<?php $this->load->view(DEFAULT_VIEW_ADMIN_THEME.$pages) ?>	
	</div><!-- /.content-wrapper -->
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> beta 0.1
		</div>
		<strong>Copyright &copy; 2016 <a href="#">Tiến Cọ</a>.</strong> All rights reserved.
	</footer>
	</div><!-- ./wrapper -->
	
	</body>
</html>
