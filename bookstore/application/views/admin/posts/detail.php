<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Thêm tin tức
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Thêm tin tức</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title pull-right" style='line-height: 1.7'></h3>
		<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN."posts/"?>'">
			<i class="fa fa-reply" aria-hidden="true"></i> <b>Quay lại</b>
		</button>

		<?php if(@$_detail): ?>
		<button type="button" class="btn btn-success btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN."posts/add/" ?>'">
		<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>
		<?php endif; ?>
	</div>
	<div class='box-body'>
		<!-- <form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."posts/add/".@$_detail['id'] ?>' method='POST' enctype="multipart/form-data"> -->
		<form class="form-horizontal" action='javascript:void(0)' method='POST' enctype="multipart/form-data" onsubmit="updateAction(this,'post','<?php echo BASE_URL_ADMIN."posts/add/".@$_detail['id'] ?>');return false;">			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Tiêu đề</label>
				<div class="col-sm-8">
					<input type="text" name="title" class='form-control <?php echo (!@$_detail)?'title_alias':''; ?>' placeholder="Tiêu đề" value="<?php echo @$_detail['title'] ?>">				
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
						<!-- <label style='margin: 0;padding:0'>
							<input type="checkbox" name='is_footer' value="1" class='uniform' <?php echo @$_detail['is_footer']==1?'checked':'' ?>>
							<b>Footer</b>
						</label> -->
					</div>	
				</div>	
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Danh mục</label>
				<div class="col-sm-8">
					<select name="category" id="input" class="form-control select2"placeholder="Chọn danh mục">
						<?php 
							echo "<option value=''>- Chọn Danh mục -</option>";
							foreach ($category as $value) {
								echo "<option value='".$value['id']."' ".($_detail['category'] == $value['id']?'selected':'').">".$value['title']."</option>";
							}
						?>
					</select>
				</div>
				<div class="col-sm-2">					
					<div class="checkbox" style='margin: 0;padding:0'>
						<!-- <label style='margin: 0;padding:0'>
							<input type="checkbox" name='is_footer' value="1" class='uniform' <?php echo @$_detail['is_footer']==1?'checked':'' ?>>
							<b>Footer</b>
						</label> -->
					</div>	
				</div>	
			</div>

			<div class="form-group">
            	<label for="textarea" class="col-sm-2 control-label">Mô tả ngắn</label>
            	<div class="col-sm-10">
            		<textarea name="description" id="textarea" class="form-control" rows="3" required="required"><?php echo @$_detail['description'] ?></textarea>
            	</div>
            </div>

            <div class="form-group">
            	<label for="textarea" class="col-sm-2 control-label">Nội dung</label>
            	<div class="col-sm-10">
            		<textarea name="content" id="textarea" class="form-control ckeditor" rows="3" required="required"><?php echo @$_detail['content'] ?></textarea>
            	</div>
            </div>

			<div class="form-group">
				<div id='slide-img' class="form-group">
					<label for="inputEmail3" class="col-sm-2">Hình ảnh</label>
					<div class="col-sm-8">
						<input accept="image/*" type="file" name="image" onchange="review_image(this)">				
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">					
					<div style='width: 200px;max-width: 45%;position: relative;float: left;margin-right: 20px;'>
						<img id='image-review' style='width: 100%;position: relative;z-index: 2'>
					</div>	
					<?php if(@$_detail['image']!=''): ?>
					<div style='width: 200px;max-width: 45%;position: relative;float: left;'>
						<img style='width: 100%;position: relative;z-index: 2' src='<?php echo BASE_UPLOAD."posts/".$_detail['image'] ?> '>
					</div>
					<?php endif; ?>				
					
				</div>	
			</div>
	
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Meta keyword</label>
				<div class="col-sm-10">
					<input name="meta_keyword" class="form-control" value="<?php echo @$_detail['meta_keyword'] ?>">
				</div>
			</div>
    		<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Meta description</label>
				<div class="col-sm-10">
					<textarea name="meta_description" class="form-control" rows="2"><?php echo @$_detail['meta_description'] ?></textarea>
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
<script type="text/javascript">$('.select2').select2();</script>