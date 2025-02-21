# Vibe - Plateforme de Réseautage Social 🌟

## À propos du projet

Vibe est une plateforme de réseautage social moderne et sécurisée, conçue pour permettre aux utilisateurs de se connecter facilement et de gérer leurs relations sociales en ligne. Notre objectif est de fournir une expérience utilisateur fluide et intuitive tout en maintenant les plus hauts standards de sécurité.

## 🚀 Fonctionnalités principales

### Authentification et Sécurité
- ✅ Inscription et connexion sécurisées
- 📧 Système de vérification des emails
- 🔐 Récupération de mot de passe sécurisée
- 🛡️ Authentification propulsée par Laravel Breeze/Jetstream

### Gestion du Profil
- 👤 Personnalisation complète du profil utilisateur
- 📝 Modification des informations personnelles (pseudo unique, nom, prénom)
- 📸 Gestion de la photo de profil
- 🔒 Changement sécurisé du mot de passe

### Fonctionnalités Sociales
- 🔍 Recherche avancée d'utilisateurs (par pseudo ou email)

## 🛠 Technologies Utilisées

- Backend: Laravel 10.x
- Frontend: Vue.js/Livewire
- Base de données: MySQL
- Authentification: Laravel Breeze/Jetstream
- Real-time: Laravel Echo & Pusher

## 📋 Prérequis

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Serveur web (Apache/Nginx)

## ⚙️ Installation

1. Cloner le repository
```bash
git clone https://github.com/votre-username/vibe.git
cd vibe
```

2. Installer les dépendances PHP
```bash
composer install
```

3. Installer les dépendances JavaScript
```bash
npm install
```

4. Copier le fichier d'environnement
```bash
cp .env.example .env
```

5. Configurer la base de données dans `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vibe
DB_USERNAME=root
DB_PASSWORD=
```

6. Générer la clé d'application
```bash
php artisan key:generate
```

7. Exécuter les migrations
```bash
php artisan migrate
```

8. Lancer le serveur de développement
```bash
php artisan serve
npm run dev
```

## 🌐 Configuration des notifications en temps réel

1. Créer un compte sur [Pusher](https://pusher.com/)
2. Configurer les credentials Pusher dans `.env`:
```env
PUSHER_APP_ID=votre_app_id
PUSHER_APP_KEY=votre_app_key
PUSHER_APP_SECRET=votre_app_secret
PUSHER_APP_CLUSTER=votre_cluster
```

## 📦 Structure du Projet

```
vibe/
├── app/
│   ├── Models/
│   ├── Http/Controllers/
│   └── Notifications/
├── database/
│   └── migrations/
├── resources/
│   ├── views/
│   └── js/
└── routes/
```
