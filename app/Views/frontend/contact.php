<h1>Formulaire de Contact</h1>

<form action="index.php?action=contactPost" method="POST">
    <div>
        <label for="name">Nom : *</label>
        <input type="text" id="lastname" name="lastname" placeholder="Votre Nom" required />
    </div>
    <div>
        <label for="firstname">Prénom : *</label>
        <input type="text" id="firstname" name="firstname" placeholder="Votre Prénom" required />
    </div>
    <div>
        <label for="email">e-mail : *</label>
        <input type="email" id="email" name="email" placeholder="Votre e-mail" required />
    </div>
    <div>
        <label for="phone">Téléphone : *</label>
        <input type="phone" id="phone" name="phone" placeholder="Votre Numéro de Téléphone" required />
    </div>
    <div>
        <label for="object">Objet : *</label>
        <input type="object" id="object" name="object" placeholder="objet de votre demande" required />
    </div>
    <div>
        <label for="message">Message : *</label>
        <textarea id="message" name="message" placeholder="Votre message" required></textarea>
    </div>
    <div>
        <input type="checkbox" required />
        <label>&nbsp; En soumettant ce formulaire, j'autorise ce site à conserver mes
            données personnelles. Aucune exploitation commerciale ne sera faite des données
            conservées.</label>
    </div>

    <button type="submit">Envoyer</button>
    <p>* Champs obligatoires</p>
</form>