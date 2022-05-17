<?php ob_start(); ?>

<section>

    <h1>Création d'un article</h1>

    <form id="form-create-article" action="indexAdmin.php?action=create" method="post">

        <!-- le type -->
        <div class="item-form">
            <label for="type">Type</label>
            <select id="select-block" name="type" id="type" required>
                <option value="#">Choisir</option>
                <option value="game">Jeu</option>
                <option value="movie">Film</option>
                <option value="book">Livre</option>
                <option value="flyer">Flyer</option>
            </select>
        </div>

        <!-- le titre     -->
        <div class="item-form name">
            <label for="name">Titre</label>
            <input type="text" name="name" id="name" required>
        </div>

        <!-- le contenu -->
        <div class="item-form content">
            <label for="content">Contenu</label>
            <textarea required="required" name="content" id="content" cols="30" rows="8"></textarea>
        </div>

        <!-- la quantité -->
        <div class="item-form quantite">
            <label for="quantite">Quantité</label>
            <input type="number" value="1" min=1 name="quantite" id="quantite" required>
        </div>

        <!-- Ademe -->
        <div class="item-form ademe">
            <label for="ademe">Ademe</label>
            <input class="increase" type="checkbox" name="ademe" id="ademe" required>
        </div>

        <!-- la caution -->
        <div class="item-form caution">
            <label for="caution">Caution</label>
            <input type="text" name="caution" id="caution" required>
        </div>

        <!-- catalogue -->
        <div class="item-form catalogue">
            <label for="catalogue">Catalogue</label>
            <input class="increase" type="checkbox" name="catalogue" id="catalogue" required>
        </div>

        <!-- état -->
        <div class="item-form condition">
            <label for="condition">État</label>
            <select name="condition" id="condition">
                <option value="">Très bon état</option>
                <option value="">Bon état</option>
                <option value="">État correct</option>
            </select>
        </div>

        <!-- le thème  -->
        <div class="item-form type">
            <label for="content">Thème</label>
            <select name="type" id="type">
                <option value="">thème 1</option>
                <option value="">thème 2</option>
                <option value="">thème 3</option>
            </select>
        </div>

        <!-- emplacement -->
        <div class="item-form location">
            <label for="location">Emplacement</label>
            <select name="location" id="location">
                <option value="">rangement 1</option>
                <option value="">rangement 2</option>
                <option value="">rangement 3</option>
            </select>
        </div>

        <!-- validation -->
        <div class="item-form is_validated">
            <label for="is_validated">Validation</label>
            <input class="increase" type="checkbox" name="is_validated" id="is_validated" required>
        </div>

        <!-- éditeur -->
        <div class="item-form  name-editor">
            <label for="name-editor">Éditeur</label>
            <input type="text" name="name-editor" id="name-editor">
        </div>

        <!-- auteur -->
        <div class="item-form name-author">
            <label for="name-author">Auteur</label>
            <input type="text" name="name-author" id="name-author">
        </div>

        <!-- producteur -->
        <div class="item-form name-producer">
            <label for="name-producer">Producteur</label>
            <input type="text" name="name-producer" id="name-producer">
        </div>

        <!-- réalisateur -->
        <div class="item-form name-director">
            <label for="name-director">Réalisateur</label>
            <input type="text" name="name-director" id="name-director">
        </div>

        <!-- format jeu -->
        <div class="item-form format-game">
            <label for="format-game">Format jeu</label>
            <input type="text" name="format-game" id="format-game">
        </div>

        <!-- createur -->
        <div class="item-form name-creator">
            <label for="name-creator">Créateur</label>
            <input type="text" name="name-creator" id="name-creator">
        </div>

        <!-- format flyer -->
        <div class="item-form format-flyer">
            <label for="format-flyer">Format flyer</label>
            <input class="increase" type="checkbox" name="format-flyer" id="format-flyer">
        </div>

        <!-- public -->
        <div class="item-form name-public">
            <label for="name-public">Public</label>
            <select name="name-public" id="name-public">
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
            </select>
        </div>

        <button class="btn" type="submit">Créer l'article</button>
    </form>
</section>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>