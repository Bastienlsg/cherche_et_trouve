# 🌱 Cherche & Trouve - Trouvez les plantes 🌱

🧒 Créez des personnages et attribuez leur des compétences et des types ! 🧒

## Il vous faut :

* Un serveur local en utilisant [LAMP](https://doc.ubuntu-fr.org/lamp) ou [WAMP](https://www.wampserver.com/)
* [PHP 8.1+](https://www.php.net/downloads)
* Composer est un logiciel gestionnaire de dépendances libre écrit en PHP, vous en aurez besoin pour ce projet installez-le sur : 
        - [Windows](https://getcomposer.org/)
        ou [Linux](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04-fr)

* Faire une copie du projet en mettant dans le terminal :

```git clone https://github.com/Bastienlsg/TheEmpire```

* Dans le projet faites :

```composer install```

## Démarrez le projet :

* Nous avons mit un .envsample, copiez-le en le renommant .env et mettez vos identifiants de connexion à la BDD.

* Pour créer la base de données faites :

```php bin/console doctrine:database:create```

* Pour y insérer des données faites :

```php bin/console doctrine:migrations:migrate```

* Pour démarrer le serveur Symfony faites :

```symfony server:start```

* Entrez l'adresse de votre serveur local dans l'url

* Si vous souhaitez vous connecter au Back Office :

```email: admin@gmail.com mdp: admin```

## Les créateurs du projet :

* Axel, Hugo, et Bastien.
