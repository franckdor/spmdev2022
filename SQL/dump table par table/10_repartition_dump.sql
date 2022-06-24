--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

-- Started on 2022-06-09 15:30:18

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
-- TOC entry 3319 (class 2606 OID 17339)
-- Name: repartition cp_id_repartition; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.repartition
    ADD CONSTRAINT cp_id_repartition PRIMARY KEY (id_repartition);


-- Completed on 2022-06-09 15:30:20

--
-- PostgreSQL database dump complete
--

