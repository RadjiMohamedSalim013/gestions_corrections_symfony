# Gestion des corrections - Application Symfony

Une application web complète pour la gestion des examens scolaires, développée avec Symfony . Cette plateforme permet de gérer les établissements, les professeurs, les épreuves, les examens et les corrections de manière centralisée.

## 🎯 Fonctionnalités

### Gestion des entités principales
- **Établissements** : Gestion des écoles et établissements scolaires
- **Professeurs** : Administration des enseignants et leurs informations
- **Épreuves** : Création et gestion des différentes épreuves
- **Examens** : Organisation des sessions d'examen
- **Corrections** : Suivi des corrections et évaluations

### Fonctionnalités avancées
- Export des données en PDF
- Interface responsive et moderne
- Système de CRUD complet pour toutes les entités
- Validation des données côté client et serveur
- Gestion des relations entre entités

## 🛠️ Stack Technique

### Backend
- **Symfony 6.4** - Framework PHP moderne
- **Doctrine ORM** - Mapping objet-relationnel
- **Twig** - Moteur de templates
- **MySQL** - Base de données relationnelle
- **PHPUnit** - Tests unitaires

### Frontend
- **Bootstrap 5** - Framework CSS responsive


### Outils de développement
- **Web Debug Toolbar** - Debugging en environnement dev
- **Maker Bundle** - Génération de code
- **Doctrine Fixtures** - Jeux de données de test

## 🚀 Installation

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- MySQL 8.0 ou supérieur
- Symfony CLI (optionnel mais recommandé)

### Étapes d'installation

1. **Cloner le projet**
```bash
git clone [URL_DU_REPO]
cd symfony-starter
```

2. **Installer les dépendances**
```bash
composer install
```

3. **Configurer l'environnement**
```bash
cp .env .env.local
# Modifier .env.local avec vos paramètres de base de données
```

4. **Créer la base de données**
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. **Charger les données de test**
```bash
php bin/console doctrine:fixtures:load
```

6. **Lancer le serveur**
```bash
symfony serve
# ou
php -S localhost:8000 -t public/
```

L'application sera accessible sur `http://localhost:8000`

## 📊 Structure de la Base de Données

### Entités principales

#### Établissement
- `id` - Identifiant unique
- `nom` - Nom de l'établissement
- `adresse` - Adresse postale
- `telephone` - Numéro de contact
- `email` - Email de contact
- `created_at` - Date de création

#### Professeur
- `id` - Identifiant unique
- `nom` - Nom du professeur
- `prenom` - Prénom du professeur
- `email` - Email professionnel
- `telephone` - Numéro de contact
- `matiere` - Matière enseignée
- `etablissement` - Relation avec l'établissement

#### Épreuve
- `id` - Identifiant unique
- `titre` - Titre de l'épreuve
- `description` - Description détaillée
- `duree` - Durée en minutes
- `coefficient` - Coefficient de l'épreuve
- `matiere` - Matière concernée
- `created_at` - Date de création

#### Examen
- `id` - Identifiant unique
- `date_examen` - Date de l'examen
- `heure_debut` - Heure de début
- `salle` - Salle d'examen
- `epreuve` - Relation avec l'épreuve
- `professeur` - Relation avec le professeur surveillant
- `created_at` - Date de création

#### Correction
- `id` - Identifiant unique
- `note` - Note attribuée
- `commentaire` - Commentaire du correcteur
- `date_correction` - Date de correction
- `examen` - Relation avec l'examen
- `professeur` - Relation avec le professeur correcteur
- `created_at` - Date de création

## 🎯 Utilisation

### Accès aux différentes sections

- **Page d'accueil** : `/` - Tableau de bord général
- **Établissements** : `/etablissement/` - Liste et gestion des établissements
- **Professeurs** : `/professeur/` - Administration des enseignants
- **Épreuves** : `/epreuve/` - Gestion des épreuves
- **Examens** : `/examen/` - Planification des examens
- **Corrections** : `/correction/` - Suivi des corrections

### Fonctions CRUD

Toutes les entités disposent des opérations CRUD complètes :
- **Create** : Création de nouvelles entrées
- **Read** : Consultation des données
- **Update** : Modification des informations
- **Delete** : Suppression des entrées

