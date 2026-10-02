# Exercices : API Kaamelott

Documentation de l'API : https://kaamelott.xyz/#api

URL de base de l'API : `https://kaamelott.xyz`

**Contraintes :**

- L'appel à l'API doit passer par la classe `FetchRequest`
- Faire une classe `KaamelottApi` qui reprend les endpoints de l'API, son rôle est de simplifier les appels à l'API, en faisant par exemple :
  - `(new KaamelottApi()).getRandomQuote()` => affiche directement une quote aléatoire
- Les données reçues doivent être typées (pas de `any`), faire les interfaces adéquates
- Si l'appel échoue, un message d'erreur doit être affiché à l'utilisateur

Les résultats doivent être afficher en `console.log` pour le moment

---

## Exercice 1 : Une citation au hasard

Au chargement de la page, on veut afficher une citation aléatoire de Kaamelott, `/api/v1/quote/random`

Pour chaque citation, la page doit afficher :

- le texte de la citation (`content`)
- le nom du personnage qui la prononce (`characts`)
- la saison (le livre) et l'épisode d'où elle est tirée (`season`, `episode`)

À chaque rafraîchissement de la page, une nouvelle citation doit apparaître.

---

## Exercice 2 : intégrer les quotes dans l'HTML


Réutilisez votre classe `KaamelottAPI` afin qu'elle puisse affiche les quotes dans l'HTML, tous les éléments doivent être créés en Typescript et s'ajouter ensuite à l'HTML !

---

## Exercice 3 : Un son aléatoire


Mettre un son aléatoire (`getRandomSound`)



## Exercice 4 : API Country


L'objectif de l'exercice : Faire un "pseudo select" qui affiche le nom du pays avec son drapeau, et met à jour les données affichés en fonction de ce que tape l'utilisateur.


### 4.1 Préparer la classe "APICountry"


- Utiliser le fichier `countries.json` présent dans le dépôt, voici le code pour l'appeler on peut utiliser le `FetchRequest` en passant cette URL : `"src/json/countries.json"`

- Lorsque l'on instancie la classe `APICountry`, on charge tous les pays dans un tableau de Promise d'objet (créer l'interface : `ICountry`, elle représente l'objet pays **complet**)
- Il faut créer une interface pour représenter nos pays dans le selector : ICountrySelector, elle va contenir les attributs suivants :
  - flag
  - name
  - alpha2Code


### 4.2 Utilisation de la classe "APICountry"


- Faire une classe `CountrySelector`
- Elle doit instancier un objet `APICountry` à sa création, tout son fonctionnement repose sur cette classe !
- La classe `CountrySelector` doit faire :
  - Créer l'input et l'ajouter à l'intérieur de l'élément souhaité par le développeur (passer un selector d'élément ? :wink_wink:)
  - (Il faut penser à préparer le "dropdown", c'est-à-dire la liste où les suggestions seront affichés)
  - On affiche pour toutes les suggestions : le drapeau et le nom du pays (le code sert simplement à identifier de manière unique le pays lorsque l'utilisateur clique sur une suggestion)
  - Plusieurs actions doivent être réalisés sur cet input :
    - Au clic dessus : on affiche les 10 premiers pays par ordre alphabétique
    - Lorsque l'utilisateur tape au clavier dans l'input (à partir de 2 caractères), on filtre les suggestions, exemple :
      - S'il tape : "stan"
      - On affiche : "Afghanistan", "Kazaghstan", "Kirghisizistan", etc


### 4.3 Afficher le détail d'un Pays


Au clic sur un 'li' de pays, afficher les informations de celui-ci


- Modifier le CSS pour "montrer" que les 'li' sont cliquables (curosor pointer en css + hover qui change légèrement les couleurs)
- Ajouter l'évènement "click" sur le 'li'
  - Au clic il faudra penser à "cacher" le bloc 'ul'
  - Trouver aussi un moyen de savoir exactement sur quel pays on vient de cliquer ? (data-attribute ?)
  - Afficher les infos du pays dans un bloc HTML en dessous