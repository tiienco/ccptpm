<section class="sidebar">
	<!-- search form -->
	<form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search..." />
			<span class="input-group-btn">
			<button type="submit" name="search" id="search-btn" class="btn btn-flat">
				<i class="fa fa-search"></i>
			</button>
			</span>
		</div>
	</form><!-- /.search form -->
	
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<li class="header">MAIN NAVIGATION</li>
		<li class="<?php echo $this->router->fetch_class()=='dashboard'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>dashboard">
				<i class="fa fa-dashboard"></i><span>Dashboard</span> 
			</a>	
		</li>		

		<li class="<?php echo $this->router->fetch_class()=='users'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>menu">
				<i class="fa fa-list"></i>
				<span>Menu</span>			
			</a>		
		</li>

		<li class="treeview <?php echo $this->router->fetch_class()=='pages'?'active':'' ?>">
			<a href="#">
				<i class="fa fa-newspaper-o"></i><span>Pages</span> 
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class='<?php echo $this->router->fetch_method()=='home'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>pages/home">
						<i class="fa fa-circle-o"></i> Trang chủ
					</a>
				</li>
				<li class='<?php echo $this->router->fetch_method()=='contact'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>pages/contact">
						<i class="fa fa-circle-o"></i> Liên hệ
					</a>
				</li>			
			</ul>
		</li>

		<li class="treeview <?php echo $this->router->fetch_class()=='product'?'active':'' ?>">
			<a href="#">
				<i class="glyphicon glyphicon-th-large"></i><span>Sản phẩm</span> 
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class='<?php echo $this->router->fetch_method()=='index'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>product/index">
						<i class="fa fa-circle-o"></i> Sản phẩm
					</a>
				</li>
				<li class='<?php echo $this->router->fetch_method()=='category_index'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>product/category_index">
						<i class="fa fa-circle-o"></i> Danh mục
					</a>
				</li>
			</ul>
		</li>

		<li class="treeview <?php echo $this->router->fetch_class()=='posts'?'active':'' ?>">
			<a href="#">
				<i class="fa fa-clone"></i><span>Tin tức</span> 
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class='<?php echo $this->router->fetch_method()=='index'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>posts/index">
						<i class="fa fa-circle-o"></i> Tin tức
					</a>
				</li>
				<li class='<?php echo $this->router->fetch_method()=='category_index'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>posts/category_index">
						<i class="fa fa-circle-o"></i> Danh mục
					</a>
				</li>			
			</ul>
		</li>

		<li class="<?php echo $this->router->fetch_class()=='users'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>users">
				<i class="fa fa-user"></i>
				<span>Tài khoản</span>			
			</a>		
		</li>
		<li class="<?php echo $this->router->fetch_class()=='banner'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>banner">
				<i class="fa fa-image"></i><span>Banner</span>
			</a>
		</li>
		
		<li class="<?php echo $this->router->fetch_class()=='feedback'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>feedback">
				<i class="fa fa-rss"></i><span>Feedback</span>
			</a>
		</li>

		<li class="<?php echo $this->router->fetch_class()=='cart'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>cart">
				<i class="fa fa-shopping-cart"></i><span>Đơn hàng</span>
			</a>
		</li>

	
		<li class="header">SETTING</li>		
		<li class="treeview <?php echo $this->router->fetch_class()=='config'?'active':'' ?>">
			<a href="#">
				<i class="fa fa-gears"></i><span>Config</span> 
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class='<?php echo $this->router->fetch_method()=='setting'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/setting">
						<i class="fa fa-circle-o"></i> Setting
					</a>
				</li>
				<li class='<?php echo $this->router->fetch_method()=='footer'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/footer">
						<i class="fa fa-circle-o"></i> Footer
					</a>
				</li>
				<li class='<?php echo $this->router->fetch_method()=='email'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/email">
						<i class="fa fa-circle-o"></i> Email
					</a>
				</li>
				<!-- <li class='<?php echo $this->router->fetch_method()=='description'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/description">
						<i class="fa fa-circle-o"></i> Giới thiệu ngắn
					</a>
				</li> -->
			</ul>	
			
		</li>
		<br>
			<br>
			<br>
	



		<!-- 

		

		<li class="<?php echo $this->router->fetch_class()=='banner'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>banner">
				<i class="fa fa-image"></i><span>Banner</span> 
			</a>	
		</li>

		<li class="<?php echo $this->router->fetch_class()=='booking_tour'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>booking_tour">
				<i class="fa fa-shopping-cart"></i><span>Booking Tour</span>
			</a>
		</li>

		<br>
		<br>
		<br>

		<li class="<?php echo $this->router->fetch_class()=='menu'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>menu">
				<i class="fa fa-table"></i><span>Menu</span>
			
			</a>
		</li>

		<li class="<?php echo $this->router->fetch_class()=='product'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>product">
				<i class="fa fa-product-hunt"></i><span>Sẩn phẩm</span>
			</a>
		</li>

		

		<li class="<?php echo $this->router->fetch_class()=='cart'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>cart">
				<i class="fa fa-shopping-cart"></i><span>Đơn hàng</span>
			</a>
		</li>

		

		<li class="<?php echo $this->router->fetch_class()=='video'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>video">
				<i class="fa fa-youtube"></i><span>Video</span>
			</a>
		</li> -->

		

		<!-- <li class="<?php echo $this->router->fetch_class()=='gallery'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>gallery">
				<i class="fa fa-picture-o" aria-hidden="true"></i>
				<span>gallery</span>			
			</a>		
		</li> -->

	<!-- 	<li class="<?php echo $this->router->fetch_class()=='certificate'?'active':'' ?>">
			<a href="<?php echo BASE_URL_ADMIN ?>certificate">
				<i class="fa fa-picture-o" aria-hidden="true"></i>
				<span>Giấy chứng nhận</span>			
			</a>		
		</li>
 -->
		

		

	<!-- 	<li class="">
			<a href="#">
				<i class="fa fa-pie-chart"></i><span>Báo cáo</span>
			</a>
		</li>
 -->

	
	
		<!-- <li class="treeview <?php echo $this->router->fetch_class()=='config'?'active':'' ?>">
			<a href="#">
				<i class="fa fa-gears"></i><span>Config</span> 
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class='<?php echo $this->router->fetch_method()=='setting'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/setting">
						<i class="fa fa-circle-o"></i> Setting
					</a>
				</li>
				<li class='<?php echo $this->router->fetch_method()=='contact'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/contact">
						<i class="fa fa-circle-o"></i> Liên hệ
					</a>
				</li>
				<li class='<?php echo $this->router->fetch_method()=='account'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/account">
						<i class="fa fa-circle-o"></i> Tài khoản
					</a>
				</li> -->
				<!-- <li class='<?php echo $this->router->fetch_method()=='distribu'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/distribu">
						<i class="fa fa-circle-o"></i> Hệ Thống Phân Phối
					</a>
				</li> -->
				<!-- <li class='<?php echo $this->router->fetch_method()=='blog'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/blog">
						<i class="fa fa-circle-o"></i> Blog
					</a>
				</li> -->
				<!-- <li class='<?php echo $this->router->fetch_method()=='about_us'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/about_us">
						<i class="fa fa-circle-o"></i> Giới thiệu
					</a>
				</li>
				
				
				<li class='<?php echo $this->router->fetch_method()=='online'?'active':'' ?>'>
					<a href="<?php echo BASE_URL_ADMIN ?>config/online">
						<i class="fa fa-circle-o"></i> Online
					</a>
				</li> -->
			</ul>	
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</li>
	</ul>
</section>
