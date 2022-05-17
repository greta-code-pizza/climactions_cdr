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

<div class="table">
    <h3 class="table-title">Prénom et Nom</h3>
    <h3 class="table-title">Contenu de l'email</h3>
    <h3 class="table-title">Publié le</h3>
    <h3 class="table-title">Action</h3>
</div>

<!-- TO DO : Faire une boucle pour afficher les emails -->

<div class="table-results">

    <ul class="table-item">
        <li>Ali Gator</li>
        <!-- TO DO : faire une méthode getExcerpt pour le contenu -->
        <li><?= getExcerpt() ?></li>
        <li>date de création</li>
        <li>
            <span class="btn"><a href="indexAdmin.php?action=readEmail">Lire</a></span>
            <span class="btn"><a href="#">Supprimer</a></span>
        </li>
    </ul>

    <ul class="table-item">
        <li>Élise Émoi</li>
        <li>contenu de l'email</li>
        <li>date de création</li>
        <li>
            <span class="btn"><a href="#">Lire</a></span>
            <span class="btn"><a href="#">Supprimer</a></span>
        </li>
    </ul>

</div>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>