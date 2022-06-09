<?php ob_start(); ?>

<section>

    <h1>Création d'un article</h1>

    <form id="form-create-article" action="" method="post" enctype="multipart/form-data">

        <!-- le type -->
        <div class="item-form type">
            <label for="type">Type</label>
            <select id="select-block" name="type" id="type" required>
                <option value="#">Choisir</option>
                <!-- <option class="item" value="game">Jeu</option> -->
                <?php foreach($types as $type) {?>
                <option class="item" value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- le titre     -->
        <div class="item-form name">
            <label for="name">Titre</label>
            <input type="text" name="name" id="name" required>
        </div>

        <!-- le thème  -->
        <!-- TO DO : FAIRE UNE BOUCLE -->
        <div class="item-form ">
            <label for="content">Thème</label>
            <select name="type" id="type">
                <!-- <option value="">thème 1</option> -->
                <?php foreach($themes as $theme) {?>
                <option class="item" value="<?= $theme['id'] ?>"><?= $theme['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- l'image -->

        <div class="item-form image">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" required>
        </div>

        <!-- le contenu -->
        <div class="item-form content">
            <p class="content-label">Contenu</p>
            <textarea aria-label="content" required="required" name="editor1" id="editor1" cols="30" rows="8">
            </textarea>
        </div>

        <!-- la quantité -->
        <div class="item-form quantite">
            <label for="quantite">Quantité</label>
            <input type="number" value="1" min=0 name="quantity" id="quantite" required>
        </div>

        <!-- la caution -->
        <div class="item-form caution">
            <label for="caution">Caution</label>
            <input type="text" name="deposit" id="caution" required>
        </div>

        <!-- état -->
        <div class="item-form condition">
            <label for="condition">État</label>
            <select name="condition" id="condition" required>
                <!-- <option value="">Très bon état</option> -->
                <?php foreach($conditions as $condition) {?>
                <option class="item" value="<?= $condition['id'] ?>"><?= $condition['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- ------------------------------------------------- -->

        <!-- staff -->

        <div class="item-form  name-author">
            <label for="name-editor">Contributeur</label>
            <!-- <input type="text" name="personality" id="name-author" required> -->
            <select name="name-author" id="name-author" required>
                <!-- <option value="">Très bon état</option> -->
                <?php foreach($personalities as $personality) {?>
                <option class="item" value="<?= $personality['id'] ?>"><?= $personality['role'] ?> -
                    <?= $personality['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- format jeu -->
        <div class="item-form format-game">
            <label for="format-game">Format jeu</label>
            <select name="type" id="format-game" required>
                <!-- <option value="">Format 1</option> -->
                <?php foreach($formats as $format) {?>
                <option class="item" value="<?= $format['id'] ?>"><?= $format['name'] ?></option>
                <?php } ?>
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
            <select name="name-public" id="name-public">
                <!-- <option value="#">1</option> -->
                <?php foreach($publics as $public) {?>
                <option class="item" value="<?= $public['id'] ?>"><?= $public['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <button class="btn-create" type="submit">Créer un Jeu</button>
    </form>
</section>

<script src="./Public/admin/js/action.js"></script>
<script src="./Public/admin/js/form-categories.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>