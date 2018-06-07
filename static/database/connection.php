<?php


// id6036374_db_sheeks
// id6036374_jram
// jr4msh33ks


try {

$user = 'id6036374_jram';
$password = 'jr4msh33ks';
$db = new PDO('mysql:host=localhost;dbname=id6036374_db_sheeks', $user, $password);

}

catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>