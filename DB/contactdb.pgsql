PGDMP     $    $    	        
    x            contact    13.1    13.1 +    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16384    contact    DATABASE     R   CREATE DATABASE contact WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'C';
    DROP DATABASE contact;
                yanuarridwan    false            �            1259    16395    contact    TABLE     �  CREATE TABLE public.contact (
    id integer NOT NULL,
    name character varying(45) NOT NULL,
    phone character varying(45) NOT NULL,
    email character varying(45) NOT NULL,
    created_date timestamp without time zone NOT NULL,
    created_by character varying(10) NOT NULL,
    last_updated_date timestamp without time zone NOT NULL,
    last_updated_by character varying(10) NOT NULL,
    is_deleted character(1) NOT NULL
);
    DROP TABLE public.contact;
       public         heap    yanuarridwan    false            �            1259    16422    contact_group    TABLE        CREATE TABLE public.contact_group (
    id integer NOT NULL,
    contact_id integer NOT NULL,
    group_id integer NOT NULL
);
 !   DROP TABLE public.contact_group;
       public         heap    yanuarridwan    false            �            1259    16420    contact_group_id_seq    SEQUENCE     �   CREATE SEQUENCE public.contact_group_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.contact_group_id_seq;
       public          yanuarridwan    false    209            �           0    0    contact_group_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.contact_group_id_seq OWNED BY public.contact_group.id;
          public          yanuarridwan    false    208            �            1259    16393    contact_id_seq    SEQUENCE     �   CREATE SEQUENCE public.contact_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.contact_id_seq;
       public          yanuarridwan    false    203            �           0    0    contact_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.contact_id_seq OWNED BY public.contact.id;
          public          yanuarridwan    false    202            �            1259    16414    group    TABLE     ^  CREATE TABLE public."group" (
    id integer NOT NULL,
    name character varying(45) NOT NULL,
    created_date timestamp without time zone NOT NULL,
    created_by character varying(10) NOT NULL,
    last_updated_date timestamp without time zone NOT NULL,
    last_updated_by character varying(10) NOT NULL,
    is_deleted character(1) NOT NULL
);
    DROP TABLE public."group";
       public         heap    yanuarridwan    false            �            1259    16412    group_id_seq    SEQUENCE     �   CREATE SEQUENCE public.group_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.group_id_seq;
       public          yanuarridwan    false    207            �           0    0    group_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.group_id_seq OWNED BY public."group".id;
          public          yanuarridwan    false    206            �            1259    16403    message    TABLE     �  CREATE TABLE public.message (
    id integer NOT NULL,
    type integer NOT NULL,
    message text NOT NULL,
    subject character varying(125) NOT NULL,
    created_date timestamp without time zone NOT NULL,
    created_by character varying(10) NOT NULL,
    last_updated_date timestamp without time zone NOT NULL,
    last_updated_by character varying(10) NOT NULL,
    is_deleted character(1) NOT NULL
);
    DROP TABLE public.message;
       public         heap    yanuarridwan    false            �            1259    16401    message_id_seq    SEQUENCE     �   CREATE SEQUENCE public.message_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.message_id_seq;
       public          yanuarridwan    false    205            �           0    0    message_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.message_id_seq OWNED BY public.message.id;
          public          yanuarridwan    false    204            �            1259    16387    user    TABLE       CREATE TABLE public."user" (
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
    DROP TABLE public."user";
       public         heap    yanuarridwan    false            �            1259    16385    user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public          yanuarridwan    false    201            �           0    0    user_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;
          public          yanuarridwan    false    200            E           2604    16398 
   contact id    DEFAULT     h   ALTER TABLE ONLY public.contact ALTER COLUMN id SET DEFAULT nextval('public.contact_id_seq'::regclass);
 9   ALTER TABLE public.contact ALTER COLUMN id DROP DEFAULT;
       public          yanuarridwan    false    203    202    203            H           2604    16425    contact_group id    DEFAULT     t   ALTER TABLE ONLY public.contact_group ALTER COLUMN id SET DEFAULT nextval('public.contact_group_id_seq'::regclass);
 ?   ALTER TABLE public.contact_group ALTER COLUMN id DROP DEFAULT;
       public          yanuarridwan    false    209    208    209            G           2604    16417    group id    DEFAULT     f   ALTER TABLE ONLY public."group" ALTER COLUMN id SET DEFAULT nextval('public.group_id_seq'::regclass);
 9   ALTER TABLE public."group" ALTER COLUMN id DROP DEFAULT;
       public          yanuarridwan    false    207    206    207            F           2604    16406 
   message id    DEFAULT     h   ALTER TABLE ONLY public.message ALTER COLUMN id SET DEFAULT nextval('public.message_id_seq'::regclass);
 9   ALTER TABLE public.message ALTER COLUMN id DROP DEFAULT;
       public          yanuarridwan    false    205    204    205            D           2604    16390    user id    DEFAULT     d   ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public          yanuarridwan    false    201    200    201            �          0    16395    contact 
   TABLE DATA           �   COPY public.contact (id, name, phone, email, created_date, created_by, last_updated_date, last_updated_by, is_deleted) FROM stdin;
    public          yanuarridwan    false    203   r2       �          0    16422    contact_group 
   TABLE DATA           A   COPY public.contact_group (id, contact_id, group_id) FROM stdin;
    public          yanuarridwan    false    209   �2       �          0    16414    group 
   TABLE DATA           u   COPY public."group" (id, name, created_date, created_by, last_updated_date, last_updated_by, is_deleted) FROM stdin;
    public          yanuarridwan    false    207   �2       �          0    16403    message 
   TABLE DATA           �   COPY public.message (id, type, message, subject, created_date, created_by, last_updated_date, last_updated_by, is_deleted) FROM stdin;
    public          yanuarridwan    false    205   �2       �          0    16387    user 
   TABLE DATA           �   COPY public."user" (id, name, username, password, email, phone, created_date, created_by, last_updated_date, last_updated_by, is_deleted) FROM stdin;
    public          yanuarridwan    false    201   �2       �           0    0    contact_group_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.contact_group_id_seq', 1, false);
          public          yanuarridwan    false    208            �           0    0    contact_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.contact_id_seq', 1, false);
          public          yanuarridwan    false    202            �           0    0    group_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.group_id_seq', 1, false);
          public          yanuarridwan    false    206            �           0    0    message_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.message_id_seq', 1, false);
          public          yanuarridwan    false    204            �           0    0    user_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.user_id_seq', 1, false);
          public          yanuarridwan    false    200            R           2606    16427     contact_group contact_group_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.contact_group
    ADD CONSTRAINT contact_group_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.contact_group DROP CONSTRAINT contact_group_pkey;
       public            yanuarridwan    false    209            L           2606    16400    contact contact_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.contact
    ADD CONSTRAINT contact_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.contact DROP CONSTRAINT contact_pkey;
       public            yanuarridwan    false    203            P           2606    16419    group group_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public."group"
    ADD CONSTRAINT group_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public."group" DROP CONSTRAINT group_pkey;
       public            yanuarridwan    false    207            N           2606    16411    message message_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.message
    ADD CONSTRAINT message_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.message DROP CONSTRAINT message_pkey;
       public            yanuarridwan    false    205            J           2606    16392    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public            yanuarridwan    false    201            S           1259    16438 
   contact_id    INDEX     J   CREATE INDEX contact_id ON public.contact_group USING btree (contact_id);
    DROP INDEX public.contact_id;
       public            yanuarridwan    false    209            T           1259    16439    group_id    INDEX     F   CREATE INDEX group_id ON public.contact_group USING btree (group_id);
    DROP INDEX public.group_id;
       public            yanuarridwan    false    209            U           2606    16428    contact_group contact_id    FK CONSTRAINT     |   ALTER TABLE ONLY public.contact_group
    ADD CONSTRAINT contact_id FOREIGN KEY (contact_id) REFERENCES public.contact(id);
 B   ALTER TABLE ONLY public.contact_group DROP CONSTRAINT contact_id;
       public          yanuarridwan    false    209    203    3148            V           2606    16433    contact_group group_id    FK CONSTRAINT     x   ALTER TABLE ONLY public.contact_group
    ADD CONSTRAINT group_id FOREIGN KEY (group_id) REFERENCES public."group"(id);
 @   ALTER TABLE ONLY public.contact_group DROP CONSTRAINT group_id;
       public          yanuarridwan    false    207    209    3152            �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �     