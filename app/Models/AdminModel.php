<?php

namespace Climactions\Models;

class AdminModel extends Manager
{

    public function creatAdmin($lastname, $firstname, $email, $password)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare('INSERT INTO admin (lastname, firstname, email,  password) VALUE (:lastname, :firstname, :email, :password)');
        $req->execute([
            "lastname" => htmlspecialchars($lastname), 
            "firstname" => htmlspecialchars($firstname), 
            "email" => htmlspecialchars($email), 
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return $req;
    }

    // if email exist 
    public function exist_email($email)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) FROM admin WHERE email = ?");
        $req->execute([$email]);

        $result = $req->fetch()[0];
        return $result;
    }
    
    // if firstname exist 
    public function exist_firstname($firstname)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) FROM admin WHERE firstname = ?");
        $req->execute([$firstname]);

        $result = $req->fetch()[0];
        return $result;
    }



    public function collectPassword($email, $password)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('SELECT email,password,lastname,firstname,id FROM admin WHERE email=?');
        $req->execute(array($email));

        return $req;
    }

    // change password sent by email
    public function getNewPassword($hashedPassword)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE admin SET password = ? WHERE email = ?");
        $req->execute([$hashedPassword, $_POST['email']]);
        
    }

    // retrieve password 
    public function newPasswordAdmin($id)
    {
        $bdd =  $this->connect();
        $req = $bdd->prepare("SELECT id, password FROM admin WHERE id =?");
        $req->execute(array($id));

        return $req;
    }

    // create new personalized password 
    public function createNewPassword($id, $newPass)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("UPDATE admin SET password = ? WHERE id = ?");
        $req->execute(array($newPass, $id));

        return $req;
    }


    // ------------------------------------------------------------------------------------------------------------------

    // display list admin 
    public function listAdmin()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id, `firstname`, `email`, `role` FROM admin");
        $req->execute(array());
        return $req;
    }

    // disply one admin 
    public function getOneAdmin($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT id, firstname, lastname, email, role FROM admin WHERE id = ?");
        $req->execute(array($id));
        return $req->fetch();
    }

    // delete one admin 
    public function deleteOneAdmin($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("DELETE FROM `admin` WHERE id = ? AND `role` = 'Administrateur'");
        $req->execute(array($id));
    }

    // afficher les articles

    public function getArticles()
    {
        $bdd = $this->connect();
        $req = $bdd->query("SELECT id, title, content FROM article ORDER BY id DESC");
        $article = $req->fetchAll();
        return $article;
    }
    // afficher un article
    
    public function getArticle($idArticle)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT * FROM article WHERE id = ?");
        $req->execute(array($idArticle));
        return $req->fetch();
    }

    //   créer un article

    public function addArticle($title, $content)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('INSERT INTO article (title, content) VALUE (?, ?)');
        $req->execute(array($title, $content));
        header('Location: indexAdmin.php?action=pageAddArticle');
    }
    // mettre à jour un article

    public function updateArticle($idArticle, $title, $content)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('UPDATE `article` SET title = :title , content = :content WHERE id = :id');
        $req->execute([
            'id' => $idArticle,
            'title' => $title,
            'content' => $content
        ]);
        return $req;
        // header('Location: indexAdmin.php?action=pageAddArticle');

    }

    // supprimer un article

    public function deleteArticle($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('DELETE FROM article WHERE id = ?');
        $req->execute(array($id));
    }

    /* ----------------------------------------------------------------------*/

    // gestion des emails (page email.php)

    // afficher tous les emails

    public function emailPage($firstEmail, $perPage)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, `lastname`, `firstname`, `email`, `object`, `message`, DATE_FORMAT(created_at, '%d/%m/%Y') AS `date`,`read`
                              FROM `email` 
                              ORDER BY `created_at` ASC LIMIT :firstemail, :perpage");
                              $req->bindValue(':firstemail', $firstEmail, \PDO::PARAM_INT);
                              $req->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
        $req->execute();
        $emails = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $emails;
    }

    // count all email 

    public function countEmail()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) AS nb_email FROM contact");
        $req->execute();
        $result = $req->fetch();
        $nbEmail = $result['nb_email'];
        return $nbEmail;
    }

    public function searchEmail($query)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT id, lastname, firstname, message, DATE_FORMAT(created_at, '%d/%m/%Y') AS `date`,`read` 
                                FROM email 
                                WHERE lastname LIKE :query 
                                OR firstname LIKE :query
                                ORDER BY id 
                                DESC LIMIT 6");
        // var_dump($req); die;
        $req->execute([':query' => '%'.$query.'%']);
    
        $searchEmail = $req->fetchAll();
        return $searchEmail;
    }

    // public function readValidate($id)
    // {
    //     $bdd = $this->connect();

    //     $req = $bdd->prepare()
    // }

    /* ----------------------------------------------------------------------*/

    // gestion des ressources (page resource.php)

    // afficher toutes les ressources

    public function resourcePage($firstResource, $perPage)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, `name`, `image`, `content`, DATE_FORMAT(created_at, '%d/%m/%Y') AS `date` 
                              FROM `resource` 
                              ORDER BY `created_at` ASC LIMIT :firstresource, :perpage");
                              $req->bindValue(':firstresource', $firstResource, \PDO::PARAM_INT);
                              $req->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
        $req->execute();
        $resources = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $resources;
    }

    // ----------------------------------------
    
    public function searchResource($query)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare("SELECT id, name, image, content ,DATE_FORMAT(created_at, '%d/%m/%Y') AS `date` 
                                FROM resource 
                                WHERE name LIKE :query 
                                OR content LIKE :query
                                ORDER BY id 
                                DESC LIMIT 6");
        $req->execute([':query' => '%'.$query.'%']);
    
        $searchResource = $req->fetchAll();
        return $searchResource;
    }
    
    // compter les ressources
    
    public function countResource()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT COUNT(id) AS nb_resources FROM resource");
        $req->execute();
        $result = $req->fetch();
        $nbResource = $result['nb_resources'];
        return $nbResource;
    }
    
    // ----------------------------------------
    
    // supprimer un email
    
    public function deleteEmail($id){
        $bdd = $this->connect();
        $req = $bdd->prepare('DELETE FROM `email` 
                              WHERE id = ?');
        $req->execute(array($id));
    }

    // lire un email

    public function readEmail($id){
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, `lastname`, `firstname`, `email`, `object`, `message`, DATE_FORMAT(created_at, '%d/%m/%Y') AS `date` 
                             FROM `email`
                              WHERE id = ?");
        $req->execute(array($id));
        $email = $req->fetch();
        return $email;
    }

    /* ----------------------------------------------------------------------*/

    // gestion des infos (page addressBook.php)

    public function infos()
    {
        $bdd = $this->connect();
        $req = $bdd->prepare("SELECT `id`, `lastname`, `firstname`, `email`
                              FROM `contact`");
        $req->execute(array());
        $infos = $req->fetchAll();
        return $infos;
    }

    public function deleteInfo($id)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('DELETE FROM `contact` 
                              WHERE id = ?');
        $req->execute(array($id));
    } 
    
}
