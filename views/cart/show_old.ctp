<?= $javascript->link('/uploadify/jquery.uploadify.v2.1.4.min') ?>
<?= $javascript->link('/uploadify/swfobject') ?>
<?= $html->css('/uploadify/uploadify.css') ?>
<div id="content">
    
	<div class="pd">

        <? if (count($orders) > 0) { ?>
        
		<? foreach ($orders as $k => $order) { ?>
    		<table cellspacing="0" cellpadding="0" border="0" class="bestelling">
        	    
                	<tr class="order-title">
                		<td rowspan="2"> 
                			<div id="uploadContainer">
                		    	<div id="uploadedItemsContainer">
		                		    <? foreach ($order['files'] as $file) { ?>
		                                <div class="uploadifyQueue" id="<?= $file['id'] ?>">
		                                    <div class="uploadifyQueueItem">
		                                        <div class="cancel">
		                                            <a class="deleteFile" parentId="<?= $file['id'] ?>" id="delete-<?= $file['id'] ?>" path="<?= $order['order_guid'] . '/' . $file['file'] ?>">
		                                                <img border="0" src="/uploadify/delete.png">
		                                            </a>
		                                        </div>
		                                        
		                                        <span class="fileName"><?= $file['file'] ?> (<?= $generic->formatFilesize($file['size']) ?>)</span>
		                                    </div>
		                                </div>
		                		    <? } ?>
		                		    <div id="<?= $order['order_guid'] ?>-queue" class="uploadifyQueue"></div>
	                            </div>
	                            
	
	                            <div class="upload">    
	                                <input name="<?= $order['order_guid'] ?>" id="<?= $order['order_guid'] ?>" type="file" />
	                                <span style="vertical-align: 25%;"></span>
	                            </div>
                                <div style="clear:both"></div>
							</div>
                		</td>
                		<td class="title">
                			<span class="highlight"><?= $order['aantal'] ?> ex. <?= $order['productnaam'] ?> - <?= $order['naam'] ?></span>
                		</td>
                		<td class="align-right price">
                			<?= $generic->formatCurrency($order['totaal']) ?>
                		</td>
                		<td><?= $html->link($html->image('ico-delete.gif'), '/cart/delete/' . $k, array('class' => 'verwijderen'), null, false) ?></td>
                	</tr>
                	<tr class="order-description">
                		<td colspan="3">
                		    <ul class="options">
                		        <li><span>&bull;</span> Papierkeuze: <?= $order['grammage'] ?> gr</li>
                		        <? if (!empty($order['opties'])) { ?>
                		        <li><span>&bull;</span> Afwerking: <?= str_replace('-', ', ', $order['opties']) ?></li>
                		        <? } ?>
                		    </ul>
                		</td>
                	</tr>
            	
        	</table>
        	<? } ?>
            
            <h5>Promocode</h5>    
     
		    <?= $form->create(false, array('url' => '/cart')) ?>
	    		<p>
	    		    <span class="first">Heeft u een promocode ontvangen? Vul deze dan hier in !</span>
	    		    <input class="textareaBestelling" name="data[promocode]" value="<?= $promo ? $promo['promo_code'] : '' ?>" /> <input type="submit" class="submitBestelling" value="Bevestig">
	    		</p>
			<?= $form->end() ?>
			<? if (!empty($promocode_error)) { ?>
	        	<p class="errorPromo"><? echo $promocode_error; ?></p>
	        <? } ?>
			<br />
    	    
    	    
    	    
    		<table cellspacing="0" cellpadding="0" border="0" class="summary">                
                <tr>
                    <td>Totaal excl. BTW</td>
                    <td class="align-right"><?= $generic->formatCurrency($totaal_ex) ?></td>
                </tr>
                <tr>
                    <td>Promo</td>
                    <td class="align-right"><?= $generic->formatCurrency($korting) ?></td>
                </tr>
                <tr class="last">
                    <td>BTW <?= $settings['vat'] * 100 ?> %</td>
                    <td class="align-right"><?= $generic->formatCurrency($totaal_vat) ?></td>
                </tr>  
                <tr class="total">   
                    <td class="highlight">Totaal</td>
                    <td class="align-right"><?= $generic->formatCurrency($totaal_inc) ?></td>
                </tr>
        	</table>
        	
        	
        	<h5>Opmerkingen</h5>
    	    <p>Heeft u eventueel nog een op- of aanmerking? Dan kan u dit hieronder kwijt.</p>
    	    
    	    <div class="input comment-order">
    	    	<textarea name="data[tmpOpmerkingen]" id="tmpOpmerkingen" class="text"><?=$_SESSION['tmp']['opmerkingen']; ?></textarea>
    	    </div>
				
			<div class="clearfix">
		        <div class="right order-submit">
                    <span class="left">
                        <?= $form->create(false, array('class'=>'left', 'type' => 'post', 'url' => '/order/redirectHome', 'id' => 'form-back')) ?>
                        	<input type="hidden" name="data[opmerkingen]" id="opmerkingenBack">
			                <?= $form->submit('Verder winkelen', array('class' => 'left button', 'div' => false, 'id' => 'cart-back')) ?>
			            <?= $form->end() ?>
                        of
                    </span>                 
		        <?= $form->create(false, array('class'=>'left', 'type' => 'post', 'url' => '/order/confirm', 'id' => 'form-confirm')) ?>
		        	<input type="hidden" name="data[opmerkingen]" id="opmerkingen">
	                <?= $form->submit('Veilig afrekenen', array('class' => 'left button', 'div' => false, 'id' => 'cart-confirm')) ?>
	            <?= $form->end() ?>
                </div>
            </div>

            <input type="hidden" id="after-upload" value=""/>

            <script type="text/javascript">

                // Start with an empty queue
                var queueCount = 0; // <?= sizeof($orders) ?>;
                var uploadedYet = false;
                
                $(document).ready(function() {

                    // Start with an empty queue
                    var queueCount = 0; // <?= sizeof($orders) ?>;

                    <? foreach ($orders as $order) { ?>
                        $("#<?= $order['order_guid'] ?>").uploadify({
                            'uploader'        : '/uploadify/uploadify.swf',
                            'script'          : '/uploadify/uploadify.php',
                            'cancelImg'       : '/uploadify/delete.png',
                            'folder'          : '/app/webroot/jsonfiles/<?= $order['order_guid'] ?>',
                            'auto'            : true,
                            'hideButton'      : false,
                            'multi'           : true,
                            'queueID'         : "<?= $order['order_guid'] ?>-queue",
                            'simUploadLimit'  : 1,
                            'removeCompleted' : false,
                            'width'           : 90,
                            'height'          : 16,
                            'buttonImg'       : '/uploadify/add.png',
                            'wmode'           : 'transparent',
                            'onSelect'        : function(event,ID,fileObj) {
                                queueCount++;
                            },
                            'onAllComplete'   : function(event, data) {
                            	uploadedYet = true;
                                queueCount--;
                                
                            },
                        });
                    <? } ?>
                    
                    $('#cart-confirm').click(function(event) {
                    	$('#opmerkingen').val($('#tmpOpmerkingen').val());
                        $('#after-upload').val('#form-confirm');
                        <? foreach ($orders as $order) { ?>
                            $("div.uploadifyProgress").show();
                            $("#<?= $order['order_guid'] ?>").uploadifyUpload();
                        <? } ?>
                        if (!uploadedYet) {
                        	$('#lightsout').show();
                            $('#dialogs').show();
                            return false;
                        } else {
                           
                        }
                    });
                    
                    $('#cart-back').click(function(event) {
                    	$('#opmerkingenBack').val($('#tmpOpmerkingen').val());
                        
                    });
                    
                    $('#cart-continue').click(function(event) {
                        $('#after-upload').val('#form-continue');
                        <? foreach ($orders as $order) { ?>
                            $("div.uploadifyProgress").show();
                            $("#<?= $order['order_guid'] ?>").uploadifyUpload();
                        <? } ?>
                        if (queueCount== 0) {
                            return true;
                        } else {
                            return false;
                        }
                    });
                    
                    $('a.deleteFile').click(function(event) {
                        var myId = $(this).attr('parentId');
                        $.get(
                            '/cart/deleteFile',
                            {path: $(this).attr('path')},
                            function(data) {
                                $('#' + myId).remove();
                            }
                        );
                    });

                });
            </script>

        <? } else { ?>

            <p>Uw winkelmandje is leeg.</p>
	        
	        <p><a href="/">Verder winkelen</a></p>
            
        <? } ?>

		<div id="content-footer"></div>
		
    </div>
    
</div>
