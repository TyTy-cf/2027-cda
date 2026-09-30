# Exercices : API Kaamelott

Documentation de l'API : https://github.com/sin0light/api-kaamelott/

URL de base de l'API : `https://kaamelott.chaudie.re/api`

**Contraintes :**

- L'appel à l'API doit passer par la classe `FetchRequest`
- Faire une classe `KaamelottApi` qui reprend les endpoints de l'API, son rôle est de simplifier les appels à l'API, en faisant par exemple :
  - `(new KaamelottApi()).getRandomQuote()` => affiche directement une quote aléatoire
- Les données reçues doivent être typées (pas de `any`), faire les interfaces adéquates
- Si l'appel échoue, un message d'erreur doit être affiché à l'utilisateur

Les résultats doivent être afficher en `console.log` pour le moment

---

## Exercice 1 : Une citation au hasard

Au chargement de la page, on veut afficher une citation aléatoire de Kaamelott.

Pour chaque citation, la page doit afficher :

- le texte de la citation ;
- le nom du personnage qui la prononce ;
- la saison (le livre) et l'épisode d'où elle est tirée.

À chaque rafraîchissement de la page, une nouvelle citation doit apparaître.

---

## Exercice 2 : Toutes les citations d'un personnage

On reprend l'exercice 1.

Le nom du personnage affiché sous la citation doit devenir cliquable. Lorsqu'on clique dessus, la page doit afficher la liste de **toutes** les citations de ce personnage.

Pour chaque citation de la liste, on retrouve les mêmes informations que dans l'exercice 1 (texte, acteur, saison, épisode).
