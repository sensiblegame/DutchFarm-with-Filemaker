<html>

<head></head>

<body>

    <?= $form->create(false, array('type' => 'post', 'url' => $ogone->submitUrl(), 'id' => 'ogone')) ?>
        <? foreach ($params as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?= addslashes($value) ?>"/>
        <? } ?>
    <?= $form->end() ?>

    <script language="JavaScript" type="text/javascript">
        document.forms[0].submit();
    </script>

</body>

</html>
