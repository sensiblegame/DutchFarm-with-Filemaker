    	
    	<table cellspacing="0" cellpadding="0" border="1" class="mijnBestellingTop">
        	<tr style="background: #000;">
        		<th class="top" width="100%" colspan="4">Opdracht <?= $order['_idWerkbon'] ?></th>
        	</tr>    
        	<tr>
                <th width="50">ID</th>
            	<th width="350" style="text-align:left;">&nbsp;Omschrijving</th>
            	<th width="40">Aantal</th>
            	<th width="40">&nbsp;&nbsp;Bedrag</th>
        	</tr>
        	<? $i = 0 ?>
        	<? foreach ($orderLines as $orderLine) { ?>
	        	<tr class="<?= (($i % 2) == 1) ? "odd" : "even" ?>">
	                <td width="40"><?= $orderLine['RECORD_ID'] ?></td>
	            	<td width="320"><?= $orderLine['Fullartikel'] ?></td>
	            	<td width="30" style="text-align:right;"><?= $orderLine['aantal'] ?></td>
	            	<td width="60" style="text-align:right;"><?= $generic->formatCurrency($orderLine['prijs_met_afwerking']) ?></td>
	        	</tr>
	        	<tr class="last <?= (($i % 2) == 1) ? "odd" : "even" ?>">
	                <td width="40"></td>
	            	<td width="280"><?= $orderLine['benoem'] ?></td>
	            	<td colspan="2" width="150" style="text-align:right;">Status: <?= $orderLine['Status'] ?></td>
	        	</tr>
	        	<? $i++ ?>
	        <? } ?>
        

    	</table>
    	
		<table width="600" cellspacing="0" cellpadding="0" border="1" class="mijnBestelling">
            <tr>
                <td width="480" style="border-top: 1px solid #EC008C;">Prijs</td>
                <td width="100" style="text-align:right;border-top: 1px solid #EC008C;"><?= $generic->formatCurrency($order['sub_products']) ?></td>
            </tr>
            <tr>
                <td width="480" style="border-top: 1px solid #EC008C;">Promo</td>
                <td width="100"  style="text-align:right;border-top: 1px solid #EC008C;"><?= $generic->formatCurrency($order['promo_calc']) ?></td>
            </tr>
            <tr>
                <td width="480" style="border-top: 1px solid #EC008C;">Levering</td>
                <td width="100" style="text-align:right;border-top: 1px solid #EC008C;"><?= $generic->formatCurrency($order['levering']) ?></td>
            </tr>
            <tr>
                <td width="480" style="border-top: 1px solid #EC008C;">Extra Kosten</td>
                <td width="100" style="text-align:right;border-top: 1px solid #EC008C;"><?= $generic->formatCurrency($order['extra_kosten']) ?></td>
            </tr>
            <tr>
                <td width="480" style="border-top: 1px solid #EC008C;">BTW <?= $order['BTW'] ?> %</td>
                <td width="100" style="text-align:right;border-top: 1px solid #EC008C;"><?= $generic->formatCurrency($order['subBTW']) ?></td>
            </tr>
            <tr>
                <td width="480" style="border-top: 1px solid #EC008C;" class="highlight">Totaal</td>
                <td width="100" style="text-align:right;border-top: 1px solid #EC008C;" class="highlight"><?= $generic->formatCurrency($order['totaal']) ?></td>
            </tr>
    	</table>
    	
		<table cellspacing="0" cellpadding="0" border="1" class="mijnBestellingFooter">
            <tr>
                <td width="100">Leverdatum</td>
                <td width="480"><?= empty($order['LeverDatum']) ? '-' : $order['LeverDatum'] ?></td>
            </tr>
            <tr>
                <td width="100">Status</td>
                <td width="480"><strong><?= $order['status'] ?></strong></td>
            </tr>
    	</table>
		
