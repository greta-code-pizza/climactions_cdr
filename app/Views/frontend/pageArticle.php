<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/styles/style.css">
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <title>Page des Articles</title>
</head>

<body>

    <h1>article exemple pagination</h1>

    <section id="bar-search">
        <?php
        include_once "layouts/searchbar.php";
        ?>
        <?php
        if (isset($search) && !empty($search) && isset($_GET['search'])) :
        ?>

        <section>
            <h2>Votre recherche</h1>
                <div class="article-container">

                    <?php foreach ($search as $article) {
                        ?>
                    <article>
                        <div>
                            <h2></h2>
                            <p><?= $article['content']; ?></p>
                            <!-- <p><?= $article['theme']; ?></p> -->
                        </div>
                        <a href="index.php?action=article&id=<?= $article['id']; ?>">Voir l'Article</a>
                    </article>
                    <?php }; ?>
                </div>
        </section>


        <?php
        else :
        ?>

        <h1>Les Articles</h1>

        <div class="button-group filters-button-group">
            <button class="button is-checked" data-filter="*">Toutes les catégories</button>
            
            <!-- TO DO : faire une boucle sur les boutons pour afficher les catégories --> 

            <button class="button" data-filter=".game">Jeux</button>
            <button class="button" data-filter=".movie">Films</button>
            <button class="button" data-filter=".book">Livres</button>
        </div>
        <section class="grid">
            <?php foreach ($articles as $article) {
                    ?>

            <div >
                <article class="article-container element-item all <?= $article['description'] ?> " data-category="">
                    <h2 class="title"><?= $article['title'] ?></h2>
                    <p class="content"><?= $article['content']; ?></p>
                    <p class="read-more"><a class="read-more"
                            href="index.php?action=article&id=<?= $article['id']; ?>">Voir l'Article</a></p>
                </article>
            </div>

            <?php }; ?>
        </section>

        <nav id="nav-pagination">
            <ul class="pagination">
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($currentPage == 1) ? "hidden" : "" ?>">
                    <a href="index.php?action=pageArticle&page=<?= htmlspecialchars($currentPage - 1) ?>"
                        class="page-link">Précédente</a>
                </li>
                <?php for ($page = 1; $page <= $pages; $page++) : ?>
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="index.php?action=pageArticle&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
                <?php endfor ?>
                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                <li class="page-item <?= ($currentPage == $pages) ? "hidden" : "" ?>">
                    <a href="index.php?action=pageArticle&page=<?= htmlspecialchars($currentPage + 1) ?>"
                        class="page-link">Suivante</a>
                </li>
            </ul>
        </nav>
        <?php
        endif
        ?>

        <footer>

        </footer>
        <script src="./Public/scripts/main.js"></script>
</body>

</html>