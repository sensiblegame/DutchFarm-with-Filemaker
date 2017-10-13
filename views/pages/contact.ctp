		<div id="sidebar" class="left">
			<div id="breadcrumb">
        	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
        	    <?= $html->link($this->pageTitle, '/contact') ?>
			</div>
			<?= $asset->image($settings, 'contact_foto', array('class' => 'thumb-sidebar', 'alt' => 'Ons kantoor')) ?>
			
			<p class="sidebar-tekst">
			    Openingstijden:<br/>
			    <?= nl2br($settings['contact_openingsuren']) ?>
			</p>

			<a href="<?= $asset->url($settings, 'contact_plan_pdf', false, 'postfly_contact_plan.pdf') ?>" title="Klik op de plattegrond" target="_blank"><?= $asset->image($settings, 'contact_plan_img', array('class' => 'thumb-sidebar')) ?></a>
			<p class="sidebar-tekst">Klik op de plattegrond voor een vergroting.</p>
			
			
			<p>
			    <a href="/contact/nieuwsbrief">Nieuwsbrief inschrijven</a>
			    <br/>
			    <a href="/contact/offerte">Offerte aanvragen</a>
			    <br/>
			    <a href="/contact/samplewaaier">Samplewaaier aanvragen</a>
			    <br/>
			</p>
		</div>
		
		<div id="content" class="left">
			<div class="pd">
				<h1>Contact met Postfly</h1>
				
				<div>
					<? if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($error)) { ?>
						Bedankt voor uw bericht, we nemen zo spoedig mogelijk contact met u op.
					<? } else { ?>
					    <? if (count($_POST) == 0) { $_POST['data']['info_type'] = 'Info'; } ?>
					    <? if (!empty($error)) { ?>
                            <p class="formError"><strong><?= $error ?></strong></p>
                        <? } ?>
    					<form method="post" action="/contact" class="form">
                            <table cellspacing="0" cellpadding="0" border="0" width="557">
                                <tr>
                					<td><label>E-mailadres</label></td>
                					<td style="width:407px;"><input name="emailInfo" value="" /></td>
                    			</tr>
                                <tr>
                					<td><label>Onderwerp</label></td>
                					<td><input name="onderwerp" value="" /></td>
                    			</tr>
                                <tr>
                					<td><label>Bericht</label></td>
                					<td><textarea name="berichtInfo" style="width: 360px;"></textarea></td>
                                </tr>
                			</table>
        					<input id="verzenden" type="submit" class="button" value="Verzenden" />
    					</form>
					<? } ?>
				</div>
				
				<div class="col1">
					<p><?= $settings['contact_naam'] ?><br />
					<?= $settings['contact_adres'] ?><br />
					<?= $settings['contact_postcode'] ?> <?= $settings['contact_gemeente'] ?> <br />
					T <?= $settings['contact_tel'] ?> <br />
					F <?= $settings['contact_fax'] ?><br />
					<a href="mailto:<?= $settings['contact_email'] ?>"><?= $settings['contact_email'] ?></a>
				</div>
				<div class="col2">
					<p><?= nl2br($settings['contact_bank']) ?></p>
				</div>	
				
				<div id="content-footer"></div>				
		</div>
	</div>	