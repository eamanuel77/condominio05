<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name="description" content=""/>
		<meta name="author" content="marcolucarella"/>
		<title><?php echo $title; ?></title>
		<link rel="shortcut icon" href="<?php echo base_url();?>resources/images/favicon.png" />
		
		<!-- StyleSheet -->
		<link href="<?php echo base_url();?>resources/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>resources/css/bootstrap-theme.min.css" rel="stylesheet">
		<!--link href="<?php echo base_url();?>resources/css/typeahead.js-bootstrap.css" rel="stylesheet"-->
		<!--link href="<?php echo base_url();?>resources/css/datepicker.css" rel="stylesheet"-->
		<!--link href="<?php echo base_url();?>resources/css/introjs.min.css" rel="stylesheet"-->
		<link href="<?php echo base_url();?>resources/css/customization.css?t=<?php time(); ?>" rel="stylesheet">
		
		<!-- JavaScript -->
		<script src="<?php echo base_url();?>resources/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>resources/js/bootstrap.min.js"></script>
		<!--script src="<?php echo base_url();?>resources/js/typeahead.min.js"></script-->
		<!--script src="<?php echo base_url();?>resources/js/datepicker/bootstrap-datepicker.js"></script-->
		<!--script src="<?php echo base_url();?>resources/js/datepicker/locales/bootstrap-datepicker.it.js"></script-->
		<!--script src="<?php echo base_url();?>resources/js/intro.min.js"></script-->
		<!--script src="<?php echo base_url();?>resources/js/personal.js"></script-->
		
	</head>
	<body>
		<div id="container">
			<div class="navbar navbar-default navbar-fixed-top hidden-print">
				<a class="navbar-brand pull-left" href="<?php echo site_url('home'); ?>">Studio Domenico Conserva</a>
				<?php if(isset($breadcrumb)){ ?>
					<ul class="breadcrumb pull-left">
						<?php 
							foreach ($breadcrumb as $key => $value) { 
								if($value == ''){ ?>
								<li class="active"><?php echo $key; ?></li>
								<?php }else{ ?>
								<li><a href="<?php echo $value; ?>"><?php echo $key; ?></a></li>
							<?php } ?>
						<?php } ?>
					</ul>
				<?php } ?>
				<a href="<?php echo site_url('login'); ?>">
					<button id="logout" type="button" class="btn btn-default navbar-btn pull-right">Logout</button>
				</a>
				<p class="navbar-text pull-right">Utente: <?php echo $_SESSION['username']; ?></p>
			</div>
			<div class="row no-margin">
				<!-- Menu veloce -->
				<div class="col-sm-2 hidden-print" id="shortcuts">
					<ul class="nav nav-pills nav-stacked">
						<li><a href="<?php echo site_url('home'); ?>">Home</a></li>
						<li><a href="<?php echo site_url('condomini'); ?>">Condomini</a></li>
						<li><select id="condominioSelezionato" class="form-control input-sm" onchange="updateSelectedCondominio()">
							<?php foreach($condomini as $value){ ?>
								<option <?php if($value['id'] == $selected_conominio) echo "selected"; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
							<?php } ?>
						</select></li>
						<li><a href="<?php echo site_url('esercizi'); ?>">Esercizi</a></li>
						<li><select id="esercizioSelezionato" class="form-control input-sm" onchange="updateSelectedCondominio()">
							<?php foreach($esercizi as $value){ ?>
								<option <?php if($value['id'] == $selected_esercizio) echo "selected"; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
							<?php } ?>
						</select></li>
						<li><a href="<?php echo site_url('unita'); ?>">Unit&agrave;</a></li>
						<ul class="nav nav-pills-sub submenu">
							<li><a href="<?php echo site_url('persone'); ?>">Anagrafica</a></li>
						</ul>
						<li><a href="<?php echo site_url('tabelle'); ?>">Tabelle</a></li>
						<li><a href="<?php echo site_url('conti'); ?>">Conti</a></li>
						<ul class="nav nav-pills-sub submenu">
							<li><a href="<?php echo site_url('conti/categorie'); ?>">Struttura preventivo</a></li>
							<li><a href="<?php echo site_url('conti/preventivi'); ?>">Preventivo</a></li>
							<li><a href="<?php echo site_url('conti/registro_cassa'); ?>">Registro cassa</a></li>
							<li><a href="<?php echo site_url('conti/preventivo_consuntivo'); ?>">Preventivo/Consuntivo</a></li>
							<li><a href="<?php echo site_url('fornitori'); ?>">Fornitori</a></li>
						</ul>
						<li><a href="<?php echo site_url('rate'); ?>">Rate</a></li>
						<ul class="nav nav-pills-sub submenu">
							<li><a href="<?php echo site_url('rate/rate_ordinarie'); ?>">Rate ordinarie</a></li>
							<li><a href="<?php echo site_url('rate/rate_straordinarie'); ?>">Rate straordinarie</a></li>
							<li><a href="<?php echo site_url('rate/rate_acquedotto'); ?>">Rate acquedotto</a></li>
						</ul>
						<li><a href="<?php echo site_url('stampe'); ?>">Stampe</a></li>
						<li><a href="<?php echo site_url('altro'); ?>">Altro</a></li>
					</ul>
				</div>
				<script type="text/javascript">
					// TODO sanitize script
					function updateSelectedCondominio(){
						window.document.location = "<?php echo site_url('home/edit'); ?>/"+$("#condominioSelezionato").val()+"/"+$("#esercizioSelezionato").val();
					}
					/*$('a').filter(function() {
							return $(this).html()=='<?php echo $title; ?>';
						}).parent().addClass('active');*/
				</script>
				<!-- FINE Menu veloce -->
				<div class="col-sm-10" id="page_content">
					<div class="row no-margin">
						<legend><?php echo $title; ?></legend>
						<?php if(isset($_GET['success_message'])){?>
						<div class="alert alert-success alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <?php echo $_GET['success_message']; ?>
						</div>
						<?php } ?>
						<?php if(isset($_GET['error_message'])){?>
							<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <?php echo $_GET['error_message']; ?>
						</div>
						<?php } ?>
					</div>