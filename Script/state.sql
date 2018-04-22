--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.5
-- Dumped by pg_dump version 9.6.5

-- Started on 2017-12-27 14:45:23

CREATE TABLE openfoodfacts._states
(
  countries_fr character varying(128) NOT NULL,
  CONSTRAINT states_pk PRIMARY KEY (countries_fr)
);

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = openfoodfacts, pg_catalog;

--
-- TOC entry 2168 (class 0 OID 34289)
-- Dependencies: 200
-- Data for Name: openfoodfacts._states; Type: TABLE DATA; Schema: openfoodfacts; Owner: a26
--

INSERT INTO openfoodfacts._states VALUES ('Arabie saoudite');
INSERT INTO openfoodfacts._states VALUES ('Australie');
INSERT INTO openfoodfacts._states VALUES ('Bangladesh');
INSERT INTO openfoodfacts._states VALUES ('Brىsil');
INSERT INTO openfoodfacts._states VALUES ('Canada');
INSERT INTO openfoodfacts._states VALUES ('Chine');
INSERT INTO openfoodfacts._states VALUES ('Costa Rica');
INSERT INTO openfoodfacts._states VALUES ('ىmirats arabes unis');
INSERT INTO openfoodfacts._states VALUES ('Espagne');
INSERT INTO openfoodfacts._states VALUES ('ىtats-Unis');
INSERT INTO openfoodfacts._states VALUES ('Finlande');
INSERT INTO openfoodfacts._states VALUES ('France');
INSERT INTO openfoodfacts._states VALUES ('Guadeloupe');
INSERT INTO openfoodfacts._states VALUES ('Irak');
INSERT INTO openfoodfacts._states VALUES ('Irlande');
INSERT INTO openfoodfacts._states VALUES ('Italie');
INSERT INTO openfoodfacts._states VALUES ('Koweُt');
INSERT INTO openfoodfacts._states VALUES ('Mexique');
INSERT INTO openfoodfacts._states VALUES ('Moldavie');
INSERT INTO openfoodfacts._states VALUES ('Nouvelle-Calىdonie');
INSERT INTO openfoodfacts._states VALUES ('Panama');
INSERT INTO openfoodfacts._states VALUES ('Pays-Bas');
INSERT INTO openfoodfacts._states VALUES ('Polynىsie franهaise');
INSERT INTO openfoodfacts._states VALUES ('Portugal');
INSERT INTO openfoodfacts._states VALUES ('Rىpublique dominicaine');
INSERT INTO openfoodfacts._states VALUES ('Roumanie');
INSERT INTO openfoodfacts._states VALUES ('Royaume-Uni');
INSERT INTO openfoodfacts._states VALUES ('Scotland');
INSERT INTO openfoodfacts._states VALUES ('Singapour');
INSERT INTO openfoodfacts._states VALUES ('Slovىnie');
INSERT INTO openfoodfacts._states VALUES ('Suisse');
INSERT INTO openfoodfacts._states VALUES ('Taiwan');
INSERT INTO openfoodfacts._states VALUES ('Thaُlande');