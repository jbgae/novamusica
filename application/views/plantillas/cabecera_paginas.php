<!DOCTYPE html>
<html lang ="es">
    <head>
        <title>Nova música. Centro de música y danza.- <?= ucfirst($titulo);?></title>
        <link rel="shortcut icon" href="<?=base_url();?>images/logo.ico" type="image/icon"> 
        <link rel="icon" href="<?=base_url();?>images/logo.ico" type="image/icon"> 
	<meta content="Nova música" property="og:site_name">
        <meta content="website" property="og:type">
        <meta content="es_ES" property="og:locale">
        <meta content="Nova música. Chiclana. Academia de música y danza" property="og:title">
        <meta content="Centro de Música y Danza en Chiclana. Clases de Piano, Guitarra, Violín, Canto, Música y movimiento, Ballet, Danza Oriental, Yoga..." property="og:description">
        <meta content="http://novamusica.es" property="og:url">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--ESTILOS-->
        <!--[if lt IE 9]>
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>css/bootstrap.css">
        <!--<link rel="stylesheet" type="text/css" href="<?= base_url();?>css/bootstrap-theme.css">-->

        <?php if(isset($estilo) && $estilo != ''):?>
            <?php if(!is_array($estilo)):?>
                <link rel="stylesheet" type="text/css" href="<?= base_url();?>css/<?= $estilo;?>.css">
            <?php else:?>
                <?php foreach($estilo as $css):?>
                    <link rel="stylesheet" type="text/css" href="<?= base_url();?>css/<?= $css;?>.css">
                <?php endforeach;?>
            <?php endif;?>        
        <?php endif;?>
        
        <!--SCRIPTS-->
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>-->
        <script src="<?= base_url();?>js/jquery.js" type="text/javascript"></script>
        <script src="<?= base_url();?>js/bootstrap.js" type="text/javascript"></script>
        <script src="<?= base_url();?>js/confirmacion.js" type="text/javascript"></script>
        


        <?php if(isset($javascript) && $javascript != ''):?>
            <?php if(!is_array($javascript)):?>
                <script src="<?= base_url();?>js/<?= $javascript;?>.js" type="text/javascript"></script>
            <?php else:?>
                <?php foreach($javascript as $js):?>
                    <script src="<?= base_url();?>js/<?= $js;?>.js" type="text/javascript"></script>
                <?php endforeach;?>
            <?php endif;?>        
        <?php endif;?>
    </head>
    <body> 
        <div id="wrapper">