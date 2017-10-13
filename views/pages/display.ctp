<?php/* <div id="sidebar" class="left">
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/p/' . $pageitem['page_slug']) ?>
	</div>
	<img src="../img/aanleveren.jpg" class="thumb-sidebar" alt="Aanleveren drukwerk" />
</div>*/?>

<div class="content">
    <?php /*<h1><?= $this->pageTitle ?></h1> */?>
    <?= $pageitem['page_contents'] ?>
</div>