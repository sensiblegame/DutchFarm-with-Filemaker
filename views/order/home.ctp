<!-- promotions -->
<div class="promotions">
	<?php /* images : <?= $asset->image($settings, 'homepage_image1_data', array('alt' => $settings['homepage_image1_text'])) ??> */?>
	<?php //Waar komen de links en span teksten vandaan??>
	<a href="<?= $settings['homepage_image1_url'] ?>" class="promo" style="background:url('<?= $asset->bgimage($settings, 'homepage_image1_data'); ?>');">
		<h3><?= $settings['homepage_image1_title'] ?></h3>
		<span><?= $settings['homepage_image1_text'] ?></span>
	</a>
	
	<div class="cols percentage clearfix">
		<div class="first col">
			<a href="<?= $settings['homepage_image2_url'] ?>" class="promo" style="background:url('<?= $asset->bgimage($settings, 'homepage_image2_data'); ?>');">
				<h3><?= $settings['homepage_image2_title'] ?></h3>
				<span><?= $settings['homepage_image2_text'] ?></span>
			</a>
		</div>
		<div class="col">
			<a href="<?= $settings['homepage_image3_url'] ?>" class="promo" style="background:url('<?= $asset->bgimage($settings, 'homepage_image3_data'); ?>');">
				<h3><?= $settings['homepage_image3_title'] ?></h3>
				<span><?= $settings['homepage_image3_text'] ?></span>
			</a>
		</div>
	</div>
	
	<a href="<?= $settings['homepage_image4_url'] ?>" class="promo" style="background:url('<?= $asset->bgimage($settings, 'homepage_image4_data'); ?>');">
		<h3><?= $settings['homepage_image4_title'] ?></h3>
		<span><?= $settings['homepage_image4_text'] ?></span>
	</a>
	
	<a href="<?= $settings['homepage_image5_url'] ?>" class="promo small-wide" style="background:url('<?= $asset->bgimage($settings, 'homepage_image5_data'); ?>');">
		<h3><?= $settings['homepage_image5_title'] ?></h3>
		<span><?= $settings['homepage_image5_text'] ?></span>
	</a>
	
</div>
<!-- promotions -->