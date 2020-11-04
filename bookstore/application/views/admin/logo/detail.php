<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Thêm logo
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Thêm logo</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title pull-right" style='line-height: 1.7'></h3>
		<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>logo'">
			<i class="fa fa-reply" aria-hidden="true"></i> <b>Quay lại</b>
		</button>

		<?php if(@$_detail): ?>
		<button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>logo/add'">
		<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>
		<?php endif; ?>
	</div>
	<div class='box-body'>
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."logo/add/".@$_detail['id'] ?>' method='POST' enctype="multipart/form-data">
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Người dùng</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='title' placeholder="Người dùng" value='<?php echo @$_detail['title']?>' required="required">
				</div>
				<div class="col-sm-2">					
					<select name="status" class="form-control" >
						<option value="0" <?php echo @$_detail['status']==0?'selected':'' ?>>Ẩn</option>
						<option value="1" <?php echo @$_detail['status']==1?'selected':'' ?>>Hiển thị</option>
					</select>				
				</div>
            </div>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Link liên kết</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='link' placeholder="link liên kết" value='<?php echo @$_detail['link']?>' required="required">
				</div>
				<div class="col-sm-2">					
					<input type="text" class="form-control" name='sort' placeholder="Sắp xếp" value='<?php echo @$_detail['sort']?:0?>'>		
				</div>
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Hình ảnh</label>
				<div class="col-sm-10">
					<input accept="image/*" type="file" name="image" onchange="review_image(this)" style='display: none'>				

					<div class='box-img' id='box-review' style='width: 150px;height: 150px;'>
						<i class="fa fa-upload fa-lg" aria-hidden="true"></i>
						<img id='image-review' style='max-width: 100%;    max-width: 100%;    width: 150px;    height: 150px;    object-fit: cover;    object-position: 50% 50%;'>
						<div></div>
					</div>

					<?php if(@$_detail['image']!=''): ?>
					<div class='box-img' style='width: 150px;height: 150px;'>
						<div>
							
						</div>
						<img style='max-width: 100%;width: 150px;height: 150px;object-fit: cover;object-position: 50% 50%;' src='<?php echo BASE_UPLOAD."logo/".$_detail['image'] ?> '>
					</div>
					<?php endif; ?>

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