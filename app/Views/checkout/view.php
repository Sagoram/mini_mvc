<h1>Validation de la commande</h1>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Sous-total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cartItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['product']['nom']) ?></td>
                <td><?= number_format($item['product']['prix'], 2) ?> €</td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['subtotal'], 2) ?> €</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div style="text-align: right; margin: 20px 0;">
    <h2>Total : <span style="color: #d32f2f;"><?= number_format($total, 2) ?> €</span></h2>
</div>

<div style="display: flex; gap: 10px; margin-top: 20px;">
    <form method="POST" action="/checkout/process" style="margin: 0;">
        <button type="submit" style="background: #4CAF50; color: white; padding: 12px 30px; border-radius: 4px; font-size: 16px;">✓ Confirmer la commande</button>
    </form>
    <a href="/cart" style="background: #f0f0f0; color: #333; padding: 12px 30px; border-radius: 4px;">← Modifier le panier</a>
</div>
