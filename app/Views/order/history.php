<h1>📋 Historique de mes commandes</h1>

<?php if (empty($orders)): ?>
    <p style="padding: 20px; background: #f0f0f0; border-radius: 4px;">Vous n'avez pas encore de commandes.</p>
    <a href="/product" style="display: inline-block; margin-top: 20px; background: #333; color: white; padding: 10px 20px; border-radius: 4px;">Découvrir nos produits</a>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Commande #</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?= $order['id'] ?></td>
                    <td><?= number_format($order['montant_total'], 2) ?> €</td>
                    <td><span style="color: #FF9800; font-weight: bold;"><?= htmlspecialchars($order['statut']) ?></span></td>
                    <td><?= $order['created_at'] ?? 'N/A' ?></td>
                    <td><a href="/order/<?= $order['id'] ?>">Voir détail</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="/" style="display: inline-block; margin-top: 20px; background: #f0f0f0; color: #333; padding: 10px 20px; border-radius: 4px;">← Retour à l'accueil</a>
