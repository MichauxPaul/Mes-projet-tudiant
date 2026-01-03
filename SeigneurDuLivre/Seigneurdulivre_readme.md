# Readme Seigneur du livre

## Table des matières

- [Générales](#generales)
- [Intégration](#integration)
- [Système_d'information](#systeme_d'information)
- [Développement_web](#developpement_web)
- [Hébergement](#hebergement)

## Générales

- Notre site se nomme "Seigneur du Livre"
- Projet réalisé par : Paul Michaux (paul.michaux9@etu.univ-lorraine.fr) ; Lilou Toussaint-Erraes (lilou.toussaint-erraes5@etu.univ-lorraine.fr)
- Notre site est adressé à tout type de public, du plus jeune au plus vieux. C'est un site de location de livres numériques. Il permet de louer des livres (en pdf) et permet aux clients de donner leurs avis sur les livres qu'ils ont lus. Le site permet aussi de posséder une bibliothèque pour réserver un livre, noter les livres qu'on a déjà lus, et ceux qu'on veut lire. Tout cela n'est accessible qu'aux personnes s'étant un compte sur le site.
- L'arborescence :
```
sae203_SeigneurDuLivre
├─ .htaccess
├─ config_webetu.php
├─ index.php
├─ media
│  ├─ erreur403.webp
│  ├─ erreur404.webp
│  ├─ livre
│  │  ├─ image1.webp
│  │  ├─ image10.webp
│  │  ├─ image11.webp
│  │  ├─ image12.webp
│  │  ├─ image13.webp
│  │  ├─ image14.webp
│  │  ├─ image15.webp
│  │  ├─ image16.webp
│  │  ├─ image17.webp
│  │  ├─ image2.webp
│  │  ├─ image3.webp
│  │  ├─ image4.webp
│  │  ├─ image5.webp
│  │  ├─ image6.webp
│  │  ├─ image7.webp
│  │  ├─ image8.webp
│  │  └─ image9.webp
│  ├─ logo
│  │  ├─ favicon.webp
│  │  ├─ logo_Commando_57.png
│  │  └─ logo_SDL.webp
│  └─ siteconstruction.jpg
├─ page
│  ├─ affiche_livre.php
│  ├─ ajouter_location.php
│  ├─ ajouter_souhait.php
│  ├─ config_webetu.php
│  ├─ creation_compte.php
│  ├─ erreur403.php
│  ├─ erreur404.php
│  ├─ espace_personnel.php
│  ├─ login.php
│  ├─ logout.php
│  ├─ nav
│  │  ├─ config_webetu.php
│  │  └─ nav.php
│  ├─ noter_livre.php
│  └─ resultat.php


```


## Intégration


- On a pas utilisé de  composants de Bootstrap qui n'étaient pas vus dans le site @home. 

-  Pour 600px :
![page index en 600px](image_readme/index%20600px.png "[page index en 600px")

![page affiche_livre en 600px](image_readme/affiche_livre%20600px.png "[page affiche_livre en 600px")

![page creation_compte en 600px](image_readme/creation_compte%20600px.png "[page creation_compte en 600px")

![page espace_personnel en 600px](image_readme/espace_personnel%20600px.png "[page espace_personnel en 600px")

![page login en 600px](image_readme/login%20600px.png "[page login en 600px")

![page affiche_livre en 600px](image_readme/resultat%20600px.png "page resultat en 600px")

-  Pour 800px :
![page index en 800px](image_readme/index%20800px.png "[page index en 800px")

![page affiche_livre en 800px](image_readme/affiche_livre%20800px.png "[page affiche_livre en 800px")

![page creation_compte en 800px](image_readme/creation_compte%20800px.png "[page creation_compte en 800px")

![page espace_personnel en 800px](image_readme/espace_personnel%20800px.png "[page espace_personnel en 800px")

![page login en 800px](image_readme/login%20800px.png "[page login en 800px")

![page affiche_livre en 800px](image_readme/resultat%20800px.png "page resultat en 800px")

-  Pour 1000px :
![page index en 1000px](image_readme/index%201000px.png "[page index en 1000px")

![page affiche_livre en 1000px](image_readme/affiche_livre%201000px.png "[page affiche_livre en 1000px")

![page creation_compte en 1000px](image_readme/creation_compte%201000px.png "[page creation_compte en 1000px")

![page espace_personnel en 1000px](image_readme/espace_personnel%201000px.png "[page espace_personnel en 1000px")

![page login en 1000px](image_readme/login%201000px.png "[page login en 1000px")

![page affiche_livre en 1000px](image_readme/resultat%201000px.png "page resultat en 1000px")

-  Pour 1300px :
![page index en 1300px](image_readme/index%201300px.png "[page index en 1300px")

![page affiche_livre en 1300px](image_readme/affiche_livre%201300px.png "[page affiche_livre en 1300px")

![page creation_compte en 1300px](image_readme/creation_compte%201300px.png "[page creation_compte en 1300px")

![page espace_personnel en 1300px](image_readme/espace_personnel%201300px.png "[page espace_personnel en 1300px")

![page login en 1300px](image_readme/login%201300px.png "[page login en 1300px")

![page affiche_livre en 1000px](image_readme/resultat%201300px.png "page resultat en 1300px")


## Système d'information

 [lien vers l'export sql ds tables seigneurdulivre](seigneurdulivre.sql)

 ![modèle conceptuel de données](image_readme/MCD.jpg "modèle conceptuel de données")

Explication : 
• SDL_BOOK :
◦ Cette entité joue le rôle d’avoir toutes les informations unique sur un ouvrage littéraire comme son code qui l’identifie dans la base de données,son nom, sa date de parution, son prix, son visuel et sa description
• SQL_TYPE
◦ Cette entité contient le nom de tous les type d’ouvrage littéraire
• SDL_RATING
◦ Contient la note qu’un utilisateur à donné à un ouvrage littéraire
• SDL_CLIENT
◦ Contient toutes les information relative au client qui lui permettent de se connecter à son compte
• SDL_RENTAL
◦ Contient les dates et heures du début de la location et la fin de la location
• SDL_BILL
◦ Contient l’identifiant et la date de la facture
• SDL_AUTHOR
◦ Contient l’identifiant, le nom et le prénom de l’auteur
• SDL_PUBLISHER
◦ Contient l’identifiant et le nom de l’éditeur
• SDL_THEME
◦ Contient l’identifiant et le nom du thème
• Cardinalité
◦ Entre SDL_BOOK et SQL_TYPE :
▪ 1,1 car un ouvrage littéraire ne peut avoir qu’un seule et unique type
◦ Entre SQL_TYPE et SDL_BOOK :
▪ 0,n car un type peut être choisi 0 fois ou il peut y avoir plein d’ouvrage littéraire associé à ce type
◦ Entre SDL_BOOK et SDL_CLIENT :
▪ 0,n car un client peut avoir choisi 0 ouvrage littéraire ou plusieures
◦ Entre SDL_CLIENT et SDL_BOOK :
▪ 0,n car un client peut avoir choisi 0 ouvrage littéraire ou plusieures
◦ Entre SDL_BOOK et SDL_PUBLISHER :
▪ 1,n car un éditeur peut publier plusieurs livres.
◦ Entre SDL_PUBLISHER et SDL_BOOK :
▪ 1,n car un livre est publié par un ou plusieurs éditeurs
◦ .Entre SDL_AUTHOR et SDL_BOOK :
▪ 1,n car un auteur peut écrire un ou plusieurs livres.
◦ Entre SDL_BOOK et SDL_AUTHOR :
▪ 1,n car un livre doit être écrit par un ou plusieurs auteurs
◦ Entre SDL_BOOK et SDL_THEME :
▪ 1,n car un livre peut avoir un ou plusieurs thèmes.
◦ Entre SDL_THEME et SDL_BOOK :
▪ 0,n car un thème peut ou pas concerner plusieurs livres.
◦ Entre SDL_CLIENT et SDL_RATING :
▪ 0,n car un client peut noter plusieurs livres ou aucun.
◦ Entre SDL_RATING et SDL_CLIENT :
▪ 0,n car un livre peut recevoir plusieurs notes ou aucune.


- Le MLD :
SDL_TYPE = (TE_Code, TE_Name);
SDL_CLIENT = (CT_Code, CT_Firstname, CT_Surname, CT_Password, CT_Email);
SDL_AUTHOR = (AR_Code, AR_Surname, AR_Firstname);
SDL_PUBLISHER = (PR_Code, PR_Name);
SDL_BILL = (BL_Code, BL_Date);
SDL_THEME = (TH_Code, TH_Name);
SDL_BOOK = (BK_Code, BK_Name, BK_Release, BK_Cost, BK_Visual, BK_Description, #TE_Code);
SDL_RENTAL = (#BK_Code, #CT_Code, #BL_Code, RL_Start, RL_End);
SDL_WRITE = (#BK_Code, #AR_Code);
SDL_PUBLISH = (#BK_Code, #PR_Code);
SDL_RATING = (#BK_Code, #CT_Code, RG_Value);
SDL_COVER = (#BK_Code, #TH_Code);

- ![modèle physiquede données](image_readme/structure_table.jpg "modèle physique de données de données")

-  Données stockées dans chaque table :

SDL_AUTHOR
![SDL_AUTHOR](image_readme/données_SDL_Author.png "SDL_AUTHOR")

SDL_BILL
![SDL_BILL](image_readme/données_SDL_BILL.png "SDL_BILL")

SDL_BOOK
![SDL_BOOK](image_readme/données_SDL_BOOK.png "SDL_BOOK")

SDL_CLIENT
![SDL_CLIENT](image_readme/données_SDL_CLIENT.png "SDL_CLIENT")

SDL_COVER
![SDL_COVER](image_readme/données_SDL_COVER.png "SDL_COVER")

SDL_PUBLISH
![SDL_PUBLISH](image_readme/données_SDL_PUBLISH.png "SDL_PUBLISH")

SDL_PUBLISHER
![SDL_PUBLISHER](image_readme/données_SDL_PUBLISHER.png "SDL_PUBLISHER")

SDL_RATING
![SDL_RATING](image_readme/données_SDL_RATING.png "SDL_RATING")

SDL_RENTAL
![SDL_RENTAL](image_readme/données_SDL_RENTAL.png "SDL_RENTAL")

SDL_THEME
![SDL_THEME](image_readme/données_SDL_THEME.png "SDL_THEME")

SDL_TYPE
![SDL_TYPE](image_readme/données_SDL_TYPE.png "SDL_TYPE")

SDL_WRITE
![SDL_WRITE](image_readme/données_SDL_WRITE.png "SDL_WRITE")

- liste des requêtes sql :

 Dans index.php :
 SELECT 
    b.BK_Code AS id,
    b.BK_Name AS titre,
    b.BK_Description AS resume,
    b.BK_Visual AS image,
    b.BK_Cost AS prix_location,
    CONCAT(a.AR_Firstname, ' ', a.AR_Surname) AS auteur,
    p.PR_Name AS editeur,
    COALESCE(AVG(rg.RG_Value), 0) AS score,
    COUNT(DISTINCT rl.CT_Code) AS nombre_locations
  FROM SDL_BOOK b
  LEFT JOIN SDL_WRITE w ON b.BK_Code = w.BK_Code
  LEFT JOIN SDL_AUTHOR a ON w.AR_Code = a.AR_Code
  LEFT JOIN SDL_PUBLISH pb ON b.BK_Code = pb.BK_Code
  LEFT JOIN SDL_PUBLISHER p ON pb.PR_Code = p.PR_Code
  LEFT JOIN SDL_RATING rg ON b.BK_Code = rg.BK_Code
  LEFT JOIN SDL_RENTAL rl ON b.BK_Code = rl.BK_Code
  GROUP BY b.BK_Code
  ORDER BY nombre_locations DESC
  LIMIT 9

  prend tous ce qui est en rapport avec les livre et affiche les 9 livres les plus louée

  Dans affiche_livre.php : 
  SELECT
  SDL_BOOK.BK_Code AS id,
  SDL_BOOK.BK_Name AS titre,
  SDL_BOOK.BK_Description AS resume,
  SDL_BOOK.BK_Cost AS prix_location,
  SDL_BOOK.BK_Visual AS image,
  SDL_AUTHOR.AR_Firstname,
  SDL_AUTHOR.AR_Surname,
  SDL_PUBLISHER.PR_Name AS editeur,
  SDL_THEME.TH_Name AS theme,
  IFNULL(AVG(SDL_RATING.RG_Value), 0) AS score
FROM SDL_BOOK
JOIN SDL_TYPE ON SDL_BOOK.TE_Code = SDL_TYPE.TE_Code
JOIN SDL_WRITE ON SDL_BOOK.BK_Code = SDL_WRITE.BK_Code
JOIN SDL_AUTHOR ON SDL_WRITE.AR_Code = SDL_AUTHOR.AR_Code
JOIN SDL_PUBLISH ON SDL_BOOK.BK_Code = SDL_PUBLISH.BK_Code
JOIN SDL_PUBLISHER ON SDL_PUBLISH.PR_Code = SDL_PUBLISHER.PR_Code
JOIN SDL_COVER ON SDL_BOOK.BK_Code = SDL_COVER.BK_Code
JOIN SDL_THEME ON SDL_COVER.TH_Code = SDL_THEME.TH_Code
LEFT JOIN SDL_RATING ON SDL_BOOK.BK_Code = SDL_RATING.BK_Code
GROUP BY SDL_BOOK.BK_Code
ORDER BY SDL_BOOK.BK_Name ";

prend tout ce qui est en rapport avec les livres

Dans ajouter_location.php : 
INSERT INTO SDL_BILL (BL_Date) VALUES (NOW())
ajoute la date actuelle dans la table SDL_BILL

INSERT INTO SDL_RENTAL (BK_Code, CT_Code, BL_Code, RL_Start, RL_End) VALUES (?, ?, ?, ?, ?)
Insère la location avec l'ID de la facture

Dans creation_compte.php :
INSERT INTO SDL_CLIENT (CT_Firstname, CT_Surname, CT_Password, CT_Email) VALUES (?, ?, ?, ?)

Dans espace_personnel.php : 
SELECT CT_Code, CT_Firstname, CT_Surname FROM SDL_CLIENT WHERE CT_Email = ?

pour afficher les location en cours de l'utilisateur : 
SELECT B.BK_Name, B.BK_Visual, R.RL_Start, R.RL_End, B.BK_Cost, B.BK_Code
    FROM SDL_RENTAL R
    JOIN SDL_BOOK B ON R.BK_Code = B.BK_Code
    WHERE R.CT_Code = $ct_code
    AND R.RL_End > NOW()

  pour afficher les location passé de l'utilisateur :  
  SELECT B.BK_Name, B.BK_Visual, R.RL_Start, R.RL_End, B.BK_Cost
    FROM SDL_RENTAL R
    JOIN SDL_BOOK B ON R.BK_Code = B.BK_Code
    WHERE R.CT_Code = $ct_code
    AND R.RL_End <= NOW()

Dans login.php : 
SELECT * FROM SDL_CLIENT WHERE CT_Email = ? AND CT_Password = ?

Dans noter_livre.php :
INSERT INTO SDL_RATING (BK_Code, CT_Code, RG_Value) VALUES (?, ?, ?)

Dans resultat.php :
SELECT B.BK_Code AS id, B.BK_Name AS titre, B.BK_Description AS resume, B.BK_Visual AS image, B.BK_Cost AS prix_location,
               A.AR_Firstname, A.AR_Surname, PUB.PR_Name AS editeur,
               IFNULL(AVG(RG.RG_Value), 0) AS score
        FROM SDL_BOOK B
        LEFT JOIN SDL_WRITE W ON B.BK_Code = W.BK_Code
        LEFT JOIN SDL_AUTHOR A ON W.AR_Code = A.AR_Code
        LEFT JOIN SDL_PUBLISH P ON B.BK_Code = P.BK_Code
        LEFT JOIN SDL_PUBLISHER PUB ON P.PR_Code = PUB.PR_Code
        LEFT JOIN SDL_RATING RG ON B.BK_Code = RG.BK_Code
        WHERE B.BK_Name LIKE '%$chaine_safe%' OR B.BK_Description LIKE '%$chaine_safe%'
        GROUP BY B.BK_Code
        ORDER BY B.TE_Code ASC, B.BK_Cost ASC


- (La liste de l'ensemble des requêtes qui sont utilisées dans le code de votre projet avec leur explication et en indiquant où elles sont exploitées dans le projet)

## Développement web

- Tous les  blocs de contenu ont été dynamisés
- La partie de dynamisation la plus complexe a été celle de la page "epace_personnel" pour faire en sorte que les onglets s'ouvrent et se ferment normalement

## Hébergement

- https://webetu.iutnc.univ-lorraine.fr/~e50199u/sae203-seigneurdulivre (Webetu) ; 

https://sae203-seigneurdulivre.alwaysdata.net (alwaysdata)

- Changement des lien des pages pour naviguer d'une page à l'autre
