Geachte klant,<br>
<br>
Wij stellen het zeer op prijs dat u een bestelling heeft geplaatst bij Postfly.
Hierbij ontvangt u de bevestiging met de gegevens van uw bestelling. <br>
<br>
Uw webbestelnummer is <?php echo $_SESSION['Ordernummer']; ?>.<br>
<br>
<table>
<tr>
<td width="50"><i><b>Nr</b></i></td>
<td width="200"><i><b>Product</b></i></td>
<td width="200"><i><b>Omschrijving</b></i></td>
<td width="100"><i><b>Aantal</b></i></td>
<td width="100"><i><b>Prijs</b></i></td>
</tr>
<?php 
$i=1;
foreach($_SESSION['Orders'] as $order){
?>
<tr>
<td width="50"><?php echo $i; ?></td>
<td width="200"><?php echo $order['class']; ?></td>
<td width="200"><?php echo $order['naam']; ?></td>
<td width="100"><?php echo $order['aantal']; ?></td>
<td width="100"><?php echo $order['prijs']; ?></td>
</tr>
<?php 
$i++;
}
?>
<tr><td></td><td></td><td></td><td></td><td>----------</td></tr>
<tr><td></td><td></td><td></td><td>BTW 21%:</td><td><?php echo $_SESSION['totaal_btw']; ?></td></tr>
<tr><td></td><td></td><td></td><td>Totaal:</td><td><?php echo $_SESSION['totaal']; ?></td></tr>
</table>	
<br>
Voor aanvullende ondersteuning of antwoorden op uw vragen kan u steeds contact met ons opnemen.<br>
<br>
<Br>
Met vriendelijke groet,<br>
Het Postfly.be-team<br>
<b>-----------------------------<br>
POSTFLY<br>
Muizenvenstraat 5<br>
2300 Turnhout<br>
-----------------------------</b><br>
T: +32 14-63 97 97<br>
F: +32 14-42 72 67<br>
E: <a href="mailto:info@postfly.be">info@postfly.be</a><br>
-----------------------------<br>
<a href="http://www.postfly.be">http://www.postfly.be</a><br>
-----------------------------<br>
<br>
<br>
<br>
Uw bestelling is onderworpen aan de algemene verkoopvoorwaarden van Postfly®, <br>
u kan deze opvragen op de volgende emailadres: <a href="mailto:info@postfly.be">info@postfly.be</a>