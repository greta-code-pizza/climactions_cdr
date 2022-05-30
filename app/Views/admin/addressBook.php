<?php ob_start(); ?>

<h1>Carnet d'adresses</h1>

<?php
require_once "app/Views/admin/layouts/search.php";
?>

<div class="table-addressBook">
    <h3 class="table-title-addressBook">Prénom et Nom</h3>
    <h3 class="table-title-addressBook">Email</h3>
    <h3 class="table-title-addressBook">Action</h3>
</div>

<div class="table-results">
<?php foreach ($infos as $info) { ?> 
    <ul class="table-item-addressBook">
        <li><?= $info["firstname"] . " " . $info["lastname"] ?></li>
        <li><?= $info["email"]?></li>
        <li>
            <span class="btn"><a class="delete" href="indexAdmin.php?action=deleteInfo&id=<?= $info['id'] ?>"><i class="fa-solid fa-trash-can"></i></a></span>
        </li>
    </ul> 
<?php }; ?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>