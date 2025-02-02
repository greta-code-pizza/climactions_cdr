<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description ?>">
    <link rel="stylesheet" href="./Public/styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="icon" href="./public/img/favicon.webp" />
    <title><?= $title ?></title>
</head>
<body>
    <header id="bandeau">
        <nav id="navigation-bandeau"  class="container">
            <a href="/"><img src="./Public/img/logo_clim_action.png" alt="logo-climactions"></a>
            <ul id="menu" class="hidden">
                <li><a href="/" class="menu-link">Accueil</a></li>
                <li><a href="index.php?action=pageArticle" class="menu-link">Ressources</a></li>
                <li><a href="index.php?action=contact" class="menu-link">Contact</a></li>
                <li><a href="https://climactions-bretagnesud.bzh/" class="menu-link">Retourner sur le site</a></li>
            </ul>
            <img id="burger" src="./Public/img/burger.png" alt="burger">
        </nav>
    </header>