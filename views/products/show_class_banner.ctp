<!-- wizard -->
<div class="wizard">

	<div class="cols percentage clearfix">
		<div class="step step1">
			<h2><em>1. Kies het materiaal</em></h2>
			<div class="scroll1" id="subclasses">
				<p class="align-center"><img src="/img/ajax-loader.gif"/></p>
			</div>
		</div>
		
		<div class="step step2">
			<h2><em>2. Kies het formaat</em></h2>
			<div class="scroll1" id="formats">
			</div>
		</div>
			
	</div>
	
	<div class="cols percentage clearfix">		
		<div class="step step3">
			<h2><em>3. Kies de oplage</em></h2>
			<div class="scroll1" id="quantity">
			</div>
		</div>
		
	
		<div class="step step4">
			<h2><em>4. Kies de afwerking</em></h2>
			<div class="scroll1" id="finishing">
			</div>
		</div>
			
	</div>
	
	<div class="step finish">
		<h2><em>5. Prijs</em></h2>
		<div class="leftColumnPrice">
			<div id="price">	
				 <table cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
							<th>Totaal excl. BTW </th>
							<td>&euro; <span id="price_subtotal">0,00</span></td>
						</tr>
						<tr>
							<th>Afwerking</th>
							<td>&euro; <span id="price_finishing">0,00</span></td>
						</tr>
						<tr>
							<th>BTW</th>
							<td>&euro; <span id="price_vat">0,00</span></td>
						</tr>
						<tr>
						
							<tr> <td colspan="2"> <hr /> </td> </tr>
						</tr>
						<tr class="total">
							<th>TOTAAL</th>
							<td>&euro; <span id="price_total">0,00</span></td>
						</tr>
					</tbody>
				</table> 			
			</div>
		</div>
			
		<div class="rightColumnProduct">
			<form id="cart_add" action="/cart/add" method="post">
				<div class="clearfix">
					<div class="input text">
						<label>Benoem je drukwerk</label>
						<input id="benoem-uw-drukwerk" name="data[product_name]">
						<span class="caption">(vb.: Beachfestival, Solden2012, &#8230;)</span>
					</div>
				</div>
				<div class="input submit clearfix">
					<input type="hidden" id="data_product_papiersoort" name="data[pr_code]" />
					<input type="hidden" id="data_prijs_subtotaal" name="data[prijs_subtotaal]" />
					<input type="hidden" id="data_prijs_afwerking" name="data[prijs_afwerking]" />
					<input type="hidden" id="data_aantal" name="data[aantal]" />
					<input type="hidden" id="data_product_finishing" name="data[product_finishing]" />
					<input id="voeg-toe" class="button" type="submit" style="display:none;" value="In winkelwagen">
				</div>
			</form>					
		</div>		
	</div>
	
	
	<div class="step">
		<h2><em>Product specificaties</em></h2>
		<div id="product_specs" class="scroll1"></div>
	</div>
	

	<div class="step">
		<h2><em>Levertijden</em></h2>
		<div id="product_delivery"></div>
	</div>
</div>
<!-- /wizard -->



<script type="text/javascript">
    $(document).ready(function() {
        $('.examples').hide();
        $.get(
            '/products/showSubClass',
            {id: <?= $class['_k1_classid'] ?>},
            function(data) {
                $('div#subclasses').html(data);
                $('div#formats').html('');
                $('div#formats_preview').html('');
                $('div#pictures').html('');
                $('div#finishing').html('');
                $('div#quantity').html('');
                $('div#checklist').html('');
               	$('#voeg-toe').hide();  
                $('.scroll').jScrollPane({
						scrollbarWidth: 6,
						topCapHeight: 10,
						showArrows: true
					});
            }
        );
        
        $('a.subclass').live('click', function() {
           
            $('a.subclass').parent().removeClass('active');
            $(this).parent().addClass('active');
                        
            $('div#product_specs').html($(this).attr('info'));
            
            var leveringImage = $(this).attr('levering_img');
            var leveringImageId = $(this).attr('levering_img_id');
            if(leveringImage == ''){
            	$('#product_delivery').html(); 
            }else{
            	$('#product_delivery').html('<img src="/assets/0/'+leveringImageId+'/image'+leveringImage+'" />'); 
            }             
            //$('div#product_delivery').html($(this).attr('delivery'));
                        
            $.get(
                '/products/showFormatsBanner',
                {id: $(this).attr('id')},
                function(data) {
                    $('div#formats').html(data);
                    $('div#formats_preview').html('');
                    $('div#pictures').html('');
                    $('div#finishing').html('');
                    $('div#quantity').html('');
                    $('div#checklist').html('');
                    $('#voeg-toe').hide();
                    $('#js-img-template').hide();
                    $('#js-download-template').hide();
                    $('.scroll').jScrollPane({
						scrollbarWidth: 6,
						topCapHeight: 10,
						showArrows: true
					});
                }
            );
            
            resetPrice();
            
            return false;
            
        });
        
        $('a.format').live('click', function() {
            $('.examples').hide();
            $('a.format').parent().removeClass('active');
            $(this).parent().addClass('active');   
            
            var downloadTemplate = $(this).attr('download_template');
            if(downloadTemplate != ''){
            	$('#js-download-template').show();
            	$('#js-download-template').attr('href', downloadTemplate);
            }else{
            	$('#js-download-template').hide();
            }
            
            var myPreviewUrl = $(this).attr('preview_big');
            if (myPreviewUrl != '') {
            	$('#js-img-template').attr('src', '');
                $('#js-img-template').attr('src', myPreviewUrl).show();
            } else {
                $('#js-img-template').hide();
            }
            
            var myDetail1 = $(this).attr('detail_1');
            var myDetail2 = $(this).attr('detail_2');
            var myDetail3 = $(this).attr('detail_3');
            var myDetail4 = $(this).attr('detail_4');

            if (myDetail1 != '') {
             	$('.examples').show();
            	$('#js-img-example-1').show();
                $('#js-img-example-1').attr('src', myDetail1);
            } else {
            	$('#js-img-example-1').hide();
            }
            if (myDetail2 != '') {
            	$('.examples').show();
            	$('#js-img-example-2').show();
                $('#js-img-example-2').attr('src', myDetail2);
            } else {
            	$('#js-img-example-2').hide();
            }
            if (myDetail3 != '') {
             	$('.examples').show();
            	$('#js-img-example-3').show();
                $('#js-img-example-3').attr('src', myDetail3);
            } else {
            	$('#js-img-example-3').hide();
            }
            if (myDetail4 != '') {
             	$('.examples').show();
            	$('#js-img-example-4').show();
                $('#js-img-example-4').attr('src', myDetail4);
            } else {
            	$('#js-img-example-4').hide();
            }
            
            var myCheckList = '';
            if ($(this).attr('check_grootte') != '') {
                myCheckList += '<p class="clearfix"><strong class="left"><span>&bull;</span> Grootte:</strong> <span class="right">' + $(this).attr('check_grootte') + '</span></p>';
            }
            if ($(this).attr('check_afloop') != '') {
                myCheckList += '<p class="clearfix"><strong class="left"><span>&bull;</span> Afloop:</strong> <span class="right">' + $(this).attr('check_afloop') + '</span></p>';
            }
            if ($(this).attr('check_kleur') != '') {
                myCheckList += '<p class="clearfix"><strong class="left"><span>&bull;</span> Kleur:</strong> <span class="right">' + $(this).attr('check_kleur') + '</span></p>';
            }
            if ($(this).attr('check_resolutie') != '') {
                myCheckList += '<p class="clearfix"><strong class="left"><span>&bull;</span> Resolutie:</strong> <span class="right">' + $(this).attr('check_resolutie') + '</span></p>';
            }
            if ($(this).attr('check_bedrukking') != '') {
                myCheckList += '<p class="clearfix"><strong class="left"><span>&bull;</span> Bedrukking:</strong> <span class="right">' + $(this).attr('check_bedrukking') + '</span></p>';
            }
            $('div#checklist').html(myCheckList);
            
            
            
            $.get(
                '/products/showPrices',
                {id: $(this).attr('id'), name: $(this).attr('full_name')},
                function(data) {
                    $('div#quantity').html(data);
                    $('div#finishing').html('');
                    $('#voeg-toe').hide(); 
                    $('.scroll').jScrollPane({
						scrollbarWidth: 6,
						topCapHeight: 10,
						showArrows: true
					});
                }
            );
            
            resetPrice();
            
            return false;
            
        });
        
        $('a.price').live('click', function() {

            var finishingOptions = [];
            $('a.finishing').each(function(index) {
                if ($(this).parent().hasClass('active')) {
                    finishingOptions.push($(this).text().toLowerCase());
                }
            });

            $('a.price').parent().removeClass('active');
            $(this).parent().addClass('active');

            var productcode = $(this).attr('prijscode');
            $('#data_product_papiersoort').val(productcode);
            
            $.get(
                '/products/showFinishing',
                {id: $(this).attr('id')},
                function(data) {
                    
                    $('div#finishing').html(data);
                    
                    $('a.finishing').each(function(index) {
                        if ($.inArray($(this).text().toLowerCase(), finishingOptions) != -1) {
                            //$(this).parent().addClass('active');
                            $(this).click();
                        }
                    });
                    
                    $('.scroll').jScrollPane({
						scrollbarWidth: 6,
						topCapHeight: 10,
						showArrows: true
					});
                    
                }
            );
            
            calculatePrice();
            
            return false;
            
        });
        
        $('a.finishing').live('click', function() {
            
            if ($(this).attr('group') != '') {
                var myGroup = $(this).attr('group');
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $('a.finishing').each(function(index) {
                        if ($(this).attr('group') == myGroup) {
                            $(this).parent().removeClass('active');
                        }
                    });
                    $(this).parent().addClass('active');
                }
            } else {
                $(this).parent().toggleClass('active');
            }
            calculatePrice();
            
            // Fill in the finishing options
            var finishingOptions = [];
            $('a.finishing').each(function() {
                if ($(this).parent().hasClass('active')) {
                    finishingOptions.push($(this).attr('titleinfo'));
                }
            });
            
            
            $('#data_product_finishing').val(finishingOptions.join(','));
            
            return false;
            
        });
        
        function resetPrice() {
            $('span#price_subtotal').html('0,00');
            $('span#price_finishing').html('0,00');
            $('span#price_vat').html('0,00');
            $('span#price_total').html('0,00');
        }
        
        function calculatePrice() {
            
            resetPrice();
            
            var priceSubtotal  = 0.00;
            var priceFinishing = 0.00;
            
            $('a.price').each(function() {
                if ($(this).parent().hasClass('active')) {
                    priceSubtotal += parseFloat($(this).attr('price').replace(',','.'));
                }
            });
            
            $('a.finishing').each(function() {
                if ($(this).parent().hasClass('active')) {
                    priceFinishing += parseFloat($(this).attr('price').replace(',','.'));
                }
            });
            
            var priceVat   = (priceSubtotal + priceFinishing) * <?= str_replace(',', '.', $settings['vat']) ?> ;
            var priceTotal = priceSubtotal + priceFinishing + priceVat;
            
            $('span#price_subtotal').html(priceSubtotal.toFixed(2).replace('.', ','));
            $('span#price_finishing').html(priceFinishing.toFixed(2).replace('.', ','));
            $('span#price_vat').html(priceVat.toFixed(2).replace('.', ','));
            $('span#price_total').html(priceTotal.toFixed(2).replace('.', ','));
            
         
            $('#voeg-toe').show();
        
        }
        
        $('#cart_add').live('submit', function(event) {

            // Check that a name if given for the item
            if (!$('#benoem-uw-drukwerk').val()) {
            	$('#lightsout').show();
            	$('#dialogs .warning').html('<h1><?=__('Gelieve het veld "Benoem uw drukwerk" nog in te vullen.');?></h1><a href="" class="no"><?=__('Sluiten');?></a>');
                $('#dialogs').show();
                return false;
            }
                      
            // Add the rest of the data
            $('#data_aantal').val($('div#quantity li.active a').attr('quantity'));
            $('#data_prijs_subtotaal').val($('span#price_subtotal').text().replace(',', '.'));
            $('#data_prijs_afwerking').val($('span#price_finishing').text().replace(',', '.'));
            
            $('#benoem-uw-drukwerk').val(nameProduct + ' - ' + formatBanner);

        });
        
        $('input#voeg-toe-banner').live('click', function() {
			
            // Check that a name if given for the item
            if (!$('#breedte-banner').val() && !$('#hoogte-banner').val()) {
            	$('#lightsout').show();
            	$('#dialogs .warning').html('<h1><?=__('Gelieve het veld "Breedte" en "Hoogte" in te vullen.');?></h1><a href="" class="no"><?=__('Sluiten');?></a>');
                $('#dialogs').show();
                return false;
            }     
            else if (!$('#breedte-banner').val()) {
            	$('#lightsout').show();
            	$('#dialogs .warning').html('<h1><?=__('Gelieve het veld "Breedte" nog in te vullen.');?></h1><a href="" class="no"><?=__('Sluiten');?></a>');
                $('#dialogs').show();
                return false;
            }         
            else if(!$('#hoogte-banner').val()) {
            	$('#lightsout').show();
            	$('#dialogs .warning').html('<h1><?=__('Gelieve het veld "Hoogte" nog in te vullen.');?></h1><a href="" class="no"><?=__('Sluiten');?></a>');
                $('#dialogs').show();
                return false;            
            }
            
            var test_b = parseInt($('#breedte-banner').val());
            var test_h = parseInt($('#hoogte-banner').val());
            
            if(isNaN(test_b))
            {
            	$('#lightsout').show();
            	$('#dialogs .warning').html('<h1>De breedte heeft geen numerieke waarde</h1><a href="" class="no">Sluiten</a>');
                $('#dialogs').show();
                return false;
            }
            
            if(isNaN(test_h))
            {
            	$('#lightsout').show();
            	$('#dialogs .warning').html('<h1>De hoogte heeft geen numerieke waarde</h1><a href="" class="no">Sluiten</a>');
                $('#dialogs').show();
                return false;
            }
            
            
            if((parseInt($('#breedte-banner').attr('maxb')) < parseInt($('#breedte-banner').val())) || (parseInt($('#breedte-banner').attr('minb')) > parseInt($('#breedte-banner').val()))) {
            	$('#lightsout').show();
            	$('#dialogs .warning').html('<h1>De breedte moet tussen ' + $('#breedte-banner').attr('minb') +'cm en ' + $('#breedte-banner').attr('maxb') + 'cm liggen </h1><a href="" class="no">Sluiten</a>');
                $('#dialogs').show();
                return false;            
            }
            
            if((parseInt($('#hoogte-banner').attr('maxh')) < parseInt($('#hoogte-banner').val())) || (parseInt($('#hoogte-banner').attr('minh')) > parseInt($('#hoogte-banner').val()))) {
            	$('#lightsout').show();
            	$('#dialogs .warning').html('<h1>De hoogte moet tussen ' + $('#hoogte-banner').attr('minh') +'cm en ' + $('#hoogte-banner').attr('maxh') + 'cm liggen </h1><a href="" class="no">Sluiten</a>');
                $('#dialogs').show();
                return false;            
            }       
            
            
            $.get(
                '/products/showPricesBanner',
                {id: $(this).attr('id_type'), name: $(this).attr('full_name'), formatb:$('#breedte-banner').val(), formath: $('#hoogte-banner').val()},
                function(data) {
                    $('div#quantity').html(data);
                    $('div#finishing').html('');
                    $('#voeg-toe').hide(); 
                    $('.scroll').jScrollPane({
						scrollbarWidth: 6,
						topCapHeight: 10,
						showArrows: true
					});
                }
            );
            
            resetPrice();
            
            return false;

        });
        
       
    });
</script>

