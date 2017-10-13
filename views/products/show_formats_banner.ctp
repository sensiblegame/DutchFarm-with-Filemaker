<div class="leftColumnProduct">	
					
		<label><strong>Breedte</strong></label>
		<input id="breedte-banner" minb="<?= $format['formaat_w_min'] ?>" maxb="<?= $format['formaat_w_max'] ?>" name="data[breedte]"> cm
		<br />
		<span class="info">(Tussen <?= $format['formaat_w_min'] ?> - <?= $format['formaat_w_max'] ?>cm)</span>

	</div>
	<div class="rightColumnProduct">
		<label><strong>Hoogte</strong></label>
		<input id="hoogte-banner" minh="<?= $format['formaat_h_min'] ?>" maxh="<?= $format['formaat_h_max'] ?>" name="data[hoogte]"> cm
		<input 
			id="voeg-toe-banner" 
			class="button" 
			type="submit" 
			value="Ok" 
			id_type="<?= $format['_k1_formaatid'] ?>" 
			full_name="<?= $format['formaat_naam_uc'] ?>"
			check_grootte="<?= $format['check_grootte'] ?>"
           check_afloop="<?= $format['check_afloop'] ?>"
           check_kleur="<?= $format['check_kleur'] ?>"
           check_resolutie="<?= $format['check_resolutie'] ?>"
           check_bedrukking="<?= $format['check_bedrukking'] ?>"
			
			>
			<br />
			<span class="info">(Tussen <?= $format['formaat_h_min'] ?> - <?= $format['formaat_h_max'] ?>cm)</span>
	</div>