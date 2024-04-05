#!/bin/bash

## Decommenter les lignes suivantes si les dependances php ne sont pas installees
# cd lib
# composer update
# cd ..

## Donner les permissions d ecriture/lecture
chmod -R 777 data/

## Lecture des logins de connexion
read -p "Serveur de base de données : " host
read -p "Port : " port
read -p "Nom d'utilisateur : " login
read -sp "Mot de passe : " mdp

## Ecriture des donnees
fichier="src/metier/db/.env"
touch $fichier
echo "DB_HOST=$host" > $fichier
echo "DB_PORT=$port" >> $fichier
echo "DB_USER=$login" >> $fichier
echo "DB_PASS=$mdp" >> $fichier

## Fin
echo "Installation terminée"
