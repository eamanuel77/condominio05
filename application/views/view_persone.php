<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-5">
		<table class="table table-hover">
			<tr><th>ID</th><th>Cognome</th><th>Nome</th></tr>
			<?php foreach($persone as $value){ ?>
				<tr <?php if($value['id'] == $id_persona) echo 'class="info"'; ?>
				onclick="window.document.location='<?php echo site_url('persone/index').'/'.$value['id']; ?>';">
					<td><?php echo $value['id']; ?></td>
					<td><?php echo $value['cognome']; ?></td>
					<td><?php echo $value['nome']; ?></td>
				</tr>
			<?php } ?>
		</table>
		<a href="<?php echo site_url('persone/index/-1'); ?>">
			<button type="button" class="btn btn-primary">+ Nuovo</button>
		</a>
	</div>
	<div class="col-sm-7">
		<div class="panel panel-default">
			<div class="panel-heading">Dati persona</div>
			<div class="panel-body">
				<form action="<?php echo site_url('persone/edit');?>" method="POST">
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Nome</label>
							<input type="text" class="form-control" placeholder="Nome" name="nome"/>
						</div>
						<div class="form-group col-sm-6">
							<label>Cognome</label>
							<input type="text" class="form-control" placeholder="Cognome" name="cognome"/>
						</div>
						<div class="form-group col-sm-7">
							<label>Codice fiscale</label>
							<input type="text" class="form-control" placeholder="Codice fiscale" name="codice_fiscale"/>
						</div>
						<div class="form-group col-sm-5">
							<label>Data di nascita</label>
							<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_nascita" />
						</div>
						<div class="form-group col-sm-6">
							<label>Telefono</label>
							<input type="text" class="form-control" placeholder="Telefono" name="telefono" />
						</div>
						<div class="form-group col-sm-6">
							<label>Cellulare</label>
							<input type="text" class="form-control" placeholder="Cellulare" name="cellulare" />
						</div>
						<div class="form-group col-sm-12">
							<label>Email</label>
							<input type="text" class="form-control" placeholder="Email" name="email" />
						</div>
						<div class="form-group col-sm-12">
							<h3>Residenza</h3>
						</div>
						<div class="form-group col-sm-8">
							<label>Indirizzo</label>
							<input type="text" class="form-control" placeholder="Indirizzo" name="indirizzo_residenza" />
						</div>
						<div class="form-group col-sm-4">
							<label>Citt&agrave </label>
							<input type="text" class="form-control" placeholder="Citt&agrave" name="citta_residenza" />
						</div>
						<div class="form-group col-sm-3">
							<label>CAP</label>
							<input type="text" class="form-control" placeholder="CAP" name="cap_residenza" />
						</div>
						<div class="form-group col-sm-4">
							<label>Provincia</label>
							<input type="text" class="form-control" placeholder="Provincia" name="provincia_residenza" />
						</div>
						<div class="form-group col-sm-5">
							<label>Nazione</label>
							<input type="text" class="form-control" placeholder="Nazione" name="nazione_residenza" />
						</div>
						<div class="form-group col-sm-12">
							<h3>Domicilio</h3>
						</div>
						<div class="form-group col-sm-8">
							<label>Indirizzo</label>
							<input type="text" class="form-control" placeholder="Indirizzo" name="indirizzo_domicilio" />
						</div>
						<div class="form-group col-sm-4">
							<label>Citt&agrave </label>
							<input type="text" class="form-control" placeholder="Citt&agrave" name="citta_domicilio" />
						</div>
						<div class="form-group col-sm-3">
							<label>CAP</label>
							<input type="text" class="form-control" placeholder="CAP" name="cap_domicilio" />
						</div>
						<div class="form-group col-sm-4">
							<label>Provincia</label>
							<input type="text" class="form-control" placeholder="Provincia" name="provincia_domicilio" />
						</div>
						<div class="form-group col-sm-5">
							<label>Nazione</label>
							<input type="text" class="form-control" placeholder="Nazione" name="nazione_domicilio" />
						</div>
						<div class="form-group col-sm-12">
							<h3>Altro</h3>
						</div>
						<div class="form-group col-sm-6">
							<label>Metodo di invio</label>
							<select class="form-control" name="metodo_invio">
								<option value="NESSUNO">Nessuno</option>
								<option value="PEC">PEC</option>
								<option value="RACCOMANDATA">Raccomandata</option>
								<option value="FAX">FAX</option>
							</select>
						</div>
						<div class="form-group col-sm-6">
							<label>Metodo di pagamento</label>
							<select class="form-control" name="metodo_pagamento">
								<option value="NESSUNO">Nessuno</option>
								<option value="BONIFICO">Bonifico</option>
								<option value="BOLLETTINO">Bollettino</option>
							</select>
						</div>
					</div>
					<input value="<?php echo $id_persona; ?>" name="id_persona" hidden />
					<?php if($id_persona != -1){ ?>
					<button name="action" value="save" type="submit" class="btn btn-default">Salva</button>
					<button name="action" value="delete" type="submit" class="pull-right btn btn-danger">Elimina</button>
					<?php }else{ ?>
					<button name="action" value="add" type="submit" class="btn btn-default">Aggiungi</button>
					<?php } ?>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// TODO sanitize script
	<?php foreach($dati_persona as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
</script>