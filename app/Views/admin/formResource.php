<?php ob_start(); ?>

<section>

    <h1>Création d'un article</h1>

    <form id="form-create-article" action="" method="post" enctype="multipart/form-data">

        <!-- le type -->
        <div class="item-form type">
            <label for="type">Type</label>
            <select id="select-block" name="type" id="type" >
                <option value="#">Choisir</option>
                <option class="item" value="game">Jeu</option>
                <option class="item" value="movie">Film</option>
                <option class="item" value="book">Livre</option>
                <option class="item" value="expo">Exposition</option>
            </select>
        </div>

        <!-- le titre     -->
        <div class="item-form name">
            <label for="name">Titre</label>
            <input type="text" name="name" id="name" >
        </div>

        <!-- le thème  -->
        <!-- TO DO : FAIRE UNE BOUCLE -->
        <div class="item-form ">
            <label for="theme">Thème</label>
            <select name="theme" id="theme">
                <option value="1">thème 1</option>
                <option value="2">thème 2</option>
                <option value="3">thème 3</option>
            </select>
        </div>

        <!-- l'image -->

        <div class="item-form image">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" >
        </div>

        <!-- le contenu -->
        <div class="item-form content">
            <p class="content-label">Contenu</p>
            <textarea aria-label="content" name="editor1" id="editor1" cols="30" rows="8">
            </textarea>
        </div>

        <!-- la quantité -->
        <div class="item-form quantite">
            <label for="quantite">Quantité</label>
            <input type="number" value="1" min=1 name="quantity" id="quantite" >
        </div>

        <!-- la caution -->
        <div class="item-form caution">
            <label for="caution">Caution</label>
            <input type="number" name="deposit" id="caution" >
        </div>

        <!-- état -->
        <div class="item-form condition">
            <label for="condition">État</label>
            <select name="condition" id="condition" >
                <option value="1">Très bon état</option>
                <option value="2">Bon état</option>
                <option value="3">État correct</option>
            </select>
        </div>

        <!-- ------------------------------------------------- -->

        <!-- staff -->

        <div class="item-form  name-author">
            <label for="name-editor">Auteur</label>
            <input type="text" name="personality" id="name-author" >
        </div>

        <!-- format jeu -->
        <div class="item-form format-game">
            <label for="format-game">Format jeu</label>
            <select name="format-game" id="format-game" >
                <option value="1">Format 1</option>
                <option value="2">Format 2</option>
                <option value="3">Format 3</option>
            </select>
        </div>

        <!-- format expo -->
        <div class="item-form format-expo">
            <label for="format-flyer">Format affiche</label>
            <input class="increase" type="checkbox" name="format-poster" id="format-flyer">
        </div>

        <div class="item-form format-expo">
            <label for="format-flyer">Format panneau</label>
            <input class="increase" type="checkbox" name="format-sign" id="format-flyer">
        </div>

        <!-- pour jeu / livre / film -->

        <!-- public -->
        <div class="item-form name-public">
            <label for="name-public">Public</label>
            <select name="public" id="name-public">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <button class="btn-create" type="submit">Créer un Jeu</button>
    </form>
</section>

<script src="./Public/admin/js/action.js"></script>
<script src="./Public/admin/js/form-categories.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>