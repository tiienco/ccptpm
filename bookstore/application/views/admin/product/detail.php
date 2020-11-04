<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Thêm sản phẩm
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Thêm sản phẩm</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title pull-right" style='line-height: 1.7'></h3>
		<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN."product/"?>'">
			<i class="fa fa-reply" aria-hidden="true"></i> <b>Quay lại</b>
		</button>

		<?php if(@$_detail): ?>
		<button type="button" class="btn btn-success btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN."product/add/" ?>'">
		<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>
		<?php endif; ?>
	</div>
	<div class='box-body'>
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."product/add/".@$_detail['id'] ?>' method='POST' enctype="multipart/form-data">			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Tên sản phẩm</label>
				<div class="col-sm-8">
					<input type="text" name="title" class='form-control <?php echo (!@$_detail)?'title_alias':''; ?>' placeholder="Nón lưỡi trai" value="<?php echo @$_detail['title'] ?>">				
				</div>
				<div class="col-sm-2">					
					<select name="status" class="form-control" >
						<option value="0" <?php echo @$_detail['status']==0?'selected':'' ?>>Ẩn</option>
						<option value="1" <?php echo @$_detail['status']==1?'selected':'' ?>>Hiển thị</option>
					</select>				
				</div>	
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Link sản phẩm</label>
				<div class="col-sm-8">
					<input type="text" name="slug" class='form-control slug' placeholder="non-luoi-trai" value="<?php echo @$_detail['slug'] ?>">				
				</div>
				<div class="col-sm-2">					
					<select name="type" class="form-control" >
						<option value="0" <?php echo @$_detail['type']==0?'selected':'' ?>>Còn hàng</option>
						<option value="1" <?php echo @$_detail['type']==1?'selected':'' ?>>Hết hàng</option>
					</select>
				</div>	
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Giá</label>
				<div class="col-sm-8">
					<input type="text" name="price" class='form-control' placeholder="100.000đ" value="<?php echo @$_detail['price'] ?>">				
				</div>
				
			</div>


			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Phân loại SP</label>
				<div class="col-sm-8">
					<select name="category[]" class="form-control select2" multiple="" >
						<?php 
							$selected = explode(',',@$_detail['category']);
							if (!is_array($selected) && !($selected instanceof Traversable)) $selected = array();
							foreach ($category as $key => $value) {
								echo "<option value='".$value['id']."' ".(in_array($value['id'],$selected)?'selected':'').">".$value['title']."</option>";
							}
						?>						
					</select>	
				</div>
			
			</div>

			

            <div class="form-group">
            	<label for="textarea" class="col-sm-2 control-label">Mô tả SP</label>
            	<div class="col-sm-10">
            		<textarea name="content" id="textarea" class="form-control ckeditor" rows="3" required="required"><?php echo @$_detail['content'] ?></textarea>
            	</div>
            </div>

			<div class="form-group">
				<div id='slide-img' class="form-group">
					<label for="inputEmail3" class="col-sm-2">Ảnh đại diện</label>
					<div class="col-sm-8">
						<input accept="image/*" type="file" name="image" onchange="review_image(this)">				
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">					
					<div style='width: 200px;max-width: 45%;position: relative;float: left;margin-right: 20px;height: 200px;border: 1px solid #d2d6de;'>
						<img id='image-review' style='width: 100%;position: relative;z-index: 2'>
					</div>	
					<?php if(@$_detail['image']!=''): ?>
					<div style='width: 200px;max-width: 45%;position: relative;float: left;height: 200px;    border: 1px solid #d2d6de;'>
						<img style='width: 100%;position: relative;z-index: 2' src='<?php echo BASE_UPLOAD."product/".$_detail['image'] ?> '>
					</div>
					<?php endif; ?>				
					
				</div>	
			</div>


			<div class="form-group">
				<div id='slide-img' class="form-group">
					<label for="inputEmail3" class="col-sm-2">Danh sách ảnh</label>
					<div class="col-sm-8">
						<input accept="image/*" type="file" name="image_list[]" multiple="">				
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-10" style="    padding: 0;">					
					<?php 
					$image_list = json_decode(@$_detail['image_list'],true);
					if (!is_array($image_list) && !($image_list instanceof Traversable)) $image_list = array();
					foreach ($image_list as $img) {
						echo"<div class='box-list-img'>
								<img src='".BASE_UPLOAD."product/".$img."'>
								<i class='fa fa-remove' onclick=\"deleteImgProd(this,".$_detail['id'].",'".$img."')\"></i>
							</div>";
					}
					?>
				</div>	
			</div>
	
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Meta keyword</label>
				<div class="col-sm-10">
					<input name="meta_keyword" class="form-control" value="<?php echo @$_detail['meta_keyword'] ?>" placeholder="Meta keyword">
				</div>
			</div>
    		<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Meta description</label>
				<div class="col-sm-10">
					<textarea name="meta_description" class="form-control" rows="2" placeholder="Meta description"><?php echo @$_detail['meta_description'] ?></textarea>
				</div>
				
			</div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2"></label>
				<div class="col-sm-10 text-right">
					<input type="reset" class="btn btn-default btn-sm" value='Làm lại'>
					<input type="submit" class="btn btn-primary btn-sm" name="<?php echo @$_btn_name ?>" value="<?php echo @$_btn_value ?>">
				</div>
            </div>
            

            
            
			<!-- <div class="box-footer">
				<button type="submit" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Sign in</button>
			</div> -->
        </form>
	</div>
</div>
</section>
<script type="text/javascript">
	$('.select2').select2();
	$(document).on('click','input[name=is_saleoff]',function(){
		if(!$(this).is(':checked')){
			$('input[name=sale_price]').val('').attr('readonly','true');
			$('input[name=sale_percent]').val('').attr('readonly','true');
		}else{
			$('input[name=sale_price]').removeAttr('readonly');
			$('input[name=sale_percent]').removeAttr('readonly');
		}
	})

	function deleteImgProd(itme,id,img){
		$.ajax({	
	        url: BASE_URL_ADMIN + "product/deleteImgProd",
	        data: {
	        	'id':id,
	        	'img':img,
	        },
			type: 'POST',
	        success: function(data){
	        	data = JSON.parse(data);
	        	if(data.status == 'true'){
	        		$(itme).closest('.box-list-img').fadeOut(function(){
	        			$(this).remove();
	        		})
	        	// 	window.location.href = location.href;
	        	}else{
	        	// 	_this.find('span.error').text(data.error);
	        	}																					
	        },
	     	beforeSend:function(data) {    
	     		// _this.find('button[type=submit]').append('<i class="fa fa-spinner fa-pulse" style="margin-left: 5px !important;font-size: 12px;"></i>').attr('disabled','');
			},
			complete: function(data){
				// _this.find('button[type=submit]').removeAttr('disabled','').find('i.fa-spinner').remove();
			} 																										
		});
	}
</script>
<style>
.box-list-img{
    width: 150px;
    height: 100px;
    border: 1px solid #e1e1e1;
        margin-right: 10px;
    margin-bottom: 10px;
    float: left;
    position: relative;
}
.box-list-img img{
	    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: 50% 50%;	
}	
.box-list-img i{
    position: absolute;
    top: -5px;
    right: -5px;
    color: red;
    border: 1px solid #acacac;
    font-size: 10px;
    padding: 3px;
    border-radius: 50%;
    background: #dbdbdb;
    width: 20px;
    height: 20px;
    text-align: center;
    cursor: pointer;
}
</style>