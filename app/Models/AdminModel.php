<?php

namespace Climactions\Models;

class AdminModel extends Manager
{

    public function creatAdmin($lastname, $firstname, $email, $password)
    {
        $bdd = $this->connect();

        $req = $bdd->prepare('INSERT INTO admin (lastname, firstname, email,  password) VALUE (?, ?, ?, ?)');
        $req->execute(array($lastname, $firstname, $email, $password));

        return $req;
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
        $req = $bdd->prepare('UPDATE article SET title = :title , content = :content WHERE id = :id');
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
}
