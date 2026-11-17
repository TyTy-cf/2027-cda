-- =====================================================================
--  TP SQL avancé - Billetterie de cinéma
--  Script de création de la base + jeu de données DENSE
--  SGBD cible : MariaDB 12.3 (compatible MySQL 8)
--
--  Volumétrie : 15 cinémas, 50 films, 60 utilisateurs, ~250 séances,
--               ~220 commandes, > 600 tickets.
--
--  Les données "référence" (films, genres, staff) sont écrites à la main
--  pour rester réalistes ; le volume (utilisateurs, salles, sièges,
--  séances, commandes, tickets) est généré par des procédures helper,
--  SUPPRIMÉES en fin de script.
--
--  NB : deux noms viennent de l'UML et sont des mots réservés SQL,
--       ils doivent donc toujours être écrits entre backticks :
--         - la table `order`
--         - la colonne `row` (table seat)
-- =====================================================================

DROP DATABASE IF EXISTS cinema;
CREATE DATABASE cinema CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cinema;

-- =====================================================================
--  1. STRUCTURE
-- =====================================================================

CREATE TABLE address (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    street_name   VARCHAR(255) NOT NULL,
    street_info   VARCHAR(255) DEFAULT NULL,
    street_number VARCHAR(20)  NOT NULL,
    zip_code      VARCHAR(10)  NOT NULL,
    latitude      VARCHAR(30)  DEFAULT NULL,
    longitude     VARCHAR(30)  DEFAULT NULL,
    city          VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE user (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    uuid       CHAR(36)     NOT NULL UNIQUE,
    email      VARCHAR(255) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL,
    birthed_at DATE         DEFAULT NULL,
    created_at DATETIME     NOT NULL,
    address_id INT          DEFAULT NULL,
    CONSTRAINT fk_user_address FOREIGN KEY (address_id) REFERENCES address(id)
) ENGINE=InnoDB;

CREATE TABLE card (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    code                VARCHAR(50)  NOT NULL UNIQUE,
    type                VARCHAR(100) NOT NULL,
    benefit_amount      INT          NOT NULL,
    benefit_amount_type ENUM('€','%') NOT NULL,
    user_id             INT          NOT NULL,
    CONSTRAINT fk_card_user FOREIGN KEY (user_id) REFERENCES user(id)
) ENGINE=InnoDB;

CREATE TABLE cinema (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(150) NOT NULL,
    slug       VARCHAR(150) NOT NULL UNIQUE,
    address_id INT          NOT NULL,
    CONSTRAINT fk_cinema_address FOREIGN KEY (address_id) REFERENCES address(id)
) ENGINE=InnoDB;

CREATE TABLE room (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    name      VARCHAR(100) NOT NULL,
    extra     VARCHAR(100) DEFAULT NULL,       -- ex : "IMAX", "Dolby", "4DX"
    price     INT          NOT NULL,           -- en centimes
    slug      VARCHAR(150) NOT NULL,
    cinema_id INT          NOT NULL,
    CONSTRAINT fk_room_cinema FOREIGN KEY (cinema_id) REFERENCES cinema(id)
) ENGINE=InnoDB;

CREATE TABLE seat (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    `row`   VARCHAR(5) NOT NULL,
    `number` INT       NOT NULL,
    room_id INT        NOT NULL,
    CONSTRAINT fk_seat_room FOREIGN KEY (room_id) REFERENCES room(id)
) ENGINE=InnoDB;

CREATE TABLE movie (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    title        VARCHAR(255) NOT NULL,
    slug         VARCHAR(255) NOT NULL UNIQUE,
    published_at DATETIME     NOT NULL,
    synopsis     TEXT         DEFAULT NULL,
    duration     INT          NOT NULL          -- en minutes
) ENGINE=InnoDB;

CREATE TABLE tag (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE movie_tag (
    movie_id INT NOT NULL,
    tag_id   INT NOT NULL,
    PRIMARY KEY (movie_id, tag_id),
    CONSTRAINT fk_movietag_movie FOREIGN KEY (movie_id) REFERENCES movie(id),
    CONSTRAINT fk_movietag_tag   FOREIGN KEY (tag_id)   REFERENCES tag(id)
) ENGINE=InnoDB;

CREATE TABLE staff (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE staff_movie (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    movie_id   INT          NOT NULL,
    staff_id   INT          NOT NULL,
    role       VARCHAR(50)  NOT NULL,           -- ex : "director", "actor"
    movie_role VARCHAR(150) DEFAULT NULL,       -- personnage joué (pour un acteur)
    CONSTRAINT fk_staffmovie_movie FOREIGN KEY (movie_id) REFERENCES movie(id),
    CONSTRAINT fk_staffmovie_staff FOREIGN KEY (staff_id) REFERENCES staff(id)
) ENGINE=InnoDB;

CREATE TABLE screening (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    started_at DATETIME NOT NULL,
    language   ENUM('VF','VO','VOSTR') NOT NULL,
    movie_id   INT NOT NULL,
    room_id    INT NOT NULL,
    CONSTRAINT fk_screening_movie FOREIGN KEY (movie_id) REFERENCES movie(id),
    CONSTRAINT fk_screening_room  FOREIGN KEY (room_id)  REFERENCES room(id)
) ENGINE=InnoDB;

CREATE TABLE `order` (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    created_at DATETIME NOT NULL,
    user_id    INT NOT NULL,
    CONSTRAINT fk_order_user FOREIGN KEY (user_id) REFERENCES user(id)
) ENGINE=InnoDB;

CREATE TABLE ticket (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    code         VARCHAR(50) NOT NULL UNIQUE,
    created_at   DATETIME NOT NULL,
    order_id     INT NOT NULL,
    screening_id INT NOT NULL,
    seat_id      INT NOT NULL,
    CONSTRAINT fk_ticket_order     FOREIGN KEY (order_id)     REFERENCES `order`(id),
    CONSTRAINT fk_ticket_screening FOREIGN KEY (screening_id) REFERENCES screening(id),
    CONSTRAINT fk_ticket_seat      FOREIGN KEY (seat_id)      REFERENCES seat(id)
) ENGINE=InnoDB;

-- =====================================================================
--  2. DONNÉES DE RÉFÉRENCE (écrites à la main)
-- =====================================================================

-- ---- Adresses des 15 cinémas ----------------------------------------
INSERT INTO address (street_name, street_info, street_number, zip_code, latitude, longitude, city) VALUES
('Rue de la République',  NULL,         '79',  '69002', '45.7640', '4.8357', 'Lyon'),
('Place Bellecour',       'Angle sud',  '12',  '69002', '45.7578', '4.8320', 'Lyon'),
('Cours Charlemagne',     'Confluence', '112', '69002', '45.7407', '4.8166', 'Lyon'),
('Boulevard Poissonnière',NULL,         '1',   '75002', '48.8708', '2.3470', 'Paris'),
('Rue du Quatre Septembre',NULL,        '2',   '75002', '48.8698', '2.3350', 'Paris'),
('Avenue Corentin Cariou',NULL,         '30',  '75019', '48.8966', '2.3870', 'Paris'),
('Allées du Président Wilson', NULL,    '3',   '31000', '43.6045', '1.4490', 'Toulouse'),
('Quai de Paludate',      NULL,         '15',  '33800', '44.8260', '-0.5560','Bordeaux'),
('Rue du Château d''Isenghien', NULL,   '1',   '59160', '50.6440', '3.0010', 'Lille'),
('Avenue Moulin de la Halvêque', NULL,  '5',   '44300', '47.2510', '-1.5160','Nantes'),
('Avenue Jean Médecin',   NULL,         '31',  '06000', '43.7030', '7.2660', 'Nice'),
('Quai des Bateliers',    NULL,         '10',  '67000', '48.5810', '7.7520', 'Strasbourg'),
('Rue du Bourg l''Évesque',NULL,        '20',  '35000', '48.1150', '-1.6900','Rennes'),
('RN8 Plan de Campagne',  NULL,         '1',   '13170', '43.4150', '5.3900', 'Les Pennes-Mirabeau'),
('Le Carré Sénart',       'Centre cial','3',   '77127', '48.6230', '2.5370', 'Lieusaint');

-- ---- 15 cinémas ------------------------------------------------------
INSERT INTO cinema (name, slug, address_id) VALUES
('Gaumont République',       'gaumont-republique',      1),
('Pathé Bellecour',          'pathe-bellecour',         2),
('UGC Confluence',           'ugc-confluence',          3),
('Le Grand Rex',             'le-grand-rex',            4),
('Gaumont Opéra',            'gaumont-opera',           5),
('Pathé La Villette',        'pathe-la-villette',       6),
('Gaumont Wilson',           'gaumont-wilson',          7),
('UGC Ciné Cité Bordeaux',   'ugc-cine-cite-bordeaux',  8),
('Kinepolis Lomme',          'kinepolis-lomme',         9),
('Pathé Atlantis',           'pathe-atlantis',         10),
('Pathé Masséna',            'pathe-massena',          11),
('UGC Ciné Cité Strasbourg', 'ugc-cine-cite-strasbourg',12),
('Gaumont Rennes',           'gaumont-rennes',         13),
('Pathé Plan de Campagne',   'pathe-plan-de-campagne', 14),
('Pathé Carré Sénart',       'pathe-carre-senart',     15);

-- ---- 15 genres -------------------------------------------------------
INSERT INTO tag (name, slug) VALUES
('Science-Fiction', 'science-fiction'),  -- 1
('Drame',           'drame'),            -- 2
('Thriller',        'thriller'),         -- 3
('Animation',       'animation'),        -- 4
('Comédie',         'comedie'),          -- 5
('Action',          'action'),           -- 6
('Policier',        'policier'),         -- 7
('Aventure',        'aventure'),         -- 8
('Fantasy',         'fantasy'),          -- 9
('Guerre',          'guerre'),           -- 10
('Péplum',          'peplum'),           -- 11
('Romance',         'romance'),          -- 12
('Horreur',         'horreur'),          -- 13
('Biopic',          'biopic'),           -- 14
('Famille',         'famille');          -- 15

-- ---- 50 membres du staff --------------------------------------------
--  1-16 + 17-28 : réalisateurs/acteurs "historiques" ; 29-50 : pool élargi
INSERT INTO staff (name, slug) VALUES
('Christopher Nolan',   'christopher-nolan'),      -- 1  (réal)
('Bong Joon-ho',        'bong-joon-ho'),           -- 2  (réal)
('Denis Villeneuve',    'denis-villeneuve'),       -- 3  (réal)
('Jean-Pierre Jeunet',  'jean-pierre-jeunet'),     -- 4  (réal)
('Daniel Kwan',         'daniel-kwan'),            -- 5  (réal)
('Hayao Miyazaki',      'hayao-miyazaki'),         -- 6  (réal)
('Quentin Tarantino',   'quentin-tarantino'),      -- 7  (réal)
('Leonardo DiCaprio',   'leonardo-dicaprio'),      -- 8  (acteur)
('Timothée Chalamet',   'timothee-chalamet'),      -- 9  (acteur)
('Cillian Murphy',      'cillian-murphy'),         -- 10 (acteur)
('Audrey Tautou',       'audrey-tautou'),          -- 11 (acteur)
('Michelle Yeoh',       'michelle-yeoh'),          -- 12 (acteur)
('Christian Bale',      'christian-bale'),         -- 13 (acteur)
('John Travolta',       'john-travolta'),          -- 14 (acteur)
('Song Kang-ho',        'song-kang-ho'),           -- 15 (acteur)
('Matthew McConaughey', 'matthew-mcconaughey'),    -- 16 (acteur)
('George Lucas',        'george-lucas'),           -- 17 (réal)
('Ridley Scott',        'ridley-scott'),           -- 18 (réal)
('Duncan Jones',        'duncan-jones'),           -- 19 (réal)
('Peter Jackson',       'peter-jackson'),          -- 20 (réal)
('James Cameron',       'james-cameron'),          -- 21 (réal)
('Mark Hamill',         'mark-hamill'),            -- 22 (acteur)
('Harrison Ford',       'harrison-ford'),          -- 23 (acteur)
('Russell Crowe',       'russell-crowe'),          -- 24 (acteur)
('Joaquin Phoenix',     'joaquin-phoenix'),        -- 25 (acteur)
('Travis Fimmel',       'travis-fimmel'),          -- 26 (acteur)
('Elijah Wood',         'elijah-wood'),            -- 27 (acteur)
('Sam Worthington',     'sam-worthington'),        -- 28 (acteur)
('Steven Spielberg',    'steven-spielberg'),       -- 29 (réal)
('Martin Scorsese',     'martin-scorsese'),        -- 30 (réal)
('David Fincher',       'david-fincher'),          -- 31 (réal)
('Robert Zemeckis',     'robert-zemeckis'),        -- 32 (réal)
('Damien Chazelle',     'damien-chazelle'),        -- 33 (réal)
('Wes Anderson',        'wes-anderson'),           -- 34 (réal)
('Lana Wachowski',      'lana-wachowski'),         -- 35 (réal)
('Tom Hanks',           'tom-hanks'),              -- 36 (acteur)
('Brad Pitt',           'brad-pitt'),              -- 37 (acteur)
('Morgan Freeman',      'morgan-freeman'),         -- 38 (acteur)
('Keanu Reeves',        'keanu-reeves'),           -- 39 (acteur)
('Natalie Portman',     'natalie-portman'),        -- 40 (acteur)
('Jean Reno',           'jean-reno'),              -- 41 (acteur)
('Omar Sy',             'omar-sy'),                -- 42 (acteur)
('Marion Cotillard',    'marion-cotillard'),       -- 43 (acteur)
('Scarlett Johansson',  'scarlett-johansson'),     -- 44 (acteur)
('Ryan Gosling',        'ryan-gosling'),           -- 45 (acteur)
('Emma Stone',          'emma-stone'),             -- 46 (acteur)
('Samuel L. Jackson',   'samuel-l-jackson'),       -- 47 (acteur)
('Tom Hardy',           'tom-hardy'),              -- 48 (acteur)
('Charlize Theron',     'charlize-theron'),        -- 49 (acteur)
('Jamel Debbouze',      'jamel-debbouze');         -- 50 (acteur)

-- ---- 50 films --------------------------------------------------------
INSERT INTO movie (title, slug, published_at, synopsis, duration) VALUES
('Inception',          'inception',          '2010-07-21 00:00:00', 'Un voleur s''infiltre dans les rêves pour y dérober des secrets.', 148),
('Parasite',           'parasite',           '2019-06-05 00:00:00', 'Une famille modeste s''immisce chez une riche famille.', 132),
('Dune',               'dune',               '2021-09-15 00:00:00', 'Paul Atréides et le destin d''une planète désertique.', 155),
('Oppenheimer',        'oppenheimer',        '2023-07-19 00:00:00', 'L''histoire du père de la bombe atomique.', 180),
('Le Fabuleux Destin d''Amélie Poulain', 'amelie-poulain', '2001-04-25 00:00:00', 'Une Parisienne décide de faire le bien autour d''elle.', 122),
('Interstellar',       'interstellar',       '2014-11-05 00:00:00', 'Des explorateurs traversent un trou de ver pour sauver l''humanité.', 169),
('Everything Everywhere All at Once', 'everything-everywhere', '2022-05-11 00:00:00', 'Une femme explore des univers parallèles.', 139),
('The Dark Knight',    'the-dark-knight',    '2008-08-13 00:00:00', 'Batman affronte le Joker dans une Gotham au bord du chaos.', 152),
('Le Voyage de Chihiro','voyage-de-chihiro', '2002-04-10 00:00:00', 'Une fillette piégée dans un monde d''esprits.', 125),
('Pulp Fiction',       'pulp-fiction',       '1994-10-26 00:00:00', 'Plusieurs histoires criminelles s''entremêlent à Los Angeles.', 154),
('Star Wars, épisode IV : Un nouvel espoir', 'star-wars-un-nouvel-espoir', '1977-10-19 00:00:00', 'Luke Skywalker rejoint la rébellion contre l''Empire.', 121),
('Gladiator',          'gladiator',          '2000-05-17 00:00:00', 'Le général Maximus devient gladiateur pour se venger.', 155),
('Warcraft Begins',    'warcraft-begins',    '2016-05-30 00:00:00', 'Humains et orcs s''affrontent aux portes d''Azeroth.', 123),
('Le Seigneur des Anneaux : La Communauté de l''Anneau', 'lotr-communaute-anneau', '2001-12-19 00:00:00', 'Frodon part détruire l''Anneau unique.', 178),
('Avatar',             'avatar',             '2009-12-16 00:00:00', 'Sur Pandora, un marine se rallie au peuple Na''vi.', 162),
('The Matrix',         'the-matrix',         '1999-06-23 00:00:00', 'Un informaticien découvre que la réalité est une simulation.', 136),
('Forrest Gump',       'forrest-gump',       '1994-10-05 00:00:00', 'La vie extraordinaire d''un homme simple.', 142),
('Fight Club',         'fight-club',         '1999-11-10 00:00:00', 'Un insomniaque fonde un club de combat clandestin.', 139),
('Les Évadés',         'les-evades',         '1995-03-01 00:00:00', 'Un banquier condamné à tort garde espoir en prison.', 142),
('Le Parrain',         'le-parrain',         '1972-09-21 00:00:00', 'La saga d''une famille mafieuse italo-américaine.', 175),
('Titanic',            'titanic',            '1998-01-07 00:00:00', 'Une romance à bord du paquebot condamné.', 195),
('Jurassic Park',      'jurassic-park',      '1993-10-20 00:00:00', 'Un parc de dinosaures ressuscités tourne au cauchemar.', 127),
('Le Roi Lion',        'le-roi-lion',        '1994-11-23 00:00:00', 'Le lionceau Simba doit reconquérir son royaume.', 88),
('Retour vers le futur','retour-vers-le-futur','1985-10-23 00:00:00', 'Un adolescent voyage en 1955 dans une DeLorean.', 116),
('Les Dents de la mer','les-dents-de-la-mer','1975-12-01 00:00:00', 'Un requin terrorise une station balnéaire.', 124),
('Alien',              'alien',              '1979-09-12 00:00:00', 'Un équipage spatial traqué par une créature mortelle.', 117),
('Blade Runner',       'blade-runner',       '1982-09-15 00:00:00', 'Un chasseur de répliquants dans un futur dystopique.', 117),
('Terminator 2',       'terminator-2',       '1991-10-16 00:00:00', 'Un cyborg protège l''enfant qui sauvera l''humanité.', 137),
('Seven',              'seven',              '1996-01-31 00:00:00', 'Deux inspecteurs traquent un tueur des sept péchés.', 127),
('The Truman Show',    'the-truman-show',    '1998-10-28 00:00:00', 'Un homme découvre que sa vie est une émission de télé.', 103),
('La La Land',         'la-la-land',         '2017-01-25 00:00:00', 'Une actrice et un pianiste s''aiment à Los Angeles.', 128),
('Whiplash',           'whiplash',           '2015-01-07 00:00:00', 'Un batteur face à un professeur tyrannique.', 106),
('Joker',              'joker',              '2019-10-09 00:00:00', 'La descente aux enfers d''un comédien raté à Gotham.', 122),
('Mad Max: Fury Road', 'mad-max-fury-road',  '2015-05-14 00:00:00', 'Course-poursuite dans un désert post-apocalyptique.', 120),
('The Grand Budapest Hotel','grand-budapest-hotel','2014-02-26 00:00:00', 'Les aventures d''un concierge d''hôtel légendaire.', 99),
('Django Unchained',   'django-unchained',   '2013-01-16 00:00:00', 'Un esclave affranchi traque des chasseurs de primes.', 165),
('Intouchables',       'intouchables',       '2011-11-02 00:00:00', 'L''amitié entre un aristocrate tétraplégique et son aide.', 112),
('La Haine',           'la-haine',           '1995-05-31 00:00:00', 'Une journée de trois jeunes en banlieue après une émeute.', 98),
('Les Choristes',      'les-choristes',      '2004-03-17 00:00:00', 'Un surveillant transforme des enfants par la chorale.', 97),
('Le Dîner de cons',   'le-diner-de-cons',   '1998-04-15 00:00:00', 'Un éditeur piège un invité naïf lors d''un dîner.', 80),
('Bienvenue chez les Ch''tis','bienvenue-chez-les-chtis','2008-02-27 00:00:00', 'Un directeur de poste muté dans le Nord.', 106),
('Taxi',               'taxi',               '1998-04-08 00:00:00', 'Un chauffeur marseillais aide un policier maladroit.', 86),
('Léon',               'leon',               '1994-09-14 00:00:00', 'Un tueur à gages recueille une fillette orpheline.', 110),
('Le Cinquième Élément','le-cinquieme-element','1997-05-07 00:00:00', 'Un taxi du futur embarque l''élément qui sauvera le monde.', 126),
('Spider-Man: New Generation','spider-man-new-generation','2018-12-12 00:00:00', 'Des Spider-Man de dimensions parallèles s''unissent.', 117),
('Toy Story',          'toy-story',          '1995-11-22 00:00:00', 'Les jouets d''un enfant prennent vie en secret.', 81),
('Là-haut',            'la-haut',            '2009-07-29 00:00:00', 'Un vieil homme s''envole avec sa maison vers l''Amérique du Sud.', 96),
('Coco',               'coco',               '2017-11-29 00:00:00', 'Un garçon voyage au pays des morts pour la musique.', 105),
('WALL-E',             'wall-e',             '2008-06-25 00:00:00', 'Un robot nettoyeur solitaire sur une Terre abandonnée.', 98),
('Le Seigneur des Anneaux : Le Retour du Roi', 'lotr-retour-du-roi', '2003-12-17 00:00:00', 'La bataille finale pour la Terre du Milieu.', 201);

-- ---- Genres des films 1 à 15 (curés) --------------------------------
INSERT INTO movie_tag (movie_id, tag_id) VALUES
(1,1),(1,3),(1,6),
(2,2),(2,3),(2,5),
(3,1),(3,8),
(4,2),(4,3),(4,14),
(5,5),(5,2),(5,12),
(6,1),(6,2),(6,8),
(7,1),(7,5),(7,6),
(8,6),(8,3),(8,7),
(9,4),(9,8),(9,15),
(10,7),(10,2),
(11,1),(11,8),(11,6),
(12,6),(12,2),(12,11),
(13,9),(13,6),(13,8),
(14,9),(14,8),(14,2),
(15,1),(15,8),(15,6);

-- ---- Casting des films 1 à 15 (curé, données réelles) ---------------
INSERT INTO staff_movie (movie_id, staff_id, role, movie_role) VALUES
(1, 1,  'director', NULL), (1, 8,  'actor', 'Dom Cobb'), (1, 10, 'actor', 'Robert Fischer'),
(2, 2,  'director', NULL), (2, 15, 'actor', 'Kim Ki-taek'),
(3, 3,  'director', NULL), (3, 9,  'actor', 'Paul Atreides'),
(4, 1,  'director', NULL), (4, 10, 'actor', 'J. R. Oppenheimer'),
(5, 4,  'director', NULL), (5, 11, 'actor', 'Amélie Poulain'),
(6, 1,  'director', NULL), (6, 16, 'actor', 'Joseph Cooper'),
(7, 5,  'director', NULL), (7, 12, 'actor', 'Evelyn Wang'),
(8, 1,  'director', NULL), (8, 13, 'actor', 'Bruce Wayne / Batman'), (8, 10, 'actor', 'Scarecrow'),
(9, 6,  'director', NULL),
(10,7,  'director', NULL), (10,14, 'actor', 'Vincent Vega'),
(11,17, 'director', NULL), (11,22, 'actor', 'Luke Skywalker'), (11,23, 'actor', 'Han Solo'),
(12,18, 'director', NULL), (12,24, 'actor', 'Maximus'), (12,25, 'actor', 'Commodus'),
(13,19, 'director', NULL), (13,26, 'actor', 'Anduin Lothar'),
(14,20, 'director', NULL), (14,27, 'actor', 'Frodon Sacquet'),
(15,21, 'director', NULL), (15,28, 'actor', 'Jake Sully');

-- =====================================================================
--  3. GÉNÉRATION DU VOLUME (procédures helper, supprimées ensuite)
-- =====================================================================

DELIMITER $$

-- ---- Salles : 3 par cinéma (2 standard + 1 premium) ------------------
DROP PROCEDURE IF EXISTS gen_rooms $$
CREATE PROCEDURE gen_rooms()
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE v_cin INT;
    DECLARE v_std INT;
    DECLARE v_extra VARCHAR(50);
    DECLARE cur CURSOR FOR SELECT id FROM cinema;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    OPEN cur;
    loop_cin: LOOP
        FETCH cur INTO v_cin;
        IF done THEN LEAVE loop_cin; END IF;
        SET v_std   = 1000 + (v_cin % 4) * 100;                       -- 1000..1300
        SET v_extra = ELT((v_cin % 3) + 1, 'IMAX', 'Dolby Cinema', '4DX');
        INSERT INTO room (name, extra, price, slug, cinema_id) VALUES
            ('Salle 1', NULL,    v_std,       CONCAT('c', v_cin, '-salle-1'), v_cin),
            ('Salle 2', NULL,    v_std,       CONCAT('c', v_cin, '-salle-2'), v_cin),
            (CONCAT('Salle ', v_extra), v_extra, v_std + 600, CONCAT('c', v_cin, '-salle-premium'), v_cin);
    END LOOP;
    CLOSE cur;
END $$

-- ---- Sièges : 3 rangs (A,B,C) x 8 places par salle -------------------
DROP PROCEDURE IF EXISTS gen_seats $$
CREATE PROCEDURE gen_seats()
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE v_room INT;
    DECLARE v_r INT;
    DECLARE v_n INT;
    DECLARE cur CURSOR FOR SELECT id FROM room;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    OPEN cur;
    loop_room: LOOP
        FETCH cur INTO v_room;
        IF done THEN LEAVE loop_room; END IF;
        SET v_r = 1;
        WHILE v_r <= 3 DO
            SET v_n = 1;
            WHILE v_n <= 8 DO
                INSERT INTO seat (`row`, `number`, room_id)
                VALUES (CHAR(64 + v_r), v_n, v_room);
                SET v_n = v_n + 1;
            END WHILE;
            SET v_r = v_r + 1;
        END WHILE;
    END LOOP;
    CLOSE cur;
END $$

-- ---- Utilisateurs (+ une adresse chacun) -----------------------------
DROP PROCEDURE IF EXISTS gen_users $$
CREATE PROCEDURE gen_users(IN p_count INT)
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE v_first VARCHAR(50);
    DECLARE v_last  VARCHAR(50);
    DECLARE v_dom   VARCHAR(50);
    DECLARE v_ci    INT;
    DECLARE v_addr  INT;
    DECLARE v_birth DATE;
    WHILE i <= p_count DO
        SET v_first = ELT(FLOOR(RAND()*30)+1,
            'Alice','Bruno','Chloe','David','Emma','Farid','Gaelle','Hugo','Ines','Julien',
            'Karim','Laura','Nadia','Olivier','Paul','Sofia','Lucas','Manon','Yanis','Camille',
            'Thomas','Lea','Mehdi','Sarah','Antoine','Jade','Nicolas','Clara','Samuel','Zoe');
        SET v_last = ELT(FLOOR(RAND()*30)+1,
            'Martin','Dubois','Bernard','Leroy','Moreau','Benali','Petit','Roux','Fontaine','Girard',
            'Hamdi','Simon','Lopez','Fabre','Henry','Garcia','Blanc','Faure','Chevalier','Robin',
            'Noel','Marchand','Perrin','Lemoine','DaSilva','Barbier','Renaud','Guerin','Aubert','Masson');
        SET v_dom = ELT(FLOOR(RAND()*8)+1,
            'gmail.com','yahoo.fr','outlook.fr','free.fr','hotmail.com','wanadoo.fr','proton.me','laposte.net');
        SET v_ci = FLOOR(RAND()*10)+1;

        INSERT INTO address (street_name, street_info, street_number, zip_code, city)
        VALUES (
            ELT(FLOOR(RAND()*12)+1,
                'Rue de la République','Avenue Jean Jaurès','Rue Garibaldi','Cours Lafayette',
                'Rue Victor Hugo','Boulevard des Belges','Rue Paul Bert','Avenue Berthelot',
                'Rue de Sèze','Quai Claude Bernard','Rue Duguesclin','Rue Vendôme'),
            NULL,
            FLOOR(RAND()*250)+1,
            ELT(v_ci, '69003','75011','13006','31000','33000','59000','44000','06000','67000','35000'),
            ELT(v_ci, 'Lyon','Paris','Marseille','Toulouse','Bordeaux','Lille','Nantes','Nice','Strasbourg','Rennes')
        );
        SET v_addr = LAST_INSERT_ID();

        -- 10% des users sans date de naissance (colonne nullable)
        IF RAND() < 0.10 THEN
            SET v_birth = NULL;
        ELSE
            SET v_birth = DATE_ADD('1970-01-01', INTERVAL FLOOR(RAND()*12784) DAY);  -- ~1970..2004
        END IF;

        INSERT INTO user (uuid, email, password, first_name, last_name, birthed_at, created_at, address_id)
        VALUES (
            UUID(),
            CONCAT(LOWER(v_first), '.', LOWER(v_last), i, '@', v_dom),
            '$2y$10$abcdefghijklmnopqrstuv',
            v_first, v_last, v_birth,
            TIMESTAMPADD(MINUTE, FLOOR(RAND()*2560000), '2022-01-01 00:00:00'),  -- 2022..nov. 2026
            v_addr
        );
        SET i = i + 1;
    END WHILE;
END $$

-- ---- Cartes : ~40% des utilisateurs ----------------------------------
DROP PROCEDURE IF EXISTS gen_cards $$
CREATE PROCEDURE gen_cards()
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE v_user INT;
    DECLARE v_t INT;
    DECLARE cur CURSOR FOR SELECT id FROM user;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    OPEN cur;
    loop_user: LOOP
        FETCH cur INTO v_user;
        IF done THEN LEAVE loop_user; END IF;
        IF RAND() < 0.40 THEN
            SET v_t = FLOOR(RAND()*5)+1;
            INSERT INTO card (code, type, benefit_amount, benefit_amount_type, user_id)
            VALUES (
                CONCAT('CARD-', LPAD(v_user, 4, '0')),
                ELT(v_t, 'Abonné Illimité','Étudiant','Fidélité','Comité Entreprise','Jeune -26 ans'),
                ELT(v_t, 20, 15, 150, 200, 10),
                ELT(v_t, '%','%','€','€','%'),
                v_user
            );
        END IF;
    END LOOP;
    CLOSE cur;
    -- On garantit un utilisateur avec DEUX cartes (user 1)
    INSERT IGNORE INTO card (code, type, benefit_amount, benefit_amount_type, user_id)
    VALUES ('CARD-0001', 'Fidélité', 150, '€', 1);
    INSERT INTO card (code, type, benefit_amount, benefit_amount_type, user_id)
    VALUES ('CARD-0001-B', 'Abonné Illimité', 20, '%', 1);
END $$

-- ---- Casting & genres des films 16 à 50 (généré) ---------------------
DROP PROCEDURE IF EXISTS gen_movie_links $$
CREATE PROCEDURE gen_movie_links()
BEGIN
    DECLARE m INT DEFAULT 16;
    DECLARE v_dir INT;
    DECLARE v_a1 INT;
    DECLARE v_a2 INT;
    WHILE m <= 50 DO
        -- 2 genres (INSERT IGNORE pour éviter un doublon de clé)
        INSERT IGNORE INTO movie_tag (movie_id, tag_id) VALUES (m, FLOOR(RAND()*15)+1);
        INSERT IGNORE INTO movie_tag (movie_id, tag_id) VALUES (m, FLOOR(RAND()*15)+1);
        -- 1 réalisateur (pool de 15 réalisateurs réels)
        SET v_dir = ELT(FLOOR(RAND()*15)+1, 1,2,3,7,17,18,20,21,29,30,31,32,33,34,35);
        INSERT INTO staff_movie (movie_id, staff_id, role, movie_role)
        VALUES (m, v_dir, 'director', NULL);
        -- 2 acteurs (pool de 18 acteurs réels)
        SET v_a1 = ELT(FLOOR(RAND()*18)+1, 8,9,10,12,13,16,36,37,38,39,40,43,44,45,46,47,48,49);
        SET v_a2 = ELT(FLOOR(RAND()*18)+1, 8,9,10,12,13,16,36,37,38,39,40,43,44,45,46,47,48,49);
        INSERT INTO staff_movie (movie_id, staff_id, role, movie_role) VALUES (m, v_a1, 'actor', NULL);
        IF v_a2 <> v_a1 THEN
            INSERT INTO staff_movie (movie_id, staff_id, role, movie_role) VALUES (m, v_a2, 'actor', NULL);
        END IF;
        SET m = m + 1;
    END WHILE;
END $$

-- ---- Séances (le film 10 "Pulp Fiction" reste volontairement exclu) --
DROP PROCEDURE IF EXISTS gen_screenings $$
CREATE PROCEDURE gen_screenings(IN p_count INT)
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE v_m INT;
    DECLARE v_rmax INT;
    SELECT MAX(id) INTO v_rmax FROM room;
    WHILE i <= p_count DO
        SET v_m = FLOOR(RAND()*49)+1;          -- 1..49
        IF v_m >= 10 THEN SET v_m = v_m + 1; END IF;   -- -> 1..9, 11..50 (exclut 10)
        INSERT INTO screening (started_at, language, movie_id, room_id)
        VALUES (
            TIMESTAMPADD(MINUTE, FLOOR(RAND()*131400), '2026-10-01 10:00:00'),  -- oct..déc 2026
            ELT(FLOOR(RAND()*3)+1, 'VF','VO','VOSTR'),
            v_m,
            FLOOR(RAND()*v_rmax)+1
        );
        SET i = i + 1;
    END WHILE;
END $$

-- ---- Commandes + tickets ---------------------------------------------
--  Chaque commande concerne UNE séance ; on lui affecte des places
--  libres de la salle de cette séance. L'utilisateur le plus récent
--  (id max) est volontairement exclu => il n'aura aucune commande.
DROP PROCEDURE IF EXISTS gen_orders $$
CREATE PROCEDURE gen_orders(IN p_count INT)
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE v_user INT;
    DECLARE v_umax INT;
    DECLARE v_scmax INT;
    DECLARE v_sc INT;
    DECLARE v_room INT;
    DECLARE v_oid INT;
    DECLARE v_created DATETIME;
    DECLARE v_qty INT;
    DECLARE v_j INT;
    DECLARE v_seat INT;

    SELECT MAX(id) INTO v_umax  FROM user;
    SELECT MAX(id) INTO v_scmax FROM screening;

    WHILE i <= p_count DO
        SET v_user = FLOOR(RAND()*(v_umax-1))+1;        -- 1..(umax-1), exclut le dernier user
        SET v_created = TIMESTAMPADD(MINUTE, FLOOR(RAND()*120960), '2026-09-15 08:00:00');
        INSERT INTO `order` (created_at, user_id) VALUES (v_created, v_user);
        SET v_oid = LAST_INSERT_ID();

        SET v_sc = FLOOR(RAND()*v_scmax)+1;
        SELECT room_id INTO v_room FROM screening WHERE id = v_sc;
        SET v_qty = FLOOR(RAND()*5)+1;                  -- 1..5 places
        SET v_j = 0;

        loop_ticket: WHILE v_j < v_qty DO
            SET v_seat = NULL;
            SELECT s.id INTO v_seat
            FROM seat s
            WHERE s.room_id = v_room
              AND s.id NOT IN (SELECT t.seat_id FROM ticket t WHERE t.screening_id = v_sc)
            ORDER BY s.id
            LIMIT 1;

            IF v_seat IS NULL THEN LEAVE loop_ticket; END IF;   -- salle pleine pour cette séance

            INSERT INTO ticket (code, created_at, order_id, screening_id, seat_id)
            VALUES (
                CONCAT('TCK-', LPAD(v_sc, 4, '0'), '-', LPAD(v_seat, 5, '0')),
                v_created, v_oid, v_sc, v_seat
            );
            SET v_j = v_j + 1;
        END WHILE;
        SET i = i + 1;
    END WHILE;
END $$

DELIMITER ;

-- ---- Appels (c'est ici que se règle la volumétrie) -------------------
CALL gen_rooms();            -- 15 cinémas x 3 = 45 salles
CALL gen_seats();            -- 45 salles x 24 = 1080 sièges
CALL gen_users(60);          -- 60 utilisateurs (+ 60 adresses)
CALL gen_cards();            -- ~40% des users ont une carte
CALL gen_movie_links();      -- casting/genres des films 16 à 50
CALL gen_screenings(250);    -- 250 séances
CALL gen_orders(220);        -- 220 commandes + leurs tickets

-- ---- Ménage : on retire les procédures de génération -----------------
DROP PROCEDURE gen_rooms;
DROP PROCEDURE gen_seats;
DROP PROCEDURE gen_users;
DROP PROCEDURE gen_cards;
DROP PROCEDURE gen_movie_links;
DROP PROCEDURE gen_screenings;
DROP PROCEDURE gen_orders;

-- =====================================================================
--  FIN DU SCRIPT
-- =====================================================================
