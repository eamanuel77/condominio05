<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-3">
		<ul class="nav nav-pills nav-stacked">
			<?php foreach($esercizi as $value){ ?>
				<li <?php if($value['id'] == $id_esercizio) echo 'class="active"'; ?> >
					<a href="<?php echo site_url('esercizi/index/'.$value['id']); ?>"><?php echo $value['nome']; ?></a>
				</li>
			<?php } ?>
		</ul>
		<div class="space"></div>
		<a href="<?php echo site_url('esercizi/index/-1'); ?>">
			<button type="button" class="btn btn-primary">+ Nuovo</button>
		</a>
	</div>
	<div class="col-sm-9">
		<div class="panel panel-default">
			<div class="panel-heading">Dati esercizio</div>
			<div class="panel-body">
				<form action="<?php echo site_url('esercizi/edit');?>" method="POST">
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Data inizio</label>
							<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_inizio"/>
						</div>
						<div class="form-group col-sm-6">
							<label>Data fine</label>
							<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_fine"/>
						</div>
						<div class="form-group col-sm-12">
								<label>Saldo iniziale</label>
								<div class="input-group">
									<input type="text" class="form-control" placeholder="0.00" name="saldo_iniziale" />
									<div class="input-group-addon">&euro;</div>
								</div>
							</div>
						<div class="form-group col-sm-12">
							<label>Descrizione</label>
							<textarea rows="2" class="form-control" placeholder="Descrizione" name="descrizione"></textarea>
						</div>
					</div>
					<input value="<?php echo $id_esercizio; ?>" name="id_esercizio" hidden />
					<?php if($id_esercizio != -1){ ?>
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
	<?php foreach($dati_esercizio as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
</script>