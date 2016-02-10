<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-3">
		<ul class="nav nav-pills nav-stacked">
			<?php foreach($condomini as $value){ ?>
				<li <?php if($value['id'] == $id_condominio) echo 'class="active"'; ?> >
					<a href="<?php echo site_url('condomini/index/'.$value['id']); ?>"><?php echo $value['nome']; ?></a>
				</li>
			<?php } ?>
		</ul>
		<div class="space"></div>
		<a href="<?php echo site_url('condomini/index/-1'); ?>">
			<button type="button" class="btn btn-primary">+ Nuovo</button>
		</a>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">Dati condominio</div>
				<div class="panel-body">
					<form action="<?php echo site_url('condomini/edit');?>" method="POST">
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Nome</label>
								<input type="text" class="form-control" placeholder="Nome" name="nome"/>
							</div>
							<div class="form-group col-sm-12">
								<label>Indirizzo</label>
								<input type="text" class="form-control" placeholder="Indirizzo" name="indirizzo"/>
							</div>
							<div class="form-group col-sm-5">
								<label>Citt&agrave;</label>
								<input type="text" class="form-control" placeholder="Citt&agrave;" name="citta"/>
							</div>
							<div class="form-group col-sm-2">
								<label>CAP</label>
								<input type="text" class="form-control" placeholder="CAP" name="cap"/>
							</div>
							<div class="form-group col-sm-5">
								<label>Provinvia</label>
								<input type="text" class="form-control" placeholder="Provincia" name="provincia"/>
							</div>
							<div class="form-group col-sm-12">
								<label>Codice fiscale</label>
								<input type="text" class="form-control" placeholder="Codice fiscale" name="codice_fiscale"/>
							</div>
							<div class="form-group col-sm-12">
								<h3>Dati bancari</h3>
							</div>
							<div class="form-group col-sm-12">
								<label>IBAN</label>
								<input type="text" class="form-control" placeholder="IBAN" name="iban"/>
							</div>
							<div class="form-group col-sm-12">
								<label>Banca</label>
								<input type="text" class="form-control" placeholder="Banca" name="banca"/>
							</div>
							<div class="form-group col-sm-12">
								<label>Codice c/c</label>
								<input type="text" class="form-control" placeholder="Codice c/c" name="codice_cc"/>
							</div>
						</div>
						<input value="<?php echo $id_condominio; ?>" name="id_condominio" hidden />
						<?php if($id_condominio != -1) { ?>
						<button name="action" value="save" type="submit" class="btn btn-default">Salva</button>
						<button name="action" value="delete" type="submit" class="pull-right btn btn-danger">Elimina</button>
						<?php }else{ ?>
						<button name="action" value="add" type="submit" class="btn btn-default">Aggiungi</button>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
		<?php if($id_condominio != -1) { ?>
		<div class="row">
		<div class="panel panel-default">
				<div class="panel-heading">Struttura</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-12">
							<div class="row">
								<div class="col-sm-9"><label>Palazzine</label></div><div class="col-sm-3"><label>Azione</label></div>
							</div>
							<?php foreach($palazzine as $value){ ?>
							<div class="row">
								<form action="<?php echo site_url("condomini/edit_palazzina"); ?>" method="POST">
									<div class="form-group col-sm-9">
										<input value="<?php echo $id_condominio; ?>" name="id_condominio" hidden />
										<input name="id_palazzina" value="<?php echo $value['id']; ?>" hidden />
										<input class="form-control" type="text" name="descrizione" placeholder="Descrizione" value="<?php echo $value['descrizione']; ?>" />
									</div>
									<div class="form-group col-sm-3">
										<button title="Salva" value="save" name="action" type="submit" class="btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-floppy-disk"></span></button>
										<button title="Elimina" value="delete" name="action" type="submit" class="btn btn-danger"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
									</div>
								</form>
							</div>
							<?php } ?>
							<div class="row">
								<form action="<?php echo site_url("condomini/edit_palazzina"); ?>" method="POST">
									<div class="col-sm-9">
										<input value="<?php echo $id_condominio; ?>" name="id_condominio" hidden />
										<input name="id_palazzina" value="-1" hidden />
										<input class="form-control" type="text" name="descrizione" placeholder="Descrizione" />
									</div>
									<div class="col-sm-3">
										<button title="Nuovo" type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></button>
									</div>
								</form>
							</div>
						</div>
						<div class="form-group col-sm-12">
							<div class="row">
								<div class="col-sm-9"><label>Gruppi</label></div><div class="col-sm-3"><label>Azione</label></div>
							</div>
							<?php foreach($gruppi as $value){ ?>
							<div class="row">
								<form action="<?php echo site_url("condomini/edit_gruppo"); ?>" method="POST">
									<div class="form-group col-sm-4">
										<select class="form-control" name="id_palazzina">
											<?php foreach($palazzine as $value2){ ?>
											<option <?php if($value2['id'] == $value['id_palazzina']) echo "selected"; ?> value="<?php echo $value2['id']; ?>"><?php echo $value2['descrizione']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-sm-5">
										<input value="<?php echo $id_condominio; ?>" name="id_condominio" hidden />
										<input name="id_gruppo" value="<?php echo $value['id']; ?>" hidden />
										<input class="form-control" type="text" name="descrizione" placeholder="Descrizione" value="<?php echo $value['descrizione']; ?>" />
									</div>
									<div class="form-group col-sm-3">
										<button title="Salva" value="save" name="action" type="submit" class="btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-floppy-disk"></span></button>
										<button title="Elimina" value="delete" name="action" type="submit" class="btn btn-danger"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
									</div>
								</form>
							</div>
							<?php } ?>
							<div class="row">
								<form action="<?php echo site_url("condomini/edit_gruppo"); ?>" method="POST">
									<div class="form-group col-sm-4">
										<select class="form-control" name="id_palazzina">
											<?php foreach($palazzine as $value){ ?>
											<option value="<?php echo $value['id']; ?>"><?php echo $value['descrizione']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-5">
										<input value="<?php echo $id_condominio; ?>" name="id_condominio" hidden />
										<input name="id_gruppo" value="-1" hidden />
										<input class="form-control" type="text" name="descrizione" placeholder="Descrizione" />
									</div>
									<div class="col-sm-3">
										<button title="Nuovo" type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript">
	// TODO sanitize script
	<?php foreach($dati_condominio as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
</script>