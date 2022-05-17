<?php ob_start(); ?>

<h1>Les avis</h1>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>