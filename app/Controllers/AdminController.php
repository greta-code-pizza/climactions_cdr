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
	
	public function createAdmin($lastname, $firstname, $mail, $city, $password) {
		
		$adminManager = new \Climactions\Models\AdminModel();
		$admin = $adminManager->creatAdmin($lastname, $firstname, $mail, $city, $password);
		
		require $this->viewAdmin('adminInscription');
	}


	public function sendMail()
	{

$mail = new PHPMailer(true);
		try{
			// configuration 
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
		  
			// on configure le SMTP 
			$mail->isSMTP();
			$mail->Host = 'localhost';
			$mail->Port = 1025; //port mailhog 
		  
			// charset 
			$mail->CharSet = 'utf-8';
		  
			// destinataires 
			$mail->addAddress("basket@site.fr");
			$mail->addCC("copie@site.fr");
			$mail->addBCC("copiecachee@site.fr");
		  
			// expéditeur 
			$mail->setFrom('no-reply@site.fr');
		  
			// contenu 
			$mail->isHTML();
			$mail->Subject = "Sujet du message";
			$mail->Body = "<p>New test: Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.
			Cras ultricies ligula sed magna dictum porta. <p>Donec sollicitudin molestie malesuada. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis </p>quis ac lectus.
			Curabitur aliquet quam id dui posuere blandit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. ";
			
			$mail->AltBody = "Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.
			Cras ultricies ligula sed magna dictum porta. Donec sollicitudin molestie malesuada. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.
			Curabitur aliquet quam id dui posuere blandit. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta.";
			// on envoie 
			$mail->send();
			echo "Message envoyé";
		  
		} 
		catch (Exception)
		{
			echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
		}


		require $this->viewAdmin('sendmail');

	}


	public function connexionAdmin() {
		require $this->viewAdmin('connexionAdmin');
	}

	public function connexion($mail,$password){
		$adminManager = new \Climactions\Models\AdminModel();
		$connexAdm = $adminManager->collectPassword($mail,$password);
		$result = $connexAdm->fetch();
		if(!empty($result)){
			$isPasswordCorrect = password_verify($password,$result['password']);

			$_SESSION['mail'] = $result['mail']; // transformation des variables recupérées en session
			$_SESSION['password'] = $result['password'];
			$_SESSION['id'] = $result['id'];
			$_SESSION['firstname'] = $result['firstname'];
			$_SESSION['lastname'] = $result['lastname'];

			if ($isPasswordCorrect) {

				require $this->viewAdmin('dashboard');
			}else{
				
        		echo 'Vos identifiants sont incorrects';
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