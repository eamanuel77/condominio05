<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-md-5">
		<?php
			$totalePreventivo = 0;
			if(count($preventivi) > 0){ ?>
			<div class="row">
				<div class="col-md-12"><h4><?php echo $preventivi[0]['nome_categoria']; ?></h4></div>
			</div>
			<ul class="nav nav-pills nav-stacked">
			<?php
			$idCategoria = $preventivi[0]['id_categoria'];
			for($i = 0; $i < count($preventivi); $i++){
				if($idCategoria != $preventivi[$i]['id_categoria']){
					$idCategoria = $preventivi[$i]['id_categoria'];
					?>
					</ul>
					<div class="row">
						<div class="col-md-12"><h4><?php echo $preventivi[$i]['nome_categoria']; ?></h4></div>
					</div>
					<ul class="nav nav-pills nav-stacked">
				<?php } ?>
				<li <?php if($preventivi[$i]['id'] == $id_preventivo) echo 'class="active"'?>>
				<a href="<?php echo site_url('conti/preventivi/'.$preventivi[$i]['id']); ?>">
					<span><?php echo $preventivi[$i]['nome']; ?></span>
					<span class="pull-right"><?php echo $preventivi[$i]['importo']; $totalePreventivo+=$preventivi[$i]['importo'];?> &euro;</span>
				</a>
				</li>
			<?php } ?>
			</ul>
		<?php } ?>
		<div class="row"><div class="col-sm-12"><p class="linea"></p></div></div>
		<div class="row">
			<div class="col-md-8"><p>Totale</p></div><div class="col-sm-4"><span class="pull-right"><?php echo $totalePreventivo; ?> &euro;</span></div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-heading">Dati preventivo</div>
			<div class="panel-body">
				<form action="<?php echo site_url('conti/edit_preventivo');?>" method="POST">
					<div class="row">
						<div class="form-group col-md-12">
							<label>Importo</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="0.00" name="importo" />
								<div class="input-group-addon">&euro;</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label>Tabella</label>
							<select class="form-control" name="id_tabella">
								<?php foreach($tabelle as $value){ ?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label>Fornitore</label>
							<select class="form-control" name="id_fornitore">
								<?php foreach($fornitori as $value){ ?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label>Note</label>
							<textarea class="form-control" rows="1" name="note" placeholder="Note"></textarea>
						</div>
					</div>
					<input value="<?php echo $id_preventivo; ?>" name="id_preventivo" hidden />
					<button name="action" value="save" type="submit" class="btn btn-default">Salva</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// TODO sanitize script
	<?php foreach($preventivo as $key => $value){ ?>
		$("[name='<?php echo $key; ?>']").val("<?php echo $value; ?>");
	<?php } ?>
</script>