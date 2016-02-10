<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name="description" content=""/>
		<meta name="author" content="marcolucarella"/>
		<title>Login</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>resources/images/favicon.png" />
		
		<!-- StyleSheet -->
		<link href="<?php echo base_url();?>resources/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>resources/css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>resources/css/customization.css?t=<?php time(); ?>" rel="stylesheet">
		
		<!-- JavaScript -->
		<script src="<?php echo base_url();?>resources/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>resources/js/bootstrap.min.js"></script>
		
	</head>
	<body>
		<div id="container">
			<div class="navbar navbar-default navbar-fixed-top hidden-print">
				<a class="navbar-brand pull-left" href="<?php echo site_url('home'); ?>">Studio Domenico Conserva</a>
			</div>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3" id="page_content">
					<div class="panel panel-default">
						<div class="panel-heading">Login</div>
						<div class="panel-body">
							<form action="<?php echo site_url('login/edit'); ?>" method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Username</label>
										<input type="text" class="form-control" placeholder="Username" name="username"/>
									</div>
									<div class="form-group col-sm-12">
										<label>Password</label>
										<input type="password" class="form-control" placeholder="Password" name="password"/>
									</div>
									<div class="col-sm-12">
										<button name="action" value="login" type="submit" class="btn btn-primary">Login</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- container -->
		<div id="footer" class="row hidden-print">
			<div class="col-lg-12">
				<span><strong>Studio di amministrazione condominiale Domenico Conserva</strong></span>
			</div>
		</div>
	</body>
</html>