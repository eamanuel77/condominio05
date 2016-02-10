<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-12">
		<h4>Transazioni non pagate</h4>
	</div>
	<div class="col-sm-12">
		<table class="table table-hover">
			<tr><th>Nome</th><th>Data competenza</th><th>Importo</th><th>Esercizio</th></tr>
			<?php foreach($non_pagate as $value){ ?>
				<tr>
					<td><?php echo $value['nome']; ?></td>
					<td><?php echo $value['data_competenza']; ?></td>
					<td><?php echo $value['importo']; ?> &euro;</td>
					<td><?php echo $value['esercizio']; ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
<div class="row no-margin">
	<div class="col-sm-12">
		<h4>Condomini con rate non pagate</h4>
	</div>
	<div class="col-sm-12">
		<table class="table table-hover">
			<tr><th>Condominio</th><th>Importo</th><th>Importo</th><th>Esercizio</th></tr>
			<?php foreach($scadenza_rate as $value){ ?>
				<tr>
					<td><?php echo $value['nome']; ?></td>
					<td><?php echo $value['data_rata']; ?></td>
					<td><?php echo $value['importo']; ?> &euro;</td>
					<td><?php echo $value['esercizio']; ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
<div class="linea"></div>
<div class="row no-margin">
	<div class="col-sm-4">
		<a href="<?php echo site_url('condomini');?>" class="list-group-item">
			<h4 class="list-group-item-heading">Condomini</h4>
			<p class="list-group-item-text">Aggiungi, rimuovi e modifica i condomini. Definisci palazzine e gruppi</p>
		</a>
	</div>
	<div class="col-sm-4">
		<a href="<?php echo site_url('esercizi');?>" class="list-group-item">
			<h4 class="list-group-item-heading">Esercizio</h4>
			<p class="list-group-item-text">Aggiungi, rimuovi e modifica gli esercizi del condominio scelto.</p>
		</a>
	</div>
	<div class="col-sm-4">
		<a href="<?php echo site_url('unita');?>" class="list-group-item">
			<h4 class="list-group-item-heading">Unità</h4>
			<p class="list-group-item-text">Aggiungi, rimuovi e modifica le unità appartenenti al condominio scelto.</p>
		</a>
	</div>
</div>
<div class="space"></div>
<div class="row no-margin">
	<div class="col-sm-4">
		<a href="<?php echo site_url('tabelle');?>" class="list-group-item">
			<h4 class="list-group-item-heading">Tabelle</h4>
			<p class="list-group-item-text">Aggiungi, rimuovi e modifica le tabelle con le rispettive quote.</p>
		</a>
	</div>
	<div class="col-sm-4">
		<a href="<?php echo site_url('stampe');?>" class="list-group-item">
			<h4 class="list-group-item-heading">Stampe</h4>
			<p class="list-group-item-text">Esporta i dati del database in modo da poterli stampare.</p>
		</a>
	</div>
	<div class="col-sm-4" >
		<a href="<?php echo site_url('altro');?>" class="list-group-item">
			<h4 class="list-group-item-heading">Altro</h4>
			<p class="list-group-item-text">Definisci i dati dell'azienda, gli utenti e i backup.</p>
		</a>
	</div>
</div>