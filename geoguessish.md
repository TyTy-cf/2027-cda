User

- id
- email
- username
- password
- createdAt
- displayName
- ?country
- ManyToOne -> Option
- ManyToOne -> Subscription
- OneToMany -> Map
- OneToMany -> Favourite
- OneToMany -> GameScore
- OneToMany -> Friend

Option

- id
- dateFormat
- lenghtUnity
- OneToMany -> User

Favourite

- id
- ManyToOne -> User
- ManyToOne -> Map

Subscription

- id
- name
- price
- OneToMany -> User

Game

- id
- OneToMany -> User
- OneToMany -> GameScore
- OneToMany -> Round

Round

- id
- distance
- timeSpent
- ManyToOne -> Game

GameScore

- id
- score
- ManyToOne -> User
- ManyToOne -> Game

Gamemode

- id
- name
- playerCount
- move true/false

Map

- id
- banner
- name
- description
- difficulty
- size

Friend

- id
- status
- ManyToOne -> User