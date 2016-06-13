PRAGMA synchronous = OFF;
PRAGMA journal_mode = MEMORY;
BEGIN TRANSACTION;

CREATE TABLE "dashboard" (
  "id" int(11) NOT NULL ,
  "id_user" int(11) DEFAULT NULL,
  "type" smallint(1) DEFAULT '1',
  "date" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "options" varchar(100) DEFAULT NULL,
  PRIMARY KEY ("id")
);
INSERT INTO "dashboard" VALUES (2,4,1,'2016-06-08 06:13:56',NULL);
INSERT INTO "dashboard" VALUES (3,1,2,'2016-06-10 19:53:19','1');
INSERT INTO "dashboard" VALUES (4,1,4,'2016-06-10 20:10:34','3YgkgurO1kDpQl1qFeCPodEIBIvPpq9sOpd3hSPg');
INSERT INTO "dashboard" VALUES (5,1,3,'2016-06-10 21:49:52','1');
INSERT INTO "dashboard" VALUES (6,4,2,'2016-06-10 21:52:15','2');
INSERT INTO "dashboard" VALUES (7,4,3,'2016-06-10 21:52:50','2');
INSERT INTO "dashboard" VALUES (8,1,2,'2016-06-11 06:47:08','3');
INSERT INTO "dashboard" VALUES (9,1,4,'2016-06-11 06:47:56','yV3Ykj9dIhaVLckj3mVi3og0tV3hj9FfcHDLyMyH');
INSERT INTO "dashboard" VALUES (10,1,2,'2016-06-11 19:10:00','4');
INSERT INTO "dashboard" VALUES (11,1,4,'2016-06-11 19:11:29','BqjMDtKEQfcdXrS3Ct3psP8NQkgUljiwXQIiJawh');
INSERT INTO "dashboard" VALUES (12,4,2,'2016-06-11 20:28:30','5');
INSERT INTO "dashboard" VALUES (13,4,4,'2016-06-11 20:39:39','JgYM1dFdLKIn5agBkXVEOVZt7e8HgiWxM2HOdW1y');
INSERT INTO "dashboard" VALUES (14,4,2,'2016-06-12 22:14:47','6');
INSERT INTO "dashboard" VALUES (15,4,2,'2016-06-12 22:15:16','7');
CREATE TABLE "groupement" (
  "lien_consultation" varchar(40) NOT NULL,
  "id_ref" int(11) NOT NULL,
  PRIMARY KEY ("lien_consultation","id_ref")
);
INSERT INTO "groupement" VALUES ('3YgkgurO1kDpQl1qFeCPodEIBIvPpq9sOpd3hSPg',1);
INSERT INTO "groupement" VALUES ('BqjMDtKEQfcdXrS3Ct3psP8NQkgUljiwXQIiJawh',3);
INSERT INTO "groupement" VALUES ('BqjMDtKEQfcdXrS3Ct3psP8NQkgUljiwXQIiJawh',4);
INSERT INTO "groupement" VALUES ('JgYM1dFdLKIn5agBkXVEOVZt7e8HgiWxM2HOdW1y',2);
INSERT INTO "groupement" VALUES ('yV3Ykj9dIhaVLckj3mVi3og0tV3hj9FfcHDLyMyH',1);
INSERT INTO "groupement" VALUES ('yV3Ykj9dIhaVLckj3mVi3og0tV3hj9FfcHDLyMyH',3);
CREATE TABLE "jeune" (
  "id" int(11) NOT NULL ,
  "nom" varchar(100) DEFAULT NULL,
  "prenom" varchar(100) DEFAULT NULL,
  "mail" varchar(100) DEFAULT NULL,
  "date_naissance" date DEFAULT NULL,
  "mdp" varchar(60) DEFAULT NULL,
  "rang" smallint(6) DEFAULT '0',
  PRIMARY KEY ("id")
);
INSERT INTO "jeune" VALUES (1,'Toto','Roger','rogerdu64@gmail.com','1984-07-02','$2a$08$XF9ERbtlxr9k.tESnID7au8NRck0uBYl7voEFSfyTVU6Z7DmCkx1G',100);
INSERT INTO "jeune" VALUES (4,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (5,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (6,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (7,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (8,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (9,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (10,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (11,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (12,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (13,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (14,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
INSERT INTO "jeune" VALUES (15,'Eude','Jean','jean@eude.lol','1996-08-15',NULL,0);
CREATE TABLE "reference" (
  "id" int(11) NOT NULL ,
  "id_user" int(11) NOT NULL,
  "description" text NOT NULL,
  "duree" varchar(50) NOT NULL,
  "commentaire" text,
  "etat" smallint(6) DEFAULT '1',
  "nom" varchar(100) NOT NULL,
  "prenom" varchar(100) NOT NULL,
  "date_naissance" date DEFAULT NULL,
  "mail" varchar(100) NOT NULL,
  "lien_validation" varchar(40) NOT NULL,
  PRIMARY KEY ("id")
);
INSERT INTO "reference" VALUES (1,1,'dfsd','1 semaine','esre',2,'fgd','fdgfd','1977-01-17','rogerdu64@gmail.com','gFr83IA9a5EI2hnti2sDIvTx2LfTlEDPT2VULdet');
INSERT INTO "reference" VALUES (2,4,'dsertser','1 semaine','dfsd',3,'rt','rt','1956-01-12','jean@eude.lol','78tOCbmshjIkYQ8vZZVHOw0b92SKJZ7Qf0mqbYgG');
INSERT INTO "reference" VALUES (3,1,'sqf','1 semaine',NULL,2,'df','df',NULL,'b@g.g','spVrdGpWjvfNWBso1Nim6e09YeuVNUUFHy4tEsNv');
INSERT INTO "reference" VALUES (4,1,'hgc','6 semaines',NULL,2,'jhkkbj','uuytoi²&amp;',NULL,'berthaudmu@eisti.eu','IMKuT8EARrYox6F94Wr0flmeKOaJaKAqgUj8dxI2');
INSERT INTO "reference" VALUES (5,4,'dqsdq','5 semaines',NULL,3,'dd','dd',NULL,'b@g.g','BZzMLvNPpv2NasMKdrUg6Rpim2w8Jw8TV5no0ACn');
INSERT INTO "reference" VALUES (6,4,'efsdf','4 semaines',NULL,1,'dfg','fdg',NULL,'b@g.g','1svkYL9V4QDuoWNqrDyiPHpxWMA8MjZLZV55qCYs');
INSERT INTO "reference" VALUES (7,4,'ff','1 semaine',NULL,1,'dsf','dsf',NULL,'b@g.g','o8qUYMLePwew4hAYzh2WzonsEWpsyL8mRxEzHadg');
CREATE TABLE "referent" (
  "id" int(11) NOT NULL ,
  "id_reference" int(11) DEFAULT NULL,
  "nom" varchar(100) DEFAULT NULL,
  "prenom" varchar(100) DEFAULT NULL,
  "date_naissance" date DEFAULT NULL,
  "mail" varchar(100) DEFAULT NULL,
  "lien" varchar(20) DEFAULT NULL,
  PRIMARY KEY ("id")
);
CREATE TABLE "savoir_etre" (
  "id" int(11) NOT NULL ,
  "nom" varchar(100) DEFAULT NULL,
  "etat" smallint(1) DEFAULT '1',
  "type" smallint(6) DEFAULT NULL,
  PRIMARY KEY ("id")
);
INSERT INTO "savoir_etre" VALUES (1,'Autonome',1,1);
INSERT INTO "savoir_etre" VALUES (2,'Passionné',1,1);
INSERT INTO "savoir_etre" VALUES (3,'Réfléchi',1,1);
INSERT INTO "savoir_etre" VALUES (4,'A l''écoute',1,1);
INSERT INTO "savoir_etre" VALUES (5,'Organisé',1,1);
INSERT INTO "savoir_etre" VALUES (6,'Fiable',1,1);
INSERT INTO "savoir_etre" VALUES (7,'Patient',1,1);
INSERT INTO "savoir_etre" VALUES (8,'Responsable',1,1);
INSERT INTO "savoir_etre" VALUES (9,'Optimiste',1,1);
INSERT INTO "savoir_etre" VALUES (10,'Autonome',1,2);
INSERT INTO "savoir_etre" VALUES (11,'Passionné',1,2);
INSERT INTO "savoir_etre" VALUES (12,'Réfléchi',1,2);
INSERT INTO "savoir_etre" VALUES (13,'A l''écoute',1,2);
INSERT INTO "savoir_etre" VALUES (14,'Organisé',1,2);
INSERT INTO "savoir_etre" VALUES (15,'Fiable',1,2);
INSERT INTO "savoir_etre" VALUES (16,'Patient',1,2);
INSERT INTO "savoir_etre" VALUES (17,'Responsable',1,2);
INSERT INTO "savoir_etre" VALUES (18,'Optimiste',1,2);
CREATE TABLE "savoir_etre_user" (
  "id_ref" int(11) NOT NULL,
  "id_savoir_etre" int(11) NOT NULL,
  "type" smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY ("id_ref","id_savoir_etre","type")
);
INSERT INTO "savoir_etre_user" VALUES (1,2,1);
INSERT INTO "savoir_etre_user" VALUES (1,3,1);
INSERT INTO "savoir_etre_user" VALUES (1,6,1);
INSERT INTO "savoir_etre_user" VALUES (1,11,2);
INSERT INTO "savoir_etre_user" VALUES (1,12,2);
INSERT INTO "savoir_etre_user" VALUES (2,1,1);
INSERT INTO "savoir_etre_user" VALUES (2,12,2);
INSERT INTO "savoir_etre_user" VALUES (3,2,1);
INSERT INTO "savoir_etre_user" VALUES (3,3,1);
INSERT INTO "savoir_etre_user" VALUES (3,6,1);
INSERT INTO "savoir_etre_user" VALUES (4,7,1);
INSERT INTO "savoir_etre_user" VALUES (4,8,1);
INSERT INTO "savoir_etre_user" VALUES (4,9,1);
INSERT INTO "savoir_etre_user" VALUES (5,4,1);
INSERT INTO "savoir_etre_user" VALUES (5,6,1);
INSERT INTO "savoir_etre_user" VALUES (6,1,1);
INSERT INTO "savoir_etre_user" VALUES (6,4,1);
INSERT INTO "savoir_etre_user" VALUES (6,6,1);
INSERT INTO "savoir_etre_user" VALUES (7,1,1);
INSERT INTO "savoir_etre_user" VALUES (7,4,1);
INSERT INTO "savoir_etre_user" VALUES (7,6,1);
CREATE TABLE "twitter" (
  "id" int(11) NOT NULL,
  "oauth_token" varchar(100) DEFAULT NULL,
  "oauth_token_secret" varchar(100) DEFAULT NULL,
  "id_user" int(11) DEFAULT NULL,
  PRIMARY KEY ("id")
);
INSERT INTO "twitter" VALUES (1015799900,'1015799900-pdjD9PokJiPlswXxG3X6SPQRs5boqrBLt48YIEE','69Eyn69PWmBVFVCQEWj3x0NnAjDULon85DP51gc2FWTaF',4);
END TRANSACTION;
