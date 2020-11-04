<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Setting
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Setting</li>
	</ol>
</section>
<?php 
$content = json_decode(@$_data['value'],true);
if (!is_array($content) && !($content instanceof Traversable)) $content = array();

?>
<!-- Main content -->
<section class="content">
<div class='box'>
	<div class='box-header with-border' style='padding: 5px 10px;'>
		<h3 class="box-title" style='line-height: 1.7'><?php echo $title?></h3>
	</div>
	<div class='box-body'>
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."config/setting"?>' method='POST' enctype="multipart/form-data">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Tên website</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="web_name" placeholder="Tên website" value="<?php echo @$content['web_name']?>">
				</div>				
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Mô tả về website</label>
				<div class="col-sm-10">
					<textarea name="web_desc" class="form-control" rows="3" placeholder="Mô tả về website"><?php echo @$content['web_desc']?></textarea>
				</div>				
            </div>

            <div class="form-group">	
				<label for="inputEmail3" class="col-sm-2">Favicon website</label>
				<div class="col-sm-4">
					<input type="file" class="form-control" name="favicon">
				</div>		
				<div class="col-sm-6">
					<img src='<?php echo BASE_UPLOAD.'images/'.@$content['favicon'] ?>' style='height: 25px;'>
				</div>		
            </div>

            <div class="form-group">	
				<label for="inputEmail3" class="col-sm-2">Logo</label>
				<div class="col-sm-4">
					<input type="file" class="form-control" name="logo_head">
				</div>		
				<div class="col-sm-6">
					<img src='<?php echo BASE_UPLOAD.'images/'.@$content['logo_head'] ?>' style='height: 40px;'>
				</div>		
            </div>

          

		<hr>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Hotline</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="hotline" placeholder="Hotline" value="<?php echo @$content['hotline']?>">
				</div>		
				<label for="inputEmail3" class="col-sm-2">Phone</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="phone" placeholder="Phone" value="<?php echo @$content['phone']?>">
				</div>		
            </div>

            <div class="form-group">	
				<label for="inputEmail3" class="col-sm-2">Link Facebook</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="facebook" placeholder="Facebook" value="<?php echo @$content['facebook']?>">
				</div>		
				<label for="inputEmail3" class="col-sm-2">Link Youtube</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="youtube" placeholder="Youtube" value="<?php echo @$content['youtube']?>">
				</div>	
            </div>
		<!-- <hr> -->

			

           <!--  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Background Color</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="background" placeholder="Background Color" value="<?php echo @$content['hotline']?>">
				</div>		
				<label for="inputEmail3" class="col-sm-2">Color</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="color" placeholder="Color" value="<?php echo @$content['phone']?>">
				</div>		
            </div> -->

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Custom CSS</label>
				<div class="col-sm-10">
					<textarea name="custom_css" class="form-control" rows="3" placeholder="*{margin: 0px}"><?php echo @$content['custom_css']?></textarea>
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