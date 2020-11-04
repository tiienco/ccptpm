<img src="<?php echo BASE_IMAGE."banner-non.jpg" ?>" style="max-height: 250px;width: 100%;object-fit: cover;object-position: 50% 65%;">


<div class='container'>
	<div class="row">
		<div class="col-sm-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
				<li class="breadcrumb-item active">Giỏ hàng</li>
			</ol>
		</div>
	</div>
</div>

<div class='container'>
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered table-responsive" id="table_cart">
				<thead>
					<tr>
						<th colspan="2">SẢN PHẨM</th>
						<th >GIÁ</th>
						<th >SỐ LƯỢNG</th>
						<th >THÀNH TIỀN</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(empty($this->cart->contents())){
						$empty_cart = 1;
						echo "<tr><td colspan=5></td></tr>";
					}else{
						foreach ($this->cart->contents() as $key => $value) {
							echo"<tr id='rowid-".$key."'>
									<td class='td-img'>
										<img src='".BASE_UPLOAD."product/".$value['image']."'>
									</td>
									<td class='td-title'>
										<a href='".BASE_URL."san-pham/".$value['slug'].".html'>".$value['name']."</a>
									</td>
									<td class='td-price'>";
										
									if(@$value['price_del']){
										echo "<div class='price_del'>".number_format($value['price_del'],0,",",".")." <span>VNĐ</span></div><div class='price_main red'>".number_format($value['price'],0,",",".")." <span>VNĐ</span></div>";
									}else{
										echo "<div class='price_main'>".number_format($value['price'],0,",",".")." <span>VNĐ</span></div>";
									}

									
								echo"</td>
									<td class='td-qty'>
										<div class='input-group'>
											<div class='input-group-btn'>
												<button class='btn btn-info btn-sm btn-minus-cart'>
													<i class='fa fa-minus-circle' aria-hidden='true'></i>
												</button>
											</div>
											<input id='".$key."' type='tel' class='form-control input-sm qty-cart' value='".$value['qty']."' onkeypress='return event.charCode >= 48 && event.charCode <= 57'>											
											<div class='input-group-btn'>
												<button class='btn btn-info btn-sm btn-plus-cart'>
													<i class='fa fa-plus-circle' aria-hidden='true'></i>
												</button>
											</div>
										</div>
									</td>
									<td class='td-subtotal'>
										<div>
											<label>".number_format($value['subtotal'],0,",",".")."</label>
											<span>VNĐ</span>
										</div>
									</td>
								</tr>";
						}
					}					
					?>
					<tr>
						<td class='td-total-text text-right'colspan="4">
							<a href='<?php echo BASE_URL ?>san-pham' class='pull-left'>TIẾP TỤC MUA HÀNG</a>
						</td>
						<td class='td-total text-center'>
							<label><?php echo number_format($this->cart->total(),0,",",".")?></label> <span>VNĐ</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>		
	</div>
	<br>
	<div class="row">
		<div class="col-sm-12"></div>
		<div class='col-sm-8'>			
			<form action="javascript:void(0)" method="POST" class="form-horizontal form-cart" role="form" onsubmit="submitCart(this)">
				<h2 class="product_others-title">THÔNG TIN THANH TOÁN</h2>
				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Họ tên <small class="required">*</small></label>
					<div class="col-sm-10">
						<input type="text" name="fullname" class="form-control" required="required" placeholder="Họ Tên">
					</div>
				</div>
				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Số điện thoại <small class="required">*</small></label>
					<div class="col-sm-10">
						<input type="tel" name="phone" class="form-control" required="required" placeholder="Số điện thoại">
					</div>
				</div>
				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Email <small class="required">&nbsp</small></label>
					<div class="col-sm-10">
						<input type="email" name="email" id="input" class="form-control" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Tỉnh thành <small class="required">*</small></label>
					<div class="col-sm-5">
						<select name="province" id="select-province" class="form-control">
							<option value="">- Tỉnh thành -</option>
							<?php 
								foreach ($province as $value) {
									echo "<option value='$value[name]'>$value[name]</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-5">
						<select name="district" id="select-district" class="form-control">
							<option value="">- Quận huyện -</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Địa chỉ <small class="required">*</small></label>
					<div class="col-sm-10">
						<input type="text" name="address" class="form-control" required="required" placeholder="Địa chỉ nhận hàng">
					</div>
				</div>
				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Ghi chú <small class="required">&nbsp</small></label>
					<div class="col-sm-10">
						<textarea name="note" id="textarea" class="form-control" rows="3" placeholder="Ghi chú"></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						<button type="submit" class="btn btn-primary pull-right">XÁC NHẬN</button>
					</div>
				</div>
			</form>
		</div>
		<div class='col-sm-4'>
			<div class='note-cart'>
				<h4>Thanh toán khi nhận hàng</h4>
				<div class='content'>
					Thanh toán trực tiếp cho nhân viên giao nhận. (COD)
				</div>
				<hr>
				<h4>Thanh toán chuyển khoản</h4>
				<div  class='content'>
					Qúy khách chuyển khoản qua tài khoản Ngân hàng sau:
					<br>

					<li>Chủ tài khoản: <b>Đinh Tấn Tiến</b></li>
					<li>Ngân hàng: <b>ACB Á Châu</b></li>
					<li>Chi nhánh: <b>Lạc Long Quân - Hồ Chí Minh</b></li>
					<li>Số tài khoản: <b>205.289.269</b></li>
					<div class='mg-b-10'></div>
					<li>Chủ tài khoản: <b>Đinh Tấn Tiến</b></li>
					<li>Ngân hàng: <b>ACB Á Châu</b></li>
					<li>Chi nhánh: <b>Lạc Long Quân - Hồ Chí Minh</b></li>
					<li>Số tài khoản: <b>205.289.269</b></li>
					<div class='mg-b-10'></div>
					Khi tiến hành chuyển khoản, quý khách vui lòng ghi rõ nội dung là: <b>Thanh toán đơn hàng XXXX</b>
					Trong đó <b>XXXX</b> là mã đơn hành quý khách nhận được qua Email
					(Hoặc gửi mail về <b>contact@nonmu.vn</b> với cùng nội dung như trên)

				</div>
			</div>
		</div>
	</div>
</div>
<br>
<br>


