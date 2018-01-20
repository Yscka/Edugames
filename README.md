Edugames
========
Installation

Etape 1: Récupérer le code

git clone https://github.com/Yscka/Edugames.git;

Etape 2: Configuration des paramètres
le fichier parameters.yml.dist est à copier puis à renommer (enlevez le .dist)
et modifier.

Etape 3: Télécharger les vendors

php composer.phar install
ou 
composer install
ou
php bin/composer install

4. Créez la base de données
Si la base de données inscrite dans le fichier parameters.yml n'existe pas: 

php bin/console doctrine:database:create

Puis créez les tables correspondantes au schéma Doctrine :

php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force

Pour ajoutez les fixtures :

php bin/console doctrine:fixtures:load

5. Publiez les assets

Installer les assets dans web/ :

php bin/console assets:install web

A Symfony project created on January 19, 2018, 1:24 pm.
