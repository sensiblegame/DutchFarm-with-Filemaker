<?php /*<div id="sidebar" class="left">
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/newuser') ?>
	</div>
</div>*/?>

		<?php /*<h1>Profiel Aanpassen</h1>*/?>

        <?= $form->create(false, array('url' => '/profile', 'class' => 'default')) ?>

                <? if (!empty($error)) { ?>
                    <p class="formError"><strong><?= $error ?></strong></p>
                <? } ?>

                <div>
                	<div class="input text">
                		<?= $form->label('email', 'Email') ?>
                		<?= $form->text('email', array('readonly' => 'true')) ?>
                	</div>
                	
                	<div class="input text">
                		<?= $form->label('password', 'Wachtwoord') ?>
                		<?= $form->password('password') ?>
                	</div>
                	
                	<div class="input select">
                		<?= $form->label('customer_type', 'Soort Klant') ?>
                		<?= $form->select('customer_type', array('Bedrijf' => 'Bedrijf', 'Particulier' => 'Particulier'), null, array(), null) ?>
                	</div>
                </div>
                
                <div id="bedrijf" class="<?= ($customerType == 'Particulier') ? 'hide' : '' ?> subdiv">
                    <h2>Factuur Adres</h2>
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
                    <?= $form->checkbox('digitale_factuur_jn', array('class' => 'checkbox')) ?>
                    <?= $form->label('digitale_factuur_jn', 'Ja, ik wil een digitale factuur ontvangen.') ?>
                    <br/>
                    <?= $form->checkbox('newsletter', array('class' => 'checkbox')) ?>
                    <?= $form->label('newsletter', 'Ja, ik wil een nieuwsbrief ontvangen') ?>
                    <br/>
                    <?= $form->checkbox('sms', array('class' => 'checkbox')) ?>
                    <?= $form->label('sms', 'Ja, ik wil de status van mijn bestelling ontvangen via SMS.') ?>
                </div>
    			
                <?= $form->submit('Aanpassen', array('class' => 'button')) ?>

        <?= $form->end() ?>