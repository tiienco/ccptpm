<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Thêm Tài khoản
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Thêm Tài khoản</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title pull-right" style='line-height: 1.7'></h3>
		<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>users'">
			<i class="fa fa-reply" aria-hidden="true"></i> <b>Quay lại</b>
		</button>

		<?php if(@$_detail): ?>
		<button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo BASE_URL_ADMIN ?>users/add'">
		<i class="fa fa-plus-circle" aria-hidden="true" style=''></i> <b>Tạo mới</b>
		</button>
		<?php endif; ?>
	</div>
	<div class='box-body'>
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."users/add/".@$_detail['id'] ?>' method='POST' enctype="multipart/form-data">
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Username</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='username' placeholder="Username" value='<?php echo @$_detail['username']?>' required="required" <?php echo @$_detail['id']?'disabled':''?>>
				</div>
				<div class="col-sm-2">					
					<select name="status" class="form-control" >						
						<option value="1" <?php echo @$_detail['status']==1?'selected':'' ?>>Active</option>
						<option value="0" <?php echo @$_detail['status']==0?'selected':'' ?>>Unactive</option>
					</select>				
				</div>
            </div>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Fullname</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='fullname' placeholder="Fullname" value='<?php echo @$_detail['fullname']?>' required="required">
				</div>
				<div class="col-sm-2 hide">					
								
				</div>
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Email</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='email' placeholder="Email" value='<?php echo @$_detail['email']?>'>
				</div>
				<div class="col-sm-2 hide">					
								
				</div>
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Phone</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='phone' placeholder="Phone" value='<?php echo @$_detail['phone']?>'>
				</div>
				<div class="col-sm-2 hide">					
								
				</div>
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Address</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name='address' placeholder="Address" value='<?php echo @$_detail['address']?>'>
				</div>
				<div class="col-sm-2 hide">					
								
				</div>
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Password</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" name='password' placeholder="Password">
				</div>
				<div class="col-sm-2 hide">					
								
				</div>
            </div>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Re Password</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" name='re_password' placeholder="Re Password">
				</div>
				<div class="col-sm-2 hide">					
								
				</div>
            </div>

          
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2"></label>
				<div class="col-sm-10 text-right">
					<input type="reset" class="btn btn-default btn-sm" value='Làm lại'>
					<input type="submit" class="btn btn-primary btn-sm" name="<?php echo $_btn_name ?>" value="<?php echo $_btn_value ?>">
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