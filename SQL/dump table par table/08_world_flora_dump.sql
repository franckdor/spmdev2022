--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

-- Started on 2022-06-08 15:31:11

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

-- Completed on 2022-06-08 15:31:11

--
-- PostgreSQL database dump complete
--

