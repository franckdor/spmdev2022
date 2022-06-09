--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

-- Started on 2022-06-08 15:21:13

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

-- Completed on 2022-06-08 15:21:13

--
-- PostgreSQL database dump complete
--

