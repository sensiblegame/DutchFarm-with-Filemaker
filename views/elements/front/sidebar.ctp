<!-- sidebar -->
		<aside class="sidebar">
			<!-- cart -->
			<div class="box cart">
				<span class="items"><a href="/cart">Winkelwagen: <var><?php echo $user->orderCount(); ?></var></a></span>
				
				<? if ($user->isLoggedIn()) { ?>
			    	<p>
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
			        <p><a href="/user/orders">Mijn bestellingen</a></p>
			        <p><a href="/profile">Mijn profiel</a></p>
			        <p><a href="/logout">Uitloggen</a></p>
			    <? }else{ ?>
							
				<form action="/login" method="post">
					<div class="input text">
						<label>Login <span>(e-mail adres)</span></label>
						<input type="text" name="data[Email]"/>
					</div>
					<div class="input password">
						<label>Wachtwoord <span><a href="/lostpassword">wachtwoord vergeten?</a></span></label>
						<input type="password" name="data[Wachtwoord]"/>
					</div>
					<div class="clearfix">
						<div class="left new-customer"><a href="/newuser">Nieuwe klant?</a></div>
						<div class="input submit right">
							<input type="submit" value="Login"/>
						</div>
					</div>
				</form>
				
				<?php } ?>
			</div>
			<!-- /cart -->
			
			<?php if(!$shopSidebar){ ?>
			<!-- shipment 
			<div class="box shipment color1">
				<h4>Gratis levering</h4>
				<div class="align-center"><a href="/p/levering"><img src="/img/shipment.gif" alt="Gratis levering"/></a></div>
				<a href="/p/levering">Meer info</a>
			</div>
			 /shipment -->
			<?php }?>
			
			
			
			<?php if(!$shopSidebar){ ?>
			<!-- hotline 
			<div class="box hotline color1">
				<h4>Postfly hotline</h4>
				<span class="phone"><?=$settings['contact_tel']; ?></span>
				
			</div>
			/hotline -->
			<?php } ?>
			
			<?php if(!$shopSidebar){ ?>
			<!-- hotline -->
			<div class="box contact color3">
				<h4>Vragen?</h4>
				<span>Het Postfly team staat steeds ter beschikking! 
				<br/>&nbsp;<img src="/img/ico-mail.gif" alt="mail" /> &nbsp;<a href="mailto:<?= $settings['contact_email'] ?>"><?= $settings['contact_email'] ?></a> 
				<br/>&nbsp;<img src="/img/ico-phone.gif" alt="mail" /> &nbsp;<?= $settings['contact_tel'] ?></span>
				<br/><br/><a href="/contact/us" class="contactBtn">Contacteer ons</a>				
			</div>
			<!-- /hotline -->
			<?php } ?>
			
			<?php if(!$shopSidebar){ ?>
			<!-- newsletter -->
			<a href="/contact/nieuwsbrief" class="box newsletter color3">
				<h4>Nieuwsbrief</h4>
				<span>Schrijf u in voor onze online nieuwsbrief</span>
			</a>
			<!-- /newsletter -->
			<?php } ?>
			
			<?php if(!$shopSidebar){ ?>
			<!-- Over postfly 
			
			<div class="box news color3">
				<h4>Over Postfly</h4>
				<ul>
					<li><a href="/nieuws/"><span>Concept</span></a></li>
					<li><a href="/nieuws/"><span>Referenties</span></a></li>
					<li><a href="/nieuws/"><span>Drukwerk</span></a></li>
					<li><a href="/nieuws/"><span>Sponsoring</span></a></li>
					<li><a href="/nieuws/"><span>Postfly en het milieu</span></a></li>						    
			    </ul>
			 </div>
			
			 /news -->
			<?php } ?>
			
			<?php if($advantages){?>
			<!-- usp -->
			<div class="box usp color3">
				<h4>Voordelen</h4>
				<ul>
					<? foreach ($advantages as $advantage) { ?>
					    <li><?= $advantage['advantage_title'] ?></li>
					<? } ?>
				</ul>
			</div>
			 <!-- /usp -->
			<?php }?>
			
			<?php if(!$shopSidebar){ ?>
			<!-- social -->
			<div class="box social color4">
				<div class="cols percentage clearfix">
				    <? if (!empty($settings['twitter_username'])) { ?>
				    	<div class="first col">
				    		follow us on
							<a href="http://twitter.com/#!/<?= $settings['twitter_username'] ?>" target="_blank"><img src="/img/ico-twitter.gif" alt="Twitter" /></a>
				    	</div>
				    <? } ?>
				
				    <? if (!empty($settings['facebook_link'])) { ?>
				    	<div class="col">	
				    		follow us on
							<a href="<?= $settings['facebook_link'] ?>" target="_blank"><img src="/img/ico-facebook.gif" alt="Facebook" /></a>
						</div>
				    <? } ?>
				</div>
			</div>
			<!-- /social -->
			<?php } ?>
			
			<?php if(!$shopSidebar){ ?>
			<!-- news -->
			
			<div class="box news color3">
				<h4>Nieuws</h4>
				<ul>
					<? for ($i = 1; $i <= 4; $i++) { ?>
						<li>
						    
						    <a href="/nieuws/<?= $news[$i]['news_slug_aec'] ?>"><span><?= $news[$i]['news_title'] ?></span></a>
						</li>						    
				    <? } ?>
			    </ul>
			    <a href="/nieuws">
					<h5>Meer nieuws</h5>
			 	</a>
			 </div>
			
			<!-- /news -->
			<?php } ?>
			
			<?php if(!$shopSidebar){ ?>
			<!-- payments -->
			<div class="box payments color3">
				<span>Betaal veilig online</span>
				<?= $asset->image($settings, 'payment_options_image', array('alt' => 'Betaal veilig online')); ?>
			</div>
			<!-- payments -->
			<?php } ?>
			
			<?php if($shopSidebar){ ?>
			<!--<div class="box basket color1">
				 <div id="price">	
				 	<h4 class="align-center">Prijs</h4>
					 <table cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<th>Prijs</th>
								<td>&euro; <span id="price_subtotal">0,00</span></td>
							</tr>
							<tr>
								<th>Afwerking</th>
								<td>&euro; <span id="price_finishing">0,00</span></td>
							</tr>
							<tr>
								<th>BTW <?= $settings['vat'] * 100 ?>%</th>
								<td>&euro; <span id="price_vat">0,00</span></td>
							</tr>
							<tr class="total">
								<th>Totaal</th>
								<td>&euro; <span id="price_total">0,00</span></td>
							</tr>
						</tbody>
					</table> 
				</div>
				
				
				<form id="cart_add" action="/cart/add" method="post">
					<div class="clearfix">
						<span class="step">5</span>
						<div class="input text">
							<label>Benoem uw drukwerk</label>
							<input id="benoem-uw-drukwerk" name="data[product_name]">
							<span class="caption">(vb.: Beachfestival, &#8230;)</span>
						</div>
					</div>
					<div class="input submit clearfix">
						<input type="hidden" id="data_product_papiersoort" name="data[pr_code]" />
						<input type="hidden" id="data_prijs_subtotaal" name="data[prijs_subtotaal]" />
						<input type="hidden" id="data_prijs_afwerking" name="data[prijs_afwerking]" />
						<input type="hidden" id="data_aantal" name="data[aantal]" />
						<input type="hidden" id="product_finishing" name="data[product_finishing]" />
						<input id="voeg-toe" class="button" type="submit" style="display:none;" value="In winkelwagen">
					</div>
				</form>
			</div>-->
			<?php } ?>
			
			<?php if($shopSidebar){ ?>
			<!-- examples -->
			<div class="box examples color3">
				<ul id="carousel-examples" class="jcarousel-skin-examples">
					<li><a href=""><img id="js-img-example-1" src="" alt=""/></a></li>
					<li><a href=""><img id="js-img-example-2" src="" alt=""/></a></li>
					<li><a href=""><img id="js-img-example-3" src="" alt=""/></a></li>
					<li><a href=""><img id="js-img-example-4" src="" alt=""/></a></li>
				</ul>
				<div class="controls">
					<ul>
						<li><a class="active" href="javascript:;">1</a></li>
						<li><a href="javascript:;">2</a></li>
						<li><a href="javascript:;">3</a></li>
						<li><a href="javascript:;">4</a></li>
					</ul>
				</div>
			</div>
			<!-- /examples -->
			
			<!-- templates -->
			<?php if(!$bannerPage){ ?>
			<div  class="box templates color3"  id="js-box-template">
				<h4>Template</h4>
				<img src="/img/dummy-template-159-221.png" alt="" style="display:none;" id="js-img-template"/>
				<a href="" id="js-download-template" style="display:none;">Download Template</a>
			</div>
			<?php } ?>
			<!-- /templates -->
			
			<div class="box checklist color3">
				<h4 class="align-center">Checklist</h4>
				<div id="checklist"></div>
				<a href="/contact/us">
					<h5>Hulp nodig?</h5>
			 	</a>
			</div>
			<?php } ?>
			
			<?php if($shopSidebar){ ?>
			<!-- social -->
			<div class="box social color4">
				<div class="cols percentage clearfix">
				    <? if (!empty($settings['twitter_username'])) { ?>
				    	<div class="first col">
				    		follow us on
							<a href="http://twitter.com/#!/<?= $settings['twitter_username'] ?>" target="_blank"><img src="/img/ico-twitter.gif" alt="Twitter" /></a>
				    	</div>
				    <? } ?>
				
				    <? if (!empty($settings['facebook_link'])) { ?>
				    	<div class="col">	
				    		follow us on
							<a href="<?= $settings['facebook_link'] ?>" target="_blank"><img src="/img/ico-facebook.gif" alt="Facebook" /></a>
						</div>
				    <? } ?>
				</div>
			</div>
			<!-- /social -->
			<?php } ?>
			
		</aside>
		<!--/sidebar -->