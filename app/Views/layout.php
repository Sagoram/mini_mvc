<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? htmlspecialchars($title) : 'E-Commerce' ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        header { background: #333; color: white; padding: 20px; }
        nav { display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin: 0 15px; }
        nav a:hover { text-decoration: underline; }
        main { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { margin-bottom: 20px; }
        button, input[type="submit"] { background: #333; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 4px; }
        button:hover, input[type="submit"]:hover { background: #555; }
        a { color: #333; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .error { color: red; padding: 10px; margin: 10px 0; background: #ffe6e6; border-radius: 4px; }
        .success { color: green; padding: 10px; margin: 10px 0; background: #e6ffe6; border-radius: 4px; }
        form div { margin: 15px 0; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; }
        form input, form textarea { width: 100%; max-width: 400px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table th, table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        table th { background: #f5f5f5; font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <nav>
            <div style="display: flex; align-items: center;">
                <a href="/" style="font-size: 20px; font-weight: bold; margin-right: 30px;">🛍️ E-Commerce</a>
                <a href="/product">Produits</a>
                <a href="/cart">🛒 Panier</a>
                <?php if (isset($_SESSION['client_id'])): ?>
                    <a href="/order/history">Mes commandes</a>
                <?php endif; ?>
            </div>
            <div>
                <?php if (isset($_SESSION['client_id'])): ?>
                    <span style="margin-right: 20px;">Bonjour, <?= htmlspecialchars($_SESSION['client_prenom']) ?></span>
                    <a href="/auth/logout">Déconnexion</a>
                <?php else: ?>
                    <a href="/auth/login">Connexion</a>
                    <a href="/auth/register">Inscription</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
</body>
</html>

