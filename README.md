📒 Projet TP1 – AGENDA (Symfony)

Ce projet est une application web de gestion de contacts (Agenda) développée avec Symfony, Twig, Doctrine ORM et le module de Sécurité Symfony.
Il permet de gérer des contacts, des catégories, l’authentification des utilisateurs ainsi que des formulaires d’ajout et de modification.

🚀 Fonctionnalités
✅ Gestion des contacts

Affichage de la liste des contacts

Affichage du détail d’un contact

Ajout d’un contact via un formulaire

Modification d’un contact

Suppression d’un contact

Filtrage des contacts ayant plus de 18 ans

✅ Gestion des catégories

Création de l’entité Category

Relation OneToMany entre Category et Contact

Trois catégories par défaut :

famille

amis

travail

Affichage de la catégorie dans le tableau

Sélection de la catégorie dans les formulaires

✅ Sécurité

Inscription d’un utilisateur (ROLE_USER par défaut)

Connexion / Déconnexion

Gestion des affichages selon l’état de connexion :

Utilisateur connecté :

Boutons Ajouter, Modifier, Supprimer

Message : "Vous êtes connecté en tant que email@email.com
"

Lien Se déconnecter

Utilisateur non connecté :

Liens Se connecter et S’inscrire

Aucun accès aux boutons Modifier/Supprimer

✅ Validation des formulaires

Nom : minimum 2 caractères

Prénom : minimum 2 caractères

Téléphone : champ obligatoire

Âge : entre 15 et 120 ans

🛠️ Technologies utilisées

PHP 8+

Symfony 6+

Twig

Doctrine ORM

Bootstrap 5

MySQL / phpMyAdmin

📁 Structure du projet
/src
 ├── Controller
 ├── Entity
 ├── Form
 ├── Repository
/templates
 ├── base.html.twig
 ├── home.html.twig
 ├── contact.html.twig
 ├── ajouter.html.twig
 ├── modifier.html.twig
/config
/migrations
/public
.env

⚙️ Installation du projet
1. Cloner le projet
git clone https://github.com/votre-repo/agenda.git
cd agenda

2. Installer les dépendances
composer install

3. Configurer la base de données

Dans le fichier .env :

DATABASE_URL="mysql://root:@127.0.0.1:3306/agenda"

4. Créer la base de données
php bin/console doctrine:database:create

5. Exécuter les migrations
php bin/console make:migration
php bin/console doctrine:migrations:migrate

6. Lancer le serveur
symfony server:start

🧱 Entités
🧍 Contact

id

nom

prenom

telephone

adresse

ville

age

category (relation ManyToOne)

🗂️ Category

id

title

contacts (relation OneToMany)

👤 User

id

email

password

roles

🖥️ Pages principales
Page	Description
/	Page d’accueil – Liste des contacts
/contact/{id}	Détails d’un contact
/ajouter	Ajouter un contact
/modifier/{id}	Modifier un contact
/register	Inscription
/login	Connexion
🔐 Règles de sécurité

Accès restreint aux fonctionnalités Ajouter / Modifier / Supprimer

Affichage dynamique du menu selon l’état de connexion

Déconnexion redirige vers l’accueil

🧪 Exemples de fonctionnalités spécifiques

Bouton Modifier :

Modifie le numéro de téléphone par "New number !"

Bouton Supprimer :

Supprime le contact de la base de données

Affichage uniquement des contacts > 18 ans

📌 Objectifs pédagogiques

Comprendre l’architecture MVC de Symfony

Manipulation de Twig

Utilisation de Doctrine ORM

Création de formulaires

Mise en place d’un système d’authentification

Gestion des relations entre entités

Sécurisation d’une application web

👨‍🎓 Auteur

Projet réalisé dans le cadre du TP Symfony – Agenda
Étudiant(e) : [Votre nom]
Année : 2024 - 2025
