--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

-- Started on 2022-06-08 15:01:08

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
-- TOC entry 3317 (class 2606 OID 17922)
-- Name: familles familles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familles
    ADD CONSTRAINT familles_pkey PRIMARY KEY (code_famille);


-- Completed on 2022-06-08 15:01:08

--
-- PostgreSQL database dump complete
--

