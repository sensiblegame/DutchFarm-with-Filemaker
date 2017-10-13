<?php /*<div id="sidebar" class="left">
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/newuser') ?>
	</div>
</div> */?>

<div id="content">
    
	<div class="pd">

        <?= $form->create(false, array('url' => '/newuser', 'class' => 'default')) ?>

                <h2>Account aanmaken</h2>

                <? if (!empty($error)) { ?>
                    <p class="formError"><strong><?= $error ?></strong></p>
                <? } ?>
                
                <div class="input text">
                	<?= $form->label('email', 'Email') ?>
                	<?= $form->text('email') ?>
                </div>
                
                <div class="input text">
                	<?= $form->label('password', 'Wachtwoord') ?>
                	<?= $form->password('password') ?>
                </div>
                
                <div class="input select">
                	<?= $form->label('customer_type', 'Soort Klant') ?>
                	<?= $form->select('customer_type', array('Bedrijf' => 'Bedrijf', 'Particulier' => 'Particulier'), null, array(), null) ?>
                </div>

                
                <div id="bedrijf" class="<?= ($customerType == 'Particulier') ? 'hide' : '' ?> subdiv">
                    <h2>Factuur Adres</h2>

                    <div class="input text">
                    	<?= $form->label('tav', 'T.a.v.') ?>
                    	<?= $form->text('tav') ?>
                    </div>
                    
                    <div class="input text">
                    	<?= $form->label('company', 'Bedrijf') ?>
                    	<?= $form->text('company') ?>
                    </div>
                    
                    <div class="input text">
                    	<?= $form->label('vat', 'BTW nummer') ?>
                    	<?= $form->text('vat') ?>
                    </div>
        		</div>

                <div class="subdiv">
                    
                    <h2>Uw gegevens</h2>
                
                    <div class="input text">
                    	<?= $form->label('name', 'Naam') ?>
                    	<?= $form->text('name') ?>
                    </div>
                    
                    <div class="input text">
                    	<?= $form->label('phone', 'Telefoon') ?>
                    	<?= $form->text('phone') ?>
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
					
                </div>
                
                <div class="subdiv">
                    <h2>Opties</h2>
                    
                    <div class="input checkbox">
                    	<?= $form->checkbox('digitale_factuur_jn') ?>
                    	<?= $form->label('digitale_factuur_jn', 'Ja, ik wil een digitale factuur ontvangen.') ?>	
                    </div>
                    
                    <div class="input checkbox">
                    	<?= $form->checkbox('newsletter') ?>
                    	<?= $form->label('newsletter', 'Ja, ik wil een nieuwsbrief ontvangen') ?>
                    </div>
                    
                    <div class="input checkbox">
                    	<?= $form->checkbox('sms') ?>
                    	<?= $form->label('sms', 'Ja, ik wil de status van mijn bestelling ontvangen via SMS.') ?>
                    </div>
                </div>
    			
                <?= $form->submit('Aanmaken', array('class' => 'button')) ?>

        <?= $form->end() ?>
		
		<div id="content-footer"></div>
		
    </div>
    
</div>