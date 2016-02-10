<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="list-group">
	<a href="<?php echo site_url('altro/azienda');?>" class="list-group-item">
		<h4 class="list-group-item-heading">Dati azienda</h4>
		<p class="list-group-item-text">Gestisci i dati dell'azienda in modo da poterli visualizzare nelle stampe.</p>
	</a>
</div>
<div class="list-group">
	<a href="<?php echo site_url('altro/utenti');?>" class="list-group-item">
		<h4 class="list-group-item-heading">Utenti</h4>
		<p class="list-group-item-text">Gestisci gli account che possono accedere alla database della tua azienda.</p>
	</a>
</div>
<div class="list-group">
	<!-- // TODO creare il backup solo dei dati dell'azienda loggata -->
	<a href="<?php echo site_url('altro/backup');?>" class="list-group-item">
		<h4 class="list-group-item-heading">Backup</h4>
		<p class="list-group-item-text">Crea e scarica un Backup dei dati salvati nel database.</p>
	</a>
</div>