<?php /*<div id="sidebar" class="left">
	<div id="breadcrumb">
		<a href="/nieuws" class="first">Nieuws</a>
		<a href="#"><?= $this->pageTitle ?></a> 
	</div>
	
	<?= $asset->image($settings, 'contact_foto', array('class' => 'thumb-sidebar')) ?>
	<p class="sidebar-tekst">
	    <span class="highlight"><?= $settings['contact_naam'] ?></span><br />
	    <?= $settings['contact_adres'] ?>, <?= $settings['contact_postcode'] ?> <?= $settings['contact_gemeente'] ?><br />
        t <?= $settings['contact_tel'] ?>	e  <?= $settings['contact_email'] ?>
    </p>
</div>*/?>

<div class="news">
	<div class="item">	
		<h2><?= $date->formatDate($newsitem['news_date']) ?> - <?= $newsitem['news_title'] ?></h2>
		<div class="image">
			<?= $asset->image($newsitem, 'news_image', array('width' => "200")) ?>
		</div>
		<p><?= nl2br($newsitem['news_text']) ?></p>
	</div>
</div>