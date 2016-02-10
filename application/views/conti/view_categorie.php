<h3>Categorie</h3>
<div class="row">
	<div class="col-md-5"><label>Nome</label></div><div class="col-md-5"><label>Note</label></div><div class="col-md-2"><label>Azione</label></div>
</div>
<?php foreach($categorie as $value){ ?>
<div class="row">
	<form action="<?php echo site_url("conti/edit_categoria"); ?>" method="POST">
		<div class="form-group col-md-5">
			<input class="form-control" type="text" name="nome" placeholder="Nome" value="<?php echo $value['nome']; ?>" />
		</div>
		<div class="form-group col-md-5">
			<textarea class="form-control" rows="1" name="note" placeholder="Note"><?php echo $value['note']; ?></textarea>
		</div>
		<div class="form-group col-md-2">
			<input name="id_categoria" value="<?php echo $value['id'];?>" hidden />
			<button title="Salva" value="save" name="action" type="submit" class="btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-floppy-disk"></span></button>
			<button title="Elimina" value="delete" name="action" type="submit" class="btn btn-danger"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
		</div>
	</form>
</div>
<?php } ?>
<div class="row">
	<form action="<?php echo site_url("conti/edit_categoria"); ?>" method="POST">
		<div class="col-md-5">
			<input class="form-control" type="text" name="nome" placeholder="Nome" />
		</div>
		<div class="col-md-5">
			<textarea class="form-control" rows="1" name="note" placeholder="Note"></textarea>
		</div>
		<div class="col-md-2">
			<input name="id_categoria" value="-1" hidden />
			<button title="Nuovo" type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></button>
		</div>
	</form>
</div>
<h3>Sottocategorie</h3>
<div class="row">
	<div class="col-md-4"><label>Categoria</label></div><div class="col-md-4"><label>Nome</label></div><div class="col-md-2"><label>Note</label></div><div class="col-md-2"><label>Azione</label></div>
</div>
<?php foreach($sottocategorie as $value){ ?>
<div class="row">
	<form action="<?php echo site_url("conti/edit_sottocategoria"); ?>" method="POST">
		<div class="form-group col-md-4">
			<select class="form-control" name="id_categoria">
				<?php foreach($categorie as $value2){ ?>
				<option <?php if($value['id_categoria'] == $value2['id']) echo 'selected'; ?> value="<?php echo $value2['id']; ?>"><?php echo $value2['nome']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<input class="form-control" type="text" name="nome" placeholder="Nome" value="<?php echo $value['nome']; ?>" />
		</div>
		<div class="form-group col-md-2">
			<textarea class="form-control" rows="1" name="note" placeholder="Note"><?php echo $value['note']; ?></textarea>
		</div>
		<div class="form-group col-md-2">
			<input name="id_sottocategoria" value="<?php echo $value['id'];?>" hidden />
			<button title="Salva" value="save" name="action" type="submit" class="btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-floppy-disk"></span></button>
			<button title="Elimina" value="delete" name="action" type="submit" class="btn btn-danger"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></button>
		</div>
	</form>
</div>
<?php } ?>
<div class="row">
	<form action="<?php echo site_url("conti/edit_sottocategoria"); ?>" method="POST">
		<div class="form-group col-md-4">
			<select class="form-control" name="id_categoria">
				<?php foreach($categorie as $value2){ ?>
				<option value="<?php echo $value2['id']; ?>"><?php echo $value2['nome']; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-4">
			<input class="form-control" type="text" name="nome" placeholder="Nome" />
		</div>
		<div class="col-md-2">
			<textarea class="form-control" rows="1" name="note" placeholder="Note"></textarea>
		</div>
		<div class="col-md-2">
			<input name="id_sottocategoria" value="-1" hidden />
			<button title="Nuovo" type="submit" class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span></button>
		</div>
	</form>
</div>