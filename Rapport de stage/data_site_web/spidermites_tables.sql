-- Adminer 4.8.1 PostgreSQL 9.6.22 dump

DROP TABLE IF EXISTS "arbre";
CREATE TABLE "public"."arbre" (
    "id_espece_valide" integer,
    "rang" integer,
    "fils" character varying(50),
    "pere" character varying(50)
) WITH (oids = false);


DROP TABLE IF EXISTS "bibliographie";
CREATE TABLE "public"."bibliographie" (
    "code_bibliographie" integer NOT NULL,
    "reference" character varying(512),
    "auteur" character varying(1024),
    "annee" integer,
    "titre" character varying(512),
    "source" character varying(512),
    "id_note" integer
) WITH (oids = false);


DROP TABLE IF EXISTS "classification";
CREATE TABLE "public"."classification" (
    "id_classification" integer NOT NULL,
    "nom_classification" character varying(100),
    "reference_page" character varying(20),
    "id_note" integer,
    "code_bibliographie" integer,
    "id_rang" integer,
    CONSTRAINT "cp_id_classification" PRIMARY KEY ("id_classification")
) WITH (oids = false);


DROP TABLE IF EXISTS "classification_superieure";
CREATE TABLE "public"."classification_superieure" (
    "id_classification_fils" integer NOT NULL,
    "id_classification_pere" integer NOT NULL,
    CONSTRAINT "cp_id_classification_superieure" PRIMARY KEY ("id_classification_fils", "id_classification_pere")
) WITH (oids = false);


DROP TABLE IF EXISTS "compteur";
CREATE TABLE "public"."compteur" (
    "ip" character varying(15) NOT NULL,
    "date" date NOT NULL,
    "ip_number" bigint,
    "country_name" character varying(50),
    CONSTRAINT "cp_compteur" PRIMARY KEY ("ip", "date")
) WITH (oids = false);


DROP TABLE IF EXISTS "compteur_nature";
CREATE TABLE "public"."compteur_nature" (
    "ip" character varying(15) NOT NULL,
    "date" date NOT NULL,
    "ip_number" bigint,
    "id_number" bigint NOT NULL,
    "id_nature" character varying(15) NOT NULL,
    "country_name" character varying(50),
    CONSTRAINT "cp_compteur_nature" PRIMARY KEY ("ip", "date", "id_number", "id_nature")
) WITH (oids = false);


DROP TABLE IF EXISTS "continent";
CREATE TABLE "public"."continent" (
    "id_continent" integer NOT NULL,
    "nom_continent" character varying(50),
    CONSTRAINT "cp_id_continent" PRIMARY KEY ("id_continent")
) WITH (oids = false);


DROP TABLE IF EXISTS "contributor";
CREATE TABLE "public"."contributor" (
    "id_contributor" integer NOT NULL,
    "first_name_contributor" character varying(250),
    "name_contributor" character varying(250),
    "country_contributor" character varying(250),
    CONSTRAINT "cp_id_contributor" PRIMARY KEY ("id_contributor")
) WITH (oids = false);


DROP TABLE IF EXISTS "espece_valide";
CREATE TABLE "public"."espece_valide" (
    "id_espece_valide" integer NOT NULL,
    "nom_genre" character varying(100),
    "nom_espece" character varying(100),
    "auteur_date" character varying(500),
    "id_note" integer,
    "reference_page" character varying(20),
    "code_bibliographie" integer,
    "bolland" integer,
    "id_genre_valide" integer,
    CONSTRAINT "cp_id_espece_valide" PRIMARY KEY ("id_espece_valide")
) WITH (oids = false);


DROP TABLE IF EXISTS "gallery";
CREATE TABLE "public"."gallery" (
    "id_gallery" integer NOT NULL,
    "name_gallery" character varying(250),
    "name_gallery_url" character varying(250),
    "name_image" character varying(250),
    "description" text,
    "url" character varying(250),
    CONSTRAINT "cp_id_gallery" PRIMARY KEY ("id_gallery")
) WITH (oids = false);


DROP TABLE IF EXISTS "genre_valide";
CREATE TABLE "public"."genre_valide" (
    "id_genre_valide" integer NOT NULL,
    "nom_genre" character varying(100),
    "reference_page" character varying(20),
    "code_bibliographie" integer,
    "id_classification" integer,
    "id_note" integer,
    CONSTRAINT "cp_id_genre_valide" PRIMARY KEY ("id_genre_valide")
) WITH (oids = false);


DROP TABLE IF EXISTS "geo_lien_level4_pays";
CREATE TABLE "public"."geo_lien_level4_pays" (
    "id_level4" integer,
    "nom_level4" character varying(255),
    "id_pays" integer,
    "nom_pays" character varying(255)
) WITH (oids = false);


DROP TABLE IF EXISTS "ip_to_country";
CREATE TABLE "public"."ip_to_country" (
    "ip_from" bigint NOT NULL,
    "ip_to" bigint NOT NULL,
    "country_code" character(2),
    "country_code_3" character(3),
    "country_name" character varying(50),
    CONSTRAINT "cp_ip_to_country" PRIMARY KEY ("ip_from", "ip_to")
) WITH (oids = false);


DROP TABLE IF EXISTS "level4json_polygones";
CREATE TABLE "public"."level4json_polygones" (
    "id_level4" integer,
    "polygone" text
) WITH (oids = false);


DROP TABLE IF EXISTS "level4web";
CREATE TABLE "public"."level4web" (
    "id_level4" integer,
    "nom_level4" character varying(35),
    "id_zone_bi" integer,
    "name" character varying(35),
    "presence" integer
) WITH (oids = false);


DROP TABLE IF EXISTS "nomenclature_espece";
CREATE TABLE "public"."nomenclature_espece" (
    "id_nomenclature_espece" integer NOT NULL,
    "nom_genre" character varying(100),
    "nom_espece" character varying(100),
    "auteur_date" character varying(500),
    "reference_page" character varying(20),
    "code_bibliographie" integer,
    "id_statut" integer,
    "id_note" integer,
    "id_espece_valide" integer,
    CONSTRAINT "cp_id_nomenclature_espece" PRIMARY KEY ("id_nomenclature_espece")
) WITH (oids = false);


DROP TABLE IF EXISTS "nomenclature_genre";
CREATE TABLE "public"."nomenclature_genre" (
    "id_nomenclature_genre" integer NOT NULL,
    "nom_genre" character varying(100),
    "reference_page" character varying(20),
    "code_bibliographie" integer,
    "id_genre_valide" integer,
    "id_nomenclature_espece" integer,
    "id_note" integer,
    "id_statut_genre" integer,
    CONSTRAINT "cp_id_nomenclature_genre" PRIMARY KEY ("id_nomenclature_genre")
) WITH (oids = false);


DROP TABLE IF EXISTS "note";
CREATE TABLE "public"."note" (
    "id_note" integer NOT NULL,
    "note" text,
    CONSTRAINT "cp_id_note" PRIMARY KEY ("id_note")
) WITH (oids = false);


DROP TABLE IF EXISTS "pays";
CREATE TABLE "public"."pays" (
    "id_pays" integer NOT NULL,
    "nom_pays" character varying(255),
    "id_continent" integer,
    "id_zone_biogeographique" integer,
    CONSTRAINT "cp_id_pays" PRIMARY KEY ("id_pays")
) WITH (oids = false);


DROP TABLE IF EXISTS "plante";
CREATE TABLE "public"."plante" (
    "id_plante" character varying(100) NOT NULL,
    "embranchement" character varying(50),
    "classe" character varying(50),
    "ordre" character varying(50),
    "famille" character varying(50),
    "genre" character varying(50),
    "espece" character varying(50),
    "auteur_date" character varying(100),
    CONSTRAINT "cp_id_plante" PRIMARY KEY ("id_plante")
) WITH (oids = false);


DROP TABLE IF EXISTS "plante_hote";
CREATE TABLE "public"."plante_hote" (
    "id_plante_hote" integer NOT NULL,
    "id_plante" character varying(100),
    "id_nomenclature_espece" integer,
    "code_bibliographie" integer,
    CONSTRAINT "cp_id_plante_hote" PRIMARY KEY ("id_plante_hote")
) WITH (oids = false);


DROP TABLE IF EXISTS "rang";
CREATE TABLE "public"."rang" (
    "id_rang" integer NOT NULL,
    "nom_rang" character varying(100),
    CONSTRAINT "cp_id_rang" PRIMARY KEY ("id_rang")
) WITH (oids = false);


DROP TABLE IF EXISTS "repartition";
CREATE TABLE "public"."repartition" (
    "id_repartition" integer NOT NULL,
    "id_pays" integer,
    "code_bibliographie" integer,
    "id_nomenclature_espece" integer,
    "printed_note" text,
    CONSTRAINT "cp_id_repartition" PRIMARY KEY ("id_repartition")
) WITH (oids = false);


DROP TABLE IF EXISTS "robot";
CREATE TABLE "public"."robot" (
    "id_crawler" integer NOT NULL,
    "crawler_user_agent" character varying(255),
    "crawler_name" character varying(45),
    "crawler_url" character varying(255),
    "crawler_info" character varying(255),
    "crawler_ip" character varying(16)
) WITH (oids = false);


DROP TABLE IF EXISTS "statut_espece";
CREATE TABLE "public"."statut_espece" (
    "id_statut_espece" integer NOT NULL,
    "nom_statut_espece" character varying(100),
    CONSTRAINT "cp_id_statut_espece" PRIMARY KEY ("id_statut_espece")
) WITH (oids = false);


DROP TABLE IF EXISTS "statut_genre";
CREATE TABLE "public"."statut_genre" (
    "id_statut_genre" integer NOT NULL,
    "nom_statut_genre" character varying(50),
    CONSTRAINT "cp_id_statut_genre" PRIMARY KEY ("id_statut_genre")
) WITH (oids = false);

/*
DROP VIEW IF EXISTS "v_bibliography_distribution";
CREATE TABLE "v_bibliography_distribution" ("code_bibliographie" integer, "nom_zone_biogeographique" character varying(50), "nom_pays" character varying(255), "nom_genre" character varying(100), "nom_espece" character varying(100), "auteur_date" character varying(500), "id_espece_valide" integer);


DROP VIEW IF EXISTS "v_bibliography_host";
CREATE TABLE "v_bibliography_host" ("code_bibliographie" integer, "famille" character varying(50), "genre" character varying(50), "espece" character varying(50), "nom_genre" character varying(100), "nom_espece" character varying(100), "auteur_date" character varying(500), "id_espece_valide" integer);


DROP VIEW IF EXISTS "v_bibliography_species";
CREATE TABLE "v_bibliography_species" ("code_bibliographie" integer, "nom_genre" character varying(100), "nom_espece" character varying(100), "auteur_date" character varying(500), "id_espece_valide" integer);


DROP VIEW IF EXISTS "v_classification";
CREATE TABLE "v_classification" ("famille" character varying(100), "rang_famille" integer, "sous_famille" character varying(100), "rang_sous_famille" integer, "tribu" character varying(100), "id_espece_valide" integer);


DROP VIEW IF EXISTS "v_genre";
CREATE TABLE "v_genre" ("genre" character varying(100), "id_espece_valide" integer, "nom_genre" character varying(100), "nom_espece" character varying(100));


DROP VIEW IF EXISTS "v_geographie";
CREATE TABLE "v_geographie" ("id_espece_valide" integer, "nom_genre" character varying(100), "nom_espece" character varying(100), "nom_continent" character varying(50), "nom_pays" character varying(255), "nom_zone_biogeographique" character varying(50));


DROP VIEW IF EXISTS "v_map";
CREATE TABLE "v_map" ("id_espece_valide" integer, "id_nomenclature_espece" integer, "id_pays" integer, "nom_pays" character varying(255), "id_level4" integer, "nom_level4" character varying(255));


DROP VIEW IF EXISTS "v_nomenclature";
CREATE TABLE "v_nomenclature" ("genre" character varying(100), "espece" character varying(100), "auteur_date" character varying(500), "nom_statut" character varying(100), "reference" character varying(512), "annee" integer, "reference_page" character varying(20), "id_statut" integer, "id_nomenclature_espece" integer, "id_espece_valide" integer, "id_note" integer, "code_bibliographie" integer);


DROP VIEW IF EXISTS "v_plante";
CREATE TABLE "v_plante" ("id_espece_valide" integer, "nom_genre" character varying(100), "nom_espece" character varying(100), "famille" character varying(50), "genre" character varying(50), "espece" character varying(50), "id_plante" character varying(100));


DROP VIEW IF EXISTS "v_plante_hote";
CREATE TABLE "v_plante_hote" ("id_espece_valide" integer, "id_nomenclature_espece" integer, "id_plante" character varying(100), "famille" character varying(50), "genre" character varying(50), "espece" character varying(50));


DROP VIEW IF EXISTS "v_repartition";
CREATE TABLE "v_repartition" ("id_espece_valide" integer, "id_nomenclature_espece" integer, "id_pays" integer, "nom_zone_biogeographique" character varying(50), "nom_pays" character varying(255));


DROP VIEW IF EXISTS "v_species_reference_distribution";
CREATE TABLE "v_species_reference_distribution" ("id_pays" integer, "id_espece_valide" integer, "id_nomenclature_espece" integer, "code_bibliographie" integer, "reference" character varying(512), "annee" integer);


DROP VIEW IF EXISTS "v_species_reference_host";
CREATE TABLE "v_species_reference_host" ("id_plante" character varying(100), "id_espece_valide" integer, "id_nomenclature_espece" integer, "code_bibliographie" integer, "reference" character varying(512), "annee" integer);


DROP VIEW IF EXISTS "v_synonym_liste";
CREATE TABLE "v_synonym_liste" ("genre" character varying(100), "espece" character varying(100), "auteur_date" character varying(500), "nom_statut" character varying(100), "reference" character varying(512), "reference_page" character varying(20), "id_espece_valide" integer, "id_note" integer);


DROP VIEW IF EXISTS "v_visiteurs_pays";
CREATE TABLE "v_visiteurs_pays" ("ip_number" bigint, "country_name" character varying(50));

*/
DROP TABLE IF EXISTS "zone_biogeographique";
CREATE TABLE "public"."zone_biogeographique" (
    "id_zone_biogeographique" integer NOT NULL,
    "nom_zone_biogeographique" character varying(50),
    CONSTRAINT "cp_id_zone_biogeographique" PRIMARY KEY ("id_zone_biogeographique")
) WITH (oids = false);

/*
DROP VIEW IF EXISTS "v_bibliography_distribution";
CREATE VIEW "v_bibliography_distribution" AS SELECT DISTINCT b.code_bibliographie,
    v.nom_zone_biogeographique,
    v.nom_pays,
    e.nom_genre,
    e.nom_espece,
    e.auteur_date,
    e.id_espece_valide
   FROM ONLY bibliographie b,
    ONLY v_repartition v,
    ONLY repartition r,
    ONLY nomenclature_espece n,
    ONLY espece_valide e
  WHERE ((b.code_bibliographie = r.code_bibliographie) AND (r.id_pays = v.id_pays) AND (r.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide))
  ORDER BY v.nom_zone_biogeographique, v.nom_pays, e.nom_genre, e.nom_espece, b.code_bibliographie, e.auteur_date, e.id_espece_valide;
*/

/*
DROP VIEW IF EXISTS "v_bibliography_host";
CREATE VIEW "v_bibliography_host" AS SELECT DISTINCT b.code_bibliographie,
    p.famille,
    p.genre,
    p.espece,
    e.nom_genre,
    e.nom_espece,
    e.auteur_date,
    e.id_espece_valide
   FROM ONLY bibliographie b,
    ONLY plante_hote h,
    ONLY v_plante_hote p,
    ONLY espece_valide e,
    ONLY nomenclature_espece n
  WHERE ((b.code_bibliographie = h.code_bibliographie) AND ((h.id_plante)::text = (p.id_plante)::text) AND (h.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide))
  ORDER BY e.nom_genre, e.nom_espece, p.famille, p.genre, p.espece, b.code_bibliographie, e.auteur_date, e.id_espece_valide;
*/

DROP VIEW IF EXISTS "v_bibliography_species";
CREATE VIEW "v_bibliography_species" AS SELECT DISTINCT b.code_bibliographie,
    e.nom_genre,
    e.nom_espece,
    e.auteur_date,
    e.id_espece_valide
   FROM ONLY bibliographie b,
    ONLY nomenclature_espece n,
    ONLY espece_valide e
  WHERE ((n.code_bibliographie = b.code_bibliographie) AND (n.id_espece_valide = e.id_espece_valide))
  ORDER BY e.nom_genre, e.nom_espece, b.code_bibliographie, e.auteur_date, e.id_espece_valide;

DROP VIEW IF EXISTS "v_classification";
CREATE VIEW "v_classification" AS SELECT DISTINCT c3.nom_classification AS famille,
    c3.id_rang AS rang_famille,
    c2.nom_classification AS sous_famille,
    c2.id_rang AS rang_sous_famille,
    c1.nom_classification AS tribu,
    e.id_espece_valide
   FROM ONLY classification c1,
    ONLY classification c2,
    ONLY classification c3,
    ONLY espece_valide e,
    ONLY genre_valide g,
    ONLY classification_superieure s1,
    ONLY classification_superieure s2
  WHERE ((e.id_genre_valide = g.id_genre_valide) AND (g.id_classification = c1.id_classification) AND (c1.id_classification = s1.id_classification_fils) AND (s1.id_classification_pere = c2.id_classification) AND (c2.id_classification = s2.id_classification_fils) AND (s2.id_classification_pere = c3.id_classification))
  ORDER BY c3.nom_classification, c3.id_rang, c2.nom_classification, c2.id_rang, c1.nom_classification, e.id_espece_valide;

DROP VIEW IF EXISTS "v_genre";
CREATE VIEW "v_genre" AS SELECT g.nom_genre AS genre,
    e.id_espece_valide,
    e.nom_genre,
    e.nom_espece
   FROM ONLY genre_valide g,
    ONLY espece_valide e
  WHERE (e.id_genre_valide = g.id_genre_valide);

DROP VIEW IF EXISTS "v_geographie";
CREATE VIEW "v_geographie" AS SELECT e.id_espece_valide,
    e.nom_genre,
    e.nom_espece,
    c.nom_continent,
    p.nom_pays,
    z.nom_zone_biogeographique
   FROM ONLY repartition r,
    ONLY continent c,
    ONLY pays p,
    ONLY zone_biogeographique z,
    ONLY espece_valide e,
    ONLY nomenclature_espece n
  WHERE ((p.id_continent = c.id_continent) AND (p.id_zone_biogeographique = z.id_zone_biogeographique) AND (r.id_pays = p.id_pays) AND (r.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide));

DROP VIEW IF EXISTS "v_map";
CREATE VIEW "v_map" AS SELECT e.id_espece_valide,
    n.id_nomenclature_espece,
    r.id_pays,
    l.nom_pays,
    l.id_level4,
    l.nom_level4
   FROM ONLY espece_valide e,
    ONLY nomenclature_espece n,
    ONLY repartition r,
    ONLY geo_lien_level4_pays l
  WHERE ((e.id_espece_valide = n.id_espece_valide) AND (n.id_nomenclature_espece = r.id_nomenclature_espece) AND (r.id_pays = l.id_pays))
  ORDER BY e.id_espece_valide;

DROP VIEW IF EXISTS "v_nomenclature";
CREATE VIEW "v_nomenclature" AS SELECT DISTINCT e.nom_genre AS genre,
    e.nom_espece AS espece,
    e.auteur_date,
    s.nom_statut_espece AS nom_statut,
    b.reference,
    b.annee,
    e.reference_page,
    e.id_statut,
    e.id_nomenclature_espece,
    e.id_espece_valide,
    e.id_note,
    b.code_bibliographie
   FROM ONLY nomenclature_espece e,
    ONLY bibliographie b,
    ONLY statut_espece s
  WHERE ((e.id_statut = s.id_statut_espece) AND (b.code_bibliographie = e.code_bibliographie))
  ORDER BY e.nom_genre, e.nom_espece, e.auteur_date, s.nom_statut_espece, b.reference, b.annee, e.reference_page, e.id_statut, e.id_nomenclature_espece, e.id_espece_valide, e.id_note, b.code_bibliographie;

DROP VIEW IF EXISTS "v_plante";
CREATE VIEW "v_plante" AS SELECT e.id_espece_valide,
    e.nom_genre,
    e.nom_espece,
    p.famille,
    p.genre,
    p.espece,
    p.id_plante
   FROM ONLY plante_hote h,
    ONLY plante p,
    ONLY espece_valide e,
    ONLY nomenclature_espece n
  WHERE (((p.id_plante)::text = (h.id_plante)::text) AND (h.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide));

DROP VIEW IF EXISTS "v_plante_hote";
CREATE VIEW "v_plante_hote" AS SELECT e.id_espece_valide,
    n.id_nomenclature_espece,
    h.id_plante,
    p.famille,
    p.genre,
    p.espece
   FROM ONLY espece_valide e,
    ONLY nomenclature_espece n,
    ONLY plante_hote h,
    ONLY plante p
  WHERE ((e.id_espece_valide = n.id_espece_valide) AND (n.id_nomenclature_espece = h.id_nomenclature_espece) AND ((h.id_plante)::text = (p.id_plante)::text))
  ORDER BY p.famille;

DROP VIEW IF EXISTS "v_repartition";
CREATE VIEW "v_repartition" AS SELECT e.id_espece_valide,
    n.id_nomenclature_espece,
    r.id_pays,
    z.nom_zone_biogeographique,
    p.nom_pays
   FROM ONLY espece_valide e,
    ONLY nomenclature_espece n,
    ONLY repartition r,
    ONLY pays p,
    ONLY zone_biogeographique z
  WHERE ((e.id_espece_valide = n.id_espece_valide) AND (n.id_nomenclature_espece = r.id_nomenclature_espece) AND (r.id_pays = p.id_pays) AND (p.id_zone_biogeographique = z.id_zone_biogeographique))
  ORDER BY z.nom_zone_biogeographique;

DROP VIEW IF EXISTS "v_species_reference_distribution";
CREATE VIEW "v_species_reference_distribution" AS SELECT DISTINCT r.id_pays,
    n.id_espece_valide,
    r.id_nomenclature_espece,
    r.code_bibliographie,
    b.reference,
    b.annee
   FROM ONLY repartition r,
    ONLY nomenclature_espece n,
    ONLY bibliographie b
  WHERE ((r.id_nomenclature_espece = n.id_nomenclature_espece) AND (r.code_bibliographie = b.code_bibliographie))
  ORDER BY r.id_pays, n.id_espece_valide, r.id_nomenclature_espece, r.code_bibliographie, b.reference, b.annee;

DROP VIEW IF EXISTS "v_species_reference_host";
CREATE VIEW "v_species_reference_host" AS SELECT DISTINCT h.id_plante,
    n.id_espece_valide,
    h.id_nomenclature_espece,
    h.code_bibliographie,
    b.reference,
    b.annee
   FROM ONLY plante_hote h,
    ONLY nomenclature_espece n,
    ONLY bibliographie b
  WHERE ((h.id_nomenclature_espece = n.id_nomenclature_espece) AND (h.code_bibliographie = b.code_bibliographie))
  ORDER BY h.id_plante, n.id_espece_valide, h.id_nomenclature_espece, h.code_bibliographie, b.reference, b.annee;

DROP VIEW IF EXISTS "v_synonym_liste";
CREATE VIEW "v_synonym_liste" AS SELECT DISTINCT v_nomenclature.genre,
    v_nomenclature.espece,
    v_nomenclature.auteur_date,
    v_nomenclature.nom_statut,
    v_nomenclature.reference,
    v_nomenclature.reference_page,
    v_nomenclature.id_espece_valide,
    v_nomenclature.id_note
   FROM ONLY v_nomenclature
  WHERE (v_nomenclature.id_statut <> 10)
  ORDER BY v_nomenclature.genre, v_nomenclature.espece, v_nomenclature.auteur_date, v_nomenclature.nom_statut, v_nomenclature.reference, v_nomenclature.reference_page, v_nomenclature.id_espece_valide, v_nomenclature.id_note;

DROP VIEW IF EXISTS "v_visiteurs_pays";
CREATE VIEW "v_visiteurs_pays" AS SELECT DISTINCT c.ip_number,
    i.country_name
   FROM ONLY compteur c,
    ONLY ip_to_country i
  WHERE ((c.ip_number >= i.ip_from) AND (c.ip_number <= i.ip_to))
  ORDER BY c.ip_number, i.country_name;

--Deux vues déplacées car font appel à des vues qui n'avaient pas été instanciées

DROP VIEW IF EXISTS "v_bibliography_distribution";
CREATE VIEW "v_bibliography_distribution" AS SELECT DISTINCT b.code_bibliographie,
    v.nom_zone_biogeographique,
    v.nom_pays,
    e.nom_genre,
    e.nom_espece,
    e.auteur_date,
    e.id_espece_valide
   FROM ONLY bibliographie b,
    ONLY v_repartition v,
    ONLY repartition r,
    ONLY nomenclature_espece n,
    ONLY espece_valide e
  WHERE ((b.code_bibliographie = r.code_bibliographie) AND (r.id_pays = v.id_pays) AND (r.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide))
  ORDER BY v.nom_zone_biogeographique, v.nom_pays, e.nom_genre, e.nom_espece, b.code_bibliographie, e.auteur_date, e.id_espece_valide;


DROP VIEW IF EXISTS "v_bibliography_host";
CREATE VIEW "v_bibliography_host" AS SELECT DISTINCT b.code_bibliographie,
    p.famille,
    p.genre,
    p.espece,
    e.nom_genre,
    e.nom_espece,
    e.auteur_date,
    e.id_espece_valide
   FROM ONLY bibliographie b,
    ONLY plante_hote h,
    ONLY v_plante_hote p,
    ONLY espece_valide e,
    ONLY nomenclature_espece n
  WHERE ((b.code_bibliographie = h.code_bibliographie) AND ((h.id_plante)::text = (p.id_plante)::text) AND (h.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide))
  ORDER BY e.nom_genre, e.nom_espece, p.famille, p.genre, p.espece, b.code_bibliographie, e.auteur_date, e.id_espece_valide;
-- 2022-04-05 14:02:48.37501+00
