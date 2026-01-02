<h1>Détail de la commande #<?= $order['id'] ?></h1>

<div style="background: #f0f0f0; padding: 20px; border-radius: 4px; margin: 20px 0;">
    <p><strong>Numéro de commande :</strong> #<?= $order['id'] ?></p>
    <p><strong>Statut :</strong> <span style="color: #FF9800; font-weight: bold;"><?= htmlspecialchars($order['statut']) ?></span></p>
    <p><strong>Date :</strong> <?= $order['created_at'] ?? 'N/A' ?></p>
</div>

<h2>Articles commandés</h2>

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
        <?php foreach ($orderItems as $item): ?>
            <tr>
                <td><a href="/product/<?= $item['product']['id_produit'] ?>"><?= htmlspecialchars($item['product']['nom']) ?></a></td>
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

<a href="/order/history" style="display: inline-block; margin-top: 20px; background: #333; color: white; padding: 10px 20px; border-radius: 4px;">← Retour à l'historique</a>
