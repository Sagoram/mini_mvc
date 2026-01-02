<h1>🛒 Panier</h1>

<?php if (empty($cartItems)): ?>
    <p style="padding: 20px; background: #f0f0f0; border-radius: 4px;">Votre panier est vide.</p>
    <a href="/product" style="display: inline-block; margin-top: 20px; background: #333; color: white; padding: 10px 20px; border-radius: 4px;">Continuer les achats</a>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><a href="/product/<?= $item['product']['id_produit'] ?>"><?= htmlspecialchars($item['product']['nom']) ?></a></td>
                    <td><?= number_format($item['product']['prix'], 2) ?> €</td>
                    <td><?= $item['quantity'] ?></td>
                    <td><strong><?= number_format($item['subtotal'], 2) ?> €</strong></td>
                    <td><a href="/cart/remove/<?= $item['product']['id_produit'] ?>" style="color: #d32f2f;">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="text-align: right; margin: 20px 0;">
        <h2>Total : <span style="color: #d32f2f;"><?= number_format($total, 2) ?> €</span></h2>
    </div>

    <div style="display: flex; gap: 10px; margin-top: 20px;">
        <a href="/product" style="background: #f0f0f0; color: #333; padding: 10px 20px; border-radius: 4px;">Continuer les achats</a>
        <a href="/cart/clear" style="background: #d32f2f; color: white; padding: 10px 20px; border-radius: 4px;">Vider le panier</a>
        <?php if (isset($_SESSION['client_id'])): ?>
            <a href="/checkout" style="background: #4CAF50; color: white; padding: 10px 20px; border-radius: 4px;">✓ Passer la commande</a>
        <?php else: ?>
            <a href="/auth/login" style="background: #4CAF50; color: white; padding: 10px 20px; border-radius: 4px;">Connexion requise</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
