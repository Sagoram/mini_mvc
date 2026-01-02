<h1>Créer un compte</h1>

<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="/auth/register" style="max-width: 500px;">
    <div>
        <label for="email"><strong>Email :</strong></label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="nom"><strong>Nom :</strong></label>
        <input type="text" id="nom" name="nom" required>
    </div>
    <div>
        <label for="prenom"><strong>Prénom :</strong></label>
        <input type="text" id="prenom" name="prenom" required>
    </div>
    <div>
        <label for="mdp"><strong>Mot de passe :</strong></label>
        <input type="password" id="mdp" name="mdp" required>
    </div>
    <div>
        <label for="mdp_confirm"><strong>Confirmer le mot de passe :</strong></label>
        <input type="password" id="mdp_confirm" name="mdp_confirm" required>
    </div>
    <div>
        <label for="adresse"><strong>Adresse :</strong></label>
        <input type="text" id="adresse" name="adresse" required>
    </div>
    <button type="submit" style="margin-top: 20px;">S'inscrire</button>
</form>

<p style="margin-top: 20px;"><a href="/auth/login">Déjà inscrit ? Se connecter ici</a></p>
