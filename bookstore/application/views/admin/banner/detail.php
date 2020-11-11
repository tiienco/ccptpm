<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Thêm banner
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Thêm banner</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title pull-right" style='line-height: 1.7'></h3>
		<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>banner'">
			<i class="fa fa-reply" aria-hidden="true"></i> <b>Quay lại</b>
		</button>

		<?php if(@$_detail): ?>
		<button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>banner/add'">
		<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>
		<?php endif; ?>
	</div>
	<div class='box-body'>
		<!-- <form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."banner/add/".@$_detail['id'] ?>' method='POST' enctype="multipart/form-data"> -->
		<form class="form-horizontal" action='javascript:void(0)' method='POST' enctype="multipart/form-data" onsubmit="updateAction(this,'banner','<?php echo BASE_URL_ADMIN."banner/add/".@$_detail['id'] ?>');return false;">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Tiêu đề</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='title' placeholder="Tiêu đề" value='<?php echo @$_detail['title']?>' required="required">
				</div>
				<div class="col-sm-2">					
					<select name="status" class="form-control" >
						<option value="0" <?php echo @$_detail['status']==0?'selected':'' ?>>Ẩn</option>
						<option value="1" <?php echo @$_detail['status']==1?'selected':'' ?>>Hiện</option>
					</select>				
				</div>
            </div>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Mô tả ngắn</label>
				<div class="col-sm-8">
					<textarea name="description" class="form-control" rows="3" required="required" placeholder="Mô tả ngắn"><?php echo @$_detail['description']?></textarea>	
				</div>
				<div class="col-sm-2">					
					<input type="text" class="form-control" name='sort' placeholder="Ưu tiên" value='<?php echo @$_detail['sort']?>'>		
				</div>
            </div>


            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Hình ảnh</label>
				<div class="col-sm-8">
					<input accept="image/*" type="file" name="image" onchange="review_image(this)">				
				</div>
			</div>	

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2"></label>
				<div class="col-sm-10">
					<div style='width: 400px;height: 140px;position: relative;float: left;margin-right: 20px;'>
						<img id='image-review' style='width: 100%;position: relative;z-index: 2'>
					<div style='position: absolute;    left: 0;    top: 0;    width: 100%;    height: 100%;    z-index: 9;    border: 1px solid #000000;'></div>
					
					</div>	
					<?php if(@$_detail['image']!=''): ?>
					<div style='width: 400px;height: 140px;position: relative;float: left;'>
						<div style='position: absolute;    left: 0;    top: 0;    width: 100%;    height: 100%;    z-index: 9;    border: 1px solid #000000;'></div>

						<img style='width: 100%;position: relative;z-index: 2' src='<?php echo BASE_UPLOAD."banner/".$_detail['image'] ?> '>
					</div>
					<?php endif; ?>				
				</div>
			</div>	

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2"></label>
				<div class="col-sm-10 text-right">
					<input type="reset" class="btn btn-default btn-sm" value='Làm lại'>
					<input type="submit" class="btn btn-primary btn-sm" name="<?php echo @$_btn_name ?>" value="<?php echo @$_btn_value ?>">
					<input type="hidden" class="btn btn-primary btn-sm" name="<?php echo @$_btn_name ?>" value="<?php echo @$_btn_value ?>">
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