<div class="row no-margin">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-6"><h4>Nome</h4></div>
			<div class="col-sm-3"><h4>Preventivo</h4></div>
			<div class="col-sm-3"><h4>Consuntivo</h4></div>
		</div>
		<?php
		$lastIdCategoria = 0;
		$totalePreventivo = 0;
		$totaleConsuntivo = 0;
		foreach($preventivo_consuntivo as $value){
			if($value['id_categoria'] != $lastIdCategoria){
				$lastIdCategoria = $value['id_categoria'];
				?>
				<div class="row"><div class="col-sm-12"><p class="linea"></p></div></div>
				<div class="row">
					<div class="col-sm-12">
						<h4><?php echo $value['nome_categoria']; ?></h4>
					</div>
				</div>
			<?php } ?>
			<div class="row">
				<div class="col-sm-6">
					<?php echo $value['nome_sottocategoria']; ?>
				</div>
				<div class="col-sm-3">
					<?php echo $value['importo_preventivo']; $totalePreventivo+=$value['importo_preventivo']; ?> &euro;
				</div>
				<div class="col-sm-3">
					<?php echo $value['importo_consuntivo']; $totaleConsuntivo+=$value['importo_consuntivo']; ?> &euro;
				</div>
			</div>
		<?php } ?>
		<div class="row"><div class="col-sm-12"><p class="linea"></p></div></div>
		<div class="row">
			<div class="col-sm-6"><h4>Totale</h4></div>
			<div class="col-sm-3"><?php echo $totalePreventivo; ?> &euro;</div>
			<div class="col-sm-3"><?php echo $totaleConsuntivo; ?> &euro;</div>
		</div>
	</div>
</div>