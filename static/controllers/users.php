
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


if (    	isset($_POST['alias'])   AND !empty($_POST['alias'])
		AND isset($_POST['mail'])    AND !empty($_POST['mail'])
		AND isset($_POST['pwd'])     AND !empty($_POST['pwd'])
		AND isset($_POST['pwd2'])    AND !empty($_POST['pwd2'])
		
		){



// htmlspecialchars évite les failles XSS en échappant le html
// les balises < > deviennent respectivement &lt; et &gt; !

// Variables réservée aux colones


$alias       = htmlspecialchars(preg_replace('/ /', '',$_POST['alias']));
$mail        = htmlspecialchars(preg_replace('/ /', '',$_POST['mail']));
$pwd         = htmlspecialchars($_POST['pwd']);
$pw2         = htmlspecialchars($_POST['pwd2']);
$pwr         = "0";
$xp          = "Newbie";
$since       = date("Y-m-d");
$pwdhash     = password_hash($pwd, PASSWORD_DEFAULT);




// Variables réservée à l'ajout d'avatar	

$avatar_default  = "avatar_default.jpg";
$avatar          = $_FILES['avatar'];
$avatar_name     = preg_replace('/ /', '',$_FILES['avatar']['name']);
$avatar_type     = pathinfo($avatar_name, PATHINFO_EXTENSION);
$avatar_dbname   = $alias.'_avatar.'.$avatar_type;
$avatar_size     = $_FILES['avatar']['size'];
$autorised_type  = array('jpg', 'jpeg', 'svg', 'png');




$searchalias = 'SELECT COUNT(*) AS nbr FROM users WHERE alias = "'.$alias.'"';
$verifalias  = $db->query($searchalias);

$searchmail = 'SELECT COUNT(*) AS nbr FROM users WHERE mail = "'.$mail.'"';
$verifmail  = $db->query($searchmail);


if ($verifalias ->fetchColumn() != 0) {

	echo 'Alias déjà utilisé !';

} elseif ($verifmail ->fetchColumn() != 0){

	echo 'Adresse e-mail déjà utilisée !';

} elseif ($_POST['pwd'] != $_POST['pwd2']) {

	echo 'Les mots de passe sont différents !';

//	header ("Location: $_SERVER[HTTP_REFERER]" );

} else {


	$req = 'INSERT INTO users(alias,
 						      mail, 
 						      pwd, 
 						      pwr,
 						      xp,
 						      avatar, inscription_date) VALUES(:alias,
 						  			     				   :mail,
 						  			     				   :pwd,
 						  			     				   :pwr,
 						  			     				   :xp,
 						  			     				   :avatar,
 						  			     				   :since)';
 $query2 = $db->prepare($req);
 $requete = $query2->execute(array(
 
                           ":alias"       => $alias,
                           ":mail"        => $mail,
                           ":pwd"         => $pwdhash,
                           ":pwr"         => $pwr,
                           ":xp"          => $xp,
                           ":since"       => $since,
                           ":avatar"      => $avatar_default, 
 			                   ));

 	if (isset($avatar) AND $_FILES['avatar']['error'] == 0) {

 		if($avatar_size <= 500000) {

 			if ((in_array($avatar_type, $autorised_type))) { 


 			move_uploaded_file($_FILES['avatar']['tmp_name'], '../uploads/avatars/'.basename($avatar_dbname));


 			$av_change  = 'UPDATE users SET avatar = :newavatar WHERE alias = :alias';
 			$av_change2 = $db->prepare($av_change);
 			$requete2   = $av_change2->execute(array(

 													":alias"      => $alias,
 													":newavatar"  =>  $avatar_dbname,

 			));


 			}			

 		}

 	}


 	echo 'Bienvenue à toi '.$alias.' parmis nous !';

}



} else {

	echo 'Merci de remplir tous les champs !';
}


?>
