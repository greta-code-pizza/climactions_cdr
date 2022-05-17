<?php

namespace Climactions\Models;

class RessourcesModel extends Manager
{

    public function filtreFilm()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT * FROM document WHERE `type` LIKE "film_multimedia%"');
        $req->execute(array());
        return $req;
    }

    public function filtreLivre()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT * FROM document WHERE `type` LIKE "livre%"');
        $req->execute(array());
        return $req;
    }

    public function filtreJeu()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT * FROM document WHERE `type` LIKE "jeu%"');
        $req->execute(array());
        return $req;
    }

    public function filtreOutil()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT * FROM document WHERE `type` LIKE "expositions%"');
        $req->execute(array());
        return $req;
    }

    public function afficherRessources()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT * FROM document');
        $req->execute(array());
        return $req;
    }

    public function afficherDetails($idRessources)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT * FROM ressources WHERE id = ?');
        $req->execute(array($idRessources));
        return $req;
    }



    // compte le nombre d'articles 
    public function countArticles()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) AS nb_articles FROM ressources");
        $req->execute();
        $result = $req->fetch();
        $nbArticles = $result['nb_articles'];
        
        return $nbArticles;
    }


    // afficher les articles par page 
    public function perPageArticle($premierArticle, $parPage)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT * 
        FROM ressources
        ORDER BY id
        DESC LIMIT :premierarticle, :parpage");
        $req->bindValue(':premierarticle', $premierArticle, \PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, \PDO::PARAM_INT);
        $req->execute();
        $articles = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $articles;
    }

    // search an/several article 
    public function searchArticle($query)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT * FROM ressources 
        WHERE name LIKE :query 
        OR content LIKE :query
        ORDER BY id 
        DESC LIMIT 6");
        $req->execute([':query' => '%'.$query.'%']);
    
        $search = $req->fetchAll();
        return $search;
    }


    // afficher un article en fonction de l'id 
    public function afficherDetailArticle()
    {
        $bdd = $this->connect();
        $id = $_GET['id'];
        $req = $bdd->prepare("SELECT * FROM ressources WHERE id = ?");
        $req->execute([$id]);

        return $req->fetch();
    }


    public function lastArticles()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, `name`, `content` FROM `ressources` ORDER BY `id` DESC LIMIT 3");
        $req->execute(array());
        $articles = $req->fetchAll();
        return $articles;
    }

    public function selectType()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,type FROM type");
        $req->execute(array());
        $types = $req->fetchAll();
        return $types;
    }

    public function selectTheme()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM theme");
        $req->execute(array());
        $themes = $req->fetchAll();
        return $themes;
    }
    public function selectCondition()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,condition FROM condition");
        $req->execute(array());
        $conditions = $req->fetchAll();
        return $conditions;
    }
    public function selectLocation()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,location FROM location");
        $req->execute(array());
        $locations = $req->fetchAll();
        return $locations;
    }
    public function selectEditor()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM editor");
        $req->execute(array());
        $editors = $req->fetchAll();
        return $editors;
    }
    public function selectAuthor()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM author");
        $req->execute(array());
        $authors = $req->fetchAll();
        return $authors;
    }

    public function selectProductor()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM productor");
        $req->execute(array());
        $productors = $req->fetchAll();
        return $productors;
    }

    public function selectRealisator()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM realisator");
        $req->execute(array());
        $realisators = $req->fetchAll();
        return $realisators;
    }

    public function selectCreator()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM creator");
        $req->execute(array());
        $creators = $req->fetchAll();
        return $creators;
    }

    public function selectPublic()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM public");
        $req->execute(array());
        $publics = $req->fetchAll();
        return $publics;
    }

    public function insertBook($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$editor,$author,$public)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("INSERT INTO ressources (name,image,content,quantite,ademe,caution,catalogue,type_id,condition_id,theme_id,location_id,is_validated) 
        VALUES (:name,:image,:content,:quantite,:ademe,:caution,:catalogue,:type_id,:condition_id,:theme_id,:location_id,:is_validated)");
        $req2= $bdd->prepare("INSERT INTO livre (editor_id,author_id,public_id,ressource_id) 
        VALUES (:editor_id,:author_id,:public_id,:ressource_id)");
        $data1 = [
            ":name" => $name,
            ":image" => $image,
            ":content" => $content,
            ":quantite" => $quantite,
            ":ademe" => $ademe,
            ":caution" => $caution,
            ":catalogue" => $catalogue,
            ":type_id" => $type,
            ":condition_id" => $condition,
            ":theme_id" => $theme,
            ":location_id" => $location,
            ":is_validated" => $is_validated
        ];

        $data2 = [
            ":editor" => $editor,
            ":author" => $author,
            ":public_id" => $public,
            ":ressource_id" => $req1->lastInsertId()
        ];
  
        $req1->execute($data1);
        $req2->execute($data2);
    }

    public function selectBook(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT ressources.`name`,ressources.image,ressources.quantite,ressources.ademe,ressources.caution,ressources.catalogue,ressources.created_at,ressources.is_validated,
        `condition`.`condition`,location.location,editor.`name`,author.`name`,public.`name` 
        FROM ressources,theme,location,`condition`,livre,editor,author,public 
        WHERE ressources.id = livre.ressource_id 
        AND ressources.condition_id = `condition`.id 
        AND ressources.location_id = location.id 
        AND ressources.theme_id = theme.id 
        AND livre.editor_id = editor.id 
        AND livre.author_id = author.id 
        AND livre.public_id = public.id");
        $req->execute(array());
        $livre = $req->fetchAll();
        return $livre;
    }

    public function selectOneBook($idRessources){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT ressources.`name`,ressources.image,ressources.quantite,ressources.ademe,ressources.caution,ressources.catalogue,ressources.created_at,ressources.is_validated,
        `condition`.`condition`,location.location,editor.`name`,author.`name`,public.`name` 
        FROM ressources,theme,location,`condition`,livre,editor,author,public 
        WHERE ressources.id = ?
        AND ressources.id = livre.ressource_id 
        AND ressources.condition_id = `condition`.id 
        AND ressources.location_id = location.id 
        AND ressources.theme_id = theme.id 
        AND livre.editor_id = editor.id 
        AND livre.author_id = author.id 
        AND livre.public_id = public.id");
        $req->execute(array($idRessources));
        $livre = $req->fetch();
        return $livre;
    }

    public function updateBook($idRessources,$name,$image,$content,$quantite,$ademe,$caution,$catalogue,$condition,$theme,$location,$is_validated,$editor,$author,$public){
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE ressources,livre
        SET name = :name,image = :image,content = :content ,quantite = :quantite ,ademe = :ademe ,caution = :caution,catalogue = :catalogue, condition_id = :condition ,theme_id = :theme_id ,location_id = :location_id ,is_validated = :is_validated ,author_id = :author_id, editor_id = :editor_id ,public_id = :public_id 
        WHERE ressources.id = :ressources_id
        AND ressources.id = livre.ressource_id");

        $data = [
            ":name" => $name,
            ":image" => $image,
            ":content" => $content,
            ":quantite" => $quantite,
            ":ademe" => $ademe,
            ":caution" => $caution,
            ":catalogue" => $catalogue,
            ":condition_id" => $condition,
            ":theme_id" => $theme,
            ":location_id" => $location,
            ":is_validated" => $is_validated,
            ":editor" => $editor,
            ":author" => $author,
            ":public_id" => $public,
            ":ressources_id" => $idRessources
        ];

        $req->execute($data);
    }

    

    public function insertMovie($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$producer,$director,$public)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("INSERT INTO ressources (name,image,content,quantite,ademe,caution,catalogue,type_id,condition_id,theme_id,location_id,is_validated) 
        VALUES (:name,:image,:content,:quantite,:ademe,:caution,:catalogue,:type_id,:condition_id,:theme_id,:location_id,:is_validated)");
        $req2 = $bdd->prepare("INSERT INTO film (producer_id,director_id,public_id,ressources_id) 
        VALUES (:producer_id,:producer_id,_public_id,:ressources_id)");
        $data1 = [
            ":name" => $name,
            ":image" => $image,
            ":content" => $content,
            ":quantite" => $quantite,
            ":ademe" => $ademe,
            ":caution" => $caution,
            ":catalogue" => $catalogue,
            ":type_id" => $type,
            ":condition_id" => $condition,
            ":theme_id" => $theme,
            ":location_id" => $location,
            ":is_validated" => $is_validated
        ];

        $data2 = [
            ":producer_id" => $producer,
            ":director_id" => $director,
            ":public_id" => $public,
            ":ressources_id" => $req1->lastInsertId()
        ];
  
        $req1->execute($data1);
        $req2->execute($data2);
    }

    public function selectMovie(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT ressources.`name`,theme.`name`,ressources.image,ressources.quantite,ressources.ademe,ressources.caution,ressources.catalogue,ressources.created_at,ressources.is_validated,
        `condition`.`condition`,location.location,director.`name`,producer.`name`,public.`name` 
        FROM ressources,theme,location,`condition`,film,producer,director,public 
        WHERE ressources.id = film.ressources_id 
        AND condition_id = `condition`.id 
        AND ressources.location_id = location.id 
        AND ressources.theme_id = theme.id 
        AND film.producer_id = producer.id 
        AND film.director_id = director.id 
        AND film.public_id = public.id; ");
        $req->execute(array());
        $movie = $req->fetchAll();
        return $movie;
    }

    public function selectOneMovie($idRessources){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT ressources.`name`,theme.`name`,ressources.image,ressources.quantite,ressources.ademe,ressources.caution,ressources.catalogue,ressources.created_at,ressources.is_validated,
        `condition`.`condition`,location.location,director.`name`,producer.`name`,public.`name` 
        FROM ressources,theme,location,`condition`,film,producer,director,public 
        WHERE ressources.id = ?
        AND ressources.id = film.ressources_id 
        AND condition_id = `condition`.id 
        AND ressources.location_id = location.id 
        AND ressources.theme_id = theme.id 
        AND film.producer_id = producer.id 
        AND film.director_id = director.id 
        AND film.public_id = public.id; ");
        $req->execute(array($idRessources));
        $movie = $req->fetch();
        return $movie;
    }

    public function updateMovie($idRessources,$name,$image,$content,$quantite,$ademe,$caution,$catalogue,$condition,$theme,$location,$is_validated,$producer_id,$director_id,$public){
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE ressources,film
        SET name = :name,image = :image,content = :content ,quantite = :quantite ,ademe = :ademe ,caution = :caution,catalogue = :catalogue, condition_id = :condition ,theme_id = :theme_id ,location_id = :location_id ,is_validated = :is_validated ,producer_id = :producer_id, director_id = :director_id ,public_id = :public_id 
        WHERE ressources.id = :ressources_id
        AND ressources.id = film.ressource_id");

        $data = [
            ":name" => $name,
            ":image" => $image,
            ":content" => $content,
            ":quantite" => $quantite,
            ":ademe" => $ademe,
            ":caution" => $caution,
            ":catalogue" => $catalogue,
            ":condition_id" => $condition,
            ":theme_id" => $theme,
            ":location_id" => $location,
            ":is_validated" => $is_validated,
            ":producer_id" => $producer_id,
            ":director_id" => $director_id,
            ":public_id" => $public,
            ":ressources_id" => $idRessources
        ];

        $req->execute($data);
    }

    public function insertGames($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$format,$creator,$public)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("INSERT INTO ressources (name,image,content,quantite,ademe,caution,catalogue,type_id,condition_id,theme_id,location_id,is_validated) 
        VALUES (:name,:image,:content,:quantite,:ademe,:caution,:catalogue,:type_id,:condition_id,:theme_id,:location_id,:is_validated)");
        $req2 = $bdd->prepare("INSERT INTO games (format,creator_id,public_id,ressources_id) 
        VALUES (:format,:creator_id,:public_id,:ressources_id)");
        $data1 = [
            ":name" => $name,
            ":image" => $image,
            ":content" => $content,
            ":quantite" => $quantite,
            ":ademe" => $ademe,
            ":caution" => $caution,
            ":catalogue" => $catalogue,
            ":type_id" => $type,
            ":condition_id" => $condition,
            ":theme_id" => $theme,
            ":location_id" => $location,
            ":is_validated" => $is_validated
        ];

        $data2 = [
            ":format" => $format,
            ":creator_id" => $creator,
            ":public_id" => $public,
            ":ressources_id" => $req1->lastInsertId()
        ];
  
        $req1->execute($data1);
        $req2->execute($data2);
    }

    public function selectGames(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT ressources.`name`,theme.`name`,ressources.image,ressources.quantite,ressources.ademe,ressources.caution,ressources.catalogue,ressources.created_at,ressources.is_validated,
        `condition`.`condition`,location.location,creator.`name`,public.`name` 
        FROM ressources,theme,location,`condition`,games,public,creator 
        WHERE ressources.id = games.ressources_id 
        AND ressources.condition_id = `condition`.id 
        AND ressources.location_id = location.id 
        AND ressources.theme_id = theme.id 
        AND games.creator_id = creator.id 
        AND games.public_id = public.id; ");
        $req->execute(array());
        $game = $req->fetchAll();
        return $game;
    }

    public function selectOneGame($idRessources){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT ressources.`name`,theme.`name`,ressources.image,ressources.quantite,ressources.ademe,ressources.caution,ressources.catalogue,ressources.created_at,ressources.is_validated,
        `condition`.`condition`,location.location,creator.`name`,public.`name` 
        FROM ressources,theme,location,`condition`,games,public,creator 
        WHERE ressources.id = ?
        AND ressources.id = games.ressources_id 
        AND ressources.condition_id = `condition`.id 
        AND ressources.location_id = location.id 
        AND ressources.theme_id = theme.id 
        AND games.creator_id = creator.id 
        AND games.public_id = public.id; ");
        $req->execute(array($idRessources));
        $game = $req->fetch();
        return $game;
    }

    public function updateGame($idRessources,$name,$image,$content,$quantite,$ademe,$caution,$catalogue,$condition,$theme,$location,$is_validated,$creator_id,$format,$public){
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE ressources,film
        SET name = :name,image = :image,content = :content ,quantite = :quantite ,ademe = :ademe ,caution = :caution,catalogue = :catalogue, condition_id = :condition ,theme_id = :theme_id ,location_id = :location_id ,is_validated = :is_validated ,creator_id = :creator_id format = :format ,public_id = :public_id 
        WHERE ressources.id = :ressources_id
        AND ressources.id = games.ressource_id");

        $data = [
            ":name" => $name,
            ":image" => $image,
            ":content" => $content,
            ":quantite" => $quantite,
            ":ademe" => $ademe,
            ":caution" => $caution,
            ":catalogue" => $catalogue,
            ":condition_id" => $condition,
            ":theme_id" => $theme,
            ":location_id" => $location,
            ":is_validated" => $is_validated,
            ":creator_id" => $creator_id,
            ":format" => $format,
            ":public_id" => $public,
            ":ressources_id" => $idRessources
        ];

        $req->execute($data);
    }

    public function insertFlyers($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$format)
    {
        $bdd = $this->connect();
        $req1 = $bdd->prepare("INSERT INTO ressources (name,image,content,quantite,ademe,caution,catalogue,type_id,condition_id,theme_id,location_id,is_validated) 
        VALUES (:name,:image,:content,:quantite,:ademe,:caution,:catalogue,:type_id,:condition_id,:theme_id,:location_id,:is_validated)");
        $req2 = $bdd->prepare("INSERT INTO flyers (format,ressources_id) 
        VALUES (:format,:ressources_id)");
        $data1 = [
            ":name" => $name,
            ":image" => $image,
            ":content" => $content,
            ":quantite" => $quantite,
            ":ademe" => $ademe,
            ":caution" => $caution,
            ":catalogue" => $catalogue,
            ":type_id" => $type,
            ":condition_id" => $condition,
            ":theme_id" => $theme,
            ":location_id" => $location,
            ":is_validated" => $is_validated
        ];

        $data2 = [
            ":format" => $format,
            ":ressources_id" => $req1->lastInsertId()
        ];
  
        $req1->execute($data1);
        $req2->execute($data2);
    }

    public function selectFlyer(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT ressources.`name`,theme.`name`,ressources.image,ressources.quantite,ressources.ademe,ressources.caution,ressources.catalogue,ressources.created_at,ressources.is_validated,
        `condition`.`condition`,location.location,flyers.`format` 
        FROM ressources,theme,location,`condition`,flyers 
        WHERE ressources.id = flyers.ressources_id 
        AND condition_id = `condition`.id 
        AND ressources.location_id = location.id 
        AND ressources.theme_id = theme.id;");
        $req->execute(array());
        $movie = $req->fetchAll();
        return $movie;
    }

    public function selectOneFlyer($idRessources){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT ressources.`name`,theme.`name`,ressources.image,ressources.quantite,ressources.ademe,ressources.caution,ressources.catalogue,ressources.created_at,ressources.is_validated,
        `condition`.`condition`,location.location,flyers.`format` 
        FROM ressources,theme,location,`condition`,flyers 
        WHERE ressources.id = ?
        AND ressources.id = flyers.ressources_id 
        AND condition_id = `condition`.id 
        AND ressources.location_id = location.id 
        AND ressources.theme_id = theme.id;");
        $req->execute(array($idRessources));
        $movie = $req->fetch();
        return $movie;
    }

    public function updateFlyer($idRessources,$name,$image,$content,$quantite,$ademe,$caution,$catalogue,$condition,$theme,$location,$is_validated,$format,$public){
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE ressources,film
        SET name = :name,image = :image,content = :content ,quantite = :quantite ,ademe = :ademe ,caution = :caution,catalogue = :catalogue, condition_id = :condition ,theme_id = :theme_id ,location_id = :location_id ,is_validated = :is_validated ,format = :format ,public_id = :public_id 
        WHERE ressources.id = :ressources_id
        AND ressources.id = flyers.ressource_id");

        $data = [
            ":name" => $name,
            ":image" => $image,
            ":content" => $content,
            ":quantite" => $quantite,
            ":ademe" => $ademe,
            ":caution" => $caution,
            ":catalogue" => $catalogue,
            ":condition_id" => $condition,
            ":theme_id" => $theme,
            ":location_id" => $location,
            ":is_validated" => $is_validated,
            ":format" => $format,
            ":public_id" => $public,
            ":ressources_id" => $idRessources
        ];

        $req->execute($data);
    }

    public function deleteRessource($idRessources){
        $bdd = $this->connect();
        $req = $bdd->prepare("DELETE FROM ressources WHERE ressources.id = ?");
        $delete = $req->execute(array($idRessources));
    }
}

