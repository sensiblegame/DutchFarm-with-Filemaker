<?php 
$country = explode('.', $_SERVER['HTTP_HOST']);
$country = end($country);
if($country == 'nl'){
	$country = 'levering_img_nl';
} else {
	$country = 'levering_img';
} ?>

<? $count = round((count($subclasses) /2)); ?>

<div class="leftColumnProduct">
<ul>
	<? for ($i = 0; $i < $count; $i++) { ?>
		    <li>
			<a href="#" levering_img="<?php echo  $subclasses[$i][$country]; ?>" levering_img_id="<?php echo $subclasses[$i]['MODIF_ID']; ?>" class="subclass clearfix" product_code="<?php echo $subclasses[$i]['RECORD_ID']; ?>" id="<?= $subclasses[$i]['_k1_subclassid'] ?>" delivery="<?= htmlentities(nl2br($subclasses[$i]['levering_css_c'])) ?>" info="<?=htmlentities(nl2br($subclasses[$i]['beschrijving_css_c'])); ?>"><em><?= $subclasses[$i]['grammage'] ?> gr</em> <i class="title"><?= $subclasses[$i]['naam'] ?></i>  <span><?php echo $subclasses[$i]['extra']; ?></span></a>
        </li> 
    <? } ?>
</ul>
</div>
<div class="rightColumnProduct">
<ul>
	<? for ($i = $count; $i < count($subclasses); $i++) { ?>
		<li>
			<a href="#" levering_img="<?php echo  $subclasses[$i][$country]; ?>" levering_img_id="<?php echo $subclasses[$i]['MODIF_ID']; ?>" class="subclass clearfix" product_code="<?php echo $subclasses[$i]['RECORD_ID']; ?>" id="<?= $subclasses[$i]['_k1_subclassid'] ?>" delivery="<?= htmlentities(nl2br($subclasses[$i]['levering_css_c'])) ?>" info="<?=htmlentities(nl2br($subclasses[$i]['beschrijving_css_c'])); ?>"><em><?= $subclasses[$i]['grammage'] ?> gr</em> <i class="title"><?= $subclasses[$i]['naam'] ?></i>  <span><?php echo $subclasses[$i]['extra']; ?></span></a>
        </li>    
    <? } ?>
</ul>
</div>