<img src="<?php echo BASE_IMAGE ?>banner-non-2.jpg" style="max-height: 250px;width: 100%;object-fit: cover;object-position: 50% 65%;">



<div class='container'>
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
				<li class="breadcrumb-item active">Sản phẩm</li>
			</ol>
		</div>
	</div>
</div>

<div class='container'>
	<div class='box-filter hide'>
		<div class='row'>
			<div class='col-md-2 hidden-xs hidden-sm'>
				
			</div>
			<div class='col-sm-3 col-md-2'>
				<?php $get_status = $this->input->get('status'); ?>
				<select name="status" class="form-control input-sm" onchange="changeFilter(this)">
					<option value="">- Trạng thái -</option>
					<option value="new" <?php echo @$get_status=='new'?'selected':'';?>>SP mới</option>
					<option value="saleoff" <?php echo @$get_status=='saleoff'?'selected':'';?>>SP giãm giá</option>
				</select>
			</div>
			<div class='col-sm-3 col-md-2'>
				<?php $get_material = $this->input->get('material'); ?>
				<select name="material" class="form-control input-sm" onchange="changeFilter(this)">
					<option value="">- Chất liệu -</option>
					<?php 
						foreach($material as $value) {
							echo "<option value='".$value['id']."' ".(@$get_material==$value['id']?'selected':'').">".$value['title']."</option>";
						}
					?>
				</select>
			</div>
			<div class='col-sm-3 col-md-2'>
				<?php $get_color = $this->input->get('color'); ?>
				<select name="color" class="form-control input-sm" onchange="changeFilter(this)">
					<option value="">- Màu sắc -</option>
					<?php 
						foreach($color as $value) {
							echo "<option value='".$value['id']."' ".(@$get_color==$value['id']?'selected':'').">".$value['title']."</option>";
						}
					?>
				</select>
			</div>
			<div class='col-sm-3 col-md-2'>
				<?php $get_price = $this->input->get('price'); ?>
				<select name="price"class="form-control input-sm" onchange="changeFilter(this)">
					<option value="">- Giá -</option>
					<option value="0-100000" <?php echo @$get_price=='0-100000'?'selected':'';?>>0 - 100.000đ</option>
					<option value="100000-500000" <?php echo @$get_price=='100000-500000'?'selected':'';?>>100.000đ - 500.000đ</option>
					<option value="500000-1000000" <?php echo @$get_price=='500000-1000000'?'selected':'';?>>500.000đ - 1.000.000đ</option>
					<option value="1000000-9999999" <?php echo @$get_price=='1000000-9999999'?'selected':'';?>>Trên 1.000.000đ</option>
				</select>
			</div>
			<div class='col-sm-3 col-md-2'>
				<?php $get_name = $this->input->get('name'); ?>
				<input type="text" name="name" class="form-control input-sm" placeholder="Từ khóa" value="<?php echo @$get_name?>">
			</div>
		</div>
	</div>
	<br>
	<div class='contain-product'>
		<div class='row'>
			<?php 
				foreach ($data as $value) {
					echo"<div class='col-md-2 col-sm-3 col-xs-6 box-main'>
							<div class='box-product'>
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
								
						echo"</div>
						</div>";
				}
			?>
		</div>
		<div class='row'>
			<div class='col-sm-12'>
				<div class='pull-right'>
					<ul class="pagination">
					<?php echo $this->pagination->create_links(); // tạo link phân trang  ?>						
					</ul>
				</div>
			</div>	
		</div>
	</div>
</div>