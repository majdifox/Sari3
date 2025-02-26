////////////////////////////////////////////////////////////////////////////////////////////
CREATE TYPE role_enum AS ENUM ('Conducteur', 'Expediteur', 'Admin');
CREATE TYPE etat_enum AS ENUM('Normal', 'Banne');

CREATE TABLE utilisateurs (
    ID SERIAL PRIMARY KEY,
	CNI varchar(25) UNIQUE,
    Nom varchar(25) NOT NULL,
    Prenom varchar(25) NOT NULL,
    Photo BYTEA NOT NULL,
    Telephone varchar(15) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Mot_de_passe VARCHAR(255) NOT NULL,
    Role role_enum NOT NULL,
    Etat etat_enum NOT NULL
);


ALTER TABLE public.details_itineraire OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 42179)
-- Name: details_itineraire_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.details_itineraire_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.details_itineraire_id_seq OWNER TO postgres;

--
-- TOC entry 4914 (class 0 OID 0)
-- Dependencies: 223
-- Name: details_itineraire_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.details_itineraire_id_seq OWNED BY public.details_itineraire.id;


--
-- TOC entry 217 (class 1259 OID 42104)
-- Name: itineraire; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.itineraire (
    id integer NOT NULL,
    conducteur_id integer NOT NULL,
    vehicule_id integer NOT NULL,
    date_depart timestamp without time zone NOT NULL,
    date_arriver timestamp without time zone,
    statut public.track_enum DEFAULT 'En préparation'::public.track_enum NOT NULL
);


ALTER TABLE public.itineraire OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 42108)
-- Name: itineraire_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.itineraire_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.itineraire_id_seq OWNER TO postgres;

--
-- TOC entry 4915 (class 0 OID 0)
-- Dependencies: 218
-- Name: itineraire_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.itineraire_id_seq OWNED BY public.itineraire.id;


--
-- TOC entry 219 (class 1259 OID 42109)
-- Name: utilisateurs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utilisateurs (
    id integer NOT NULL,
    cni character varying(25),
    nom character varying(25) NOT NULL,
    prenom character varying(25) NOT NULL,
    photo bytea NOT NULL,
    telephone character varying(15) NOT NULL,
    email character varying(255) NOT NULL,
    mot_de_passe character varying(255) NOT NULL,
    role public.role_enum NOT NULL,
    etat public.etat_enum NOT NULL
);


ALTER TABLE public.utilisateurs OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 42114)
-- Name: utilisateurs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.utilisateurs_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.utilisateurs_id_seq OWNER TO postgres;

--
-- TOC entry 4916 (class 0 OID 0)
-- Dependencies: 220
-- Name: utilisateurs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.utilisateurs_id_seq OWNED BY public.utilisateurs.id;


--
-- TOC entry 221 (class 1259 OID 42115)
-- Name: vehicule; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vehicule (
    id integer NOT NULL,
    matricule character varying(50) NOT NULL,
    model character varying(50) NOT NULL,
    volume numeric NOT NULL
);


ALTER TABLE public.vehicule OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 42120)
-- Name: vehicule_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vehicule_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vehicule_id_seq OWNER TO postgres;

--
-- TOC entry 4917 (class 0 OID 0)
-- Dependencies: 222
-- Name: vehicule_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vehicule_id_seq OWNED BY public.vehicule.id;


--
-- TOC entry 4739 (class 2604 OID 42257)
-- Name: colis id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colis ALTER COLUMN id SET DEFAULT nextval('public.colis_id_seq'::regclass);


--
-- TOC entry 4737 (class 2604 OID 42183)
-- Name: details_itineraire id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_itineraire ALTER COLUMN id SET DEFAULT nextval('public.details_itineraire_id_seq'::regclass);


--
-- TOC entry 4733 (class 2604 OID 42123)
-- Name: itineraire id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itineraire ALTER COLUMN id SET DEFAULT nextval('public.itineraire_id_seq'::regclass);


--
-- TOC entry 4735 (class 2604 OID 42124)
-- Name: utilisateurs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateurs ALTER COLUMN id SET DEFAULT nextval('public.utilisateurs_id_seq'::regclass);


--
-- TOC entry 4736 (class 2604 OID 42125)
-- Name: vehicule id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vehicule ALTER COLUMN id SET DEFAULT nextval('public.vehicule_id_seq'::regclass);


--
-- TOC entry 4907 (class 0 OID 42254)
-- Dependencies: 226
-- Data for Name: colis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.colis (id, expediteur_id, itineraire_id, destination, volume, poids, date_depart, date_arriver, statut, etat) FROM stdin;
\.


--
-- TOC entry 4905 (class 0 OID 42180)
-- Dependencies: 224
-- Data for Name: details_itineraire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.details_itineraire (id, itineraire_id, orders, ville, statut) FROM stdin;
\.


--
-- TOC entry 4898 (class 0 OID 42104)
-- Dependencies: 217
-- Data for Name: itineraire; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.itineraire (id, conducteur_id, vehicule_id, date_depart, date_arriver, statut) FROM stdin;
\.


--
-- TOC entry 4900 (class 0 OID 42109)
-- Dependencies: 219
-- Data for Name: utilisateurs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utilisateurs (id, cni, nom, prenom, photo, telephone, email, mot_de_passe, role, etat) FROM stdin;
\.


--
-- TOC entry 4902 (class 0 OID 42115)
-- Dependencies: 221
-- Data for Name: vehicule; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vehicule (id, matricule, model, volume) FROM stdin;
\.


--
-- TOC entry 4918 (class 0 OID 0)
-- Dependencies: 225
-- Name: colis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.colis_id_seq', 1, false);


--
-- TOC entry 4919 (class 0 OID 0)
-- Dependencies: 223
-- Name: details_itineraire_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.details_itineraire_id_seq', 1, false);


--
-- TOC entry 4920 (class 0 OID 0)
-- Dependencies: 218
-- Name: itineraire_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.itineraire_id_seq', 1, false);


--
-- TOC entry 4921 (class 0 OID 0)
-- Dependencies: 220
-- Name: utilisateurs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.utilisateurs_id_seq', 1, false);


--
-- TOC entry 4922 (class 0 OID 0)
-- Dependencies: 222
-- Name: vehicule_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vehicule_id_seq', 1, false);


--
-- TOC entry 4749 (class 2606 OID 42263)
-- Name: colis colis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colis
    ADD CONSTRAINT colis_pkey PRIMARY KEY (id);


--
-- TOC entry 4747 (class 2606 OID 42186)
-- Name: details_itineraire details_itineraire_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_itineraire
    ADD CONSTRAINT details_itineraire_pkey PRIMARY KEY (id);


--
-- TOC entry 4743 (class 2606 OID 42178)
-- Name: itineraire itineraire_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itineraire
    ADD CONSTRAINT itineraire_id_unique UNIQUE (id);


--
-- TOC entry 4745 (class 2606 OID 42211)
-- Name: utilisateurs utilisateurs_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateurs
    ADD CONSTRAINT utilisateurs_id_unique UNIQUE (id);


--
-- TOC entry 4751 (class 2606 OID 42264)
-- Name: colis colis_expediteur_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colis
    ADD CONSTRAINT colis_expediteur_id_fkey FOREIGN KEY (expediteur_id) REFERENCES public.utilisateurs(id) ON DELETE CASCADE;


--
-- TOC entry 4752 (class 2606 OID 42269)
-- Name: colis colis_itineraire_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colis
    ADD CONSTRAINT colis_itineraire_id_fkey FOREIGN KEY (itineraire_id) REFERENCES public.itineraire(id) ON DELETE CASCADE;


--
-- TOC entry 4750 (class 2606 OID 42187)
-- Name: details_itineraire details_itineraire_itineraire_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.details_itineraire
    ADD CONSTRAINT details_itineraire_itineraire_id_fkey FOREIGN KEY (itineraire_id) REFERENCES public.itineraire(id) ON DELETE CASCADE;


-- Completed on 2025-02-12 09:46:20

--
-- PostgreSQL database dump complete
--

