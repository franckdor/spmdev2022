--Mein fichier SQL

CREATE TABLE admin (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    login VARCHAR(32),
    mdp VARCHAR(64),
);

CREATE SEQUENCE ris_id_seq;

CREATE TABLE ris (
    id_ris INT PRIMARY KEY NOT NULL DEFAULT nextval('ris_id_seq'),
    TY VARCHAR(500),
    A1 VARCHAR(500),
    AB VARCHAR(500),
    DA DATE,
    DB VARCHAR(500),
    ED VARCHAR(500),
    EP VARCHAR(500),
    ID VARCHAR(500),
    LA VARCHAR(500),
    LK VARCHAR(500),
    N1 VARCHAR(500),
    N2 VARCHAR(500),
    OP VARCHAR(500),
    RN VARCHAR(500),
    UR VARCHAR(500),
);



ALTER TABLE bibliographie ADD
occurences VARCHAR(50),
ADD TAP VARCHAR(50);

CREATE SEQUENCE biblio_id_seq

ALTER SEQUENCE ris_id_seq OWNED BY ris.id_ris;
//
OR 
//
CREATE TABLE ris (
    id_ris INT,
    tag VARCHAR(2),
    value VARCHAR(500)
)


CREATE OR REPLACE TRIGGER after_nomenclature_valid
AFTER INSERT OR UPDATE
ON nomenclature_espece FOR EACH ROW
EXECUTE PROCEDURE trigger_function();

CREATE OR REPLACE FUNCTION trigger_function() 
   RETURNS TRIGGER 
   LANGUAGE PLPGSQL
AS $$
BEGIN
   IF NEW.id_statut = 10 THEN
        INSERT INTO espece_valide(nom_genre, nom_espece, auteur_date, reference_page, code_bibliographie)
        VALUES(new.nom_genre, new.nom_espece, new.auteur_date, new.reference_page, new.code_bibliographie);
    END IF;
    return NEW;
END;
$$

CREATE OR REPLACE TRIGGER after_nomenclature_genus_valid
AFTER INSERT OR UPDATE
ON nomenclature_genre FOR EACH ROW
EXECUTE PROCEDURE trigger_genus();

CREATE OR REPLACE FUNCTION trigger_genus() 
   RETURNS TRIGGER 
   LANGUAGE PLPGSQL
AS $$
BEGIN
   IF NEW.id_statut = 10 THEN
        INSERT INTO genre_valide(nom_genre, reference_page, id_classification, reference_page, code_bibliographie)
        VALUES(new.genre, new.code_reference, , new.code_bibliographie);
    END IF;
    return NEW;
END;
$$


CREATE OR REPLACE FUNCTION searchIdClassificationName(name text)     
RETURNS integer   
LANGUAGE plpgsql  
AS $$    
DECLARE
id integer; 
BEGIN    
  SELECT id_classification INTO id
  FROM classification cl
  JOIN genres g ON 
  WHERE name 

RETURN id; 
END;   
$$  

SELECT searchIdClassificationName('Tetranychini');

ALTER TABLE nomenclature_espece
ADD utilisateur VARCHAR(32),
ADD date_add DATE;

ALTER TABLE nomenclature_genre
ADD utilisateur VARCHAR(32);
ADD date_add DATE,
ADD tribu VARCHAR(32),
ADD sous-famille VARCHAR(32);

ALTER TABLE plante_hote
ADD utilisateur VARCHAR(32),
ADD date_add DATE,
ADD valid Boolean,
ADD original_data Boolean,
ADD synthesis Boolean; 

--EN ATTENDANT ALAIN

CREATE TABLE genres (
    Code_genre VARCHAR(32),
    Genre VARCHAR(32),
    Tribu VARCHAR(32),
    Sous_famille VARCHAR(32),
    Code_genre_valide VARCHAR(32),
    Code_famille VARCHAR(32),
    Code_reference VARCHAR(32),
    Page VARCHAR(32),
    Code_Statut VARCHAR(32),
    Code_espece_type VARCHAR(32),
    Ordre_taxonomique VARCHAR(32),
    Note_imp VARCHAR(32),
    Note_enr VARCHAR(32),
    Date_maj DATE,
    Utilisateur VARCHAR(32)
);

INSERT INTO GENRES VALUES
    ('1','Eurytetranychoides','Eurytetranychini','Tetranychinae','1','1','6965',NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('2','Eurytetranychus','Eurytetranychini','Tetranychinae','2','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('3','Eutetranychus','Eurytetranychini','Tetranychinae','3','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('4','Meyernychus','Eurytetranychini','Tetranychinae','4','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('5','Paraponychus','Eurytetranychini','Tetranychinae','5','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('6','Sinotetranychus','Eurytetranychini','Tetranychinae','6','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('7','Synonychus','Eurytetranychini','Tetranychinae','7','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('8','Afronobia','Hystrichonychini','Bryobiinae','8','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('9','Aplonobia','Hystrichonychini','Bryobiinae','9','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('10','Beerella','Hystrichonychini','Bryobiinae','10','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('11','Bryocopsis','Hystrichonychini','Bryobiinae','11','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('12','Dolichonobia','Hystrichonychini','Bryobiinae','12','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('13','Hystrichonychus','Hystrichonychini','Bryobiinae','13','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('14','Magdalena','Hystrichonychini','Bryobiinae','14','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('15','Mesobryobia','Hystrichonychini','Bryobiinae','15','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('16','Monoceronychus','Hystrichonychini','Bryobiinae','16','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('17','Neopetrobia (Langella)','Hystrichonychini','Bryobiinae','17','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('18','Neopetrobia (Neopetrobia)','Hystrichonychini','Bryobiinae','18','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('19','Neopetrobia (Reckia)','Hystrichonychini','Bryobiinae','19','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('20','Notonychus','Hystrichonychini','Bryobiinae','20','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('21','Parapetrobia','Hystrichonychini','Bryobiinae','21','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('22','Paraplonobia (Anaplonobia)','Hystrichonychini','Bryobiinae','22','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('23','Paraplonobia (Brachynychus)','Hystrichonychini','Bryobiinae','23','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('24','Paraplonobia (Paraplonobia)','Hystrichonychini','Bryobiinae','24','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('25','Peltanobia','Hystrichonychini','Bryobiinae','25','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('26','Porcupinychus','Hystrichonychini','Bryobiinae','26','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('27','Tauriobia','Hystrichonychini','Bryobiinae','27','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('28','Tribolonychus','Tetranychini','Tetranychinae','28','1','6829','321','10','3417',NULL,NULL,NULL,'2005-06-09 11:49:45'),
    ('29','Crotonella','Tenuipalpoidini','Tetranychinae','29','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('30','Eonychus','Tenuipalpoidini','Tetranychinae','30','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('31','Tenuipalpoides','Tenuipalpoidini','Tetranychinae','31','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('32','Tenuipalponychus','Tenuipalpoidini','Tetranychinae','32','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('33','Acanthonychus','Tetranychini','Tetranychinae','52','1','8592','2','10',NULL,NULL,NULL,NULL,'2022-04-05 10:23:55'),
    ('34','Allonychus','Tetranychini','Tetranychinae','34','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('35','Amphitetranychus','Tetranychini','Tetranychinae','35','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('36','Atrichoproctus','Tetranychini','Tetranychinae','36','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('37','Brevinychus','Tetranychini','Tetranychinae','37','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('38','Eotetranychus','Tetranychini','Tetranychinae','38','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('39','Evertella','Tetranychini','Tetranychinae','39','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('40','Hellenychus','Tetranychini','Tetranychinae','40','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('41','Mixonychus (Bakerina)','Tetranychini','Tetranychinae','41','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('42','Mixonychus (Mixonychus)','Tetranychini','Tetranychinae','42','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('43','Mixonychus (Tylonychus)','Tetranychini','Tetranychinae','43','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('44','Mononychellus','Tetranychini','Tetranychinae','44','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('45','Neotetranychus','Tetranychini','Tetranychinae','45','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('46','Oligonychus','Tetranychini','Tetranychinae','46','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('47','Palmanychus','Tetranychini','Tetranychinae','47','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('48','Panonychus','Tetranychini','Tetranychinae','48','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('49','Platytetranychus','Tetranychini','Tetranychinae','49','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('50','Schizotetranychus','Tetranychini','Tetranychinae','50','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('51','Sonotetranychus','Tetranychini','Tetranychinae','51','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('52','Tetranychus','Tetranychini','Tetranychinae','52','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('53','Xinella','Tetranychini','Tetranychinae','53','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('54','Yezonychus','Tetranychini','Tetranychinae','54','1','6927','90','10','3420',NULL,NULL,NULL,'2005-06-09 11:49:20'),
    ('55','Yunonychus','Tetranychini','Tetranychinae','55','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('56','Bryobia','Bryobiini','Bryobiinae','56','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('57','Bryobiella','Bryobiini','Bryobiinae','57','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('58','Eremobryobia','Bryobiini','Bryobiinae','58','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('59','Hemibryobia','Bryobiini','Bryobiinae','59','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('60','Marainobia','Bryobiini','Bryobiinae','60','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('61','Neoschizonobiella','Bryobiini','Bryobiinae','61','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('62','Pseudobryobia','Bryobiini','Bryobiinae','62','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('63','Sinobryobia','Bryobiini','Bryobiinae','63','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('64','Strunkobia','Bryobiini','Bryobiinae','64','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('65','Toronobia','Bryobiini','Bryobiinae','65','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('66','Tetranycopsis','Hystrichonychini','Bryobiinae','66','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('67','Dasyobia','Petrobiini','Bryobiinae','67','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('68','Edella','Petrobiini','Bryobiinae','68','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('69','Lindquistiella','Petrobiini','Bryobiinae','69','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('70','Mezranobia','Petrobiini','Bryobiinae','70','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('71','Neotrichobia','Petrobiini','Bryobiinae','71','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('72','Petrobia (Mesotetranychus)','Petrobiini','Bryobiinae','72','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('73','Petrobia (Petrobia)','Petrobiini','Bryobiinae','73','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('74','Petrobia (Tetranychina)','Petrobiini','Bryobiinae','74','1',NULL,NULL,'10','1515',NULL,NULL,NULL,'2022-05-02 09:32:28'),
    ('75','Schizonobia','Petrobiini','Bryobiinae','75','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('76','Schizonobiella','Petrobiini','Bryobiinae','76','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('77','Anatetranychus','Eurytetranychini','Tetranychinae','77','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('78','Aponychus','Eurytetranychini','Tetranychinae','78','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('79','Atetranychus','Eurytetranychini','Tetranychinae','79','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('80','Duplanychus','Eurytetranychini','Tetranychinae','80','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('81','Stylophoronychus','Eurytetranychini','Tetranychinae','81','1',NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL),
    ('82','Diplonychus','Tetranychini','Tetranychinae','82','1','8087','75','10','2612',NULL,NULL,NULL,NULL),
    ('83','Swarnanychus','Tenuipalpoidini','Tetranychinae','83','1','8094',NULL,'10','3445',NULL,NULL,NULL,NULL),
    ('84','Stigmaeopsis','Tetranychini','Tetranychinae','84','1','145','193','10','1798',NULL,NULL,NULL,'2005-06-09 11:49:59'),
    ('85','Neonidulus','Tetranychini','Tetranychinae','85','1','8911','3','10','2413',NULL,NULL,NULL,'2011-08-24 15:32:04'),
    ('86','Georgiobia','Hystrichonychini','Bryobiinae','86','1','8009','224','10','976',NULL,NULL,NULL,NULL),
    ('88','Sasanychys','Tetranychini','Tetranychinae','88','1','6930',NULL,'10','2091',NULL,NULL,NULL,NULL),
    ('89','Nuciforaella','Bryobiini','Bryobiinae','89','1','6133',NULL,'10',NULL,NULL,NULL,NULL,NULL);

ALTER TABLE "public"."genres" ALTER COLUMN "code_genre" TYPE integer USING (code_genre::integer)
ALTER TABLE "public"."genres" ALTER COLUMN "code_genre_valide" TYPE integer USING (code_genre_valide::integer)
ALTER TABLE "public"."genres" ALTER COLUMN "code_famille" TYPE integer USING (code_famille::integer)
ALTER TABLE "public"."genres" ALTER COLUMN "code_reference" TYPE integer USING (code_reference::integer)
ALTER TABLE "public"."genres" ALTER COLUMN "code_statut" TYPE integer USING (code_statut::integer)
ALTER TABLE "public"."genres" ALTER COLUMN "code_espece_type" TYPE integer USING (code_espece_type::integer)
ALTER TABLE "public"."genres" ADD PRIMARY KEY (code_genre);

CREATE TABLE IF NOT EXISTS FAMILLES (
    Code_famille INT,
    Famille VARCHAR(13),
    Super_famille VARCHAR(14),
    Infra_ordre INT,
    Sous_ordre INT,
    Ordre VARCHAR(5),
    Code_ordre INT,
    Reference INT,
    Page INT,
    Ordre_taxonomique INT,
    PRIMARY KEY (code_famille)
);
INSERT INTO FAMILLES VALUES
    (1,'Tetranychidae','Tetranychoidea',NULL,NULL,'Acari',0,NULL,NULL,NULL);

CREATE TABLE "world_flora_online" (

	"taxonID"	TEXT,

	"scientificNameID"	TEXT,

	"localID"	TEXT,

	"scientificName"	TEXT,

	"taxonRank"	TEXT,

	"parentNameUsageID"	TEXT,

	"scientificNameAuthorship"	TEXT,

	"family"	TEXT,

	"subfamily"	TEXT,

	"tribe"	TEXT,

	"subtribe"	TEXT,

	"genus"	TEXT,

	"subgenus"	TEXT,

	"specificEpithet"	TEXT,

	"infraspecificEpithet"	TEXT,

	"verbatimTaxonRank"	TEXT,

	"nomenclaturalStatus"	TEXT,

	"namePublishedIn"	TEXT,

	"taxonomicStatus"	TEXT,

	"acceptedNameUsageID"	TEXT,

	"originalNameUsageID"	TEXT,

	"nameAccordingToID"	TEXT,

	"taxonRemarks"	TEXT,

	"created"	TEXT,

	"modified"	TEXT,

	"references"	TEXT,

	"source"	TEXT,

	"majorGroup"	TEXT,

	"tplId"	TEXT

)

ALTER TABLE nomenclature_genre
RENAME TO genre;

ALTER TABLE genres
RENAME TO nomenclature_genre;