<?php ob_start(); ?>

<h1>Les emails</h1>

<div class="table-read-email">
    
    <h3 class="table-title">Contenu de l'email</h3>
</div>

<!-- TO DO : Récupérer l'email grace à son ID -->

<div class="table-results" ">


    <ul id="read-email">
        <li class="username">Ali Gator</li>
        <!-- TO DO : faire une méthode getExcerpt -->
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus corporis sunt magni voluptas sit, doloremque, libero maxime aliquid expedita recusandae fugit nobis, ipsum error sequi fugiat placeat culpa distinctio facere quaerat quisquam in temporibus iure architecto commodi! In at modi ad necessitatibus quidem, quasi optio. Aspernatur laborum neque, incidunt ex doloremque, sequi et, hic aperiam quam quibusdam fugit! Labore tenetur doloremque asperiores, laborum laboriosam ullam nihil, debitis optio voluptatem nemo accusamus? Dolorem velit optio eos quaerat fugit aut magni dolores minus, adipisci fuga quisquam iusto excepturi quod odio quas molestias laboriosam vitae ipsum enim voluptate aspernatur. Vero, adipisci sunt. Facere!</li>
        <li><strong>date du message</strong></li>
        <li>
            <span class="btn"><a href="indexAdmin.php?action=emailAdmin">Revenir</a></span>
            <!-- TO DO : faire une méthode delete() -->
            <span class="btn"><a href="#">Supprimer</a></span>
        </li>

    </ul>
</div>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>