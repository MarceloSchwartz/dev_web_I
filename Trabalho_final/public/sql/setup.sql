--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

-- Started on 2025-11-27 22:22:11

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
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
-- TOC entry 222 (class 1259 OID 18786)
-- Name: admin_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admin_users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(100),
    is_active boolean DEFAULT true,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.admin_users OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 18785)
-- Name: admin_users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.admin_users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.admin_users_id_seq OWNER TO postgres;

--
-- TOC entry 4894 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.admin_users_id_seq OWNED BY public.admin_users.id;


--
-- TOC entry 220 (class 1259 OID 18770)
-- Name: avaliacoes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.avaliacoes (
    id integer NOT NULL,
    id_dispositivo integer NOT NULL,
    id_pergunta integer NOT NULL,
    resposta integer NOT NULL,
    feedback_textual text,
    data_registro timestamp without time zone DEFAULT now()
);


ALTER TABLE public.avaliacoes OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 18769)
-- Name: avaliacoes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.avaliacoes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.avaliacoes_id_seq OWNER TO postgres;

--
-- TOC entry 4895 (class 0 OID 0)
-- Dependencies: 219
-- Name: avaliacoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.avaliacoes_id_seq OWNED BY public.avaliacoes.id;


--
-- TOC entry 224 (class 1259 OID 18800)
-- Name: dispositivos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dispositivos (
    id integer NOT NULL,
    nome_dispositivo character varying(100) NOT NULL,
    status character varying(10) DEFAULT 'ativo'::character varying NOT NULL
);


ALTER TABLE public.dispositivos OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 18799)
-- Name: dispositivos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dispositivos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.dispositivos_id_seq OWNER TO postgres;

--
-- TOC entry 4896 (class 0 OID 0)
-- Dependencies: 223
-- Name: dispositivos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dispositivos_id_seq OWNED BY public.dispositivos.id;


--
-- TOC entry 218 (class 1259 OID 18762)
-- Name: perguntas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perguntas (
    id integer NOT NULL,
    texto character varying(255) NOT NULL,
    data_criacao timestamp without time zone DEFAULT now(),
    status character varying(10) DEFAULT 'ativo'::character varying NOT NULL
);


ALTER TABLE public.perguntas OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 18761)
-- Name: perguntas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.perguntas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.perguntas_id_seq OWNER TO postgres;

--
-- TOC entry 4897 (class 0 OID 0)
-- Dependencies: 217
-- Name: perguntas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.perguntas_id_seq OWNED BY public.perguntas.id;


--
-- TOC entry 4715 (class 2604 OID 18789)
-- Name: admin_users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin_users ALTER COLUMN id SET DEFAULT nextval('public.admin_users_id_seq'::regclass);


--
-- TOC entry 4713 (class 2604 OID 18773)
-- Name: avaliacoes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avaliacoes ALTER COLUMN id SET DEFAULT nextval('public.avaliacoes_id_seq'::regclass);


--
-- TOC entry 4718 (class 2604 OID 18803)
-- Name: dispositivos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dispositivos ALTER COLUMN id SET DEFAULT nextval('public.dispositivos_id_seq'::regclass);


--
-- TOC entry 4710 (class 2604 OID 18765)
-- Name: perguntas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perguntas ALTER COLUMN id SET DEFAULT nextval('public.perguntas_id_seq'::regclass);


--
-- TOC entry 4886 (class 0 OID 18786)
-- Dependencies: 222
-- Data for Name: admin_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admin_users (id, username, password, email, is_active, created_at) FROM stdin;
1	marcelo	marcelo1234	\N	t	2025-11-20 23:32:14.044176
\.


--
-- TOC entry 4884 (class 0 OID 18770)
-- Dependencies: 220
-- Data for Name: avaliacoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.avaliacoes (id, id_dispositivo, id_pergunta, resposta, feedback_textual, data_registro) FROM stdin;
1	1	1	0	teste	2025-11-13 00:24:29.877994
2	1	2	0	teste	2025-11-13 00:24:29.885194
3	1	1	0		2025-11-13 00:24:51.017245
4	1	2	0		2025-11-13 00:24:51.019128
5	1	3	0		2025-11-13 00:24:51.019447
6	1	1	1	\N	2025-11-13 00:38:54.856067
7	1	2	1	\N	2025-11-13 00:38:58.458291
8	1	3	1	\N	2025-11-13 00:39:01.544256
9	1	1	4	\N	2025-11-13 00:44:36.268188
10	1	2	4	\N	2025-11-13 00:44:39.09658
11	1	3	4		2025-11-13 00:44:52.842593
12	1	1	3	\N	2025-11-13 00:48:42.174796
13	1	2	3	\N	2025-11-13 00:48:43.964889
14	1	3	3	teste	2025-11-13 00:48:53.903202
15	1	1	5	\N	2025-11-13 00:51:27.514539
16	1	2	5	\N	2025-11-13 00:51:30.945735
17	1	3	0		2025-11-13 00:55:52.707626
18	1	1	10	\N	2025-11-13 00:56:08.097231
19	1	2	10	\N	2025-11-13 00:56:11.703071
20	1	3	10	kdgsldaudah	2025-11-13 00:56:19.396556
21	1	1	9	\N	2025-11-13 01:05:25.018332
22	1	2	9	\N	2025-11-13 01:05:26.903104
23	1	3	9		2025-11-13 01:05:29.529475
24	1	1	9	\N	2025-11-13 01:17:27.190134
25	1	2	6	\N	2025-11-13 01:17:33.832865
26	1	3	4	lala	2025-11-13 01:17:41.873561
27	1	1	5	\N	2025-11-13 01:18:48.333889
28	1	2	8	\N	2025-11-13 01:18:58.958056
29	1	3	8		2025-11-13 01:19:54.12375
30	1	1	0	\N	2025-11-13 01:45:41.706865
31	1	2	0	\N	2025-11-13 01:45:43.043657
32	1	3	0		2025-11-13 01:45:45.069429
33	1	1	0	\N	2025-11-13 01:46:34.724753
34	1	2	4	\N	2025-11-13 01:52:37.703307
35	1	3	3		2025-11-13 01:52:40.348391
36	1	1	2	\N	2025-11-13 01:52:46.015045
37	1	2	2	\N	2025-11-13 01:52:48.234042
38	1	3	2	teste novo	2025-11-13 01:52:55.180036
39	1	1	6	\N	2025-11-13 02:00:16.915738
40	1	2	6	\N	2025-11-13 02:00:18.654481
41	1	3	6	testee	2025-11-13 02:00:25.582254
42	1	1	5	\N	2025-11-13 02:08:10.356905
43	1	2	5	\N	2025-11-13 02:08:12.764302
44	1	3	5	\N	2025-11-13 02:08:14.613577
47	1	1	5	\N	2025-11-13 02:10:31.307974
48	1	2	5	\N	2025-11-13 02:10:33.377861
49	1	3	5	teste1	2025-11-13 02:10:43.588279
50	1	1	2	\N	2025-11-13 02:15:25.387305
51	1	2	2	\N	2025-11-13 02:15:27.312537
52	1	3	2	teste2	2025-11-13 02:15:32.736613
53	1	1	0	\N	2025-11-13 02:18:34.321998
54	1	2	1	\N	2025-11-13 02:18:37.438139
55	1	3	2	teste3	2025-11-13 02:18:46.908308
56	1	1	3	\N	2025-11-13 02:19:39.539094
57	1	2	3	\N	2025-11-13 02:19:42.116594
58	1	3	3		2025-11-13 02:19:44.621436
59	1	1	7	\N	2025-11-12 23:21:57
60	1	2	7	\N	2025-11-12 23:22:00
61	1	3	7		2025-11-12 23:22:03
62	1	1	8	\N	2025-11-13 18:58:46
63	1	2	8	\N	2025-11-13 18:58:48
64	1	3	8	\N	2025-11-13 18:58:54
65	1	1	9	\N	2025-11-13 19:24:02
66	1	2	9	\N	2025-11-13 19:24:03
67	1	3	9	teste 9	2025-11-13 19:24:09
68	1	1	10	\N	2025-11-13 19:28:53
69	1	2	10	\N	2025-11-13 19:28:55
70	1	3	10	\N	2025-11-13 19:28:56
72	1	1	10	\N	2025-11-13 19:30:36
73	1	2	10	\N	2025-11-13 19:30:38
74	1	3	10	teste 10	2025-11-13 19:30:42
75	1	1	0	\N	2025-11-13 19:34:00
76	1	2	0	\N	2025-11-13 19:34:03
77	1	3	0	\N	2025-11-13 19:34:05
79	1	1	1	\N	2025-11-13 19:35:36
80	1	2	1	\N	2025-11-13 19:35:38
81	1	3	1	\N	2025-11-13 19:35:39
83	1	1	2	\N	2025-11-13 19:39:22
84	1	2	2	\N	2025-11-13 19:39:24
85	1	3	2	\N	2025-11-13 19:39:25
87	1	1	3	\N	2025-11-13 19:43:46
88	1	2	3	\N	2025-11-13 19:43:48
89	1	3	3	\N	2025-11-13 19:43:49
90	1	1	5	\N	2025-11-13 19:45:25
91	1	2	5	\N	2025-11-13 19:45:26
92	1	3	5	\N	2025-11-13 19:45:29
94	1	3	2	\N	2025-11-13 19:48:55
95	1	1	1	\N	2025-11-13 19:49:00
96	1	2	1	\N	2025-11-13 19:49:03
97	1	3	1	teste 1	2025-11-13 19:49:09
98	1	1	7	\N	2025-11-13 20:00:27
99	1	2	7	\N	2025-11-13 20:00:29
100	1	3	7	teste7	2025-11-13 20:00:39
101	1	1	4	\N	2025-11-13 20:19:18
102	1	2	3	\N	2025-11-13 20:19:49
103	1	3	6	a	2025-11-13 20:41:59
104	1	1	0	\N	2025-11-20 21:16:59
105	1	2	0	\N	2025-11-20 21:17:07
106	1	3	0	\N	2025-11-20 21:17:09
107	1	4	0	teste 0	2025-11-20 21:17:18
108	1	1	8	\N	2025-11-27 19:30:18
109	1	2	8	\N	2025-11-27 19:30:20
110	1	3	8	\N	2025-11-27 19:30:21
111	1	4	8	avaliacao nota 8	2025-11-27 19:30:31
112	1	1	10	\N	2025-11-27 19:41:34
113	1	2	10	\N	2025-11-27 19:41:36
114	1	3	10	\N	2025-11-27 19:41:37
115	1	4	10	avaliacao 10	2025-11-27 19:41:48
116	1	1	10	\N	2025-11-27 19:51:00
117	1	2	10	\N	2025-11-27 19:51:02
118	1	3	10	\N	2025-11-27 19:51:03
119	1	4	10	\N	2025-11-27 19:51:07
120	1	1	9	\N	2025-11-27 20:00:15
121	1	2	9	\N	2025-11-27 20:00:17
122	1	3	9	\N	2025-11-27 20:00:18
123	1	4	9	\N	2025-11-27 20:00:20
124	1	1	7	\N	2025-11-27 20:41:16
125	1	2	7	\N	2025-11-27 20:41:18
126	1	3	7	\N	2025-11-27 20:41:20
127	1	4	6	avaliacao final	2025-11-27 20:41:30
128	1	1	9	\N	2025-11-27 20:48:40
129	1	2	9	\N	2025-11-27 20:48:41
130	1	3	9	\N	2025-11-27 20:48:43
131	1	4	9	\N	2025-11-27 20:48:45
132	1	1	9	\N	2025-11-27 20:48:59
133	1	2	8	\N	2025-11-27 20:49:01
134	1	3	8	\N	2025-11-27 20:49:02
135	1	4	8	\N	2025-11-27 20:49:04
136	1	1	6	\N	2025-11-27 20:51:15
137	1	2	6	\N	2025-11-27 20:51:16
138	1	3	6	\N	2025-11-27 20:51:17
139	1	4	6	\N	2025-11-27 20:51:19
140	1	1	4	\N	2025-11-27 20:53:11
141	1	2	4	\N	2025-11-27 20:53:13
142	1	3	4	\N	2025-11-27 20:53:14
143	1	4	4	\N	2025-11-27 20:53:16
144	1	4	7	\N	2025-11-27 21:00:45
145	1	1	6	\N	2025-11-27 21:01:05
146	1	2	6	\N	2025-11-27 21:01:06
147	1	3	6	\N	2025-11-27 21:01:07
148	1	4	6	\N	2025-11-27 21:01:09
149	1	1	7	\N	2025-11-27 21:05:09
150	1	2	7	\N	2025-11-27 21:05:10
151	1	3	7	\N	2025-11-27 21:05:12
152	1	4	7	\N	2025-11-27 21:05:13
153	1	1	6	\N	2025-11-27 21:06:50
154	1	2	6	\N	2025-11-27 21:06:51
155	1	3	6	\N	2025-11-27 21:06:52
156	1	4	6	\N	2025-11-27 21:06:54
157	1	1	6	\N	2025-11-27 21:08:01
158	1	2	7	\N	2025-11-27 21:08:02
159	1	3	8	\N	2025-11-27 21:08:03
160	1	4	9	\N	2025-11-27 21:08:05
\.


--
-- TOC entry 4888 (class 0 OID 18800)
-- Dependencies: 224
-- Data for Name: dispositivos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dispositivos (id, nome_dispositivo, status) FROM stdin;
1	Central	ativo
3	dispositivo_2	ativo
\.


--
-- TOC entry 4882 (class 0 OID 18762)
-- Dependencies: 218
-- Data for Name: perguntas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.perguntas (id, texto, data_criacao, status) FROM stdin;
1	Como você avalia a cordialidade dos atendentes?	2025-11-13 00:21:18.17695	ativo
2	O tempo de espera pelo atendimento foi satisfatório?	2025-11-13 00:21:18.17695	ativo
3	A qualidade do produto/serviço atendeu suas expectativas?	2025-11-13 00:21:18.17695	ativo
4	A qualidade dos estacionamentos atendeu suas expectativas?	2025-11-20 23:56:57.396642	ativo
5	Como vocè avalia a qualidade da comida ?	2025-11-28 00:13:47.39161	ativo
\.


--
-- TOC entry 4898 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admin_users_id_seq', 1, true);


--
-- TOC entry 4899 (class 0 OID 0)
-- Dependencies: 219
-- Name: avaliacoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.avaliacoes_id_seq', 160, true);


--
-- TOC entry 4900 (class 0 OID 0)
-- Dependencies: 223
-- Name: dispositivos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dispositivos_id_seq', 13, true);


--
-- TOC entry 4901 (class 0 OID 0)
-- Dependencies: 217
-- Name: perguntas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.perguntas_id_seq', 5, true);


--
-- TOC entry 4726 (class 2606 OID 18797)
-- Name: admin_users admin_users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin_users
    ADD CONSTRAINT admin_users_email_key UNIQUE (email);


--
-- TOC entry 4728 (class 2606 OID 18793)
-- Name: admin_users admin_users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin_users
    ADD CONSTRAINT admin_users_pkey PRIMARY KEY (id);


--
-- TOC entry 4730 (class 2606 OID 18795)
-- Name: admin_users admin_users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin_users
    ADD CONSTRAINT admin_users_username_key UNIQUE (username);


--
-- TOC entry 4723 (class 2606 OID 18778)
-- Name: avaliacoes avaliacoes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avaliacoes
    ADD CONSTRAINT avaliacoes_pkey PRIMARY KEY (id);


--
-- TOC entry 4732 (class 2606 OID 18808)
-- Name: dispositivos dispositivos_nome_dispositivo_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dispositivos
    ADD CONSTRAINT dispositivos_nome_dispositivo_key UNIQUE (nome_dispositivo);


--
-- TOC entry 4734 (class 2606 OID 18806)
-- Name: dispositivos dispositivos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dispositivos
    ADD CONSTRAINT dispositivos_pkey PRIMARY KEY (id);


--
-- TOC entry 4721 (class 2606 OID 18768)
-- Name: perguntas perguntas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perguntas
    ADD CONSTRAINT perguntas_pkey PRIMARY KEY (id);


--
-- TOC entry 4724 (class 1259 OID 18784)
-- Name: idx_avaliacoes_data_registro; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_avaliacoes_data_registro ON public.avaliacoes USING btree (data_registro);


--
-- TOC entry 4735 (class 2606 OID 18779)
-- Name: avaliacoes avaliacoes_id_pergunta_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.avaliacoes
    ADD CONSTRAINT avaliacoes_id_pergunta_fkey FOREIGN KEY (id_pergunta) REFERENCES public.perguntas(id);


-- Completed on 2025-11-27 22:22:11

--
-- PostgreSQL database dump complete
--

