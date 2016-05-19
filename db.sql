BEGIN TRANSACTION;

DROP TABLE IF EXISTS jeune ;
DROP TABLE IF EXISTS reference ;
DROP TABLE IF EXISTS referent ;
DROP TABLE IF EXISTS consultant;
DROP TABLE IF EXISTS connexion;
DROP TABLE IF EXISTS savoir_etre;

CREATE TABLE jeune (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nom VARCHAR (100),
  prenom VARCHAR (100),
  mail VARCHAR (100),
  date_naissance DATE,
  mdp VARCHAR (60),
  rang TINYINY
);

CREATE TABLE reference (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_user INTEGER,
  description TEXT,
  duree VARCHAR (50),
  endroit VARCHAR (150),
  savoir_etre_user VARCHAR (15),
  commentaire TEXT,
  savoir_etre_ref VARCHAR (15),
  etat TINYINT
);

CREATE TABLE referent (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_reference INTEGER,
  nom VARCHAR (100),
  prenom VARCHAR (100),
  date_naissance DATE,
  mail VARCHAR (100),
  lien VARCHAR (20)
);

CREATE TABLE consultant (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_reference INTEGER,
  lien VARCHAR (20)
);

CREATE TABLE connexion (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  type_connexion TINYINT,
  id_connexion INTEGER,
  id_user INTEGER
);

CREATE TABLE savoir_etre (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nom VARCHAR (100)
);

INSERT INTO savoir_etre (nom) VALUES ('Autonome');
INSERT INTO savoir_etre (nom) VALUES ('Passionné');
INSERT INTO savoir_etre (nom) VALUES ('Réfléchi');
INSERT INTO savoir_etre (nom) VALUES ('A l''écoute');
INSERT INTO savoir_etre (nom) VALUES ('Organisé');
INSERT INTO savoir_etre (nom) VALUES ('Fiable');
INSERT INTO savoir_etre (nom) VALUES ('Patient');
INSERT INTO savoir_etre (nom) VALUES ('Responsable');
INSERT INTO savoir_etre (nom) VALUES ('Optimiste');

COMMIT;
