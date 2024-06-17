# SQL / DB

## Objectifs pédagogiques

1. Maîtriser la syntaxe SQL (les principaux types de requêtes)
1. Pouvoir récupérer les données stockées dans une base de données
1. Pouvoir faire des [requêtes préparées](http://php.net/manual/fr/pdo.prepared-statements.php)
1. Comprendre ce qu'est le CRUD

### Parcours pédagogiques (Les bases du SQL)

1. Intro : [Intro](./1.intro.md)
1. Read : [SELECT](https://sqlbolt.com/lesson/select_queries_introduction) Lesson 1 to 12
1. Create : [INSERT INTO](https://sqlbolt.com/lesson/inserting_rows)
1. Update : [UPDATE](https://sqlbolt.com/lesson/updating_rows)
1. Delete : [DELETE FROM](https://sqlbolt.com/lesson/deleting_rows)
1. [CREATE DB](https://sqlbolt.com/lesson/creating_tables)
1. [UPDATE DB](https://sqlbolt.com/lesson/altering_tables)
1. [DROP DB](https://sqlbolt.com/lesson/dropping_tables)
1. Pour [voler de tes propres ailes](./2.moveon.md)
1. PHP + MySQL : [via PDO](./3.0.pdo.md)
1. [Bases de données relationnelles](4.relational-db.md)

### Exercices pratiques

1. [petits exercices / Drill d'initiation au SQL](./sql-exo)
1. [MySQL CRUD - Activité "randonnée"](./exos/php-training-mysql) - Comprendre la base de données
1. [Authentification](./exos/php-challenge-auth) - Create a user system
1. [CRUD - 1](./exos/php-exercises-crud1) - CRUD part one
1. [CRUD - 2](./exos/php-exercises-crud2) - CRUD part two

Rappel : bien séparer le traitement PHP (avant la balise doctype) et l'affichage dans le navigateur (dans la partie HTML)!

### Perfectionnement :

1. [Utiliser les transactions](https://riptutorial.com/php/example/4186/database-transactions-with-pdo) (soit toutes les requêtes s'exécutent, soit elles échouent toutes)
1. Savoir penser et construire une base de données relationnelle
1. Mettre en place un CRUD
1. Réaliser un REST API

### Ressources externes

- [Introduction à MySQL](https://docs.google.com/presentation/d/1yXQz5dMMDkdSu5eBOG7YS2UH2uWyg5vJmU0kJt6YR6Q/edit?usp=sharing) - DB, phpMyAdmin et SQL
- [Introduction à PDO](https://docs.google.com/presentation/d/14-5BGNJyuILB2kfYlxzsaFDRNA8zCrot9DbYVVNo3X4/edit?usp=sharing) - connexion à la DB
- [Introduction aux bases de données relationnelles](https://docs.google.com/presentation/d/1pPVFVr72xmmGpHFSKbF6ZL9QblwfX5MWaViXlnY3w2I/edit?usp=sharing) - tables multiples et jointures
- [Wiki sur les MCD et les logiciels utiles pour les réaliser](https://github.com/becodeorg/BeCode/wiki/Outils-de-mod%C3%A9lisation-de-base-de-donn%C3%A9es-%28SQL%29)
