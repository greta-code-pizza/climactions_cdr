<?php

namespace Climactions\Models;

class RessourcesModel extends Manager
{

    public function afficherDetails($idRessources)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT * FROM ressources WHERE id = ?');
        $req->execute(array($idRessources));
        return $req;
    }


    // search an/several article 
    public function searchArticle($query)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.id,resource.name AS resource,image,content,type_id,`type`.name AS type,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date` FROM resource,`type`  
        WHERE resource.name LIKE :query 
        OR content LIKE :query
        AND resource.type_id = `type`.id
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
        $req = $bdd->prepare("SELECT * FROM resource WHERE id = ?");
        $req->execute([$id]);

        return $req->fetch();
    }


    public function lastArticles()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, type_id, `name`, `image` FROM `resource` ORDER BY `id` DESC LIMIT 3");
        $req->execute(array());
        $articles = $req->fetchAll();
        return $articles;
    }

    public function selectType()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,`name` FROM type");
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
        $req = $bdd->prepare("SELECT id,name FROM condition");
        $req->execute(array());
        $conditions = $req->fetchAll();
        return $conditions;
    }
    

    public function selectPublic()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id,name FROM public");
        $req->execute(array());
        $publics = $req->fetchAll();
        return $publics;
    }

    public function selectResources(){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT resource.id,resource.name,image,content,type_id,`type`.name AS type,DATE_FORMAT(created_at, '%d/%m/%Y') AS `date` FROM resource INNER JOIN `type` 
        ON resource.type_id = `type`.id
        ORDER BY resource.id DESC" );
        $req->execute(array());
        $articles = $req->fetchAll();
        // var_dump($articles);die;
        return $articles;
    }

    public function selectResourceMovieBook($idResource){
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.name,theme.`name` AS theme,`condition`.name AS `condition`,public.name AS public,`type`.`name` AS `type`,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date` 
        FROM resource,`type`,admin,`condition`,public,theme 
        WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id;");

        $req2 = $bdd->prepare("SELECT staff.name AS staff,role.name AS role
        FROM staff,role,resource
        WHERE resource.id = 
        AND resource.id = staff.resource_id
        AND staff.role_id = role.id;");

        $req->execute(array($idResource));
        $req2->execute(array($idResource));
        $movieBook = $req->fetch();
        $staff = $req2->fetchAll();

        return $movieBook;
        return $staff;
    }

    public function selectResourceGame($idResource){
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.name,theme.`name` AS theme,`condition`.name AS `condition`,public.name AS public,`type`.`name` AS `type`,game_format.name AS game_format,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date`
        FROM resource,`type`,admin,`condition`,public,theme,game,game_format
        WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id
        AND game.id_resource = resource.id
        AND game.id_format = game_format.id;");

        $req2 = $bdd->prepare("SELECT staff.name AS staff,role.name AS role
        FROM staff,role,resource
        WHERE resource.id = ?
        AND resource.id = staff.resource_id
        AND staff.role_id = role.id;");

        $req->execute(array($idResource));
        $req2->execute(array($idResource));
        $game = $req->fetch();
        $staff = $req2->fetchAll();

        return $game;
        return $staff;
    }

    public function selectResourceExpo($idResource){
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT resource.name,theme.`name` AS theme,`condition`.name AS `condition`,`type`.`name` AS `type`,public.name AS public,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date`,poster_bool,sign_bool
        FROM resource,`type`,admin,`condition`,theme,exposure
        WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id
        AND exposure.resource_id = resource.id;");

        $req->execute(array($idResource));
        $expo = $req->fetch();

        return $expo;
    }

    

    public function insertResource($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$format)
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

    public function selectOneFlyer($idRessources){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT resource.name,theme.`name` AS theme,`condition`.name AS `condition`,`type`.`name` AS `type`,firstname,lastname,image,content,deposit,quantity,DATE_FORMAT(modified_at, '%d/%m/%Y') AS `date` 
        FROM resource,`type`,admin,`condition`,public,theme 
        WHERE resource.id = ?
        AND resource.type_id = `type`.id
        AND resource.theme_id = theme.id
        AND resource.public_id = public.id
        AND resource.condition_id = `condition`.id
        AND resource.admin_id = admin.id;");
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
        $req = $bdd->prepare("DELETE FROM resource WHERE resource.id = ?");
        $delete = $req->execute(array($idRessources));
    }
}

