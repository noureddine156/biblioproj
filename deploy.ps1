# Script de déploiement PowerShell pour l'application Symfony

Write-Host "Début du déploiement de l'application..." -ForegroundColor Green

# 1. Mise à jour du code source (à décommenter si vous utilisez Git)
# git pull origin main

# 2. Installation des dépendances
Write-Host "Installation des dépendances..." -ForegroundColor Cyan
composer install --no-dev --optimize-autoloader

# 3. Génération des fichiers d'environnement optimisés
Write-Host "Optimisation des fichiers d'environnement..." -ForegroundColor Cyan
composer dump-env prod

# 4. Nettoyage et préchauffage du cache
Write-Host "Optimisation du cache..." -ForegroundColor Cyan
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod

# 5. Mise à jour de la base de données
Write-Host "Mise à jour de la base de données..." -ForegroundColor Cyan
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

Write-Host "Déploiement terminé avec succès !" -ForegroundColor Green
