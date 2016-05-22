<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>User Management</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Eprima Technology">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img">
	<!-- end: Favicon -->
	
			<style type="text/css">
			body { background: url(../assets/img/bg-login.jpg) !important; }
		</style>
		
		
		
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="alert-error">
					<?php echo $message;?>
					 </div>
					<h2>Login User Management</h2>
					<form class="form-horizontal" action="<?php echo base_url() ;?>auth/login" method="post" enctype="multipart/form-data" >
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="email" id="email" type="text" placeholder="Username Please"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" placeholder="Password Here"/>
							</div>
							<div class="clearfix"></div>

							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
							</fieldset>
					</form>
					
					
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
     <div class="clearfix"></div>
	<footer style="position:absolute; width:100%; margin-top:11.4%;">
    <center>
	<span>
	Copyright &copy San
	</span>
    </center>	
	</footer>
	<!-- start: JavaScript-->

		<script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/modernizr.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
	
		<script src='<?php echo base_url(); ?>assets/js/fullcalendar.min.js'></script>
	
		<script src='<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js'></script>

		<script src="<?php echo base_url(); ?>assets/js/excanvas.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.flot.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.flot.pie.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.flot.stack.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.flot.resize.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.chosen.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.uniform.min.js"></script>
		
		<script src="<?php echo base_url(); ?>assets/js/jquery.cleditor.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.noty.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.elfinder.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.raty.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.iphone.toggle.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.imagesloaded.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.masonry.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.knob.modified.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/counter.js"></script>
	
		<script src="<?php echo base_url(); ?>assets/js/retina.js"></script>

		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
