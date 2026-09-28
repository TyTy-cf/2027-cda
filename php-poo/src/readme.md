
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
3. Avec un **getter** et un **setter** pour chaque attribut (encapsulation !)
4. Les setters retournent `static` afin de pouvoir chaîner les appels :

```php
$user = (new User())
    ->setEmail('carter.davis1@example.com')
    ->setNickname('CarterDavis1');
```

5. Pensez aux valeurs par défaut : un `User` a des `roles` vides par défaut, un `Topic` n'a pas de `updatedAt` à sa création, etc.


## Partie 2 : les relations entre objets


1. Les attributs de type objet (`$author`, `$topic`, `$parent`...) représentent déjà un côté des relations. Ajoutez les relations **inverses** sous forme de tableaux, avec des méthodes `add...()` / `remove...()` / `get...()` :
   - `Category` : ses sous-catégories (`getChildren()`, `addChild()`, `removeChild()`)
   - `Topic` : ses commentaires (`getComments()`, `addComment()`, `removeComment()`)
   - `Comment` : ses réponses (`getReplies()`) et ses votes (`getVotes()`)
   - `User` : ses sujets, ses commentaires et ses favoris
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
3. Créez une **interface** `AuthoredInterface` avec les méthodes `getAuthor(): User` et `isAuthor(User $user): bool`, implémentée par toutes les classes possédant un auteur (`Topic`, `Comment`, `Vote`)


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
