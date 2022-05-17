<?php

require 'app/Views/frontend/layouts/nav.php';
?>


<section id="container_inscription_admin">
    <h1>Création de l'administrateur</h1>
    
    
    <form id="form_admin" action="indexAdmin.php?action=creatAdmin" method="post">

        <div>
            <label for="lastname"> nom:</label>
            <input type="text" name="lastname" id="lastname" placeholder="Votre nom" required>
        </div>

        <div>
            <label for="firstname"> Prénom:</label>
            <input type="text" name="firstname" id="firstname" placeholder="Votre prénom" required>
        </div>

        <div>
            <label for="email"> email:</label>
            <input type="email" name="email" id="email" placeholder="Votre email" required>
        </div>
        <div>
            <label for="password"> Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
        </div>
       
        <button type="submit">Soumettre</button>
    </form>
</section>


<?php
require 'app/Views/frontend/layouts/footer.php';
?>
