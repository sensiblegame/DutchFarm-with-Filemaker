<? $count = round((count($formats) /2)); ?>

<div class="leftColumnProduct">
<ul>
	<? for ($i = 0; $i < $count; $i++) { ?>
		<li>
            <a href="#" class="format clearfix" id="<?= $formats[$i]['_k1_formaatid'] ?>"
               preview_big="<?= $asset->url($formats[$i], 'template_groot', true, $formats[$i]['template_filename_uc']) ?>"
               download_template="<?= $asset->url($formats[$i], 'template_download', true, $formats[$i]['template_filename_uc']) ?>"
               check_grootte="<?= $formats[$i]['check_grootte'] ?>"
               check_afloop="<?= $formats[$i]['check_afloop'] ?>"
               check_kleur="<?= $formats[$i]['check_kleur'] ?>"
               check_resolutie="<?= $formats[$i]['check_resolutie'] ?>"
               check_bedrukking="<?= $formats[$i]['check_bedrukking'] ?>"
               detail_1="<?= $asset->url($formats[$i], 'detail_1', true, $formats[$i]['naam'] . '_1') ?>"
               detail_2="<?= $asset->url($formats[$i], 'detail_2', true, $formats[$i]['naam'] . '_2') ?>"
               detail_3="<?= $asset->url($formats[$i], 'detail_3', true, $formats[$i]['naam'] . '_3') ?>"
               detail_4="<?= $asset->url($formats[$i], 'detail_4', true, $formats[$i]['naam'] . '_4') ?>"
               full_name="<?= $formats[$i]['formaat_naam_uc'] ?>">
               <em><?= $formats[$i]['naam'] ?></em> <span><?= $formats[$i]['breedte'] ?> x <?= $formats[$i]['hoogte'] ?></span></a>
        </li>
    
    <? } ?>
</ul>
</div>
<div class="rightColumnProduct">
<ul>
	<? for ($i = $count; $i < count($formats); $i++) { ?>
		<li>
            <a href="#" class="format clearfix" id="<?= $formats[$i]['_k1_formaatid'] ?>"
               preview_big="<?= $asset->url($formats[$i], 'template_groot', true, $formats[$i]['template_filename_uc']) ?>"
               download_template="<?= $asset->url($formats[$i], 'template_download', true, $formats[$i]['template_filename_uc']) ?>"
               check_grootte="<?= $formats[$i]['check_grootte'] ?>"
               check_afloop="<?= $formats[$i]['check_afloop'] ?>"
               check_kleur="<?= $formats[$i]['check_kleur'] ?>"
               check_resolutie="<?= $formats[$i]['check_resolutie'] ?>"
               check_bedrukking="<?= $formats[$i]['check_bedrukking'] ?>"
               detail_1="<?= $asset->url($formats[$i], 'detail_1', true, $formats[$i]['naam'] . '_1') ?>"
               detail_2="<?= $asset->url($formats[$i], 'detail_2', true, $formats[$i]['naam'] . '_2') ?>"
               detail_3="<?= $asset->url($formats[$i], 'detail_3', true, $formats[$i]['naam'] . '_3') ?>"
               detail_4="<?= $asset->url($formats[$i], 'detail_4', true, $formats[$i]['naam'] . '_4') ?>"
               full_name="<?= $formats[$i]['formaat_naam_uc'] ?>">
               <em><?= $formats[$i]['naam'] ?></em> <span><?= $formats[$i]['breedte'] ?> x <?= $formats[$i]['hoogte'] ?></span></a>
        </li>
    
    <? } ?>
</ul>
</div>