create schema openfoodfacts;
create table openfoodfacts._produit(
id_produit SERIAL,
code text not null,
url text not null,
creator text not null,
created_datetime  date DEFAULT ('now'::text)::date not null,
last_modified_datetime date DEFAULT ('now'::text)::date,
product_name text,
brands text,
serving_size text,
states_fr text,
nutrition_grade_fr char,
energy_100g numeric,
fat_100g decimal,
saturated_fat_100g decimal,
trans_fat_100g decimal,
cholesterol_100g decimal,
carbohydrates_100g decimal,
sugars_100g decimal,
fiber_100g decimal,
proteins_100g decimal,
salt_100g decimal,
sodium_100g decimal,
vitamin_a_100g decimal,
vitamin_c_100g decimal,
calcium_100g decimal,
iron_100g decimal,
nutritions_core_fr_100g integer,
constraint produit_pk primary key (id_produit)
);

create table openfoodfacts._ingredient(
id_produit integer not null,
ingredients_text text,
ingredients_that_may_be_from_palm_oil_n integer,
constraint ingredients_pk primary key (id_produit),
constraint ingredients_fk foreign key (id_produit) references openfoodfacts._produit(id_produit)
);

create table openfoodfacts._additif(
id_produit integer not null,
additives_n integer,
additives text,
constraint additif_pk primary key (id_produit),
constraint  additif_fk foreign key (id_produit) references openfoodfacts._produit(id_produit)
);