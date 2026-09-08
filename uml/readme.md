# UML - 07/09/2026 au 10/09/2026


## 1. Use Case


### 1.1. Gestion d’une bibliothèque


Un client de la bibliothèque peut emprunter un livre, retourner un livre, vérifier la disponibilité d’un livre.


Le libraire peut effectuer les mêmes chose qu’un utilisateur, sauf qu’il peut ajouter d’autres livres dans la bibliothèque.


### 1.2. Gestion site de vente :


- Un utilisateur peut consulter ses messages privés, ou son profil, lorsqu’il est connecté.
- Un utilisateur peut commander des produits sur le site, même s’il n’est pas connecté, cependant il doit se connecter pour payer sa commande.
- L’administrateur peut faire les mêmes actions qu’un utilisateur, mais il peut en plus consulter la liste des commandes.


### 1.3. Cas de l’hôpital :


- Le module de réception d'hôpital prend en charge certaines des nombreuses tâches de réceptionniste d'hôpital.
- La réceptionniste planifie les rendez-vous et l'admission du patient à l'hôpital, cela implique qu’elle ait recueilli les informations du patient à son arrivée.
- Les réceptionnistes peuvent également recevoir les paiements des patients, les enregistrer dans une base de données et fournir des reçus, déposer des réclamations d'assurance et des rapports médicaux.


### 1.4. Système de réservation d'hôtel


**Acteurs** : Client, Réceptionniste

Cas d'utilisation :
- Réaliser une réservation : Le client effectue une réservation d'une chambre d'hôtel.
- Annuler une réservation : Le client annule une réservation existante.
- Vérifier la disponibilité : Le réceptionniste vérifie la disponibilité des chambres.
- Enregistrer une arrivée : Le réceptionniste enregistre l'arrivée d'un client et lui attribue une chambre.
- Gérer les services supplémentaires : Le réceptionniste ajoute ou supprime des services supplémentaires pour une réservation (par exemple, petit-déjeuner, blanchisserie).


## 2. Class diagram


### 2.1. Système de gestion des étudiants


- Considérez un système de gestion des étudiants dans une université
- Les étudiants peuvent s'inscrire à des cours et obtenir leurs notes
- Chaque étudiant a un nom, un numéro d'étudiant unique et une date de naissance
- Chaque cours a un nom, un code unique et un enseignant responsable
- Chaque note est associée à un étudiant, un cours et une valeur numérique


### 2.2 Chess


Détails :

- ChessGame (classe gérant tout le jeu)
  - Elle doit gérer le plateau de jeu

- Board (plateau du jeu)
    - Contient les cases du plateau

- Case (case du plateau)
    - Les propriétés nécessaires à la réalisation d'une case

- Piece (classe représentants toutes les pièces du plateau)
    - Les propriétés relatives à une pièce

Il faut modéliser toutes les pièces du jeu : Pawn (Pion), Rock (Tour), Knight (Cavalier), Bishop (Fou), King (Roi) et Queen (Reine)
