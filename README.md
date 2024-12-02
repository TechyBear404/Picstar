# Picstar

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

-   PHP 8.2
-   Composer
-   Node.js et npm
-   Git

## Clonage du dépôt

```bash
# Clonez le dépôt
git clone https://github.com/TechyBear404/Picstar.git

# Accédez au répertoire du projet
cd Picstar
```

## Installation des dépendances

### Dépendances PHP (Composer)

```bash
# Installez les dépendances PHP
composer install
```

### Dépendances Node.js

```bash
# Installez les dépendances npm
npm install
```

## Configuration du projet Laravel

```bash
# Générez la clé de l'application
php artisan key:generate

# Créez le dossier pour les SVG
mkdir -p resources/svg

# Créez un lien symbolique pour le stockage
php artisan storage:link

# Exécutez les migrations de base de données
php artisan migrate

# Exécutez les migrations de base de données + seeder
php artisan migrate --seed
```

## Compilation des assets

```bash
# Compilez les assets pour le développement
npm run dev
```

## Lancement du serveur de développement

```bash
# Démarrez le serveur de développement Laravel
php artisan serve
```

## Environnement

1. Copiez le fichier `.env.example` en `.env`
2. Configurez vos variables d'environnement (base de données, etc.)

```bash
cp .env.example .env
```
