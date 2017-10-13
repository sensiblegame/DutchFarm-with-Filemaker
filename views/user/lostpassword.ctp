<?php /*<div id="sidebar" class="left">
    
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/lostpassword') ?>
	</div>
	
</div>*/?>

<div id="content">
    
	<div class="pd">		
		<? if ($result == true) { ?>

            <p>We hebben uw paswoord via email verzonden.</p>
            
            <p><a href="/login">Inloggen</a></p>
		    
		<? } else { ?> 
		
    		<h2>Uw bent uw paswoord vergeten?</h2>
    		<p>Vul hier uw e-mail adres in om uw paswoord op te vragen.</p>

            <? if (!empty($error)) { ?>
                <p class="formError"><strong><?= $error ?></strong></p>
            <? } ?>

           		<?= $form->create(false, array('method' => 'post', 'url' => '/lostpassword', 'class' => 'default')) ?>
        
                <div class="input text">
                	<?= $form->label('Email') ?>
            		<?= $form->text('Email') ?>
            	</div>
			
				<div class="input submit">
                	<?= $form->submit('Verstuur', array('div'=>false)) ?>
            	</div>
            	
            <?= $form->end() ?>
        
        <? }?>

		<div id="content-footer"></div>
		
    </div>
    
</div>