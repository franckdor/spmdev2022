--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

-- Started on 2022-06-24 15:43:22

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 267 (class 1255 OID 18016)
-- Name: searchidclassificationname(name); Type: FUNCTION; Schema: public; Owner: postgres
--
/*

SUPPRESSED TRIGGER : J.Besse : 24/06/2022

CREATE FUNCTION public.searchidclassificationname(name) RETURNS integer
    LANGUAGE plpgsql
    AS $$    
DECLARE
id integer; 
BEGIN    
  SELECT id_classification INTO id
  FROM classification
  WHERE name IN (SELECT nom_classification
                FROM classification);
RETURN id; 
END;   
$$;


ALTER FUNCTION public.searchidclassificationname(name) OWNER TO postgres;

--
-- TOC entry 269 (class 1255 OID 18017)
-- Name: searchidclassificationname(text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.searchidclassificationname(name text) RETURNS integer
    LANGUAGE plpgsql
    AS $$    
DECLARE
id integer; 
BEGIN    
  SELECT id_classification INTO id
  FROM classification
  WHERE name = (SELECT nom_classification
                FROM classification);
RETURN id; 
END;   
$$;


ALTER FUNCTION public.searchidclassificationname(name text) OWNER TO postgres;

--
-- TOC entry 268 (class 1255 OID 17992)
-- Name: trigger_function(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.trigger_function() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
   IF NEW.id_statut = 10 THEN
        INSERT INTO espece_valide(nom_genre, nom_espece, auteur_date, reference_page, code_bibliographie)
        VALUES(new.nom_genre, new.nom_espece, new.auteur_date, new.reference_page, new.code_bibliographie);
    END IF;
    return NEW;
END;
$$;


ALTER FUNCTION public.trigger_function() OWNER TO postgres;
*/
SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 266 (class 1259 OID 18023)
-- Name: _occurence_occurence; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public._occurence_occurence (
    code_occurence integer DEFAULT NULL::numeric,
    code_repartition character varying(6) DEFAULT NULL::character varying,
    code_reference numeric(5,1) DEFAULT NULL::numeric,
    code_espece numeric(6,1) DEFAULT NULL::numeric,
    code_pays numeric(5,1) DEFAULT NULL::numeric,
    date_maj character varying(11) DEFAULT NULL::character varying,
    qui_maj character varying(2) DEFAULT NULL::character varying,
    localite character varying(103) DEFAULT NULL::character varying,
    latitude character varying(10) DEFAULT NULL::character varying,
    longitude character varying(11) DEFAULT NULL::character varying,
    "precision" character varying(11) DEFAULT NULL::character varying
);


ALTER TABLE public._occurence_occurence OWNER TO postgres;

--
-- TOC entry 252 (class 1259 OID 17871)
-- Name: admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    login character varying(32) NOT NULL,
    mdp character varying(64) NOT NULL
);


ALTER TABLE public.admin OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 17215)
-- Name: arbre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.arbre (
    id_espece_valide integer,
    rang integer,
    fils character varying(50),
    pere character varying(50)
);


ALTER TABLE public.arbre OWNER TO postgres;

--
-- TOC entry 264 (class 1259 OID 18011)
-- Name: seq_code_biblio; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_code_biblio
    START WITH 9809
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_code_biblio OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 17218)
-- Name: bibliographie; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bibliographie (
    code_bibliographie integer DEFAULT nextval('public.seq_code_biblio'::regclass) NOT NULL,
    reference character varying(512),
    auteur character varying(1024),
    annee integer,
    titre character varying(512),
    source character varying(512),
    id_note integer,
    occurences character varying(50),
    tap character varying(50)
);


ALTER TABLE public.bibliographie OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 17223)
-- Name: classification; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.classification (
    id_classification integer NOT NULL,
    nom_classification character varying(100),
    reference_page character varying(20),
    id_note integer,
    code_bibliographie integer,
    id_rang integer
);


ALTER TABLE public.classification OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 17228)
-- Name: classification_superieure; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.classification_superieure (
    id_classification_fils integer NOT NULL,
    id_classification_pere integer NOT NULL
);


ALTER TABLE public.classification_superieure OWNER TO postgres;

--
-- TOC entry 259 (class 1259 OID 17924)
-- Name: code_famille_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.code_famille_id
    START WITH 2
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.code_famille_id OWNER TO postgres;

--
-- TOC entry 257 (class 1259 OID 17914)
-- Name: code_genre_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.code_genre_id
    START WITH 90
    INCREMENT BY 1
    MINVALUE 89
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.code_genre_id OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 17233)
-- Name: compteur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.compteur (
    ip character varying(15) NOT NULL,
    date date NOT NULL,
    ip_number bigint,
    country_name character varying(50)
);


ALTER TABLE public.compteur OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 17238)
-- Name: compteur_nature; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.compteur_nature (
    ip character varying(15) NOT NULL,
    date date NOT NULL,
    ip_number bigint,
    id_number bigint NOT NULL,
    id_nature character varying(15) NOT NULL,
    country_name character varying(50)
);


ALTER TABLE public.compteur_nature OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 17243)
-- Name: continent; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.continent (
    id_continent integer NOT NULL,
    nom_continent character varying(50)
);


ALTER TABLE public.continent OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 17248)
-- Name: contributor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contributor (
    id_contributor integer NOT NULL,
    first_name_contributor character varying(250),
    name_contributor character varying(250),
    country_contributor character varying(250)
);


ALTER TABLE public.contributor OWNER TO postgres;

--
-- TOC entry 254 (class 1259 OID 17888)
-- Name: espece_valide_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.espece_valide_id
    START WITH 14070
    INCREMENT BY 1
    MINVALUE 14069
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.espece_valide_id OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 17255)
-- Name: espece_valide; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.espece_valide (
    id_espece_valide integer DEFAULT nextval('public.espece_valide_id'::regclass) NOT NULL,
    nom_genre character varying(100),
    nom_espece character varying(100),
    auteur_date character varying(500),
    id_note integer,
    reference_page character varying(20),
    code_bibliographie integer,
    bolland integer,
    id_genre_valide integer
);


ALTER TABLE public.espece_valide OWNER TO postgres;

--
-- TOC entry 258 (class 1259 OID 17918)
-- Name: familles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.familles (
    code_famille integer DEFAULT nextval('public.code_famille_id'::regclass) NOT NULL,
    famille character varying(13),
    super_famille character varying(14),
    infra_ordre integer,
    sous_ordre integer,
    ordre character varying(5),
    code_ordre integer,
    reference integer,
    page integer,
    ordre_taxonomique integer
);


ALTER TABLE public.familles OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 17262)
-- Name: gallery; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.gallery (
    id_gallery integer NOT NULL,
    name_gallery character varying(250),
    name_gallery_url character varying(250),
    name_image character varying(250),
    description text,
    url character varying(250)
);


ALTER TABLE public.gallery OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 17299)
-- Name: genre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.genre (
    id_nomenclature_genre integer NOT NULL,
    nom_genre character varying(100),
    reference_page character varying(20),
    code_bibliographie integer,
    id_genre_valide integer,
    id_nomenclature_espece integer,
    id_note integer,
    id_statut_genre integer,
    utilisateur character varying(32),
    date_maj date,
    tribu character varying(32),
    sous_famille character varying(32)
);


ALTER TABLE public.genre OWNER TO postgres;

--
-- TOC entry 265 (class 1259 OID 18018)
-- Name: seq_code_genre_valid; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_code_genre_valid
    START WITH 87
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 10000
    CACHE 1;


ALTER TABLE public.seq_code_genre_valid OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 17269)
-- Name: genre_valide; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.genre_valide (
    id_genre_valide integer DEFAULT nextval('public.seq_code_genre_valid'::regclass) NOT NULL,
    nom_genre character varying(100),
    reference_page character varying(20),
    code_bibliographie integer,
    id_classification integer,
    id_note integer
);


ALTER TABLE public.genre_valide OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 17274)
-- Name: geo_lien_level4_pays; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.geo_lien_level4_pays (
    id_level4 integer,
    nom_level4 character varying(255),
    id_pays integer,
    nom_pays character varying(255)
);


ALTER TABLE public.geo_lien_level4_pays OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 17279)
-- Name: ip_to_country; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ip_to_country (
    ip_from bigint NOT NULL,
    ip_to bigint NOT NULL,
    country_code character(2),
    country_code_3 character(3),
    country_name character varying(50)
);


ALTER TABLE public.ip_to_country OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 17284)
-- Name: level4json_polygones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.level4json_polygones (
    id_level4 integer,
    polygone text
);


ALTER TABLE public.level4json_polygones OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 17289)
-- Name: level4web; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.level4web (
    id_level4 integer,
    nom_level4 character varying(35),
    id_zone_bi integer,
    name character varying(35),
    presence integer
);


ALTER TABLE public.level4web OWNER TO postgres;

--
-- TOC entry 253 (class 1259 OID 17883)
-- Name: seq_nomenclature_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_nomenclature_id
    START WITH 14070
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_nomenclature_id OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 17292)
-- Name: nomenclature_espece; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nomenclature_espece (
    id_nomenclature_espece integer DEFAULT nextval('public.seq_nomenclature_id'::regclass) NOT NULL,
    nom_genre character varying(100),
    nom_espece character varying(100),
    auteur_date character varying(500),
    reference_page character varying(20),
    code_bibliographie integer,
    id_statut integer,
    id_note integer,
    id_espece_valide integer,
    date_add date,
    utilisateur character varying(32)
);


ALTER TABLE public.nomenclature_espece OWNER TO postgres;

--
-- TOC entry 256 (class 1259 OID 17893)
-- Name: nomenclature_genre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nomenclature_genre (
    code_genre integer DEFAULT nextval('public.code_genre_id'::regclass) NOT NULL,
    genre character varying(32),
    tribu character varying(32),
    sous_famille character varying(32),
    code_genre_valide integer,
    code_famille integer,
    code_reference integer,
    page character varying(32),
    id_statut integer,
    code_espece_type integer,
    ordre_taxonomique character varying(32),
    note_imp character varying(32),
    note_enr character varying(32),
    date_maj date,
    utilisateur character varying(32)
);


ALTER TABLE public.nomenclature_genre OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 17304)
-- Name: note; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.note (
    id_note integer NOT NULL,
    note text
);


ALTER TABLE public.note OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 17311)
-- Name: pays; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pays (
    id_pays integer NOT NULL,
    nom_pays character varying(255),
    id_continent integer,
    id_zone_biogeographique integer
);


ALTER TABLE public.pays OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 17316)
-- Name: plante; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plante (
    id_plante character varying(100) NOT NULL,
    embranchement character varying(50),
    classe character varying(50),
    ordre character varying(50),
    famille character varying(50),
    genre character varying(50),
    espece character varying(50),
    auteur_date character varying(100)
);


ALTER TABLE public.plante OWNER TO postgres;

--
-- TOC entry 255 (class 1259 OID 17890)
-- Name: plante_hote_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.plante_hote_id
    START WITH 17357
    INCREMENT BY 1
    MINVALUE 15475
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.plante_hote_id OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 17323)
-- Name: plante_hote; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plante_hote (
    id_plante_hote integer DEFAULT nextval('public.plante_hote_id'::regclass) NOT NULL,
    id_plante character varying(100),
    id_nomenclature_espece integer,
    code_bibliographie integer,
    utilisateur character varying(32),
    date_add date,
    original_data boolean,
    synthesis boolean,
    valid boolean
);


ALTER TABLE public.plante_hote OWNER TO postgres;

--
-- TOC entry 260 (class 1259 OID 17931)
-- Name: plants; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plants (
    "plant_ID" text,
    phylum text,
    class text,
    "order" text,
    family text,
    genus text,
    species text,
    scientific_name text,
    scientific_name_authorship text,
    taxon_rank text,
    taxonomic_status text,
    "parent_name_usage_ID" text,
    "accepted_name_usage_ID" text,
    "original_name_usage_ID" text,
    tplid text,
    synonym text
);


ALTER TABLE public.plants OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 17328)
-- Name: rang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rang (
    id_rang integer NOT NULL,
    nom_rang character varying(100)
);


ALTER TABLE public.rang OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 17333)
-- Name: repartition; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.repartition (
    id_repartition integer NOT NULL,
    id_pays integer,
    code_bibliographie integer,
    id_nomenclature_espece integer,
    printed_note text,
    valid boolean,
    original boolean,
    synthesis boolean,
    date_upd date,
    who_upd character varying(32)
);


ALTER TABLE public.repartition OWNER TO postgres;

--
-- TOC entry 263 (class 1259 OID 18002)
-- Name: ris; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ris (
    id_ris integer NOT NULL,
    tag character varying(2),
    value character varying(500)
);


ALTER TABLE public.ris OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 17340)
-- Name: robot; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.robot (
    id_crawler integer NOT NULL,
    crawler_user_agent character varying(255),
    crawler_name character varying(45),
    crawler_url character varying(255),
    crawler_info character varying(255),
    crawler_ip character varying(16)
);


ALTER TABLE public.robot OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 17870)
-- Name: seq_admin_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_admin_id
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_admin_id OWNER TO postgres;

--
-- TOC entry 3607 (class 0 OID 0)
-- Dependencies: 251
-- Name: seq_admin_id; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.seq_admin_id OWNED BY public.admin.id;


--
-- TOC entry 262 (class 1259 OID 18001)
-- Name: seq_ris_id_ris; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_ris_id_ris
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_ris_id_ris OWNER TO postgres;

--
-- TOC entry 3608 (class 0 OID 0)
-- Dependencies: 262
-- Name: seq_ris_id_ris; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.seq_ris_id_ris OWNED BY public.ris.id_ris;


--
-- TOC entry 233 (class 1259 OID 17345)
-- Name: statut_espece; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.statut_espece (
    id_statut_espece integer NOT NULL,
    nom_statut_espece character varying(100)
);


ALTER TABLE public.statut_espece OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 17350)
-- Name: statut_genre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.statut_genre (
    id_statut_genre integer NOT NULL,
    nom_statut_genre character varying(50)
);


ALTER TABLE public.statut_genre OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 17355)
-- Name: zone_biogeographique; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.zone_biogeographique (
    id_zone_biogeographique integer NOT NULL,
    nom_zone_biogeographique character varying(50)
);


ALTER TABLE public.zone_biogeographique OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 17393)
-- Name: v_repartition; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_repartition AS
 SELECT e.id_espece_valide,
    n.id_nomenclature_espece,
    r.id_pays,
    z.nom_zone_biogeographique,
    p.nom_pays
   FROM ONLY public.espece_valide e,
    ONLY public.nomenclature_espece n,
    ONLY public.repartition r,
    ONLY public.pays p,
    ONLY public.zone_biogeographique z
  WHERE ((e.id_espece_valide = n.id_espece_valide) AND (n.id_nomenclature_espece = r.id_nomenclature_espece) AND (r.id_pays = p.id_pays) AND (p.id_zone_biogeographique = z.id_zone_biogeographique))
  ORDER BY z.nom_zone_biogeographique;


ALTER TABLE public.v_repartition OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 17413)
-- Name: v_bibliography_distribution; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_bibliography_distribution AS
 SELECT DISTINCT b.code_bibliographie,
    v.nom_zone_biogeographique,
    v.nom_pays,
    e.nom_genre,
    e.nom_espece,
    e.auteur_date,
    e.id_espece_valide
   FROM ONLY public.bibliographie b,
    ONLY public.v_repartition v,
    ONLY public.repartition r,
    ONLY public.nomenclature_espece n,
    ONLY public.espece_valide e
  WHERE ((b.code_bibliographie = r.code_bibliographie) AND (r.id_pays = v.id_pays) AND (r.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide))
  ORDER BY v.nom_zone_biogeographique, v.nom_pays, e.nom_genre, e.nom_espece, b.code_bibliographie, e.auteur_date, e.id_espece_valide;


ALTER TABLE public.v_bibliography_distribution OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 17389)
-- Name: v_plante_hote; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_plante_hote AS
 SELECT e.id_espece_valide,
    n.id_nomenclature_espece,
    h.id_plante,
    p.famille,
    p.genre,
    p.espece
   FROM ONLY public.espece_valide e,
    ONLY public.nomenclature_espece n,
    ONLY public.plante_hote h,
    ONLY public.plante p
  WHERE ((e.id_espece_valide = n.id_espece_valide) AND (n.id_nomenclature_espece = h.id_nomenclature_espece) AND ((h.id_plante)::text = (p.id_plante)::text))
  ORDER BY p.famille;


ALTER TABLE public.v_plante_hote OWNER TO postgres;

--
-- TOC entry 250 (class 1259 OID 17417)
-- Name: v_bibliography_host; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_bibliography_host AS
 SELECT DISTINCT b.code_bibliographie,
    p.famille,
    p.genre,
    p.espece,
    e.nom_genre,
    e.nom_espece,
    e.auteur_date,
    e.id_espece_valide
   FROM ONLY public.bibliographie b,
    ONLY public.plante_hote h,
    ONLY public.v_plante_hote p,
    ONLY public.espece_valide e,
    ONLY public.nomenclature_espece n
  WHERE ((b.code_bibliographie = h.code_bibliographie) AND ((h.id_plante)::text = (p.id_plante)::text) AND (h.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide))
  ORDER BY e.nom_genre, e.nom_espece, p.famille, p.genre, p.espece, b.code_bibliographie, e.auteur_date, e.id_espece_valide;


ALTER TABLE public.v_bibliography_host OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 17360)
-- Name: v_bibliography_species; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_bibliography_species AS
 SELECT DISTINCT b.code_bibliographie,
    e.nom_genre,
    e.nom_espece,
    e.auteur_date,
    e.id_espece_valide
   FROM ONLY public.bibliographie b,
    ONLY public.nomenclature_espece n,
    ONLY public.espece_valide e
  WHERE ((n.code_bibliographie = b.code_bibliographie) AND (n.id_espece_valide = e.id_espece_valide))
  ORDER BY e.nom_genre, e.nom_espece, b.code_bibliographie, e.auteur_date, e.id_espece_valide;


ALTER TABLE public.v_bibliography_species OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 17364)
-- Name: v_classification; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_classification AS
 SELECT DISTINCT c3.nom_classification AS famille,
    c3.id_rang AS rang_famille,
    c2.nom_classification AS sous_famille,
    c2.id_rang AS rang_sous_famille,
    c1.nom_classification AS tribu,
    e.id_espece_valide
   FROM ONLY public.classification c1,
    ONLY public.classification c2,
    ONLY public.classification c3,
    ONLY public.espece_valide e,
    ONLY public.genre_valide g,
    ONLY public.classification_superieure s1,
    ONLY public.classification_superieure s2
  WHERE ((e.id_genre_valide = g.id_genre_valide) AND (g.id_classification = c1.id_classification) AND (c1.id_classification = s1.id_classification_fils) AND (s1.id_classification_pere = c2.id_classification) AND (c2.id_classification = s2.id_classification_fils) AND (s2.id_classification_pere = c3.id_classification))
  ORDER BY c3.nom_classification, c3.id_rang, c2.nom_classification, c2.id_rang, c1.nom_classification, e.id_espece_valide;


ALTER TABLE public.v_classification OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 17368)
-- Name: v_genre; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_genre AS
 SELECT g.nom_genre AS genre,
    e.id_espece_valide,
    e.nom_genre,
    e.nom_espece
   FROM ONLY public.genre_valide g,
    ONLY public.espece_valide e
  WHERE (e.id_genre_valide = g.id_genre_valide);


ALTER TABLE public.v_genre OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 17372)
-- Name: v_geographie; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_geographie AS
 SELECT e.id_espece_valide,
    e.nom_genre,
    e.nom_espece,
    c.nom_continent,
    p.nom_pays,
    z.nom_zone_biogeographique
   FROM ONLY public.repartition r,
    ONLY public.continent c,
    ONLY public.pays p,
    ONLY public.zone_biogeographique z,
    ONLY public.espece_valide e,
    ONLY public.nomenclature_espece n
  WHERE ((p.id_continent = c.id_continent) AND (p.id_zone_biogeographique = z.id_zone_biogeographique) AND (r.id_pays = p.id_pays) AND (r.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide));


ALTER TABLE public.v_geographie OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 17376)
-- Name: v_map; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_map AS
 SELECT e.id_espece_valide,
    n.id_nomenclature_espece,
    r.id_pays,
    l.nom_pays,
    l.id_level4,
    l.nom_level4
   FROM ONLY public.espece_valide e,
    ONLY public.nomenclature_espece n,
    ONLY public.repartition r,
    ONLY public.geo_lien_level4_pays l
  WHERE ((e.id_espece_valide = n.id_espece_valide) AND (n.id_nomenclature_espece = r.id_nomenclature_espece) AND (r.id_pays = l.id_pays))
  ORDER BY e.id_espece_valide;


ALTER TABLE public.v_map OWNER TO postgres;

--
-- TOC entry 241 (class 1259 OID 17380)
-- Name: v_nomenclature; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_nomenclature AS
 SELECT DISTINCT e.nom_genre AS genre,
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
   FROM ONLY public.nomenclature_espece e,
    ONLY public.bibliographie b,
    ONLY public.statut_espece s
  WHERE ((e.id_statut = s.id_statut_espece) AND (b.code_bibliographie = e.code_bibliographie))
  ORDER BY e.nom_genre, e.nom_espece, e.auteur_date, s.nom_statut_espece, b.reference, b.annee, e.reference_page, e.id_statut, e.id_nomenclature_espece, e.id_espece_valide, e.id_note, b.code_bibliographie;


ALTER TABLE public.v_nomenclature OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 17385)
-- Name: v_plante; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_plante AS
 SELECT e.id_espece_valide,
    e.nom_genre,
    e.nom_espece,
    p.famille,
    p.genre,
    p.espece,
    p.id_plante
   FROM ONLY public.plante_hote h,
    ONLY public.plante p,
    ONLY public.espece_valide e,
    ONLY public.nomenclature_espece n
  WHERE (((p.id_plante)::text = (h.id_plante)::text) AND (h.id_nomenclature_espece = n.id_nomenclature_espece) AND (n.id_espece_valide = e.id_espece_valide));


ALTER TABLE public.v_plante OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 17397)
-- Name: v_species_reference_distribution; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_species_reference_distribution AS
 SELECT DISTINCT r.id_pays,
    n.id_espece_valide,
    r.id_nomenclature_espece,
    r.code_bibliographie,
    b.reference,
    b.annee
   FROM ONLY public.repartition r,
    ONLY public.nomenclature_espece n,
    ONLY public.bibliographie b
  WHERE ((r.id_nomenclature_espece = n.id_nomenclature_espece) AND (r.code_bibliographie = b.code_bibliographie))
  ORDER BY r.id_pays, n.id_espece_valide, r.id_nomenclature_espece, r.code_bibliographie, b.reference, b.annee;


ALTER TABLE public.v_species_reference_distribution OWNER TO postgres;

--
-- TOC entry 246 (class 1259 OID 17401)
-- Name: v_species_reference_host; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_species_reference_host AS
 SELECT DISTINCT h.id_plante,
    n.id_espece_valide,
    h.id_nomenclature_espece,
    h.code_bibliographie,
    b.reference,
    b.annee
   FROM ONLY public.plante_hote h,
    ONLY public.nomenclature_espece n,
    ONLY public.bibliographie b
  WHERE ((h.id_nomenclature_espece = n.id_nomenclature_espece) AND (h.code_bibliographie = b.code_bibliographie))
  ORDER BY h.id_plante, n.id_espece_valide, h.id_nomenclature_espece, h.code_bibliographie, b.reference, b.annee;


ALTER TABLE public.v_species_reference_host OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 17405)
-- Name: v_synonym_liste; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_synonym_liste AS
 SELECT DISTINCT v_nomenclature.genre,
    v_nomenclature.espece,
    v_nomenclature.auteur_date,
    v_nomenclature.nom_statut,
    v_nomenclature.reference,
    v_nomenclature.reference_page,
    v_nomenclature.id_espece_valide,
    v_nomenclature.id_note
   FROM ONLY public.v_nomenclature
  WHERE (v_nomenclature.id_statut <> 10)
  ORDER BY v_nomenclature.genre, v_nomenclature.espece, v_nomenclature.auteur_date, v_nomenclature.nom_statut, v_nomenclature.reference, v_nomenclature.reference_page, v_nomenclature.id_espece_valide, v_nomenclature.id_note;


ALTER TABLE public.v_synonym_liste OWNER TO postgres;

--
-- TOC entry 248 (class 1259 OID 17409)
-- Name: v_visiteurs_pays; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_visiteurs_pays AS
 SELECT DISTINCT c.ip_number,
    i.country_name
   FROM ONLY public.compteur c,
    ONLY public.ip_to_country i
  WHERE ((c.ip_number >= i.ip_from) AND (c.ip_number <= i.ip_to))
  ORDER BY c.ip_number, i.country_name;


ALTER TABLE public.v_visiteurs_pays OWNER TO postgres;

--
-- TOC entry 261 (class 1259 OID 17936)
-- Name: world_flora_online; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.world_flora_online (
    "taxonID" text NOT NULL,
    "scientificNameID" text,
    "localID" text,
    "scientificName" text,
    "taxonRank" text,
    "parentNameUsageID" text,
    "scientificNameAuthorship" text,
    family text,
    subfamily text,
    tribe text,
    subtribe text,
    genus text,
    subgenus text,
    "specificEpithet" text,
    "infraspecificEpithet" text,
    "verbatimTaxonRank" text,
    "nomenclaturalStatus" text,
    "namePublishedIn" text,
    "taxonomicStatus" text,
    "acceptedNameUsageID" text,
    "originalNameUsageID" text,
    "nameAccordingToID" text,
    "taxonRemarks" text,
    created text,
    modified text,
    "references" text,
    source text,
    "majorGroup" text,
    "tplId" text
);


ALTER TABLE public.world_flora_online OWNER TO postgres;

--
-- TOC entry 3372 (class 2604 OID 17874)
-- Name: admin id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin ALTER COLUMN id SET DEFAULT nextval('public.seq_admin_id'::regclass);


--
-- TOC entry 3431 (class 2606 OID 17878)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id);


--
-- TOC entry 3387 (class 2606 OID 26216)
-- Name: bibliographie bibliographie_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bibliographie
    ADD CONSTRAINT bibliographie_pkey PRIMARY KEY (code_bibliographie);


--
-- TOC entry 3393 (class 2606 OID 17237)
-- Name: compteur cp_compteur; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compteur
    ADD CONSTRAINT cp_compteur PRIMARY KEY (ip, date);


--
-- TOC entry 3395 (class 2606 OID 17242)
-- Name: compteur_nature cp_compteur_nature; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.compteur_nature
    ADD CONSTRAINT cp_compteur_nature PRIMARY KEY (ip, date, id_number, id_nature);


--
-- TOC entry 3389 (class 2606 OID 17227)
-- Name: classification cp_id_classification; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.classification
    ADD CONSTRAINT cp_id_classification PRIMARY KEY (id_classification);


--
-- TOC entry 3391 (class 2606 OID 17232)
-- Name: classification_superieure cp_id_classification_superieure; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.classification_superieure
    ADD CONSTRAINT cp_id_classification_superieure PRIMARY KEY (id_classification_fils, id_classification_pere);


--
-- TOC entry 3397 (class 2606 OID 17247)
-- Name: continent cp_id_continent; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.continent
    ADD CONSTRAINT cp_id_continent PRIMARY KEY (id_continent);


--
-- TOC entry 3399 (class 2606 OID 17254)
-- Name: contributor cp_id_contributor; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contributor
    ADD CONSTRAINT cp_id_contributor PRIMARY KEY (id_contributor);


--
-- TOC entry 3401 (class 2606 OID 17261)
-- Name: espece_valide cp_id_espece_valide; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.espece_valide
    ADD CONSTRAINT cp_id_espece_valide PRIMARY KEY (id_espece_valide);


--
-- TOC entry 3403 (class 2606 OID 17268)
-- Name: gallery cp_id_gallery; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gallery
    ADD CONSTRAINT cp_id_gallery PRIMARY KEY (id_gallery);


--
-- TOC entry 3405 (class 2606 OID 17273)
-- Name: genre_valide cp_id_genre_valide; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genre_valide
    ADD CONSTRAINT cp_id_genre_valide PRIMARY KEY (id_genre_valide);


--
-- TOC entry 3409 (class 2606 OID 17298)
-- Name: nomenclature_espece cp_id_nomenclature_espece; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nomenclature_espece
    ADD CONSTRAINT cp_id_nomenclature_espece PRIMARY KEY (id_nomenclature_espece);


--
-- TOC entry 3411 (class 2606 OID 17303)
-- Name: genre cp_id_nomenclature_genre; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genre
    ADD CONSTRAINT cp_id_nomenclature_genre PRIMARY KEY (id_nomenclature_genre);


--
-- TOC entry 3413 (class 2606 OID 17310)
-- Name: note cp_id_note; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT cp_id_note PRIMARY KEY (id_note);


--
-- TOC entry 3415 (class 2606 OID 17315)
-- Name: pays cp_id_pays; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pays
    ADD CONSTRAINT cp_id_pays PRIMARY KEY (id_pays);


--
-- TOC entry 3417 (class 2606 OID 17322)
-- Name: plante cp_id_plante; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plante
    ADD CONSTRAINT cp_id_plante PRIMARY KEY (id_plante);


--
-- TOC entry 3419 (class 2606 OID 17327)
-- Name: plante_hote cp_id_plante_hote; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plante_hote
    ADD CONSTRAINT cp_id_plante_hote PRIMARY KEY (id_plante_hote);


--
-- TOC entry 3421 (class 2606 OID 17332)
-- Name: rang cp_id_rang; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rang
    ADD CONSTRAINT cp_id_rang PRIMARY KEY (id_rang);


--
-- TOC entry 3423 (class 2606 OID 17339)
-- Name: repartition cp_id_repartition; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.repartition
    ADD CONSTRAINT cp_id_repartition PRIMARY KEY (id_repartition);


--
-- TOC entry 3425 (class 2606 OID 17349)
-- Name: statut_espece cp_id_statut_espece; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.statut_espece
    ADD CONSTRAINT cp_id_statut_espece PRIMARY KEY (id_statut_espece);


--
-- TOC entry 3427 (class 2606 OID 17354)
-- Name: statut_genre cp_id_statut_genre; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.statut_genre
    ADD CONSTRAINT cp_id_statut_genre PRIMARY KEY (id_statut_genre);


--
-- TOC entry 3429 (class 2606 OID 17359)
-- Name: zone_biogeographique cp_id_zone_biogeographique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.zone_biogeographique
    ADD CONSTRAINT cp_id_zone_biogeographique PRIMARY KEY (id_zone_biogeographique);


--
-- TOC entry 3407 (class 2606 OID 17283)
-- Name: ip_to_country cp_ip_to_country; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ip_to_country
    ADD CONSTRAINT cp_ip_to_country PRIMARY KEY (ip_from, ip_to);


--
-- TOC entry 3435 (class 2606 OID 17922)
-- Name: familles familles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familles
    ADD CONSTRAINT familles_pkey PRIMARY KEY (code_famille);


--
-- TOC entry 3433 (class 2606 OID 17917)
-- Name: nomenclature_genre genres_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nomenclature_genre
    ADD CONSTRAINT genres_pkey PRIMARY KEY (code_genre);


--
-- TOC entry 3447 (class 2620 OID 17993)
-- Name: nomenclature_espece after_nomenclature_valid; Type: TRIGGER; Schema: public; Owner: postgres
--

--CREATE TRIGGER after_nomenclature_valid AFTER INSERT OR UPDATE ON public.nomenclature_espece FOR EACH ROW EXECUTE FUNCTION public.trigger_function();


--
-- TOC entry 3436 (class 2606 OID 26217)
-- Name: bibliographie bibliographie_id_note_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bibliographie
    ADD CONSTRAINT bibliographie_id_note_fkey FOREIGN KEY (id_note) REFERENCES public.note(id_note) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3444 (class 2606 OID 26271)
-- Name: plante_hote code_biblio_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plante_hote
    ADD CONSTRAINT code_biblio_fk FOREIGN KEY (code_bibliographie) REFERENCES public.bibliographie(code_bibliographie) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3437 (class 2606 OID 26222)
-- Name: espece_valide code_biblio_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.espece_valide
    ADD CONSTRAINT code_biblio_foreign FOREIGN KEY (code_bibliographie) REFERENCES public.bibliographie(code_bibliographie) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3438 (class 2606 OID 26227)
-- Name: genre_valide code_biblio_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genre_valide
    ADD CONSTRAINT code_biblio_foreign FOREIGN KEY (code_bibliographie) REFERENCES public.bibliographie(code_bibliographie) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3440 (class 2606 OID 26237)
-- Name: nomenclature_espece code_biblio_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nomenclature_espece
    ADD CONSTRAINT code_biblio_foreign FOREIGN KEY (code_bibliographie) REFERENCES public.bibliographie(code_bibliographie) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3445 (class 2606 OID 26252)
-- Name: nomenclature_genre code_biblio_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nomenclature_genre
    ADD CONSTRAINT code_biblio_foreign FOREIGN KEY (code_reference) REFERENCES public.bibliographie(code_bibliographie) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3439 (class 2606 OID 26232)
-- Name: genre_valide id_classification_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genre_valide
    ADD CONSTRAINT id_classification_foreign FOREIGN KEY (id_classification) REFERENCES public.classification(id_classification) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3442 (class 2606 OID 26247)
-- Name: nomenclature_espece id_espece_valide_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nomenclature_espece
    ADD CONSTRAINT id_espece_valide_foreign FOREIGN KEY (id_espece_valide) REFERENCES public.espece_valide(id_espece_valide) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3443 (class 2606 OID 26266)
-- Name: plante_hote id_nomenclature_esp_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plante_hote
    ADD CONSTRAINT id_nomenclature_esp_fk FOREIGN KEY (id_nomenclature_espece) REFERENCES public.nomenclature_espece(id_nomenclature_espece) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3446 (class 2606 OID 26257)
-- Name: nomenclature_genre id_statut; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nomenclature_genre
    ADD CONSTRAINT id_statut FOREIGN KEY (id_statut) REFERENCES public.statut_genre(id_statut_genre) ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3441 (class 2606 OID 26242)
-- Name: nomenclature_espece id_statut_espece_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nomenclature_espece
    ADD CONSTRAINT id_statut_espece_foreign FOREIGN KEY (id_statut) REFERENCES public.statut_espece(id_statut_espece) ON DELETE CASCADE NOT VALID;


-- Completed on 2022-06-24 15:43:24

--
-- PostgreSQL database dump complete
--

