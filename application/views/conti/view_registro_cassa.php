<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-md-7">
		<div class="row">
			<div class="col-sm-3">Entrate: <span class="testo-verde"><?php echo $totale_entrate; ?>&euro;</span></div>
			<div class="col-sm-3">Uscite: <span class="testo-rosso"><?php echo $totale_uscite; ?>&euro;</span></div>
			<div class="col-sm-3">Saldo: <?php echo $totale_saldo; ?>&euro;</div>
			<div class="col-sm-3">Non pagato: <span class="testo-rosso"><?php echo $totale_non_pagato; ?>&euro;</span></div>
		</div>
		<div class="space"></div>
		<a href="<?php echo site_url('conti/registro_cassa/-1'); ?>">
			<button type="button" class="btn btn-primary">+ Nuova transazione</button>
		</a>
		<div class="space"></div>
		<table class="table table-hover">
			<tr><th>Nome</th><th>Data</th><th>Importo</th><th>Categoria</th><th>Saldo parziale</th></tr>
			<?php foreach($transazioni as $value){ ?>
				<tr <?php if($value['id'] == $id_transazione) echo 'class="info"'; ?>
				onclick="window.document.location='<?php echo site_url('conti/registro_cassa').'/'.$value['id']; ?>';">
					<td><?php echo $value['nome']; ?></td>
					<td><?php echo $value['data_competenza']; ?></td>
					<td class="<?php if($value['segno']==1) echo "testo-rosso"; else echo "testo-verde";?> <?php if($value['pagato']==0) echo "barrato";?>" >
						<?php echo $value['importo']; ?> &euro;
					</td>
					<td><?php if($value['tipo'] == "RATA") echo 'Pagamento rata'; else echo $value['nome_categoria']; ?></td>
					<td>
						<?php echo $totale_saldo; ?> &euro;
					</td>
				</tr>
				<?php 
					if($value['pagato']==1)
						if($value['segno']==1)
							$totale_saldo+=$value['importo'];
						else
							$totale_saldo-=$value['importo'];
				?>
			<?php } ?>
		</table>
		<p class="linea"></p>
		<p>Saldo iniziale: <?php echo $saldo_iniziale; ?> &euro;</p>
	</div>
	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading">Dati transazione</div>
			<div class="panel-body">
				<form action="<?php echo site_url('conti/edit_transazione');?>" method="POST">
					<div class="row">
						<div class="form-group col-md-12">
							<label>Nome</label>
							<input type="text" class="form-control" placeholder="Nome" name="nome" />
						</div>
						<div class="form-group col-md-12">
							<label>Segno</label>
							<div>
								<label class="radio-inline"><input type="radio" name="segno" id="segno_0" value="0">Entrata in cassa</label>
								<label class="radio-inline"><input type="radio" name="segno" id="segno_1" value="1">Uscita dalla cassa</label>
							</div>
						</div>
						<div class="form-group col-md-9">
							<label>Importo</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="0.00" name="importo" />
								<div class="input-group-addon">&euro;</div>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label>Pagato</label>
							<select class="form-control" name="pagato">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label>Tipo transazione</label>
							<select class="form-control" name="tipo_rata">
								<option value="ORDINARIA">Ordinaria</option>
								<option value="STRAORDINARIA">Straordinaria</option>
								<option value="ACQUEDOTTO">Acquedotto</option>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label>Descrizione</label>
							<textarea class="form-control" rows="1" name="descrizione" placeholder="Descrizione"></textarea>
						</div>
						<div class="form-group col-md-12">
							<label>Tipo</label>
							<div>
								<label class="radio-inline"><input type="radio" name="tipo" id="radio_servizio" value="SERVIZIO">Servizio</label>
								<label class="radio-inline"><input type="radio" name="tipo" id="radio_rata" value="RATA">Rata</label>
							</div>
						</div>
						<div id="div_servizio">
							<div class="form-group col-md-4">
								<label>Data competenza</label>
								<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_competenza" />
							</div>
							<div class="form-group col-md-4">
								<label>Data fattura</label>
								<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_fattura" />
							</div>
							<div class="form-group col-md-4">
								<label>Data pagamento</label>
								<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_pagamento" />
							</div>
							<div class="form-group col-md-12">
								<label>Fornitore</label>
								<select class="form-control" name="id_fornitore">
									<?php foreach($fornitori as $value){ ?>
									<option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label>Sottocategoria</label>
								<select class="form-control" name="id_sottocategoria">
									<?php foreach($sottocategorie as $value){ ?>
										<option value="<?php echo $value['id']; ?>"><?php echo $value['nome_categoria'].' > '.$value['nome']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div id="div_rata">
							<div class="form-group col-md-4">
								<label>Data</label>
								<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data" />
							</div>
							<div class="form-group col-md-8">
								<label>Unita pagante</label>
								<select class="form-control" name="id_relazione_unita">
									<?php foreach($proprietari_conduttori as $value){ ?>
									<option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
					</div>
					<input value="<?php echo $id_transazione; ?>" name="id_transazione" hidden />
					<?php if($id_transazione != -1){ ?>
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
	<?php foreach($transazione as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
	// Correzione dei valori
	$("#radio_servizio").val('SERVIZIO');
	$("#radio_rata").val('RATA');
	$("#segno_1").val('1');
	$("#segno_0").val('0');
	//$("#segno_1").prop("checked", true);
	
	// set servizio/rata
	<?php
	if(isset($transazione['tipo'])) {
		if($transazione['tipo'] == 'RATA'){ ?>
			$("#div_servizio").hide();
			$("#radio_rata").prop("checked", true);
			$("#segno_1").prop("disabled", true);
		<?php }else{ ?>
			$("#div_rata").hide();
			$("#radio_servizio").prop("checked", true);
		<?php }
	}else{ ?>
		$("#div_rata").hide();
		$("#radio_servizio").prop("checked", true);
	<?php } ?>
	
	// set segno
	<?php
	if(isset($transazione['segno'])) {
		if($transazione['segno'] == 1){ ?>
			$("#segno_1").prop("checked", true);
	<?php }else{ ?>
			$("#segno_0").prop("checked", true);
	<?php } 
	}else{ ?>
		$("#segno_0").prop("checked", true);
	<?php } ?>
	
	$("#radio_servizio").click(function(){
		$("#div_rata").hide();
		$("#div_servizio").show();
		$("#segno_1").prop("disabled", false); // attivato
	});
	$("#radio_rata").click(function(){
		$("#div_servizio").hide();
		$("#div_rata").show();
		$("#segno_0").prop("checked", true); // selezionato
		$("#segno_1").prop("disabled", true); // disattivato
	});
	
</script>