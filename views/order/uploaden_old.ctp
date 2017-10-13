<?= $javascript->link('/uploadify/jquery.uploadify.v2.1.4.min') ?>
<?= $javascript->link('/uploadify/swfobject') ?>
<?= $html->css('/uploadify/uploadify.css') ?>

<div id="sidebar" class="left">

	<div id="breadcrumb">
	    <?= $html->link('Home', '/', array('class' => 'first')) ?>
	    <?= $html->link($this->pageTitle, '/order/uploaden') ?>
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
	    Bestelnummer: <?= $_SESSION['orderWerkbon'] ?><br/>
	    Aantal item(s): <?= count($_SESSION['Orders']) ?><br/>
	    Totaal: &euro; <?= number_format($_SESSION['prijs_totaal'], 2,',','.'); ?>
    </p>

</div>

<div id="content" class="left">

    <div class="pd">

        <h1><?= $this->pageTitle ?></h1>

        <p>Bestelling: <?= $_SESSION['orderWerkbon'] ?></p>

        <?= $form->create(false, array('id' => 'uploadform', 'method' => 'post', 'url' => '/order/done', 'enctype' => 'multipart/form-data', 'class' => 'form')) ?>
			

            <? foreach ($_SESSION['Orders'] as $order) { ?>
            
                <p style="background-color: #ec008c; padding-left: 4px; color: white; margin-bottom: 8px;">Referentie: <?= $order['naam'] ?> - <?= $order['Fullartikel'] ?></p>
            
                <div id="<?= $order['idLine'] ?>-queue" class="uploadifyQueue"></div>
                
                <div style="margin-bottom: 24px; vertical-align: middle; margin-left: 24px;">    
                    <input name="<?= $order['idLine'] ?>" id="<?= $order['idLine'] ?>" type="file" />
                    <span style="vertical-align: 25%;"></span>
                </div>
                
            <? } ?>

            <p style="border-top: 1px solid #ec008c; margin-top: 12px;">
                <label>Opmerkingen</label><br/>
			    <textarea name="opmerkingen"></textarea>
			</p>
        
            <?= $form->submit('Upload', array('id' => 'upload', 'class' => 'button')) ?>
        
        <?= $form->end() ?>

		<div id="content-footer"></div>

    </div>
    
</div>

<script type="text/javascript">
    $(document).ready(function() {
        
        // Start with an empty queue
        var queueCount = <?= sizeof($_SESSION['Orders']) ?>;
        
        <? foreach ($_SESSION['Orders'] as $order) { ?>
            $("#<?= $order['idLine'] ?>").uploadify({
                'uploader'        : '/uploadify/uploadify.swf',
                'script'          : '/uploadify/uploadify.php',
                'cancelImg'       : '/uploadify/delete.png',
                'folder'          : '/app/webroot/jsonfiles/<?= $order['idLine'] ?>',
                'auto'            : false,
                'hideButton'      : false,
                'multi'           : true,
                'queueID'         : "<?= $order['idLine'] ?>-queue",
                'simUploadLimit'  : 1,
                'removeCompleted' : false,
                'width'           : 145,
                'height'          : 16,
                'buttonImg'       : '/uploadify/add.png',
                'wmode'           : 'transparent',
                'onAllComplete'   : function(event, data) {
                    queueCount--;
                    if (queueCount == 0) {
                        $('#uploadform').submit();
                    }
                },
            });
        <? } ?>
        
        $('#upload').click(function(event) {
            <? foreach ($_SESSION['Orders'] as $order) { ?>
                $("div.uploadifyProgress").show();
                $("#<?= $order['idLine'] ?>").uploadifyUpload();
            <? } ?>
            return false;
        });

    });
</script>
