# Symfony 7.3 Starter Template 🚀

Template de base Symfony 7.3 prêt à l'emploi pour démarrer rapidement de nouveaux projets.

## 📋 Prérequis

- PHP 8.2 ou supérieur
- Composer
- Symfony CLI (optionnel mais recommandé)
- Node.js 18+ et npm (pour les assets)
- Docker & Docker Compose (optionnel)

## 🛠️ Stack Technique

### Framework & Core
- **Symfony 7.3** - Framework PHP moderne
- **PHP 8.2+** - Version PHP requise
- **Doctrine ORM 3.x** - Mapping objet-relationnel
- **Twig 3.x** - Moteur de template

### Base de données
- **Doctrine DBAL 3.x** - Abstraction de base de données
- **Doctrine Migrations 3.x** - Gestion des migrations
- **Fixtures** - Jeux de données de test (doctrine-fixtures-bundle)

### Frontend
- **AssetMapper** - Gestion des assets natifs Symfony
- **Stimulus Bundle** - Framework JavaScript moderne
- **UX Turbo** - Navigation rapide sans rechargement
- **Bootstrap** via CDN (configurable)

### Outils de développement
- **PHPUnit 11.5** - Tests unitaires
- **Maker Bundle** - Génération de code
- **Web Profiler** - Barre de debug Symfony
- **Monolog** - Logging structuré

### Services intégrés
- **Mailer** - Envoi d'emails
- **Messenger** - File d'attente et workers
- **Translation** - Internationalisation
- **Security Bundle** - Authentification et autorisation
- **Validator** - Validation de données
- **Form** - Création de formulaires

## 🚀 Démarrage rapide

### Méthode 1 : Installation locale

```bash
# Cloner le projet
git clone [URL_DU_REPO] mon-nouveau-projet
cd mon-nouveau-projet

# Installer les dépendances PHP
composer install

# Copier l'environnement
cp .env .env.local

# Configurer la base de données dans .env.local
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
# ou
# DATABASE_URL="mysql://user:password@127.0.0.1:3306/db_name"

# Créer la base de données
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# Charger les fixtures (optionnel)
php bin/console doctrine:fixtures:load

# Lancer le serveur
symfony serve -d
```

### Méthode 2 : Avec Docker (optionnel)

```bash
# Lancer les services
docker-compose up -d

# Installer les dépendances
docker-compose exec php composer install

# Créer la base de données
docker-compose exec php bin/console doctrine:database:create
docker-compose exec php bin/console doctrine:migrations:migrate
```

## 📁 Structure du projet

```
symfony-starter/
├── assets/              # Assets frontend (JS, CSS)
│   ├── app.js          # Point d'entrée JavaScript
│   ├── bootstrap.js    # Initialisation
│   └── controllers/    # Contrôleurs Stimulus
├── bin/                 # Commandes console
│   └── console         # Commande principale
├── config/              # Configuration Symfony
│   ├── packages/       # Configuration des bundles
│   ├── routes/         # Routes
│   └── services.yaml   # Services
├── migrations/          # Fichiers de migration Doctrine
├── public/              # Point d'entrée web
│   └── index.php       # Front controller
├── src/                 # Code source PHP
│   ├── Controller/     # Contrôleurs
│   ├── Entity/         # Entités Doctrine
│   ├── Repository/     # Repositories Doctrine
│   └── DataFixtures/   # Jeux de données
├── templates/          # Templates Twig
│   └── base.html.twig  # Template de base
├── tests/              # Tests PHPUnit
├── translations/       # Fichiers de traduction
├── var/                # Cache et logs
├── vendor/             # Dépendances Composer
├── composer.json       # Dépendances PHP
├── compose.yaml        # Configuration Docker
└── importmap.php      # Assets JavaScript
```

## 📝 Commandes utiles

### Base de données
```bash
# Créer la base
php bin/console doctrine:database:create

# Exécuter les migrations
php bin/console doctrine:migrations:migrate

# Générer une migration
php bin/console make:migration

# Charger les fixtures
php bin/console doctrine:fixtures:load
```

### Génération de code
```bash
# Créer un contrôleur
php bin/console make:controller

# Créer une entité
php bin/console make:entity

# Créer un formulaire
php bin/console make:form

# Créer un repository
php bin/console make:repository
```

### Tests
```bash
# Lancer tous les tests
php bin/phpunit

# Lancer un test spécifique
php bin/phpunit tests/Controller/SomeControllerTest.php
```

### Cache et performance
```bash
# Vider le cache
php bin/console cache:clear

# Vérifier l'environnement
php bin/console about
```

## 🔧 Configuration

### Variables d'environnement importantes (.env.local)

```bash
# Base de données
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
# ou
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

# Mailer (pour les emails)
MAILER_DSN="smtp://localhost:1025"

# Clé secrète de l'application
APP_SECRET="your-secret-key-here"

# Environnement
APP_ENV=dev
APP_DEBUG=true
```

## 🎯 Personnalisation rapide

### 1. Renommer le projet
Modifier `composer.json` :
```json
{
    "name": "your-username/your-project-name",
    "description": "Description de votre projet"
}
```

### 2. Changer la base de données
Modifier `DATABASE_URL` dans `.env.local`

### 3. Installer des packages supplémentaires
```bash
# Admin panel
composer require easycorp/easyadmin-bundle

# API Platform
composer require api

# Authentification
composer require symfonycasts/verify-email-bundle
```

### 4. Créer votre première page
```bash
# Créer un contrôleur
php bin/console make:controller HomeController

# Créer une entité
php bin/console make:entity Article
```

## 🐛 Troubleshooting

### Problèmes courants

**Erreur : "Unable to write in the "cache" directory"**
```bash
sudo chown -R $USER:$USER var/
chmod -R 755 var/
```

**Erreur de mémoire PHP**
```bash
# Augmenter la mémoire PHP
php -d memory_limit=2G bin/console [command]
```

**Erreur de connexion à la base de données**
```bash
# Vérifier la configuration
php bin/console debug:config doctrine
```

## 📚 Ressources

- [Documentation Symfony 7.3](https://symfony.com/doc/current/index.html)
- [Doctrine Documentation](https://www.doctrine-project.org/projects/doctrine-orm/en/current/index.html)
- [Twig Documentation](https://twig.symfony.com/doc/)
- [AssetMapper Documentation](https://symfony.com/doc/current/frontend/asset_mapper.html)

## 🤝 Contribution

1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request



**Template créé avec  pour Symfony 7.3**
