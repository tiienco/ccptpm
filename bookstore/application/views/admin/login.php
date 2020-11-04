<!DOCTYPE html>
<html style='    background: #f1f1f1;'>
	<head>
		<meta charset="UTF-8">
		<meta charset="utf-8">
		<title>Admin Manager | Login</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- <link rel="shortcut icon" href="favicon.png" type="image/x-icon"> -->
		<!-- <link rel="icon" href="favicon.png" type="image/x-icon"> -->
		<script src="<?php echo BASE_ADMIN_JS ?>jquery-3.0.0.min.js"></script>

		<link rel="stylesheet" href="<?php echo BASE_ADMIN_CSS ?>font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo BASE_ADMIN_CSS ?>bootstrap.min.css">


		<link rel='stylesheet' href='<?php echo BASE_ADMIN_PLUGIN?>uniform/uniform.css' type='text/css' /> 

		<link href="<?php echo BASE_ADMIN_CSS ?>AdminLTE.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo BASE_ADMIN_CSS ?>skin-black-light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo BASE_ADMIN_CSS ?>style.css" rel="stylesheet" type="text/css" />
	</head>
  	<body class="login-page" style='    background: #f1f1f1;'>
		<div class="login-box" style='width: 340px;'>
			<div class="login-logo">
				<!-- <a href="../../index2.html"><img src='<?php echo BASE_IMAGE?>logo.png'></a> -->
			</div><!-- /.login-logo -->

			<div class="login-box-body" style='-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);box-shadow: 0 1px 3px rgba(0,0,0,.13);'>
				<p class="login-box-msg">Log in to Admin Manager</p>
				<font color='red' class='pull-left'><?php echo $_error?></font>
				<br>
				<form action="<?php echo BASE_URL_ADMIN ?>login" method="post">
					<span>Username</span>
					<div class="form-group has-feedback">
						<input name='username' type="text" class="form-control" placeholder="Username" style='height: 35px'/>
						<span class="glyphicon glyphicon-user form-control-feedback" style='height: 35px;line-height: 35px'></span>
					</div>
					<span>Password</span>
					<div class="form-group has-feedback">
						<input name='password' type="password" class="form-control" placeholder="Password" style='height: 35px'/>
						<span class="glyphicon glyphicon-lock form-control-feedback" style='height: 35px;line-height: 35px'></span>
					</div>

					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label>
								<input type="checkbox" class='uniform'> Remember Me
								</label>
							</div>
						</div><!-- /.col -->
						<div class="col-xs-4">
							<input  name='submit' type="submit" class="btn btn-primary btn-block btn-flat" value='Log In'>
						</div><!-- /.col -->
					</div>
				</form>

				<a href="#">I forgot my password</a>
			</div><!-- /.login-box-body -->
		</div><!-- /.login-box -->
		
	<script src="<?php echo BASE_ADMIN_PLUGIN ?>inputmask/jquery.mask.js" type="text/javascript"></script> 
  	<script src="<?php echo BASE_ADMIN_JS ?>bootstrap.min.js"></script>
	<script src='<?php echo BASE_ADMIN_PLUGIN ?>uniform/jquery.uniform.min.js'></script> 
	<script src="<?php echo BASE_ADMIN_JS ?>app.js" type="text/javascript"></script> 
	<script type="text/javascript">$('.uniform').uniform();</script>
  	</body>
</html>