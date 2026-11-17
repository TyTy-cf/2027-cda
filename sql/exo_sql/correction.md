
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
