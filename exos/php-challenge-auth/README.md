# Challenge PHP

Nous avons vu du CRUD avec l'activité [randonnée](../php-training-mysql).

Certaines actions du CRUD ne doivent pas être accessibles par n'importe qui : comme la mise à jour, la création et la suppression.

Dans ce challenge, nous allons mettre en place une protection sur nos pages _create.php, update.php, delete.php_ de l'activité [randonnée](../php-training-mysql), pour laisser l'utilisation de ces fonctionnalités uniquement à des personnes enregistrées en base de données (les utilisateurs de confiance).

## Comment ça marche

Avant tout, sachez que pour pouvoir faire cela, il faudra savoir utiliser les sessions en PHP. Ce [petit tutoriel](http://www.lephpfacile.com/cours/18-les-sessions) vous explique comment fonctionne les sessions et aussi le principe d'une page connexion et de déconnexion.

## Insérer des utilisateurs

Pour s'identifier, il faut déjà avoir des utilisateurs en base de données.

Avec phpmyadmin, ajoutez des utilisateurs en base de données.

## Protections des pages

Au début de chaque page _create.php_, _update.php_, _delete.php_ vérifiez que l'utilisateur soit connecté.

Pour faire cela c'est très simple. En se connectant vous avez dû enregistrer les informations de l'utilisateur dans une variable de session. Il suffit maintenant d'aller vérifier que la variable de session existe pour savoir si l'utilisateur est valide !

TIPS : Créer une fonction pour pouvoir la réutiliser au début de chaque page concernée.

> C'est un peu léger comme protection mais c'est pour que vous compreniez le principe.

## ALLER PLUS LOIN

Si vous regardez dans la base de données, vous verrez que les mots de passes sont stockés en "clair", on peut les lire. Pas top pour la sécurité.
Il va falloir crypter le mot de passe ! Sachez qu'il y a des fonctions faites pour ça. Pour commencer, on va utiliser la fonction [sha1()](http://php.net/manual/fr/function.sha1.php)

Il faudra crypter le mot de passe dans la base de données. Dans phpmyadmin, lorsque vous entrez/éditer une ligne, vous pouvez voir la colonne _FONCTION_. Dans cette colonne, vous choisissez _SHA1_. Après avoir effectué cela, vous pouvez voir que le mot de passe est une succession de chiffres et de lettres.

Vous allez me dire qu'il y a un problème. Car lors de la connexion de l'utilisateur on compare le mot de passe avec ce qu'il y a dans le champ _password_ de notre base de données et c'est clairement plus la même chose.

Vous avez raison. C'est pourquoi, lors de la connexion, on utilise la fonction `sha1()` avec comme paramètre le mot de passe entrée par l'internaute. À cette fonction, si on lui passe le même paramètre, elle retourne le même résultat.

Pour résumer, dans le fichier qui vérifie les identifiants et les mots de passes, au moment de comparer les mots de passes il suffit d'utiliser la fonction `sha1()`

Par exemple :

```php
//request to find the user in database
$req = $bdd->prepare('SELECT nom FROM user WHERE username = ? AND password <= ?');
//$username and $password are variable you got from the login form
$req->execute(array($username, sha1($password)));
```

**Bonus**

Les fonctions de hashage comme `sha1()`, `md5` ou encore `SHA256` ont beaucoups d'avantages mais également quelques inconvénients, elles sont rapides et efficaces, néanmoins avec les technologies actuelles, il est devenu assez aisé de cibler la sortie de ces algorithmes pour retrouver les données d'origine.

C'est pour cette raison que l'on considère ces algorithmes comme faibles et qu'ils ne sont pas recommandés pour le hashage de mots de passe ou d'utilisateurs...

J'aurais pu vous prévenir avant vous allez me dire et vous auriez raison, néanmoins, ils sont toujours pratiques pour bien comprendre les mécanismes qui entrent en jeu, maintenant que ces aspects n'ont plus aucun secret pour vous, je vous conseille grandement de travailler de manière optimisée et surtout sécurisée en utilisant quelque chose de beaucoup plus viable, PHP est un langage bien fait, il met une API native directement à votre disposition ;) (https://www.php.net/manual/fr/book.password.php), reproduis l'exo en utilisant les fonctions adéquates !
