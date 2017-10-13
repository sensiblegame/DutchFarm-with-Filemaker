<?php /*<div id="sidebar" class="left">

	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/user/invoiceaddress') ?>
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
	
	<p class="sidebar-tekst">
	    <span class="highlight">Uw bestelling</span><br/>
	    Aantal item(s): <?= count($_SESSION['Orders']) ?><br/>
	    Totaal: &euro; <?= number_format($_SESSION['prijs_totaal'], 2,',','.'); ?>
    </p>

</div>*/ ?>

<div id="content">
    
	<div class="pd">
        <?= $form->create(false, array('url' => '/user/invoiceaddress', 'class' => 'default')) ?>

                <? if (!empty($error)) { ?>
                    <p class="formError"><strong><?= $error ?></strong></p>
                <? } ?>
                
                <div class="input text">
                	<?= $form->label('name', 'Naam') ?>
                	<?= $form->text('name') ?>
                </div>
                
                <div class="input text">
                	<?= $form->label('contact', 'Contact') ?>
                	<?= $form->text('contact') ?>
                </div>
                
                <div class="input text">
                	<?= $form->label('street', 'Straat') ?>
                	<?= $form->text('street') ?>
                </div>
                
                <div class="input text">
                	<?= $form->label('postal_code', 'Postcode') ?>
                	<?= $form->text('postal_code') ?>
                </div>
                
                <div class="input text">
                	<?= $form->label('city', 'Plaats') ?>
                	<?= $form->text('city') ?>
                </div>
                
                <div class="input select">
                	<?= $form->label('country', 'Land') ?>
					<?= $form->select('country', array('BE' => 'België', 'NL' => 'Nederland', 'FR' => 'Frankrijk', 'DE' => 'Duitsland', 'GB' => 'Groot-Britannië'), null, array(), false) ?>
                </div>
                
                <div class="input text">
                	<?= $form->label('vat', 'BTW nummer') ?>
                	<?= $form->text('vat') ?>
                </div>
    			
				<div class="input submit">
					 <?= $form->submit('Aanmaken', array('class' => 'button', 'div' => false, 'style' => 'float: left; margin-right: 8px;')) ?>
				</div>
				
	          	<div class="input submit">
	          		<?= $form->submit('Annuleer', array('class' => 'button cancel', 'name' => 'button', 'div' => false, 'style' => 'float: left;')) ?>
	          	</div>
                
                <div style="clear: both;"></div>	

        <?= $form->end() ?>
		
		<div id="content-footer"></div>
		
    </div>
    
</div>