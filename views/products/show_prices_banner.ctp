<div class="headerColumnProductBanner firstColumn">
	Standaard levering<br />
	<span>5 productiedagen</span>
</div>
<div class="headerColumnProductBanner">
	Express levering<br />
	<span>3 productiedagen</span>
</div>

<div class="titleColumnProductBanner">
<ul>
	<? foreach ($prices as $price ) { ?>
		<? if($price['type_levering'] == 'express') { ?>
		  	<li>
            	<p class="title"><?= $price['aantal'] ?> ex</p>
        	</li>
        <? } ?>
    <? } ?>
</ul>
</div>
<div class="priceColumnProductBanner">
<ul>    
    <? foreach ($prices as $price ) { ?>
		<? if($price['type_levering'] == 'Standaard') { ?>
		  	<li>
		  	
		  	 <? 
		  	 $hb = (int)$_SESSION['Order']['formatBannerB'];
		  	 $wb = (int)$_SESSION['Order']['formatBannerH'];
		  	 
		  	 	$string = $price['prijs'];        
		  	 	$a = explode(",",$string);            
				$int = $a[0];                        
				$dec = $a[1];           
				$lengthofnum=strlen($dec);       
				$divider="1";   
				$i=0;
				while($i < ($lengthofnum)) {
				$divider.="0";        
				$i++;
				}
				$divider=(int)$divider;   
				$factor=$int+($dec/$divider);  
		  	 
		  	 $totalPriceBanner = $hb * $wb * $factor; ?>
		  	 
            	<a href="#" class="price clearfix" prijscode = "<?= $price['pr_code']; ?>"  id="<?= $price['_k1_prijsid'] ?>" price="<?= $totalPriceBanner ?>" quantity="<?= $price['aantal'] ?>"><?= $generic->formatCurrency($totalPriceBanner) ?></a>
        	</li>
        <? } ?>
    <? } ?>
</ul>
</div>
<div class="priceColumnProductBanner">
<ul>
	<? foreach ($prices as $price ) { ?>
		<? if($price['type_levering'] == 'express') { ?>
		  	<li>
		  	
		  	 <? 
		  	 $hb = (int)$_SESSION['Order']['formatBannerB'];
		  	 $wb = (int)$_SESSION['Order']['formatBannerH'];
		  	 
		  	 	$string = $price['prijs'];        
		  	 	$a = explode(",",$string);            
				$int = $a[0];                        
				$dec = $a[1];           
				$lengthofnum=strlen($dec);       
				$divider="1";   
				$i=0;
				while($i < ($lengthofnum)) {
				$divider.="0";        
				$i++;
				}
				$divider=(int)$divider;   
				$factor=$int+($dec/$divider);  
		  	 
		  	 $totalPriceBanner = $hb * $wb * $factor; ?>
		  	 
            	<a href="#" class="price clearfix" prijscode = "<?= $price['pr_code']; ?>"  id="<?= $price['_k1_prijsid'] ?>" price="<?= $totalPriceBanner ?>" quantity="<?= $price['aantal'] ?>"><?= $generic->formatCurrency($totalPriceBanner) ?></a>
        	</li>
        <? } ?>
    <? } ?>
</ul>
</div>