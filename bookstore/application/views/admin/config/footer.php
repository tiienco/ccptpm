<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php echo $title ?>
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><?php echo $title ?></li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title" style='line-height: 1.7'><?php echo $title ?></h3>
	</div>
	<div class='box-body'>
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."config/footer"?>' method='POST' enctype="multipart/form-data">
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Footer</label>
				<div class="col-sm-10">
					<textarea name="footer" class="form-control" rows="6" placeholder="Footer"><?php echo @$_data['value']?></textarea>
				</div>				
            </div>

           
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2"></label>
				<div class="col-sm-10 text-right">
					<input type="submit" class="btn btn-primary btn-sm" name="submit" value="Cập nhật">
				</div>
            </div>        
        </form>
	</div>
</div>
</section>