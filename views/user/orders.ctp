<?php /*<div id="sidebar" class="left">
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/newuser') ?>
	</div>
</div>*/?>

		
        <? if ($orders !== false) { ?>

        	<table cellspacing="0" cellpadding="0" border="1" class="bestellingen">
        	    
            	<tr>
                        <th width="100">&nbsp;&nbsp;Datum</th>
                	<th width="160" style="text-align:left;">&nbsp;Referentie</th>
                	<th width="150" style="text-align:left;">&nbsp;Prijs</th>
                	<th width="110" style="text-align:left;">&nbsp;Status</th>
                	<th width="100">Leverdatum</th>
            	</tr>
            	<? $i = 0 ?>
        	    <? foreach ($orders as $k => $order) { ?>
                	<tr class="<?= (($i % 2) == 1) ? "odd" : "even" ?>">
                		<td>&nbsp;&nbsp;<?= strftime('%d-%m-%Y', strtotime(empty($order['CreationDate_werkbon']) ? $order['CreationDate'] : $order['CreationDate_werkbon'])) ?></td>
                		<td><a href="/user/order/<?= $order['idOpdracht'] ?>"><?= $order['_idWerkbon'] ?></a></td>
                		<td style="text-align:left;"><?= number_format(floatval(str_replace(',', '.', $order['totaal'])), 2,',','.') ?> €&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                		<td><strong><?= $order['status'] ?></strong></td>
                		<td style="text-align:right;"><?= empty($order['LeverDatum']) ? '--' : strftime('%d-%m-%Y', strtotime($order['LeverDatum'])) ?>&nbsp;&nbsp;</td>
                	</tr>
                	<? $i++ ?>
            	<? } ?>

        	</table>

        <? } else { ?>

            <p>U heeft nog geen bestellingen bij ons geplaatst.</p>

        <? } ?>
