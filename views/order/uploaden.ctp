<?= $javascript->link('/uploadifive/jquery.uploadifive.min') ?>
<?= $html->css('/uploadifive/uploadifive.css') ?>

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
            <?php $timestamp = time();?>
            $("#<?= $order['idLine'] ?>").uploadifive({
                'auto'              : false,
                'multi'             : true,
                'simUploadLimit'    : 1,
                'removeCompleted'   : false,
                'uploadScript'      : '/uploadifive/uploadifive_LOK8IDX.php',
                'width'             : 145,
                'height'            : 16,
                'buttonText'        : 'Kies bestand',
                'queueID'           : "<?= $order['idLine'] ?>-queue",
                'formData'          : {
                    'folder'        : '/app/webroot/jsonfiles/<?= $order['idLine'] ?>',
                    'timestamp'     : '<?php echo $timestamp;?>',
                    'token'         : '<?php echo hash_hmac('sha256', $timestamp, "6\"~gU&Y$Rk7TAJ~Xp9?K9,X");?>'
                },
                'onCancel'          : function(file, data) {
                    var path = "<?= $order['idLine'] ?>/" + file.name;
                    $.get(
                        '/cart/deleteFile',
                        {path: path},
                        function(data) {
                        }
                    );
                },
                'onQueueComplete'   : function() {
                    queueCount--;
                    if (queueCount == 0) {
                        $('#uploadform').submit();
                    }
                }
            });
        <? } ?>
        
        $('#upload').click(function(event) {
            <? foreach ($_SESSION['Orders'] as $order) { ?>
                $("div.uploadifyProgress").show();
                console.log($("#<?= $order['idLine'] ?>"));
                $("#<?= $order['idLine'] ?>")..uploadifive('upload');
            <? } ?>
            return false;
        });

    });
</script>

