
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

### 3. Faire une **procédure stockée** qui prend 1 paramètre, l'id d'un user, et affiche le nombre de commande par utilisateur et affiche par commande, le total de ces commandes


## Requêtes


### 1. 