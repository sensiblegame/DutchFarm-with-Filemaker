<div id="sidebar" class="left">

	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/user/deliveryaddress') ?>
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

</div>

<div id="content" class="left">
    
	<div class="pd">

		<h1><?= $this->pageTitle ?></h1>

        <?= $form->create(false, array('url' => '/user/deliveryaddress', 'class' => 'form')) ?>

                <? if (!empty($error)) { ?>
                    <p class="formError"><strong><?= $error ?></strong></p>
                <? } ?>

                <div>
                    <table cellspacing="0" cellpadding="0" border="0" width="400">
                        <tr>
                            <td style="width:150px;"><?= $form->label('name', 'Naam') ?></td>
                            <td style="width:250px;"><?= $form->text('name') ?></td>
            			</tr>
                        <tr>
                            <td><?= $form->label('contact', 'Contact') ?></td>
                            <td><?= $form->text('contact') ?></td>
            			</tr>
                        <tr>
                            <td><?= $form->label('phone', 'Telefoon') ?></td>
                            <td><?= $form->text('phone') ?></td>
            			</tr>
                        <tr>
                            <td><?= $form->label('street', 'Straat') ?></td>
                            <td><?= $form->text('street') ?></td>
            			</tr>
                        <tr>
                            <td><?= $form->label('postal_code', 'Postcode') ?></td>
                            <td><?= $form->text('postal_code') ?></td>
            			</tr>
                        <tr>
                            <td><?= $form->label('city', 'Plaats') ?></td>
                            <td><?= $form->text('city') ?></td>
            			</tr>
                        <tr>
                            <td><?= $form->label('country', 'Land') ?></td>
                            <td><?= $form->select('country', array('BE' => 'België', 'NL' => 'Nederland', 'FR' => 'Frankrijk', 'DE' => 'Duitsland', 'GB' => 'Groot-Britannië'), null, array(), false) ?></td>
            			</tr>
        			</table>

                </div>
    			
    			<div>
                    <?= $form->submit('Aanmaken', array('class' => 'button', 'div' => false, 'style' => 'float: left; margin-right: 8px;')) ?>
                    <?= $form->submit('Annuleer', array('class' => 'button cancel', 'name' => 'button', 'div' => false, 'style' => 'float: left;')) ?>
                </div>
                
                <div style="clear: both;"></div>	

        <?= $form->end() ?>
		
		<div id="content-footer"></div>
		
    </div>
    
</div>