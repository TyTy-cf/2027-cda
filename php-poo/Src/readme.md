
# TP : Fakeddit, modéliser les entités en PHP natif


- Accès au site : lancer un `php -S localhost:8000` (soyez bien dans un conteneur PHP, `make php` !)
- Accès à la base données : http://localhost:8080`



## Contexte


Fakeddit est un clone simplifié de Reddit. Les utilisateurs publient des **sujets** (topics) classés dans des **catégories**, les **commentent**, **votent** pour les commentaires et ajoutent des sujets en **favoris**.

Les données se trouvent dans le fichier `fakeddit.sql`, à la racine du projet. Votre mission est d'écrire les **classes PHP (sans framework)** qui représentent chacune des tables de cette base.

> Toutes les classes sont à créer dans le dossier `Src/Entity/`, avec **un fichier par classe** (`User.php`, `Topic.php`, etc.), puis à inclure dans `Src/include.php`.


## Les classes à créer


Les attributs sont nommés en camelCase. Un attribut marqué **(peut être nul)** doit être déclaré nullable en PHP (ex : `?DateTime`).

### `User`

| Attribut     | Type                     |
|--------------|--------------------------|
| `$id`        | entier                   |
| `$email`     | chaîne de caractères     |
| `$roles`     | tableau                  |
| `$password`  | chaîne de caractères     |
| `$nickname`  | chaîne de caractères     |
| `$picture`   | chaîne de caractères     |
| `$birthAt`   | date (`DateTime`)        |
| `$createdAt` | date (`DateTime`)        |

### `Category`

| Attribut  | Type                                   |
|-----------|----------------------------------------|
| `$id`     | entier                                 |
| `$name`   | chaîne de caractères                   |
| `$parent` | objet `Category` **(peut être nul)**   |

### `Topic`

| Attribut     | Type                                  |
|--------------|---------------------------------------|
| `$id`        | entier                                |
| `$title`     | chaîne de caractères                  |
| `$content`   | chaîne de caractères                  |
| `$picture`   | chaîne de caractères                  |
| `$createdAt` | date (`DateTime`)                     |
| `$updatedAt` | date (`DateTime`) **(peut être nul)** |
| `$author`    | objet `User`                          |
| `$category`  | objet `Category`                      |

### `Comment`

| Attribut     | Type                                  |
|--------------|---------------------------------------|
| `$id`        | entier                                |
| `$content`   | chaîne de caractères                  |
| `$createdAt` | date (`DateTime`)                     |
| `$updatedAt` | date (`DateTime`) **(peut être nul)** |
| `$author`    | objet `User`                          |
| `$topic`     | objet `Topic`                         |
| `$parent`    | objet `Comment` **(peut être nul)**   |

### `Vote`

| Attribut     | Type                          |
|--------------|-------------------------------|
| `$id`        | entier                        |
| `$value`     | entier (`1` ou `-1`) ; sous forme de constante dans la classe         |
| `$createdAt` | date (`DateTime`)             |
| `$author`    | objet `User`                  |
| `$comment`   | objet `Comment`               |

### `Favorite`

| Attribut     | Type              |
|--------------|-------------------|
| `$id`        | entier            |
| `$createdAt` | date (`DateTime`) |
| `$user`      | objet `User`      |
| `$topic`     | objet `Topic`     |


## Partie 1 : les classes de base


Pour **chacune** des 6 classes listées ci-dessus :

1. Nommée au singulier et en PascalCase : `User`, `Category`, `Topic`, `Comment`, `Vote`, `Favorite`
2. Déclarez **chaque attribut en `private`** et typé
3. Avec un **getter** et un **setter** pour chaque attribut (encapsulation !), en "property hooks"
4. Pensez aux valeurs par défaut : un `User` a des `roles` vides par défaut, un `Topic` n'a pas de `updatedAt` à sa création, etc.


## Partie 2 : les relations entre objets


1. Les attributs de type objet (`$author`, `$topic`, `$parent`...) représentent déjà un côté des relations. Ajoutez les relations **inverses** sous forme de tableaux, avec des méthodes `add...()` / `remove...()` / `get...()` :
   - `Category` : ses sous-catégories (`getChildren()`, `addChild()`, `removeChild()`)
   - `Topic` : ses commentaires (`addComment()`, `removeComment()`)
2. Lorsqu'on ajoute un élément d'un côté de la relation, l'autre côté doit être mis à jour automatiquement :

```php
$topic->addComment($comment);
// $comment->getTopic() doit maintenant retourner $topic !
```


## Partie 3 : factoriser le code commun


Plusieurs classes partagent les mêmes attributs, il faut éviter la duplication :

1. Créez un **trait** `IdTrait` contenant l'attribut `$id` et son getter/setter, puis utilisez-le dans toutes les entités
2. Créez un **trait** `TimestampableTrait` contenant `$createdAt` (initialisé à la date courante dans le constructeur de la classe) et `$updatedAt` (nullable), avec leurs getters/setters
   - Quelles classes l'utilisent entièrement ? Lesquelles n'ont besoin que de `$createdAt` ? Adaptez (un second trait `CreatedAtTrait` est une bonne piste)
3. Créez une **trait** `AuthorTrait` contenant l'attribut `$user` et son getter/setter, puis utilisez-le dans toutes les entités
4. Créez une **interface** `CreatedAtInterface` contenant la méthode `setCreatedAt`


## Partie 4 : les règles métier


Ajoutez les méthodes suivantes :

- `User`
  - `getRoles(): array` retourne **toujours** au minimum `ROLE_USER`, même si le tableau stocké est vide
  - `isAdmin(): bool`
  - `getAge(): int`, calculé à partir de `birthAt`
- `Category`
  - `isRoot(): bool` : vrai si la catégorie n'a pas de parent
- `Topic`
  - `isEdited(): bool` : vrai si le sujet a été modifié
- `Comment`
  - `getScore(): int` : somme des valeurs de ses votes


## Partie 5 : les repositories


Un **repository** est la classe chargée de faire le lien entre la base de données et nos entités : il exécute les requêtes SQL et transforme chaque ligne récupérée en objet PHP.

Le fichier `Src/Repository/AbstractRepository.php` contient déjà toutes les requêtes communes (`fetchAll()`, `fetchById()`, `fetchBy()`, `create()`, `updateById()`, `deleteById()`). Chaque entité aura son propre repository qui en **hérite**.

> Avant de commencer, vérifiez que la base `db_fakeddit` contient bien les données (http://localhost:8080). Sinon, importez-les avec `make db`.

**Dans un premier temps, on ne s'occupe que de `Category`.** Les autres repositories seront faits plus tard.

1. Créez le fichier `Src/Repository/CategoryRepository.php`, avec une classe `CategoryRepository` qui hérite de `AbstractRepository`, puis incluez-le dans `Src/include.php`
2. Le constructeur de `CategoryRepository` ne prend **aucun paramètre**. Il appelle le constructeur parent avec le nom de la base (`db_fakeddit`) et le nom de la table (`category`)
3. Implémentez la méthode abstraite `createObjectByAssocArray(array $array): object`, qui reçoit une ligne SQL sous forme de tableau associatif, par exemple :

```php
[
    'id' => 11,
    'name' => 'Photography',
    'parent_id' => 1,
]
```

   et doit retourner un objet `Category` rempli :
   - `id` et `name` se recopient directement
   - `parent_id` est un entier : s'il n'est pas `null`, récupérez la catégorie parente **via le repository lui-même** (`$this->fetchById(...)`) pour renseigner le parent de l'objet

4. Dans `Src/index.php`, testez votre repository :
   - affichez la liste de **toutes** les catégories (`fetchAll()`), en indiquant pour chacune le nom de sa catégorie parente si elle en a une
   - affichez la catégorie d'id `11` et vérifiez que son parent est bien `Technology`
   - affichez les 5 premières sous-catégories de `Technology` (`fetchBy()`, avec le paramètre `parent_id`)

5. Pour aller plus loin :
   - Que se passe-t-il si on appelle `fetchById(9999)` ? Corrigez le comportement pour que la méthode retourne `null` lorsque la catégorie n'existe pas
   - Ajoutez une méthode `fetchRoots(): array` dans `CategoryRepository`, qui retourne uniquement les catégories sans parent (attention : en SQL, on ne compare pas une valeur à `NULL` avec `=`, mais avec `IS NULL` !)
   - Créez une nouvelle catégorie avec `create()`, modifiez son nom avec `updateById()`, puis supprimez-la avec `deleteById()`


## Partie 6 : afficher les topics


- Dans le `index.php`, afficher sous forme de card "simpliste" les 10 derniers topics
- Cela impliquera de faire :
  - TopicRepository (et ses implémentations nécessaires !)
  - Il y aura peut être un petit piège... (le Topic possède des clés étrangères ? Il faudra les prendre en compte lors de la récupération de l'objet, **PEUT-ÊTRE** faudra t'il faire communiquer les Repository entre eux :wink_wink:)


## Partie 7 : afficher les commentaires d'un topic


- Créer un fichier `topic_show.php` à la racine de `src`
- Il doit récupérer un ID de topic EXISTANT (vérifications à faire) en $_GET
- On va ensuite récupérer ce topic PUIS ses commentaires (faire deux requêtes, car j'ai vraiment la flemme de gérer le cas de figure de la boucle infinie), ces commentaires seront triés de plus récent au moins récent