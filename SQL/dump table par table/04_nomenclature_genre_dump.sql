--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

-- Started on 2022-06-08 15:11:33

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

SET default_tablespace = '';

SET default_table_access_method = heap;

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
    code_statut integer,
    code_espece_type integer,
    ordre_taxonomique character varying(32),
    note_imp character varying(32),
    note_enr character varying(32),
    date_maj date,
    utilisateur character varying(32)
);


ALTER TABLE public.nomenclature_genre OWNER TO postgres;

--
-- TOC entry 3317 (class 2606 OID 17917)
-- Name: nomenclature_genre genres_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nomenclature_genre
    ADD CONSTRAINT genres_pkey PRIMARY KEY (code_genre);


-- Completed on 2022-06-08 15:11:33

--
-- PostgreSQL database dump complete
--

