<?php ob_start(); ?>


<?php 
// TO DO : mettre la fonction dans le controller
function getExcerpt()
    {
        // mb_substr retourne un segnement de la chaîne de caractère
        // paramètre la chaîne de caractère, le début de la chaîne et sa fin
		$content = "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit veniam fugit, temporibus facere eum laudantium totam deserunt, tempora rerum sed iusto quibusdam nihil ea iste natus. Dolore neque non ducimus in possimus commodi iusto facilis illo quo reprehenderit hic magnam consequuntur numquam debitis nostrum, expedita architecto quaerat accusantium voluptatem id praesentium eos quisquam eius? Praesentium, ea amet facere totam quae aperiam iure at quisquam rem? Perferendis perspiciatis nam voluptate aliquam quae tempora molestias dolore harum consequatur! Illum, non eius? Saepe cupiditate, adipisci perspiciatis neque sed qui molestias sunt distinctio quo dicta fugit? In assumenda cupiditate laudantium, consequuntur nihil dolorum aut?";	
        return mb_substr($content, 0, 120) . ' ...';
    }
?>

<h1>Les emails</h1>

<?php
require_once "app/Views/admin/layouts/search.php";
?>

<div class="table">
    <h3 class="table-title">Prénom et Nom</h3>
    <h3 class="table-title">Contenu de l'email</h3>
    <h3 class="table-title">Publié le</h3>
    <h3 class="table-title">Action</h3>
</div>

<div class="table-results">
<?php foreach ($emails as $email) { ?>
    
    <ul class="table-item">
        <li><?= $email["firstname"] . " " . $email["lastname"] ?></li>
        <li><?= $email["message"]?></li>
        <li><?= $email["date"]?></li>
        <li class="flex">
            <span class="btn"><a href="indexAdmin.php?action=readEmail&id=<?= $email['id']?>"  title="Lire"><i class="fa-solid fa-eye"></i></a></span>
            <span class="btn"><a class="delete" href="indexAdmin.php?action=deleteEmail&id=<?= $email['id'] ?>" title="Supprimer"><i class="fa-solid fa-trash-can"></i></a></span>
            <span class="btn"><a href="#" title="Ajouter au carnet d'adresse"><i class="fa-solid fa-address-book"></i></a></span>
        </li>
    </ul> 
    
    <?php }; ?>
</div>

<nav id="nav-pagination">
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($currentPage == 1) ? "hidden" : "" ?>">
            <a title="précédent" href="indexAdmin.php?action=emailAdmin&page=<?= htmlspecialchars($currentPage - 1) ?>"
                class="page-link">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
            <a title="page" href="indexAdmin.php?action=emailAdmin&page=<?= $page ?>" class="page-link"><?= $page ?></a>
        </li>
        <?php endfor ?>
        <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
        <li class="page-item <?= ($currentPage == $pages) ? "hidden" : "" ?>">
            <a title="suivant" href="indexAdmin.php?action=emailAdmin&page=<?= htmlspecialchars($currentPage + 1) ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</nav>


<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>