--La vue pour les caracctéristiques des produits
create view openfoodfacts.caracteristique as
select id_produit,code, product_name, serving_size, brands, states_fr
from openfoodfacts._produit p;

--La vue pour la composition des produits

create view openfoodfacts.composition as
select a.additives, i.ingredients_text, a.id_produit
from openfoodfacts._additif a inner join openfoodfacts._ingredient i
on i.id_produit = a.id_produit;

--La vue liste sels minéraux
create view openfoodfacts.list_sels_mineraux as
select id_produit,vitamin_a_100g, vitamin_c_100g
from openfoodfacts._produit;

--La vue pour liste vitamines
create view openfoodfacts.list_vitamines as
select id_produit, vitamin_a_100g, vitamin_c_100g
from openfoodfacts._produit;

--La vue pour les informations nutritionnelles
create view openfoodfacts.info_nutri as
with r1 as
(select p.id_produit,
nutrition_grade_fr,
energy_100g,
fat_100g,
saturated_fat_100g,
sugars_100g,
fiber_100g,
proteins_100g,
salt_100g,
s.vitamin_a_100g,
s.vitamin_c_100g
from openfoodfacts._produit p inner join openfoodfacts.list_sels_mineraux s
on p.id_produit=s.id_produit)
select
v.id_produit,
nutrition_grade_fr,
energy_100g,
fat_100g,
saturated_fat_100g,
sugars_100g,
fiber_100g,
proteins_100g,
salt_100g,
v.vitamin_a_100g,
v.vitamin_c_100g
from r1 r inner join openfoodfacts.list_vitamines v
on r.id_produit = v.id_produit;

--La vue pour avoir toutes les infos
create view openfoodfacts.all_produit as
with r1 as(
select 
i.id_produit,
nutrition_grade_fr,
energy_100g,
fat_100g,
saturated_fat_100g,
sugars_100g,
fiber_100g,
proteins_100g,
salt_100g,
vitamin_a_100g,
vitamin_c_100g,
ingredients_text,
additives
from openfoodfacts.info_nutri i inner join openfoodfacts.composition c
on i.id_produit=c.id_produit)
select distinct r.id_produit,
nutrition_grade_fr,
energy_100g,
fat_100g,
saturated_fat_100g,
sugars_100g,
fiber_100g,
proteins_100g,
salt_100g,
vitamin_a_100g,
vitamin_c_100g,
ingredients_text,
additives,
code, product_name, serving_size, brands, states_fr
from r1 r inner join openfoodfacts.caracteristique c on r.id_produit = c.id_produit;
--La view all_product
CREATE OR REPLACE VIEW openfoodfacts.all_product AS 
 WITH r1 AS (
         SELECT i.id_produit,
            i.nutrition_grade_fr,
            i.energy_100g,
            i.fat_100g,
            i.saturated_fat_100g,
            i.sugars_100g,
            i.fiber_100g,
            i.proteins_100g,
            i.salt_100g,
            i.vitamin_a_100g,
            i.vitamin_c_100g,
            c_1.ingredients_text,
            c_1.additives
           FROM openfoodfacts.info_nutri i
             JOIN openfoodfacts.composition c_1 ON i.id_produit = c_1.id_produit
        )
 SELECT DISTINCT r.id_produit,
    r.nutrition_grade_fr,
    r.energy_100g,
    r.fat_100g,
    r.saturated_fat_100g,
    r.sugars_100g,
    r.fiber_100g,
    r.proteins_100g,
    r.salt_100g,
    r.vitamin_a_100g,
    r.vitamin_c_100g,
    r.ingredients_text,
    r.additives,
    c.code,
    c.product_name,
    c.serving_size,
    c.brands,
    c.states_fr
   FROM r1 r
     JOIN openfoodfacts.caracteristique c ON r.id_produit = c.id_produit;
	 
	 