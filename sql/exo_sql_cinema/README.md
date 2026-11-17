# Exo SQL avancé — Billetterie de cinéma

> ⚠️ Deux noms viennent de l'UML et sont des **mots réservés SQL** : ils doivent
> **toujours** être écrits entre backticks → la table `` `order` `` et la colonne `` `row` `` (table `seat`).

![Exam-Classe.drawio.png](../../uml/examen/Exam-Classe.drawio.png)

## Triggers

### 1. Mettre à jour automatiquement la date de modification d'un film

Avant de faire ce trigger vous devez passer cette requête :
```sql
ALTER TABLE movie
ADD COLUMN updated_at DATETIME DEFAULT NULL;
```

Faire un **trigger** `BEFORE UPDATE` sur `movie` qui met automatiquement la colonne `updated_at`
à la date courante à chaque modification de la fiche film (back-office).

### 2. Générer automatiquement le code d'un billet

Faire un **trigger** `BEFORE INSERT` sur `ticket` qui, si la colonne `code` est vide (`NULL` ou `''`),
la remplit automatiquement au format `TCK-<screening_id>-<seat_id>` (ex : `TCK-42-1057`).
- On en profite pour positionner `created_at = NOW()` si aucune date n'est fournie.

### 3. Anonymiser un utilisateur désactivé

Avant de faire ce trigger vous devez passer cette requête :
```sql
ALTER TABLE user
ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1;
```

Faire un **trigger** `BEFORE UPDATE` sur `user` qui : lorsque l'on modifie un utilisateur,
on vérifie si le booléen `is_active` passe à `FALSE` (`0`). Si c'est le cas, on **anonymise** ses données :
- sur la ligne modifiée (`SET NEW.…`) : `first_name`, `last_name` et `email` ;
- sur son adresse (`UPDATE address WHERE id = NEW.address_id`) : `street_name`, `street_number`, `zip_code`, `city`.

---

## Procédures stockées

### 1. Total d'une commande — `getOrderTotal`

Faire une **procédure stockée** qui prend en paramètre un **id de commande** (`order`) et affiche
le **montant total** de cette commande.
- Le prix d'un billet est celui de la **salle** de la séance (`room.price`, via `ticket → screening → room`).
- Afficher le total au format `"xx,xx€"` (les prix sont stockés en **centimes**).
- Sert à la page **panier / confirmation de commande**.

### 2. Places disponibles d'une séance — `getAvailableSeats`

Faire une **procédure stockée** qui prend en paramètre un **id de séance** et affiche le **nombre de places encore disponibles**.
- Disponibles = capacité de la salle (nombre de `seat`) − nombre de billets déjà vendus pour cette séance.
- Sert à l'**API de la page séance** (activer/désactiver le bouton « Réserver »).
- **Bonus** : faire une variante qui **liste les sièges libres** (`row` + `number`) plutôt que de les compter.

### 3. Récapitulatif d'un utilisateur — `getUserSummary`

Faire une **procédure stockée** qui prend en paramètre un **id d'utilisateur** et affiche
son **nombre de commandes** et le **total dépensé** (au format `"xx,xx€"`).
- Sert à l'**espace client** et au back-office marketing.

---

## Transaction

### Réservation atomique de plusieurs places

Avant cet exercice, on protège la base contre la double réservation avec une **contrainte** :
```sql
ALTER TABLE ticket
ADD CONSTRAINT uq_ticket_seat_screening UNIQUE (screening_id, seat_id);
```

Écrire une **transaction** qui réserve plusieurs places pour une même séance :
1. créer une nouvelle ligne dans `` `order` `` pour l'utilisateur ;
2. insérer un `ticket` par siège choisi.

- Tester un scénario qui **réussit** (sièges libres) et un scénario qui **échoue** (au moins un siège déjà vendu).

---

## Requêtes

> L'objectif : écrire les requêtes qui alimentent réellement **les pages du site** et **les réponses JSON de l'API**.

### 1. (Page d'accueil — à l'affiche)
Afficher les films qui ont **au moins une séance à venir** (`started_at >= NOW()`),
avec leur titre, leur durée et le **nombre de séances à venir**. Trier par nombre de séances décroissant.

### 2. (Fiche film — en-tête)
Pour un film donné, afficher son titre, sa durée, son synopsis, la **liste de ses genres** concaténée
sur une seule ligne (ex : `"Science-Fiction, Action, Aventure"`) et le **nom de son réalisateur**.

### 3. (Fiche film — casting)
Pour un film donné, afficher la liste de ses **acteurs** (`staff.name`) avec le **personnage** joué
(`staff_movie.movie_role`). N'afficher que les membres dont le rôle est `actor`.

### 4. (Fiche film — séances)
Pour un film donné, afficher ses **prochaines séances** : date/heure, langue, nom du cinéma et nom de la salle.
Trier par date croissante.

### 5. (Page cinéma — programme)
Pour un cinéma donné, afficher le **programme des séances à venir** : titre du film, date/heure,
salle et langue. Trier par film puis par date.

### 6. (Page séance — plan de salle)
Pour une séance donnée, afficher **tous les sièges de la salle** avec leur statut :
le `row`, le `number`, et `"Occupé"` ou `"Libre"` selon qu'un billet existe ou non pour ce siège sur cette séance.
- Indice : `LEFT JOIN` entre `seat` et `ticket`.

### 7. (Billet / confirmation de commande)
Afficher le **détail d'une commande** : pour chaque billet → titre du film, date de la séance,
cinéma, salle, place (`row` + `number`) et **prix unitaire** au format `"xx,xx€"`.

### 8. (Espace client — mes commandes)
Pour un utilisateur donné, afficher l'**historique de ses commandes** : numéro (id) de commande,
date, **nombre de places** et **montant total** de la commande au format `"xx,xx€"`. Trier par date décroissante.

### 9. (API — top films)
Afficher le **top 10 des films les plus vendus** (en nombre de billets vendus), avec le titre et le total de billets.

### 10. (Dashboard — chiffre d'affaires par cinéma)
Afficher, par **cinéma**, le **chiffre d'affaires** généré (somme des prix des billets vendus),
au format `"xx,xx€"`. Trier du plus gros au plus petit.

### 11. (Dashboard — taux de remplissage)
Afficher, pour chaque séance **passée**, son **taux de remplissage** en pourcentage
(`billets vendus / capacité de la salle * 100`). Afficher film, date et taux. Trier par taux décroissant.

### 12. (Dashboard — CA par genre)
Afficher le **chiffre d'affaires par genre** (`tag`), au format `"xx,xx€"`, trié décroissant.
- Attention : un film ayant plusieurs genres compte dans chacun de ses genres.

### 13. (API — répartition des langues)
Afficher la **répartition des séances par langue** (`VF`, `VO`, `VOSTR`) : la langue et le nombre de séances.

### 14. (Marketing — relance)
Afficher les utilisateurs **n'ayant jamais passé de commande** (peut être 0 !) :
email, nom et prénom. *Cible d'une campagne de relance.*

### 15. (Stat — inscriptions par domaine)
Compter les utilisateurs regroupés par **domaine d'email** (ex : `"gmail.com"`, `"yahoo.fr"`, etc.),
trié du plus fréquent au moins fréquent.

### 16. (Stat — inscriptions par année)
Afficher, par **année**, le nombre d'utilisateurs inscrits (d'après `created_at`).

### 17. (Stat — réalisateurs)
Afficher, par **réalisateur**, le **nombre de films** réalisés (rôle `director`), trié décroissant.

### 18. (Catalogue — films jamais projetés)
Afficher le ou les films qui **n'ont jamais eu de séance** (peut être 0 !).

### 19. (Finance — panier moyen)
Afficher le **panier moyen** : le montant moyen d'une commande, au format `"xx,xx€"`.

### 20. (Back-office — meilleur client)
Afficher le **top 5 des clients** ayant **dépensé le plus** : email, nombre de commandes et total dépensé
au format `"xx,xx€"`. Trier par total décroissant.
