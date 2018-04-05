--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.12
-- Dumped by pg_dump version 9.5.12

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
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


--
-- Name: roles; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.roles AS ENUM (
    'user',
    'admin'
);


ALTER TYPE public.roles OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: boxes_coordinate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.boxes_coordinate (
    coordinate_id smallint NOT NULL,
    image_id bigint NOT NULL,
    x smallint,
    y smallint,
    height smallint,
    width smallint
);


ALTER TABLE public.boxes_coordinate OWNER TO postgres;

--
-- Name: boxes_coordinate_image_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.boxes_coordinate_image_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.boxes_coordinate_image_id_seq OWNER TO postgres;

--
-- Name: boxes_coordinate_image_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.boxes_coordinate_image_id_seq OWNED BY public.boxes_coordinate.image_id;


--
-- Name: dots_coordinate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dots_coordinate (
    coordinate_id bigint NOT NULL,
    image_id bigint NOT NULL,
    x smallint,
    y smallint,
    userin character varying,
    datein timestamp without time zone,
    userup character varying,
    dateup timestamp without time zone
);


ALTER TABLE public.dots_coordinate OWNER TO postgres;

--
-- Name: dots_coordinate_coordinate_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dots_coordinate_coordinate_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dots_coordinate_coordinate_id_seq OWNER TO postgres;

--
-- Name: dots_coordinate_coordinate_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dots_coordinate_coordinate_id_seq OWNED BY public.dots_coordinate.image_id;


--
-- Name: dots_count; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dots_count (
    username character varying NOT NULL,
    image_id bigint NOT NULL,
    dots_count bigint
);


ALTER TABLE public.dots_count OWNER TO postgres;

--
-- Name: dots_distance; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dots_distance (
    username1 character varying,
    username2 character varying,
    image_id bigint,
    coordinate_id1 bigint,
    coordinate_id2 bigint,
    distance double precision
);


ALTER TABLE public.dots_distance OWNER TO postgres;

--
-- Name: images; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.images (
    image_id bigint NOT NULL,
    image_name character varying,
    path character varying
);


ALTER TABLE public.images OWNER TO postgres;

--
-- Name: images_image_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.images_image_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.images_image_id_seq OWNER TO postgres;

--
-- Name: images_image_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.images_image_id_seq OWNED BY public.images.image_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    username character varying NOT NULL,
    password_hash character varying,
    role character varying
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: coordinate_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dots_coordinate ALTER COLUMN coordinate_id SET DEFAULT nextval('public.dots_coordinate_coordinate_id_seq'::regclass);


--
-- Name: image_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.images ALTER COLUMN image_id SET DEFAULT nextval('public.images_image_id_seq'::regclass);


--
-- Data for Name: boxes_coordinate; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: boxes_coordinate_image_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.boxes_coordinate_image_id_seq', 1, false);


--
-- Data for Name: dots_coordinate; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.dots_coordinate VALUES (39, 1, 146, 66, 'staff', '2018-01-30 14:07:57.889862', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (40, 1, 143, 42, 'staff', '2018-01-30 14:07:57.924534', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (41, 2, 138, 40, 'staff', '2018-02-13 17:57:25.072155', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (42, 2, 95, 55, 'staff', '2018-02-13 17:57:25.130845', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (43, 2, 48, 102, 'staff', '2018-02-13 17:57:25.138913', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (44, 2, 99, 76, 'staff', '2018-02-13 17:57:25.147869', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (51, 3, 95, 34, 'staff', '2018-04-03 17:48:44.479313', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (52, 3, 142, 43, 'staff', '2018-04-03 17:48:44.53302', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (53, 3, 142, 110, 'staff', '2018-04-03 17:48:44.540866', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (54, 3, 144, 66, 'staff', '2018-04-03 17:48:44.547601', NULL, NULL);
INSERT INTO public.dots_coordinate VALUES (55, 3, 144, 90, 'staff', '2018-04-03 17:48:44.555999', NULL, NULL);


--
-- Name: dots_coordinate_coordinate_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dots_coordinate_coordinate_id_seq', 55, true);


--
-- Data for Name: dots_count; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.dots_count VALUES ('staff', 1, 10);
INSERT INTO public.dots_count VALUES ('staff', 2, 12);
INSERT INTO public.dots_count VALUES ('staff', 3, 13);
INSERT INTO public.dots_count VALUES ('staff', 4, 10);
INSERT INTO public.dots_count VALUES ('staff', 5, 15);

INSERT INTO public.dots_count VALUES ('user1', 1, 9);
INSERT INTO public.dots_count VALUES ('user1', 2, 0);
INSERT INTO public.dots_count VALUES ('user1', 3, 0);
INSERT INTO public.dots_count VALUES ('user1', 4, 8);
INSERT INTO public.dots_count VALUES ('user1', 5, 15);

INSERT INTO public.dots_count VALUES ('user2', 1, 10);
INSERT INTO public.dots_count VALUES ('user2', 2, 12);
INSERT INTO public.dots_count VALUES ('user2', 3, 15);
INSERT INTO public.dots_count VALUES ('user2', 4, 0);
INSERT INTO public.dots_count VALUES ('user2', 5, 20);


--
-- Data for Name: dots_distance; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: images; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.images VALUES (1, 'Image_1.JPG', 'images/');
INSERT INTO public.images VALUES (2, 'Image_2.JPG', 'images/');
INSERT INTO public.images VALUES (3, 'Image_3.jpg', 'images/');
INSERT INTO public.images VALUES (4, 'Image_4.jpg', 'images/');
INSERT INTO public.images VALUES (4, 'Image_5.jpg', 'images/');

--
-- Name: images_image_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.images_image_id_seq', 3, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.users VALUES ('staff', '1253208465b1efa876f982d8a9e73eef', 'staff');
INSERT INTO public.users VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');


--
-- Name: boxes_coordinate_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boxes_coordinate
    ADD CONSTRAINT boxes_coordinate_pkey PRIMARY KEY (coordinate_id, image_id);


--
-- Name: dots_coordinate_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dots_coordinate
    ADD CONSTRAINT dots_coordinate_pkey PRIMARY KEY (coordinate_id);


--
-- Name: dots_count_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dots_count
    ADD CONSTRAINT dots_count_pkey PRIMARY KEY (username, image_id);


--
-- Name: images_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.images
    ADD CONSTRAINT images_pkey PRIMARY KEY (image_id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (username);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--
