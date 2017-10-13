<?php /*<div id="sidebar" class="left">

	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/order/done') ?>
	</div>

    <? if ($user->isLoggedIn()) { ?>
    	<p class="sidebar-tekst">
    	    <span class="highlight">U bent ingelogd als</span><br/>
            <? if (!empty($customer['Contactpersoon'])) { ?>
                <?= $customer['Contactpersoon'] ?><br/>
            <? } ?>
            <?= $customer['Klant'] ?><br/>
            <?= $customer['adres'] ?><br/>
            <?= $customer['code'] ?> <?= $customer['plaats'] ?>
            <br/><br/>
            <?= $customer['email'] ?><br/>
            <?= $customer['tel'] ?>
        </p>
    <? } ?>

</div>*/?>

<div id="content">

    <div class="pd">

        <h1><?= $this->pageTitle ?></h1>

        <p>Bestelnr.: <?= $bestelling ?></p>
		<p>U ontvangt een bevestigingsmail met daarin het overzicht van uw bestelde producten.</p>

		<div id="content-footer"></div>

    </div>
    
</div>

<!-- Google Code for Verkoop Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1035111296;
var google_conversion_language = "nl";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "vX4BCOqmlAIQgJfK7QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1035111296/?label=vX4BCOqmlAIQgJfK7QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>