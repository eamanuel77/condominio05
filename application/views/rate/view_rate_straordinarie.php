<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row no-margin">
	<div class="col-sm-12">
		<form class="form-inline" action="<?php echo site_url('rate/edit_scadenza_straordinaria'); ?>" method="POST">
			<div class="form-group">
				<label>Scadenza:</label>
				<input type="text" placeholder="gg/mm/aaaa" class="form-control input-sm input-rata" name="scadenza_straordinaria">
			</div>
			<button type="submit" class="btn btn-default">Salva scadenza</button>
		</form>
		<div class="space"></div>
		<table class="table table-hover table-striped">
			<tr>
				<th>Unit&agrave;</th>
				<th>Persona</th>
				<th>Versato</th>
				<th>Totale spese</th>
				<th>Saldo</th>
			</tr>
			
			<?php
			$totale_spese    = 0;
			$totale_versato = 0;
			$totale_saldi   = 0;
			
			$now = new DateTime("now");
			$scaduto = (date_create($scadenza_rate['scadenza_straordinaria']) < $now);
			
			foreach($rate_straordinarie as $value){
				// sommatoria per il totale_spese
				$saldo = $value['totale_spese']-$value['versato'];
				$totale_spese   += $value['totale_spese'];
				$totale_versato += $value['versato'];
				$totale_saldi   += $saldo;
				?>
				<tr>
					<td><?php echo $value['id_unita']; ?></td>
					<td><?php echo $value['nome_persona']; ?></td>
					<td class="<?php if($scaduto) if($saldo>0) echo 'testo-rosso'; else echo 'testo-verde'; ?>">
						<?php echo $value['versato']; ?>&euro;
					</td>
					<td><?php echo $value['totale_spese']; ?>&euro;</td>
					<td><?php echo $saldo; ?>&euro;</td>
				</tr>
			<?php } ?>
			<tr>
				<td>-</td>
				<td class="testo-grassetto">Totale:</td>
				<td class="testo-grassetto"><?php echo $totale_spese; ?>&euro;</td>
				<td class="testo-grassetto"><?php echo $totale_versato; ?>&euro;</td>
				<td class="testo-grassetto"><?php echo $totale_saldi; ?>&euro;</td>
			</tr>
		</table>
	</div>
</div>

<script type="text/javascript">
	// TODO sanitize script
	<?php $this->load->library('utils'); ?>
	$("[name='scadenza_straordinaria']").val("<?php echo $this->utils->data_sql_to_php($scadenza_rate['scadenza_straordinaria']); ?>");
</script>