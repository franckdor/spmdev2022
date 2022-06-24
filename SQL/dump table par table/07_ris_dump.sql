--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

-- Started on 2022-06-08 15:22:32

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
-- TOC entry 3474 (class 0 OID 0)
-- Dependencies: 262
-- Name: seq_ris_id_ris; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.seq_ris_id_ris OWNED BY public.ris.id_ris;


-- Completed on 2022-06-08 15:22:32

--
-- PostgreSQL database dump complete
--

