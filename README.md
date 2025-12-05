Agenda - Symfony Project
Table des matières

Description

Technologies utilisées

Installation

Configuration

Fonctionnalités

Structure des entités

Routes importantes

Sécurité et utilisateurs

Auteurs

Description

Agenda est une application web développée avec Symfony qui permet de gérer des contacts.
Chaque contact possède des informations telles que le nom, prénom, téléphone, adresse, ville, âge et catégorie (famille, amis, travail).

L’application offre également un système de sécurité complet avec inscription, connexion et gestion des rôles.

Technologies utilisées

PHP 8.x

Symfony 6.x

Doctrine ORM

Twig (templating)

Bootstrap 4/5 (frontend)

MySQL (base de données)

Installation

Cloner le projet :

git clone <repo-url>
cd agenda


Installer les dépendances :

composer install


Configurer la base de données dans .env :

DATABASE_URL="mysql://username:password@127.0.0.1:3306/agenda?serverVersion=8.0"


Créer la base de données et les tables :

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate


Lancer le serveur de développement :

symfony serve
# ou
php bin/console server:run

Configuration

Fichier principal de configuration : config/packages/security.yaml

Les utilisateurs sont gérés via l’entité User avec email et mot de passe encodé.

La sécurité protège les routes /contact/* : ajout, modification, suppression nécessitent un utilisateur connecté.

Fonctionnalités
Gestion des contacts

Ajouter un contact

Modifier un contact

Supprimer un contact

Afficher la liste des contacts

Afficher les détails d’un contact

Filtrer les contacts par âge (>18 ans)

Associer un contact à une catégorie (famille, amis, travail)

Formulaires

Formulaire pour ajouter et modifier un contact avec validation :

Nom / prénom ≥ 2 caractères

Téléphone obligatoire

Âge entre 15 et 120 ans

Catégorie obligatoire

Sécurité

Inscription d’utilisateurs avec rôle par défaut ROLE_USER

Connexion et déconnexion

Protection des routes selon les rôles

Gestion des boutons et liens selon l’état de connexion (Ajouter, Modifier, Supprimer)

UI / UX

Interface responsive avec Bootstrap 4/5

Navbar dynamique selon l’utilisateur connecté

Messages flash pour confirmer les actions (ajout, modification, suppression)

Structure des entités
Contact
Propriété	Type	Description
id	int	Identifiant unique
nom	string	Nom du contact
prenom	string	Prénom du contact
telephone	string	Numéro de téléphone
adresse	string	Adresse
ville	string	Ville
age	int	Âge du contact
category	Category	Catégorie du contact
Category
Propriété	Type	Description
id	int	Identifiant unique
title	string	Nom de la catégorie
contacts	Collection	Liste des contacts associés
User
Propriété	Type	Description
id	int	Identifiant unique
email	string	Email utilisateur
password	string	Mot de passe encodé
roles	array	Rôles de l’utilisateur
Routes importantes
Route	Méthode	Description
/	GET	Page d’accueil / liste des contacts
/contact/add	GET, POST	Ajouter un contact
/contact/{id}	GET	Afficher les détails d’un contact
/contact/{id}/edit	GET, POST	Modifier un contact
/contact/{id}/delete	POST	Supprimer un contact
/login	GET, POST	Page de connexion
/register	GET, POST	Page d’inscription
/logout	GET	Déconnexion
Sécurité et utilisateurs

Les utilisateurs doivent être connectés pour :

Ajouter, modifier, supprimer des contacts

Les boutons “Modifier” et “Supprimer” ne s’affichent que pour les utilisateurs connectés.

Les boutons “Se connecter” et “S’inscrire” disparaissent quand l’utilisateur est connecté.

L’utilisateur connecté voit son email en haut de la page avec un lien pour se déconnecter.

Auteurs: Aristide SAGODAN

Projet développé dans le cadre du TP Symfony

Nom : Ton Nom

Email : ton.email@example.com
