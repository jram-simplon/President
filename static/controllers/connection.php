<?php

// connection to the database

 include '../database/connection.php';

// connection test 

// $sql = 'select * from users';
// $query = $db->query($sql);
// $users = $query-> fetchAll();

// foreach ($users as $user) {

// 	echo $user['surname'].'<br>';
// 
// }
$alias       = htmlspecialchars(preg_replace('/ /', '',$_POST['alias']));


 if    ( empty($_POST['mail']) OR empty($_POST['pwd'])) {

	echo "Merci de remplir tous les champs !";

 }


if (    	isset($_POST['mail'])  AND !empty($_POST['mail'])
		AND isset($_POST['pwd'])   AND !empty($_POST['pwd'])

	){


$mail       = htmlspecialchars(preg_replace('/ /', '',$_POST['mail']));

$pwd        = htmlspecialchars($_POST['pwd']);



$req        = 'SELECT mail FROM users WHERE mail = "'.$mail.'"';
$query      = $db->query($req);
$checkmail = $query->fetchColumn();


		if ($checkmail == $mail){

$req        = 'SELECT pwd FROM users WHERE mail = "'.$mail.'"';
$query      = $db->query($req);
$checkpwd = $query->fetchColumn();

			if (password_verify($pwd, $checkpwd)) {

				echo 'ok good';

				session_start ();

				$_SESSION['login'] = $alias;

       		//	header ('location: ../views/profil.php');

			} else {

				echo "mot de passe incorrect !";
			}

		} else {

			echo 'Login incorrect !';
		
	}

}		


?>