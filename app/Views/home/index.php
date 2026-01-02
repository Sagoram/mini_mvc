<h1>Bienvenue sur notre E-Commerce</h1>

<p style="margin-bottom: 30px; font-size: 16px;">Découvrez nos meilleurs produits à des prix imbattables.</p>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
    <?php foreach ($products as $product): ?>
        <div style="border: 1px solid #ddd; padding: 15px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h3><?= htmlspecialchars($product['nom']) ?></h3>
            <p style="color: #666; height: 60px; overflow: hidden;"><?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...</p>
            <p style="font-size: 18px; color: #d32f2f; font-weight: bold; margin: 10px 0;"><?= number_format($product['prix'], 2) ?> €</p>
            <p style="font-size: 12px; color: #999;">Stock : <?= $product['stock'] ?></p>
            <a href="/product/<?= $product['id_produit'] ?>" style="display: inline-block; background: #333; color: white; padding: 10px 15px; border-radius: 4px; margin-top: 10px; text-decoration: none;">Voir détail</a>
        </div>
    <?php endforeach; ?>
</div>



