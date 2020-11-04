<img src="<?php echo BASE_IMAGE ?>banner.jpg" style="max-height: 250px;width: 100%;object-fit: cover;object-position: 50% 65%;">


<div class='container'>
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>san-pham">Sản phẩm</a></li>
				<li class="breadcrumb-item active"><?php echo $_detail['title']?></li>
			</ol>
		</div>
	</div>
</div>

<div class='container'>
	<div class="row">
		<div class='product-left'>
			<div class="col-sm-4">
				<img src="<?php echo BASE_UPLOAD."product/".@$_detail['image']?>" style="max-width: 200px;">
			</div>
			<div class="col-sm-8">
				<div class='detail-product'>
					<h1><?php echo $_detail['title']?></h1>
					<div style="padding-left: 20px;">
						<form action="<?php echo BASE_URL."addCart?id=".$_detail['id'] ?>" method="POST">
							<div class='price-detail'>
								<?php 
									if($_detail['is_saleoff'] == 1){
										echo"<label class='price-main'>".number_format($_detail['sale_price'],0,",",".")."</label>
											<span class='unit-main'>VNĐ</span>
											<label class='price-del'>".number_format($_detail['price'],0,",",".")."</label>
											<span class='unit-del'>VNĐ</span>";
									}else{
										echo"<label class='price-main'>".number_format($_detail['price'],0,",",".")."</label>
											<span class='unit-main'>VNĐ</span>";
									}
								?>
							</div>

		
							<div class='sku-detail'>
								<span>Loại sản phẩm: </span>
								<label>
									<?php 
										$cate_a = array();
										foreach ($category as $cate) {
											$cate_a[] = "<a href='".BASE_URL."san-pham/".$cate['slug']."'>".$cate['title']."</a>";
										}
										echo implode(', ', $cate_a);
									?>
								</label>
							</div>
							<div class='sku-detail'>						
								
								
								<button type="submit" class="btn btn-primary">ĐẶT HÀNG</button>			
							</div>

							<div class='btn-share'>
								<div class='div-co co-1' style="height: 22px;">
									<div class="fb-like" style="float: left;margin-right: 10px;" 
										data-href="<?php echo BASE_URL."san-pham/".$_detail['slug'] ?>.html" 
										data-layout="button_count" 
										data-action="like" 
										data-size="small" 
										data-show-faces="true">									
									</div>
									<div class="fb-share-button" 
										data-href="<?php echo BASE_URL."san-pham/".$_detail['slug'] ?>.html" 
										data-layout="button_count" 
										data-size="small" 
										data-mobile-iframe="true">								
									</div>
								</div>
							</div>
						</form>	
					</div>

					
					
				</div>
			</div>
			
			<div class='col-sm-12'>
				<br><br>	
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#desc">Mô tả sản phẩm</a></li>
					<li><a data-toggle="tab" href="#comment">Nhận xét (<span class="fb-comments-count" data-href="<?php echo BASE_URL.'san-pham';?>">0</span>)</a></li>
				</ul>

				<div class="tab-content">
					<div id="desc" class="tab-pane fade in active">
						<div class='description-price'>
							<?php echo $_detail['content']?>
						</div>
					</div>
					<div id="comment" class="tab-pane fade">
						<div class='load-comment-fb'>
							<div class="fb-comments" data-href="<?php echo BASE_URL.'san-pham';?>" data-numposts="10" data-width="100%"></div>
						</div>
					</div>
				</div>
				<br><br>
			</div>
		</div>
		<div class='product-right hidden-xs'>
			<h2 class='camket'><i class="fa fa-yelp" aria-hidden="true"></i> TCTRUYEN CAM KẾT</h2>
			<div class='box-four-steps'>
				<div class='img'>
					<img src="<?php echo BASE_IMAGE ?>giao-hang.png">
				</div>
				<div class='text'>
					<label>GIAO HÀNG TẬN NƠI</label>
					<span>Nhanh gọn - Toàn quốc</span>
				</div>
			</div>
			<div class='box-four-steps'>
				<div class='img'>
					<img src="<?php echo BASE_IMAGE ?>cam-ket.png">
				</div>
				<div class='text'>
					<label>CAM KẾT CHẤT LƯỢNG</label>
					<span>Đổi trả miễn phí trong 7 ngày</span>
				</div>
			</div>
			<div class='box-four-steps'>
				<div class='img'>
					<img src="<?php echo BASE_IMAGE ?>ho-tro.png">
				</div>
				<div class='text'>
					<label>HỖ TRỢ TƯ VẤN</label>
					<span>Tư vấn bán hàng 24/7</span>
				</div>
			</div>
			<div class='box-four-steps'>
				<div class='img'>
					<img src="<?php echo BASE_IMAGE ?>thanh-toan.png">
				</div>
				<div class='text'>
					<label>THANH TOÁN LINH HOẠT</label>
					<span>Chuyển khoản / COD</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class='container'>
	<div class='row'>
		<div class='col-sm-12'><h2 class='product_others-title'>SẢN PHẨM CÙNG CHỦ ĐỀ</h2></div>
	</div>
	<div class='row'>
		<div class='col-sm-12'>
			<div class='box-slide-product'>			
			<?php 
				foreach ($product_others as $value) {
					echo"<div class='box-product'>
								<a href='".BASE_URL."san-pham/".$value['slug'].".html' class='img'>
									<img class='lazyOwl' ogi-src='".BASE_UPLOAD."product/".$value['image']."' alt='".$value['title']."' title='".$value['title']."'>
								</a>
								<div class='info'>
									<a href='".BASE_URL."san-pham/".$value['slug'].".html' class='name'>
										".$value['title']."
									</a>
									<label class='uid'>".$value['sku']."</label>";
									if($value['is_saleoff']==1){
										echo"<div class='box-price'>
												<span class='price'>". number_format($value['price'],0,",",".") ."</span>
												<span class='unit'>VND</span>
											</div>
											<div class='box-price'>
												<span class='price-sale'>". number_format($value['sale_price'],0,",",".") ."</span>
												<span class='unit-sale'>VND</span>
											</div>";
									}else{
										echo"<div class='box-price'>
												<span class='price-sale'>". number_format($value['price'],0,",",".") ."</span>
												<span class='unit-sale'>VND</span>
											</div>";
									}									
						echo"</div>";
							if($value['is_saleoff']==1){
								echo"<div class='img-sale'>
										<img class='lazyOwl' ogi-src='".BASE_IMAGE."sale.png'>
									</div>
									<div class='prescent-sale'>- ".$value['sale_percent']."%</div>";
							}
							if($value['is_new']==1){
								echo"<div class='img-new'>
										<img class='lazyOwl' ogi-src='".BASE_IMAGE."new.png'>
									</div>";
							}							
					echo"</div>";
				}
			?>
			</div>
		</div>
	</div>
</div>
<br>
<br>



<br>
<br>