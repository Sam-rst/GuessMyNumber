# Devinez Mon Numéro

## Description

Devinez Mon Numéro est une application web interactive qui permet aux utilisateurs de jouer à un jeu simple où ils doivent deviner un nombre généré aléatoirement par le serveur. Le projet utilise PHP pour la logique côté serveur, MySQL pour la base de données, et JavaScript (avec jQuery) pour une expérience utilisateur dynamique.

## Fonctionnalités

- Génération aléatoire d'un nombre entre 1 et 20.
- Validation des suppositions de l'utilisateur avec des indications.
- Stockage et affichage des meilleurs scores des joueurs.
- Interface utilisateur responsive avec Bootstrap.

## Prérequis

- Serveur web avec PHP 7.4 ou supérieur.
- MySQL 5.7 ou supérieur.
- Accès à Internet pour les ressources CDN Bootstrap et jQuery.

## Installation

1. Clonez le dépôt dans votre répertoire de serveur web :
    ~~~
    git clone https://github.com/Sam-rst/GuessMyNumber.git
    ~~~

2. Importez le script SQL fourni dans votre base de données MySQL pour créer les tables nécessaires :
    ~~~sql
    CREATE TABLE guessmynumber (
        id INT AUTO_INCREMENT PRIMARY KEY,
        pseudo VARCHAR(255) NOT NULL,
        score INT NOT NULL
    );
    ~~~

3. Configurez votre connexion à la base de données en modifiant le fichier `config.php` :
    ~~~php
    <?php
    $host = 'votre_hôte';
    $dbname = 'nom_de_votre_base_de_données';
    $user = 'votre_utilisateur';
    $password = 'votre_mot_de_passe';
    ?>
    ~~~

4. Accédez à l'application via un navigateur web en naviguant vers le répertoire où vous avez cloné le dépôt.

## Utilisation

- Ouvrez l'application dans votre navigateur.
- Essayez de deviner le nombre généré aléatoirement par le serveur.
- Recevez des indications si votre supposition est trop haute ou trop basse.
- Enregistrez votre score une fois que vous avez correctement deviné le nombre.

## Contribution

Les contributions à ce projet sont les bienvenues. Veuillez suivre les étapes suivantes pour contribuer :

1. Forkez le dépôt.
2. Créez votre branche de fonctionnalité (`git checkout -b feature/AmazingFeature`).
3. Commitez vos changements (`git commit -m 'Ajout de quelques fonctionnalités incroyables'`).
4. Poussez vers la branche (`git push origin feature/AmazingFeature`).
5. Ouvrez une Pull Request.

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## Contact

Votre nom - exemple@email.com

Lien du projet : https://example.com/mon-projet.git
