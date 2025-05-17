#!/bin/bash

# Script de déploiement pour l'application Symfony

echo "Début du déploiement de l'application..."

# 1. Mise à jour du code source (à décommenter si vous utilisez Git)
# git pull origin main

# 2. Installation des dépendances
echo "Installation des dépendances..."
composer install --no-dev --optimize-autoloader

# 3. Génération des fichiers d'environnement optimisés
echo "Optimisation des fichiers d'environnement..."
composer dump-env prod

# 4. Nettoyage et préchauffage du cache
echo "Optimisation du cache..."
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod

# 5. Mise à jour de la base de données
echo "Mise à jour de la base de données..."
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

# 6. Configuration des permissions si nécessaire
# echo "Configuration des permissions..."
# chmod -R 775 var/
# chown -R www-data:www-data var/

echo "Déploiement terminé avec succès !"
