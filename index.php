<?php


session_start();

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// function errorHandler($errno, $errstr) {
//   throw new Exception($errno, $errstr);
// }

// set_error_handler('errorHandler');

function eCatcher($e)
{
  if ($_ENV["APP_ENV"] == "dev") {
    $whoops = new \Whoops\Run;
    $whoops->allowQuit(false);
    $whoops->writeToOutput(false);
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $html = $whoops->handleException($e);

    require 'app/Views/errors/error.php';
  }
}
try {
  $controllerFront = new \Climactions\Controllers\FrontController();


  if (isset($_GET['action']) && !empty($_GET['action'])) {

    // afficher page home
    if($_GET['action'] == 'home'){
      $controllerFront->home();
    }


    // afficher page des articles 
    elseif ($_GET['action'] == 'pageArticle') {
      $query = $_POST['query'] ?? "";
      if (isset($_GET['page']) && !empty($_GET['page'])) {

        $currentPage = (int) strip_tags($_GET['page']);
      } else {
        $currentPage = 1;
      }
      $controllerFront->pageArticle($query, $currentPage);
    }


    // afficher un article 
    elseif ($_GET['action'] == 'article') {
      $controllerFront->article($_GET['id']);
    }

    
    // afficher page contact 
    elseif($_GET['action'] == 'contact'){
      $controllerFront->contact();
  }
    
    // envoi mail en BDD 
    elseif($_GET['action'] == 'contactPost'){
      $lastname = htmlspecialchars($_POST['lastname']);
      $firstname = htmlspecialchars($_POST['firstname']);
      $email = htmlspecialchars($_POST['email']);
      $phone = htmlspecialchars($_POST['phone']);
      $object = htmlspecialchars($_POST['object']);
      $message = htmlspecialchars($_POST['message']);

      if (!empty($lastname) && (!empty($firstname) && (!empty($email) && (!empty($phone) && (!empty($object) && (!empty($message))))))) {
      $controllerFront->contactPost($lastname, $firstname, $email, $phone, $object, $message);
    } else {
      throw new Exception('Tous les champs ne sont pas remplis!!');
    }
  }
 
  
        
} else{
  $controllerFront->home();
}


} catch (Exception $e) {
  eCatcher($e);
  if ($e->getCode === 404) {
    die('Erreur : ' . $e->getMessage());
  } else {
    header("app/Views/errors/error.php");

  }
} catch (Error $e) {
  eCatcher($e);
  header("location: app/Views/errors/error.php");
}
