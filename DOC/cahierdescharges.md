# RDZAgent

## Desciption du problème

Dans le parachutisme il y a un responsable de drop zone, raccourci RDZ (Drop zone ou DZ est juste un endroit ou il y a une activité de largage de parachutistes) qui doit, entre autre, consacrer sa journée à s'occuper de l'organisation des avions ansi que de la caisse.

Cette personne doit sacrifier sa journée pour les autres. 

Une autre problématique est que l'avionnage ce fait encore souvent avec une page en papier ou les noms des sauteurs y sont inscrits. Souvent, les sauteurs ne passent pas par le rdz pour s'avionner (s'inscrire sur le papier) et cela mène à des overbooking des sauteurs ne peuvent pas monter dans cet avion.

## La solution proposée

[P] objectif principal

[S] objectif secondaire

Une application web mobile first ou il est possible de voir les horaires des prochains avions.

- Pour les non-connectés
    * [P] Voir les horaires des avions
    
    * [P] Voir le nombre de places encore disponible dans un avion

    * [P] Se connecter

    * [S] Voir la météo

    * [S] Voir si l'activité à lieu (remplacer un répondeur de l'année 1912)

    

- Pour les utilisateurs

    * [P] Création un compte

    * [P] Voir qui est dans le prochain avion.

    * [P] Rejoindre un avion ou il y a des places libre.

    * [S] Des notifications quand il faut se préparer.

    * [S] Acheter des tickets de sauts (MasterCard twint etc.)

- Pour les RDZ
    * [P] Retirer quelqu'un d'un avion

    * [P] Annuler un avion

    * [P] Création des avions

    * [P] Modification d'un avion (et répercussion sur les suivants, imaginons un retard, cela repousse le décollage des suivants)

    * [P] Créer des templates d'avions ( afin de facilement pouvoir les ajouter dans l'horaire)
    
    * [P] Gérer les crédits des utilisateurs (les crédits sont le nombre de sauts, si l'utilisateur va à la caisse acheter, le RDZ doit lui ajouter des crédits de sauts)
    
    * [P] Création d'un compte utilisateur

    * [P] Avionner un utilisateur


Cette application ne peut pas remplacer le RDZ car il doit communiquer fréquemment avec le pilote afin de synchroniser les largages. Mais, l'appli devrait lui permettre de faire des sauts avec les autres et de quand-même passer une journée amusante et non pas que stressante.

## Contraintes

### Design

Reprendre le design général du site existant [pcv.ch](https://www.pcv.ch/)
