# UML - 07/09/2026 au 10/09/2026


## 1. Projet - "Le patrimoine de Vercingétorix"


### 1.1. Récap du besoin


Synthèse du besoin :

AirBnb like, basé sur les propriétés du client.
Les propriétés sont réparties partout dans le monde, pour tout type de catégorie de logement, comme villa, château, gîtes etc

Plusieurs utilisateurs seront sur le site :
- user anonyme
- user connecté
- admin
- gestionnaire


#### Utilisateurs


##### User anonyme


- [x] Regarder la liste des biens
- [x] Se connecter
- [x] S'inscrire
- [x] Filtrer les biens
- [x] Modifier la langue du site
- [x] Regarder le détail d'un bien
- [x] Consulter les CGU
- [x] Effecteur une demande d'assistance pour un logement


##### User connecté


- [x] Effectuer une réservation
- [x] Payer une réservation
- [x] Annuler la réservation
- [x] Consulter la liste des partenaires / services supplémentaires
- [x] Reçoit les newsletters
- [x] Déposer un avis sur sa réservation
- [x] Modifier un avis sur sa réservation
- [x] Se déconnecter
- [x] Ajouter un logement en favoris
- [x] Supprimer un logement en favoris
- [x] Modifier son mot de passe
- [x] Modifier ses infos perso
- [x] Modifier une réservation
- [x] Supprimer son compte et ses données
- [x] Consulter l'historique de ses commandes
- [x] Effectuer une demande de support pour une réservation


##### Gestionnaire


- [x] Consulter les réservations attribuées en cours
- [x] Changer le prix de la caution et/ou du prix journalier
- [x] Modifier les logements attribuées
- [x] Ajouter un logement
- [x] Supprimer un logement
- [x] Consulter un dashboard de ses logements attribués
- [x] Répondre aux demandes de supports
- [x] Consulter les stats
- [x] Exporter ses stats
- [x] Répondre à une demande d'assistance pour une réservation
- [x] Répondre à une demande de support pour un logement
- [x] Peut modérer les avis


##### Admin


- [x] Consulter toutes les réservations en cours
- [x] Consulter un dashboard de ses logement
- [x] Consulter les stats de ses logements
- [x] Consulter les réservations en cours
- [x] Changer le prix de la caution et/ou du prix journalier
- [x] Modifier les logements
- [x] Ajouter un logement
- [x] Supprimer un logement
- [x] Consulter les stats
- [x] Exporter ses stats


#### Contenu des entités métiers


##### Property


- [x] name
- [x] price
- [x] description
- [x] withdrawal (h)
- [x] ?locationOther
- [x] slug
- [x] ManyToOne -> ?Location
- [x] OneToMany -> Media
- [x] OneToMany -> ModifierPrice
- [x] OneToMany -> PropertyCharacteristic
- [x] OneToMany -> Review
- [x] OneToMany -> Extra


##### Location


- [x] country
- [x] city
- [x] zipcode
- [x] streetNumber
- [x] street
- [x] latitude
- [x] longitude


#### ModifierPrice


- [x] ?startedAt
- [x] ?finishedAt
- [ ] amount
- [ ] type (€ or %)
- [x] ManyToOne -> Property


##### CharacteristicLabel


- [x] name
- [x] valueType


##### PropertyCharacteristic


- [x] ManyToOne -> CharacteristicLabel
- [x] ManyToOne -> Property
- [x] value


##### Booking


- [x] createdAt
- [x] updatedAt
- [x] startedAt
- [x] finishedAt
- [x] peopleQty
- [ ] status [PENDING, PAYED, PASSED]


##### Assistance


- [x] ManyToOne -> Booking
- [x] createdAt


##### Support


- [x] ManyToOne -> Property
- [x] createdAt



##### Media


- [x] name
- [x] extension
- [x] size
- [x] ManyToOne -> Property


##### User


- [x] email
- [x] roles **[USER, MANAGER, ADMIN]**
- [x] password
- [x] OneToMany -> Favorite


##### Favorite


- [x] createdAt
- [x] ManyToOne -> Property
- [x] ManyToOne -> User


##### Review


- [x] createdAt
- [x] content
- [x] status [PENDING, VALIDATED, HIDDEN]
- [x] ManyToOne -> Property
- [x] ManyToOne -> User


##### Extra (?)


- [x] name
- [x] description
- [x] price
- [x] ManyToOne -> Property


##### Partner (?)


- [x] name
- [x] description
- [x] price
- [x] ManyToOne -> Property
- [x] ManyToOne -> Location


#### Questions supplémentaires


- Existera t'il un prix variable en fonction du jour de la semaine ? O/N
- Précision sur l'assistance / support
- Confirmer infos sur les users (renseigner à l'inscription)
- Propriétés gérées par un ou plusieurs gestionnaires ?
- Est-ce que les extras sont impactés par la modification des prix ?
- Est-ce que les partenaires sont impactés par la modification des prix ?
- Comment fonctionnent les extras ?
- Comment fonctionnent les partenaires ?
- Newsletter ?
- Réduction à partir d'un nombre de jours ?