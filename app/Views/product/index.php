<h1>Catalogue des produits</h1>

<div style="display: flex; gap: 30px; margin-bottom: 30px;">
    <div style="flex: 0 0 200px;">
        <h3>Catégories</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="margin: 10px 0;"><a href="/product" style="padding: 8px 12px; display: block; border-radius: 4px; background: #f0f0f0;">Tous les produits</a></li>
            <?php foreach ($categories as $cat): ?>
                <li style="margin: 10px 0;"><a href="/product/category/<?= $cat['id_cat'] ?>" style="padding: 8px 12px; display: block; border-radius: 4px; background: #f0f0f0;"><?= htmlspecialchars($cat['nom']) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div style="flex: 1;">
        <?php if (!empty($currentCategory)): ?>
            <h2><?= htmlspecialchars($currentCategory['nom']) ?></h2>
        <?php endif; ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
            <?php foreach ($products as $product): ?>
                <div style="border: 1px solid #ddd; padding: 15px; background: white; border-radius: 8px;">
                    <h3><?= htmlspecialchars($product['nom']) ?></h3>
                    <p style="color: #666; height: 60px; overflow: hidden;"><?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...</p>
                    <p style="font-size: 18px; color: #d32f2f; font-weight: bold; margin: 10px 0;"><?= number_format($product['prix'], 2) ?> €</p>
                    <p style="font-size: 12px; color: #999;">Stock : <?= $product['stock'] ?></p>
                    <a href="/product/<?= $product['id_produit'] ?>" style="display: inline-block; background: #333; color: white; padding: 10px 15px; border-radius: 4px; margin-top: 10px; text-decoration: none;">Voir détail</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

