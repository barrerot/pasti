<!doctype html>
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
    <section id="main" data-transition="">
        <header>
            <nav class="left">
                <a href="#features" data-router="aside" data-icon="menu"></a>
            </nav>
            Pastillero
        </header>

        <article id="main-article" class="active list indented scroll">
            <ul>
                <li>
                    <a href="#" onclick="alert('jaaaa');" class="button anchor">Nueva Toma</a>
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

        <article id="months-article" class="list indented scroll">
            <ul>
                <li class="arrow"><a href="#days-article" data-router="article"><strong>Junio 2013</strong></a></li>
            </ul>
        </article>

        <article id="days-article" class="list indented scroll">
            <ul id="days-list">
                <li class="anchor">Junio de 2013</li>
            <?php
                $start=date("d");
                for($i=$start;$i>=1;$i--)
                {
                    echo "<li class=\"arrow\"><a href=\"#items-article-20136$i\" data-router=\"article\"><strong>$i</strong></a></li>";
                }
            ?>
            </ul>
        </article>

        <?php
            for($i=1;$i<31;$i++)
            {
                echo  "<article id=\"items-article-20136$i\" class=\"list indented scroll\"><ul>
                    <li class=\"anchor\">$i de Junio de 2013</li>
                    <div id=\"items-tomas-day-20136$i\">
                    </div>
                </ul></article>";
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

        LoadDataTratamiento= function() {
        var apiRest, obj,template,html;
            apiRest= function() {
                       $$.get(url_tratamiento,{},
                            function(api) {
                                obj=api;
                                template="{{#pastillas}}\
                                            <li id='{{pastillaid}}'>\
                                                <strong>{{nombre}}</strong>\
                                            </li>\{{/pastillas}}";

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
            apiRest= function() {
                       $$.get(url_tomas,{day:year+"-"+month+"-"+day},
                            function(api) {
                                obj=api;
                                template="<ul>{{#tomas}}\
                                             <li id='{{tomaid}}'>\
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

        LoadDataTratamiento();
        LoadDataLastTomas();
        for (var i = 1; i < 31; i++) {
            LoadDataAllTomas(i,6,2013)
        };
    </script>
</body>
</html>