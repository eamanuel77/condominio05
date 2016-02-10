<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-12">
		<form class="form-inline" action="<?php echo site_url('rate/edit_acquedotto'); ?>" method="POST">
			<a href="<?php echo site_url('rate/aggiorna_dati_acquedotto'); ?>">
				<button type="button" class="btn btn-primary">Aggiorna dati</button>
			</a>
			<input name="count_rate_acquedotto" value="<?php echo count($rate_acquedotto); ?>" hidden>
			<button type="submit" class="btn btn-default">Salva rate e scadenze</button>
			<div class="space"></div>
			<table class="table table-hover table-striped">
				<tr>
					<th>Unit&agrave;</th>
					<th>Categoria</th>
					<th>Persona</th>
					<th>Rata 1 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_acquedotto1"></th>
					<th>Rata 2 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_acquedotto2"></th>
					<th>Rata 3 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_acquedotto3"></th>
					<th>Rata 4 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_acquedotto4"></th>
					<th>Totale rate</th>
					<th>Versato</th>
					<th>Saldo</th>
				</tr>
				<?php
				$totale_rate    = 0;
				$totale_versato = 0;
				$totale_saldi   = 0;
				
				foreach($rate_acquedotto as $key=>$value){
					// sommatoria per il totale_rate
					$saldo = $value['totale_rate']-$value['versato'];
					$totale_rate   += $value['totale_rate'];
					$totale_versato += $value['versato'];
					$totale_saldi   += $saldo;
					?>
					<tr>
						<td>
							<input name="id_rata_acquedotto_<?php echo $key; ?>" value="<?php echo $value['id']; ?>" hidden>
							<?php echo $value['id_unita']; ?>
						</td>
						<td><?php echo $value['categoria_acquedotto']; ?></td>
						<td><?php echo $value['nome_persona']; ?></td>
						<td>
							<div class="input-group <?php if($value['stato_pagamento1']=='PAGATO') echo 'has-success'; if($value['stato_pagamento1']=='NON_PAGATO') echo 'has-error'; ?>">
								<input type="text" placeholder="0.00" class="form-control input-sm input-rata" name="rata1_<?php echo $key; ?>" value="<?php echo $value['rata1']; ?>">
								<div class="input-group-addon">&euro;</div>
							</div>
						</td>
						<td>
							<div class="input-group <?php if($value['stato_pagamento2']=='PAGATO') echo 'has-success'; if($value['stato_pagamento2']=='NON_PAGATO') echo 'has-error'; ?>">
								<input type="text" placeholder="0.00" class="form-control input-sm input-rata" name="rata2_<?php echo $key; ?>" value="<?php echo $value['rata2']; ?>">
								<div class="input-group-addon">&euro;</div>
							</div>
						</td>
						<td>
							<div class="input-group <?php if($value['stato_pagamento3']=='PAGATO') echo 'has-success'; if($value['stato_pagamento3']=='NON_PAGATO') echo 'has-error'; ?>">
								<input type="text" placeholder="0.00" class="form-control input-sm input-rata" name="rata3_<?php echo $key; ?>" value="<?php echo $value['rata3']; ?>">
								<div class="input-group-addon">&euro;</div>
							</div>
						</td>
						<td>
							<div class="input-group <?php if($value['stato_pagamento4']=='PAGATO') echo 'has-success'; if($value['stato_pagamento4']=='NON_PAGATO') echo 'has-error'; ?>">
								<input type="text" placeholder="0.00" class="form-control input-sm input-rata" name="rata4_<?php echo $key; ?>" value="<?php echo $value['rata4']; ?>">
								<div class="input-group-addon">&euro;</div>
							</div>
						</td>
						<td><?php echo $value['totale_rate']; ?>&euro;</td>
						<td><?php echo $value['versato']; ?>&euro;</td>
						<td><?php echo $saldo; ?>&euro;</td>
					</tr>
				<?php } ?>
				<tr>
					<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
					<td class="testo-grassetto">Totale:</td>
					<td class="testo-grassetto"><?php echo $totale_rate; ?>&euro;</td>
					<td class="testo-grassetto"><?php echo $totale_versato; ?>&euro;</td>
					<td class="testo-grassetto"><?php echo $totale_saldi; ?>&euro;</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type="text/javascript">
	// TODO sanitize script
	<?php $this->load->library('utils'); ?>
	$("[name='scadenza_acquedotto1']").val("<?php echo $this->utils->data_sql_to_php($scadenza_rate['scadenza_acquedotto1']); ?>");
	$("[name='scadenza_acquedotto2']").val("<?php echo $this->utils->data_sql_to_php($scadenza_rate['scadenza_acquedotto2']); ?>");
	$("[name='scadenza_acquedotto3']").val("<?php echo $this->utils->data_sql_to_php($scadenza_rate['scadenza_acquedotto3']); ?>");
	$("[name='scadenza_acquedotto4']").val("<?php echo $this->utils->data_sql_to_php($scadenza_rate['scadenza_acquedotto4']); ?>");
</script>