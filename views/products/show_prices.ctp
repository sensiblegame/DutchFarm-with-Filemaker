<div>
    <div class="headerColumnProductPrices_firstColumn">
        &nbsp;
    </div>
    <div class="headerColumnProductPrices">
        <?php if (!empty($deliveryinfo[0]['dag_1'])) { ?>
            <span><?= empty($deliveryinfo[0]['dag_1']) ? '?' : $deliveryinfo[0]['dag_1'] ; ?> productiedagen<br/>
            <?= $date->formatDate($deliveryinfo[0]['dag_1_einddatum_finaal']); ?></span>
        <?php } ?>
    </div>
    <div class="headerColumnProductPrices">
        <?php if (!empty($deliveryinfo[0]['dag_2'])) { ?>
            <span><?= empty($deliveryinfo[0]['dag_2']) ? '?' : $deliveryinfo[0]['dag_2'] ; ?> productiedagen<br/>
            <?= $date->formatDate($deliveryinfo[0]['dag_2_einddatum_finaal']); ?></span>
        <?php } ?>
    </div>
    <div class="headerColumnProductPrices">
        <?php if (!empty($deliveryinfo[0]['dag_3'])) { ?>
            <span><?= empty($deliveryinfo[0]['dag_3']) ? '?' : $deliveryinfo[0]['dag_3'] ; ?> productiedagen<br/>
            <?= $date->formatDate($deliveryinfo[0]['dag_3_einddatum_finaal']); ?></span>
        <?php } ?>
    </div>
    <div style="clear:both;"></div>
</div>


<!-- AANTAL -->
<div class="titleColumnProductAantal">
<ul>
    <? foreach ($prices as $price ) { ?>
        <li>
            <p class="title"><?= $price['aantal'] ?> ex</p>
        </li>
    <? } ?>
</ul>
</div>


<!-- PRICES -->
<!-- PRICE 1 -->
<div class="priceColumnProductDelivery">
<ul>
    <? foreach ($prices as $price ) { ?>
        <?php if ((!empty($price['prijs'])) && ($price['prijs'] != "0")) { ?>
        <li>
            <a href="#" class="price clearfix" prijscode = "<?= $price['pr_code']; ?>" levertermijn="1"  id="<?= $price['_k1_prijsid'] ?>" price="<?= $price['prijs'] ?>" quantity="<?= $price['aantal'] ?>"><?= $generic->formatCurrency($price['prijs']) ?></a>
        </li>
        <?php } else { ?>
        <li><a href="#">&nbsp;</a></li>
        <?php } ?>
    <? } ?>
</ul>
</div>

<!-- PRICE 2 -->
<div class="priceColumnProductDelivery">
<?php if (!empty($deliveryinfo[0]['dag_2'])) { ?>
<ul>
<? foreach ($prices as $price ) { ?>
    <?php if ((!empty($price['prijs_2'])) && ($price['prijs_2'] != "0")) { ?>
    <li>
        <a href="#" class="price clearfix" prijscode = "<?= $price['pr_code']; ?>" levertermijn="2"  id="<?= $price['_k1_prijsid'] ?>" price="<?= $price['prijs_2'] ?>" quantity="<?= $price['aantal'] ?>"><?= $generic->formatCurrency($price['prijs_2']) ?></a>
    </li>
    <?php } else { ?>
    <li><a href="#">&nbsp;</a></li>
    <?php } ?>
<? } ?>
</ul>
<?php } ?>
</div>

<!-- PRICE 3 -->
<div class="priceColumnProductDelivery">
<?php if (!empty($deliveryinfo[0]['dag_3'])) { ?>
<ul>
<? foreach ($prices as $price ) { ?>
    <?php if ((!empty($price['prijs_3'])) && ($price['prijs_3'] != "0")) { ?>
    <li>
        <a href="#" class="price clearfix" prijscode = "<?= $price['pr_code']; ?>" levertermijn="3"  id="<?= $price['_k1_prijsid'] ?>" price="<?= $price['prijs_3'] ?>" quantity="<?= $price['aantal'] ?>"><?= $generic->formatCurrency($price['prijs_3']) ?></a>
    </li>
    <?php } else { ?>
    <li><a href="#">&nbsp;</a></li>
    <?php } ?>
<? } ?>
</ul>
<?php } ?>
</div>