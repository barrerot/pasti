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
    <meta name="author" content="Carlos Barrero Martinez">
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
    <link rel="stylesheet" href="components/lungo/theme.red.css">
</head>

<body class="app">
    <section id="main" data-transition="slide">
        <header>
            <nav class="left">
                <a href="#features" data-router="aside" data-icon="menu"></a>
            </nav>
            <div class="title centered">my pillbox</div>
        </header>

        <article id="main-article" class="active list scroll">
            <ul>
                <li>
                    <a href="#new-toma" data-router="article" class="button">Nueva Toma</a>
                </li>
            </ul>
            <ul id="last_tomas-list">
                <li class="light">
                    Últimas tomas
                </li>
            </ul>
            <ul id="tratamiento-list">
                <li class="light">
                    Tomas periódicas
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

        <article id="edit-toma" class="scroll">
            <form class="margined">

            <input type="text" name="edit-toma-id" id="edit-toma-id" value="00000" style="display:none;">

            <label>Selecciona el día</label>
            <input id="fecha_select" type="date" class="align_right" placeholder="Select finish" value="10/04/1980">

            <label>Selecciona la hora</label>
                <label class="select">
                    <select id="hora_select" class="custom">
                        <option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                    </select>
                </label>
                <label class="select">
                    <select id="minutos_select" class="custom">
                        <option value="00">00</option>
                        <option value="05">05</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                        <option value="35">35</option>
                        <option value="40">40</option>
                        <option value="45">45</option>
                        <option value="50">50</option>
                        <option value="55">55</option>
                    </select>
                </label>
            <a id="editar_button" href="#" class="button anchor" data-label="Editar Toma"></a>
        </form>        
        </article>



        <article id="months-article" class="list scroll">
            <ul>
                <li class="light">2013</li>
<?php
    for($j=$final;$j>=$inicio; $j--)
    {
?>
                <li class="arrow"><a href="#days-article<?php echo $j; ?>" data-router="article"><strong><?php echo $meses[$j-1]; ?> 2013</strong></a></li>
<?php
    }
?>
            </ul>
        </article>
<?php
    for($j=$inicio;$j<=$final; $j++)
    {
?>
        <article id="days-article<?php echo $j; ?>" class="list scroll">
            <ul id="days-list">
                <li class="light"><?php echo $meses[$j-1]; ?> de 2013</li>
            <?php
                if($j == date("n"))
                    $start=date("j");
                else
                    $start = date("t", mktime( 0, 0, 0, $j, 1, 2013));
                for($i=$start;$i>=1;$i--)
                {
                    echo "<li class=\"arrow\"><a href=\"#items-article-2013$j$i\" data-router=\"article\"><strong>$i</strong></a></li>";
                }
            ?>
            </ul>
        </article>

        <?php

            for($i=1;$i<=$start;$i++)
            {
                echo  "<article id=\"items-article-2013$j$i\" class=\"list scroll\"><ul>
                    <li class=\"light\">$i de ".$meses[$j-1]." de 2013</li>
                    <div id=\"items-tomas-day-2013$j$i\">
                    </div>
                </ul></article>";
            }
    }
        ?>
    </section>

    <aside id="features">
        <header data-title="Opciones"></header>
        <article class="active list">
            <ul>
                <li class="current">
                    <a href="#main-article" data-router="article" data-icon="home">
                        <strong>Inicio</strong>
                    </a>
                </li>
                <li>
                    <a href="#months-article" data-router="article" data-icon="calendar">
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
        var url_editarToma = "http://79.125.5.206/rest/editToma.php";
        var url_eliminarToma = "http://79.125.5.206/rest/deleteToma.php";

        LoadDataTratamiento= function() {
        var apiRest, obj,template,html;
        $$('#tratamiento-list').html("<li class='light'>Tomas periódicas</li>");
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
        $$('#last_tomas-list').html("<li class='light'>Últimas tomas</li>");
            apiRest= function() {
                       $$.get(url_tomas,{last_items:10},
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
                                                    <a href='#' class='button small' data-theme='theme.red.css' onclick='delete_toma({{tomaid}})'>Borrar</a>\
                                                </div>\
                                                <div class='right' style='padding-right:5px;'>\
                                                    <a href='#' class='button small' data-theme='theme.red.css' onclick='editar_toma({{tomaid}},"+year+month+day+")'>Editar</a>\
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
            for (var i = 1; i <= 30; i++) {
                LoadDataAllTomas(i,6,2013)
            };
            for (var i = 1; i <= 31; i++) {
                LoadDataAllTomas(i,7,2013)
            };
            for (var i = 1; i <= 30; i++) {
                LoadDataAllTomas(i,8,2013)
            };
        }

        $$('#insertar_button').tap(function(event) { 
 
        var id=$$('#pastilla_select').val();

        Lungo.Notification.confirm({
            icon: 'warning',
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

        $$('#editar_button').tap(function(event) { 
 
        var tid=$$("#edit-toma-id").val();
        var fecha=$$("#fecha_select").val();
        var hora=$$("#hora_select").val();
        var minutos=$$("#minutos_select").val();

        Lungo.Notification.confirm({
            icon: 'warning',
            title: 'Editar Toma',
            description: 'Hola Vane, ¿estás segura que quieres editar esta toma?',
            accept: {
                icon: 'checkmark',
                label: 'Aceptar',
                callback: function(){
                    $$.ajax({
                        type: 'GET', // defaults to 'GET'
                        url: url_editarToma,
                        data: {tomaid: tid, tomafecha: fecha, tomahora: hora, tomaminutos: minutos},
                        dataType: 'text', //'json', 'xml', 'html', or 'text'
                        async: true,
                        success: function(response) { 
                            Refrescar();
                            Lungo.Router.article("edit-toma","months-article"); 
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

        delete_toma = function(id) {
            Lungo.Notification.confirm({
                icon: 'warning',
                title: 'Eliminar Toma',
                description: 'Hola Vane, ¿estás segura que quieres eliminar esta toma?',
                accept: {
                    icon: 'checkmark',
                    label: 'Aceptar',
                    callback: function(){
                        $$.ajax({
                            type: 'GET', // defaults to 'GET'
                            url: url_eliminarToma,
                            data: {tomaid: id},
                            dataType: 'text', //'json', 'xml', 'html', or 'text'
                            async: true,
                            success: function(response) { 
                                Refrescar();
                                //Lungo.Router.article("days-article","months-article"); 
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
        }

        editar_toma = function(tid,fecha) {
            $$("#edit-toma-id").val(""+tid);
            Lungo.Router.article("items-tomas-day-"+fecha,"edit-toma");
        }

        Refrescar();
    </script>
</body>
</html>