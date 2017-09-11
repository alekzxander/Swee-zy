<?php

require_once('config/config.php');
// Inscription on MailChimp platform

require_once('librairies/Mailchimp.php');
use \DrewM\MailChimp\MailChimp;

$mailChimp=new Mailchimp(MAILCHIMPAPIKEY);
$list_id = MAILCHIMPLISTID;
$email = isset($_POST['email']) ? $_POST['email'] : "";
if(!empty($email)) {
	$subscriber_hash = $mailChimp->subscriberHash($email);

	$result = $mailChimp->put("lists/$list_id/members/$subscriber_hash", [
					'email_address' => $email,
					'status'        => 'subscribed'
				]);
}
if ($mailChimp->success()) {
	echo "true";
} else {
	echo $mailChimp->getLastError();
}

/* Inscription in Database */
/*
$email = isset($_POST['email']) ? $_POST['email'] : "";
if(!empty($email)) {
	//object if we had some additional parameters (firstname,lastname...)
	$user = new stdClass();
	$user->email = $email;
	// Connexion Database
	try{
		$pdo = new PDO("mysql:host=". DB_HOST.";dbname=".DB_NAME,DB_LOGIN,DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
	}catch(PDOException $e){
		echo "Une erreur est survenue. Contactez le support client";
		return;
	}
	// Test if 	email already exist
	$sql = "SELECT * FROM newsletter WHERE email = :email";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':email' => $user->email));
	$userExist = $stmt->fetch();
	if(!$userExist) {
		try {
			$sql = "INSERT INTO newsletter(email,opt_in) VALUES (:email,:opt_in)";
			$pdo->prepare($sql)->execute(array(
				"email" => $user->email,
				"opt_in" => true));
				echo "true";
			} catch (Exception $e) {
				echo "Une erreur est survenue. Contactez le support client";
			}
	}
	else {
		echo "Vous êtes déjà inscrit à notre newsletter";
	}
}
*/
?>