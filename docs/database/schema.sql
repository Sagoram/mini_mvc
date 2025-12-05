CREATE TABLE Categories (
    id_cat INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Clients (
    id_clients INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    adresse VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Admin (
    id_admins INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    roles ENUM('admin','super_admin') NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Produits (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    decription TEXT,
    prix DECIMAL(10,2) NOT NULL CHECK (prix > 0),
    stock INT NOT NULL CHECK (stock >= 0),
    image VARCHAR(255),
    disponibilite BOOLEAN DEFAULT TRUE,
    id_cat INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cat) REFERENCES Categories(id_cat)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    INDEX idx_id_cat (id_cat)
);

CREATE TABLE Commandes (
    id_commandes INT AUTO_INCREMENT PRIMARY KEY,
    statu ENUM('en_attente','en_cours','livree','annulee') NOT NULL,
    montant_total DECIMAL(10,2) NOT NULL CHECK (montant_total >= 0),
    adress_livraison VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE passer (
    id_commandes INT NOT NULL,
    id_clients INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_commandes, id_clients),
    FOREIGN KEY (id_commandes) REFERENCES Commandes(id_commandes)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_clients) REFERENCES Clients(id_clients)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Inclure (
    id_produit INT NOT NULL,
    id_commandes INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_produit, id_commandes),
    FOREIGN KEY (id_produit) REFERENCES Produits(id_produit)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_commandes) REFERENCES Commandes(id_commandes)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- 5 catégories
INSERT INTO Categories (nom, description, image) VALUES
('Vélos électriques', 'Vélos à assistance électrique', 'elec.jpg'),
('VTT', 'Vélos tout terrain', 'vtt.jpg'),
('Vélos de ville', 'Vélos urbains', 'ville.jpg'),
('Accessoires', 'Accessoires pour vélos', 'acc.jpg'),
('Enfants', 'Vélos pour enfants', 'kids.jpg');

-- 25 produits répartis dans les catégories
INSERT INTO Produits (nom, decription, prix, stock, image, disponibilite, id_cat) VALUES
('E-Bike 500', 'Vélo électrique puissant', 1200.00, 10, 'ebike500.jpg', TRUE, 1),
('E-Bike 700', 'Vélo électrique autonomie longue', 1500.00, 8, 'ebike700.jpg', TRUE, 1),
('E-Bike City', 'Vélo électrique urbain', 1100.00, 12, 'ebikecity.jpg', TRUE, 1),
('VTT Pro', 'VTT pour professionnels', 900.00, 5, 'vttpro.jpg', TRUE, 2),
('VTT Junior', 'VTT pour juniors', 450.00, 7, 'vttjunior.jpg', TRUE, 2),
('VTT Trail', 'VTT pour trail', 700.00, 6, 'vtttrail.jpg', TRUE, 2),
('City Classic', 'Vélo de ville classique', 350.00, 15, 'cityclassic.jpg', TRUE, 3),
('City Comfort', 'Vélo de ville confortable', 400.00, 10, 'citycomfort.jpg', TRUE, 3),
('City Speed', 'Vélo de ville rapide', 500.00, 9, 'cityspeed.jpg', TRUE, 3),
('Casque Pro', 'Casque de protection', 50.00, 30, 'casquepro.jpg', TRUE, 4),
('Antivol Max', 'Antivol haute sécurité', 35.00, 25, 'antivolmax.jpg', TRUE, 4),
('Gants Grip', 'Gants pour cyclistes', 20.00, 40, 'gantsgrip.jpg', TRUE, 4),
('Vélo Enfant 12\"', 'Vélo pour enfant 3-5 ans', 120.00, 20, 'enfant12.jpg', TRUE, 5),
('Vélo Enfant 16\"', 'Vélo pour enfant 5-7 ans', 140.00, 18, 'enfant16.jpg', TRUE, 5),
('Vélo Enfant 20\"', 'Vélo pour enfant 7-9 ans', 160.00, 15, 'enfant20.jpg', TRUE, 5),
('Panier vélo', 'Panier pour vélo', 25.00, 22, 'panier.jpg', TRUE, 4),
('Pompe à vélo', 'Pompe portable', 18.00, 35, 'pompe.jpg', TRUE, 4),
('Lumière LED', 'Lumière avant/arrière', 15.00, 50, 'led.jpg', TRUE, 4),
('Bidon sport', 'Bidon pour cycliste', 10.00, 60, 'bidon.jpg', TRUE, 4),
('Sonnette', 'Sonnette vélo', 8.00, 55, 'sonnette.jpg', TRUE, 4),
('VTT Mini', 'VTT pour enfants', 300.00, 10, 'vttmini.jpg', TRUE, 5),
('E-Bike Junior', 'Vélo électrique enfant', 800.00, 5, 'ebikejunior.jpg', TRUE, 5),
('City Mini', 'Vélo de ville enfant', 200.00, 8, 'citymini.jpg', TRUE, 5),
('Gilet réfléchissant', 'Gilet sécurité', 12.00, 40, 'gilet.jpg', TRUE, 4),
('Sacoche vélo', 'Sacoche pour vélo', 22.00, 30, 'sacoche.jpg', TRUE, 4);

-- 5 clients
INSERT INTO Clients (email, nom, prenom, mdp, adresse) VALUES
('alice@example.com', 'Dupont', 'Alice', 'mdp1', '1 rue de Paris'),
('bob@example.com', 'Martin', 'Bob', 'mdp2', '2 avenue Lyon'),
('carol@example.com', 'Durand', 'Carol', 'mdp3', '3 boulevard Nice'),
('david@example.com', 'Petit', 'David', 'mdp4', '4 place Lille'),
('eve@example.com', 'Leroy', 'Eve', 'mdp5', '5 impasse Nantes');

-- 2 administrateurs
INSERT INTO Admin (username, mdp, roles, email) VALUES
('admin1', 'adminpass1', 'admin', 'admin1@smartbike.com'),
('superadmin', 'superpass', 'super_admin', 'superadmin@smartbike.com');

-- 10 commandes
INSERT INTO Commandes (statu, montant_total, adress_livraison) VALUES
('en_attente', 1200.00, '1 rue de Paris'),
('livree', 350.00, '2 avenue Lyon'),
('en_cours', 900.00, '3 boulevard Nice'),
('annulee', 50.00, '4 place Lille'),
('livree', 800.00, '5 impasse Nantes'),
('en_attente', 450.00, '1 rue de Paris'),
('en_cours', 700.00, '2 avenue Lyon'),
('livree', 400.00, '3 boulevard Nice'),
('en_attente', 160.00, '4 place Lille'),
('livree', 140.00, '5 impasse Nantes');

-- Liaisons passer (commandes-clients)
INSERT INTO passer (id_commandes, id_clients) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5), (6, 1), (7, 2), (8, 3), (9, 4), (10, 5);

-- Liaisons Inclure (commandes-produits, exemple)
INSERT INTO Inclure (id_produit, id_commandes) VALUES
(1, 1), (2, 1), (7, 2), (4, 3), (10, 4), (5, 5), (6, 6), (8, 7), (13, 8), (14, 9), (15, 10),
(3, 2), (9, 3), (11, 4), (12, 5), (16, 6), (17, 7), (18, 8), (19, 9), (20, 10);
