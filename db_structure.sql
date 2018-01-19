--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.10
-- Dumped by pg_dump version 9.5.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: boxes_coordinate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE boxes_coordinate (
    coordinate_id smallint NOT NULL,
    image_id bigint NOT NULL,
    x smallint,
    y smallint,
    height smallint,
    width smallint
);


ALTER TABLE boxes_coordinate OWNER TO postgres;

--
-- Name: boxes_coordinate_image_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE boxes_coordinate_image_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE boxes_coordinate_image_id_seq OWNER TO postgres;

--
-- Name: boxes_coordinate_image_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE boxes_coordinate_image_id_seq OWNED BY boxes_coordinate.image_id;


--
-- Name: dots_coordinate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE dots_coordinate (
    coordinate_id bigint NOT NULL,
    image_id bigint NOT NULL,
    x smallint,
    y smallint,
    userin character varying,
    datein timestamp without time zone,
    userup character varying,
    dateup timestamp without time zone
);


ALTER TABLE dots_coordinate OWNER TO postgres;

--
-- Name: dots_coordinate_coordinate_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE dots_coordinate_coordinate_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dots_coordinate_coordinate_id_seq OWNER TO postgres;

--
-- Name: dots_coordinate_coordinate_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE dots_coordinate_coordinate_id_seq OWNED BY dots_coordinate.image_id;


--
-- Name: images; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE images (
    image_id bigint NOT NULL,
    image_name character varying,
    path character varying
);


ALTER TABLE images OWNER TO postgres;

--
-- Name: images_image_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE images_image_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE images_image_id_seq OWNER TO postgres;

--
-- Name: images_image_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE images_image_id_seq OWNED BY images.image_id;


--
-- Name: coordinate_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dots_coordinate ALTER COLUMN coordinate_id SET DEFAULT nextval('dots_coordinate_coordinate_id_seq'::regclass);


--
-- Name: image_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY images ALTER COLUMN image_id SET DEFAULT nextval('images_image_id_seq'::regclass);


--
-- Name: boxes_coordinate_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY boxes_coordinate
    ADD CONSTRAINT boxes_coordinate_pkey PRIMARY KEY (coordinate_id, image_id);


--
-- Name: dots_coordinate_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dots_coordinate
    ADD CONSTRAINT dots_coordinate_pkey PRIMARY KEY (coordinate_id);


--
-- Name: images_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY images
    ADD CONSTRAINT images_pkey PRIMARY KEY (image_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

