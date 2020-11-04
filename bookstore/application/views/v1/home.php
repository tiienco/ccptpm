<div id='banner' class='margin_bottom_60'>
	<!-- <div class="customva_1">
		<span class="banner-prev fa fa-angle-left fa-lg"></span>
		<span class="banner-next fa fa-angle-right fa-lg"></span>
	</div> -->
	<div class='owl-carousel owl-theme content-banner'>
		<?php 
			foreach ($_banner as $value) {
				echo'<div class="banner-box">
						<div class="banner-title">
							<h2 class="animated">'.$value['title'].'</h2>
							<p class="animated">'.$value['description'].'</p>
						</div>
						<img class="lazyOwl" data-src="'.BASE_UPLOAD.'banner/'.$value['image'].'">
					</div>';
			}
		?>	
	</div>
</div>
	<br>
	<br>
<div class='container'>
	<div classs='row'>
		<div class='col-sm-12'>
			<div id='customer-vip' class='customer-vip mg-b-60'>
				<div class='heading text-center mg-b-20'>
					<h1>VỀ CHÚNG TÔI</h1>
				</div>
				<div class='content relative'>
					<?php
						$content = json_decode(@$_content['content'],true);
						if (!is_array($content) && !($content instanceof Traversable)) $content = array();
					 	echo $content['description'];
					 ?>
				</div>
			</div>
		</div>
	</div>
	<?php 
		foreach ($_category_home as $value) {
			$category = $value['category'];
			$product  = $value['product'];
			echo"<div class='row'>
					<div class='col-sm-12'><h2 class='product_others-title'>".$category['title']."</h2></div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
						<div class='box-slide-product'>";
							foreach ($product as $pro) {
								echo "<div class='box-product'>
										<a href='".BASE_URL."san-pham/".$pro['slug'].".html' class='img'>
											<img class='lazyOwl' data-src='".BASE_UPLOAD."product/".$pro['image']."' alt='".$pro['title']."' title='".$pro['title']."'>
										</a>
										<div class='info'>
											<a href='".BASE_URL."san-pham/".$pro['slug'].".html' class='name'>
												".$pro['title']."
											</a>
											<label class='uid'>".$pro['sku']."</label>											
											<div class='box-price'>
												<span class='price-sale'>". number_format($pro['price'],0,",",".") ."</span>
												<span class='unit-sale'>VND</span>
											</div>
										</div>
										<div class='img-sale'>
											<img class='lazyOwl' data-src='".BASE_IMAGE."sale.png'>
										</div>
							
									</div>";
							}	
					echo"</div>
					</div>
				</div>
				<br><br>";
		}
	?>
	<div classs='row'>
		<div class='col-sm-12'>
			<div id='feedback' class='feedback mg-b-60'>
				<div class='heading heading-feedback text-center mg-b-40'>
					<h1>PHẢN HỒI CỦA KHÁCH HÀNG</h1>
					<h4>Chúng tôi luôn nghiêm túc lắng nghe ý kiến phản hồi của khách hàng để cải thiện dịch vụ và sản phẩm nhằm tạo ra những giải pháp tốt nhất, hiệu quả nhất cho khách hàng.</h4>
				</div>
				<div class='content relative'>
					<div class='control btn-next'>
						<i class="glyphicon glyphicon-triangle-right" aria-hidden="true"></i>
					</div>
					<div class='control btn-prev'>
						<i class="glyphicon glyphicon-triangle-left" aria-hidden="true"></i>
					</div>
					
					<div id="feedback-owl" class="owl-carousel owl-theme">
						<?php 
						foreach ($_feedback as $key => $value) {
							echo'<div class="item relative">												
									<img class="lazyOwl" data-src="'.BASE_UPLOAD.'feedback/'.$value['image'].'">
									<div>
										<a href="'.$value['link'].'" class="name" target="_blank">'.$value['title'].'</a>
										<div class="title" title="'.$value['content'].'">
											'.$this->myfunctions->charLimit($value['content'],200).'
										</div>
									</div>										
								</div>';
						}
						?>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
