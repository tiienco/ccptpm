<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Thêm màu sắc
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Thêm màu sắc</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title pull-right" style='line-height: 1.7'></h3>
		<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN."product/color_index"?>'">
			<i class="fa fa-reply" aria-hidden="true"></i> <b>Quay lại</b>
		</button>
	
		<?php if(@$_detail): ?>
		<button type="button" class="btn btn-success btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN."product/color_add/" ?>'">
		<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>
		<?php endif; ?>
	</div>
	<div class='box-body'>
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."product/color_add/".@$_detail['id'] ?>' method='POST' enctype="multipart/form-data">			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Màu sắc</label>
				<div class="col-sm-8">
					<input type="text" name="title" class='form-control <?php echo (!@$_detail)?'title_alias':''; ?>' placeholder="Màu sắc" value="<?php echo @$_detail['title'] ?>">				
				</div>
				<div class="col-sm-2">					
					<select name="status" class="form-control" >
						<option value="0" <?php echo @$_detail['status']==0?'selected':'' ?>>Ẩn</option>
						<option value="1" <?php echo @$_detail['status']==1?'selected':'' ?>>Hiển thị</option>
					</select>				
				</div>	
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Link</label>
				<div class="col-sm-8">
					<input type="text" name="slug" class='form-control slug' placeholder="Link" value="<?php echo @$_detail['slug'] ?>">				
				</div>
				<div class="col-sm-2">					
					<div class="checkbox" style='margin: 0;padding:0'>
						<input type="text" class="form-control" name='sort' placeholder="Sắp xếp" value='<?php echo @$_detail['sort']?:0?>'>	
					</div>	
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