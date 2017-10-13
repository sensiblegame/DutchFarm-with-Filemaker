<?php/*<div id="sidebar" class="left">
	<div id="breadcrumb">
		<a href="#" class="first">Home</a>
		<a href="#">Nieuws</a> 
	</div>
	
	<?= $asset->image($settings, 'contact_foto', array('class' => 'thumb-sidebar')) ?>
	<p class="sidebar-tekst">
	    <span class="highlight"><?= $settings['contact_naam'] ?></span><br />
	    <?= $settings['contact_adres'] ?>, <?= $settings['contact_postcode'] ?> <?= $settings['contact_gemeente'] ?><br />
        t <?= $settings['contact_tel'] ?>	e  <?= $settings['contact_email'] ?>
    </p>
</div>*/?>

<div class="news">
	<?php/*<h1>Nieuws</h1>*/?>
	<? if ($news == false) { ?>
	    <p>Er werden geen nieuwsberichten gevonden...</p>
	<? } else { ?>
	    <? foreach ($news as $newsitem) { ?>
			<div class="item">
			    <a href="/nieuws/<?= $newsitem['news_slug_aec'] ?>"><?= $date->formatDate($newsitem['news_date']) ?> - <?= $newsitem['news_title'] ?></a>		    
			    <? if (!empty($newsitem['news_image'])) { ?>
			       <div class="image">
				   <a href="/nieuws/<?= $newsitem['news_slug_aec'] ?>"><?= $asset->image($newsitem, 'news_image', array('width' => "400")) ?></a>
				   </div>
				<? } ?>
	
			   <p><?= nl2br($newsitem['news_intro']) ?></p>
			</p>
			</div>
	    <? } ?>
	<? } ?>
</div>