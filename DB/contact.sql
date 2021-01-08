--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

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
-- Name: contact; Type: TABLE; Schema: public; Owner: yanuarridwan
--

CREATE TABLE public.contact (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    phone character varying(12) NOT NULL,
    email character varying(100) NOT NULL,
    created_date timestamp with time zone NOT NULL,
    created_by character varying(10) NOT NULL,
    last_updated_date timestamp with time zone NOT NULL,
    last_updated_by character varying(10) NOT NULL,
    is_deleted character(1) NOT NULL
);


ALTER TABLE public.contact OWNER TO yanuarridwan;

--
-- Name: contact_group; Type: TABLE; Schema: public; Owner: yanuarridwan
--

CREATE TABLE public.contact_group (
    id integer NOT NULL,
    contact_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE public.contact_group OWNER TO yanuarridwan;

--
-- Name: contact_group_id_seq; Type: SEQUENCE; Schema: public; Owner: yanuarridwan
--

CREATE SEQUENCE public.contact_group_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contact_group_id_seq OWNER TO yanuarridwan;

--
-- Name: contact_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yanuarridwan
--

ALTER SEQUENCE public.contact_group_id_seq OWNED BY public.contact_group.id;


--
-- Name: contact_id_seq; Type: SEQUENCE; Schema: public; Owner: yanuarridwan
--

CREATE SEQUENCE public.contact_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contact_id_seq OWNER TO yanuarridwan;

--
-- Name: contact_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yanuarridwan
--

ALTER SEQUENCE public.contact_id_seq OWNED BY public.contact.id;


--
-- Name: group; Type: TABLE; Schema: public; Owner: yanuarridwan
--

CREATE TABLE public."group" (
    id integer NOT NULL,
    name character varying(45) NOT NULL,
    created_date timestamp without time zone NOT NULL,
    created_by character varying(10) NOT NULL,
    last_updated_date timestamp without time zone NOT NULL,
    last_updated_by character varying(10) NOT NULL,
    is_deleted character(1) NOT NULL
);


ALTER TABLE public."group" OWNER TO yanuarridwan;

--
-- Name: group_id_seq; Type: SEQUENCE; Schema: public; Owner: yanuarridwan
--

CREATE SEQUENCE public.group_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.group_id_seq OWNER TO yanuarridwan;

--
-- Name: group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yanuarridwan
--

ALTER SEQUENCE public.group_id_seq OWNED BY public."group".id;


--
-- Name: message; Type: TABLE; Schema: public; Owner: yanuarridwan
--

CREATE TABLE public.message (
    id integer NOT NULL,
    type integer NOT NULL,
    message text NOT NULL,
    subject character varying(125) NOT NULL,
    created_date timestamp with time zone NOT NULL,
    created_by character varying(10) NOT NULL,
    last_updated_date timestamp with time zone NOT NULL,
    last_updated_by character varying(10) NOT NULL,
    is_deleted character(1) NOT NULL
);


ALTER TABLE public.message OWNER TO yanuarridwan;

--
-- Name: message_id_seq; Type: SEQUENCE; Schema: public; Owner: yanuarridwan
--

CREATE SEQUENCE public.message_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.message_id_seq OWNER TO yanuarridwan;

--
-- Name: message_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yanuarridwan
--

ALTER SEQUENCE public.message_id_seq OWNED BY public.message.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: yanuarridwan
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    name character varying(120) NOT NULL,
    username character varying(30) NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(45) NOT NULL,
    phone character varying(12) NOT NULL,
    created_date timestamp without time zone NOT NULL,
    created_by character varying(10) NOT NULL,
    last_updated_date timestamp without time zone NOT NULL,
    last_updated_by character varying(10) NOT NULL,
    is_deleted character(1) NOT NULL
);


ALTER TABLE public."user" OWNER TO yanuarridwan;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: yanuarridwan
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO yanuarridwan;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yanuarridwan
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: contact id; Type: DEFAULT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public.contact ALTER COLUMN id SET DEFAULT nextval('public.contact_id_seq'::regclass);


--
-- Name: contact_group id; Type: DEFAULT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public.contact_group ALTER COLUMN id SET DEFAULT nextval('public.contact_group_id_seq'::regclass);


--
-- Name: group id; Type: DEFAULT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public."group" ALTER COLUMN id SET DEFAULT nextval('public.group_id_seq'::regclass);


--
-- Name: message id; Type: DEFAULT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public.message ALTER COLUMN id SET DEFAULT nextval('public.message_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: contact; Type: TABLE DATA; Schema: public; Owner: yanuarridwan
--

COPY public.contact (id, name, phone, email, created_date, created_by, last_updated_date, last_updated_by, is_deleted) FROM stdin;
\.


--
-- Data for Name: contact_group; Type: TABLE DATA; Schema: public; Owner: yanuarridwan
--

COPY public.contact_group (id, contact_id, group_id) FROM stdin;
\.


--
-- Data for Name: group; Type: TABLE DATA; Schema: public; Owner: yanuarridwan
--

COPY public."group" (id, name, created_date, created_by, last_updated_date, last_updated_by, is_deleted) FROM stdin;
\.


--
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: yanuarridwan
--

COPY public.message (id, type, message, subject, created_date, created_by, last_updated_date, last_updated_by, is_deleted) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: yanuarridwan
--

COPY public."user" (id, name, username, password, email, phone, created_date, created_by, last_updated_date, last_updated_by, is_deleted) FROM stdin;
1	admin	admin	$2y$10$6BdSvc3en/L316ewEFLsr.Eq.wfyFOR5sAQU.MbJPFnEnCqnabD86	yanuar.ridwan.h@gmail.com	081227579300	2020-11-23 00:00:00	0	2020-03-12 17:21:40	1	n
\.


--
-- Name: contact_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yanuarridwan
--

SELECT pg_catalog.setval('public.contact_group_id_seq', 50, true);


--
-- Name: contact_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yanuarridwan
--

SELECT pg_catalog.setval('public.contact_id_seq', 12, true);


--
-- Name: group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yanuarridwan
--

SELECT pg_catalog.setval('public.group_id_seq', 12, true);


--
-- Name: message_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yanuarridwan
--

SELECT pg_catalog.setval('public.message_id_seq', 9, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yanuarridwan
--

SELECT pg_catalog.setval('public.user_id_seq', 2, true);


--
-- Name: contact_group contact_group_pkey; Type: CONSTRAINT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public.contact_group
    ADD CONSTRAINT contact_group_pkey PRIMARY KEY (id);


--
-- Name: contact contact_pkey; Type: CONSTRAINT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public.contact
    ADD CONSTRAINT contact_pkey PRIMARY KEY (id);


--
-- Name: group group_pkey; Type: CONSTRAINT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public."group"
    ADD CONSTRAINT group_pkey PRIMARY KEY (id);


--
-- Name: message message_pkey; Type: CONSTRAINT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT message_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: contact_id; Type: INDEX; Schema: public; Owner: yanuarridwan
--

CREATE INDEX contact_id ON public.contact_group USING btree (contact_id);


--
-- Name: group_id; Type: INDEX; Schema: public; Owner: yanuarridwan
--

CREATE INDEX group_id ON public.contact_group USING btree (group_id);


--
-- Name: contact_group contact_id; Type: FK CONSTRAINT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public.contact_group
    ADD CONSTRAINT contact_id FOREIGN KEY (contact_id) REFERENCES public.contact(id);


--
-- Name: contact_group group_id; Type: FK CONSTRAINT; Schema: public; Owner: yanuarridwan
--

ALTER TABLE ONLY public.contact_group
    ADD CONSTRAINT group_id FOREIGN KEY (group_id) REFERENCES public."group"(id);


--
-- PostgreSQL database dump complete
--

