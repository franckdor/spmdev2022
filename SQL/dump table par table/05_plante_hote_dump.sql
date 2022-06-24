--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

-- Started on 2022-06-08 15:19:19

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
-- TOC entry 3317 (class 2606 OID 17327)
-- Name: plante_hote cp_id_plante_hote; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plante_hote
    ADD CONSTRAINT cp_id_plante_hote PRIMARY KEY (id_plante_hote);


-- Completed on 2022-06-08 15:19:19

--
-- PostgreSQL database dump complete
--

