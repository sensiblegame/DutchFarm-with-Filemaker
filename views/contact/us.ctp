<?php /*<div id="sidebar" class="left">
    
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/contact/us') ?>
	</div>
	<?= $asset->image($settings, 'contact_foto', array('class' => 'thumb-sidebar', 'alt' => 'Ons kantoor')) ?>
	
	<p class="sidebar-tekst">
	    Openingstijden:<br/>
	    <?= nl2br($settings['contact_openingsuren']) ?>
	</p>

	<a href="<?= $asset->url($settings, 'contact_plan_pdf', false, 'postfly_contact_plan.pdf') ?>" title="Klik op de plattegrond" target="_blank"><?= $asset->image($settings, 'contact_plan_img', array('class' => 'thumb-sidebar')) ?></a>
	<p class="sidebar-tekst">Klik op de plattegrond voor een vergroting.</p>
	
</div>*/?>
	

		<?php /*<h1><?= $this->pageTitle ?></h1>*/?>
	
		<? if ($result) { ?>
		    
		    <p>Bedankt!</p>
		    
		<? } else { ?>
		    
		    <? if (!empty($error)) { ?>
                <p class="formError"><strong><?= $error ?></strong></p>
            <? } ?>
			
			<form method="post" action="/contact/us" class="default">
				<input type="hidden" name="site" value="<?= $_SERVER['SERVER_NAME'] ?>"/>
                <div class="input text">
                	<label>E-mailadres</label>
                	<input name="emailInfo" value="<?= $this->params['form']['emailInfo'] ?>" />
                </div>
                
                <div class="input text">
                	<label>Onderwerp</label></td>
    				<input name="onderwerp" value="<?= $this->params['form']['onderwerp'] ?>" />
                </div>
                
                <div class="input textarea">
                	<label>Bericht</label></td>
    				<textarea name="berichtInfo" style="width: 360px;"><?= $this->params['form']['berichtInfo'] ?></textarea>
                </div>
                
                <div class="input submit">
                	<input id="verzenden" type="submit" class="button" value="Verzenden" />
                </div>
			</form>
            
            <div class="cols percentage clearfix">
            	<div class="first col">
            		<p><?= $settings['contact_naam'] ?><br />
	    			<?= $settings['contact_adres'] ?><br />
	    			<?= $settings['contact_postcode'] ?> <?= $settings['contact_gemeente'] ?> <br />
	    			T <?= $settings['contact_tel'] ?> <br />
	    			F <?= $settings['contact_fax'] ?><br />
	    			<a href="mailto:<?= $settings['contact_email'] ?>"><?= $settings['contact_email'] ?></a>
            	</div>
            	<div class="col">
            		<p><?= nl2br($settings['contact_bank']) ?></p>
            	</div>
            </div>
           	<div class="cols percentage clearfix"> 
           		<div class="first col" style="margin: 10px 0 0 0;">
	            	<?= $asset->image($settings, 'contact_foto', array('class' => 'thumb-sidebar', 'alt' => 'Ons kantoor')) ?>
				</div>
				<div class="col">
					<p class="sidebar-tekst">
	    				Openingstijden:<br/>
	    				<?= nl2br($settings['contact_openingsuren']) ?>
					</p>
				</div>
            </div>

		<? } ?>

			
