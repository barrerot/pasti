<!doctype html>
<?php
include "inc/configuration.php";
include "inc/class.database.php";

date_default_timezone_set('Europe/Madrid');
$inicio = 6;
$final = date("n");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>.:: Pastillero ::.</title>
    <meta name="description" content="">
    <meta name="author" content="Javier Jiménez Villar (@soyjavi)">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="cleartype" content="on">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="components/lungo/lungo.css">
    <link rel="stylesheet" href="components/lungo/lungo.icon.css">
    <link rel="stylesheet" href="components/lungo/lungo.icon.brand.css">
    <link rel="stylesheet" href="components/lungo/lungo.css">
    <link rel="stylesheet" href="components/lungo/theme.lungo.css">
</head>

<body class="app">
    <section id="main" data-transition="slide">
        <header>
            <nav class="left">
                <a href="#features" data-router="aside" data-icon="menu"></a>
            </nav>
            Pastillero
        </header>

        <article id="main-article" class="active list scroll">
            <ul>
                <li>
                    <a href="#new-toma" data-router="article" class="button anchor">Nueva Toma</a>
                </li>
            </ul>
            <ul id="tratamiento-list">
                <li class="anchor">
                    Tomas periódicas
                </li>
            </ul>
            <ul id="last_tomas-list">
                <li class="anchor">
                    Últimas tomas
                </li>
            </ul>
        </article>

        <article id="new-toma" class="scroll">
            <form class="margined">

            <label>Selecciona la pastilla</label>
            <label class="select">
                <select id="pastilla_select" class="custom">
                    <?php
                        $connection = Database::Connect();
                        $query = "select pastillaid, nombre from pastilla where pastilla.usuarioid = 4 AND pastilla.enabled = 1";
                        $cursor = Database::Reader($query, $connection);
                        while ($row = Database::Read($cursor))
                        {
                            echo "<option value='".$row['pastillaid']."'>".$row['nombre']."</option>";
                        }
                    ?>
                </select>
            </label>
            <a id="insertar_button" href="#" class="button anchor" data-label="Insertar Toma"></a>
        </form>        
        </article>
<?php
    for($j=$inicio;$j<=$final; $j++)
    {
?>
        <article id="months-article" class="list scroll">
            <ul>
                <li class="arrow"><a href="#days-article" data-router="article"><strong><?php echo $meses[$j-1]; ?> 2013</strong></a></li>
            </ul>
        </article>
<?php
    }
    for($j=$inicio;$j<=$final; $j++)
    {
?>
        <article id="days-article" class="list scroll">
            <ul id="days-list">
                <li class="anchor"><?php echo $meses[$j-1]; ?> de 2013</li>
            <?php
                $start=date("d");
                for($i=$start;$i>=1;$i--)
                {
                    echo "<li class=\"arrow\"><a href=\"#items-article-2013$j$i\" data-router=\"article\"><strong>$i</strong></a></li>";
                }
            ?>
            </ul>
        </article>

        <?php

            for($i=1;$i<31;$i++)
            {
                echo  "<article id=\"items-article-2013$j$i\" class=\"list scroll\"><ul>
                    <li class=\"anchor\">$i de ".$meses[$j-1]." de 2013</li>
                    <div id=\"items-tomas-day-2013$j$i\">
                    </div>
                </ul></article>";
            }
    }
        ?>
    </section>

    <aside id="features">
        <header data-title="Options"></header>
        <article class="active list">
            <ul>
                <li class="current">
                    <a href="#main-article" data-router="article">
                        <strong>Inicio</strong>
                    </a>
                </li>
                <li>
                    <a href="#months-article" data-router="article">
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

        var url_tomas = "http://79.125.5.206/rest/get_tomas.php";
        var url_tratamiento = "http://79.125.5.206/rest/get_tratamiento.php";
        var url_insertarToma = "http://79.125.5.206/rest/addToma.php";

        LoadDataTratamiento= function() {
        var apiRest, obj,template,html;
        $$('#tratamiento-list').html("<li class='anchor'>Tomas periódicas</li>");
            apiRest= function() {
                       $$.get(url_tratamiento,{},
                            function(api) {
                                obj=api;
                                template="{{#pastillas}}\
                                            <li id='{{pastillaid}}'>\
                                                <strong>{{nombre}}</strong>\
                                            </li>\
                                            {{/pastillas}}";

                                html=Mustache.render(template,obj);
                                $$('#tratamiento-list').append(html); //Aqui es donde se 'pintaría' los datos que estamos consumiendo en JSON
                            }
                            );
                        }
                         apiRest();
                         return {}
        }  

        LoadDataLastTomas= function() {
        var apiRest, obj,template,html;
        $$('#last_tomas-list').html("<li class='anchor'>Últimas tomas</li>");
            apiRest= function() {
                       $$.get(url_tomas,{last_items:5},
                            function(api) {
                                obj=api;
                                template="{{#tomas}}\
                                             <li id='{{tomaid}}'>\
                                                <strong>{{pastilla}}</strong>\
                                                <small>{{date}} - {{time}} hrs.</small>\
                                            </li>\
                                             {{/tomas}}";

                                html=Mustache.render(template,obj);
                                $$("#last_tomas-list").append(html);
                            }
                            );
                        }
                         apiRest();
                         return {}
        }

        LoadDataAllTomas= function(day,month,year) {
        var apiRest, obj,template,html;
        $$('#items-tomas-day-'+year+month+day).html("");
            apiRest= function() {
                       $$.get(url_tomas,{day:year+"-"+month+"-"+day},
                            function(api) {
                                obj=api;
                                template="<ul>{{#tomas}}\
                                             <li id='{{tomaid}}'>\
                                                <div class='right'>\
                                                    <a href='#' class='button small' data-theme='theme.red.css'>Borrar</a>\
                                                </div>\
                                                <strong>{{pastilla}}</strong>\
                                                <small>{{time}} hrs.</small>\
                                            </li>\
                                             {{/tomas}}</ul>";

                                html=Mustache.render(template,obj);
                                $$('#items-tomas-day-'+year+month+day).html(html); //Aqui es donde se 'pintaría' los datos que estamos consumiendo en JSON
                            }
                            );
                        }
                         apiRest();
                         return {}
        }

        Refrescar = function() {
            LoadDataTratamiento();
            LoadDataLastTomas();
            for (var i = 1; i < 31; i++) {
                LoadDataAllTomas(i,6,2013)
            };
        }

        $$('#insertar_button').tap(function(event) { 
 
        var id=$$('#pastilla_select').val();

        Lungo.Notification.confirm({
            icon: 'user',
            title: 'Insertar Toma',
            description: 'Hola Vane, ¿estás segura que quieres añadir esta nueva toma?',
            accept: {
                icon: 'checkmark',
                label: 'Aceptar',
                callback: function(){
                    $$.ajax({
                        type: 'GET', // defaults to 'GET'
                        url: url_insertarToma,
                        data: {pid: id},
                        dataType: 'text', //'json', 'xml', 'html', or 'text'
                        async: true,
                        success: function(response) { 
                            Refrescar();
                            Lungo.Router.article("new-toma","main-article"); 
                        },
                        error: function(xhr, type) { }
                    });
                }
            },
            cancel: {
                icon: 'close',
                label: 'Cancelar',
                callback: function(){ }
            }
        });

    });

        Refrescar();
    </script>
</body>
</html>