<?php
include "inc/configuration.php";
include "inc/class.database.php";

date_default_timezone_set('Europe/Madrid');

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Lungo 2.1 - Example</title>
    <meta name="description" content="">
    <meta name="author" content="Javier Jiménez Villar (@soyjavi)">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="cleartype" content="on">

    <!-- iPhone -->
    <link href="http://cdn.tapquo.com/lungo/icon-57.png" sizes="57x57" rel="apple-touch-icon">
    <link href="http://cdn.tapquo.com/lungo/startup-image-320x460.png" media="(device-width: 320px) and (device-height: 480px)
             and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">

    <!-- iPhone (Retina) -->
    <link href="http://cdn.tapquo.com/lungo/icon-114.png" sizes="114x114" rel="apple-touch-icon">
    <link href="http://cdn.tapquo.com/lungo/startup-image-640x920.png" media="(device-width: 320px) and (device-height: 480px)
             and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

    <!-- iPhone 5 -->
    <link href="http://cdn.tapquo.com/lungo/startup-image-640x1096.png" media="(device-width: 320px) and (device-height: 568px)
             and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

    <!-- iPad -->
    <link href="http://cdn.tapquo.com/lungo/icon-72.png" sizes="72x72" rel="apple-touch-icon">
    <link href="http://cdn.tapquo.com/lungo/startup-image-768x1004.png" media="(device-width: 768px) and (device-height: 1024px)
             and (orientation: portrait)
             and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">
    <link href="http://cdn.tapquo.com/lungo/startup-image-748x1024.png" media="(device-width: 768px) and (device-height: 1024px)
             and (orientation: landscape)
             and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">

    <!-- iPad (Retina) -->
    <link href="http://cdn.tapquo.com/lungo/icon-144.png" sizes="144x144" rel="apple-touch-icon">
    <link href="http://cdn.tapquo.com/lungo/startup-image-1536x2008.png" media="(device-width: 768px) and (device-height: 1024px)
             and (orientation: portrait)
             and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
    <link href="http://cdn.tapquo.com/lungo/startup-image-1496x2048.png" media="(device-width: 768px) and (device-height: 1024px)
             and (orientation: landscape)
             and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="components/lungo/lungo.css">
    <link rel="stylesheet" href="components/lungo/lungo.icon.css">
    <link rel="stylesheet" href="components/lungo/lungo.icon.brand.css">
    <link rel="stylesheet" href="components/lungo/lungo.css">
    <link rel="stylesheet" href="components/lungo/theme.lungo.css">

 <!--   <script type="text/javascript">
        function notificationNew(){
            Lungo.Notification.html("<form class='margined'><label></label><label>Inserta la nueva toma</label><label class='select'><select class='custom'><option value='1'>Instanyl 200 microgramos</option><option value='2'>Paracetamol 1g VO</option><option value='3'>Nolotil VO</option></select></label></form>", "");
        }
    </script>
-->
</head>

<body class="app">
    <section id="main" data-transition="slide">
        <header>
            <nav class="left">
                <a href="#features" data-router="aside" data-icon="menu"></a>
            </nav>
            VanCarPasti
        </header>

        
                <?php
                    $connection = Database::Connect();
                    $query = "SELECT pastilla.nombre FROM pastilla WHERE pastilla.usuarioid = 4 AND pastilla.tipoid=2";
                    $cursor = Database::Reader($query, $connection);
                    while ($row = Database::Read($cursor))
                    {
                        echo "<li><strong>".$row['nombre']."</strong></li>";
                    } 
               ?>
                

        <article id="days-article" class="active list indented scroll">
            <li class="anchor">Junio de 2013</li>
            <?php
                $start=date("d");
                for($i=$start;$i>=1;$i--)
                {
                    echo "<li class=\"arrow\"><a href=\"#items-article-20136$i\" data-router=\"article\"><strong>$i</strong></a></li>";
                }
            ?>
        </article>



    <aside id="features">
        <header data-title="Opciones"></header>
        <article class="active list">
            <ul>
                <li class="current">
                    <a href="#main-article" data-router="article">
                        <strong>Inicio</strong>
                    </a>
                </li>
                <li>
                    <a href="#mounths-article" data-router="article">
                        <strong>Calendario</strong>
                    </a>
                </li>
            </ul>
        </article>
    </aside>

    <!-- Lungo - Dependencies -->
    <script src="components/quojs/quo.js"></script>
    <script src="components/lungo/lungo.js"></script>
    <script src="components/mustache.js"></script>
    <!-- Lungo - Sandbox App -->
    <script>
        Lungo.init({
            name: 'example'
        });
        
    </script>
</body>
</html>