1. Pourquoi stocker le prix unitaire dans la table des lignes de commande ?
On stocke le prix dans lignes_commande pour garder le prix réel payé au moment de la commande. Si le prix change après, l’historique des commandes reste correct.

2. Quelle stratégie pour gérer les suppressions ?

Catégorie → Produit : CASCADE, pour ne pas avoir de produits orphelins.
Commande → Lignes : CASCADE, pour supprimer les lignes si la commande est supprimée.
Produit → Lignes : RESTRICT, on ne peut pas supprimer un produit déjà commandé.
Client → Commandes : CASCADE, pour supprimer les commandes si le client est supprimé.

3. Comment gérez-vous les stocks ?

Si un produit est en rupture, le client ne peut pas commander.
Le stock est décrémenté au moment de la validation de la commande, pas au panier ni au paiement, pour éviter les erreurs.

4. Avez-vous prévu des index ?

Oui, sur produits.id_categorie pour filtrer par catégorie et sur commandes.id_client pour retrouver rapidement les commandes d’un client.
Les clés primaires et uniques sont aussi indexées automatiquement.

5. Comment assurez-vous l’unicité du numéro de commande ?

On met une contrainte UNIQUE sur le champ numero_commande et le backend génère des numéros différents pour chaque commande.

6. Quelles extensions possibles du modèle ?

Plusieurs adresses par client.
Historique des prix.
Avis clients.
Plusieurs images par produit.
Gestion des promotions ou suivi plus détaillé des commandes.