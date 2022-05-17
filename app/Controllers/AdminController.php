<?php

namespace Climactions\Controllers;

use GuzzleHttp\Psr7\Header;
use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;

require_once "vendor/phpmailer/phpmailer/src/Exception.php";
require_once "vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "vendor/phpmailer/phpmailer/src/SMTP.php";


class AdminController extends Controller {
	
	public function pageConnexionAdmin() {
		
		require $this->viewAdmin('adminInscription');
	}
	
	public function createAdmin($lastname, $firstname, $email, $password) {
		
		$adminManager = new \Climactions\Models\AdminModel();
		$admin = $adminManager->creatAdmin($lastname, $firstname, $email, $password);
		
		require $this->viewAdmin('adminInscription');
	}

	// affichage des pages de l'administration

	public function accountAdmin()
	{
		require $this->viewAdmin('account');
	}
	public function homeAdmin()
	{
		require $this->viewAdmin('home');
	}
	public function emailAdmin()
	{
		require $this->viewAdmin('email');
	}
	public function resourceAdmin()
	{
		require $this->viewAdmin('resource');
	}
	public function opinionAdmin()
	{
		require $this->viewAdmin('opinions');
	}
	public function addressBookAdmin()
	{
		require $this->viewAdmin('addressBook');
	}

	// les méthodes de la page Resource.php (CRUD)

	public function createResource()
	{
		require $this->viewAdmin('formResource');
	}
	public function updateResource()
	{
		require $this->viewAdmin('updateResource');
	}
	public function deleteResource()
	{
		require $this->viewAdmin('delete');
	}

	// les méthodes de la page Email.php

	public function readEmail()
	{
		require $this->viewAdmin('readEmail');
	}
	public function deleteEmail()
	{
		require $this->viewAdmin('delete');
	}
	

	public function connexionAdmin() {
		require $this->viewAdmin('connexionAdmin');
	}

	public function connexion($email,$password){
		$adminManager = new \Climactions\Models\AdminModel();
		$connexAdm = $adminManager->collectPassword($email,$password);
		$result = $connexAdm->fetch();
		if(!empty($result)){
			$isPasswordCorrect = password_verify($password,$result['password']);

			$_SESSION['email'] = $result['email']; // transformation des variables recupérées en session
			$_SESSION['password'] = $result['password'];
			$_SESSION['id'] = $result['id'];
			$_SESSION['firstname'] = $result['firstname'];
			$_SESSION['lastname'] = $result['lastname'];
			
			if ($isPasswordCorrect) {

				require $this->viewAdmin('home');
			}else{
				
        		echo 'Vos identifiants sont incorrects';
			}
		} else{
			echo "il ya une erreur";
		}
	}

	// logout admin 
	public function deconnexion()
	{
		unset($_SESSION['id']);
        session_destroy();
        header('Location: indexAdmin.php');
	}


	// go to page forgot_password 
	public function forgot_password()
	{
		require $this->viewAdmin('forgot_password');
	}

	// change password 
	public function changePassword()
	{
		$adminManager = new \Climactions\Models\AdminModel();
		$adminController = new \Climactions\Controllers\AdminController();
		if(isset($_POST['email']))
		{
			$mail = new PHPMailer(true);
		try{
			// configuration pour voir les bugs
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
		  
			// on configure le SMTP 
			$mail->isSMTP();
			$mail->Host = 'localhost';
			$mail->Port = 1025; //port mailhog 
		  
			// charset 
			$mail->CharSet = 'utf-8';
		  
			// destinataires 
			$mail->addAddress($_POST['email']);
			
		  
			// expéditeur 
			$mail->setFrom('no-reply@site.fr');
		  
			// contenu 
			$mail->isHTML();
			$mail->Subject = "Nouveau mot de passe";
			$password = uniqid();
			$mail->Body = "Bonjour ".$_POST['email']. "Votre nouveau mot de passe: ".$password;
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$changePassword = $adminManager->getNewPassword($hashedPassword);
			
	
			// on envoie 
			$mail->send();
			echo "Message envoyé";
			
		  
		} 
		catch (Exception)
		{
			echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
		}
		}

		header('Location: indexAdmin.php');
	}

	// page create new password 
	public function pageNewPassword()
	{
		require $this->viewAdmin('pageNewPassword');
	}

	// confirm new passsword 
	public function createNewPassword($id, $oldPassword, $newPassword)
	{

		extract($_POST);
		$validation = true;
		$erreur = [];

		if(empty($oldPassword) || empty($newPassword) || empty($passwordConfirm)){
			$validation = false;
			$erreur[] = "Tous les champs sont requis!";
		}

		if ($newPassword){
			$adminManager = new \Climactions\Models\AdminModel();
			$getPassword = $adminManager->newPasswordAdmin($id);

			$verifPassword = $getPassword->fetch();
			$isPasswordCorrect = password_verify($oldPassword, $verifPassword['password']);

			if(!$isPasswordCorrect){
				$validation = false;
				$erreur[] = "le mot de passe actuel est erroné";
			}

			if ($newPassword != $passwordConfirm){
				$validation = false;
				$erreur[] = 'Vos mots de passe ne sont pas identiques';
			}
			
			if($isPasswordCorrect && $newPassword === $passwordConfirm){
				$newPass = password_hash($newPassword, PASSWORD_DEFAULT);
				$changePassword = $adminManager->createNewPassword($id, $newPass);

				require $this->viewAdmin('account');
			} else{
				require $this->viewAdmin('pageNewPassword');
				return $erreur;
			}
		}
	}

	public function pageAddArticle()
	{
		$articles = new \Climactions\Models\AdminModel();
		$allArticles = $articles->getArticles();
		require $this->viewAdmin('pageAddArticle');
	}
	public function viewUpdateArticle($idArticle)
	{
		$article = new \Climactions\Models\AdminModel();
		$oneArticle = $article->getArticle($idArticle);
		require $this->viewAdmin('updateArticle');
	}

	// public function addArticle($title, $content)
	// {
	// 	$adminManager = new \Climactions\Models\AdminModel();
	// 	$admin = $adminManager->addArticle($title, $content);
	// 	require $this->viewAdmin('pageAddArticle');

	// }

	public function addArticle() {
		$article = new \Climactions\Models\RessourcesModel();
		$type = $article->selectType();
		$condition = $article->selectCondition();
		$theme = $article->selectTheme();
		$location = $article->selectLocation();
		$public = $article->selectPublic();
		$editor = $article->selectEditor();
		$auhtor = $article->selectAuthor();
		$productor = $article->selectProductor();
		$realisator = $article->selectRealisator();
		$creator = $article->selectCreator();
		require $this->viewAdmin('addArticle');
	}

	public function addGames($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$format,$creator,$public){
		$ressources = new \Climactions\Models\RessourcesModel();
		$game = $ressources->insertGames($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$format,$creator,$public);
		header('Location: app/Views/admin/resource.php');
	}

	public function addBook($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$editor,$author,$public){
		$ressources = new \Climactions\Models\RessourcesModel();
		$book = $ressources->insertGames($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$editor,$author,$public);
		header('Location: app/Views/admin/resource.php');
	}

	public function addMovie($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$productor,$realisator,$public){
		$ressources = new \Climactions\Models\RessourcesModel();
		$movie = $ressources->insertGames($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$productor,$realisator,$public);
		header('Location: app/Views/admin/resource.php');
	}

	public function addFlyers($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$format){
		$ressources = new \Climactions\Models\RessourcesModel();
		$flyers = $ressources->insertFlyers($name,$image,$content,$quantite,$ademe,$caution,$catalogue,$type,$condition,$theme,$location,$is_validated,$format);
		header('Location: app/Views/admin/resource.php');
	}

	public function deleteArticle($id) {
		$article = new \Climactions\Models\AdminModel();
		$deleteArticle = $article->deleteArticle($id);

		header('Location: indexAdmin.php?action=pageAddArticle');


	}
	public function updateArticle($idArticle, $title, $content)
	{
		$article = new \Climactions\Models\AdminModel();
		$updateArticle = $article->updateArticle($idArticle, $title, $content);
		
		header('Location: indexAdmin.php?action=pageAddArticle');
	}

	
}