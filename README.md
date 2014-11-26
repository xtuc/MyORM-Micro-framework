# MyORM-Micro-framework

Fonctionnalités du framework :
- Un ORM puissant pour la partie backend.
- Un MVC utilisant l'url rewriting très facile à utiliser.
- Un moteur de template : Twig composant de Symfony2 ([Twig sensiolabs](http://twig.sensiolabs.org/))

[Site de démonstration](http://MyORM.xtuc.net/)

## Configuration

La configuration du framework se fait à partir du sossier /application/config. Les paramètres sont défini par la fonction define() de PHP. Config.php est le fichier de configuration générale et le fichier orm_config.php celui spécifique à l'ORM.

Veuillez pensez à modifier la configuration pour la connexion à votre base de données disponible dans le fichier config.php.
```php
define('DB_TYPE', 'mysql'); // Type de base de données (http://php.net/manual/fr/pdo.drivers.php)
define('DB_HOST', 'localhost');
define('DB_NAME', 'site');
define('DB_USER', 'site');
define('DB_PASS', 'secret'); 
```

##### Configurations additionnels :
- "DB_CHARSET" permet de choisir l'encodage SQL, "UTF8" par défault.

## Usage ORM

Voici la table "membre" notre base de données :

```
ID       Nom       Prenom 
-------  --------  ---------- 
      1  DUPONT    Alain 
      2  MARTIN    Marc
      3  BOUVIER   Alain
      4  DUBOIS    Paul
      5  DREYFUS   Jean 
```

Imaginons que vous souhaitiez le nom du membre n°2.

```php
$membre = new ORM\membre(2);
echo $membre->Nom; // retourne "MARTIN"
```

Pour le modifier:
```php
...
$membre->Nom = "DEJEAN";
$membre->save();
```
Maintenant vous souhaitez supprimer ce membre:
```php
...
$membre->delete();
```

Vous pouvez personnaliser l'ORM pour l'adapter à votre site. Par exemple si vous souhaitez récupérer un membre en function de son prénom. Vous devez créer un fichier PHP destiné à la couche modèle du MVC dans le dossier /application/models. Créez une class qui hérite de la class ORM\membre.
```php
namespace ORM;

use ORM\SQL\SQL;

class MyMembre extends membre
{
  public function __construct($id = NULL)
  {
      if(!is_null($id)) {
        parent :: __construct($id);
      }
  }
  
  public function ByPrenom($prenom)
  {
    $sql = new sql();
    $query = $sql->sql_query("SELECT * FORM membre WHERE Prenom = ". $sql->quote($prenom) . " LIMIT 1");
    
    $membre = $sql->sql_fetch_object($query, "ORM\\membre");
    return $membre;
  }
}
```

## Usage MVC

Nous ne somme pas les auteurs du système de MVC mais il n'est actuellement plus disponible. Nous l'avons adapté au moteur de template et à l'ORM.
Comme mentionné tout en haut le MVC marche avec l'URL rewiting. Vous devez absolument l'avoir activé. Ainsi le framework intègre des URL plus SEO-friendly comme par exemple : http://www.exemple.com/membre/profil/2. 

La syntaxe de l'URL est simple et pratique:
- "http://www.exemple.com" est votre nom de domaine.
- "/membre" est le nom de la class dans la couche controlleur (dossier controller).
- "/profil" est la function dans la class membre.
- "/2" est un des arguments de la function profil().

Vous pouvez cumuler jusqu'a 4 arguments, par exemple http://www.exemple.com/membre/profil/2/Martin/Marc/Stagiaire est égale à : 
```php
membre->profil(2, "Martin", "Marc", "Stagiaire");
```

## Installation

Téléchargez ou clonez le GIT.

```sh
$ git clone https://github.com/xtuc/MyORM-Micro-framework.git
```

Le framework ne require pas d'installation spécifique.

## Configuration minimum requise

L'ORM require PHP 5 >= 5.3.0 a cause de l'utilisation des namespaces notament. 

## Auteurs
- Renaud PLATEL
- Sven SAULEAU
