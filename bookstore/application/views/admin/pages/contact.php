<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Liên hệ
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Liên hệ</li>
	</ol>
</section>
<!-- Main content -->
<?php 

$content = json_decode(@$_data['content'],true);
if (!is_array($content) && !($content instanceof Traversable)) $content = array();
?>
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title" style='line-height: 1.7'>Liên hệ</h3>
	</div>
	<div class='box-body'>
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."pages/contact"?>' method='POST'>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Nội dung</label>
				<div class="col-sm-10">
					<textarea name="description" class="form-control ckeditor" rows="6" placeholder="Footer"><?php echo @$content['description']?></textarea>
				</div>				
            </div>


            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Google Map</label>
				<div class="col-sm-10">
					<textarea name="google_map" class="form-control" rows="6" placeholder="Footer"><?php echo @$content['google_map']?></textarea>
				</div>				
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Meta keyword</label>
				<div class="col-sm-10">
					<input name="meta_keyword" class="form-control" value="<?php echo @$_data['meta_keyword']?>" placeholder="Meta keyword">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Meta description</label>
				<div class="col-sm-10">
					<textarea name="meta_description" class="form-control" rows="2" placeholder="Meta description"><?php echo @$_data['meta_description']?></textarea>
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