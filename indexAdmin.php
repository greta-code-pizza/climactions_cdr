<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'app/Views/admin/layouts/secure.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Create an instance; passing `true` enables exceptions

// function errorHandler($errno, $errstr) {
  //   throw new Exception($errno, $errstr);
  // }

// set_error_handler('errorHandler');

function eCatcher($e) {
  if($_ENV["APP_ENV"] == "") {
    $whoops = new \Whoops\Run;
    $whoops->allowQuit(false);
    $whoops->writeToOutput(false);
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $html = $whoops->handleException($e);
    
    require 'app/Views/errors/error.php';
  }
}

try {

    $backController = new \Climactions\Controllers\AdminController();
    
    
    if (isset($_GET['action'])) {
        
        if($_GET['action'] == 'pageCreationAdmin') {
        isConnect();
        $backController->pageConnexionAdmin();
    
        }

        // create an admin 
        elseif($_GET['action'] == 'creatAdmin') {
            isConnect();
            $lastname   = htmlspecialchars($_POST['lastname']);
            $firstname  = htmlspecialchars($_POST['firstname']);
            $email       = htmlspecialchars($_POST['email']);
            $pass   = htmlspecialchars($_POST['password']);

            $password   = password_hash($pass, PASSWORD_DEFAULT);

            $backController->createAdmin($lastname, $firstname, $email, $password);
        }


        elseif($_GET['action'] == 'home') {
          // isConnect();
          $email = htmlspecialchars($_POST['email']);
          $password = htmlspecialchars($_POST['password']);
          if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
            $backController->connexion($email, $password); // on passe deux paramètre
          } else {
              throw new Exception('renseigner vos identifiants');
          }
        }

        // logout admin 
          elseif($_GET['action'] == 'deconnexion'){
            isConnect();
          $backController->deconnexion();
      }
        
        
        // go to page forgot_password
        elseif($_GET['action'] == 'forgot_password'){
         
          $backController->forgot_password();
        }

        // send mail to receive new password 
        elseif($_GET['action'] == 'emailPost'){
          $backController->changePassword();
        }

        // go to page create new password 
        elseif($_GET['action'] == 'pageNewPassword'){
          isConnect();
          $backController->pageNewPassword();
          }
          

        // confirm new password 
        elseif($_GET['action'] == 'newPasswordPost'){
          isConnect();
          if(isset($_SESSION['id']) && isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['passwordConfirm'])){

            $id = $_GET['id'];
            $oldPassword = htmlspecialchars($_POST['oldPassword']);
            $newPassword = htmlspecialchars($_POST['newPassword']);
            $passwordConfirm = htmlspecialchars($_POST['passwordConfirm']);
            
            $erreur = $backController->createNewPassword($id, $oldPassword, $newPassword);

        }}


        
        elseif ($_GET['action'] == 'pageAddArticle') {
          isConnect();
          $backController->pageAddArticle();
        } 
        
        elseif ($_GET['action'] == 'viewUpdateArticle') {
          isConnect();
          $idArticle = $_GET['id'];
          $backController->viewUpdateArticle($idArticle);
        } 
        
        elseif ($_GET['action'] == 'deleteArticle') {
          isConnect();
          $id = $_GET['id'];
          $backController->deleteArticle($id);
        } 
        
        elseif ($_GET['action'] == 'addArticle') {
          isConnect();
          $title = htmlspecialchars($_POST['title']);
          $content = htmlspecialchars($_POST['content']);
          $backController->addArticle($title, $content);
          
        } elseif ($_GET['action'] == 'updateArticle') {
          isConnect();
          $idArticle = $_GET['id'];    
          $title = htmlspecialchars($_POST['title']);
          $content = htmlspecialchars($_POST['content']);
          $backController->updateArticle($idArticle, $title, $content);
          
        }
        
        // go to page home admin 
        // les pages de l'administration
        elseif($_GET['action'] == 'homeAdmin'){
          isConnect();
          $backController->homeAdmin();
        }
        elseif($_GET['action'] == 'emailAdmin'){
          isConnect();
          $backController->emailAdmin();
        }
        elseif($_GET['action'] == 'accountAdmin'){
          isConnect();
          $backController->accountAdmin();
        }

        elseif($_GET['action'] == 'resourceAdmin'){
          isConnect();
          $backController->resourceAdmin();
        }
        elseif($_GET['action'] == 'addressBookAdmin'){
          isConnect();
          $backController->addressBookAdmin();
        }
        elseif($_GET['action'] == 'opinionAdmin'){
          isConnect();
          $backController->opinionAdmin();
        }

        // les méthodes de la page Resource.php (CRUD)
        elseif($_GET['action'] == 'createResource'){
          isConnect();
          $backController->createResource();
        }
        elseif($_GET['action'] == 'updateResource'){
          isConnect();
          $backController->updateResource();
        }
        elseif($_GET['action'] == 'deleteResource'){
          isConnect();
          $backController->deleteResource();
        }
        // les méthodes de la page email.php
        elseif($_GET['action'] == 'readEmail'){
          isConnect();
          $backController->readEmail();
        }
        elseif($_GET['action'] == 'deleteEmail'){
          isConnect();
          $backController->deleteEmail();
        }

        else{
          require "app/Views/errors/pageNotFound.php";
          // throw new Exception("La page demandée n'existe pas", 404);
        }
       
        

  }else{
   $backController->connexionAdmin();

 }
        
} catch (Exception $e) {
  eCatcher($e);
  if($e->getCode() === 404) {
    die('Erreur : ' .$e->getMessage());
  } else {
    require "app/Views/errors/notAdmin.php";
  } 
  
} catch (Error $e) {
  eCatcher($e);
  require "app/Views/errors/notAdmin.php";
}
