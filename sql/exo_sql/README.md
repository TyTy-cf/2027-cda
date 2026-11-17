
# Exo SQL avancé


## View


Faire une vue pour afficher les commandes détaillées :
- On part de Purchase (on affiche tout, sauf les colonnes en FK)
- On affiche email, firstname et lastname du User On affiche l'adresse complète (seulement les colonnes en varchar)
- On affiche le détail des produits de la commande (quantité, prix d'achat et nom de produit)

```sql
CREATE VIEW purchase_v AS 
SELECT 	p.id AS "purchase_id",
	p.number AS "purchase_number",
	p.created_at AS "purchase_created_at",
	p.status AS "purchase_status",
	u.email AS "u_email",
	u.last_name AS "u_lastname",
	u.first_name AS "u_firstname",
	a.last_name AS "a_last_name",
	a.first_name AS "a_firstname",
	a.phone AS "a_phone",
	a.line AS "a_line",
	a.extra_line AS "a_extra_line",
	a.zip_code AS "a_zipcode",
	a.city AS "a_city",
	a.country AS "a_country",
	pr.label AS "product_label",
	pp.quantity AS "pp_quantity",
	pp.price AS "pp_price"

FROM purchase p
JOIN purchase_product pp ON pp.purchase_id = p.id
JOIN product pr ON pr.id = pp.product_id
JOIN address a ON a.id = p.address_id
JOIN user u ON u.id = p.user_id;
```


## Trigger


### 1. Faire un trigger sur la table `purchase_product` qui lorsque l'on ajoute une ligne dans celle-ci, on set automatiquement la colonne price de `purchase_product` au prix du produit ajouté.


```sql
DELIMITER |
DROP TRIGGER IF EXISTS purchase_product_before_insert |
CREATE TRIGGER purchase_product_before_insert BEFORE INSERT
ON purchase_product FOR EACH ROW
BEGIN
     SET NEW.price = (
         SELECT price
         FROM product
         WHERE product.id = NEW.product_id
     );
END |
DELIMITER ;
```


### 2. Faire un trigger qui : lorsque l'on modifie un USER On vérifie si le booléen "is_active" est FALSE (0), si c'est le cas, alors on anonymise les adresses de ce user


```sql
DELIMITER |
DROP TRIGGER IF EXISTS user_before_update |
CREATE TRIGGER user_before_update BEFORE UPDATE
ON user FOR EACH ROW
BEGIN
     IF NEW.is_active = 0 THEN
         UPDATE address
         SET
             city = '*********',
             country = '*********',
             extra_line = NULL,
             first_name = '*********',
             last_name = '*********',
             line = '*********',
             phone = NULL,
             zip_code = '*****'
         WHERE user_id = NEW.id;
         
	SET NEW.first_name = '*********';
        SET NEW.last_name = '*********';
        SET NEW.email = '*********';
        SET NEW.phone = '**********';
     END IF;
END |
DELIMITER ;
```


### 3. Faire un trigger qui met à jour la colonne `update_at` de la table `address`, lorsque l'on fait un update sur celle-ci


Avant de faire ce trigger vous devez passer cette requête :
```sql
ALTER TABLE address
ADD COLUMN update_at DATETIME DEFAULT NULL;
```


## Requêtes préparées


### 1. Faire une requête préparée qui prends en paramètre un ID de purchase et affiche toutes les lignes de purchase_product (en plus de celles de purchase)
> À faire sur HeidiSQL !

```sql
PREPARE select_brand_product FROM 'SELECT * FROM brand JOIN product ON product.brand_id = brand.id WHERE brand.id = ?';
SET @brandId = 20;
EXECUTE select_brand_product USING @brandId;

SET @brandId = 18;
EXECUTE select_brand_product USING @brandId;
```


### 2. Faire une **requête préparée** qui permet de faire un `INSERT into brand`


### 3. Faire une **requête préparée** qui permet de faire un `UPDATE brand`


## Procédures stockées


### 1. Faire une **procédure stockée**qui prend en paramètre un ID de `purchase` et affiche le total de cette commande. Via `purchase_product` on récupère le `price` et on doit le multiplier par `quantity`


### 2. Faire une **procédure stockée** qui prend 0 paramètre et affiche le nombre de commande par utilisateur, trié par quantité (du plus de commande au moins de commande)

```sql
DELIMITER //
DROP PROCEDURE IF EXISTS getPurchaseByUser //
CREATE PROCEDURE getPurchaseByUser()
BEGIN
        SELECT u.first_name, u.last_name, COUNT(p.id) nb_purchases
        FROM user u
        LEFT JOIN purchase p ON u.id = p.user_id
        GROUP BY u.id
        ORDER BY `nb_purchases` DESC;
END //
DELIMITER ;
```

### 3. Faire une **procédure stockée** qui prend 1 paramètre, l'id d'un user, et affiche le nombre de commande par utilisateur et affiche le total de ces commandes


## Requêtes


### 1. Compter les emails des utilisateurs (table `user`) regroupées par domaine (ex: "gmail.com", "yahoo.fr", etc)

```sql
SELECT COUNT(*), SUBSTRING_INDEX(u.email, '@', -1) AS domain
FROM user u
GROUP BY domain;
```

### 2. Afficher par années le nombre d'utilisateur (table `user`) inscrit

```sql
SELECT 	YEAR(created_at) AS annee,
		COUNT(*)
        
FROM user

GROUP BY annee
ORDER BY annee DESC;
```

### 3. Compter les produits (table `product`) étant fait en "Copper"

```sql
SELECT * 
FROM product
WHERE product.label LIKE "%copper%"
OR product.description LIKE "%copper%";
```

### 4. Afficher le/les produits (table `product`) n'ayant jamais été acheté (cela peut être 0 !)

```sql
SELECT *
FROM `product` p
LEFT JOIN purchase_product pp ON pp.product_id = p.id
WHERE pp.id IS NULL;

-- Autre solution
SELECT *
FROM `product` p
WHERE p.id NOT IN (
    SELECT DISTINCT product_id
    FROM purchase_product
);
```

### 5. Afficher le total des commandes (table `purchase`) au format "xx,xx€" - Les montants sont en centimes en base de données

```sql
SELECT
	p.number,
    CONCAT(FORMAT(SUM(pp.price * pp.quantity)/100, 2), '€') AS price

FROM purchase AS p
JOIN purchase_product AS pp ON pp.purchase_id = p.id

GROUP BY p.id 
ORDER BY SUM(pp.price * pp.quantity) DESC;
```

### 6. Afficher le/les adresses (table `address`) n'ayant jamais été utilisé (cela peut être 0 !)

```sql
SELECT a.*
FROM address a
LEFT JOIN purchase p ON p.address_id = a.id
WHERE p.id IS NULL;
```

### 7. Afficher le/les produits (table `product`) avec leur image par défaut (table `image`, colonne `is_default`)

```sql
SELECT p.*, i.path, i.is_default
FROM `product` p
LEFT JOIN image i
	ON i.product_id = p.id AND i.is_default = 1;
```

### 8. Afficher les informations suivantes :
- `user.email`
- `purchase.number`
- `purchase.created_at`
- `address` - concaténation d'une vraie ligne d'adresse (lastname, firstname, line, zipcode, city)
- `total` (total de la commande au format "xx,xx€")
- Trier par `created_at`

```sql
SELECT 	u.email,
          p.number,
          p.created_at,
          CONCAT(a.line, ', ', a.zip_code, ' ', a.city, ' ', a.country),
          CONCAT(FORMAT((SUM(pp.price * pp.quantity)/100),2), '€') AS well_formed_price

FROM purchase AS p

         JOIN `user` AS u ON u.id = p.user_id
         JOIN address AS a ON p.address_id = a.id
         JOIN purchase_product AS pp ON pp.purchase_id = p.id

GROUP BY p.id
ORDER BY p.created_at DESC;
```


### 9. Afficher par marque (table `brand`) le nombre de produits vendus

```sql
SELECT 	b.label,
        COALESCE(SUM(pp.quantity), 0) AS nb_product

FROM brand b
LEFT JOIN product p ON p.brand_id = b.id
LEFT JOIN purchase_product pp ON pp.product_id = p.id

GROUP BY b.id
ORDER BY `nb_product` DESC 
```

### 10. Afficher le ou les produits (table `product`) les plus vendus. Il faut prendre en compte la quantité...

```sql
SELECT product.*, COALESCE(SUM(pp.quantity), 0) AS nbVentes
FROM product
LEFT JOIN purchase_product pp ON pp.product_id = product.id
GROUP BY product.id
HAVING nbVentes = (
    SELECT COALESCE(SUM(pp.quantity), 0) AS nb_product
    FROM product p
    LEFT JOIN purchase_product pp ON pp.product_id = p.id
    GROUP BY p.id
    ORDER BY `nb_product` DESC
    LIMIT 1
);
```

### 11. Compter le nombre d'utilisateur par département (on a le département par les deux premiers chiffres de `address.zipCode`), un utilisateur qui possède plusieurs adresses compte pour 1 pour chaque adresse 
