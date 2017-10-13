<?php /*<div id="sidebar" class="left">
    
	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/login') ?>
	</div>
	
</div>*/ ?>

<div id="content">
    
	<div class="pd">		
		<h2>Heeft u al vaker bij Postfly besteld?</h2>
		<p>Vul dan uw login en wachtwoord in. <a href="/lostpassword">Uw wachtwoord vergeten?</a></p>

        <? if (!empty($error)) { ?>
            <p class="formError"><strong><?= $error ?></strong></p>
        <? } ?>
		
        <?= $form->create(false, array('method' => 'post', 'url' => '/login', 'class' => 'default')) ?>
        	<div class="input text">
        		<?= $form->label('Email') ?>
        		<?= $form->text('Email') ?>
        	</div>
        	
        	<div class="input password">
        		<?= $form->label('Wachtwoord') ?>
        		<?= $form->password('Wachtwoord') ?>
        	</div>
           
           	<div class="input submit">
           		<?= $form->submit('Inloggen', array('div'=>false)) ?>
            </div>
            
        <?= $form->end() ?>
        
		<h2>Bent u hier voor de eerste keer?</h2>
		<p>U kunt hier in een paar simpele stappen uw eigen veilige Postfly account aanmaken.</p>

        <?= $form->create(false, array('type' => 'get', 'url' => '/newuser', 'class' => 'default imnew')) ?>
            <?= $form->submit('Ik ben nieuw', array('div'=>'input submit')) ?>
        <?= $form->end() ?>

		<div id="content-footer"></div>
		
    </div>
    
</div>