<?php ob_start(); ?>

<h1>Carnet d'adresses</h1>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>