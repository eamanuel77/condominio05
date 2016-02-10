<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-12">
		<form action="<?php echo site_url('rate/edit_scadenze_ordinarie'); ?>" method="POST">
			<a href="<?php echo site_url('rate/aggiorna_dati_ordinari'); ?>">
				<button type="button" class="btn btn-primary">Aggiorna dati</button>
			</a>
			<button type="submit" class="btn btn-default">Salva scadenze</button>
			<div class="space"></div>
			<table class="table table-hover table-striped">
				<tr>
					<th>Unit&agrave;</th>
					<th>Persona</th>
					<th>Rata 1 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata1"></th>
					<th>Rata 2 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata2"></th>
					<th>Rata 3 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata3"></th>
					<th>Rata 4 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata4"></th>
					<th>Rata 5 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata5"></th>
					<th>Rata 6 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata6"></th>
					<th>Rata 7 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata7"></th>
					<th>Rata 8 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata8"></th>
					<th>Rata 9 <br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata9"></th>
					<th>Rata 10<br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata10"></th>
					<th>Rata 11<br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata11"></th>
					<th>Rata 12<br/><input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_rata12"></th>
					<th>Totale rate</th>
					<th>Versato</th>
					<th>Saldo</th>
				</tr>
				
				<?php
				$totale_rate = 0;
				$totale_versato = 0;
				$totale_saldi = 0;
				foreach($rate as $value){
					// arrotondamento
					$value['totale_rate'] = ceil($value['totale_rate'] * 100) / 100;
					$value['totale_versato'] = ceil($value['totale_versato'] * 100) / 100;
					$value['saldo'] = ceil($value['saldo'] * 100) / 100;
					// sommatoria per il totale
					$totale_rate += $value['totale_rate'];
					$totale_versato += $value['totale_versato'];
					$totale_saldi += $value['saldo'];
					?>
					<tr>
						<td><?php echo $value['id_unita']; ?></td>
						<td><?php echo $value['nome_persona']; ?></td>
						
						<!------------ RATE ------------>
						<td class="<?php if($value['stato_pagamento1' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento1' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata1' ]==0) echo '-'; else echo $value['rata1' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento2' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento2' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata2' ]==0) echo '-'; else echo $value['rata2' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento3' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento3' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata3' ]==0) echo '-'; else echo $value['rata3' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento4' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento4' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata4' ]==0) echo '-'; else echo $value['rata4' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento5' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento5' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata5' ]==0) echo '-'; else echo $value['rata5' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento6' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento6' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata6' ]==0) echo '-'; else echo $value['rata6' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento7' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento7' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata7' ]==0) echo '-'; else echo $value['rata7' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento8' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento8' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata8' ]==0) echo '-'; else echo $value['rata8' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento9' ]=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento9' ]=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata9' ]==0) echo '-'; else echo $value['rata9' ].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento10']=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento10']=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata10']==0) echo '-'; else echo $value['rata10'].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento11']=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento11']=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata11']==0) echo '-'; else echo $value['rata11'].'&euro;'; ?>
						</td>
						<td class="<?php if($value['stato_pagamento12']=='PAGATO') echo 'testo-verde'; if($value['stato_pagamento12']=='NON_PAGATO') echo 'testo-rosso'; ?>">
							<?php if($value['rata12']==0) echo '-'; else echo $value['rata12'].'&euro;'; ?>
						</td>
						
						<td><?php echo $value['totale_rate']; ?>&euro;</td>
						<td><?php echo $value['totale_versato']; ?>&euro;</td>
						<td><?php echo $value['saldo']; ?>&euro;</td>
					</tr>
				<?php } ?>
				<tr>
					<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
					<td class="testo-grassetto">Totale:</td><td class="testo-grassetto"><?php echo $totale_rate; ?>&euro;</td><td class="testo-grassetto"><?php echo $totale_versato; ?>&euro;</td><td class="testo-grassetto"><?php echo $totale_saldi; ?>&euro;</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type="text/javascript">
	// TODO sanitize script
	<?php
	$this->load->library('utils');
	foreach($scadenza_rate as $key => $value){ 
		if(strpos($key, 'scadenza_rata') !== false && $value != ''){
	?>
			$("[name='<?php echo $key; ?>']").val("<?php echo $this->utils->data_sql_to_php($value); ?>");
	<?php 
		} 
	} 
	?>
</script>