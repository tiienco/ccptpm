<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Thêm Menu
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Thêm Menu</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title pull-right" style='line-height: 1.7'></h3>
		<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>menu'">
			<i class="fa fa-reply" aria-hidden="true"></i> <b>Quay lại</b>
		</button>

		<?php if(@$_detail): ?>
		<button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>menu/add'">
		<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>
		<?php endif; ?>
	</div>
	<div class='box-body'>
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."menu/add/".@$_detail['id'] ?>' method='POST' enctype="multipart/form-data">
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Menu</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='title' placeholder="Menu" value='<?php echo @$_detail['title']?>' required="required">
				</div>
				<div class="col-sm-2">					
					<select name="status" class="form-control" >						
						<option value="1" <?php echo @$_detail['status']==1?'selected':'' ?>>Hiển thị</option>
						<option value="0" <?php echo @$_detail['status']==0?'selected':'' ?>>Ẩn</option>
					</select>				
				</div>
            </div>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Link</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='link' placeholder="Link" value='<?php echo @$_detail['link']?>' required="required">
				</div>
				<div class="col-sm-2">					
					<input type="text" class="form-control" name='sort' placeholder="Sắp xếp" value='<?php echo @$_detail['sort']?:0?>'>				
				</div>
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Vị trí</label>
				<div class="col-sm-8">
					<select name="position" class="form-control" >						
						<option value="main" <?php echo @$_detail['position']=='main'?'selected':'' ?>>Main</option>
						<!-- <option value="top" <?php echo @$_detail['position']=='top'?'selected':'' ?>>Top</option>
						<option value="Bottom" <?php echo @$_detail['position']=='Bottom'?'selected':'' ?>>Bottom</option> -->
					</select>	
				</div>
				<div class="col-sm-2">					
					<label>
						<input type="checkbox" name="is_blank"value="1" class='uniform' <?php echo @$_detail['is_blank']==1?'checked':''?>>
						_Blank
					</label>			
				</div>
            </div>

          
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2"></label>
				<div class="col-sm-10 text-right">
					<input type="reset" class="btn btn-default btn-sm" value='Làm lại'>
					<input type="submit" class="btn btn-primary btn-sm" name="<?php echo $_btn_name ?>" value="<?php echo $_btn_value ?>">
				</div>
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Link cứng</label>
				<div class="col-sm-10">
					<ul class='url-link'>
						<li>
							<label>Giới thiệu:</label>
							<span><?php echo BASE_URL ?>gioi-thieu.html</span>
						</li>
						<li>
							<label>Liên hệ:</label>
							<span><?php echo BASE_URL ?>lien-he.html</span>
						</li>
						<hr>
						<li>
							<label>Sản phẩm:</label>
							<span><?php echo BASE_URL ?>san-pham</span>
						</li>
						<li>
							<label>Danh mục sản phẩm:</label>
							<span><?php echo BASE_URL ?>san-pham/<font color="red">non-ket</font></span>
						</li>
						<li>
							<label>Chi tiết sản phẩm:</label>
							<span><?php echo BASE_URL ?>san-pham/<font color="red">non-ket-mc219-do5.html</font></span>
						</li>
						<hr>
						<li>
							<label>Tin tức:</label>
							<span><?php echo BASE_URL ?>tin-tuc</span>
						</li>
						<li>
							<label>Danh mục tin tức:</label>
							<span><?php echo BASE_URL ?>tin-tuc/<font color="red">xu-huong-thoi-trang</font></span>
						</li>
						<li>
							<label>Chi tiết tin tức:</label>
							<span><?php echo BASE_URL ?>tin-tuc/<font color="red">phot-lo-xu-phat-mu-bao-hiem-dom-tung-hoanh.html</font></span>
						</li>
					</ul>
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
<style>
.url-link li label{
	margin: 0 5px 0 0
}	
.box-img {
    width: 400px;
    height: 209px
}
.box-img div {
    padding-top: 60px;
    color: #d0d0d0;
    font-size: 20px;
    text-align: center;
}
</style>