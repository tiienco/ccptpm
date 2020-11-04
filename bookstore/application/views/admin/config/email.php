
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
		<form class="form-horizontal" action='<?php echo BASE_URL_ADMIN."config/email"?>' method='POST' enctype="multipart/form-data">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Tên hiển thị</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="name" placeholder="Nón mủ" value="<?php echo @$content['name']?>">
				</div>	
				<label for="inputEmail3" class="col-sm-2">Địa chỉ email</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="email" placeholder="nonmu@gmail.com" value="<?php echo @$content['email']?>">
				</div>				
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">Tài khoản</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="user" placeholder="nonmu@gmail.com" value="<?php echo @$content['user']?>">
				</div>	

				<label for="inputEmail3" class="col-sm-2">Mật khẩu</label>
				<div class="col-sm-4">
					<input type="password" class="form-control" name="pass" placeholder="Mật khẩu" value="<?php echo @$content['pass']?>">
				</div>			
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">SMTP server</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="server" placeholder="smtp.googlemail.com" value="<?php echo @$content['server']?>">
				</div>	

				<label for="inputEmail3" class="col-sm-2">Port</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="port" placeholder="465" value="<?php echo @$content['port']?>">
				</div>			
            </div>

            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2">CC</label>
				<div class="col-sm-4">
					<textarea name="cc" id="textarea" class="form-control" rows="3" style="resize: vertical;min-height: 50px" placeholder="email1@gmail.com\nemail2@gmail.com\nemâil3#gmail.com"></textarea>
					
				</div>	

				<label for="inputEmail3" class="col-sm-2">Encryption</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="encryption" placeholder="ssl / tls" value="<?php echo @$content['encryption']?>">					
					<label>
						<input type="checkbox" value="1" class='uniform' name='status' <?php echo @$content['status']?'checked':'';?>>
						Kích hoạt
					</label>
				</div>			
            </div>
            <script type="text/javascript">
            	var textAreas = document.getElementById('textarea');
    			textAreas.placeholder = textAreas.placeholder.replace(/\\n/g, '\n');
            </script>

            <?php if(!empty($content)): ?>
            	<div class="form-group">
					<label for="inputEmail3" class="col-sm-2">Test sendmail</label>
					<div class="col-sm-10">
						<label><a href='<?php echo BASE_URL_ADMIN ?>config/sendmail' target="_blank">Click vào đây</a></label>
					</div>	

						
	            </div>
            <?php endif; ?>
	
          

           
           
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