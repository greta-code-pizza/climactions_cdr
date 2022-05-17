<?php ob_start(); ?>

<h1>Les articles</h1>

<!-- TO DO : faire la barre de recherche en javascript -->

<div class="input-control">
    <label for="search">
        <i class="fa-solid fa-magnifying-glass"></i>
    </label>
    <input type="text" name="search" id="search" placeholder="chercher" />
</div>

<h2 class="main-title">Création et mise à jour d'un article</h2>

<span class="btn"><a href="indexAdmin.php?action=createResource">Créer un article</a></span>

<div class="table">
    <h3 class="table-title">Titre</h3>
    <h3 class="table-title">Contenu</h3>
    <h3 class="table-title">Publié le</h3>
    <h3 class="table-title">Action</h3>
</div>

<!-- TO DO : Faire une boucle pour afficher les ressources -->

<div class="table-results">

    <ul class="table-item">
        <li>titre de mon article</li>
        <li class="article-title">contenu de mon article</li>
        <li class="article-created-at">date de création</li>
        <li>
            <span class="btn"><a href="#">Modifier</a></span>
            <span class="btn"><a href="#">Supprimer</a></span>
        </li>
    </ul>

    <ul class="table-item">
        <li>titre de mon article</li>
        <li class="article-title">contenu de mon article</li>
        <li class="article-created-at">date de création</li>
        <li>
            <span class="btn"><a href="#">Modifier</a></span>
            <span class="btn"><a href="#">Supprimer</a></span>
        </li>
    </ul>

</div>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>