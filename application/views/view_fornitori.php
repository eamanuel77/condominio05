<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-5">
		<table class="table table-hover">
			<tr><th>Ragione sociale</th><th>Titolare</th><th>Telefono</th><th>Cellulare</th></tr>
			<?php foreach($fornitori as $value){ ?>
				<tr <?php if($value['id'] == $id_fornitore) echo 'class="info"'; ?>
				onclick="window.document.location='<?php echo site_url('fornitori/index').'/'.$value['id']; ?>';">
					<td><?php echo $value['ragione_sociale']; ?></td>
					<td><?php echo $value['titolare']; ?></td>
					<td><?php echo $value['telefono']; ?></td>
					<td><?php echo $value['cellulare']; ?></td>
				</tr>
			<?php } ?>
		</table>
		<a href="<?php echo site_url('fornitori/index/-1'); ?>">
			<button type="button" class="btn btn-primary">+ Nuovo</button>
		</a>
	</div>
	<div class="col-sm-7">
		<div class="panel panel-default">
			<div class="panel-heading">Dati fornitore</div>
			<div class="panel-body">
				<form action="<?php echo site_url('fornitori/edit');?>" method="POST">
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Ragione sociale</label>
							<input type="text" class="form-control" placeholder="Ragione sociale" name="ragione_sociale"/>
						</div>
						<div class="form-group col-sm-6">
							<label>Tipo attivit&agrave;</label>
							<input type="text" class="form-control" placeholder="Tipo attivit&agrave;" name="tipo"/>
						</div>
						<div class="form-group col-sm-12">
							<h3>Domicilio</h3>
						</div>
						<div class="form-group col-sm-8">
							<label>Indirizzo</label>
							<input type="text" class="form-control" placeholder="Indirizzo" name="indirizzo" />
						</div>
						<div class="form-group col-sm-4">
							<label>Citt&agrave </label>
							<input type="text" class="form-control" placeholder="Citt&agrave" name="citta" />
						</div>
						<div class="form-group col-sm-3">
							<label>CAP</label>
							<input type="text" class="form-control" placeholder="CAP" name="cap" />
						</div>
						<div class="form-group col-sm-4">
							<label>Provincia</label>
							<input type="text" class="form-control" placeholder="Provincia" name="provincia" />
						</div>
						<div class="form-group col-sm-5">
							<label>Nazione</label>
							<input type="text" class="form-control" placeholder="Nazione" name="nazione" />
						</div>
						
						<div class="form-group col-sm-12">
							<h3>Informazioni</h3>
						</div>
						<div class="form-group col-sm-6">
							<label>Codice fiscale</label>
							<input type="text" class="form-control" placeholder="Codice fiscale" name="codice_fiscale"/>
						</div>
						<div class="form-group col-sm-6">
							<label>Partita IVA</label>
							<input type="text" class="form-control" placeholder="Partita IVA" name="piva"/>
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
							<h3>Titolare</h3>
						</div>
						<div class="form-group col-sm-4">
							<label>Nome</label>
							<input type="text" class="form-control" placeholder="Nome" name="nome_titolare" />
						</div>
						<div class="form-group col-sm-4">
							<label>Cognome</label>
							<input type="text" class="form-control" placeholder="Cognome" name="cognome_titolare" />
						</div>
						<div class="form-group col-sm-4">
							<label>Data di nascita</label>
							<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_nascita_titolare" />
						</div>
						<div class="form-group col-sm-12">
							<label>Note titolare</label>
							<textarea rows="2" class="form-control" placeholder="Note" name="note_titolare"></textarea>
						</div>
						<div class="form-group col-sm-12">
							<h3>Altro</h3>
						</div>
						<div class="form-group col-sm-6">
							<label>Banca</label>
							<input type="text" class="form-control" placeholder="Banca" name="banca" />
						</div>
						<div class="form-group col-sm-6">
							<label>Metodo di pagamento</label>
							<input type="text" class="form-control" placeholder="Metodo di pagamento" name="metodo_pagamento" />
						</div>
						<div class="form-group col-sm-12">
							<label>Ritenuta acconto</label>
							<select class="form-control" name="ritenuta_acconto">
								<option value="NESSUNA">Nessuna</option>
								<option value="1040">1040 -  20% - Liberi professionisti</option>
								<option value="1019">1019 -   4% - Ditte individuali e societa di persone</option>
								<option value="1020">1020 -   4% - Societa di capitali</option>
							</select>
						</div>
						<div class="form-group col-sm-12">
							<label>Note</label>
							<textarea rows="2" class="form-control" placeholder="Note" name="note"></textarea>
						</div>
					</div>
					<input value="<?php echo $id_fornitore; ?>" name="id_fornitore" hidden />
					<?php if($id_fornitore != -1){ ?>
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
	<?php foreach($dati_fornitore as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
</script>