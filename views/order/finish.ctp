<div id="sidebar" class="left">
    
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/order/confirm') ?>
	</div>
	
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
	
</div>

<div id="content" class="left">
    
    <div class="pd">

        <h1>Resultaat van uw betaling</h1>

        <? if ($result == 'cancel') { ?>
            <p>U heeft geannuleerd.</p>
        <? } ?>

        <? if ($result == 'exception' || $result == 'deny') { ?>
            <p>Er was een probleem met uw betaling.</p>
        <? } ?>

    </div>

</div>