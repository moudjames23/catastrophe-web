<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Configuration
## Pré réquis: [GIT](https://git-scm.com/) [Composer](https://getcomposer.org/) [PHP 7.2.5+](https://www.php.net/)
1. Cloner le projet sur votre en tapant cette commande: 
```
git clone https://github.com/moudjames23/catastrophe-web.git
```
2. Deplacer vous dans le repertoire du projet du tapant: 

```
cd [NOM_DOSSIER]/catastrophe-web
```

3. Installer les dependances en tapant cette commande:

```
composer update
```

4. Créer le fichier .env

```
cp  .env.example .env
```
5. Generer la clé:
```
php artisan key:generate
```
6. Connexion à la base de données:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NOM_DE_LA_BASE_DONNEE
DB_USERNAME=USERNAME
DB_PASSWORD=MOT_DE_PASSE
```

7. Migrer les tables
```
php artisan migrate
```

8. Initiliaser les donnees:
```
php artisan  db:seed
```

9. Lancer le server

```
php artisan serve
```
