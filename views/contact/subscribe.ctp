<?php /*<div id="sidebar" class="left">
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/contact/' . $type) ?>
	</div>
</div> */?>

<div id="content">
	<div class="pd">
		
		<? if ($result) { ?>
		    
		    <p>Bedankt!</p>
		    
		<? } else { ?>
		    
		    <? if (!empty($error)) { ?>
                <p class="formError"><strong><?= $error ?></strong></p>
            <? } ?>
		    
    		<form method="post" action="/contact/<?= $type ?>" class="default">
		
    		    <input type="hidden" name="type" value="<?= $type ?>" />
		
        		<div>
                
                    <h2>Klant gegevens</h2>
                
                    <div class="input text">
                    	<label>Voornaam</label>
                    	<input name="name_first" value="<?= $this->params['form']['name_first'] ?>" />
                    </div>
                    
                    <div class="input text">
                    	<label>Achternaam</label>
                    	<input name="name_last" value="<?= $this->params['form']['name_last'] ?>" />
                    </div>
                    
                    <div class="input text">
                    	<label>E-mailadres</label>
                    	<input name="email" value="<?= $this->params['form']['email'] ?>" />
                    </div>
    			
    			    <? if ($type != 'nieuwsbrief') { ?>
    			    
                        <h2>
                            <? if ($type == 'offerte') { ?>
                                Bedrijfsgegevens
                            <? } else { ?>
                                Bezorg Adres
                            <? } ?>
                        </h2>
						
						
						<div class="input text">
							<label>Bedrijfsnaam</label>
							<input name="company_name" value="<?= $this->params['form']['company_name'] ?>" />
						</div>
						
						<div class="input text">
							<label>Adres</label>
							<input name="address" value="<?= $this->params['form']['address'] ?>" />
						</div>
						
						<div class="input text">
							<label>Postcode</label>
							<input name="zipcode" value="<?= $this->params['form']['zipcode'] ?>" />
						</div>
						
						<div class="input text">
							<label>Plaats</label>
							<input name="city" value="<?= $this->params['form']['city'] ?>" />
						</div>
						
						<div class="input text">
							<label>Telefoon</label>
							<input name="phone" value="<?= $this->params['form']['phone'] ?>" />
						</div>
						
						<div class="input text">
							<label>Fax</label>
							<input name="fax" value="<?= $this->params['form']['fax'] ?>" />
						</div>
    			
    			        <? if ($type != 'samplewaaier') { ?>
                          	<div class="input textarea">
                           		<label>Bericht</label></td>
                				<textarea name="message"><?= $this->params['form']['message'] ?></textarea>
                           </div>
            			<? } ?>
                    
                    <? } ?>
					
					<div class="input submit">
    					<input id="verzenden" type="submit" value="Verzenden" />
					</div>
    		    </div>
	
    		</form>

        <? } ?>
		
		<div id="content-footer"></div>				
</div>
</div>