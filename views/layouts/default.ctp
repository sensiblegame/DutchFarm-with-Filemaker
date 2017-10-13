<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?= $html->charset() ?>
	
	<title><?= $title_for_layout ?> - Postfly</title>
	
	<?= $html->meta('icon') ?>
	<?= $html->css('reset') ?>
	<?= $html->css('init') ?>
	<?= $html->css('woosh') ?>
	<?= $html->css('jScrollPane') ?>
	<?= $html->css('default') ?>
	
	<?= $scripts_for_layout ?>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script src="/js/jquery.jcarousel.min.js"></script>
	<?= $javascript->link('modernizr-1.7.min.js') ?>
	<?= $javascript->link('scrollPane') ?>
	<?= $javascript->link('mousewheel') ?>
	<?= $javascript->link('movebanners'); ?>
	<?= $javascript->link('shop'); ?>
	<script src="/js/main.js"></script>

    <!--[if IE 7]>
        <style>
            .arrow-col4 { display: none; }
        </style>
    <![endif]-->

</head>

<body id="<? if(isset($page)){ echo $page; } ?>"<?php if ($landingItem) { ?> class="landing"<?php } ?>>
	<header>
		<div class="container clearfix">
			<!-- logo -->
			<a href="/" class="logo"><img src="/img/postfly.gif" alt="Postfly" /></a>
			
			<!-- main navigation -->
			<nav class="main">
			        <ul class="clearfix">
			        	<? foreach ($pages as $groupName => $groupPages) { ?>
				            <li><a href="<?php echo (empty($groupPages[0]['page_url']))?'/p/'.$groupPages[0]['page_slug']:$groupPages[0]['page_url']; ?>"><?= $groupName ?></a>
				            <? if (count($groupPages) > 0) { ?>
				                <ul class="sub">
				                    <? foreach ($groupPages as $tmppage) { ?>
				                        <? if (empty($tmppage['page_url'])) { ?>
				                            <li><a href="/p/<?= $tmppage['page_slug'] ?>"><?= $tmppage['page_title'] ?></a></li>
				                        <? } else { ?>
				                            <li><a href="<?= $tmppage['page_url'] ?>"><?= $tmppage['page_title'] ?></a></li>
				                        <? } ?>
				                    <? } ?>
				                </ul>
				            <? } ?>
				            </li>
			            <? } ?>
			        </ul>
			</nav>
			<!-- /main navigation -->
		</div>
	</header>
	
	<div class="page clearfix">
		<!-- product navigation -->
		<nav class="products">
			<?php foreach ($groupedClasses as $group => $classes) { ?>
				<h1><?= $group ?></h1>
				<hr />
				<ul>
					<?php foreach ($classes as $i => $tmpClass) { ?>							
								
							<?php if($tmpClass['_k1_classid'] == '31') { ?>
								<li class="<?php if ($class['slug'] == $tmpClass['slug']) echo ' active'; ?>"><a href="<?=Router::url(array('controller' => 'products', 'action' => 'showClassBanner', 'slug' => $tmpClass['slug'])); ?>"><?= $tmpClass['naam'] ?><?= empty($tmpClass['naam_extra']) ? '' : ' <span>' . $tmpClass['naam_extra'] . '</span>' ?></a></li>	
							<?php } else { ?>
								<li class="<?php if ($class['slug'] == $tmpClass['slug']) echo ' active'; ?>"><a href="<?=Router::url(array('controller' => 'products', 'action' => 'showClass', 'slug' => $tmpClass['slug'])); ?>"><?= $tmpClass['naam'] ?><?= empty($tmpClass['naam_extra']) ? '' : ' <span>' . $tmpClass['naam_extra'] . '</span>' ?></a></li>	
							<?php } ?>
					<?php } ?>
				</ul>
			<? } ?>
		</nav>
		<!-- /product navigation -->
		<section class="content">
			<!-- eyecatcher -->
			<?php if ($class) { ?>
				<?php if ($page == 'undefined') { // 2017-03-24 - KVDB - ER STOND products en dit is gewijzigd ?>
						<div class="eyecatcher" style="display:none">
				<?php } else { ?>
					<div class="eyecatcher" style="background:url('<?= $asset->bgimage($class, 'banner'); ?>')">
				<?php } ?>			
			<?php } else { ?>
			
				<?php if ($page == 'home') { ?>
						<a href="/contact/us"><div class="eyecatcher" style="background:url('<?= $asset->bgimage($settings, 'homepage_image6_data'); ?>');">
				<?php } else { // not homepage ?>
					<?php ?><div class="eyecatcher" style="background:url('<?= $asset->bgimage($header, 'header'); ?>')">
				<?php } ?>
				
			<?php } ?>
			
				
				<h1<?php if($noTitle || $page == 'home'){?> style="display:none"<?php }?>><strong><?= $this->pageTitle ?></strong><?=$page; ?></h1>
				
			</div>
			<?php if ($page == 'home') { ?>
			</a>
			<?php } ?>
			<!-- /eyecatcher -->
			<?php if ($page == 'home' || $noTitle || $page == 'cart') { ?>
				<?php if(!$noService){?> 
				<h2><span><strong>Snel bestel</strong> service</span></h2>
				<?php }?>
				<!-- tooltip -->
				<?php if ($page != 'products') { ?>
					<div class="tooltip">
						<div class="innerbox">
							- Welkom bij de Postfly <strong>Snel bestel</strong> service.
						</div>
						<img class="tip" src="/img/ico-tooltip.png" alt=""/>
					</div>
				<?php } ?>
				<!-- /tooltip -->
			<?php } ?>

			<?php $session->flash(); ?>
        	<?= $content_for_layout; ?>
        	<?= $cakeDebug; ?>
		</section>
		
		<!-- sidebar -->
		<?php echo $this->renderElement('front/sidebar');?>
		<!-- sidebar -->
	</div>
	
	<footer>
		
	</footer>
	
	<div id="lightsout"></div>
	
	<div id="dialogs">
		<div class="warning">
			<h1><?=__('U heeft nog geen bestanden opgeladen');?></h1>
			<p><?=__('Weet u zeker dat u wilt doorgaan');?></p>
			<a href="" class="yes"><?=__('Doorgaan');?></a>
			<a href="" class="no"><?=__('Annuleren');?></a>
			<a href="" class="close">Sluiten</a>
		</div>
	</div>

	<?= $settings['analytics'] ?>
    
	<!--[if lt IE 7 ]>
	<script src="/js/pngfix.js"></script>
	<script src="/js/pngfix-config.js"></script>
	<![endif]-->
	
	<script type="text/javascript"> 
	    var $buoop = {} 
	    $buoop.ol = window.onload; 
	    window.onload=function(){ 
	        if ($buoop.ol) $buoop.ol(); 
	        var e = document.createElement("script"); 
	        e.setAttribute("type", "text/javascript"); 
	        e.setAttribute("src", "http://browser-update.org/update.js"); 
	        document.body.appendChild(e); 
	    } 
	</script> 
</body>
</html>