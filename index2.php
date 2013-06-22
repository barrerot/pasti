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
            <ul>
                <li class="anchor">
                    Tomas periódicas
                </li>
                <li class="anchor">
                    Últimas tomas
                </li>
                <li class="dark">
                    <strong>
                        A framework for developers who want to design, build and share cross device apps.
                    </strong>
                </li>
                <li data-icon="brand html5" class="feature">
                    <strong>HTML5 Optimized Apps</strong>
                    Lungo Framework supports open web standards, such as HTML5, CSS3 and JavaScript. It brings consistent browser environment across mobiles, tvs and desktop devices.
                </li>
                <li data-icon="book" class="feature">
                    <strong>Powerfull JavaScript API</strong>
                    Each new line of code in Lungo is welcome, we hope that Developers and restless minds help us to improve day by day this humble project.
                </li>
                <li data-icon="brand branch" class="feature">
                    <strong>Multi-Device full support</strong>
                    Is known that create apps for each platform is expensive, this situation is increased by the arrival of tablets and SmartTVs. Lungo will suit all of them creating a unique and amazing UX.
                </li>
                <li data-icon="brand github-2" class="feature">
                    <strong>Open Source Project</strong>
                    Each new line of code in Lungo is welcome, we hope that Developers and restless minds help us to improve day by day this humble project.
                </li>
                <li>
                    <a href="https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Flungo.tapquo.com%2F&text=@lungojs a framework for developers who want to design, build and share cross device apps" data-icon="brand twitter" target="_blank" class="button anchor theme" data-label="Tweet me"></a>
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
    <!-- Lungo - Sandbox App -->
    <script>
        Lungo.init({
            name: 'example'
        });
    </script>
</body>
</html>