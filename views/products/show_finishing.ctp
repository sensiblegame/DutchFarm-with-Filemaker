<? $count = round((count($finishing) /2)); ?>

<div class="leftColumnProduct">
<ul>
	<? for ($i = 0; $i < $count; $i++) { ?>
		<li>
			<a href="#" id="<?= $finishing[$i]['_k1_afwerkingid'] ?>" class="finishing open-naming" price="<?= $finishing[$i]['prijs'] ?>" group="<?= $finishing[$i]['groep'] ?>" info="<?= addslashes(nl2br($finishing[$i]['info'])) ?>" titleInfo="<?= addslashes(nl2br($finishing[$i]['naam'])) ?>"><?= $finishing[$i]['naam'] ?><span><?= $generic->formatCurrency($finishing[$i]['prijs']) ?></span></a>
		</li>    
    <? } ?>
</ul>
</div>
<div class="rightColumnProduct">
<ul>
	<? for ($i = $count; $i < count($finishing); $i++) { ?>
		   <li>
			<a href="#" id="<?= $finishing[$i]['_k1_afwerkingid'] ?>" class="finishing open-naming" price="<?= $finishing[$i]['prijs'] ?>" group="<?= $finishing[$i]['groep'] ?>" info="<?= addslashes(nl2br($finishing[$i]['info'])) ?>" titleInfo="<?= addslashes(nl2br($finishing[$i]['naam'])) ?>"><?= $finishing[$i]['naam'] ?><span><?= $generic->formatCurrency($finishing[$i]['prijs']) ?></span></a>
		</li> 
    <? } ?>
</ul>
</div>
