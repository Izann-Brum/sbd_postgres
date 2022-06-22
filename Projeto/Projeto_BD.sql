--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

-- Started on 2021-04-26 00:59:28

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
-- TOC entry 200 (class 1259 OID 33036)
-- Name: Aluno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Aluno" (
    "Nome" character varying(64) NOT NULL,
    "Data_Nasc" date NOT NULL,
    "Matricula" bigint NOT NULL,
    "Curso_ID" bigint NOT NULL
);


ALTER TABLE public."Aluno" OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 33165)
-- Name: Aluno_Matricula_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Aluno" ALTER COLUMN "Matricula" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Aluno_Matricula_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 201 (class 1259 OID 33043)
-- Name: Carteirinha; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Carteirinha" (
    "Data_Emiss" date DEFAULT now() NOT NULL,
    "Data_Val" date NOT NULL,
    "Saldo" numeric NOT NULL,
    "Ativo" boolean DEFAULT true NOT NULL,
    "Carteirinha_ID" bigint NOT NULL
);


ALTER TABLE public."Carteirinha" OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 33209)
-- Name: Cursos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Cursos" (
    "Curso_ID" bigint NOT NULL,
    "Curso_Desc" character varying(255) NOT NULL
);


ALTER TABLE public."Cursos" OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 33214)
-- Name: Cursos_Curso_ID_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Cursos" ALTER COLUMN "Curso_ID" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Cursos_Curso_ID_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 208 (class 1259 OID 33225)
-- Name: Linhas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Linhas" (
    "Linha_Desc" character varying(255) NOT NULL,
    "Linha_ID" bigint NOT NULL
);


ALTER TABLE public."Linhas" OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 33235)
-- Name: Linhas_Linha_ID_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Linhas" ALTER COLUMN "Linha_ID" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Linhas_Linha_ID_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 202 (class 1259 OID 33077)
-- Name: Onibus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Onibus" (
    "Preco_Pass" numeric NOT NULL,
    "Ativo" boolean DEFAULT true NOT NULL,
    "Onibus_ID" bigint NOT NULL,
    "Linha_ID" bigint,
    "Passagem_ID" bigint
);


ALTER TABLE public."Onibus" OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 33190)
-- Name: Onibus_Onibus_ID_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Onibus" ALTER COLUMN "Onibus_ID" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Onibus_Onibus_ID_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 203 (class 1259 OID 33148)
-- Name: Passagem; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Passagem" (
    "Preco" money NOT NULL,
    "Data" timestamp without time zone DEFAULT CURRENT_TIMESTAMP(0) NOT NULL,
    "Carteirinha_ID" bigint NOT NULL,
    "Passagem_ID" bigint NOT NULL,
    "Onibus_ID" bigint NOT NULL
);


ALTER TABLE public."Passagem" OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 33255)
-- Name: Passagem_Passagem_ID_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public."Passagem" ALTER COLUMN "Passagem_ID" ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Passagem_Passagem_ID_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 3032 (class 0 OID 33036)
-- Dependencies: 200
-- Data for Name: Aluno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Aluno" ("Nome", "Data_Nasc", "Matricula", "Curso_ID") FROM stdin;
João	2001-09-12	11	6
\.


--
-- TOC entry 3033 (class 0 OID 33043)
-- Dependencies: 201
-- Data for Name: Carteirinha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Carteirinha" ("Data_Emiss", "Data_Val", "Saldo", "Ativo", "Carteirinha_ID") FROM stdin;
2021-04-23	2022-04-23	55.50	t	11
\.


--
-- TOC entry 3038 (class 0 OID 33209)
-- Dependencies: 206
-- Data for Name: Cursos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Cursos" ("Curso_ID", "Curso_Desc") FROM stdin;
6	Medicina
\.


--
-- TOC entry 3040 (class 0 OID 33225)
-- Dependencies: 208
-- Data for Name: Linhas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Linhas" ("Linha_Desc", "Linha_ID") FROM stdin;
Venezuela-Panamá	3
Chile-Venezuela	4
\.


--
-- TOC entry 3034 (class 0 OID 33077)
-- Dependencies: 202
-- Data for Name: Onibus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Onibus" ("Preco_Pass", "Ativo", "Onibus_ID", "Linha_ID", "Passagem_ID") FROM stdin;
3.50	t	12	4	\N
\.


--
-- TOC entry 3035 (class 0 OID 33148)
-- Dependencies: 203
-- Data for Name: Passagem; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."Passagem" ("Preco", "Data", "Carteirinha_ID", "Passagem_ID", "Onibus_ID") FROM stdin;
R$3,50	2021-04-25 23:18:18	11	46	12
R$3,50	2021-04-25 23:18:21	11	47	12
\.


--
-- TOC entry 3048 (class 0 OID 0)
-- Dependencies: 204
-- Name: Aluno_Matricula_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Aluno_Matricula_seq"', 11, true);


--
-- TOC entry 3049 (class 0 OID 0)
-- Dependencies: 207
-- Name: Cursos_Curso_ID_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Cursos_Curso_ID_seq"', 6, true);


--
-- TOC entry 3050 (class 0 OID 0)
-- Dependencies: 209
-- Name: Linhas_Linha_ID_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Linhas_Linha_ID_seq"', 15, true);


--
-- TOC entry 3051 (class 0 OID 0)
-- Dependencies: 205
-- Name: Onibus_Onibus_ID_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Onibus_Onibus_ID_seq"', 12, true);


--
-- TOC entry 3052 (class 0 OID 0)
-- Dependencies: 210
-- Name: Passagem_Passagem_ID_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Passagem_Passagem_ID_seq"', 47, true);


--
-- TOC entry 2888 (class 2606 OID 33182)
-- Name: Carteirinha Carteirinha_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Carteirinha"
    ADD CONSTRAINT "Carteirinha_pkey" PRIMARY KEY ("Carteirinha_ID");


--
-- TOC entry 2894 (class 2606 OID 33213)
-- Name: Cursos Curso_PK; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Cursos"
    ADD CONSTRAINT "Curso_PK" PRIMARY KEY ("Curso_ID");


--
-- TOC entry 2896 (class 2606 OID 33234)
-- Name: Linhas Linha_ID_PK; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Linhas"
    ADD CONSTRAINT "Linha_ID_PK" PRIMARY KEY ("Linha_ID");


--
-- TOC entry 2886 (class 2606 OID 33180)
-- Name: Aluno Matricula_PK; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Aluno"
    ADD CONSTRAINT "Matricula_PK" PRIMARY KEY ("Matricula");


--
-- TOC entry 2890 (class 2606 OID 33189)
-- Name: Onibus Onibus_PK; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Onibus"
    ADD CONSTRAINT "Onibus_PK" PRIMARY KEY ("Onibus_ID");


--
-- TOC entry 2892 (class 2606 OID 33254)
-- Name: Passagem Passagem_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Passagem"
    ADD CONSTRAINT "Passagem_pkey" PRIMARY KEY ("Passagem_ID");


--
-- TOC entry 2898 (class 2606 OID 33183)
-- Name: Carteirinha Carteirinha_FK; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Carteirinha"
    ADD CONSTRAINT "Carteirinha_FK" FOREIGN KEY ("Carteirinha_ID") REFERENCES public."Aluno"("Matricula") NOT VALID;


--
-- TOC entry 2900 (class 2606 OID 33197)
-- Name: Passagem Carteirinha_FK; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Passagem"
    ADD CONSTRAINT "Carteirinha_FK" FOREIGN KEY ("Carteirinha_ID") REFERENCES public."Carteirinha"("Carteirinha_ID") NOT VALID;


--
-- TOC entry 2897 (class 2606 OID 33216)
-- Name: Aluno Curso_ID_FK; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Aluno"
    ADD CONSTRAINT "Curso_ID_FK" FOREIGN KEY ("Curso_ID") REFERENCES public."Cursos"("Curso_ID") NOT VALID;


--
-- TOC entry 2899 (class 2606 OID 33247)
-- Name: Onibus Linha_ID_FK; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Onibus"
    ADD CONSTRAINT "Linha_ID_FK" FOREIGN KEY ("Linha_ID") REFERENCES public."Linhas"("Linha_ID") NOT VALID;


--
-- TOC entry 2901 (class 2606 OID 33257)
-- Name: Passagem Onibus_FK; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Passagem"
    ADD CONSTRAINT "Onibus_FK" FOREIGN KEY ("Onibus_ID") REFERENCES public."Onibus"("Onibus_ID") NOT VALID;


-- Completed on 2021-04-26 00:59:29

--
-- PostgreSQL database dump complete
--

