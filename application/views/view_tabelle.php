<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-4">
		<table class="table table-hover">
			<tr><th>Nome</th><th class="text-center">Straordinari</th><th class="text-center">Acquedotto</th></tr>
			<?php foreach($tabelle as $value){ ?>
				<tr <?php if($value['id'] == $id_tabella) echo 'class="info"'; ?>
				onclick="window.document.location='<?php echo site_url('tabelle/index').'/'.$value['id']; ?>';">
					<td><?php echo $value['nome']; ?></td>
					<td class="text-center"><?php if($value['straordinari']) echo '<span aria-hidden="true" class="glyphicon glyphicon-ok"></span>'; ?></td>
					<td class="text-center"><?php if($value['acquedotto']) echo '<span aria-hidden="true" class="glyphicon glyphicon-ok"></span>'; ?></td>
				</tr>
			<?php } ?>
		</table>
		<div class="space"></div>
		<a href="<?php echo site_url('tabelle/index/-1'); ?>">
			<button type="button" class="btn btn-primary">+ Nuovo</button>
		</a>
	</div>
	<div class="col-sm-8">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">Dati tabella</div>
				<div class="panel-body">
					<form action="<?php echo site_url('tabelle/edit');?>" method="POST">
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Nome</label>
								<input type="text" class="form-control" placeholder="Nome" name="nome"/>
							</div>
							<div class="form-group col-sm-12">
								<label>Descrizione</label>
								<textarea rows="2" class="form-control" placeholder="Descrizione" name="descrizione"></textarea>
							</div>
						</div>
						<input value="<?php echo $id_tabella; ?>" name="id_tabella" hidden />
						<?php if($id_tabella != -1) { ?>
						<button name="action" value="save" type="submit" class="btn btn-default">Salva</button>
						<button name="action" value="delete" type="submit" class="pull-right btn btn-danger">Elimina</button>
						<?php }else{ ?>
						<button name="action" value="add" type="submit" class="btn btn-default">Aggiungi</button>
						<?php } ?>
					</form>
					<?php if($id_tabella != -1) { ?>
					<div class="space"></div>
					<div class="row">
						<div class="col-sm-12">
							<label>Imposta come tabella per:</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<a href="<?php echo site_url('tabelle/edit_straordinari/'.$id_tabella); ?>">
								<button type="button" class="btn btn-primary">Spese straordinarie</button>
							</a>
							<a href="<?php echo site_url('tabelle/edit_acquedotto/'.$id_tabella); ?>">
								<button type="button" class="btn btn-primary">Spese per l'acquedotto</button>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php if($id_tabella != -1){ ?>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">Quote tabella</div>
				<div class="panel-body">
					<form action="<?php echo site_url('tabelle/edit_dati');?>" method="POST">
						<div class="row">
							<div class="col-sm-2"><label>Unit&agrave </label></div><div class="col-sm-4"><label>Persona</label></div><div class="col-sm-3"><label>Rapporto</label></div><div class="col-sm-3"><label>Quota</label></div>
						</div>
						<?php
						$lastUnita = 0;
						$totale = 0;
						foreach($dati_contenuto_tabella as $key => $value){
							if($lastUnita != $value['id_unita']){ ?>
								<div class="row"><div class="col-sm-12"><p class="linea"></p></div></div>
							<?php } ?>
							<div class="row">
								<div class="col-sm-2"><?php if($lastUnita != $value['id_unita']) echo $value['id_unita']; ?></div>
								<div class="col-sm-4"><?php echo $value['persona']; ?></div>
								<div class="col-sm-3"><?php echo $value['rapporto']; ?></div>
								<div class="col-sm-3"><input type="text" class="form-control" placeholder="Quota" name="quota_<?php echo $key; ?>" value="<?php echo $value['quota']; ?>" /></div>
								<input name="id_dato_tabella_<?php echo $key; ?>" value="<?php echo $value['id']; ?>" hidden />
								<?php $totale += $value['quota'];?>
							</div>
						<?php 
							$lastUnita = $value['id_unita'];
						} ?>
						<div class="row"><div class="col-sm-12">
							<p class="pull-right"><strong>Totale:</strong> <span id="totale"><?php echo $totale; ?></span></p>
						</div></div>
						<div class="row"><div class="col-sm-12">
							<input value="<?php echo count($dati_contenuto_tabella); ?>" name="count_dati_tabella" hidden />
							<input value="<?php echo $id_tabella; ?>" name="id_tabella" hidden />
							<button name="action" value="save" type="submit" class="btn btn-default">Salva</button>
							<button name="action" value="update" type="submit" class="pull-right btn btn-primary">Aggiorna dati</button>
						</div></div>
					</form>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript">
	// TODO sanitize script
	<?php foreach($dati_tabella as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
	
	$("input[name^='quota_']").change(function(){
		totale = 0;
		$("input[name^='quota_']").each(function(){
			totale += parseFloat($(this).val());
		});
		$("#totale").html(totale);
	});
</script>