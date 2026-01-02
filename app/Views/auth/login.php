<h1>Connexion</h1>

<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<form method="POST" action="/auth/login" style="max-width: 500px;">
    <div>
        <label for="email"><strong>Email :</strong></label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="mdp"><strong>Mot de passe :</strong></label>
        <input type="password" id="mdp" name="mdp" required>
    </div>
    <button type="submit" style="margin-top: 20px;">Se connecter</button>
</form>

<p style="margin-top: 20px;"><a href="/auth/register">Pas encore inscrit ? Créer un compte ici</a></p>
