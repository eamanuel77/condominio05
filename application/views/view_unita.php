<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-6">
		<table class="table table-hover">
			<tr><th>ID</th><th>Tipo</th><th>Proprietari</th><th>Interno</th><th>Piano</th></tr>
			<?php foreach($unita as $value){ ?>
				<tr <?php if($value['id'] == $id_unita) echo 'class="info"'; ?>
				onclick="window.document.location='<?php echo site_url('unita/index').'/'.$value['id']; ?>';">
					<td><?php echo $value['id']; ?></td>
					<td><?php echo $value['tipo']; ?></td>
					<td><?php echo $value['proprietari']; ?></td>
					<td><?php echo $value['interno']; ?></td>
					<td><?php echo $value['piano']; ?></td>
				</tr>
			<?php } ?>
		</table>
		<div class="space"></div>
		<a href="<?php echo site_url('unita/index/-1'); ?>">
			<button type="button" class="btn btn-primary">+ Nuovo</button>
		</a>
	</div>
	<div class="col-sm-6">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">Dati unit&agrave;</div>
				<div class="panel-body">
					<form action="<?php echo site_url('unita/edit'); ?>" method="POST">
						<div class="row">
							<div class="form-group col-sm-6">
								<label>Tipo</label>
								<input type="text" class="form-control" placeholder="Tipo" name="tipo"/>
							</div>
							<div class="form-group col-sm-6">
								<label>Frequenza rate</label>
								<select class="form-control" name="frequenza_rate">
									<option value="MENSILE">Mensile</option>
									<option value="BIMESTRALE">Bimestrale</option>
									<option value="TRIMESTRALE">Trimestrale</option>
									<option value="ANNUALE">Annuale</option>
								</select>
							</div>
							<div class="form-group col-sm-12">
								<label>Gruppo</label>
								<select class="form-control" name="id_gruppo">
									<?php foreach($gruppi as $value){ ?>
										<option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-sm-3">
								<label>Piano</label>
								<input type="text" class="form-control" placeholder="Piano" name="piano" />
							</div>
							<div class="form-group col-sm-3">
								<label>Interno</label>
								<input type="text" class="form-control" placeholder="Interno" name="interno" />
							</div>
							<div class="form-group col-sm-6">
								<label>Categoria acquedotto</label>
								<select class="form-control" name="categoria_acquedotto">
									<option value="DOMESTICO">Domestico</option>
									<option value="PUBBLICO">Pubblico</option>
									<option value="COMMERICIALE">Commerciale</option>
									<option value="INDUSTRIALE">Industriale</option>
									<option value="ALTRO">Altro</option>
								</select>
							</div>
							<div class="form-group col-sm-12">
								<label>Note</label>
								<textarea rows="1" class="form-control" placeholder="Note" name="note" ></textarea>
							</div>
							
							<div class="form-group col-sm-12">
								<h3>Dati catastali</h3>
							</div>
							<div class="form-group col-sm-4">
								<label>Foglio</label>
								<input type="text" class="form-control" placeholder="Foglio" name="foglio" />
							</div>
							<div class="form-group col-sm-4">
								<label>Particella</label>
								<input type="number" class="form-control" placeholder="Particella" name="particella" />
							</div>
							<div class="form-group col-sm-4">
								<label>Subalterno</label>
								<input type="number" class="form-control" placeholder="Subalterno" name="subalterno" />
							</div>
							<div class="form-group col-sm-4">
								<label>Categoria</label>
								<input type="text" class="form-control" placeholder="Categoria" name="categoria" />
							</div>
							<div class="form-group col-sm-8">
								<label>Rendita</label>
								<div class="input-group">
									<input type="text" class="form-control" placeholder="0.00" name="rendita" />
									<div class="input-group-addon">&euro;</div>
								</div>
							</div>
						</div>
						<input value="<?php echo $id_unita; ?>" name="id_unita" hidden />
						<?php if($id_unita != -1){ ?>
							<button name="action" value="save" type="submit" class="btn btn-default">Salva</button>
							<button name="action" value="delete" type="submit" class="pull-right btn btn-danger">Elimina</button>
						<?php }else{ ?>
							<button name="action" value="add" type="submit" class="btn btn-default">Aggiungi</button>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
		<?php if($id_unita != -1){ ?>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">Relazioni unit&agrave;</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-12">
							<div class="row">
								<div class="col-sm-9"><label>Proprietari</label></div><div class="col-sm-3"><label>Azione</label></div>
							</div>
							<?php foreach($proprietari as $value){ ?>
							<div class="row">
								<form action="<?php echo site_url("unita/edit_relazione/PROPRIETARIO"); ?>" method="POST">
									<div class="form-group col-sm-9">
										<input value="<?php echo $id_unita; ?>" name="id_unita" hidden />
										<input value="<?php echo $value['id']; ?>" name="id_relazione" hidden />
										<select class="form-control" name="id_persona">
											<?php foreach($persone as $value2){ ?>
											<option <?php if($value2['id'] == $value['id_persona']) echo 'selected'; ?> value="<?php echo $value2['id']; ?>"><?php echo $value2['nome']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-sm-3">
										<button title="Salva" value="save" name="action" type="submit" class="btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-floppy-disk"></span></button>
										<button title="Elimina" value="delete" name="action" type="submit" class="btn btn-danger"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
									</div>
								</form>
							</div>
							<?php } ?>
							<div class="row">
								<form action="<?php echo site_url("unita/edit_relazione/PROPRIETARIO"); ?>" method="POST">
									<div class="col-sm-9">
										<input value="<?php echo $id_unita; ?>" name="id_unita" hidden />
										<input value="<?php echo -1; ?>" name="id_relazione" hidden />
										<select class="form-control" name="id_persona">
											<?php foreach($persone as $value2){ ?>
											<option value="<?php echo $value2['id']; ?>"><?php echo $value2['nome']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-3">
										<button title="Nuovo" type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></button>
									</div>
								</form>
							</div>
							<div class="row">
								<div class="col-sm-6"><label>Conduttori</label></div><div class="col-sm-3"><label>Data inizio</label></div><div class="col-sm-3"><label>Azione</label></div>
							</div>
							<?php foreach($conduttori as $value){ ?>
							<div class="row">
								<form action="<?php echo site_url("unita/edit_relazione/CONDUTTORE"); ?>" method="POST">
									<div class="form-group col-sm-6">
										<input value="<?php echo $id_unita; ?>" name="id_unita" hidden />
										<input value="<?php echo $value['id']; ?>" name="id_relazione" hidden />
										<select class="form-control" name="id_persona">
											<?php foreach($persone as $value2){ ?>
											<option <?php if($value2['id'] == $value['id_persona']) echo 'selected'; ?> value="<?php echo $value2['id']; ?>"><?php echo $value2['nome']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-3">
										<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_inizio" value="<?php echo $value['data_inizio']; ?>" />
									</div>
									<div class="form-group col-sm-3">
										<button title="Salva" value="save" name="action" type="submit" class="btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-floppy-disk"></span></button>
										<button title="Elimina" value="delete" name="action" type="submit" class="btn btn-danger"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
									</div>
								</form>
							</div>
							<?php } ?>
							<div class="row">
								<form action="<?php echo site_url("unita/edit_relazione/CONDUTTORE"); ?>" method="POST">
									<div class="col-sm-6">
										<input value="<?php echo $id_unita; ?>" name="id_unita" hidden />
										<input value="<?php echo -1; ?>" name="id_relazione" hidden />
										<select class="form-control" name="id_persona">
											<?php foreach($persone as $value2){ ?>
											<option value="<?php echo $value2['id']; ?>"><?php echo $value2['nome']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-3">
										<input type="text" class="form-control" placeholder="gg/mm/aaaa" name="data_inizio" />
									</div>
									<div class="col-sm-3">
										<button title="Nuovo" type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></button>
									</div>
								</form>
							</div>
							<div class="row">
								<div class="col-sm-9"><label>Usufruttuari</label></div><div class="col-sm-3"><label>Azione</label></div>
							</div>
							<?php foreach($usufruttuari as $value){ ?>
							<div class="row">
								<form action="<?php echo site_url("unita/edit_relazione/USUFRUTTUARIO"); ?>" method="POST">
									<div class="form-group col-sm-9">
										<input value="<?php echo $id_unita; ?>" name="id_unita" hidden />
										<input value="<?php echo $value['id']; ?>" name="id_relazione" hidden />
										<select class="form-control" name="id_persona">
											<?php foreach($persone as $value2){ ?>
											<option <?php if($value2['id'] == $value['id_persona']) echo 'selected'; ?> value="<?php echo $value2['id']; ?>"><?php echo $value2['nome']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-sm-3">
										<button title="Salva" value="save" name="action" type="submit" class="btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-floppy-disk"></span></button>
										<button title="Elimina" value="delete" name="action" type="submit" class="btn btn-danger"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
									</div>
								</form>
							</div>
							<?php } ?>
							<div class="row">
								<form action="<?php echo site_url("unita/edit_relazione/USUFRUTTUARIO"); ?>" method="POST">
									<div class="col-sm-9">
										<input value="<?php echo $id_unita; ?>" name="id_unita" hidden />
										<input value="<?php echo -1; ?>" name="id_relazione" hidden />
										<select class="form-control" name="id_persona">
											<?php foreach($persone as $value2){ ?>
											<option value="<?php echo $value2['id']; ?>"><?php echo $value2['nome']; ?></option>
											<?php } ?>
										</select>
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
	<?php foreach($dati_unita as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
</script>