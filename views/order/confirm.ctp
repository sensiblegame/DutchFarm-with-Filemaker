<?php /*<div id="sidebar" class="left">
    
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/order/confirm') ?>
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
	
	<? if (!empty($settings['icoontjes_betaling'])) { ?>
	    <p><?= $asset->image($settings, 'icoontjes_betaling', array('class' => 'thumb-sidebar')) ?></p>
	<? } ?>
	
</div>*/?>

<div id="content">
    
    <div class="pd">

        <?= $form->create(false, array('type' => 'post', 'url' => '/order/create', 'class' => 'default')) ?>
    
            <h2>Levering</h2>
    
            <div class="input select">
            	<select name="delivery_method" id="delivery_method">
	                <option value="">-- Selecteer hier--</option>
	                <option value="afhalen">Afhalen (<?= empty($settings['prijs_afhaling']) ? 'gratis' : '€ ' . $settings['prijs_afhaling'] . ' kosten' ?>)</option>
	                <option value="levering" <?= empty($deliveryId) ? '': 'selected' ?>>Levering (<?= empty($settings['prijs_levering']) ? 'gratis' : '€ ' . $settings['prijs_levering'] . ' kosten' ?>)</option>
            	</select>
            </div>
    
            <div id="confirm_delivery_afhalen" class="hide">
        
                <table width="100%" cellspacing="0" border="0">
                <tr>
                    <td width="50%">
                        <p><?= $settings['contact_naam'] ?><br />
        		        <?= $settings['contact_adres'] ?>, <?= $settings['contact_postcode'] ?> <?= $settings['contact_gemeente'] ?><br />
                        t <?= $settings['contact_tel'] ?>	e  <?= $settings['contact_email'] ?></p>
                    </td>
                    <td width="50%">
                        <p><?= nl2br($settings['contact_openingsuren']) ?></p>
                    </td>
                </tr>
                </table>

            </div>

            <div id="confirm_delivery_levering" class="hide">
	    
				<div class="input select">
					<label>Selecteer het leveradres</label>
					 <select name="deliveryId" id="confirm_delivery_address" style="width: 400px; display: inline;">
        		        <? if ($deliveryAddresses) { ?>
        		            <? foreach ($deliveryAddresses as $address) { ?>
        		                <option value="<?= $address['idLevering'] ?>" <?= ($deliveryId == $address['idLevering']) ? 'selected' : '' ?>><?= $address['lever_klant'] ?>, <?= $address['lever_adres'] ?>, <?= $address['lever_postcode'] ?> <?= $address['lever_plaats'] ?></option>
        		            <? } ?>
        		        <? } ?>
        		    </select>
        		   
				</div>	    
    		  <p><?= $html->link('Ander leveradres', '/user/deliveryaddress', array('class' => 'highlight')) ?></p>
	    
            </div>
    		
    		<div id="confirm_neutraal_verpakt" class="<?= empty($deliveryId) ? 'hide': '' ?>">
                
                <div class="input checkbox">
                	<label><?= $form->checkbox('neutraal_verpakt', array('class' => 'checkbox')) ?>
</label>
				<?= $form->label('neutraal_verpakt', 'Neutraal verpakt', array('style' => 'color: black;')) ?>
                </div>
            </div>

            <div id="confirm_delivery_invoice" class="<?= empty($deliveryId) ? 'hide': '' ?>">
	    		<h2>Facturatie</h2>
    		    <div class="input select">
    		    	<label>Selecteer het facturatieadres</label>
	    			<select name="invoiceId" id="confirm_invoice_address" style="width: 400px; display: inline;">
        		        <? if ($invoiceAddresses) { ?>
        		            <? foreach ($invoiceAddresses as $address) { ?>
        		                <option value="<?= $address['idFactadres'] ?>" <?= ($invoiceId == $address['idFactadres']) ? 'selected' : '' ?>><?= $address['Klant'] ?>, <?= $address['adres'] ?>, <?= $address['postcode'] ?> <?= $address['plaats'] ?></option>
        		            <? } ?>
        		        <? } ?>
        		    </select>
        		 </div>
        		 <?= $html->link('Ander facturatieadres', '/user/invoiceaddress', array('class' => 'highlight')) ?>
            </div>
    
            <div id="confirm_payment" class="<?= empty($deliveryId) ? 'hide': '' ?>">
                
                <h2>Betaling</h2>
    			
    			<div class="input select">
    				<label style="width:250px;">Selecteer hoe u uw bestelling wil betalen:</label>
    				<select name="betalingType" id="confirm_payment_type">
	                    <option value="">-- selecteer hier--</option>
	        	        <option id="confirm_payment_type_online" value="Online">Online<?= empty($settings['prijs_online_betaling']) ? '' : ' (€ ' . $settings['prijs_online_betaling'] . ' kosten)' ?></option>
	        	        <? if ($customer['factuur_jn'] == 'ja') { ?>
	        	            <option id="confirm_payment_type_factuur" value="Factuur">Factuur</option>
	            	        <? if ($customer['wekelijkse_factuur_jn'] == 'ja') { ?>
	            	            <option id="confirm_payment_type_factuur_wekelijks" value="WekelijkseFactuur">Wekelijkse Factuur</option>
	            	        <? } ?>
	        	        <? } ?>
	        	        <? if ($customer['rembours_jn'] == 'ja') { ?>
	        	            <option id="confirm_payment_type_rembours" value="Rembours">Onder Rembours<?= empty($priceRembours) ? '' : ' (€ ' . $priceRembours . ' kosten)' ?></option>
	        	        <? } ?>
	        	        <option id="confirm_payment_type_contant" value="Contant">Contant bij afhalen</option>
	        	    </select>
    			</div>
        
                <div id="confirm_i_agree">
                    <p style="margin:0"><?= $form->checkbox('i_agree', array('class' => 'checkbox')) ?>
                    <?= $form->label('i_agree', 'Ja, ik ga akkoord met de <a href="' . $asset->url($settings, 'voorwaarden', false, 'postfly_verkoopsvoorwaarden.pdf') . '" target="_blank">verkoopsvoorwaarden</a>.') ?></p>
                </div>
        
        	    <div id="confirm_payment_ogone" class="hide">
                    <?= $form->hidden('type', array('value' => 'ogone')) ?>
                    <?= $form->submit('Online betalen', array('class' => 'button checkIAgree', 'style' => 'width: 200px;')) ?>
                    &nbsp;
        	    </div>

        	    <div id="confirm_upload_files" class="hide">
                    <?= $form->hidden('type', array('value' => 'ogone')) ?>
                    <?= $form->submit('Bevestig', array('class' => 'button checkIAgree', 'style' => 'width: 200px;')) ?>
                    &nbsp;
        	    </div>

            </div>

        <?= $form->end() ?>

		<div id="content-footer"></div>

    </div>

</div>