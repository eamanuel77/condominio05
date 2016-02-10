<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-12">
		<form action="<?php echo site_url('altro/edit_azienda');?>" method="POST">
			<div class="row">
				<div class="form-group col-sm-12">
					<label>Nome</label>
					<input type="text" class="form-control" placeholder="Nome" name="nome"/>
				</div>
				<div class="form-group col-sm-12"><p class="linea"></p></div>
				<div class="form-group col-sm-12">
					<h3>Dati ufficio</h3>
				</div>
				<div class="form-group col-sm-12">
					<label>Indirizzo</label>
					<input type="text" class="form-control" placeholder="Indirizzo" name="indirizzo"/>
				</div>
				<div class="form-group col-sm-5">
					<label>Citt&agrave;</label>
					<input type="text" class="form-control" placeholder="Citt&agrave;" name="citta"/>
				</div>
				<div class="form-group col-sm-3">
					<label>CAP</label>
					<input type="text" class="form-control" placeholder="CAP" name="cap"/>
				</div>
				<div class="form-group col-sm-4">
					<label>Provinvia</label>
					<input type="text" class="form-control" placeholder="Provincia" name="provincia"/>
				</div>
				<div class="form-group col-sm-12"><p class="linea"></p></div>
				<div class="form-group col-sm-12">
					<h3>Altri dati</h3>
				</div>
				<div class="form-group col-sm-12">
					<label>Partita IVA</label>
					<input type="text" class="form-control" placeholder="Partita IVA" name="piva"/>
				</div>
				<div class="form-group col-sm-12">
					<label>Codice fiscale</label>
					<input type="text" class="form-control" placeholder="Codice fiscale" name="codice_fiscale"/>
				</div>
				<div class="form-group col-sm-12">
					<label>Telefono</label>
					<input type="text" class="form-control" placeholder="Telefono" name="telefono"/>
				</div>
				<div class="form-group col-sm-6">
					<label>Cellulare</label>
					<input type="text" class="form-control" placeholder="Cellulare" name="cellulare"/>
				</div>
				<div class="form-group col-sm-6">
					<label>Fax</label>
					<input type="text" class="form-control" placeholder="Fax" name="fax"/>
				</div>
				<div class="form-group col-sm-6">
					<label>Email</label>
					<input type="text" class="form-control" placeholder="Email" name="email"/>
				</div>
				<div class="form-group col-sm-6">
					<label>Posta elettronica certificata(PEC)</label>
					<input type="text" class="form-control" placeholder="Pec" name="pec"/>
				</div>
				<div class="form-group col-sm-12">
					<label>Sito web</label>
					<input type="text" class="form-control" placeholder="Sito web" name="website"/>
				</div>
				<div class="form-group col-sm-12"><p class="linea"></p></div>
				<div class="form-group col-sm-12">
					<h3>Dati per la stampa</h3>
				</div>
				<div class="form-group col-sm-12">
					<label>Descrizione</label>
					<textarea type="text" class="form-control" placeholder="Descrizione" name="descrizione"></textarea>
				</div>
			</div>
			<input value="<?php echo $id_azienda; ?>" name="id_azienda" hidden />
			<button name="action" value="save" type="submit" class="btn btn-default">Salva</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	// TODO sanitize script
	<?php foreach($dati_azienda as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
</script>