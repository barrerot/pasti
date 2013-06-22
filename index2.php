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
    <meta name="apple-mobile-web-app-capable" content="yes">
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

        <article id="second-article" class="list">
            <li class="highlight">
                <strong>
                    A framework for developers who want to design, build and share cross device apps.
                </strong>
            </li>
        </article>
    </section>

    <aside id="features">
        <header data-title="Options"></header>
        <article class="active list">
            <ul>
                <li class="current">
                    <a href="#main-article" data-router="article">
                        <strong>Main Article</strong>
                    </a>
                </li>
                <li>
                    <a href="#second-article" data-router="article">
                        <strong>Second Article</strong>
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

        LoadDataTratamiento();
        LoadDataLastTomas();
    </script>
</body>
</html>