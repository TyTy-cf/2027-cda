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