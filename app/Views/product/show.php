<h1><?= htmlspecialchars($product['nom']) ?></h1>

<div style="display: flex; gap: 30px; margin: 20px 0;">
    <div style="flex: 1;">
        <p><strong>Prix :</strong> <span style="font-size: 24px; color: #d32f2f;"><?= number_format($product['prix'], 2) ?> €</span></p>
        <p><strong>Stock :</strong> <?= $product['stock'] ?> article(s)</p>
        <h3 style="margin-top: 20px;">Description</h3>
        <p><?= htmlspecialchars($product['description']) ?></p>

        <?php if ($product['stock'] > 0): ?>
            <form method="POST" action="/cart/add/<?= $product['id_produit'] ?>" style="margin-top: 20px;">
                <div>
                    <label for="quantity"><strong>Quantité :</strong></label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>" style="width: 80px;" required>
                </div>
                <button type="submit" style="margin-top: 10px;">🛒 Ajouter au panier</button>
            </form>
        <?php else: ?>
            <p style="color: red; margin-top: 20px; font-weight: bold;">❌ Produit indisponible</p>
        <?php endif; ?>
    </div>
</div>

<a href="/product" style="margin-top: 20px; display: inline-block;">← Retour au catalogue</a>
