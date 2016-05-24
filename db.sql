
DROP TABLE IF EXISTS jeune ;
DROP TABLE IF EXISTS reference ;
DROP TABLE IF EXISTS savoir_etre_user;
DROP TABLE IF EXISTS consultant;
DROP TABLE IF EXISTS groupement;
DROP TABLE IF EXISTS connexion;
DROP TABLE IF EXISTS savoir_etre;

-- Information sur le jeune (utilisateur)

-- id : identifiant unique du jeune
-- nom : nom du jeune
-- prenom : prenom du jeune
-- mail : mail du jeune
-- date_naissance : date de naissance du jeune
-- mdp : mot de passe chiffré
-- rang : droit du jeune sur le site : inf strict à 100 -> utilisateur lambda / sup ou egal à 100 -> admin

CREATE TABLE `jeune` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) DEFAULT NULL,
  `prenom` VARCHAR(100) DEFAULT NULL,
  `mail` VARCHAR(100) DEFAULT NULL,
  `date_naissance` DATE DEFAULT NULL,
  `mdp` VARCHAR(60) DEFAULT NULL,
  `rang` SMALLINT(6) DEFAULT '0', -- rang < 100 -> non admin; rang >= 100 -> admin
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Toutes les informations pour une référence

-- id : identifant unique de la référence
-- id_user : identifiant de l'utilisateur faisant la demande de référence
-- description : description de l'engagement
-- duree : durée de l'engagement
-- endroit : milieu de l'engagement (association / club de sport...)
-- commentaire : j'en sais rien
-- savoir_etre_ref : toujours aucune idée
-- etat : 1 = en cours de validation / 2 = validé / 3 = archivé
-- nom : nom du référent
-- prenom : prenom du référent
-- date_naissance : date de naissance du référent (rempli par le référent / null au départ)
-- mail : mail du référent
-- lien_validation : identifant unique alpha numérique de 40 caractères identifiant la référence pour la validation
CREATE TABLE `reference` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) DEFAULT NULL,
  `description` TEXT,
  `duree` VARCHAR(50) DEFAULT NULL,
  `endroit` VARCHAR(150) DEFAULT NULL,
  `commentaire` TEXT,
  `savoir_etre_ref` VARCHAR(15) DEFAULT NULL,
  `etat` SMALLINT(6) DEFAULT NULL,
  `nom` VARCHAR(100) DEFAULT NULL,
  `prenom` VARCHAR(100) DEFAULT NULL,
  `date_naissance` DATE DEFAULT NULL,
  `mail` VARCHAR(100) DEFAULT NULL,
  `lien_validation` VARCHAR(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table liant une référence avec les savoir être que le jeune a choisi

-- id : identifiant unique du couple ref / savoir etre
-- id_ref : identiant de la référence
-- id_savoir_etre : identifiant du savoir être
CREATE TABLE `savoir_etre_user` (
  `id` INT (11) NOT NULL AUTO_INCREMENT,
  `id_ref` INT(11) DEFAULT NULL,
  `id_savoir_etre` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Regroupement de référence

-- id : indentifiant unique du couple lien / reference
-- lien_consultation : identifant unique alpha numérique de 40 caractères identifiant la groupement
-- id_ref : identifiant une référence présente dans le groupement
CREATE TABLE `groupement` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `lien_consultation` VARCHAR(40) DEFAULT NULL,
  `id_ref` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Initialment prévu pour les connexion via twitter / google / fb -> à revoir car pas terrible du tout

CREATE TABLE `connexion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type_connexion` SMALLINT(6) DEFAULT NULL,
  `id_connexion` INT(11) DEFAULT NULL,
  `id_user` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Liste des savoir-être

-- id : identifiant unique du savoir être
-- nom : désignation du savoir être
-- etat : -1 -> le savoir est supprimé / 0 -> le savoir etre est désactivé /1 -> le savoir être est actif
-- type : 1 -> jeune / 2 -> Référent

CREATE TABLE `savoir_etre` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) DEFAULT NULL,
  `etat` SMALLINT(1) DEFAULT '1',
  `type` SMALLINT(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO savoir_etre (nom, type) VALUES ('Autonome', '1');
INSERT INTO savoir_etre (nom, type) VALUES ('Passionné', '1');
INSERT INTO savoir_etre (nom, type) VALUES ('Réfléchi', '1');
INSERT INTO savoir_etre (nom, type) VALUES ('A l''écoute', '1');
INSERT INTO savoir_etre (nom, type) VALUES ('Organisé', '1');
INSERT INTO savoir_etre (nom, type) VALUES ('Fiable', '1');
INSERT INTO savoir_etre (nom, type) VALUES ('Patient', '1');
INSERT INTO savoir_etre (nom, type) VALUES ('Responsable', '1');
INSERT INTO savoir_etre (nom, type) VALUES ('Optimiste', '1');

INSERT INTO savoir_etre (nom, type) VALUES ('Autonome', '2');
INSERT INTO savoir_etre (nom, type) VALUES ('Passionné', '2');
INSERT INTO savoir_etre (nom, type) VALUES ('Réfléchi', '2');
INSERT INTO savoir_etre (nom, type) VALUES ('A l''écoute', '2');
INSERT INTO savoir_etre (nom, type) VALUES ('Organisé', '2');
INSERT INTO savoir_etre (nom, type) VALUES ('Fiable', '2');
INSERT INTO savoir_etre (nom, type) VALUES ('Patient', '2');
INSERT INTO savoir_etre (nom, type) VALUES ('Responsable', '2');
INSERT INTO savoir_etre (nom, type) VALUES ('Optimiste', '2');

