#!/bin/bash

echo -n "Entrez votre identifiant d'équipe (en minuscules) : "
read equipe

mkdir fbtemp
cd fbtemp

# clone du depot equipe
git clone https://gitlab.iutlan.univ-rennes1.fr/web-m3104/$equipe

# on se place dans le depot en local
cd $equipe

# on recupere l'archive de CodeIgniter de base
wget http://delhay.iut-lannion.fr/tools/visagelivre.zip
unzip visagelivre

rm visagelivre.zip


# Ajout des repertoires au depot local
git add visagelivre

# Commit
git commit -am 'Premier commit : ajout de Codeigniter de base'

# Push
git push

# on redescend de 2 crans et on efface ses traces
cd ../..
rm -rf fbtemp

exit 0


